<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        // Ambil data user yang sedang login
        $user = auth()->user(); // Ini akan mengambil data dari model User
        return view('profile', compact('user'));
    }
    //tambahkan method edit
    public function edit()
    {
        // Ambil data user yang sedang login
        $user = auth()->user(); // Ini akan mengambil data dari model User
        return view('edit_profile', compact('user'));
    }
    //tambahkan method update
    public function update(Request $request)
    {
        // Validasi data yang dikirim
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . auth()->id(),
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Ambil data user yang sedang login
        $user = auth()->user(); // Ini akan mengambil data dari model User
        $user->name = $request->name;
        $user->username = $request->username;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profile berhasil diupdate.');
    }
}

