@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add New</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.roomListing.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="roomname" class="col-sm-12">Room Name <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input name="room_title" autocomplete="off" class="form-control" type="text" placeholder="Room Name" id="roomname" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="roomtype" class="col-sm-12">Room Type <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input name="room_type" autocomplete="off" class="form-control" type="text" placeholder="Room Type" id="roomtype" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="room_number" class="col-sm-12">Room Number <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input name="room_number" autocomplete="off" class="form-control" type="number" placeholder="Room Number" id="room_number" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-sm-12">Price <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input name="price" autocomplete="off" class="form-control" type="number"   placeholder="Price" id="price" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="room_ava">Availability Status</label>
                            <select name="availability_status" id="" class="form-control">
                                <option value="available">Available</option>
                                <option value="occupied">Occupied</option>
                                <option value="under maintenance">Under Maintenance</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <label for="room_image" class="col-sm-12">Image <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="file" accept="image/*" name="room_image" id="room_image" onchange="loadFile(event)" required>
                                <a class="cattooltipsimg" data-toggle="tooltip" data-placement="top" title="Use only .jpg,.jpeg,.gif and .png Images">
                                    <i class="fa fa-question-circle" aria-hidden="true"></i>
                                </a>
                                {{-- <small id="fileHelp" class="text-muted"> 	Can update room status (e.g., available, occupied, under maintenance).
                                    <img src="https://xainhotellatest.bdtask-demo.com/assets/img/room-setting/room_images.png" id="output" class="img-thumbnail height_150_width_200px jsclrimg" required/>
                                </small>
                                <input type="hidden" name="old_image" value=""> --}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="room_images" class="col-sm-4 ">Upload Images (Multiple) <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input name="room_images[]" type="file" multiple class="form-control" id="room_images" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="roomdescription" class="col-sm-12">Room Description  <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <textarea name="description" id="description" cols="35" rows="3" class="form-control" placeholder="Room Description"></textarea>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success w-md m-b-5">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
