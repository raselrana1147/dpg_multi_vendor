@extends('layouts.app')
@section('ecommerce_title','Ecommerce | Checkout')
@section('extra_css')
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/custom/css/invoice.css') }}">
@endsection
@section('main_content')
	   <div class="bg-gray-13 bg-md-transparent">
           <div class="container">
               <!-- breadcrumb -->
               <div class="my-md-3">
                   <nav aria-label="breadcrumb">
                       <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                           <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ route('home.page') }}">@lang('menu.home')</a></li>
                           <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">@lang('title.order_placement')</li>
                       </ol>
                   </nav>
               </div>
               <!-- End breadcrumb -->
           </div>
       </div>
       <!-- End breadcrumb -->

       <div class="container">
           <div class="mb-5">
               <h1 class="text-center">@lang('title.order_placement')</h1>
               <div id="shopCartHeadingOne" class="alert alert-primary mb-0" role="alert">
                   @lang('title.placement_content')
                   <a href="{{ route('home.page') }}" class="alert-link">@lang('title.placement_content_link')</a>
              </div>
          </div>
                

              <div class="invoice-wrapper">
                   <div class="pl-lg-3 invoice-area">
                           <div class="brand-section bg-warning">
                               <div class="row">
                                   <div class="col-6">
                                       <img src="{{ asset('assets/backend/image/logo/'.logo()) }}">
                                   </div>
                                   <div class="col-6">
                                       <div class="company-details">
                                           <p class="text-white">{{company_address()}}</p>
                                           <p class="text-white">{{company_email()}}</p>
                                           <p class="text-white">{{company_phone()}}</p>
                                       </div>
                                   </div>
                               </div>
                           </div>

                           <div class="body-section">
                               <div class="row">
                                   <div class="col-6">
                                    @php
                                      $billing=json_decode($order->shipping_detail);

                                    @endphp
                                       <h2 class="heading">Order Number.: {{$order->order_number}}</h2>
                                      
                                       <p class="sub-heading">Order Date: {{date("d-m-Y")}}s </p>
                                       <p class="sub-heading">Email Address: {{$billing->email}}  </p>
                                   </div>
                                   <div class="col-6">
                                       <p class="sub-heading">Full Name: {{$billing->fname." ".$billing->lname}} </p>
                                       <p class="sub-heading">Address: {{$billing->address}} </p>
                                       <p class="sub-heading">Phone Number:  {{$billing->phone}}</p>
                                       <p class="sub-heading">{{$billing->city}},{{$billing->postcode}}  </p>
                                   </div>
                               </div>
                           </div>

                           <div class="body-section">
                               <h3 class="heading">Ordered Items</h3>
                               <br>
                               <table class="table-bordered">
                                   <thead>
                                       <tr>
                                           <th>Image</th>
                                           <th>Product</th>
                                           <th class="w-20">Price</th>
                                           <th class="w-20">Quantity</th>
                                           <th class="w-20">Total</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                  @foreach ($orders as $cart)
                                       <tr>
                                           <td><img src="{{ asset('assets/backend/image/product/small/'.$cart->product->thumbnail) }}" style="width: 70px;height: 60px"></td>
                                           <td>
                                            <span>{{$cart->product->name}}</span><br>
                                             <span>Size: {{$cart->size->size}}</span><br>
                                             <span style="background: {{$cart->color->color_code}};color: {{$cart->color->color_code}}">Color</span>
                                           </td>
                                            <td>{{currency()}}{{number_format($cart->product->current_price,2)}}</td>
                                            <td>{{$cart->product_quantity}}</td>
                                           <td>{{currency()}}{{number_format($cart->product_quantity*$cart->product->current_price,2)}}</td>
                                       </tr>
                                       @endforeach
                                       
                                       <tr>
                                           <td colspan="4" class="text-right">Sub Total</td>
                                           <td>{{currency()}}{{number_format($order->sub_total,2)}}</td>
                                       </tr>
                                       <tr>
                                           <td colspan="4" class="text-right">Tax Total</td>
                                           <td>{{currency()}}{{number_format($order->tax,2)}}</td>
                                       </tr>
                                       <tr>
                                           <td colspan="4" class="text-right">Shipping</td>
                                           <td>{{currency()}}{{number_format($order->shipping_charge,2)}}</td>
                                       </tr>
                                       <tr>
                                           <td colspan="4" class="text-right">Grand Total</td>
                                           <td>{{currency()}}{{number_format($order->grand_total,2)}}</td>
                                       </tr>
                                   </tbody>
                               </table>
                               <br>
                               <h3 class="heading">Order Status: {{$order->status}}</h3>
                               <h3 class="heading">Payment Status: {{$order->payment_method}}</h3>
                           </div>

                           <div class="body-section">
                               <p>{{copyright()}}
                                   <a href="#" class="float-right">DPG Market Place</a>
                               </p>
                           </div>      
                    
                </div>
            </div>
@endsection
