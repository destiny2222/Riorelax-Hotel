@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats statistic-box mb-4">
                <div
                    class="card-header card-header-warning card-header-icon position-relative border-0 text-right px-3 py-0">
                    <div class="card-icon d-flex align-items-center justify-content-center">
                        <i class="material-icons">today</i>
                    </div>
                    <p class="card-category text-uppercase fs-10 font-weight-bold text-muted">
                        Today Booking</p>
                    <h3 class="card-title fs-18 font-weight-bold">{{ $booking_of_today }}</h3>
                </div>
                <div class="card-footer p-3">
                    <div class="stats">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats statistic-box mb-4">
                <div
                    class="card-header card-header-success card-header-icon position-relative border-0 text-right px-3 py-0">
                    <div class="card-icon d-flex align-items-center justify-content-center">
                        <i class="material-icons">attach_money</i>
                    </div>
                    <p class="card-category text-uppercase fs-10 font-weight-bold text-muted">
                        Total Amount</p>
                    <h3 class="card-title fs-21 font-weight-bold">{{ $total_booking_amount }}</h3>
                </div>
                <div class="card-footer p-3">
                    <div class="stats">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats statistic-box mb-4">
                <div
                    class="card-header card-header-danger card-header-icon position-relative border-0 text-right px-3 py-0">
                    <div class="card-icon d-flex align-items-center justify-content-center">
                        <i class="material-icons">account_circle</i>
                    </div>
                    <p class="card-category text-uppercase fs-10 font-weight-bold text-muted">
                        Total Customer</p>
                    <h3 class="card-title fs-21 font-weight-bold">{{ $total_user }}</h3>
                </div>
                <div class="card-footer p-3">
                    <div class="stats">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats statistic-box mb-4">
                <div
                    class="card-header card-header-info card-header-icon position-relative border-0 text-right px-3 py-0">
                    <div class="card-icon d-flex align-items-center justify-content-center">
                        <i class="material-icons">date_range</i>
                    </div>
                    <p class="card-category text-uppercase fs-10 font-weight-bold text-muted">
                        Total Booking</p>
                    <h3 class="card-title fs-21 font-weight-bold">{{ $total_booking }}</h3>
                </div>
                <div class="card-footer p-3">
                    <div class="stats">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-12">
            <!--Basic apexMixedChart Chart-->
            <div class="card mb-4">
                <div class="col-lg-10 col-xl-10 offset-md-1">
                </div>
                <div class="card-body">
                    <div id="apexMixedChart"></div>
                </div>
            </div>
        </div>
    </div>
@endsection