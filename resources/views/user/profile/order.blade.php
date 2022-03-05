@extends('layouts.app')
@section('ecommerce_title','Ecommerce | Checkout')
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
               @lang('title.order_list')
             </div>
             <div class="card-body">
               <table id="item_table" class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">Seial No #</th>
                      <th scope="col">Order Number</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Payment</th>
                      <th scope="col">Total Amount</th>
                      <th scope="col">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($orders as $order)
                    <tr>
                      <td>{{$loop->index+1}}</td>
                      <td>{{$order->order_number}}</td>
                      <td>{{$order->quantity}}</td>
                      <td>{{$order->payment_method}}</td>
                      <td>{{currency()}}{{number_format($order->grand_total,2)}}</td>
                      <td><span class="badge badge-danger">{{$order->status}}</span></td>
                    </tr>
                   @endforeach
                  </tbody>
               </table>
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