@extends('layouts.master')

@section('title', 'Role Details')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Role Details: {{ ucwords(str_replace('-', ' ', $role->name)) }}</h1>
        <div>
            @if(!in_array($role->name, ['super-admin', 'supervisor', 'front-desk']))
                <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit Role
                </a>
            @endif
            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Roles
            </a>
        </div>
    </div>

    @if(in_array($role->name, ['super-admin', 'supervisor', 'front-desk']))
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i>
            <strong>System Role:</strong> This is a system role that is essential for application functionality.
        </div>
    @endif

    <div class="row">
        <!-- Role Information -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Role Information</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label font-weight-bold">Role Name:</label>
                                <p class="form-control-plaintext">
                                    {{ ucwords(str_replace('-', ' ', $role->name)) }}
                                    @if(in_array($role->name, ['super-admin', 'supervisor', 'front-desk']))
                                        <span class="badge badge-info ml-2">System Role</span>
                                    @else
                                        <span class="badge badge-success ml-2">Custom Role</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label font-weight-bold">Guard:</label>
                                <p class="form-control-plaintext">
                                    <span class="badge badge-secondary">{{ $role->name }}</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label font-weight-bold">Created:</label>
                                <p class="form-control-plaintext">{{ $role->created_at->format('M d, Y \a\t g:i A') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label font-weight-bold">Last Updated:</label>
                                <p class="form-control-plaintext">{{ $role->updated_at->format('M d, Y \a\t g:i A') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Permissions -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Assigned Permissions ({{ $role->permissions->count() }})
                    </h6>
                </div>
                <div class="card-body">
                    @if($role->permissions->count() > 0)
                        @php
                            $groupedPermissions = $role->permissions->groupBy(function($permission) {
                                $parts = explode(' ', $permission->name);
                                return $parts[count($parts) - 1] ?? 'other';
                            });
                        @endphp
                        
                        @foreach($groupedPermissions as $group => $groupPermissions)
                            <div class="permission-group mb-4">
                                <h6 class="text-primary mb-3">
                                    <i class="fas fa-folder"></i> {{ ucfirst($group) }} Permissions
                                    <span class="badge badge-light ml-2">{{ $groupPermissions->count() }}</span>
                                </h6>
                                <div class="row">
                                    @foreach($groupPermissions as $permission)
                                        <div class="col-md-6 mb-2">
                                            <span class="badge badge-success mr-1">
                                                <i class="fas fa-check"></i> {{ $permission->name }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @if(!$loop->last)
                                <hr>
                            @endif
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-exclamation-circle text-muted" style="font-size: 48px;"></i>
                            <p class="text-muted mt-3">No permissions assigned to this role.</p>
                            @if(!in_array($role->name, ['super-admin', 'supervisor', 'front-desk']))
                                <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Add Permissions
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <!-- Users with this Role -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Users with this Role {{ $role->admins ? $role->admins->count() : 0 }}
                    </h6>
                </div>
                <div class="card-body">
                    @if($role->admins->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Joined</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($role->admins as $user)
                                        <tr>
                                            <td>{{ $user->name ?? 'N/A' }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                                            <td>
                                                @if($user->email_verified_at)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-warning">Pending Verification</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-users text-muted" style="font-size: 48px;"></i>
                            <p class="text-muted mt-3">No users assigned to this role yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Role Statistics -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">
                        <i class="fas fa-chart-bar"></i> Role Statistics
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6 mb-3">
                            <div class="border-right">
                                <div class="h5 font-weight-bold text-primary">{{ $role->permissions->count() }}</div>
                                <div class="small text-muted">Permissions</div>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="h5 font-weight-bold text-success">{{ $role->admins->count() }}</div>
                            <div class="small text-muted">Users</div>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="small">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Role Type:</span>
                            <span>
                                @if(in_array($role->name, ['super-admin', 'supervisor', 'front-desk']))
                                    <span class="badge badge-info">System</span>
                                @else
                                    <span class="badge badge-success">Custom</span>
                                @endif
                            </span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Guard Type:</span>
                            <span class="badge badge-secondary">{{ $role->guard_name }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Status:</span>
                            <span class="badge badge-success">Active</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">
                        <i class="fas fa-bolt"></i> Quick Actions
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        @if(!in_array($role->name, ['super-admin', 'supervisor', 'front-desk']))
                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit Role
                            </a>
                        @endif
                        
                        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Create New Role
                        </a>
                        
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-list"></i> All Roles
                        </a>
                    </div>
                </div>
            </div>

            @if(!in_array($role->name, ['super-admin', 'supervisor', 'front-desk']))
                <!-- Danger Zone -->
                <div class="card shadow mb-4 border-danger">
                    <div class="card-header py-3 bg-danger text-white">
                        <h6 class="m-0 font-weight-bold">
                            <i class="fas fa-exclamation-triangle"></i> Danger Zone
                        </h6>
                    </div>
                    <div class="card-body">
                        <p class="small text-muted mb-3">
                            Deleting this role will remove it from all {{ $role->admins->count() }} assigned users. This action cannot be undone.
                        </p>
                        
                        @if($role->admins->count() > 0)
                            <div class="alert alert-warning small mb-3">
                                <strong>Warning:</strong> This role is currently assigned to {{ $role->admins->count() }} user(s). 
                                Consider reassigning users before deletion.
                            </div>
                        @endif
                        
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
    function confirmDelete() {
        const usersCount = {{ $role->admins->count() }};
        let message = 'Are you sure you want to delete this role?';
        
        if (usersCount > 0) {
            message += `\n\nThis will remove the role from ${usersCount} user(s) and cannot be undone.`;
        }
        
        return confirm(message);
    }
</script>
@endpush