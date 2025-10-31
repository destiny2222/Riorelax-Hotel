@extends('layouts.master')
@section('content')
<div class="row" id="registered_users">
    <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>
                    <i class="ti-user"></i> Registered Users
                </h4>
                <div>
                    <a href="{{ route('admin.customer.guests') }}" class="btn btn-secondary btn-sm">
                        <i class="ti-id-badge"></i> View Guest Users
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table width="100%" class="datatable table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Wallet Points</th>
                                <th>Discount Code</th>
                                <th>Registered</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($registeredUsers as $user)
                                <tr>
                                    <td>{{ ($registeredUsers->currentPage() - 1) * $registeredUsers->perPage() + $loop->index + 1 }}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge badge-success">
                                            ₦{{ number_format($user->wallet_points ?? 0, 2) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($user->discountCode)
                                            <span class="badge badge-info" title="Family & Friends Discount">
                                                {{ $user->discountCode->code }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                                    <td class="center">
                                        <a href="{{ route('admin.customer.edit', $user->id) }}" 
                                           class="btn btn-info btn-sm" 
                                           data-toggle="tooltip" 
                                           title="Edit Customer">
                                            <i class="ti-pencil-alt text-white"></i>
                                        </a>
                                        <form action="{{ route('admin.customer.destroy', $user->id) }}" 
                                              id="delete-form-{{ $user->id }}" 
                                              method="POST" 
                                              style="display: inline-block;"
                                              onsubmit="return confirm('Are you sure you want to delete this customer?');">
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
                                    <td colspan="9" class="text-center">No registered users found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                @if($registeredUsers->hasPages())
                    <div class="d-flex justify-content-center mt-3">
                        {{ $registeredUsers->links() }}
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
