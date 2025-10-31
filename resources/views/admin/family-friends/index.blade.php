@extends('layouts.master')

@section('title', 'Family & Friends List')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Family & Friends List</h1>
        <div>
            @if(Auth::guard('admin')->user()->hasRole('super-admin'))
                <form action="{{ route('admin.family-friends.generate-codes') }}" method="POST" style="display: inline-block;" onsubmit="return confirm('This will generate discount codes for all existing users who are in the Family & Friends list but don\'t have codes yet. Continue?');">
                    @csrf
                    <button type="submit" class="btn btn-warning mr-2">
                        <i class="fas fa-sync"></i> Generate Codes for Existing Users
                    </button>
                </form>
            @endif
            <a href="{{ route('admin.family-friends.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Family & Friends</h6>
        </div>
        <div class="card-body">
            @if($familyAndFriends->isEmpty())
                <div class="text-center py-5">
                    <p class="text-muted">No family and friends added yet.</p>
                    <a href="{{ route('admin.family-friends.create') }}" class="btn btn-primary">Add Your First Entry</a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Added By</th>
                                <th>Status</th>
                                <th>Added At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($familyAndFriends as $entry)
                                <tr>
                                    <td>{{ $entry->id }}</td>
                                    <td>{{ $entry->name }}</td>
                                    <td>{{ $entry->email ?? 'N/A' }}</td>
                                    <td>{{ $entry->phone ?? 'N/A' }}</td>
                                    <td>{{ $entry->addedBy->name ?? 'N/A' }}</td>
                                    <td>
                                        @if($entry->is_active)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ $entry->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.family-friends.edit', $entry->id) }}" 
                                           class="btn btn-sm btn-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.family-friends.destroy', $entry->id) }}" 
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this entry?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    {{ $familyAndFriends->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
