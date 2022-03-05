@extends('layouts.app')

@section('main_content')
    <div class="container">
                <div class="m-5">
                    <h1 class="text-center">@lang('title.customer_login')</h1>
                </div>
                <div class="row mb-10">
                    <div class="col-lg-7 col-xl-6 mb-8 mb-lg-0 offset-3 registration-card">
                        <div class="mr-xl-6">
                            <div class="border-bottom border-color-1 mb-5">
                                <h3 class="section-title mb-0 pb-2 font-size-25">@lang('title.information')</h3>
                            </div>
                           
                            <form id="kt_sign_in_form" data-action="{{ route('login') }}" method="POST">
                                @csrf
                                <div data-target-group="idForm">
                                    <!-- Title -->
                                    <header class="text-center mb-7">
                                    <h2 class="h4 mb-0">@lang('title.welcome_back')</h2>
                                    <p>@lang('title.manage_login')</p>
                                     <div id="message_area" style="display: none"></div>
                                    </header>
                                    <!-- End Title -->

                                    <!-- Form Group -->
                                    <div class="form-group">
                                        <div class="js-form-message js-focus-state">
                                            <label class="sr-only" for="signinEmail">@lang('title.email')</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <span class="fas fa-user"></span>
                                                    </span>
                                                </div>
                                                <input type="email" class="form-control" name="email" placeholder="@lang('title.email')" aria-label="Email" required
                                                data-msg="Please enter a valid email address."
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="js-form-message js-focus-state">
                                          <label class="sr-only">@lang('title.password')</label>
                                          <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <span class="fas fa-lock"></span>
                                                </span>
                                            </div>
                                            <input type="password" class="form-control" name="password" placeholder="@lang('title.password')" aria-label="Password" required
                                               data-msg="Your password is invalid. Please try again."
                                               data-error-class="u-has-error"
                                               data-success-class="u-has-success">
                                          </div>
                                        </div>
                                    </div>
                                 
                                    <div class="mb-2">
                                        <button type="submit" class="btn btn-block btn-sm btn-primary transition-3d-hover submit_button">@lang('auth.signin')</button>
                                        
                                    </div>
                                     <div class="text-center mb-4">
                                        <span class="small text-muted">@lang('title.no_account')</span>
                                        <a  href="{{ route('register') }}" class="small text-dark" >@lang('auth.signup')
                                        </a>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    
                </div>   
    </div>
@endsection
