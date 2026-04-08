<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\TourManagement; // Make sure this matches your Model name

class BookingController extends Controller
{

    public function index()
    {
        $index = Booking::with('tour')->get();
        return view('bookings.index', compact('index'));
    }
    // Show the booking form for a specific tour
    public function create()
    {
        $tour = TourManagement::all();
        return view('bookings.create', compact('tour'));
    }

    // Save the booking and calculate total price
    public function store(Request $request)
    {
        //line 27 to 42  ai
    //1 get the price from the tours table base on the ID
    $tour = TourManagement::find($request->tour_id);
    // 2. Calculate the total 
    $total_price = $tour ? $request->people_count * $tour->price : 0;

    // 3. Save to database
    Booking::create([
        'customer_name'  => $request->customer_name,
        'customer_email' => $request->customer_email,
        'tour_id'        => $request->tour_id,
        'people_count'   => $request->people_count,
        'total_price'    => $total_price, // <--- Make sure this is here!
    ]);

    return redirect()->route('booking.index');
        // dd($request->all());
        // $data = $request->validate([

        //     'customer_name'   => 'nullable|string|max:255',
        //     'customer_email'  => 'nullable|email|max:255',
        //     'people_count'    => 'nullable|integer|min:1',
        //     'total_price'     => 'nullable|decimal',
        //     'tour_id'         => 'nullable|exists:tour_management,id',
        // ]);
        // Booking::create($data);
        // return redirect()->route('booking.index')->with('success', 'Booking successful!');
    }

    public function edit($id)
    {
        $tour = TourManagement::all();
        $data = Booking::findOrFail($id);
        return view('bookings.edit', compact('data', 'tour'));
    }

    public function update(Request $request, $id)
    {
               //line 65 to 87 ai

        // 1. Validate fields
    $validatedData = $request->validate([
        'tour_id' => 'required|exists:tour_management,id',
        'customer_name' => 'nullable',
        'customer_email' => 'nullable|email|max:255',
        'people_count' => 'required|integer|min:1',
    ]);

    $booking = Booking::findOrFail($id);

    // 2. Fetch the tour to get the official price
    $tour = TourManagement::findOrFail($request->tour_id);

    // 3. Perform the calculation on the server side
    $total_price = $request->people_count * $tour->price;

    // 4. Add the total_price to the data array before updating
    $validatedData['total_price'] = $total_price;

    // 5. Update the record
    $booking->update($validatedData);

        // 1. validate other fields
        $data = $request->validate([
            'tour_id' => 'nullable',
            'customer_name' => 'nullable',
            'customer_email' => 'nullable|email|max:255',
            'people_count' => 'nullable',
            'tour_price' => 'nullable',
            'total_price' =>'nullable',
        ]);

        $booking = Booking::findOrFail($id);

        $booking->update($data);
        return redirect()->route('booking.index')->with('success', 'Booking updated successfully');

    }

    public function delete($id)
    {
        $tour= Booking::all();
        $data = Booking::findOrFail($id);
        $tour = TourManagement::all();
        return view('bookings.delete', compact('data', 'tour'));

        $tour = TourManagement::all();
        $data = Booking::findOrFail($id);
        return view('bookings.edit', compact('data', 'tour'));
    }

    public function destroy($id)
    {
        $tour = Booking::all();
        $booking = Booking::findOrFail($id);
        $booking->delete();
        return redirect()->route('booking.index')->with('success', 'Booking deleted successfully!');
    }
}
