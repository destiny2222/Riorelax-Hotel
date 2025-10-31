@extends('layouts.master')
@section('content')
<div class="row" id="customer_list">
    <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-header">
                <h4>Customer Management</h4>
            </div>
            <div class="card-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#registered-users" role="tab">
                            <i class="ti-user"></i> Registered Users
                            <span class="badge badge-primary">{{ $registeredUsers->count() }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#guest-users" role="tab">
                            <i class="ti-id-badge"></i> Guest Users
                            <span class="badge badge-secondary">{{ $guestUsers->count() }}</span>
                        </a>
                    </li>
                </ul>

                <!-- Tab content -->
                <div class="tab-content mt-3">
                    <!-- Registered Users Tab -->
                    <div class="tab-pane active" id="registered-users" role="tabpanel">
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
                                            <td>{{ $loop->index + 1 }}</td>
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
                                                    <span class="badge badge-info" title="Family & Friends">
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
                    </div>

                    <!-- Guest Users Tab -->
                    <div class="tab-pane" id="guest-users" role="tabpanel">
                        <div class="alert alert-info">
                            <i class="ti-info"></i> <strong>Guest Users:</strong> These are customers who made bookings without creating an account. They have limited profile information.
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
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($guestUsers as $user)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>
                                                <span class="badge badge-secondary">GUEST</span>
                                                {{ $user->first_name }} {{ $user->last_name }}
                                            </td>
                                            <td>
                                                <small class="text-muted">{{ $user->email }}</small>
                                            </td>
                                            <td>{{ $user->phone ?? 'N/A' }}</td>
                                            <td>
                                                <span class="badge badge-primary">
                                                    {{ $user->bookings ? $user->bookings->count() : 0 }}
                                                </span>
                                            </td>
                                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                                            <td class="center">
                                                <a href="{{ route('admin.customer.edit', $user->id) }}" 
                                                   class="btn btn-info btn-sm" 
                                                   data-toggle="tooltip" 
                                                   title="View Details">
                                                    <i class="ti-eye text-white"></i>
                                                </a>
                                                <form action="{{ route('admin.customer.destroy', $user->id) }}" 
                                                      id="delete-guest-form-{{ $user->id }}" 
                                                      method="POST" 
                                                      style="display: inline-block;"
                                                      onsubmit="return confirm('Are you sure you want to delete this guest user?');">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize DataTables for both tables
        $('.datatable').DataTable({
            "pageLength": 10,
            "ordering": true,
            "searching": true,
            "responsive": true
        });
        
        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endpush