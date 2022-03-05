@extends('layouts.app')
@section('ecommerce_title','DPG | User Registration')

@section('main_content')
    <div class="container">
                <div class="m-5">
                    <h1 class="text-center">@lang('title.customer_resgistration')</h1>
                </div>
                <div class="row mb-10">
                    <div class="col-lg-7 col-xl-6 mb-8 mb-lg-0 offset-3 registration-card">
                        <div class="mr-xl-6">
                            <div class="border-bottom border-color-1 mb-5">
                                <h3 class="section-title mb-0 pb-2 font-size-25">@lang('title.information')</h3>
                            </div>
                           
                            <form class="js-validate" novalidate="novalidate" action="{{ route('register') }}" method="Post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Input -->
                                        <div class="js-form-message mb-4">
                                            <label class="form-label">
                                                @lang('title.first_name')
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" 
                                            name="first_name" value="{{ old('first_name') }}"  placeholder="@lang('title.enter_last_name')">
                                            @if ($errors->has('first_name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('first_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <!-- End Input -->
                                    </div>

                                    <div class="col-md-6">
                                        <!-- Input -->
                                        <div class="js-form-message mb-4">
                                            <label class="form-label">
                                                @lang('title.last_name')
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" placeholder="@lang('title.enter_last_name')">
                                            @if ($errors->has('last_name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('last_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <!-- End Input -->
                                    </div>

                                    <div class="col-md-6">
                                        <!-- Input -->
                                        <div class="js-form-message mb-4">
                                            <label class="form-label">
                                               @lang('title.email')
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="@lang('title.enter_email')" name="email" value="{{ old('email') }}">
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <!-- End Input -->
                                    </div>

                                    <div class="col-md-6">
                                        <!-- Input -->
                                        <div class="js-form-message mb-4">
                                            <label class="form-label">
                                               @lang('title.phone')
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="@lang('title.enter_phone')" name="phone" value="{{ old('phone') }}">
                                            @if ($errors->has('phone'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <!-- End Input -->
                                    </div>

                                    <div class="col-md-6">
                                        <!-- Input -->
                                        <div class="js-form-message mb-4">
                                            <label class="form-label">
                                                @lang('title.password')
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="@lang('title.password')">
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <!-- End Input -->
                                    </div>

                                    <div class="col-md-6">
                                        <!-- Input -->
                                        <div class="js-form-message mb-4">
                                            <label class="form-label">
                                                @lang('title.confirm_password')
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="password" class="form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" placeholder="@lang('title.confirm_password')">
                                            @if ($errors->has('password_confirmation'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <!-- End Input -->
                                    </div>

                                    <div class="col-md-12">
                                        <div class="js-form-message mb-4">
                                            <label class="form-label">
                                                @lang('title.address')
                                                <span class="text-danger">*</span>
                                            </label>

                                            <div class="input-group">
                                                <textarea class="form-control p-5 {{ $errors->has('address') ? ' is-invalid' : '' }}" rows="2" name="address" name="address" placeholder="@lang('title.address')">{{ old('address') }}</textarea>
                                                @if ($errors->has('address'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('address') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary-dark-w px-5">@lang('title.register')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
                <!-- Brand Carousel -->
                
                <!-- End Brand Carousel -->
            </div>
@endsection