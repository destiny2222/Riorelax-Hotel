@extends('layouts.master')
@section('content')
<div class="row" id="guest_users">
    <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>
                    <i class="ti-id-badge"></i> Guest Users
                </h4>
                <div>
                    <a href="{{ route('admin.customer.index') }}" class="btn btn-primary btn-sm">
                        <i class="ti-user"></i> View Registered Users
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="ti-info-alt"></i> 
                    <strong>About Guest Users:</strong> These are temporary accounts created when customers make bookings without registering. They do not have passwords or access to wallet points and discount features.
                </div>

                <div class="table-responsive">
                    <table width="100%" class="datatable table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Total Bookings</th>
                                <th>Created Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($guestUsers as $user)
                                <tr>
                                    <td>{{ ($guestUsers->currentPage() - 1) * $guestUsers->perPage() + $loop->index + 1 }}</td>
                                    <td>
                                        {{ $user->first_name }} {{ $user->last_name }}
                                        <span class="badge badge-warning ml-2">GUEST</span>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge badge-primary">
                                            {{ $user->bookings->count() }} booking(s)
                                        </span>
                                    </td>
                                    <td>{{ $user->created_at->format('M d, Y H:i') }}</td>
                                    <td class="center">
                                        <a href="{{ route('admin.customer.edit', $user->id) }}" 
                                           class="btn btn-info btn-sm" 
                                           data-toggle="tooltip" 
                                           title="Edit Guest">
                                            <i class="ti-pencil-alt text-white"></i>
                                        </a>
                                        <form action="{{ route('admin.customer.destroy', $user->id) }}" 
                                              id="delete-form-{{ $user->id }}" 
                                              method="POST" 
                                              style="display: inline-block;"
                                              onsubmit="return confirm('Are you sure you want to delete this guest user and all their bookings?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-danger btn-sm" 
                                                    data-toggle="tooltip" 
                                                    title="Delete">
                                                <i class="ti-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No guest users found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                @if($guestUsers->hasPages())
                    <div class="d-flex justify-content-center mt-3">
                        {{ $guestUsers->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize DataTables
        $('.datatable').DataTable({
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
