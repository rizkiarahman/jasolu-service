<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Vehicle;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Query services dengan relations
        $query = Service::with(['vehicle.customer', 'serviceDetails']);

        if ($startDate) {
            $query->whereDate('service_date', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('service_date', '<=', $endDate);
        }

        $services = $query->latest()->get();

        // Hitung statistik
        $totalCustomers = Customer::count();
        $totalVehicles = Vehicle::count();
        $totalServices = Service::count();

        // Hitung total pendapatan secara aman
        $totalIncome = 0;
        if (Schema::hasTable('service_details')) {
            $totalIncome = \App\Models\ServiceDetail::sum('subtotal');
        } else {
            // Jika tabel service_details belum ada, estimasikan pendapatan berdasarkan service yang Selesai (Flat Rp 50.000)
            $totalIncome = Service::where('status', 'Selesai')->count() * 50000;
        }

        return view('reports.index', compact(
            'services',
            'totalCustomers',
            'totalVehicles',
            'totalServices',
            'totalIncome',
            'startDate',
            'endDate'
        ));
    }
}
