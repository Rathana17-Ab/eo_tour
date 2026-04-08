<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourManagement extends Model
{
    //
    protected $table ='tour_management';
     protected $fillable = [
        'name', 
        'description',
        'price',
        'start_date',
        'end_date',
        'status',
     ];
     public function bookings(){
        return $this->hasMany(Booking::class,'tour_id', 'id');
     }
}

