<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Part;

class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parts = Part::with('car')->get();

        return response()->json($parts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'serialnumber' => 'required|string|max:255|unique:parts,serialnumber',
            'car_id' => 'required|exists:cars,id',
        ]);

        $part = Part::create($request->all());

        return response()->json($part, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $part = Part::with('car')->findOrFail($id);
        return response()->json($part);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'serialnumber' => 'required|string|max:255|unique:parts,serialnumber,'.$part->id,
            'car_id' => 'required|exists:cars,id',
        ]);

        $part->update($request->all());

        return response()->json($part);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $part = part::findOrFail($id);

        $part->delete();

        return response()->json(null, 204);
    }
}
