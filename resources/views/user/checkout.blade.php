@extends('layouts.app')
@section('ecommerce_title','Ecommerce | Checkout')
@section('main_content')
	   <div class="bg-gray-13 bg-md-transparent">
           <div class="container">
               <!-- breadcrumb -->
               <div class="my-md-3">
                   <nav aria-label="breadcrumb">
                       <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                           <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ route('home.page') }}">@lang('menu.home')</a></li>
                           <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">@lang('menu.checkout')</li>
                       </ol>
                   </nav>
               </div>
               <!-- End breadcrumb -->
           </div>
       </div>
       <!-- End breadcrumb -->

       <div class="container">
           <div class="mb-5">
               <h1 class="text-center">@lang("menu.checkout")</h1>
           </div>
          
           <form action="{{ route('submit.checkout') }}" method="post">
            @csrf
               <div class="row">
                   <div class="col-lg-5 order-lg-2 mb-7 mb-lg-0">
                       <div class="pl-lg-3 ">
                           <div class="bg-gray-1 rounded-lg">
                               <!-- Order Summary -->
                               <div class="p-4 mb-4 checkout-table">
                                   <!-- Title -->
                                   <div class="border-bottom border-color-1 mb-5">
                                       <h3 class="section-title mb-0 pb-2 font-size-25">@lang('title.your_order')</h3>
                                   </div>
                          
                                   <table class="table">
                                       <thead>
                                           <tr>
                                               <th class="product-name">@lang('title.product_name')</th>
                                               <th class="product-total">@lang('title.total')</th>
                                           </tr>
                                       </thead>
                                       <tbody>
                                          @foreach ($carts as $cart)
                                           <tr class="cart_item">
                                               <td><a href="{{ route('product.detail',$cart->product->slug) }}" style="color: #000">{{$cart->product->name}}</a> <strong class="product-quantity">× {{$cart->quantity}}</strong></td>
                                               <td>{{currency()}}{{number_format($cart->product->current_price,2)}}</td>
                                           </tr>
                                           @endforeach
                                       </tbody>
                                       <tfoot>
                                           <tr>
                                               <th>@lang('title.sub_total')</th>
                                               <td>{{currency()}}{{number_format($total_price,2)}}</td>
                                           </tr>
                                           <tr>
                                               <th>@lang('title.shipping_charge')</th>
                                               <td> {{currency()}}{{number_format(shipping_charge(),2)}}</td>
                                           </tr>

                                           <tr>
                                               <th>@lang('title.tax')</th>
                                               <td>Flat rate {{currency()}}{{number_format(tax(),2)}}</td>
                                           </tr>
                                           <tr>
                                               <th>@lang('title.grand_total')</th>
                                               <td><strong>{{currency()}}{{number_format($grand_total,2)}}</strong></td>
                                           </tr>
                                       </tfoot>
                                   </table>
                                   <!-- End Product Content -->
                                   <div class="border-top border-width-3 border-color-1 pt-3 mb-3">
                                       <!-- Basics Accordion -->
                                       <div id="basicsAccordion1">
                                           <!-- Card -->
                                           <div class="border-bottom border-color-1 border-dotted-bottom">
                                               <div class="p-3" id="basicsHeadingOne">
                                                   <div class="custom-control custom-radio">
                                                       <input type="radio" class="custom-control-input" id="stylishRadio1" name="payment_method" value="cash on delivery" required="">
                                                       <label class="custom-control-label form-label" for="stylishRadio1"
                                                           data-toggle="collapse"
                                                           data-target="#basicsCollapseOnee"
                                                           aria-expanded="true"
                                                           aria-controls="basicsCollapseOnee">
                                                           Cash On Delivery
                                                       </label>
                                                   </div>
                                               </div>
                                               <div id="basicsCollapseOnee" class="collapse border-top border-color-1 border-dotted-top bg-dark-lighter"
                                                   aria-labelledby="basicsHeadingOne"
                                                   data-parent="#basicsAccordion1">
                                                   <div class="p-4">
                                                       Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.
                                                   </div>
                                               </div>
                                           </div>
                                           
                                       </div>
                                       <!-- End Basics Accordion -->
                                   </div>
                                   <button type="submit" class="btn btn-primary-dark-w btn-block btn-pill font-size-20 mb-3 py-3">@lang('title.proceed_to_checkout')</button>
                               </div>
                               <!-- End Order Summary -->
                           </div>
                       </div>
                   </div>

                   <div class="col-lg-7 order-lg-1">
                       <div class="pb-7 mb-7">
                           <!-- Title -->
                           <div class="border-bottom border-color-1 mb-5">
                               <h3 class="section-title mb-0 pb-2 font-size-25">@lang('title.billing_detail')</h3>
                           </div>
                           <!-- End Title -->

                           <!-- Billing Form -->
                           <div class="row">
                               <div class="col-md-6">
                                   <!-- Input -->
                                   <div class="js-form-message mb-6">
                                       <label class="form-label">
                                           @lang('title.first_name')
                                           <span class="text-danger">*</span>
                                       </label>
                                       <input type="text" class="form-control" name="fname" placeholder="@lang('title.enter_first_name')"  required="" value="{{Auth::user()->first_name}}">
                                   </div>
                                   <!-- End Input -->
                               </div>

                               <div class="col-md-6">
                                   <!-- Input -->
                                   <div class="js-form-message mb-6">
                                       <label class="form-label">
                                           @lang('title.last_name')
                                           <span class="text-danger">*</span>
                                       </label>
                                       <input type="text" class="form-control" name="lname" placeholder="@lang('title.enter_last_name')" required="" value="{{Auth::user()->last_name}}">
                                   </div>
                                   <!-- End Input -->
                               </div>

                               <div class="w-100"></div>

                               

                               <div class="col-md-12">
                                   <!-- Input -->
                                   <div class="js-form-message mb-6">
                                       <label class="form-label">
                                           @lang('title.country')
                                           <span class="text-danger">*</span>
                                       </label>
                                       <select class="form-control js-select selectpicker dropdown-select" required="" 
                                           data-live-search="true" name="country">
                                           <option value="">@lang('title.select_country')</option>
                                           <option value="Bangladesh">Bangladesh</option>
                                       </select>
                                   </div>
                                   <!-- End Input -->
                               </div>

 
                               <div class="col-md-12">
                                   <!-- Input -->
                                   <div class="js-form-message mb-6">
                                       <label class="form-label">
                                           @lang('title.city')
                                           <span class="text-danger">*</span>
                                       </label>
                                       <select class="form-control js-select selectpicker dropdown-select" required="" 
                                           data-live-search="true"
                                            name="city">
                                           <option value="">@lang('title.select_city')</option>
                                           <option value="Dhaka">Dhaka</option>
                                           <option value="Chittagong">Chittagong</option>
                                           <option value="Rajsgahi">Rajsgahi</option>
                                           <option value="Barishal">Barishal</option>
                                           <option value="Khulna">Khulna</option>
                                           <option value="Rangpur">Rangpur</option>
                                           <option value="Mymensing">Mymensing</option>
                                           <option value="Sylhet">Sylhet</option>
                                       </select>
                                   </div>
                                   <!-- End Input -->
                               </div>

                               <div class="col-md-12">
                                   <!-- Input -->
                                   <div class="js-form-message mb-6">
                                       <label class="form-label">
                                           @lang('title.postcode')
                                           <span class="text-danger">*</span>
                                       </label>
                                       <input type="text" class="form-control" name="postcode" placeholder="@lang('title.enter_postcode')"  required="">
                                   </div>
                                   <!-- End Input -->
                               </div>

                               <div class="w-100"></div>

                               <div class="col-md-6">
                                   <!-- Input -->
                                   <div class="js-form-message mb-6">
                                       <label class="form-label">
                                           @lang('title.email')
                                           <span class="text-danger">*</span>
                                       </label>
                                       <input type="email" class="form-control" name="email" placeholder="@lang('title.enter_email')"  required="" value="{{Auth::user()->email}}">
                                   </div>
                                   <!-- End Input -->
                               </div>

                               <div class="col-md-6">
                                   <!-- Input -->
                                   <div class="js-form-message mb-6">
                                       <label class="form-label">
                                           @lang('title.phone')
                                       </label>
                                       <input type="text" class="form-control" placeholder="@lang('title.enter_phone')" name="phone" required="" value="{{Auth::user()->phone}}">
                                   </div>
                                   <!-- End Input -->
                               </div>

                               <div class="w-100"></div>
                           </div>
                           
                           <div class="js-form-message mb-6">
                               <label class="form-label">
                                   @lang('title.order_note')
                               </label>

                               <div class="input-group">
                                   <textarea class="form-control p-5" rows="4" name="order_note" placeholder="@lang('title.write_something')"></textarea>
                               </div>
                           </div>
                           <!-- End Input -->
                       </div>
                   </div>
               </div>
           </form>
       </div>
@endsection

@section('extra_js')

@endsection