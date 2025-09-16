@extends('layouts.master') 
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Edit Customer
                    <small class="float-right">
                        <a href="{{ route('admin.customer.index') }}" class="btn btn-primary btn-md">
                            <i class="ti-arrow-left" aria-hidden="true"></i>
                            Back
                        </a>
                    </small>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.customer.update', $user->id) }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    @csrf
                    @method('PUT')

                    <div class="form-group row">
                        <label for="first_name" class="col-sm-2 col-form-label">First Name <span class="text-danger">*</span></label>
                        <div class="col-sm-4">
                            <input name="first_name" value="{{ old('first_name', $user->first_name) }}" autocomplete="off" required class="form-control" type="text" placeholder="First Name" id="first_name">
                        </div>

                        <label for="last_name" class="col-sm-2 col-form-label">Last Name <span class="text-danger">*</span></label>
                        <div class="col-sm-4">
                            <input name="last_name" value="{{ old('last_name', $user->last_name) }}" required autocomplete="off" class="form-control" type="text" placeholder="Last Name" id="last_name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email<span class="text-danger">*</span></label>
                        <div class="col-sm-4">
                            <input name="email" value="{{ old('email', $user->email) }}" autocomplete="off" required class="form-control" type="email" placeholder="Email" id="email">
                        </div>

                        <label for="phone" class="col-sm-2 col-form-label">Phone <span class="text-danger">*</span></label>
                        <div class="col-sm-4">
                            <input name="phone" value="{{ old('phone', $user->phone) }}" autocomplete="off" required class="form-control" type="text" placeholder="Phone" id="phone">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="dob" class="col-sm-2 col-form-label">Date of Birth</label>
                        <div class="col-sm-4">
                            <input name="dob" value="{{ old('dob', $user->dob) }}" autocomplete="off" class="datepickers form-control" type="date" id="dob">
                        </div>

                        <label for="wallets" class="col-sm-2 col-form-label">Wallet Balance</label>
                        <div class="col-sm-4">
                            <input name="wallets" value="{{ old('wallets', $user->wallets) }}" autocomplete="off" class="form-control" type="number" step="0.01" id="wallets">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="city" class="col-sm-2 col-form-label">City</label>
                        <div class="col-sm-4">
                            <input name="city" value="{{ old('city', $user->city) }}" autocomplete="off" class="form-control" type="text" placeholder="City" id="city">
                        </div>

                        <label for="state" class="col-sm-2 col-form-label">State</label>
                        <div class="col-sm-4">
                            <input name="state" value="{{ old('state', $user->state) }}" autocomplete="off" class="form-control" type="text" placeholder="State" id="state">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="country" class="col-sm-2 col-form-label">Country</label>
                        <div class="col-sm-4">
                            <input name="country" value="{{ old('country', $user->country) }}" autocomplete="off" class="form-control" type="text" placeholder="Country" id="country">
                        </div>

                        <label for="zip" class="col-sm-2 col-form-label">Zip</label>
                        <div class="col-sm-4">
                            <input name="zip" value="{{ old('zip', $user->zip) }}" autocomplete="off" class="form-control" type="text" placeholder="Zip" id="zip">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                            <textarea name="address" cols="30" rows="3" autocomplete="off" class="form-control" placeholder="Address">{{ old('address', $user->address) }}</textarea>
                        </div>
                    </div>

                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-success w-md m-b-5">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
