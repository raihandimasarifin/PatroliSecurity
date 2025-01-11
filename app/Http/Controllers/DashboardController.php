<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $role = auth()->user()->role;

    if ($role === 'satpam') {
        return view('dashboard_satpam');
    } elseif ($role === 'kepala') {
        return view('dashboard');
    } else {
        return abort(403, 'Unauthorized access'); // Akses tidak diizinkan
    }
}

}
