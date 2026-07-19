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

        // Fitur ekspor Excel/CSV
        if ($request->input('export') === 'excel') {
            $headers = [
                "Content-type"        => "text/csv; charset=UTF-8",
                "Content-Disposition" => "attachment; filename=laporan_bengkel_" . now()->format('Y-m-d') . ".csv",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            ];

            $callback = function() use($services) {
                $file = fopen('php://output', 'w');
                // UTF-8 BOM
                fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
                
                fputcsv($file, ['No', 'Tanggal', 'Pelanggan', 'Kendaraan', 'Keluhan', 'Total Pendapatan']);

                $hasDetailsTable = Schema::hasTable('service_details');
                
                foreach ($services as $index => $service) {
                    $total = 50000;
                    if ($hasDetailsTable) {
                        $total = $service->serviceDetails->sum('subtotal') ?: 50000;
                    }

                    fputcsv($file, [
                        $index + 1,
                        \Carbon\Carbon::parse($service->service_date)->format('d-m-Y'),
                        $service->vehicle->customer->name ?? '-',
                        $service->vehicle->plate_number ?? '-',
                        $service->complaint,
                        $total
                    ]);
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }

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
