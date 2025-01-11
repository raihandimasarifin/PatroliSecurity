<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
{
    $users = User::all();
    return view('data_user', compact('users'));
}
    public function create()
{
    return view('create_user');
}
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('edit_user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'role' => 'required|string|in:kepala,satpam',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect('/users')->with('success', 'User berhasil dibuat.');
    }

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username',
        'role' => 'required|string|in:kepala,satpam',
        'password' => 'required|string|min:8|confirmed', // Menggunakan konfirmasi password
    ]);

    User::create([
        'name' => $request->name,
        'username' => $request->username,
        'role' => $request->role,
        'password' => Hash::make($request->password),
    ]);

    return redirect('/users')->with('success', 'User berhasil dibuat.');
}
    public function destroy($id)
{
    $user = User::findOrFail($id); // Cari data berdasarkan ID
    $user->delete();              // Hapus data
    return redirect('/users')->with('success', 'Room deleted successfully!');
}
}
