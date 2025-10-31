@extends('layouts.master')

@section('title', 'Add Family & Friend')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Family & Friend</h1>
        <a href="{{ route('admin.family-friends.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Customer Information</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.family-friends.store') }}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label for="name">Full Name <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   placeholder="customer@example.com">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Used to match registered customers</small>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" 
                                   class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" 
                                   name="phone" 
                                   value="{{ old('phone') }}" 
                                   placeholder="+234 XXX XXX XXXX">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Used to match registered customers</small>
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            <strong>Note:</strong> Provide at least one contact method (email or phone). 
                            When this customer registers, they will automatically receive a 60% discount code.
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save Entry
                            </button>
                            <a href="{{ route('admin.family-friends.index') }}" class="btn btn-secondary">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">About Family & Friends</h6>
                </div>
                <div class="card-body">
                    <h6 class="font-weight-bold">Discount Benefits:</h6>
                    <ul>
                        <li>60% discount on bookings</li>
                        <li>Usable once per week</li>
                        <li>Automatically assigned on registration</li>
                        <li>Personal and non-transferable</li>
                    </ul>
                    
                    <hr>
                    
                    <h6 class="font-weight-bold">How it works:</h6>
                    <ol>
                        <li>Add customer details here</li>
                        <li>Customer registers with matching email/phone</li>
                        <li>System generates unique discount code</li>
                        <li>Customer sees code on their dashboard</li>
                        <li>Code can be used during booking</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
