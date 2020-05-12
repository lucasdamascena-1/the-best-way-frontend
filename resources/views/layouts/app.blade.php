<html>
    <head>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
        <link href="{{ asset('vendor/fonts/circular-std/style.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('libs/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/charts/chartist-bundle/chartist.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/charts/morris-bundle/morris.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/charts/c3charts/c3.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/fonts/flag-icon-css/flag-icon.min.css') }}">



        <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/css/buttons.bootstrap4.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/css/select.bootstrap4.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/css/fixedHeader.bootstrap4.css') }}">

        <title>FIAP - 35SCJ - Webservices & Restful Technologies</title>
    </head>

<body>
    <div id="app">
        <!-- ============================================================== -->
        <!-- main wrapper -->
        <!-- ============================================================== -->
        <div class="dashboard-main-wrapper">


            <!-- ============================================================== -->
            <!-- navbar -->
            <!-- ============================================================== -->
            @component('components.navbar', [ "current" => $current ])
            @endcomponent
            <!-- ============================================================== -->
            <!-- end navbar -->
            <!-- ============================================================== -->


            <!-- ============================================================== -->
            <!-- left sidebar -->
            <!-- ============================================================== -->
            @component('components.sidebar', [ "current" => $current ])
            @endcomponent
            <!-- ============================================================== -->
            <!-- end left sidebar -->
            <!-- ============================================================== -->



            <!-- ============================================================== -->
            <!-- wrapper  -->
            <!-- ============================================================== -->
            <div class="dashboard-wrapper">
                <div class="dashboard-ecommerce">
                    <div class="container-fluid dashboard-content ">
                        <!-- ============================================================== -->
                        <!-- pageheader  -->
                        <!-- ============================================================== -->
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="page-header">
                                    <h2 class="pageheader-title">{{$current}} </h2>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end pageheader  -->
                        <!-- ============================================================== -->

                            @yield('content')



                    </div>
                </div>

                <!-- ============================================================== -->
                <!-- footer -->
                <!-- ============================================================== -->
                    @component('components.footer')
                    @endcomponent
                <!-- ============================================================== -->
                <!-- end footer -->
                <!-- ============================================================== -->


            </div>
            <!-- ============================================================== -->
            <!-- end wrapper  -->
            <!-- ============================================================== -->



        </div>
        <!-- ============================================================== -->
        <!-- end main wrapper  -->
        <!-- ============================================================== -->
    </div>

    <!-- main js -->
    <!--script src="{{ asset('js/app.js')}}" type="text/javascript"></script-->
    <!-- jquery 3.3.1 -->
    <script src="{{ asset('vendor/jquery/jquery-3.3.1.min.js')}}"></script>
    <!-- bootstap bundle js -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
    <!-- slimscroll js -->
    <script src="{{ asset('vendor/slimscroll/jquery.slimscroll.js')}}"></script>
    <!-- main js -->
    <script src="{{ asset('libs/js/main-js.js')}}"></script>

    @if($current=="Dashbord")
        <!-- chart chartist js -->
        <script src="{{ asset('vendor/charts/chartist-bundle/chartist.min.js')}}"></script>
        <!-- sparkline js -->
        <script src="{{ asset('vendor/charts/sparkline/jquery.sparkline.js')}}"></script>
        <!-- morris js -->
        <script src="{{ asset('vendor/charts/morris-bundle/raphael.min.js')}}"></script>
        <script src="{{ asset('vendor/charts/morris-bundle/morris.js')}}"></script>
        <!-- chart c3 js -->
        <script src="{{ asset('vendor/charts/c3charts/c3.min.js')}}"></script>
        <script src="{{ asset('vendor/charts/c3charts/d3-5.4.0.min.js')}}"></script>
        <script src="{{ asset('vendor/charts/c3charts/C3chartjs.js')}}"></script>
        <script src="{{ asset('libs/js/dashboard-ecommerce.js')}}"></script>
    @endif

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('vendor/datatables/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('vendor/datatables/js/data-table.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>



    @hasSection('javascript')
        @yield('javascript')
    @endif
</body>
</html>
