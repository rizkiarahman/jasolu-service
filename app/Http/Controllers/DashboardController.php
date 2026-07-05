<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
    $nama = "Admin";
    $motor = [
        "Honda",
        "Yamaha",
        "Suzuki",
        "Kawasaki"
    ];

    return view('dashboard', compact('nama', 'motor'));
    }
}
