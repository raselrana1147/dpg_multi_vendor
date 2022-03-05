@extends('layouts.app')
@section('ecommerce_title','Ecommerce | Detail')
@section('extra_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/style/css/custom.css') }}">
@endsection
@section('main_content')
	   <div class="bg-gray-13 bg-md-transparent">
           <div class="container">
               <!-- breadcrumb -->
               <div class="my-md-3">
                   <nav aria-label="breadcrumb">
                       <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                           <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="../home/index.html">@lang('menu.home')</a></li>
                           <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">@lang('title.cart')</li>
                       </ol>
                   </nav>
               </div>
               <!-- End breadcrumb -->
           </div>
       </div>
       <!-- End breadcrumb -->

       <div class="container">
           <div class="mb-4">
               <h1 class="text-center">@lang('title.cart')</h1>
           </div>

           <div class="cart-section">
            @if (count($carts)>0)
             <div class="mb-10 cart-table">
                     <table class="table" cellspacing="0">
                         <thead>
                             <tr>
                                 <th class="product-remove">&nbsp;</th>
                                 <th class="product-thumbnail">&nbsp;</th>
                                 <th class="product-name">@lang('title.product_name')</th>
                                 <th class="product-price">@lang('title.price')</th>
                                 <th class="product-quantity w-lg-15">@lang('title.quantity')</th>
                                 <th class="product-subtotal">@lang('title.total')</th>
                             </tr>
                         </thead>
                         <tbody>
                          @foreach ($carts as $cart)
                            {{-- expr --}}
                         
                             <tr class="cart_row{{$cart->id}}">
                                 <td class="text-center">
                                     <a href="javascript:void(0)" class="text-gray-32 font-size-26 delete_cart" cart_id="{{$cart->id}}" data-action="{{route('delete.cart')}}">×</a>
                                 </td>
                                 <td class="d-none d-md-table-cell">
                                     <a href="{{ route('product.detail',$cart->product->slug)}}"><img class="img-fluid max-width-100 p-1 border border-color-1" src="{{ asset('assets/backend/image/product/small/'.$cart->product->thumbnail) }}" alt="Image Description"></a>
                                 </td>

                                 <td data-title="Product">
                                     <a href="{{ route('product.detail',$cart->product->slug)}}" class="text-gray-90">{{$cart->product->name}}</a><br>
                                     <span>@lang('title.color'): {{$cart->color->color_name}} <span style="background: {{$cart->color->color_code}};color: {{$cart->color->color_code}}">@lang('title.color')</span></span><br>
                                      <span>@lang('title.size'): {{$cart->size->size}} </span>
                                 </td>

                                 <td data-title="Price">
                                     <span class="">{{currency()}}{{number_format($cart->product->current_price,2)}}</span>
                                 </td>

                                 <td data-title="Quantity">
                                     <span class="sr-only">Quantity</span>
                                     <!-- Quantity -->
                                     <div class="border rounded-pill py-1 width-122 w-xl-80 px-3 border-color-1">
                                         <div class="js-quantity row align-items-center">
                                             <div class="col">
                                                 <input class="js-result form-control h-auto border-0 rounded p-0 shadow-none update_cart" type="number" value="{{$cart->quantity}}" min="1" step="1" cart_id="{{$cart->id}}" color_id="{{$cart->color_id}}" size_id="{{$cart->size_id}}" product_id="{{$cart->product_id}}"data-action="{{ route('update.cart') }}" >
                                             </div>
                                             
                                         </div>
                                     </div>
                                     
                                 </td>

                                 <td data-title="Total">
                                     <span class="">
                                       {{currency()}} <span class="each_cart_price{{$cart->id}}">{{number_format($cart->product->current_price*$cart->quantity,2)}}</span>
                                    </span>
                                 </td>
                             </tr>
                             @endforeach

                             <tr>
                                 <td colspan="6" class="border-top space-top-2 justify-content-center">
                                     <div class="pt-md-3">
                                         <div class="d-block d-md-flex flex-center-between">
                                             <div class="mb-3 mb-md-0 w-xl-40">
                                                 <!-- Apply coupon Form -->
                                                 <form class="js-focus-state">
                                                     <label class="sr-only" for="subscribeSrEmailExample1">@lang('title.coupon_code')</label>
                                                     <div class="input-group">
                                                         <input type="text" class="form-control" name="text" id="subscribeSrEmailExample1" placeholder="@lang('title.coupon_code')" aria-label="Coupon code" aria-describedby="subscribeButtonExample2" required>
                                                         <div class="input-group-append">
                                                             <button class="btn btn-block btn-dark px-4" type="button" id="subscribeButtonExample2"><i class="fas fa-tags d-md-none"></i><span class="d-none d-md-inline">@lang('title.apply_coupon')</span></button>
                                                         </div>
                                                     </div>
                                                 </form>
                                                 <!-- End Apply coupon Form -->
                                             </div>
                                             <div class="d-md-flex">
                                                 <a  href="{{ route('home.page') }}" class="btn btn-soft-secondary mb-3 mb-md-0 font-weight-normal px-5 px-md-4 px-lg-5 w-100 w-md-auto">@lang('title.continue_shoping')</a>
                                                 <a href="{{ route('checkout') }}" class="btn btn-primary-dark-w ml-md-2 px-5 px-md-4 px-lg-5 w-100 w-md-auto d-none d-md-inline-block">@lang('title.proceed_to_checkout')</a>
                                             </div>
                                         </div>
                                     </div>
                                 </td>
                             </tr>
                             
                         </tbody>
                     </table>
                
             </div>
             <div class="mb-8 cart-total-section">
                 <div class="row">
                     <div class="col-xl-5 col-lg-6 offset-lg-6 offset-xl-7 col-md-8 offset-md-4">
                         <div class="border-bottom border-color-1 mb-3">
                             <h3 class="d-inline-block section-title mb-0 pb-2 font-size-26">@lang('title.total_cart')</h3>
                         </div>
                         <table class="table mb-3 mb-md-0">
                             <tbody>
                                 <tr class="cart-subtotal">
                                     <th>@lang('title.sub_total')</th>
                                     <td data-title="Subtotal"><span class="amount">{{currency()}} <span class="sub_total">{{$total_price}}</span></span></td>
                                 </tr>

                                 <tr class="cart-subtotal">
                                     <th>@lang('title.tax')</th>
                                     <td data-title="Subtotal"><span class="amount">{{currency()}} {{number_format(tax(),2)}}</span></td>
                                 </tr>
                                 <tr class="shipping">
                                     <th>@lang('title.shipping_charge')</th>
                                     <td data-title="Shipping">
                                         Flat Rate: <span class="amount">{{currency()}} <span class="shipping_charge">{{shipping_charge()}}</span></span>
                                         <div class="mt-1">
                                             <a class="font-size-12 text-gray-90 text-decoration-on underline-on-hover font-weight-bold mb-3 d-inline-block" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                 @lang('title.shipping_calculating')
                                             </a>
                                             <div class="collapse mb-3" id="collapseExample">
                                                 <div class="form-group mb-4">
                                                     <select class="js-select selectpicker dropdown-select right-dropdown-0-all w-100"
                                                         data-style="bg-white font-weight-normal border border-color-1 text-gray-20">
                                                         <option value="">Select a country…</option>
                                                        
                                                     </select>
                                                 </div>
                                                 <div class="form-group mb-4">
                                                     <select class="js-select selectpicker dropdown-select right-dropdown-0-all w-100"
                                                         data-style="bg-white font-weight-normal border border-color-1 text-gray-20">
                                                         <option value="">Select an option…</option>
                                                        
                                                     </select>
                                                 </div>
                                                 <input class="form-control mb-4" type="text" placeholder="Postcode / ZIP">
                                                 <button type="button" class="btn btn-soft-secondary mb-3 mb-md-0 font-weight-normal px-5 px-md-4 px-lg-5 w-100 w-md-auto">Update Totals</button>
                                             </div>
                                         </div>
                                     </td>
                                 </tr>
                                 <tr class="order-total">
                                     <th>@lang('title.grand_total')</th>
                                     <td data-title="Total"><strong><span class="amount">{{currency()}}<span class="grand_total">{{number_format($grand_total)}}</span></span></strong></td>
                                 </tr>
                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>
             @else
             <h4 class="text-center">Empty Cart</h4>
             @endif
           </div>
       </div>    
            
@endsection

@section('extra_js')

@endsection