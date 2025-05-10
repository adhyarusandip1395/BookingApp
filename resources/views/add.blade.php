@extends('partials.layout')
@section('styles')
<style>
    body {
    background-color: #f8f9fa;
    }
    .login-container {
        min-width: 400px;
        max-width: 400px;
    
    }
</style>
@endsection
@section('content')
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card login-container shadow p-4">
            <h4 class="text-center mb-4">Booking Form</h4>
           <form action="{{ route('booking.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="c_name" class="form-label">Customer Name</label>
                    <input type="text" name="c_name" value="{{ old('c_name') }}" class="form-control" id="c_name" placeholder="Enter customer name" autocomplete="off" >
                    @error('c_name')
                        <span class="text-danger ml-2">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="c_email" class="form-label">Customer Email</label>
                    <input type="email" name="c_email" value="{{ old('c_email') }}" class="form-control" id="c_email" placeholder="Enter customer email" autocomplete="off">
                    @error('c_email')
                        <span class="text-danger ml-2">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="mb-3 booking_date">
                    <label for="c_booking_date" class="form-label">Booking Date</label>
                    <input type="text" name="c_booking_date" value="{{ old('c_booking_date') }}" placeholder="Select date" class="form-control" id="c_booking_date" autocomplete="off" readonly>
                    @error('c_booking_date')
                        <span class="text-danger ml-2">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="mb-3 booking_type">
                    <label for="c_booking_type" class="form-label">Booking Type</label>
                    <select id="c_booking_type" name="c_booking_type" class="form-control">
                        <option value="">Select booking type</option>
                        <option value="full_day">Full Day</option>
                        <option value="half_day">Half Day</option>
                        <option value="custom">Custom</option>
                    </select>
                    @error('c_booking_type')
                        <span class="text-danger ml-2">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="mb-3 booking_slot d-none">
                    <label for="c_booking_slot" class="form-label">Booking Slot</label>
                    <select id="c_booking_slot" name="c_booking_slot" class="form-control">
                        <option value="">Select slot</option>
                        <option value="first_half">First Half</option>
                        <option value="second_half">Second Half</option>
                    </select>
                    @error('c_booking_slot')
                        <span class="text-danger ml-2">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="row booking_time d-none">
                    <div class="mb-3 col-6">
                        <label for="c_from_time" class="form-label">From</label>
                        <input type="text" name="c_from_time" class="form-control" id="c_from_time" autocomplete="off" 
                        placeholder="Select time" readonly>
                        @error('c_from_time')
                            <span class="text-danger ml-2">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3 col-6">
                        <label for="c_to_time" class="form-label">To</label>
                        <input type="text" name="c_to_time" class="form-control" id="c_to_time" autocomplete="off"
                        placeholder="Select time" readonly>
                        @error('c_to_time')
                            <span class="text-danger ml-2">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col text-end">
                        <button type="submit" class="btn btn-primary w-50 mt-4">Submit</button>
                    </div>
                    <div class="col text-left">
                        <a href="{{ route('booking.list') }}"><button type="button" class="btn btn-secondary w-50 mt-4">Back</button></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')

<script>
    $("#c_booking_date").datepicker({
        dateFormat: "dd/mm/yy",
        minDate:0
    });

    $("#c_from_time").timepicker({
        timeFormat: "HH:mm", // 24-hour format with seconds
    });

     $("#c_to_time").timepicker({
        timeFormat: "HH:mm", // 24-hour format with seconds
    });
   
   $(document).ready(function(){
        $('#c_booking_type').on('change', function() {
            if ($(this).val() === 'full_day') {
                $('.booking_slot').addClass('d-none');
                $('.booking_time').addClass('d-none');
            } else if ($(this).val() === 'half_day') {
                $('.booking_slot').removeClass('d-none');
                $('.booking_time').addClass('d-none');
            } else if ($(this).val() === 'custom') {
                $('.booking_slot').addClass('d-none');
                $('.booking_time').removeClass('d-none');
            }
        });
   });
</script>
@endsection