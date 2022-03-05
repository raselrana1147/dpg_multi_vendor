<!DOCTYPE html>
<html lang="en">

<head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>@lang('seller.page_title')</title>
        <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
        <meta content="Themesbrand" name="author" />
        <link rel="shortcut icon" href="{{ asset('assets/backend/assets/images/favicon.ico')}}">

        <link href="{{ asset('assets/backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/backend/assets/css/metismenu.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/backend/assets/css/icons.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/backend/assets/css/style.css')}}" rel="stylesheet" type="text/css">
    </head>

    <body class="bg-primary">
        <div class="home-btn d-none d-sm-block">
            <a href="{{ route('seller.dashboard') }}" class="text-white"><i class="fas fa-home h2"></i></a>
        </div>

        <div class="account-pages my-5 pt-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-pattern shadow-none">
                            <div class="card-body">
                                <div class="text-center mt-4">
                                    <div class="mb-3">
                                        <a href="{{ route('seller.dashboard') }}" class="logo"><img src="{{ asset('assets/backend/image/logo/'.logo()) }}" height="20" alt="logo"></a>
                                    </div>
                                </div>
                                <div class="p-3"> 
                                    <h4 class="font-18 text-center">@lang('seller.login_header')</h4>
                                    <p class="text-muted text-center mb-4">@lang('seller.login_header_title')</p>
                                    <div id="message_area" style="display: none"></div>
                                    <form id="kt_sign_in_form" class="form-horizontal" data-action="{{ route('login') }}" method="POST">
                						@csrf
                                        <div class="form-group">
                                            <label for="username">@lang('seller.email')</label>
                                            <input type="text" class="form-control" name="email" placeholder="@lang('seller.enter_email')">
                                        </div>
                
                                        <div class="form-group">
                                            <label for="userpassword">@lang('seller.password')</label>
                                            <input type="password" class="form-control" name="password" placeholder="@lang('seller.enter_email')">
                                        </div>
                
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customControlInline">
                                            <label class="custom-control-label" for="customControlInline">@lang('seller.remember_me')</label>
                                        </div>
                                        
                                        <div class="mt-3">
                                            <button class="btn btn-primary btn-block waves-effect waves-light submit_button" type="submit">@lang('seller.login')</button>
                                        </div>
            
                                        <div class="mt-4 text-center">
                                            <a href="pages-recoverpw.html"><i class="mdi mdi-lock"></i>@lang('seller.forget_password')?</a>
                                        </div>
                                    </form>
                
                                </div>
                    
                            </div>
                        </div>
                        <div class="mt-5 text-center text-white-50">
                            <p>@lang('seller.not_account') ? <a href="pages-register.html" class="font-500 text-white">@lang('seller.singup')</a> </p>
                            <p>{{copyright()}}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery  -->
        <script src="{{ asset('assets/backend/assets/js/jquery.min.js')}}"></script>
        <script src="{{ asset('assets/backend/assets/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{ asset('assets/backend/assets/js/metismenu.min.js')}}"></script>
        <script src="{{ asset('assets/backend/assets/js/jquery.slimscroll.js')}}"></script>
        <script src="{{ asset('assets/backend/assets/js/waves.min.js')}}"></script>

        <!-- App js -->
        <script src="{{ asset('assets/backend/assets/js/app.js')}}"></script>
        <script>
           $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });
      </script>
      <script src="{{ asset('assets/custom/js/auth.js')}}"></script>
        
    </body>
</html>