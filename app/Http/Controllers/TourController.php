<?php

namespace App\Http\Controllers;

use App\Models\TourManagement;
use Illuminate\Http\Request;

class TourController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('permission:tour.viewer|tour.create|tour.edit|tour.delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:tour.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:tour.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:our.delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $q = $request->input('q');
        $status = $request->input('status');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        $tour = TourManagement::with('bookings')
            //search
            ->when($q, function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('id', 'Like', "%{$q}%")
                        ->orWhere("name", 'Like', "%{$q}%")
                        ->orWhere("description", 'Like', "%{$q}%")
                        ->orWhere("price", 'Like', "%{$q}%")
                        ->orWhere("start_date", 'Like', "%{$q}%")
                        ->orWhere("end_date", 'Like', "%{$q}%")
                        ->orWhere("status", 'Like', "%{$q}%")
                        ->orWhereHas('bookings', fn($t) => $t->where('name', 'LIKE', "%{$q}%"));
                });
            })
            //filter by status
            ->when($status, fn($query) => $query->where('status', $status))
            //filter by min price
            ->when($minPrice, fn($query) => $query->where('price', $minPrice))
            //filter by max price
            ->when($maxPrice, fn($query) => $query->where('price', $maxPrice))
            ->latest()
            ->paginate(5);

        // $tour  = TourManagement::all();
        return view('tours.index', compact('tour', 'q', 'status', 'minPrice', 'maxPrice'));
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
