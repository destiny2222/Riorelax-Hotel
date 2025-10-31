@extends('layouts.master')

@section('title', 'Edit Family & Friend')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Family & Friend</h1>
        <a href="{{ route('admin.family-friends.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Customer Information</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.family-friends.update', $familyFriend->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="name">Full Name <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $familyFriend->name) }}" 
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
                                   value="{{ old('email', $familyFriend->email) }}" 
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
                                   value="{{ old('phone', $familyFriend->phone) }}" 
                                   placeholder="+234 XXX XXX XXXX">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Used to match registered customers</small>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" 
                                       class="custom-control-input" 
                                       id="is_active" 
                                       name="is_active" 
                                       value="1"
                                       {{ old('is_active', $familyFriend->is_active) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active">
                                    Active (Customer can use discount code)
                                </label>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            <strong>Note:</strong> Provide at least one contact method (email or phone). 
                            Deactivating this entry will prevent the customer from using their discount code.
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Entry
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
                    <h6 class="m-0 font-weight-bold text-primary">Entry Details</h6>
                </div>
                <div class="card-body">
                    <p><strong>Added By:</strong> {{ $familyFriend->addedBy->name ?? 'N/A' }}</p>
                    <p><strong>Added On:</strong> {{ $familyFriend->created_at->format('M d, Y h:i A') }}</p>
                    <p><strong>Last Updated:</strong> {{ $familyFriend->updated_at->format('M d, Y h:i A') }}</p>
                    <p><strong>Current Status:</strong> 
                        @if($familyFriend->is_active)
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-secondary">Inactive</span>
                        @endif
                    </p>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-danger text-white">
                    <h6 class="m-0 font-weight-bold">Danger Zone</h6>
                </div>
                <div class="card-body">
                    <p class="text-muted">Deleting this entry is permanent and cannot be undone.</p>
                    <form action="{{ route('admin.family-friends.destroy', $familyFriend->id) }}" 
                          method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this entry? This action cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Delete Entry
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
