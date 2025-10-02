@extends('layouts.master')
@section('content')
<div class="row" id="booking_list">
    <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-header">
                <h4>
                    Booking List
                    <small class="float-right">
                        <a href="{{ route('admin.bookings.create') }}" id="reservationbtn" class="btn btn-primary btn-md">
                            <i class="ti-plus" aria-hidden="true"></i>
                            Book Reservation
                        </a>
                    </small>
                </h4>
            </div>
            <div class="row">
                <!--  table area -->
                <div class="col-sm-12">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table width="100%" class="datatable table table-striped table-bordered table-hover"  id="bookingdetails">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Booking Number</th>
                                        <th>Room Type</th>
                                        <th>Room No.</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Check In</th>
                                        <th>Check Out</th>
                                        <th>Arrival Time</th>
                                        <th>Paid Amount</th>
                                        <th>Assign</th>
                                        <th>Booking Status</th>
                                        <th>Payment Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($bookings as $booking)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $booking->booking_number }}</td>
                                            <td>{{ $booking->roomListing->room_type }}</td>
                                            <td>{{ $booking->roomListing->room_number }}</td>
                                            <td>{{ $booking->user->first_name }}  {{ $booking->user->last_name }}</td>
                                            <td>{{ $booking->user->phone }}</td>
                                            <td>{{ $booking->check_in }}</td>
                                            <td>{{ $booking->check_out }}</td>
                                            <td>{{ $booking->arrival_time }}</td>
                                            <td>{{ $booking->paid_amount ? '$' . number_format($booking->paid_amount, 2) : 'N/A' }}</td>
                                            <td>
                                                @if ($booking->assign == 1)
                                                    <span class="badge badge-success">Assigned</span>
                                                @else
                                                    <span class="badge badge-danger">Not Assigned</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($booking->payment_type == 'full')
                                                    <span class="badge badge-success p-2">Full Payment</span>
                                                @elseif($booking->payment_type == 'reservation')
                                                    <span class="badge badge-success p-2">Reservation</span>
                                                @else
                                                    <span class="badge badge-danger p-2">No Payment</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($booking->payment_status == 1)
                                                    <span class="badge badge-success p-2">Paid</span>
                                                @else
                                                    <span class="badge badge-danger p-2">Unpaid</span>
                                                @endif
                                            </td>
                                            <td class="center">
                                                <a href="{{ route('admin.booking.edit', $booking->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="" data-original-title="Update"><i class="ti-pencil-alt text-white" aria-hidden="true"></i></a>
                                                <a href="{{ route('admin.booking.show', $booking->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="" data-original-title="Customer Details"><i class="ti-eye text-white" aria-hidden="true"></i></a>
                                                <a href="{{ route('admin.booking.delete', $booking->id) }}" onclick="return confirm('Are you sure ?'); document.getElementById('delete-form-{{ $booking->id }}').submit();" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="" data-original-title="Delete "><i class="ti-trash"></i></a>
                                                <form action="{{ route('admin.booking.delete', $booking->id) }}" id="delete-form-{{ $booking->id }}" style="display: none;" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        
                                    @endforelse
                                </tbody>
                            </table> <!-- /.table-responsive -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('#bookingdetails').DataTable();
    });
</script>
@endpush
