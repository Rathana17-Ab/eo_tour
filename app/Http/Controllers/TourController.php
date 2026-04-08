<?php

namespace App\Http\Controllers;

use App\Models\TourManagement;
use Illuminate\Http\Request;

class TourController extends Controller
{
    //
    public function index()
    {
        $tour  = TourManagement::all();
        return view('tours.index', compact('tour'));
    }
    public function create()
    {
        return view('tours.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => ' required',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required'
        ]);
        TourManagement::create($data);
        return redirect()->route('tour.index')->with('success', 'Tour created successfully!');
    }
    public function edit($id)
    {
        $data = TourManagement::findOrFail($id);
        return view('tours.edit', compact('data'));
    }
    // Use $id instead of the Model if your route uses {id}
    public function update(Request $request, $id)
    {
        // 1. Validate other fields (status is optional here)
        $data = $request->validate([
            'name' => 'nullable',
            'description' => 'nullable',
            'price' => 'nullable',
            'start_date' => 'nullable',
            'end_date' => 'nullable',
        ]);

        $tour = TourManagement::findOrFail($id);

        // 2. Logic: If the checkbox was clicked, it's 1. If not, it's 0.
        $data['status'] = $request->has('status') ? 1 : 0;

        // 3. Update the database
        $tour->update($data);

        return redirect()->route('tour.index')->with('success', 'Tour updated successfully!');
    }

    public function delete($id)
    {
        $data = TourManagement::findOrFail($id);
        return view('tours.delete', compact('data'));
    }

    public function destroy($id)
    {
        $tour = TourManagement::findOrFail($id);
        $tour->delete();
        return redirect()->route('tour.index')->with('success', 'Tour deleted successfully!');
    }
}
