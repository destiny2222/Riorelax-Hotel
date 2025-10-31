@extends('layouts.master')

@section('title', 'Role Management')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Role Management</h1>
        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create New Role
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Roles</h6>
        </div>
        <div class="card-body">
            @if($roles->isEmpty())
                <div class="text-center py-5">
                    <p class="text-muted">No roles found.</p>
                    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">Create Your First Role</a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Role Name</th>
                                <th>Permissions</th>
                                <th>Admins Count</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>
                                        <strong>{{ ucwords(str_replace('-', ' ', $role->name)) }}</strong>
                                        @if(in_array($role->name, ['super-admin', 'supervisor', 'front-desk']))
                                            <span class="badge badge-info ml-2">System</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($role->permissions && $role->permissions->count() > 0)
                                            <span class="badge badge-success">{{ $role->permissions->count() }} permissions</span>
                                            <button class="btn btn-sm btn-outline-info ml-1" data-toggle="collapse" data-target="#permissions-{{ $role->id }}">
                                                View
                                            </button>
                                            <div class="collapse mt-2" id="permissions-{{ $role->id }}">
                                                <div class="card card-body">
                                                    @foreach($role->permissions as $permission)
                                                        <span class="badge badge-light mr-1 mb-1">{{ $permission->name }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-muted">No permissions</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge badge-primary">{{ $role->admins ? $role->admins->count() : 0 }} admins</span>
                                    </td>
                                    <td>{{ $role->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.roles.show', $role->id) }}" 
                                               class="btn btn-sm btn-info" 
                                               data-toggle="tooltip" 
                                               title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if(!in_array($role->name, ['super-admin', 'supervisor', 'front-desk']))
                                                <a href="{{ route('admin.roles.edit', $role->id) }}" 
                                                   class="btn btn-sm btn-warning" 
                                                   data-toggle="tooltip" 
                                                   title="Edit Role">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.roles.destroy', $role->id) }}" 
                                                      method="POST" 
                                                      style="display: inline-block;"
                                                      onsubmit="return confirm('Are you sure you want to delete this role?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-danger" 
                                                            data-toggle="tooltip" 
                                                            title="Delete Role">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <span class="btn btn-sm btn-secondary" data-toggle="tooltip" title="System roles cannot be modified">
                                                    <i class="fas fa-lock"></i>
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($roles->hasPages())
                    <div class="d-flex justify-content-center mt-3">
                        {{ $roles->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize DataTables
        $('#dataTable').DataTable({
            "pageLength": 10,
            "ordering": true,
            "searching": true,
            "responsive": true,
            "paging": false,
            "info": false
        });
        
        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endpush