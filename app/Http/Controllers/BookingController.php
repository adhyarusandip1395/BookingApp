<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class BookingController extends Controller
{
    public function list(){
        
        $bookings=Booking::where('user_id',Auth::user()->id)->get();

        return view('list',compact('bookings'));
    }

    public function add(){

        return view('add');
    }
    public function store(BookingRequest $request) {

        $date = \DateTime::createFromFormat('d/m/Y', $request->c_booking_date)->format('Y-m-d');
        $type = $request->c_booking_type;
        $slot = $request->c_booking_slot;
        $from = $request->c_from_time;
        $to = $request->c_to_time;
    
        $conflict = false;
    
        if ($type === 'full_day') {
            $conflict = Booking::where('user_id',Auth::user()->id)->where('booking_date', $date)->exists();

        }elseif ($type === 'half_day') {

            $query = Booking::where('user_id',Auth::user()->id)->where('booking_date', $date);
    
            if ($slot === 'first_half') {

                $conflict = $query->where(function ($q) {
                    $q->where('booking_type', 'full_day')
                        ->orWhere(function ($q2) {
                            $q2->where('booking_type', 'half_day')
                                ->where('booking_slot', 'first_half');
                        })
                        ->orWhere(function ($q3) {
                            $q3->where('booking_type', 'custom')
                                ->where(function ($q4) {
                                    $q4->whereBetween('from_time', ['10:00:00', '11:00:00'])
                                    ->orWhereBetween('to_time', ['10:00:00', '11:00:00']);
                                });
                        });
                })->exists();
            }
    
            if ($slot === 'second_half') {
                $conflict = $query->where(function ($q) {
                    $q->where('booking_type', 'full_day')
                        ->orWhere(function ($q2) {
                            $q2->where('booking_type', 'half_day')
                                ->where('booking_slot', 'second_half');
                        });
                })->exists();
            }

        }elseif ($type === 'custom') {

            $conflict = Booking::where('user_id',Auth::user()->id)->where('booking_date', $date)
                ->where(function ($q) use ($from, $to) {
                    $q->where('booking_type', 'full_day')
                        ->orWhere(function ($q2) {
                            $q2->where('booking_type', 'half_day')
                                ->where('booking_slot', 'first_half');
                        })
                        ->orWhere(function ($q3) use ($from, $to) {
                            $q3->where('booking_type', 'custom')
                                ->where(function ($q4) use ($from, $to) {
                                    $q4->whereBetween('from_time', [$from, $to])
                                        ->orWhereBetween('to_time', [$from, $to])
                                        ->orWhere(function ($q5) use ($from, $to) {
                                            $q5->where('from_time', '<=', $from)
                                            ->where('to_time', '>=', $to);
                                        });
                                });
                        });
                })
                ->exists();
        }
    
        if ($conflict) {
            Toastr::error('Booking conflict. Please select another time or type.');
            return redirect()->back()->withInput();  
        }
    
        Booking::create([
            'user_id' => Auth::user()->id,
            'name' => $request->c_name,
            'email' => $request->c_email,
            'booking_date' => $date,
            'booking_type' => $request->c_booking_type,
            'booking_slot' => $request->c_booking_type === 'half_day' ? $request->c_booking_slot : null,
            'from_time' => $request->c_booking_type === 'custom' ? $request->c_from_time : null,
            'to_time' => $request->c_booking_type === 'custom' ? $request->c_to_time : null,
        ]);
        
        
        Toastr::success('Booking has been created successfully.');
        return redirect()->route('booking.list');
    }
        

}
