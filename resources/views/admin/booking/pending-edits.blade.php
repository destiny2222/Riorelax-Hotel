@extends('layouts.master')

@section('title', 'Pending Booking Edits')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pending Booking Edit Requests</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Requests Awaiting Approval</h6>
        </div>
        <div class="card-body">
            @if($editRequests->isEmpty())
                <div class="text-center">
                    <p>No pending edit requests at the moment.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Booking ID</th>
                                <th>Room</th>
                                <th>Requested By</th>
                                <th>Original Data</th>
                                <th>Requested Changes</th>
                                {{-- <th>Notes</th> --}}
                                <th>Requested At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($editRequests as $request)
                                <tr>
                                    <td>{{ $request->id }}</td>
                                    <td>
                                        <a href="{{ route('admin.booking.show', $request->booking_id) }}">
                                            {{ $request->booking_id }}
                                        </a>
                                    </td>
                                    <td>{{ $request->booking->roomListing->room_title ?? 'N/A' }}</td>
                                    <td>{{ $request->requestedBy->name ?? 'N/A' }}</td>
                                    <td>
                                        <ul>
                                            @foreach($request->original_data as $field => $value)
                                                <li><strong>{{ ucfirst(str_replace('_', ' ', $field)) }}:</strong> {{ $value }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach($request->requested_changes as $field => $value)
                                                <li><strong>{{ ucfirst(str_replace('_', ' ', $field)) }}:</strong> <span class="text-danger">{{ $value }}</span></li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    {{-- <td>{{ $request->notes }}</td> --}}
                                    <td>{{ $request->created_at->format('d M Y, H:i') }}</td>
                                    <td>
                                        <form action="{{ route('admin.booking.edit-request.approve', $request->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success btn-sm mb-1">Approve</button>
                                        </form>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#rejectModal-{{ $request->id }}">
                                            Reject
                                        </button>
                                    </td>
                                </tr>

                                <!-- Reject Modal -->
                                <div class="modal fade" id="rejectModal-{{ $request->id }}" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel-{{ $request->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.booking.edit-request.reject', $request->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="rejectModalLabel-{{ $request->id }}">Reject Edit Request</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="rejection_reason">Reason for Rejection</label>
                                                        <textarea class="form-control" name="rejection_reason" rows="3" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Confirm Rejection</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $editRequests->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
