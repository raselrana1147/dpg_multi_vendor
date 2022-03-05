@extends('layouts.app')
@section('ecommerce_title','Ecommerce | Profile')
@section('extra_css')
@endsection
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
              @lang('title.update_profile')
             </div>
             <div class="card-body">
                <div class="message_section" style="display: none"></div>
                <form id="update_profile" novalidate="novalidate" action="{{ route('customer.profile_update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row pb-4">
                     <div class="offset-4">
                        <div class="text-center">
                           <img id="profile_image_path" src="{{Auth::user()->profile_image_url !=null ? asset('assets/backend/image/profile/small/'.Auth::user()->profile_image_url) : asset('assets/backend/image/'.default_image())}}"  class="profile_image" alt="customer image"><br>
                           <button type="button" class="btn btn-warning btn-sm upload_button" role="button"><i class="fas fa-upload"></i>@lang('title.upload')</button>
                        </div>
                        <input type="file" id="image_path" name="profile_image_url" class="d-none get_image">
                     </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Input -->
                            <div class="js-form-message mb-4">
                                <label class="form-label">
                                    @lang('title.first_name')
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" 
                                name="first_name" value="{{ Auth::user()->first_name }}"  placeholder="@lang('title.enter_last_name')">
                               
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
                                <input type="text"  class="form-control" name="last_name" value="{{ Auth::user()->last_name }}" placeholder="@lang('title.enter_last_name')">
                                
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
                                <input type="text" class="form-control" name="phone" value="{{ Auth::user()->phone }}" placeholder="@lang('title.enter_phone')">
                                
                            </div>
                            <!-- End Input -->
                        </div>

                        <div class="col-md-6">
                            <!-- Input -->
                            <div class="js-form-message mb-4">
                                <label class="form-label">
                                    @lang('title.gender')
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="custom-control custom-radio custom-control-inline">
                                  <input type="radio" id="radioMale" name="gender" class="custom-control-input" {{Auth::user()->gender=="Male" ? 'checked' : ''}} value="Male">
                                  <label class="custom-control-label" for="radioMale">@lang('title.male')</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                  <input type="radio" id="radioFemale" name="gender" class="custom-control-input" {{Auth::user()->gender=="Female" ? 'checked' : ''}} value="Female">
                                  <label class="custom-control-label" for="radioFemale">@lang('title.female')</label>
                                </div>

                                <div class="custom-control custom-radio custom-control-inline">
                                  <input type="radio" id="radionOther" name="gender" class="custom-control-input" {{Auth::user()->gender=="Other" ? 'checked' : ''}} value="Other">
                                  <label class="custom-control-label" for="radionOther">@lang('title.other')</label>
                                </div>
                               
                                
                            </div>
                            <!-- End Input -->
                        </div>

                        <div class="col-md-12">
                            <!-- Input -->
                            <div class="js-form-message mb-4">
                                <label class="form-label">
                                    @lang('title.address')
                                    <span class="text-danger">*</span>
                                </label>
                               <textarea class="form-control p-5 " rows="2"  name="address" placeholder="@lang('title.address')">{{ Auth::user()->address }}</textarea>
                                
                            </div>
                            <!-- End Input -->
                        </div>

                    </div>
                    <div class="mb-3">
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


<script>
  $(document).ready(function(){
      $('.get_image').on('change',function(){
          const profile_image_path = document.querySelector('#profile_image_path');
          const image_path = document.querySelector('#image_path').files[0];
          const reader = new FileReader();
          reader.addEventListener("load", function () {
            profile_image_path.src = reader.result;
          }, false);

          if (image_path) {
            reader.readAsDataURL(image_path);
          }
      });
  })
</script>

@endsection