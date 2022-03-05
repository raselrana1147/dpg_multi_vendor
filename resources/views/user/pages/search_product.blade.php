@extends('layouts.app')
@section('ecommerce_title','Ecommerce | Search Products')
@section('main_content')
	<div class="bg-gray-13 bg-md-transparent">
	    <div class="container">
	        <!-- breadcrumb -->
	        <div class="my-md-3">
	            <nav aria-label="breadcrumb">
	                <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
	                    <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ route('home.page') }}">@lang('menu.home')</a></li>
	                    <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">@lang('title.you_have_searched') {{$data['search_key']}}</li>
	                </ol>
	            </nav>
	        </div>
	        <!-- End breadcrumb -->
	    </div>
	</div>
	<!-- End breadcrumb -->

	<div class="container">
	    <div class="mb-6">
	        <div class="d-flex justify-content-between align-items-center border-bottom border-color-1 flex-lg-nowrap flex-wrap mb-4">
	            <h3 class="section-title section-title__full mb-0 pb-2 font-size-22">@lang('title.you_have_searched') {{$data['search_key']}}</h3>
	        </div>
	        <ul class="row list-unstyled products-group no-gutters mb-6 sell_search_product" page_num_search="1" category_id="{{$data['category_id']}}" search_key="{{$data['search_key']}}">
	        
	        </ul>
	        <div class="load_more_section d-flex justify-content-center" >
	            <p class="no_more_data" style="display: none"></p>
	            <button id="load_more" class="button" style="background: yellow;border: none;padding: 8px;border-radius: 15px;">@lang('title.load_more')</button>
	        </div>
	        <!-- People buying in this category -->
	        <div class="position-relative">
	            <div class="border-bottom border-color-1 mb-2">
	                <h3 class="section-title section-title__full d-inline-block mb-0 pb-2 font-size-22">@lang('title.customer_buying')</h3>
	            </div>
	            <div class="js-slick-carousel u-slick position-static overflow-hidden u-slick-overflow-visble pb-7 pt-2 px-1"
	                data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-3 mt-md-0"
	                data-slides-show="6"
	                data-slides-scroll="1"
	                data-arrows-classes="position-absolute top-0 font-size-17 u-slick__arrow-normal top-10"
	                data-arrow-left-classes="fa fa-angle-left right-1"
	                data-arrow-right-classes="fa fa-angle-right right-0"
	                data-responsive='[{
	                  "breakpoint": 1400,
	                  "settings": {
	                    "slidesToShow": 5
	                  }
	                }, {
	                    "breakpoint": 1200,
	                    "settings": {
	                      "slidesToShow": 3
	                    }
	                }, {
	                  "breakpoint": 992,
	                  "settings": {
	                    "slidesToShow": 3
	                  }
	                }, {
	                  "breakpoint": 768,
	                  "settings": {
	                    "slidesToShow": 2
	                  }
	                }, {
	                  "breakpoint": 554,
	                  "settings": {
	                    "slidesToShow": 2
	                  }
	                }]'>
	                <div class="js-slide products-group">
	                    <div class="product-item">
	                        <div class="product-item__outer h-100">
	                            <div class="product-item__inner px-wd-4 p-2 p-md-3">
	                                <div class="product-item__body pb-xl-2">
	                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
	                                    <h5 class="mb-1 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
	                                    <div class="mb-2">
	                                        <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="{{asset('assets/frontend/assets/img/212X200/img1.jpg')}}" alt="Image Description"></a>
	                                    </div>
	                                    <div class="flex-center-between mb-1">
	                                        <div class="prodcut-price">
	                                            <div class="text-gray-100">$685,00</div>
	                                        </div>
	                                        <div class="d-none d-xl-block prodcut-add-cart">
	                                            <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="product-item__footer">
	                                    <div class="border-top pt-2 flex-center-between flex-wrap">
	                                        <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
	                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	         
	            </div>
	        </div>
	        <!-- End People buying in this category -->
	    </div>
	    <!-- Brand Carousel -->
	    @include('user.files.brand_carousel')
	    <!-- End Brand Carousel -->
	</div>
@endsection