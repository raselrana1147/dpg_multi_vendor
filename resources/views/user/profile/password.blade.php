@extends('layouts.app')
@section('ecommerce_title','Ecommerce | Change Password')
@section('main_content')
  <div class="container">
              
      <div class="row m-5">
         
         <div class="col-4 ">
            <div class="card">
              <div class="card-header bg-warning header-title">
                <span><i class="fas fa-bars pr-1"></i>@lang('title.menu')</span>
              </div>
              @include('user.profile.sidebar')
            </div>
         </div>

         <div class="col-8 ">
           <div class="card">
             <div class="card-header bg-warning header-title">
              @lang('title.change_password')
             </div>
             <div class="card-body">
                <div class="message_section" style="display: none"></div>
                <form id="change_password" novalidate="novalidate" data-action="{{ route('customer.change_password') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-10 offset-1">
                            <!-- Input -->
                            <div class="js-form-message mb-4">
                                <label class="form-label">
                                    @lang('title.old_password')
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password" class="form-control" name="old_password" placeholder="@lang('title.enter_old_password')">
                            </div>
                        </div>

                        <div class="col-md-10 offset-1">
                            <!-- Input -->
                            <div class="js-form-message mb-4">
                                <label class="form-label">
                                   @lang('title.new_password')
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password" class="form-control" name="new_password" placeholder="@lang('title.enter_new_password')">
                                
                            </div>
                            <!-- End Input -->
                        </div>

                        <div class="col-md-10 offset-1">
                            <!-- Input -->
                            <div class="js-form-message mb-4">
                                <label class="form-label">
                                   @lang('title.confirm_password')
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="@lang('title.enter_confirm_password')">
                               
                            </div>
                            <!-- End Input -->
                        </div>
                    </div>
                    <div class="mb-3 offset-1">
                        <button type="submit" class="btn btn-primary-dark-w px-5">@lang('title.save_changes') <span class="spinner-border spinner-border-sm show_spinner" style="display: none"></span></button>
                    </div>
                </form>
             </div>
           </div>
         </div>
          
      </div>
             
  </div>
@endsection

@section('extra_js')

@endsection