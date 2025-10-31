@extends('layouts.master')
@section('content')
<div id="newreservation">
    <div id="reservation">
        <form method="POST" action="{{ route('admin.bookings.store') }}">
            @csrf
            <div class="card mb-4">
                <div class="card-header py-2 ">
                    <h6 class="fs-17 font-weight-600 mb-0">
                        Reservation Details <span id="msg" class="red-message"></span>
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                            <label class="font-weight-600 mb-1">Room <span class="text-danger">*</span></label>
                            <select name="room_id" id="room_id" class="form-control">
                                <option value="">Select Room</option>
                                @foreach($rooms as $room)
                                <option value="{{$room->id}}">{{$room->room_title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                            <div class="form-group mb-0">
                                <label class="font-weight-600 mb-1">Adults</label>
                                <div class="icon-addon addon-md">
                                    <input type="number" name="adults" class="form-control" placeholder="Adults" value="1">
                                    <label class="fas fa-user"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                            <div class="form-group mb-0">
                                <label class="font-weight-600 mb-1">Rooms</label>
                                <div class="icon-addon addon-md">
                                    <input type="number" name="rooms" class="form-control" placeholder="Rooms" value="1">
                                    <label class="fas fa-user"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                            <div class="form-group mb-0">
                                <label class="font-weight-600 mb-1">Children</label>
                                <div class="icon-addon addon-md">
                                    <input type="number" name="children" class="form-control" placeholder="Children" value="0">
                                    <label class="fas fa-child"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                            <div class="form-group mb-0">
                                <label class="font-weight-600 mb-1">Check In <span class="text-danger">*</span></label>
                                <div class="icon-addon addon-md">
                                    <input type="date" name="check_in" class="form-control datefilter" id="datefilter1"
                                        placeholder="mm/dd/yyyy --:-- --" value="">
                                    <label class="fas fa-calendar-alt"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                            <div class="form-group mb-0">
                                <label class="font-weight-600 mb-1">Check Out<span class="text-danger">*</span></label>
                                <div class="icon-addon addon-md">
                                    <input type="date" name="check_out" class="form-control datefilter" id="datefilter2"
                                        placeholder="mm/dd/yyyy --:-- --" value="">
                                    <label class="fas fa-calendar-alt"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                            <div class="form-group mb-0">
                                <label class="font-weight-600 mb-1">Arrival Time</label>
                                <div class="icon-addon addon-md">
                                    <input type="text" class="form-control" name="arrival_time" placeholder="Arrival Time">
                                    <label class="fas fa-plane-arrival"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header py-2 ">
                    <h6 class="fs-17 font-weight-600 mb-0">
                        Guest Details
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label class="font-weight-600 mb-1">First Name</label>
                            <input type="text" class="form-control" name="first_name" placeholder="First Name">
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="font-weight-600 mb-1">Last Name</label>
                            <input type="text" class="form-control" name="last_name" placeholder="Last Name">
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="font-weight-600 mb-1">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Email">
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="font-weight-600 mb-1">Phone</label>
                            <input type="text" class="form-control" name="phone" placeholder="Phone">
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="font-weight-600 mb-1">Country</label>
                            <input type="text" class="form-control" name="country" placeholder="Country">
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="font-weight-600 mb-1">State</label>
                            <input type="text" class="form-control" name="state" placeholder="State">
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="font-weight-600 mb-1">City</label>
                            <input type="text" class="form-control" name="city" placeholder="City">
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="font-weight-600 mb-1">Zip Code</label>
                            <input type="text" class="form-control" name="zip_code" placeholder="Zip Code">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="font-weight-600 mb-1">Address</label>
                            <textarea class="form-control" name="address" rows="3" placeholder="Address"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary w-100p">Save</button>
            </div>
        </form>
    </div>
</div>

@endsection
