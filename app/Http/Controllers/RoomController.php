<?php

namespace App\Http\Controllers;

use App\Models\room;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;
use PDF;

class RoomController extends Controller
{
    public function index(){

        $rooms = room::orderBy('created_at', 'desc')->get();

        return view ('room', compact('rooms'));
    }

    public function create_room(){
        return view ('create_ruangan');
    }

    public function exportPdf()
    {
        $rooms = Room::all();

        // Load view ke dalam PDF
        $pdf = PDF::loadView('rooms_download', compact('rooms'));

        // Tampilkan PDF di browser (bukan unduh)
        return $pdf->stream('room_list.pdf');
    }

    //buatkan function edit dan update
    public function edit($id)
    {
        $room = Room::findOrFail($id);
        return view('edit_room', compact('room'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'room' => 'required|string|max:255',
            'floor' => 'required|integer',
            'room_code' => 'required|string|max:255',
        ]);

        $room = Room::findOrFail($id);
        $room->room = $request->room;
        $room->floor = $request->floor;
        $room->room_code = $request->room_code;

        $room->save();

        return redirect('/room')->with('success', 'Room updated successfully!');
    }

    public function store(Request $request)
    {
        // Generate the room code
        $floor = str_pad($request->floor, 3, '0', STR_PAD_LEFT);
        $roomCount = Room::where('floor', $request->floor)->count() + 1;
        $roomNumber = str_pad($roomCount, 3, '0', STR_PAD_LEFT);
        $roomCode = 'R-' . $floor . $roomNumber;

        // Add room_code to the request
        $request['room_code'] = $roomCode;

        // Save the room data to the database
        $room = Room::create($request->all());

        $roomCode = $room->room_code; // Assuming 'room_code' is the column for the room code

        // Define the path to save the QR code
        $imagePath = public_path('qr_codes/' . $roomCode . '.png');

        // Create the folder if it doesn't exist
        if (!File::exists(public_path('qr_codes'))) {
            File::makeDirectory(public_path('qr_codes'), 0755, true);
        }

        // Generate and save the QR code with the room name
        QrCode::format('png')
            ->size(300)
            ->margin(2)
            // ->generate($roomName, $imagePath);
            ->generate($roomCode, $imagePath);

        return redirect('/room');
    }

    public function destroy($id)
{
    $room = Room::findOrFail($id); // Cari data berdasarkan ID
    $room->delete();              // Hapus data
    return redirect('/room')->with('success', 'Room deleted successfully!');
}
}
