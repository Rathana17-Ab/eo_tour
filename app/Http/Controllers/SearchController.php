<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TourManagement;
use App\Models\User;
use App\Models\Booking;
use Spatie\Permission\Models\Permission;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'q' => 'required|string|min:1|max:100',
        ]);

        $q = $request->input('q');

        // Search tours by columns directly
        $tours = TourManagement::where('id', 'LIKE', "%{$q}%")
            ->orWhere('name', 'LIKE', "%{$q}%")
            ->orWhere('description', 'LIKE', "%{$q}%")
            ->orWhere('price', 'LIKE', "%{$q}%")
            ->latest()
            ->paginate(10, ['*'], 'tour_page');

        // Search bookings by columns directly (NOT whereHas for columns)
        $bookings = Booking::with(['tour', 'user'])
            ->where('id', 'LIKE', "%{$q}%")
            ->orWhere('customer_name', 'LIKE', "%{$q}%")
            ->orWhere('customer_email', 'LIKE', "%{$q}%")
            ->orWhere('people_count', '=', $q) // <--- ADD THIS LINE
            ->orWhereHas('tour', fn($query) => $query->where('name', 'LIKE', "%{$q}%"))
            ->latest()
            ->paginate(10, ['*'], 'booking_page');

        // Search Users by Name, Email, or Role
        $users = User::with('roles')
            ->where(function ($query) use ($q) {
                $query->where('id', 'LIKE', "%{$q}%")
                    ->orWhere('name', 'LIKE', "%{$q}%")
                    ->orWhere('email', 'LIKE', "%{$q}%")
                    ->orWhere('status', 'LIKE', "%{$q}%")
                    // This searches the Spatie roles table
                    ->orWhereHas('roles', function ($roleQuery) use ($q) {
                        $roleQuery->where('name', 'LIKE', "%{$q}%");
                    });
            })
            ->latest()
            ->limit(10)
            ->get();

        // Add this at the top with your other "use" statements


        // Inside your search() function:
        $permissions = Permission::where('name', 'LIKE', "%{$q}%")
            ->latest()->limit(10)->get();

        // Then update your return to include $permissions
        return view('search.results', compact('tours', 'bookings', 'users', 'permissions', 'q'));
    }
}
