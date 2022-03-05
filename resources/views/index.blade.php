@extends('layouts.app')
@section('ecommerce_title','Ecommerce | Home')
@section('main_content')
	      <!-- Slider Section -->
	       @include('user.files.slider')
	      <!-- End Slider Section -->
	      <div class="container">
	          <!-- Banner -->
	          @include('user.files.top_banner')
	          <!-- End Banner -->
	          <!-- Deals-and-tabs -->
	          @include('user.files.deal_tab')
	          <!-- End Deals-and-tabs -->
	      </div>
	      <!-- Products-4-1-4 -->
	     
	      <!-- End Products-4-1-4 -->
	      <div class="container">
	          <!-- Prodcut-cards-carousel -->
	          @include('user.files.best_seller')
	          <!-- End Prodcut-cards-carousel -->
	          <!-- Full banner -->
	          {{--  @include('user.files.full_banner') --}}
	          <!-- End Full banner -->
	          <!-- Recently viewed -->
	           @include('user.files.recent_view')
	          <!-- End Recently viewed -->
	          <!-- Brand Carousel -->
	          @include('user.files.brand_carousel')
	          <!-- End Brand Carousel -->
	      </div>
@endsection