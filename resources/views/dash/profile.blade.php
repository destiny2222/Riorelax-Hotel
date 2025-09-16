@extends('layouts.main')
@section('content')
    <section class="breadcrumb-area d-flex align-items-center page_speed_1312335483">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12">
                    <div class="breadcrumb-wrap text-center">
                        <div class="breadcrumb-title">
                            <h2>Profile</h2>
                            <div class="breadcrumb-wrap">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="https://riorelax.archielite.com">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Account information</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-40 pb-40">
        <div class="container">
            <div class="customer-page crop-avatar">
                <div class="container">
                    <div class="customer-body">
                        <div class="row body-border">
                            <div class="col-md-3">
                                <div class="profile-sidebar">
                                    @include('dash.sidebar')
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="profile-content">
                                    @if(session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            @foreach ($errors->all() as $error)
                                                <div>{{ $error }}</div>
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h1 class="text-center">Edit Profile</h1>
                                        </div>
                                        <form method="POST" action="{{ route('dashboard.edit.profile', $user->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-md">
                                                    <div class="form-group mb-20">
                                                        <label for="first_name"
                                                            class="input-group-prepend mb-10 mt-20">First Name: </label>
                                                        <input id="first_name" type="text" class="form-control "
                                                            name="first_name" value="{{ $user->first_name }}">
                                                    </div>
                                                </div>
                                                <div class="col-md">
                                                    <div class="form-group mb-20">
                                                        <label for="last_name"
                                                            class="input-group-prepend mb-10 mt-20">Last Name: </label>
                                                        <input id="last_name" type="text" class="form-control "
                                                            name="last_name" value="{{ $user->last_name }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md">
                                                    <div class="form-group mb-20">
                                                        <label for="date_of_birth" class="input-group-prepend mb-10 mt-20">Date of birth: </label>
                                                        <input id="date_of_birth" type="date"
                                                            class="form-control date-picker " name="dob" value="{{ $user->dob }}"
                                                            autocomplete="false">
                                                    </div>
                                                </div>
                                                <div class="col-md">
                                                    <div class="form-group mb-20">
                                                        <label for="email" class="input-group-prepend mb-10 mt-20">Email: </label>
                                                        <input id="email" type="email" class="form-control " name="email"
                                                            value="{{ $user->email }}" autocomplete="false" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md">
                                                    <div class="form-group mb-20">
                                                        <label for="country"
                                                            class="input-group-prepend mb-10 mt-20">Country: </label>
                                                        <input id="country" type="text" class="form-control "
                                                            name="country" value="{{ $user->country }}"></div>
                                                </div>
                                                <div class="col-md">
                                                    <div class="form-group mb-20">
                                                        <label for="state" class="input-group-prepend mb-10 mt-20">
                                                            State / Province: 
                                                        </label>
                                                            <input id="state" type="text" class="form-control " name="state" value="{{ $user->state }}">
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md">
                                                    <div class="form-group mb-20">
                                                        <label for="city"  class="input-group-prepend mb-10 mt-20">City:  </label>
                                                        <input id="city" type="text" class="form-control "   name="city" value="{{ $user->city }}">
                                                    </div>
                                                </div>
                                                <div class="col-md">
                                                    <div class="form-group mb-20">
                                                        <label for="address" class="input-group-prepend mb-10 mt-20">Address:  </label>
                                                        <input id="address" type="text" class="form-control " name="address" value="{{ $user->address }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md">
                                                    <div class="form-group mb-20">
                                                        <label for="zip" class="input-group-prepend mb-10 mt-20">Postal / Zip code: </label>
                                                        <input id="zip" type="text"  class="form-control " name="zip" value="{{ $user->zip }}" aria-describedby="txt-zip-error">
                                                    </div>
                                                </div>
                                                <div class="col-md">
                                                    <div class="form-group mb-20">
                                                        <label for="phone"  class="input-group-prepend mb-10 mt-20">Phone  number: </label>
                                                        <input id="phone" type="text" class="form-control " name="phone" value="{{ $user->phone }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col s12 mt-20">
                                                <button type=submit class="btn btn-primary customer-btn">
                                                    Save Changes
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
@endsection