@extends('layouts.app')
@section('ecommerce_title','Ecommerce | Wishlist')
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
                         <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ route('home.page') }}">@lang('menu.home')</a></li>
                         <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">@lang('title.add_to_Wishlist')</li>
                     </ol>
                 </nav>
             </div>
             <!-- End breadcrumb -->
         </div>
     </div>
     <!-- End breadcrumb -->

     <div class="container">
         <div class="my-6">
             <h1 class="text-center">@lang('title.add_to_Wishlist')</h1>
         </div>
         <div class="mb-16 wishlist-table wishlist-section">
              @if (count($wishlists)>0)
                 <div class="table-responsive">
                     <table class="table" cellspacing="0">
                         <thead>
                             <tr>
                                 <th class="product-remove">&nbsp;</th>
                                 <th class="product-thumbnail">&nbsp;</th>
                                 <th class="product-name">@lang('title.product_name')</th>
                                 <th class="product-price">@lang('title.unit_price')</th>
                                 <th class="product-Stock w-lg-15">@lang('title.stock_status')</th>
                                 <th class="product-subtotal min-width-200-md-lg">&nbsp;</th>
                             </tr>
                         </thead>
                         <tbody>
                            @foreach ($wishlists as $wishlist)
                                
                             <tr class="wishlist_row{{$wishlist->id}}">
                                 <td class="text-center">
                                     <a href="javascript:void(0)" class="text-gray-32 font-size-26 delete_wishlist" data-action="{{ route('delete.wishlist') }}" wishlist_id="{{$wishlist->id}}">×</a>
                                 </td>
                                 <td class="d-none d-md-table-cell">
                                     <a href="{{ route('product.detail',$wishlist->product->slug) }}"><img class="img-fluid max-width-100 p-1 border border-color-1" src="{{ asset('assets/backend/image/product/small/'.$wishlist->product->thumbnail) }}" alt="Image Description"></a>
                                 </td>

                                 <td data-title="Product">
                                     <a href="{{ route('product.detail',$wishlist->product->slug) }}" class="text-gray-90">{{$wishlist->product->name}}</a>
                                 </td>

                                 <td data-title="Unit Price">
                                     <span class="">{{currency()}}{{number_format($wishlist->product->current_price,2)}}</span>
                                 </td>

                                 <td data-title="Stock Status">
                                     <!-- Stock Status -->
                                     <span class="badge {{count($wishlist->product->checkStocks)>0 ? 'badge-success' : 'badge-warning'}} ">{{count($wishlist->product->checkStocks)>0 ? __('title.in_stock') : __('title.stock_out')}}</span>
                                     <!-- End Stock Status -->
                                 </td>

                                 <td>
                                     <a href="{{ route('product.detail',$wishlist->product->slug) }}" class="btn btn-soft-secondary mb-3 mb-md-0 font-weight-normal px-5 px-md-4 px-lg-5 w-100 w-md-auto">@lang('title.add_to_cart')</a>
                                 </td>
                             </tr>
                             @endforeach
                         </tbody>
                     </table>
                 </div>
                 @else 
                 <h4 class="text-center">No product added to your wishlist</h4>
             @endif
         </div>
     </div>
      
@endsection

@section('extra_js')

@endsection