@extends('layouts.app')
@section('ecommerce_title','Ecommerce | Compare List')
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
                          <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">@lang('title.compare')</li>
                      </ol>
                  </nav>
              </div>
              <!-- End breadcrumb -->
          </div>
      </div>
    

      <div class="container comparelist-section">
        @if (count($comparelists)>0)
        
          <div class="table-responsive table-bordered table-compare-list mb-10 border-0">
              <table class="table">
                  <tbody>
                      <tr>
                          <th class="min-width-200">@lang('title.product_name')</th>
                        
                        @foreach ($comparelists as $comp_product)
                          <td>
                              <a href="{{ route('product.detail',$comp_product->product->slug) }}" class="product d-block">
                                  <div class="product-compare-image">
                                      <div class="d-flex mb-3">
                                          <img class="img-fluid mx-auto" src="{{ asset('assets/backend/image/product/small/'.$comp_product->product->thumbnail) }}" style="max-width: 300px;max-height
                                          250px" alt="Image Description">
                                      </div>
                                  </div>
                                  <h3 class="product-item__title text-blue font-weight-bold mb-3">{{$comp_product->product->name}}</h3>
                              </a>
                              <div class="text-warning mb-2">
                                  <small class="fas fa-star"></small>
                                  <small class="fas fa-star"></small>
                                  <small class="fas fa-star"></small>
                                  <small class="fas fa-star"></small>
                                  <small class="fas fa-star"></small>
                              </div>
                          </td>
                       @endforeach
                      </tr>
                      <tr>
                          <th>@lang('title.price')</th>
                           @foreach ($comparelists as $comp_price)
                          <td>
                              <div class="product-price">{{currency()}}{{number_format($comp_price->product->current_price,2)}}</div>
                          </td>
                         @endforeach
                      </tr>
                      <tr>
                          <th>@lang('title.availability')</th>
                           @foreach ($comparelists as $comp_stock)
                              <td><span>{{count($comp_stock->product->checkStocks)>0 ? count($comp_stock->product->checkStocks). __('title.in_stock') : __('title.stock_out')}}</span>
                            @endforeach
                          </td>
                      </tr>

                      <tr>
                          <th>@lang('title.brand')</th>
                          @foreach ($comparelists as $comp_brand)
                            <td>{{$comp_brand->product->brand->brand_name}}</td>
                          @endforeach
                      </tr>

                      <tr>
                          <th>@lang('title.color')</th>
                          @foreach ($comparelists as $comp_color)
                            <td>@foreach ($comp_color->product->checkStocks as $stock)
                                <span style="background: {{$stock->color->color_code}};color:{{$stock->color->color_code}}">Color</span>
                            @endforeach</td>
                          @endforeach
                      </tr>

                       <tr>
                          <th>@lang('title.size')</th>
                          @foreach ($comparelists as $comp_size)
                            <td>@foreach ($comp_size->product->checkStocks as $stock)
                                <span>{{$stock->size->size}},</span>
                            @endforeach</td>
                          @endforeach
                      </tr>

                      <tr>
                          <th>@lang('title.description')</th>
                          @foreach ($comparelists as $comp_des)
                          <td>
                              <div class="text-justify">
                                  {!!$comp_des->product->description!!}
                              </div>
                          </td>
                          @endforeach
                      </tr>

                      <tr>
                          <th>@lang('title.add_to_cart')</th>
                          @foreach ($comparelists as $comp_cart)
                          <td>
                              <div class=""><a href="{{ route('product.detail',$comp_cart->product->slug) }}" class="btn btn-soft-secondary mb-3 mb-md-0 font-weight-normal px-5 px-md-3 px-xl-5">@lang('title.add_to_cart')</a></div>
                          </td>
                        @endforeach
                      </tr>

                      <tr>
                          <th>@lang('title.delete')</th>
                           @foreach ($comparelists as $comp_remove)
                          <td class="text-center comparelist_row{{$comp_remove->id}}">
                              <a href="javascript:;" class="text-gray-90 delete_comparelist" data-action="{{ route('delete.comparelist') }}" comparelist_id="{{$comp_remove->id}}"><i class="fa fa-times"></i></a>
                          </td>
                         @endforeach
                      </tr>
                  </tbody>
              </table>
          </div>
          @else
          <h4 class="text-center">@lang('title.no_data')</h4>
        @endif
      </div>
@endsection

@section('extra_js')

@endsection