<?php

namespace App\Http\Controllers\Wilayah;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        return view('wilayah.index', [
            'locations' => Location::with('children.children')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'detail' => 'nullable|string',
        ]);

        Location::create([
            'name' => $validated['city'],
            'city' => $validated['city'],
            'province' => $validated['province'],
            'detail' => $validated['detail'] ?? null,
            'type' => 'city',
            'parent_id' => null,
        ]);

        return back()->with('success', 'Wilayah ditambahkan');
    }

    public function edit(Location $location)
    {
        return view('wilayah.edit', compact('location'));
    }

    public function update(Request $request, Location $location)
    {
        $validated = $request->validate([
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'detail' => 'nullable|string',
        ]);

        $location->update([
            'name' => $validated['city'],
            'city' => $validated['city'],
            'province' => $validated['province'],
            'detail' => $validated['detail'] ?? null,
            'type' => 'city',
        ]);

        return redirect()
            ->route('wilayah.locations.index')
            ->with('success', 'Wilayah berhasil diperbarui');
    }

    public function destroy(Location $location)
    {
        $location->delete();

        return back()->with('success', 'Wilayah berhasil dihapus');
    }
}
