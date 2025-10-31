@extends('layouts.master')
@section('content')
    <!-- load custom page -->
    <div class="card">
        <div class="card-header">
            <h4>
                Room List 
                <small class="float-right">
                    <a href="{{ route('admin.roomListing.create') }}" class="btn btn-primary btn-md mb-2"><i class="ti-plus" aria-hidden="true"></i>
                        Add New
                    </a>
                </small>
            </h4>
        </div>
        <div class="row">
            <!--  table area -->
            <div class="col-sm-12">

                <div class="card-body">
                    <div class="table-responsive">
                        <table width="100%" id="exdatatable"
                            class="datatable table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Room Name</th>
                                    <th>Room Type</th>
                                    <th>Room Number</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>Images</th>
                                    <th>Availability</th>
                                    <th>Description</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roomListings as $roomListing)
                                    <tr class="odd gradeX">
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $roomListing->room_title }}</td>
                                    <td>{{ $roomListing->room_type }}</td>
                                    <td>{{ $roomListing->room_number }}</td>
                                    <td>{{ $roomListing->price }}</td>
                                    <td><img src="{{ $roomListing->room_image }}" alt="" width="50px" height="50px"></td>
                                    <td>
                                       <div class="d-flex ">
                                            @foreach ($roomListing->room_images as $image)
                                                <img src="{{ $image }}" alt="" width="50px" height="50px">
                                            @endforeach
                                       </div>

                                    </td>
                                    <td>
                                        @if($roomListing->availability_status == 'available')
                                            <span class="badge bg-success p-2 text-white" style="font-size: 15px;">{{ $roomListing->availability_status }}</span>
                                        @else
                                            <span class="badge bg-info p-2 text-white" style="font-size: 15px;">{{ $roomListing->availability_status }}</span>
                                        @endif
                                    </td>
                                    <td>{!! $roomListing->description !!} </td>
                                    <td class="center">
                                        <a href="{{ route('admin.roomListing.edit', $roomListing->id) }}" class="btn btn-info btn-sm" title="Update">
                                            <i class="ti-pencil-alt text-white" aria-hidden="true"></i>
                                        </a>
                                        <a href="javascript:void()" onclick="return confirm('Are you sure ?')  event.preventDefault(); document.getElementById('delete-form-{{ $roomListing->id }}').submit();" class="btn btn-danger btn-sm" title="Delete ">
                                            <i  class="ti-trash"></i>
                                        </a>
                                        <form action="{{ route('admin.roomListing.destroy', $roomListing->id) }}" class="d-none" id="delete-form-{{ $roomListing->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table> <!-- /.table-responsive -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
