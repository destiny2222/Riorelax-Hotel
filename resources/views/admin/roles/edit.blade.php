@extends('layouts.master')

@section('title', 'Edit Role')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Role: {{ ucwords(str_replace('-', ' ', $role->name)) }}</h1>
        <div>
            <a href="{{ route('admin.roles.show', $role->id) }}" class="btn btn-info">
                <i class="fas fa-eye"></i> View Details
            </a>
            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Roles
            </a>
        </div>
    </div>

    @if(in_array($role->name, ['super-admin', 'supervisor', 'front-desk']))
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle"></i>
            <strong>System Role:</strong> This is a system role and cannot be modified. System roles are protected to maintain application security.
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Role Information</h6>
                </div>
                <div class="card-body">
                    @if(!in_array($role->name, ['super-admin', 'supervisor', 'front-desk']))
                        <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="form-group">
                                <label for="name" class="form-label">Role Name <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', str_replace('-', ' ', $role->name)) }}" 
                                       placeholder="Enter role name"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    Role name will be automatically formatted (spaces become hyphens, lowercase).
                                </small>
                            </div>

                            <div class="form-group">
                                <label for="guard_name" class="form-label">Guard</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="guard_name" 
                                       value="{{ $role->name }}" 
                                       readonly>
                                <small class="form-text text-muted">
                                    Guard cannot be changed after role creation.
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
                                            <div>
                                                <button type="button" class="btn btn-sm btn-outline-primary" id="selectAll">
                                                    Select All
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-secondary" id="deselectAll">
                                                    Deselect All
                                                </button>
                                            </div>
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
                                                $rolePermissionIds = $role->permissions->pluck('id')->toArray();
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
                                                                           {{ in_array($permission->id, old('permissions', $rolePermissionIds)) ? 'checked' : '' }}>
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
                                    <i class="fas fa-save"></i> Update Role
                                </button>
                                <a href="{{ route('admin.roles.show', $role->id) }}" class="btn btn-info">
                                    <i class="fas fa-eye"></i> View Details
                                </a>
                                <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                            </div>
                        </form>
                    @else
                        <div class="form-group">
                            <label class="form-label">Role Name</label>
                            <input type="text" class="form-control" value="{{ ucwords(str_replace('-', ' ', $role->name)) }}" readonly>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Guard</label>
                            <input type="text" class="form-control" value="{{ $role->guard_name }}" readonly>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Permissions</label>
                            <div class="card">
                                <div class="card-body">
                                    @if($role->permissions->count() > 0)
                                        @foreach($role->permissions as $permission)
                                            <span class="badge badge-light mr-1 mb-1">{{ $permission->name }}</span>
                                        @endforeach
                                    @else
                                        <p class="text-muted mb-0">No permissions assigned.</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <a href="{{ route('admin.roles.show', $role->id) }}" class="btn btn-info">
                                <i class="fas fa-eye"></i> View Details
                            </a>
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Roles
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">
                        <i class="fas fa-info-circle"></i> Role Details
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <strong>Created:</strong><br>
                            <span class="text-muted">{{ $role->created_at->format('M d, Y \a\t g:i A') }}</span>
                        </div>
                        <div class="col-12 mb-3">
                            <strong>Last Updated:</strong><br>
                            <span class="text-muted">{{ $role->updated_at->format('M d, Y \a\t g:i A') }}</span>
                        </div>
                        <div class="col-12 mb-3">
                            <strong>Users with this Role:</strong><br>
                            <span class="badge badge-primary">{{ $role->admins->count() }} users</span>
                        </div>
                        <div class="col-12 mb-3">
                            <strong>Total Permissions:</strong><br>
                            <span class="badge badge-success">{{ $role->permissions->count() }} permissions</span>
                        </div>
                    </div>

                    @if($role->admins->count() > 0)
                        <hr>
                        <h6>Users with this Role:</h6>
                        <ul class="list-unstyled small">
                            @foreach($role->admins->take(5) as $user)
                                <li>• {{ $user->name ?? $user->email }}</li>
                            @endforeach
                            @if($role->admins->count() > 5)
                                <li class="text-muted">... and {{ $role->admins->count() - 5 }} more</li>
                            @endif
                        </ul>
                    @endif
                </div>
            </div>

            @if(!in_array($role->name, ['super-admin', 'supervisor', 'front-desk']))
                <div class="card shadow mb-4 border-danger">
                    <div class="card-header py-3 bg-danger text-white">
                        <h6 class="m-0 font-weight-bold">
                            <i class="fas fa-exclamation-triangle"></i> Danger Zone
                        </h6>
                    </div>
                    <div class="card-body">
                        <p class="small text-muted">
                            Deleting this role will remove it from all assigned users. This action cannot be undone.
                        </p>
                        <form action="{{ route('admin.roles.destroy', $role->id) }}" 
                              method="POST" 
                              onsubmit="return confirmDelete();">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> Delete Role
                            </button>
                        </form>
                    </div>
                </div>
            @endif
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
        $('form[method="POST"]').submit(function(e) {
            if ($(this).find('.permission-checkbox').length > 0) {
                const checkedPermissions = $('.permission-checkbox:checked').length;
                if (checkedPermissions === 0) {
                    e.preventDefault();
                    alert('Please select at least one permission for this role.');
                    return false;
                }
            }
        });
    });

    function confirmDelete() {
        return confirm('Are you sure you want to delete this role? This will remove the role from all assigned users and cannot be undone.');
    }
</script>
@endpush