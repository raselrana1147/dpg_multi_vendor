@extends('layouts.app')
@section('ecommerce_title','Ecommerce | Checkout')
@section('main_content')
  <div class="container">
            
      <div class="row m-5">
         <div class="col-4">
            <div class="card">
              <div class="card-header bg-warning header-title">
                <span><i class="fas fa-bars pr-1"></i>@lang('title.menu')</span>
              </div>
              @include('user.profile.sidebar')
            </div>
         </div>

         <div class="col-8">
           <div class="card">
             <div class="card-header bg-warning header-title">
               @lang('title.dashboard')
             </div>
             <div class="card-body">
               <h5 class="card-title">Welcome To Dashboard panel</h5>
              
               
             </div>
           </div>
         </div>
          
      </div>
             
  </div>
@endsection

@section('extra_js')

@endsection