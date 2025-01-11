<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tracking;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TrackingExport;


class TrackingController extends Controller
{
    public function index(Request $request)
    {
        $query = Tracking::query()->with('room', 'user');

        if ($request->has('start_date') && $request->start_date) {
            $startDate = $request->start_date . ' 00:00:00';
            $query->where('date', '>=', $startDate);
        }

        if ($request->has('end_date') && $request->end_date) {
            $endDate = $request->end_date . ' 23:59:59';
            $query->where('date', '<=', $endDate);
        }

        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('room', function ($qr) use ($request) {
                    $qr->where('room', 'like', '%' . $request->search . '%');
                })->orWhereHas('user', function ($qu) use ($request) {
                    $qu->where('name', 'like', '%' . $request->search . '%');
                });
            });
        }

        $query->orderBy('date', 'desc');
        $trackings = $query->paginate(10);

        return view('tracking', compact('trackings'));
    }
    public function scan()
    {
        return view('scan');
    }

    public function exportToExcel(Request $request)
    {
        $filters = [
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'search' => $request->input('search'),
        ];

        return Excel::download(new TrackingExport($filters), 'Data_Tracking.xlsx');
    }

    public function checkRoom(Request $request)
    {
        $roomCode = $request->query('room_code');

        $room = Room::where('room_code', $roomCode)->first();

        if (!$room || Tracking::where('room_id', $room->id)->whereDate('date', date('Y-m-d'))->exists()) {
            $errorMessage = !$room ? 'Room tidak valid atau tidak ditemukan.' : 'Room telah di scan.';
            return redirect()->back()->with('error', $errorMessage);
        }

        return redirect()->route('tracking.create', [
            'room_id' => $room->id,
            'user_name' => 'User dari Scan',
        ]);
    }

    public function create(Request $request)
    {
        // Ambil parameter yang diterima dari route
        $roomId = $request->query('room_id');
        $userName = $request->query('user_name');

        // Cari room berdasarkan ID
        $room = Room::find($roomId);

        if (!$room) {
            return redirect()->back()->with('error', 'Room tidak valid.');
        }

        // Ambil semua data user untuk dropdown
        $users = User::all();

        // Tanggal otomatis
        $currentDate = now()->format('Y-m-d H:i:s');

        return view('create_tracking', compact('room', 'userName', 'currentDate', 'users'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'situasi' => 'required|string|max:255',
            'foto' => 'required|image|max:2048', // Maksimum ukuran foto 2MB
        ]);
        // Mendapatkan ID user yang sedang login
        $userId = Auth::id(); // Mendapatkan ID user yang sedang login
        // Simpan data tracking ke database
        $tracking = new Tracking();
        $tracking->room_id = $validatedData['room_id'];
        $tracking->situasi = $validatedData['situasi'];
        $tracking->foto = $request->file('foto')->store('uploads/foto', 'public');
        $tracking->user_id = $userId; // Menggunakan user yang login
        $tracking->date = now();
        $tracking->save();

        return redirect()->route('tracking.index')->with('success', 'Tracking berhasil disimpan.');
    }

    public function destroy($id)
{
    $tracking = tracking::findOrFail($id); // Cari data berdasarkan ID
    $tracking->delete();              // Hapus data
    return redirect('/tracking')->with('success', 'Room deleted successfully!');
}
}
