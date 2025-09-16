@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Booking List
                        {{-- <small class="float-right">
                            <a href="#" id="reservationbtn" class="btn btn-primary btn-md">
                                <i class="ti-plus" aria-hidden="true"></i>
                                Room Booking
                            </a>
                        </small> --}}
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.booking.update', $booking->id) }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        @csrf
                        @method('PUT')
                        <!-- Booking Information Section -->
                        <div class="form-group row mt-4">
                            <div class="col-12">
                                <hr>
                                <h5 class="mb-3 text-primary">Booking Information</h5>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="check_in" class="col-sm-2 col-form-label">Check In <span class="text-danger">*</span></label>
                            <div class="col-sm-4">
                                <input name="check_in" autocomplete="off" required class="datepickers form-control" type="text"
                                    placeholder="Check In Date" id="check_in" value="{{ $booking->check_in }}">
                            </div>
                            <label for="check_out" class="col-sm-2 col-form-label">Check Out <span class="text-danger">*</span></label>
                            <div class="col-sm-4">
                                <input name="check_out" autocomplete="off" required class="datepickers form-control" type="text"
                                    placeholder="Check Out Date" id="check_out" value="{{ $booking->check_out }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="adults" class="col-sm-2 col-form-label">Adults <span class="text-danger">*</span></label>
                            <div class="col-sm-4">
                                <input name="adults" autocomplete="off" required class="form-control" type="number"
                                    placeholder="Number of Adults" id="adults" min="1" value="{{ $booking->adults }}">
                            </div>
                            <label for="children" class="col-sm-2 col-form-label">Children</label>
                            <div class="col-sm-4">
                                <input name="children" autocomplete="off" class="form-control" type="number"
                                    placeholder="Number of Children" id="children" min="0" value="{{ $booking->children}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rooms" class="col-sm-2 col-form-label">Rooms <span class="text-danger">*</span></label>
                            <div class="col-sm-4">
                                <input name="rooms" autocomplete="off" required class="form-control" type="number"
                                    placeholder="Number of Rooms" id="rooms" min="1" value="{{ $booking->rooms }}">
                            </div>
                            <label for="assign" class="col-sm-2 col-form-label">Room Assignment</label>
                            <div class="col-sm-4">
                                <select name="assign" id="" class="form-control">
                                    <option value="1" {{ $booking->assign == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ $booking->assign == 0 ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="arrival_time" class="col-sm-2 col-form-label">Arrival Time</label>
                            <div class="col-sm-4">
                                <input name="arrival_time" autocomplete="off" class="form-control" type="text"
                                    placeholder="Expected Arrival Time" id="arrival_time" value="{{ $booking->arrival_time }}">
                            </div>
                            <label for="paid_amount" class="col-sm-2 col-form-label">Paid Amount</label>
                            <div class="col-sm-4">
                                <input name="paid_amount" autocomplete="off" class="form-control" type="number" step="0.01"
                                    placeholder="Amount Paid" id="paid_amount" value="{{ $booking->paid_amount }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="expires_at" class="col-sm-2 col-form-label">Booking Expires At</label>
                            <div class="col-sm-4">
                                <input name="expires_at" autocomplete="off" class="datepickers form-control" type="text"
                                    placeholder="Expiration Date" id="expires_at" value="{{ $booking->expires_at }}">
                            </div>
                            <label for="payment_status" class="col-sm-2 col-form-label">Payment Status</label>
                            <div class="col-sm-4">
                                <select name="payment_status" class="form-control" id="payment_status">
                                    <option value="">Select Payment Status</option>
                                    <option value="payment_status" selected>payment_status</option>
                                    <option value="0"  {{ $booking->payment_status == 0 ? 'selected' : ''}}>Pending</option>
                                    <option value="1" {{ $booking->payment_status == 1 ? 'selected' : ''}}>Paid</option>
                                    {{-- <option value="partial">Partially Paid</option>
                                    <option value="refunded">Refunded</option> --}}
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="booking_number" class="col-sm-2 col-form-label">Booking Number</label>
                            <div class="col-sm-4">
                                <input name="booking_number" autocomplete="off" class="form-control" type="text"
                                    placeholder="Auto-generated" id="booking_number" value="{{ $booking->booking_number }}" readonly>
                            </div>
                            <label for="qrcode" class="col-sm-2 col-form-label">QR Code</label>
                            <div class="col-sm-4">
                                <img src="{{ $booking->qrcode }}" alt="">
                            </div>
                        </div>
                        
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-success w-lg m-b-5">Update Booking</button>
                        </div>
                    </form>          
                </div>
            </div>
        </div>
    </div>
@endsection