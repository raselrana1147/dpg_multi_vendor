<!DOCTYPE html>
<html lang="en">
     <head>
       @include('seller.files.css')
    </head>

    <body>
         <div id="wrapper">

            <!-- Top Bar Start -->
            @include('seller.files.header')
            <!-- Top Bar End -->

            <!-- ========== Left Sidebar Start ========== -->
             @include('seller.files.sidebar')
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h4 class="page-title">@yield('seller_breadcrumb')</h4>
                                    
                                </div>
                                
                            </div> <!-- end row -->
                        </div>
                        <!-- end page-title -->
                        @section('seller_content')
                        @show
                        
                    </div>
                    <!-- container-fluid -->

                </div>
                <!-- content -->

                <footer class="footer">
                  {{copyright()}}
                </footer>

            </div>
           

        </div>
    
         @include('seller.files.js')
    </body>


<!-- Mirrored from themesbrand.com/veltrix/layouts-2/vertical/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Jan 2020 07:07:20 GMT -->
</html>