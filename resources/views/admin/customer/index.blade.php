@extends('layouts.master')
@section('content')
<div class="row" id="booking_list">
    <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-header">
                <h4>
                    Customer List
                    {{-- <small class="float-right">
                        <a href="#" id="reservationbtn" class="btn btn-primary btn-md">
                            <i class="ti-plus" aria-hidden="true"></i>
                            Room Booking
                        </a>
                    </small> --}}
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
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Balance</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $user->first_name }}</td>
                                            <td>{{ $user->last_name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->wallets ? '$' . number_format($user->wallets, 2) : '0' }}</td>
                                            <td class="center">
                                                <a href="{{ route('admin.customer.edit', $user->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="" data-original-title="Update"><i class="ti-pencil-alt text-white" aria-hidden="true"></i></a>
                                                {{-- <a onclick="paymentinfo('312')" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="" data-original-title="Paynow"><i class="ti-money text-white" aria-hidden="true"></i></a> --}}
                                                {{-- <a href="#" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="" data-original-title="Customer Details"><i class="ti-eye text-white" aria-hidden="true"></i></a> --}}
                                                {{-- <a href="#" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="" data-original-title="All Transaction"><i class="hvr-buzz-out fab fa-confluence text-white" aria-hidden="true"></i></a> --}}
                                                <a href="{{ route('admin.customer.destroy', $user->id) }}" onclick="return confirm('Are you sure ?') document.getElementById('delete-form').submit();" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="" data-original-title="Delete "><i class="ti-trash"></i></a>
                                                <form action="{{ route('admin.customer.destroy', $user->id) }}" id="delete-form-{{ $user->id }}" method="POST" style="display: inline-block;">
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
<div id="edit" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <strong>Cancel Reservation</strong>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>
@endsection