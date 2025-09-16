@extends('layouts.master')
@section('content')
         <!-- start page title -->
         <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 btn  waves-effect waves-light">
                       Add New Amentias
                    </h4>


                </div>
            </div>
        </div>
        <!-- end page title -->
        
        <div class="row">
            <div class="col-12">
                <!-- Amenities Table -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Room Amenities</h5>
                        <a href="{{ route('admin.amenities.create') }}" type="button" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Add Amenity
                        </a>
                    </div>
                    <div class="card-body">
                        @if($amenities->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Room</th>
                                            <th>Icon</th>
                                            <th>Title</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($amenities as $amenity)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $amenity->room->name ?? 'N/A' }}</td>
                                                <td>
                                                    <i class="{{ $amenity->icon }} fs-4 text-primary"></i>
                                                </td>
                                                <td>{{ $amenity->title }}</td>
                                                <td>
                                                    <a href="{{ route('admin.amenities.edit', $amenity->id) }}"  class="btn btn-sm btn-warning me-1">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>
                                                    
                                                    <form action="{{ route('admin.amenities.destroy', $amenity->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this amenity?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <p class="text-muted">No amenities found.</p>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
                                    <i class="fa fa-plus"></i> Add First Amenity
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->  
@endsection


