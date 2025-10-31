@extends('layouts.master')

@section('title', 'Create New Role')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create New Role</h1>
        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Roles
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Role Information</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.roles.store') }}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label for="name" class="form-label">Role Name <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   placeholder="Enter role name (e.g., manager, accountant)"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                Role name will be automatically formatted (spaces become hyphens, lowercase).
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="guard_name" class="form-label">Guard <span class="text-danger">*</span></label>
                            <select class="form-control @error('name') is-invalid @enderror" 
                                    id="name" 
                                    name="name" 
                                    required>
                                <option value="">Select Guard</option>
                                <option value="admin" {{ old('name') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="web" {{ old('name') == 'web' ? 'selected' : '' }}>Web (User)</option>
                            </select>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                Select the guard type this role belongs to.
                            </small>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Permissions <span class="text-danger">*</span></label>
                            @error('permissions')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                            
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>Select Permissions</span>
                                        {{-- <div>
                                            <button type="button" class="btn btn-sm btn-outline-primary" id="selectAll">
                                                Select All
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-secondary" id="deselectAll">
                                                Deselect All
                                            </button>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                                    @if($permissions->isEmpty())
                                        <p class="text-muted">No permissions available.</p>
                                    @else
                                        @php
                                            $groupedPermissions = $permissions->groupBy(function($permission) {
                                                $parts = explode(' ', $permission->name);
                                                return $parts[count($parts) - 1] ?? 'other';
                                            });
                                        @endphp
                                        
                                        @foreach($groupedPermissions as $group => $groupPermissions)
                                            <div class="permission-group mb-3">
                                                <h6 class="text-primary mb-2">
                                                    <i class="fas fa-folder"></i> {{ ucfirst($group) }} Permissions
                                                    <button type="button" 
                                                            class="btn btn-sm btn-link group-toggle" 
                                                            data-group="{{ $group }}">
                                                        Toggle All
                                                    </button>
                                                </h6>
                                                <div class="row">
                                                    @foreach($groupPermissions as $permission)
                                                        <div class="col-md-6 mb-2">
                                                            <div class="form-check">
                                                                <input type="checkbox" 
                                                                       class="form-check-input permission-checkbox" 
                                                                       name="permissions[]" 
                                                                       value="{{ $permission->id }}" 
                                                                       id="permission_{{ $permission->id }}"
                                                                       data-group="{{ $group }}"
                                                                       {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="permission_{{ $permission->id }}">
                                                                    {{ $permission->name }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <hr>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Create Role
                            </button>
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">
                        <i class="fas fa-info-circle"></i> Role Management Guide
                    </h6>
                </div>
                <div class="card-body">
                    <h6>Creating Custom Roles</h6>
                    <ul class="small">
                        <li>Role names are automatically formatted (lowercase, spaces become hyphens)</li>
                        <li>System roles (super-admin, supervisor, front-desk) cannot be modified</li>
                        <li>Choose appropriate permissions for the role's responsibilities</li>
                        <li>Admin guard is for staff members, Web guard is for customers</li>
                    </ul>

                    <h6 class="mt-3">Permission Groups</h6>
                    <ul class="small">
                        <li><strong>Bookings:</strong> Manage customer bookings and reservations</li>
                        <li><strong>Rooms:</strong> Manage room listings and availability</li>
                        <li><strong>Customers:</strong> Manage customer accounts and data</li>
                        <li><strong>Amenities:</strong> Manage room amenities</li>
                        <li><strong>Admins:</strong> Manage admin accounts (restricted)</li>
                    </ul>

                    <h6 class="mt-3">Best Practices</h6>
                    <ul class="small">
                        <li>Grant only necessary permissions</li>
                        <li>Use descriptive role names</li>
                        <li>Test roles before assigning to users</li>
                        <li>Regularly review role permissions</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Select All permissions
        $('#selectAll').click(function() {
            $('.permission-checkbox').prop('checked', true);
        });

        // Deselect All permissions
        $('#deselectAll').click(function() {
            $('.permission-checkbox').prop('checked', false);
        });

        // Group toggle functionality
        $('.group-toggle').click(function() {
            const group = $(this).data('group');
            const groupCheckboxes = $(`.permission-checkbox[data-group="${group}"]`);
            const allChecked = groupCheckboxes.length === groupCheckboxes.filter(':checked').length;
            
            groupCheckboxes.prop('checked', !allChecked);
        });

        // Form validation
        $('form').submit(function(e) {
            const checkedPermissions = $('.permission-checkbox:checked').length;
            if (checkedPermissions === 0) {
                e.preventDefault();
                alert('Please select at least one permission for this role.');
                return false;
            }
        });
    });
</script>
@endpush