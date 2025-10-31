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
                                        <th>Pending Amount</th>
                                        <th>Pending Check In</th>
                                        <th>Pending Check Out</th>
                                        <th>Assign</th>
                                        <th>Booking Status</th>
                                        <th>Payment Type</th>
                                        <th>Payment Status</th>
                                        <th>Approval Status</th>
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
                                            <td>{{ $booking->check_in_date }}</td>
                                            <td>{{ $booking->check_out_date }}</td>
                                            <td>{{ $booking->arrival_time ?? 'N/A' }}</td>
                                            <td>{{ $booking->paid_amount ? '₦' . number_format($booking->paid_amount, 2) : 'N/A' }}</td>
                                            <td>{{ $booking->pending_amount ? '₦' . number_format($booking->pending_amount, 2) : 'N/A' }}</td>
                                            <td>{{ $booking->pending_check_in_date ?? 'N/A' }}</td>
                                            <td>{{ $booking->pending_check_out_date ?? 'N/A' }}</td>
                                            <td>
                                                @if ($booking->assign == 1)
                                                    <span class="badge bg-success text-white">Assigned</span>
                                                @else
                                                    <span class="badge bg-danger text-white">Not Assigned</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($booking->status == 'pending')
                                                    <span class="badge bg-warning p-2 text-white">Pending</span>
                                                @elseif ($booking->status == 'confirmed')
                                                    <span class="badge bg-info p-2 text-white">Confirmed</span>
                                                @elseif ($booking->status == 'checked-in')
                                                    <span class="badge bg-primary p-2 text-white">Checked In</span>
                                                @elseif ($booking->status == 'checked-out')
                                                    <span class="badge bg-success p-2 text-white">Checked Out</span>
                                                @elseif ($booking->status == 'cancelled')
                                                    <span class="badge bg-danger p-2 text-white">Cancelled</span>
                                                @else
                                                    <span class="badge bg-secondary p-2 text-white">{{ ucfirst($booking->status) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($booking->payment_type == 'full')
                                                    <span class="badge bg-success p-2 text-white">Full Payment</span>
                                                @elseif($booking->payment_type == 'reservation')
                                                    <span class="badge bg-info p-2 text-white">Reservation</span>
                                                @else
                                                    <span class="badge bg-secondary p-2 text-white">No Payment</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($booking->payment_status == 1)
                                                    <span class="badge bg-success p-2 text-white">Paid</span>
                                                @else
                                                    <span class="badge bg-danger p-2 text-white">Unpaid</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($booking->approval_status == 'pending')
                                                    <span class="badge bg-warning p-2 text-white">Pending</span>
                                                @elseif ($booking->approval_status == 'approved')
                                                    <span class="badge bg-success p-2 text-white">Approved</span>
                                                @elseif ($booking->approval_status == 'rejected')
                                                    <span class="badge bg-danger p-2 text-white">Rejected</span>
                                                @else
                                                    <span class="badge bg-secondary p-2 text-white">N/A</span>
                                                @endif
                                            </td>
                                            <td class="center">
                                                @if (Auth::guard('admin')->user()->hasPermissionTo('edit-other-booking-details'))
                                                    <a href="{{ route('admin.booking.edit', $booking->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="" data-original-title="Update"><i class="ti-pencil-alt text-white" aria-hidden="true"></i></a>
                                                @endif
                                                @if (Auth::guard('admin')->user()->hasPermissionTo('view-bookings'))
                                                    <a href="{{ route('admin.booking.show', $booking->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="" data-original-title="Customer Details"><i class="ti-eye text-white" aria-hidden="true"></i></a>
                                                @endif
                                                @if (Auth::guard('admin')->user()->hasPermissionTo('delete-bookings'))
                                                    <a href="{{ route('admin.booking.delete', $booking->id) }}" onclick="return confirm('Are you sure ?'); document.getElementById('delete-form-{{ $booking->id }}').submit();" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="" data-original-title="Delete "><i class="ti-trash"></i></a>
                                                    <form action="{{ route('admin.booking.delete', $booking->id) }}" id="delete-form-{{ $booking->id }}" style="display: none;" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                @endif

                                                @if ($booking->approval_status == 'pending' && Auth::guard('admin')->user()->hasPermissionTo('approve-booking-edits'))
                                                    <form action="{{ route('admin.booking.approve', $booking->id) }}" method="post" style="display: inline-block;">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="" data-original-title="Approve"><i class="ti-check text-white"></i></button>
                                                    </form>
                                                    <form action="{{ route('admin.booking.reject', $booking->id) }}" method="post" style="display: inline-block;">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="right" title="" data-original-title="Reject"><i class="ti-close text-white"></i></button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="19" class="text-center">No bookings found.</td>
                                        </tr>
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
