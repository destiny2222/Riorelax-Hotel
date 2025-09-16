@extends('layouts.master')
@section('content')
    <section>
        <div class="row p-3" id="allRooms">
            <div class="col-sm-6 col-lg-4 col-xl-3 col-xxl-2 mb-3">
                <div class="position-relative d-flex justify-content-center">
                    <div class="hotel-image">
                        <img src="https://xainhotellatest.bdtask-demo.com/application/modules/room_setting/assets/images/2025-02-13/6.jpg"
                            class="image-inner" alt="">
                    </div>
                    <div
                        class="scroll-bar overlay-green px-4 py-3 text-center text-white position-absolute">
                        <h2 class="fs-21 mt-3 font-weight-bold">
                            Floor Name First Floor</h2>
                        <h3 class="fs-21 mt-3 font-weight-bold">
                            Room No. 101</h3>
                        <p class="mb-1">
                            Room Type :VIP</p>
                        <p class="mb-1">
                            Check Out :2025-09-16 </p>
                        <p class="mb-1 countdown-text" id="time_1"></p>
                        <input type="hidden" value="2025-09-16 00:00:00" id="1" class='sl'>
                        <input type="hidden" id="date_time" value="2025-09-15">
                        <button type="button" class="btn btn-primary mb-2 font-weight-bold"
                            id="b_379" value="101" data-toggle="modal" onclick="Detail(379,101)"
                            data-target="#exampleModal1">Booked</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 col-xl-3 col-xxl-2 mb-3">
                <div class="position-relative d-flex justify-content-center">
                    <div class="hotel-image">
                        <img src="https://xainhotellatest.bdtask-demo.com/application/modules/room_setting/assets/images/2025-02-13/6.jpg"
                            class="image-inner" alt="">
                    </div>
                    <div
                        class="scroll-bar overlay-black px-4 py-3 text-center text-white position-absolute">
                        <h2 class="fs-21 mt-3 font-weight-bold">
                            Floor Name First Floor</h2>
                        <h3 class="fs-21 mt-3 font-weight-bold">
                            Room No. 102</h3>
                        <p class="mb-1">
                            Room Type :VIP</p>
                        <p class="mb-1">Check Out : None</p>
                        <p class="mb-1 countdown-text">0.0</p>
                        <input type="hidden" id="date_time" value="2025-09-15">
                        <button type="button" class="btn btn-success mb-2 font-weight-bold"
                            id="" value="102" data-toggle="modal" onclick="Detail(0,102)"
                            data-target="#exampleModal1">Available</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 col-xl-3 col-xxl-2 mb-3">
                <div class="position-relative d-flex justify-content-center">
                    <div class="hotel-image">
                        <img src="https://xainhotellatest.bdtask-demo.com/application/modules/room_setting/assets/images/2025-02-13/6.jpg"
                            class="image-inner" alt="">
                    </div>
                    <div
                        class="scroll-bar overlay-black px-4 py-3 text-center text-white position-absolute">
                        <h2 class="fs-21 mt-3 font-weight-bold">
                            Floor Name First Floor</h2>
                        <h3 class="fs-21 mt-3 font-weight-bold">
                            Room No. 103</h3>
                        <p class="mb-1">
                            Room Type :VIP</p>
                        <p class="mb-1">Check Out : None</p>
                        <p class="mb-1 countdown-text">0.0</p>
                        <input type="hidden" id="date_time" value="2025-09-15">
                        <button type="button" class="btn btn-success mb-2 font-weight-bold"
                            id="" value="103" data-toggle="modal" onclick="Detail(0,103)"
                            data-target="#exampleModal1">Available</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 col-xl-3 col-xxl-2 mb-3">
                <div class="position-relative d-flex justify-content-center">
                    <div class="hotel-image">
                        <img src="https://xainhotellatest.bdtask-demo.com/application/modules/room_setting/assets/images/2025-02-13/6.jpg"
                            class="image-inner" alt="">
                    </div>
                    <div
                        class="scroll-bar overlay-black px-4 py-3 text-center text-white position-absolute">
                        <h2 class="fs-21 mt-3 font-weight-bold">
                            Floor Name First Floor</h2>
                        <h3 class="fs-21 mt-3 font-weight-bold">
                            Room No. 104</h3>
                        <p class="mb-1">
                            Room Type :VIP</p>
                        <p class="mb-1">Check Out : None</p>
                        <p class="mb-1 countdown-text">0.0</p>
                        <input type="hidden" id="date_time" value="2025-09-15">
                        <button type="button" class="btn btn-success mb-2 font-weight-bold"
                            id="" value="104" data-toggle="modal" onclick="Detail(0,104)"
                            data-target="#exampleModal1">Available</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 col-xl-3 col-xxl-2 mb-3">
                <div class="position-relative d-flex justify-content-center">
                    <div class="hotel-image">
                        <img src="https://xainhotellatest.bdtask-demo.com/application/modules/room_setting/assets/images/2025-02-13/6.jpg"
                            class="image-inner" alt="">
                    </div>
                    <div
                        class="scroll-bar overlay-black px-4 py-3 text-center text-white position-absolute">
                        <h2 class="fs-21 mt-3 font-weight-bold">
                            Floor Name Second Floor</h2>
                        <h3 class="fs-21 mt-3 font-weight-bold">
                            Room No. 121</h3>
                        <p class="mb-1">
                            Room Type :VIP</p>
                        <p class="mb-1">Check Out : None</p>
                        <p class="mb-1 countdown-text">0.0</p>
                        <input type="hidden" id="date_time" value="2025-09-15">
                        <button type="button" class="btn btn-success mb-2 font-weight-bold"
                            id="" value="121" data-toggle="modal" onclick="Detail(0,121)"
                            data-target="#exampleModal1">Available</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection