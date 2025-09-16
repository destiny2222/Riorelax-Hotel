@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="text-start py-3">
                {{-- <a href="javascript:void()" class="btn btn-primary waves-effect waves-light" >Upload Room</a> --}}
                <h2>Amenities</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    @if(count($rooms) != 0)
                    <form action="{{ route('admin.amenities.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <div>
                                <label for="defaultSelect" class="form-label">{{ __('Room name') }}</label>
                                <select id="defaultSelect" name="room_id" class="form-select ">
                                    @foreach ($rooms as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <div id="amenities-wrapper">
                                <div class="row align-items-center amenity-item mb-2">
                                    <div class="col-md-5">
                                        <label>Amenities</label>
                                        <input type="text" name="amenities[0][title]" class="form-control" placeholder="Amenity Title (e.g. Free Wi-Fi)">
                                    </div>
                                    <div class="col-md-5">
                                        <label for="icon">Icon</label>
                                        <select name="amenities[0][icon]" class="form-control">
                                            <option value="fa-solid fa-wifi">Wi-Fi</option>
                                            <option value="fa-solid fa-tv">Television</option>
                                            <option value="fa-solid fa-bath">Bath</option>
                                            <option value="fa-solid fa-utensils">Restaurant</option>
                                            <option value="fa-solid fa-fan">Fan</option>
                                            <option value="fa-solid fa-snowflake">AC</option>
                                            <option value="fa-solid fa-mug-hot">Coffee</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mt-4">
                                        <button type="button" class="btn btn-danger remove-amenity">Remove</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-primary" id="add-amenity">Add Amenity</button>
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-primary w-100">{{ __(' Save ') }}</button>
                        </div>

                    </form>
                    @else
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('admin.rooms.index') }}" class="btn btn-primary">
                                Create New Room
                            </a>
                        </div>
                        <div class="card-body">
                            You have not created any amenities yet. PLease create one now
                        </div>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    let amenityIndex = 1;

    document.getElementById('add-amenity').addEventListener('click', function () {
        const wrapper = document.getElementById('amenities-wrapper');
        const html = `
        <div class="row amenity-item mb-2">
            <div class="col-md-5">
                <input type="text" name="amenities[${amenityIndex}][title]" class="form-control" placeholder="Amenity Title">
            </div>
            <div class="col-md-5">
                <select name="amenities[${amenityIndex}][icon]" class="form-control">
                    <option value="fa-solid fa-wifi">Wi-Fi</option>
                    <option value="fa-solid fa-tv">Television</option>
                    <option value="fa-solid fa-bath">Bath</option>
                    <option value="fa-solid fa-utensils">Restaurant</option>
                    <option value="fa-solid fa-fan">Fan</option>
                    <option value="fa-solid fa-snowflake">AC</option>
                    <option value="fa-solid fa-mug-hot">Coffee</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-amenity">Remove</button>
            </div>
        </div>`;
        wrapper.insertAdjacentHTML('beforeend', html);
        amenityIndex++;
    });

    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-amenity')) {
            e.target.closest('.amenity-item').remove();
        }
    });
</script>

@endpush