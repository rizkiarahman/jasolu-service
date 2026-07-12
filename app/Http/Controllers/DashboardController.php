<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Vehicle;
use App\Models\Sparepart;
use App\Models\Service;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCustomers = Customer::count();
        $totalVehicles = Vehicle::count();
        $totalSpareparts = Sparepart::count();
        $totalServices = Service::count();

        return view('dashboard', compact(
            'totalCustomers',
            'totalVehicles',
            'totalSpareparts',
            'totalServices'
        ));
    }
}
