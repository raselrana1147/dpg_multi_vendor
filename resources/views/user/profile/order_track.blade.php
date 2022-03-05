@extends('layouts.app')
@section('ecommerce_title','Ecommerce | Order Tracking')
@section('extra_css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/custom/css/datatable.css') }}">
<style type="text/css">
  .dataTables_paginate span a
  {
     background: #ffc107 !important;
     border: 1px solid #dfac13 !important;
     border-radius: 15% !important;
  }

</style>
@endsection
@section('main_content')
  <div class="container">
      <div class="profile-wrapper">
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
               @lang('title.track_order')
             </div>
             <div class="card-body">
               <div class="message_section" style="display: none"></div>
                  <section id="order_track_area">
                    
                  </section>
                   <form id="track_order" data-action="{{ route('customer.track_order') }}" method="post">
                     @csrf
                      <div class="col-md-12">
                          <!-- Input -->
                          <div class="js-form-message mb-4">
                              <label class="form-label">
                                 @lang('title.order_number')
                                  <span class="text-danger">*</span>
                              </label>
                              <input type="text" class="form-control" name="order_number" placeholder="@lang('title.order_number')">
                          </div>
                      </div>
                      <div class="col-md-12">
                          <!-- Input -->
                          <div class="js-form-message mb-4">
                              <button type="submit" class="btn btn-primary-dark-w px-5">@lang('title.track_order') <span class="spinner-border spinner-border-sm show_spinner" style="display: none"></span></button>
                          </div>
                          <!-- End Input -->
                      </div>
                   </form>
             </div>
           </div>
         </div>
      </div>
     </div>   
             
  </div>
@endsection

@section('extra_js')
<script src="{{ asset('assets/custom/js/datatable.js') }}"></script>
<script>
  $(document).ready(function(){
    $('#item_table').DataTable();
  });
</script>

@endsection