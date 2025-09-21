<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> Hotel - Home</title>

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href=""
        type="image/x-icon">

    <!-- Start Global Mandatory Style -->
    <!-- jquery-ui css -->
    <link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"
        type="text/css" />
    <link href="/assets/plugins/bootstrap/css/datatables.min.css"
        rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/bootstrap4-toggle/css/bootstrap4-toggle.min.css"
        rel="stylesheet" type="text/css" />
    <!-- Bootstrap -->
    <link href="/assets/plugins/flash.css" rel="stylesheet"
        type="text/css" />
    <!-- Bootstrap tag input-->
    <link href="/assets/plugins/metisMenu.css" rel="stylesheet"
        type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet"
        type="text/css" />
        <!-- Themify Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="/assets/plugins/typicons.min.css" rel="stylesheet"
        type="text/css" />
    <link href="/assets/plugins/themify-icons/themify-icons.css" rel="stylesheet"
        type="text/css" />
    <link href="/assets/plugins/select2.min.css"
        rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/bootstrap/css/bootstrap-select.css"
        rel="stylesheet" type="text/css" />
    <!-- Bootstrap rtl -->

    <!-- Lobipanel css -->
    <link href="/assets/plugins/material_icons/materia_icons.css"
        rel="stylesheet" type="text/css" />
    <link
        href="/assets/plugins/bootstrap/css/bootstrap-material-datetimepicker.css"
        rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/daterangepicker/daterangepicker.css"
        rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/jquery.sumoselect/sumoselect.min.css"
        rel="stylesheet" type="text/css" />

    <!-- Sweet Alert -->
    <link href="/assets/sweetalert/sweetalert.css" rel="stylesheet"
        type="text/css" />
    <!-- timepicker -->
    <link href="/assets/css/jquery-ui-timepicker-addon.min.css" rel="stylesheet"
        type="text/css" />
    <!-- Pace css -->
    <!-- Themify icons -->
    <link href="/assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css"
        rel="stylesheet" type="text/css" />
    <link href="/assets/css/custom-style.css" rel="stylesheet" type="text/css" />
    <!-- Kitchen Css -->
    <link href="/assets/css/kitchen.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/print.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/style.css" rel="stylesheet" type="text/css" />

    <!-- Google fonts -->
    <link
        href= "https://fonts.googleapis.com/css?family=Nunito+Sans:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&display=swap"
        rel="stylesheet" />

    <!-- Theme style rtl -->
    <!-- Include module style -->
    <link href=https://xainhotellatest.bdtask-demo.com/application/modules/accounts/assets/css/style.css
        rel="stylesheet">
    <link href=https://xainhotellatest.bdtask-demo.com/application/modules/addon/assets/css/style.css rel="stylesheet">
    <link href=https://xainhotellatest.bdtask-demo.com/application/modules/customer/assets/css/style.css
        rel="stylesheet">
    <link href=https://xainhotellatest.bdtask-demo.com/application/modules/dashboard/assets/css/style.css
        rel="stylesheet">
    <link href=https://xainhotellatest.bdtask-demo.com/application/modules/hrm/assets/css/style.css rel="stylesheet">
    <link href=https://xainhotellatest.bdtask-demo.com/application/modules/purchase/assets/css/style.css
        rel="stylesheet">
    <link href=https://xainhotellatest.bdtask-demo.com/application/modules/reports/assets/css/style.css
        rel="stylesheet">
    <link href=https://xainhotellatest.bdtask-demo.com/application/modules/room_facilities/assets/css/style.css
        rel="stylesheet">
    <link href=https://xainhotellatest.bdtask-demo.com/application/modules/room_reservation/assets/css/style.css
        rel="stylesheet">
    <link href=https://xainhotellatest.bdtask-demo.com/application/modules/room_setting/assets/css/style.css
        rel="stylesheet">
    <link href=https://xainhotellatest.bdtask-demo.com/application/modules/tax_management/assets/css/style.css
        rel="stylesheet">
    <link href=https://xainhotellatest.bdtask-demo.com/application/modules/duty_roster/assets/css/style.css
        rel="stylesheet">
    <link href=https://xainhotellatest.bdtask-demo.com/application/modules/pool_booking/assets/css/style.css
        rel="stylesheet">
    <link href=https://xainhotellatest.bdtask-demo.com/application/modules/transport_facility/assets/css/style.css
        rel="stylesheet">
    <link href=https://xainhotellatest.bdtask-demo.com/application/modules/whatsapp/assets/css/style.css
        rel="stylesheet">
    <link href=https://xainhotellatest.bdtask-demo.com/application/modules/hall_room/assets/css/style.css
        rel="stylesheet">
    <link href=https://xainhotellatest.bdtask-demo.com/application/modules/day_closing/assets/css/style.css
        rel="stylesheet">
    <link href=https://xainhotellatest.bdtask-demo.com/application/modules/car_parking/assets/css/style.css
        rel="stylesheet">
    <link href=https://xainhotellatest.bdtask-demo.com/application/modules/ordermanage/assets/css/style.css
        rel="stylesheet">
    <link href=https://xainhotellatest.bdtask-demo.com/application/modules/house_keeping/assets/css/style.css
        rel="stylesheet">
    <link href=https://xainhotellatest.bdtask-demo.com/application/modules/facebook_app/assets/css/style.css
        rel="stylesheet"><!-- jQuery -->
    <script src="https://xainhotellatest.bdtask-demo.com/assets/plugins/jQuery/jquery.min.js"></script>
    <!-- print func -->
    <script src="https://xainhotellatest.bdtask-demo.com/assets/js/print.js"></script>
</head>

<div class="fixed sidebar-mini">

    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <div class="wrapper">
        <!-- Sidebar  -->
        @include('layouts.sidebar')
        <!-- Page Content  -->
        <div class="content-wrapper">
            <div class="main-content">
                <!--Navbar-->
                @include('layouts.topnav')
                <!--/.navbar-->

                <!--/.Content Header (Page header)-->
                <div class="body-content">
                    <!-- <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-1 mb-sm-0 p-0 ">
                        </nav>
                        <div class="col-sm-8 header-title"> </div>
                    -->
                    @yield('content')
                </div>
                <!--/.body content-->
            </div>
            <!--/.main content-->
            <footer class="footer-content">
                <div class="footer-text d-flex align-items-center justify-content-between">
                    <div class="copy">
                        2025Â©Copyright: <a href=""> Hotel</a>
                    </div>
                    <div class="credit">United States, America </div>
                </div>
            </footer>
            <!--/.footer content-->
            <div class="overlay"></div>
        </div>
        <!--/.wrapper-->
    </div>
    <!-- jquery-ui -->
    <script src="https://xainhotellatest.bdtask-demo.com/assets/plugins/bootstrap/js/datatables.min.js"
        type="text/javascript"></script>
    <script src="https://xainhotellatest.bdtask-demo.com/assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js"
        type="text/javascript"></script>

    <script src="https://xainhotellatest.bdtask-demo.com/assets/js/datatable.js" type="text/javascript"></script>
    <script src="https://xainhotellatest.bdtask-demo.com/assets/js/datatablereport.js" type="text/javascript"></script>

    <script src="https://xainhotellatest.bdtask-demo.com/assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="https://xainhotellatest.bdtask-demo.com/assets/plugins/bootstrap/js/bootstrap-select.js"
        type="text/javascript"></script>
    <script src="https://xainhotellatest.bdtask-demo.com/assets/plugins/bootstrap/js/bootstrap.min.js"
        type="text/javascript"></script>
    <script src="https://xainhotellatest.bdtask-demo.com/assets/plugins/bootstrap/js/moment-with-locales.min.js"
        type="text/javascript"></script>

    <script src="https://xainhotellatest.bdtask-demo.com/assets/js/jquery-ui-timepicker-addon.min.js"
        type="text/javascript"></script>
    <script src="https://xainhotellatest.bdtask-demo.com/assets/plugins/bootstrap/js/bootstrap-material-datetimepicker.js"
        type="text/javascript"></script>
    <script src="https://xainhotellatest.bdtask-demo.com/assets/plugins/daterangepicker/daterangepicker.js"
        type="text/javascript"></script>
    <script src="https://xainhotellatest.bdtask-demo.com/assets/plugins/jquery.sumoselect/jquery.sumoselect.min.js"
        type="text/javascript"></script>
    <!-- Bootstrap -->
    <script src="https://xainhotellatest.bdtask-demo.com/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
    <!-- Bootstrap tag input-->
    <script src="https://xainhotellatest.bdtask-demo.com/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"
        type="text/javascript"></script>
    <script src="https://xainhotellatest.bdtask-demo.com/assets/js/custom-script.js" type="text/javascript"></script>
    <!-- lobipanel -->
    <script src="https://xainhotellatest.bdtask-demo.com/assets/plugins/moment/moment.min.js" type="text/javascript">
    </script>
    <!-- new panel -->
    <script src="https://xainhotellatest.bdtask-demo.com/assets/plugins/metisMenu/metisMenu.min.js" type="text/javascript">
    </script>
    <!-- Pace js -->
    <script src="https://xainhotellatest.bdtask-demo.com/assets/js/script.js" type="text/javascript"></script>
    <script src="https://xainhotellatest.bdtask-demo.com/assets/plugins/bootstrap4-toggle/js/bootstrap4-toggle.min.js"
        type="text/javascript"></script>

    <!-- sweetalert -->
    <script src="https://xainhotellatest.bdtask-demo.com/assets/sweetalert/sweetalert.min.js" type="text/javascript">
    </script>

    <!-- bootstrap timepicker -->
    <script src="https://xainhotellatest.bdtask-demo.com/assets/js/jquery-ui-sliderAccess.js" type="text/javascript">
    </script>

    <script src="https://xainhotellatest.bdtask-demo.com/assets/js/sidebar.js" type="text/javascript"></script>
    <input type="hidden" id="base" value="https://xainhotellatest.bdtask-demo.com/">
    <input type="hidden" id="emtycheck" value="home">
    <script src="https://xainhotellatest.bdtask-demo.com/assets/js/global.js" type="text/javascript"></script>
    <script src="https://xainhotellatest.bdtask-demo.com/assets/js/demo.js" type="text/javascript"></script>


    <!-- Select2 -->
    <script src="https://xainhotellatest.bdtask-demo.com/assets/js/select2.min.js" type="text/javascript"></script>
    <script src="https://xainhotellatest.bdtask-demo.com/assets/plugins/toastr/toastr.min.js" type="text/javascript">
    </script>
    <script src="https://xainhotellatest.bdtask-demo.com/assets/plugins/jQuery-print/jQuery.print.min.js"></script>



    <!-- Ordermanage js load -->
    <script src="https://xainhotellatest.bdtask-demo.com/assets/js/jquery.slimscroll.min.js" type="text/javascript">
    </script>
    <script src="https://xainhotellatest.bdtask-demo.com/assets/js/pusher.min.js" type="text/javascript"></script>
    <script src="https://xainhotellatest.bdtask-demo.com/assets/mousetrap-master/mousetrap.min.js" type="text/javascript">
    </script>

    {{-- <script src="https://xainhotellatest.bdtask-demo.com/ordermanage/order/showljslang" type="text/javascript"></script>
    <script src="https://xainhotellatest.bdtask-demo.com/application/modules/ordermanage/assets/js/print.js"
        type="text/javascript"></script>
    <a id="dayClose" hidden></a>
    <script src="https://xainhotellatest.bdtask-demo.com/application/modules/day_closing/assets/js/cashregister.js"
        type="text/javascript"></script>
    <!-- Include module Script -->
    <script src=https://xainhotellatest.bdtask-demo.com/application/modules/accounts/assets/js/script.js
        type="text/javascript"></script>
    <script src=https://xainhotellatest.bdtask-demo.com/application/modules/customer/assets/js/script.js
        type="text/javascript"></script>
    <script src=https://xainhotellatest.bdtask-demo.com/application/modules/dashboard/assets/js/script.js
        type="text/javascript"></script>
    <script src=https://xainhotellatest.bdtask-demo.com/application/modules/hrm/assets/js/script.js type="text/javascript">
    </script>
    <script src=https://xainhotellatest.bdtask-demo.com/application/modules/payment_setting/assets/js/script.js
        type="text/javascript"></script>
    <script src=https://xainhotellatest.bdtask-demo.com/application/modules/purchase/assets/js/script.js
        type="text/javascript"></script>
    <script src=https://xainhotellatest.bdtask-demo.com/application/modules/reports/assets/js/script.js
        type="text/javascript"></script>
    <script src=https://xainhotellatest.bdtask-demo.com/application/modules/room_facilities/assets/js/script.js
        type="text/javascript"></script>
    <script src=https://xainhotellatest.bdtask-demo.com/application/modules/room_reservation/assets/js/script.js
        type="text/javascript"></script>
    <script src=https://xainhotellatest.bdtask-demo.com/application/modules/room_setting/assets/js/script.js
        type="text/javascript"></script>
    <script src=https://xainhotellatest.bdtask-demo.com/application/modules/tax_management/assets/js/script.js
        type="text/javascript"></script>
    <script src=https://xainhotellatest.bdtask-demo.com/application/modules/units/assets/js/script.js
        type="text/javascript"></script>
    <script src=https://xainhotellatest.bdtask-demo.com/application/modules/duty_roster/assets/js/script.js
        type="text/javascript"></script>
    <script src=https://xainhotellatest.bdtask-demo.com/application/modules/pool_booking/assets/js/script.js
        type="text/javascript"></script>
    <script src=https://xainhotellatest.bdtask-demo.com/application/modules/transport_facility/assets/js/script.js
        type="text/javascript"></script>
    <script src=https://xainhotellatest.bdtask-demo.com/application/modules/hall_room/assets/js/script.js
        type="text/javascript"></script>
    <script src=https://xainhotellatest.bdtask-demo.com/application/modules/car_parking/assets/js/script.js
        type="text/javascript"></script>
    <script src=https://xainhotellatest.bdtask-demo.com/application/modules/ordermanage/assets/js/script.js
        type="text/javascript"></script>
    <script src=https://xainhotellatest.bdtask-demo.com/application/modules/house_keeping/assets/js/script.js
        type="text/javascript"></script> --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
        .create(document.querySelector('#description'), {
            ckfinder: {
               
            } 
        })
        .catch(error => {
            console.error(error);
        });
    </script>
    @include('partials.message')
    @stack('scripts')
</body>
</html>
