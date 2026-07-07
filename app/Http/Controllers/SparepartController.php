<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sparepart;

class SparepartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $spareparts = Sparepart::when($keyword, function ($query, $keyword) {
            $query->where('name', 'like', "%{$keyword}%")
                ->orWhere('code', 'like', "%{$keyword}%");
        })
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('spareparts.index', compact('spareparts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('spareparts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'code' => 'required|unique:spareparts',
            'name' => 'required',
            'stock' => 'required|integer',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',

        ]);

        Sparepart::create($request->all());
        return redirect()->route('spareparts.index')
            ->with('success', 'Data berhasil ditambahkan');;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sparepart $sparepart)
    {
        return view('spareparts.edit', compact('sparepart'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sparepart $sparepart)
    {
        $validated = $request->validate([
            'code' => 'required|max:50',
            'name' => 'required|max:100',
            'stock' => 'required|integer|min:0',
            'selling_price' => 'required|numeric|min:0',
        ]);

        $sparepart->update($validated);

        return redirect()->route('spareparts.index')
            ->with('success', 'Data sparepart berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sparepart $sparepart)
    {
        $sparepart->delete();

        return redirect()
            ->route('spareparts.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
