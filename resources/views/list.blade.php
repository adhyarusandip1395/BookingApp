@extends('partials.layout')
@section('styles')
<style>
    body {
    background-color: #f8f9fa;
    }
    th,td{
        text-align: center;
    }
</style>
@endsection
@section('content')
    <div class="container mt-5 p-5">
        <div class="row">
            <div class="col text-end mb-2">
                <button class="btn btn-primary" onclick="window.location.href='{{ route('booking.add') }}'">Book</button>
                <button class="btn btn-danger" onclick="window.location.href='{{ route('customer.logout') }}'">Logout</button>
            </div>
        </div>
        <div class="card shadow p-4">
            <h4 class="text-center mb-4">My bookings</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Date</th>
                        <th scope="col">Type</th>
                        <th scope="col">Slot</th>
                        <th scope="col">From time</th>
                        <th scope="col">To time</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bookings as $booking)
                        <tr>
                            <td>{{ $booking->name }}</td>
                            <td>{{ $booking->email }}</td>
                            <td>{{ $booking->booking_date }}</td>
                            <td>{{ $booking->booking_type }}</td>
                            <td>{{ $booking->booking_slot ?? '-' }}</td>
                            <td>{{ $booking->from_time ?? '-'}}</td>
                            <td>{{ $booking->to_time ?? '-'}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No bookings found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')

<script>
    $("#c_booking_date").datepicker({
        dateFormat: "dd/mm/yy"  // Customize the format as needed
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