<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::with('customer')
            ->paginate(5);

        return view(
            'vehicles.index',
            compact('vehicles')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::orderBy('name')->get();

        return view('vehicles.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'customer_id' => 'required',
            'plate_number' => 'required|unique:vehicles',
            'brand' => 'required',
            'model' => 'required',
            'year' => 'required'
        ]);

        Vehicle::create($request->all());

        return redirect()
            ->route('vehicles.index')
            ->with('success', 'Data kendaraan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }
}
