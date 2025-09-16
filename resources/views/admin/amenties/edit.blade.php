@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="text-start py-3">
                <h2>Edit Amenity</h2>
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
                    <form action="{{ route('admin.amenities.update', $amenity->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="room_id" class="form-label">Room</label>
                            <select id="room_id" name="room_id" class="form-select">
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}" {{ $room->id == $amenity->room_id ? 'selected' : '' }}>
                                        {{ $room->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Amenity Title</label>
                            <input type="text" id="title" name="title" class="form-control"
                                   value="{{ old('title', $amenity->title) }}" placeholder="e.g. Free Wi-Fi">
                        </div>

                        <div class="mb-3">
                            <label for="icon" class="form-label">Icon</label>
                            <select id="icon" name="icon" class="form-select">
                                <option value="fa-solid fa-wifi" {{ $amenity->icon == 'fa-solid fa-wifi' ? 'selected' : '' }}>Wi-Fi</option>
                                <option value="fa-solid fa-tv" {{ $amenity->icon == 'fa-solid fa-tv' ? 'selected' : '' }}>Television</option>
                                <option value="fa-solid fa-bath" {{ $amenity->icon == 'fa-solid fa-bath' ? 'selected' : '' }}>Bath</option>
                                <option value="fa-solid fa-utensils" {{ $amenity->icon == 'fa-solid fa-utensils' ? 'selected' : '' }}>Restaurant</option>
                                <option value="fa-solid fa-fan" {{ $amenity->icon == 'fa-solid fa-fan' ? 'selected' : '' }}>Fan</option>
                                <option value="fa-solid fa-snowflake" {{ $amenity->icon == 'fa-solid fa-snowflake' ? 'selected' : '' }}>AC</option>
                                <option value="fa-solid fa-mug-hot" {{ $amenity->icon == 'fa-solid fa-mug-hot' ? 'selected' : '' }}>Coffee</option>
                            </select>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
