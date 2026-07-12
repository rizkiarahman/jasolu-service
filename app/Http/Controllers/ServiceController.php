<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $services = Service::with('vehicle.customer')

            ->when($keyword, function ($query) use ($keyword) {

                $query->whereHas('vehicle', function ($q) use ($keyword) {

                    $q->where('plate_number', 'like', "%$keyword%");
                });
            })

            ->latest()

            ->paginate(5)

            ->withQueryString();

        return view('services.index', compact('services'));
    }

    public function create()
    {
        $vehicles = Vehicle::with('customer')
            ->orderBy('plate_number')
            ->get();

        return view('services.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $request->validate([

            'vehicle_id' => 'required',

            'service_date' => 'required|date',

            'complaint' => 'required',

            'status' => 'required'

        ]);

        Service::create($request->all());

        return redirect()
            ->route('services.index')
            ->with('success', 'Data service berhasil ditambahkan.');
    }

    public function edit(Service $service)
    {
        $vehicles = Vehicle::with('customer')->get();

        return view(
            'services.edit',
            compact('service', 'vehicles')
        );
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([

            'vehicle_id' => 'required',

            'service_date' => 'required',

            'complaint' => 'required',

            'status' => 'required'

        ]);

        $service->update($request->all());

        return redirect()
            ->route('services.index')
            ->with('success', 'Data service berhasil diperbarui.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()
            ->route('services.index')
            ->with('success', 'Data service berhasil dihapus.');
    }
}
