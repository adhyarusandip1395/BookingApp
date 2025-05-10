<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'c_name' => 'required',
            'c_email' => 'required|email',
            'c_booking_date' => 'required',
            'c_booking_type' => 'required|in:full_day,half_day,custom',
        ];
    
        if ($this->c_booking_type === 'half_day') {
            $rules['c_booking_slot'] = 'required|in:first_half,second_half';
        }
    
        if ($this->c_booking_type === 'custom') {
            $rules['c_from_time'] = 'required';
            $rules['c_to_time'] = 'required|after:c_from_time';
        }
    
        return $rules;
    }

    public function messages(){
        return [
            'c_name.required' => 'Name is required',
            'c_email.required' => 'Email is required',
            'c_booking_date.required' => 'Booking date is required',
            'c_booking_type.required' => 'Booking type is required',
            'c_booking_slot.required' => 'Booking slot is required',
            'c_from_time.required' => 'From time is required',
            'c_to_time.required' => 'To time is required',
        ];
    }
}
