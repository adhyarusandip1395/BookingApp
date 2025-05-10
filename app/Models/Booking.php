<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable=[
        'user_id',
        'name',
        'email',
        'booking_date',
        'booking_type',
        'booking_slot',
        'from_time',
        'to_time'
    ];

    public function getBookingDateAttribute($value){
        return date('d/m/Y', strtotime($value));
    }

    public function getFromTimeAttribute($value){
        $value = ($value) ? date('H:i', strtotime($value)) : null;
        return $value;
    }

    public function getToTimeAttribute($value){
        $value = ($value) ? date('H:i', strtotime($value)) : null;
        return $value;
    }

    public function getBookingTypeAttribute($value){
        switch($value){
            case 'full_day':
                return 'Full Day';
            case 'half_day':
                return 'Half Day';
            case 'custom':
                return 'Custom';
        }
    }

    public function getBookingSlotAttribute($value){
        switch($value){
            case 'first_half':
                return 'First Half';
            case 'second_half':
                return 'Second Half';
        }
    }
}
