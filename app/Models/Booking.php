<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory; // Uncommented and fixed

    protected $table = 'bookings';

    protected $fillable = [
        'customer_name',
        'customer_email',
        'people_count',
        'tour_id',
        'user_id',      // CRITICAL: Added user_id here
        'total_price',
        'tour_price'
    ];

    /**
     * Relationship: Booking belongs to a Tour
     */
    public function tour(): BelongsTo
    {
        return $this->belongsTo(TourManagement::class, 'tour_id', 'id');
    }

    /**
     * Relationship: Booking belongs to a User (Admin/Staff who created it)
     * THIS FIXES YOUR ERROR
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}