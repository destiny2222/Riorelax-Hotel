@extends('layouts.master')

@section('title', 'Acknowledged Booking Edits')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Acknowledged Booking Edit Requests</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">History of Acknowledged Rejections</h6>
        </div>
        <div class="card-body">
            @if($acknowledgedRequests->isEmpty())
                <div class="text-center">
                    <p>No acknowledged edit requests found.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Booking ID</th>
                                <th>Requested By</th>
                                <th>Rejected By</th>
                                <th>Rejection Reason</th>
                                <th>Acknowledged By</th>
                                <th>Acknowledged At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($acknowledgedRequests as $request)
                                <tr>
                                    <td>{{ $request->id }}</td>
                                    <td>
                                        <a href="{{ route('admin.booking.show', $request->booking_id) }}">
                                            {{ $request->booking_id }}
                                        </a>
                                    </td>
                                    <td>{{ $request->requestedBy->name ?? 'N/A' }}</td>
                                    <td>{{ $request->approvedBy->name ?? 'N/A' }}</td>
                                    <td>{{ $request->rejection_reason }}</td>
                                    <td>{{ $request->requestedBy->name ?? 'N/A' }}</td>
                                    <td>{{ $request->acknowledged_at ? $request->acknowledged_at->format('d M Y, H:i') : 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $acknowledgedRequests->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
