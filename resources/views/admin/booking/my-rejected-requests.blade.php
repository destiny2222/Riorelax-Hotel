@extends('layouts.master')

@section('title', 'My Rejected Booking Edits')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">My Rejected Booking Edit Requests</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Rejected Requests</h6>
        </div>
        <div class="card-body">
            @if($rejectedRequests->isEmpty())
                <div class="text-center">
                    <p>You have no rejected edit requests.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Booking ID</th>
                                <th>Room</th>
                                <th>Rejected By</th>
                                <th>Rejection Reason</th>
                                <th>Rejected At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rejectedRequests as $request)
                                <tr>
                                    <td>{{ $request->id }}</td>
                                    <td>
                                        <a href="{{ route('admin.booking.show', $request->booking_id) }}">
                                            {{ $request->booking_id }}
                                        </a>
                                    </td>
                                    <td>{{ $request->booking->roomListing->room_title ?? 'N/A' }}</td>
                                    <td>{{ $request->approvedBy->name ?? 'N/A' }}</td>
                                    <td class="text-danger">{{ $request->rejection_reason }}</td>
                                    <td>{{ $request->approved_at ? $request->approved_at->format('d M Y, H:i') : 'N/A' }}</td>
                                    <td>
                                        <form action="{{ route('admin.booking.edit-request.acknowledge', $request->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-info btn-sm">Acknowledge</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $rejectedRequests->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
