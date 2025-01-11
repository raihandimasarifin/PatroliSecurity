<?php

namespace App\Http\Controllers;

use App\Models\room;
use App\Models\Tracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScannerController extends Controller
{
    public function scanner(){
        $userId = Auth::user()->id;
        $rooms = room::all();
        $trackings = Tracking::where('user_id', $userId)
                ->whereDate('date', date('Y-m-d'))
                ->get();

        $data = $rooms->map(function ($room) use ($trackings) {
            $isScanned = $trackings->contains('room_id', $room->id);
            return [
                'id' => $room->id,
                'room' => $room->room,
                'floor' => $room->floor,
                'room_code' => $room->room_code,
                'isScanned' => $isScanned ? true : false,
            ];
        });

        $belumScan = $data->filter(fn($item) => $item['isScanned'] === false);
        $sudahScan = $data->filter(fn($item) => $item['isScanned'] === true);

        return view ('scanner', compact('belumScan', 'sudahScan'));
    }
}
