@extends('layouts.app')
@section('ecommerce_title','Ecommerce | Detail')
@section('extra_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/style/css/custom.css') }}">
@endsection
@section('main_content')
	       <!-- breadcrumb -->
            <div class="bg-gray-13 bg-md-transparent">
                <div class="container">
                    <!-- breadcrumb -->
                    <div class="my-md-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ route('home.page') }}">@lang('menu.home')</a></li>
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ route('product.category_wise',$product->category_id) }}">{{$product->category->category_name}}</a></li>
                                @if (!is_null($product->sub_category_id))
                                    <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ route('product.category_wise',$product->sub_category_id) }}">{{$product->sub_category->category_name}}</a></li>
                                @endif

                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">{{$product->name}}</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- End breadcrumb -->
                </div>
            </div>
            <!-- End breadcrumb -->
            <div class="container">
                <!-- Single Product Body -->
                <div class="mb-xl-14 mb-6">
                    <div class="row">
                        <div class="col-md-5 mb-4 mb-md-0">
                            <div id="sliderSyncingNav" class="js-slick-carousel u-slick mb-2"
                                data-infinite="true"
                                data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-classic u-slick__arrow-centered--y rounded-circle"
                                data-arrow-left-classes="fas fa-arrow-left u-slick__arrow-classic-inner u-slick__arrow-classic-inner--left ml-lg-2 ml-xl-4"
                                data-arrow-right-classes="fas fa-arrow-right u-slick__arrow-classic-inner u-slick__arrow-classic-inner--right mr-lg-2 mr-xl-4"
                                data-nav-for="#sliderSyncingThumb">

                            <div class="js-slide">
                                <img data-zoom-image=" {{ asset('assets/backend/image/product/small/'.$product->thumbnail) }}" class="img-fluid" src="{{ asset('assets/backend/image/product/small/'.$product->thumbnail) }} " alt="Image Description">
                            </div>
                        
                            @foreach ($product->galleries as $gallery)
                                <div class="js-slide">
                                    <img class="img-fluid" src="{{ asset('assets/backend/image/gallery/small/'.$gallery->image) }}" alt="Image Description">
                                </div>
                            @endforeach
                              
                            </div>

                            <div id="sliderSyncingThumb" class="js-slick-carousel u-slick u-slick--slider-syncing u-slick--slider-syncing-size u-slick--gutters-1 u-slick--transform-off"
                                data-infinite="true"
                                data-slides-show="5"
                                data-is-thumbs="true"
                                data-nav-for="#sliderSyncingNav">
                                <div class="js-slide">
                                     <img class="img-fluid" src="{{ asset('assets/backend/image/product/small/'.$product->thumbnail) }}" alt="Image Description">
                                </div>
                                @foreach ($product->galleries as $gallery)
                                <div class="js-slide" style="cursor: pointer;">
                                    <img class="img-fluid" src="{{ asset('assets/backend/image/gallery/small/'.$gallery->image) }}" alt="Image Description">
                                </div>
                               @endforeach
                            </div>
                        </div>
                        <div class="col-md-7 mb-md-6 mb-lg-0">
                            <div class="mb-2">
                                <div class="border-bottom mb-3 pb-md-1 pb-3">
                                    <a href="#" class="font-size-12 text-gray-5 mb-2 d-inline-block">{{$product->category->category_name}}</a>
                                    <h2 class="font-size-25 text-lh-1dot2">{{$product->name}}</h2>
                                    
                                    <div class="mb-2">

                                        <a class="d-inline-flex align-items-center small font-size-15 text-lh-1" href="#">
                                            <div class="text-warning mr-2">
                                                @for ($i = 0; $i <5 ; $i++)
                                                    @if ($i<$max_ratting)
                                                        <small class="fas fa-star"></small>
                                                    @else
                                                    <small class="far fa-star text-muted"></small>
                                                    @endif
                                                @endfor
                                            </div>
                                             <span class="text-secondary font-size-13">({{$max_ratting}} @lang('title.customer_review'))</span>
                                        </a>

                                    </div>


                                    <div class="d-md-flex align-items-center">
                                        <a href="{{ route('home.page') }}" class="max-width-150 ml-n2 mb-2 mb-md-0 d-block"><img class="img-fluid" src="{{ asset('assets/backend/image/product/small/'.$product->thumbnail) }}" alt="Image Description" style="max-height: 70px"></a>
                                        <div class="ml-md-3 text-gray-9 font-size-14">Availability:
                                            @if (count($stock_check)>0)
                                                <span class="text-green font-weight-bold">Stocks {{$stock_check->sum('quantity')}}</span>
                                            @else
                                            <span class="text-red font-weight-bold">@lang('title.stock_out')</span>
                                            @endif
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-horizontal-center flex-wrap mb-4">
                                    <a href="#" class="text-gray-6 font-size-13 mr-2"><i class="ec ec-favorites mr-1 font-size-15"></i>@lang('title.add_to_Wishlist')</a>
                                    <a href="#" class="text-gray-6 font-size-13 ml-2"><i class="ec ec-compare mr-1 font-size-15"></i> @lang('title.compare')</a>
                                </div>
                            
                                <p><strong>SKU</strong>: FW511948218</p>
                                <div class="mb-4">
                                    <div class="d-flex align-items-baseline">
                                        <ins class="font-size-36 text-decoration-none">{{currency()}}{{number_format($product->current_price, 2)}}
                                            </ins>
                                        @if ($product->current_price>$product->previous_price)
                                            <del class="font-size-20 ml-2 text-gray-6">{{currency()}}
                                                {{number_format($product->previous_price, 2)}}</del>
                                        @endif
                                        
                                    </div>
                                </div>
   
                               <form id="submit_cart_form" data-action="{{ route('add_to_cart') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                {{-- @if (count($stock_check)>0) --}}
                                <div class="border-top border-bottom py-3 mb-4">
                                    <h6 class="font-size-14 mb-2"><strong>@lang('title.color')</strong></h6>
                                    <div class="d-flex align-items-center">
                                        <div class="colors">
                                          <ul>
                                            @foreach ($stocks as $stock)
                                            <li >
                                              <label>
                                                <input type="radio" name="color_id" class="find_all_size" value="{{$stock->color_id}}" data-action="{{ route('find_size') }}">
                                                <span class="swatch" style="background-color:{{$stock->color->color_code}}">
                                                </span> {{$stock->color->color_name}}
                                              </label>
                                            </li>
                                             @endforeach
                                          </ul> 
                                        </div>
                                    </div>
                                    
                                    <div class="colors">
                                      <ul class="load_size">

                                      </ul> 
                                    </div> 
                                </div>
                                {{--  @endif --}}

                               <div class="d-md-flex align-items-end mb-3">
                                   <div class="max-width-150 mb-4 mb-md-0">
                                       <h6 class="font-size-14">@lang('title.quantity')</h6>
                                       <!-- Quantity -->
                                       <div class="border rounded-pill border-color-1">
                                           <div class="js-quantity row align-items-center">
                                               <div class="col">
                                                  <select class="form-control load_quantity" name="quantity">
                                                    <option value="">@lang('title.quantity')</option>
                                                  </select>
                                               </div>
                                               
                                           </div>
                                       </div>
                                       <!-- End Quantity -->
                                   </div>
                                   <div class="ml-md-3">
                                      @if (count($stock_check)>0)
                                        <button type="submit" class="btn px-5 btn-primary-dark transition-3d-hover"><i class="ec ec-add-to-cart mr-2 font-size-20"></i>@lang('title.add_to_cart')</button>

                                        @else
                                        <button type="button" class="btn px-5 btn-primary-dark transition-3d-hover"><i class="ec ec-add-to-cart mr-2 font-size-20"></i>@lang('title.stock_out')</button>
                                      @endif
                                      
                                   </div>
                               </div>
                               </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Product Body -->
                <!-- Single Product Tab -->
                <div class="mb-8">
                    <div class="position-relative position-md-static px-md-6">
                        <ul class="nav nav-classic nav-tab nav-tab-lg justify-content-xl-center flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble border-0 pb-1 pb-xl-0 mb-n1 mb-xl-0" id="pills-tab-8" role="tablist">
                          
                            <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                                <a class="nav-link active" id="Jpills-two-example1-tab" data-toggle="pill" href="#Jpills-two-example1" role="tab" aria-controls="Jpills-two-example1" aria-selected="false">@lang('title.description')</a>
                            </li>
                            <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                                <a class="nav-link" id="Jpills-three-example1-tab" data-toggle="pill" href="#Jpills-three-example1" role="tab" aria-controls="Jpills-three-example1" aria-selected="false">@lang('title.specification')</a>
                            </li>

                            <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                                <a class="nav-link" id="Jpills-one-example1-tab" data-toggle="pill" href="#Jpills-one-example1" role="tab" aria-controls="Jpills-one-example1" aria-selected="false">@lang('title.return_policy')</a>
                            </li>

                            <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                                <a class="nav-link sell_all_review" id="Jpills-four-example1-tab" data-toggle="pill" href="#Jpills-four-example1" role="tab" aria-controls="Jpills-four-example1" aria-selected="false" product_id="{{$product->id}}" page_num_review="1">@lang('title.review')</a>
                            </li>
                        </ul>
                    </div>
                    <!-- Tab Content -->
                    <div class="borders-radius-17 border p-4 mt-4 mt-md-0 px-lg-10 py-lg-9">
                        <div class="tab-content" id="Jpills-tabContent">
                           
                            <div class="tab-pane fade active show" id="Jpills-two-example1" role="tabpanel" aria-labelledby="Jpills-two-example1-tab">
                              {!!$product->description!!}
                            </div>
                            <div class="tab-pane fade" id="Jpills-three-example1" role="tabpanel" aria-labelledby="Jpills-three-example1-tab">
                                <div class="mx-md-5 pt-1">
                                    
                                   {!!$product->specification!!}
                                    
                                </div>
                            </div>
                            <div class="tab-pane fade" id="Jpills-one-example1" role="tabpanel" aria-labelledby="Jpills-one-example1-tab">
                               
                               {!!$product->return_policy!!}
                            </div>

                             <div class="tab-pane fade" id="Jpills-four-example1" role="tabpanel" aria-labelledby="Jpills-four-example1-tab">
                               
                                <div class="row mb-8">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <h3 class="font-size-18 mb-6">Based on <span class="total_review">0</span> reviews</h3>
                                             <h2 class="font-size-30 font-weight-bold text-lh-1 mb-0"><span class="avarage_review">{{$avarage}}</span></h2>
                                            <div class="text-lh-1">overall</div>
                                        </div>

                                        <!-- Ratings -->
                                        <ul class="list-unstyled">
                                            <li class="py-1">
                                                <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                            @for ($i = 0; $i <5 ; $i++)
                                                                <small class="fas fa-star"></small>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="progress ml-xl-5  five_progress" style="height: 10px; width: 200px;">
                                                            <div class="progress-bar" role="progressbar" style="width: {{$five_ratting}}%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>

                                            <li class="py-1">
                                                <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                            @for ($i = 0; $i <5 ; $i++)
                                                                @if ($i<4)
                                                                  <small class="fas fa-star"></small>
                                                                  @else
                                                                   <small class="fas fa-star text-muted"></small>
                                                                @endif
                                                            @endfor  
                                                        </div>
                                                    </div>
                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="progress ml-xl-5 four_progress" style="height: 10px; width: 200px;">
                                                            <div class="progress-bar" role="progressbar" style="width: {{$four_ratting}}%;" aria-valuenow="53" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>

                                            <li class="py-1">
                                                <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                           @for ($i = 0; $i <5 ; $i++)
                                                               @if ($i<3)
                                                                 <small class="fas fa-star"></small>
                                                                 @else
                                                                  <small class="fas fa-star text-muted"></small>
                                                               @endif
                                                           @endfor  
                                                        </div>
                                                    </div>
                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="progress ml-xl-5 three_progress" style="height: 10px; width: 200px;">
                                                            <div class="progress-bar" role="progressbar" style="width: {{$three_ratting}}%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>

                                            <li class="py-1">
                                                <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                           @for ($i = 0; $i <5 ; $i++)
                                                               @if ($i<2)
                                                                 <small class="fas fa-star"></small>
                                                                 @else
                                                                  <small class="fas fa-star text-muted"></small>
                                                               @endif
                                                           @endfor  
                                                        </div>
                                                    </div>
                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="progress ml-xl-5 two_progress" style="height: 10px; width: 200px;">
                                                            <div class="progress-bar" role="progressbar" style="width: {{$two_ratting}}%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>

                                            <li class="py-1">
                                                <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                            @for ($i = 0; $i <5 ; $i++)
                                                                @if ($i<1)
                                                                  <small class="fas fa-star"></small>
                                                                  @else
                                                                   <small class="fas fa-star text-muted"></small>
                                                                @endif
                                                            @endfor  
                                                        </div>
                                                    </div>
                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="progress ml-xl-5 one_progress" style="height: 10px; width: 200px;">
                                                            <div class="progress-bar" role="progressbar" style="width: {{$one_ratting}}%;" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- End Ratings -->
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="font-size-18 mb-5">Add a review</h3>
                                        <!-- Form -->
                                        <form data-action="{{ route('product.review') }}" method="POST" id="submit_ratting">
                                            @csrf
                                            <div class="row align-items-center mb-4">
                                                <div class="col-md-4 col-lg-3">
                                                    <label for="rating" class="form-label mb-0">Your Review</label>
                                                </div>
                                                <div class="col-md-8 col-lg-9">
                                                   
                                                    <div class="text-warning text-ls-n2 font-size-16">
                                                        @for ($i = 1; $i <=5 ; $i++)
                                                           <span onmouseover="starmark(this)" onclick="starmark(this)" id="{{$i}}one"  class="star-ratting fa fa-star {{$i==5 ? 'checked-star' : ''}}"></span>
                                                        @endfor
                                                    </div>
                                                   
                                                </div>
                                            </div>

                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                            <input type="hidden" name="ratting" id="ratingCount" value="5">
                                            <div class="js-form-message form-group mb-3 row">
                                                <div class="col-md-4 col-lg-3">
                                                    <label for="descriptionTextarea" class="form-label">Your Review</label>
                                                </div>
                                                <div class="col-md-8 col-lg-9">
                                                    <textarea class="form-control" rows="3" name="review" id="descriptionTextarea"
                                                    data-msg="Please enter your message."
                                                    data-error-class="u-has-error"
                                                    data-success-class="u-has-success" required=""></textarea>
                                                </div>
                                            </div>
                                            <div class="js-form-message form-group mb-3 row">
                                                <div class="col-md-4 col-lg-3">
                                                    <label for="inputName" class="form-label">Name <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-8 col-lg-9">
                                                    <input type="text" class="form-control" name="name" id="inputName" aria-label="Alex Hecker" required
                                                    data-msg="Please enter your name."
                                                    data-error-class="u-has-error"
                                                    data-success-class="u-has-success">
                                                </div>
                                            </div>
                                            <div class="js-form-message form-group mb-3 row">
                                                <div class="col-md-4 col-lg-3">
                                                    <label for="emailAddress" class="form-label">Email <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-8 col-lg-9">
                                                    <input type="email" class="form-control" name="email" id="emailAddress" aria-label="alexhecker@pixeel.com" required
                                                    data-msg="Please enter a valid email address."
                                                    data-error-class="u-has-error"
                                                    data-success-class="u-has-success">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="offset-md-4 offset-lg-3 col-auto">
                                                    <button type="submit" class="btn btn-primary-dark btn-wide transition-3d-hover">Add Review</button>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- End Form -->
                                    </div>
                                </div>
                                <!-- Review -->


                            <div class="review-section">
                               
                            </div>
                            <div class="load_more_section d-flex justify-content-center" >
                                <p class="no_more_review" style="display: none"></p>
                                <button id="load_more_review" class="button" style="background: yellow;border: none;padding: 8px;border-radius: 15px;">@lang('title.load_more')</button>
                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Tab Content -->
                </div>
                <!-- End Single Product Tab -->
                <!-- Related products -->
                <div class="mb-6">
                    <div class="d-flex justify-content-between align-items-center border-bottom border-color-1 flex-lg-nowrap flex-wrap mb-4">
                        <h3 class="section-title mb-0 pb-2 font-size-22">@lang('title.related_product')</h3>
                    </div>
                    <ul class="row list-unstyled products-group no-gutters seee_related_product" page_num_related="1" category_id="{{$product->category_id}}">
                       
                    </ul>
                    <div class="load_more_section d-flex justify-content-center" >
                        <p class="no_more_data" style="display: none"></p>
                        <button id="load_more" class="button" style="background: yellow;border: none;padding: 8px;border-radius: 15px;">@lang('title.load_more')</button>
                    </div>
                </div>
                <!-- End Related products -->
                <!-- Brand Carousel -->
                @include('user.files.brand_carousel')
                <!-- End Brand Carousel -->
            </div>
@endsection

@section('extra_js')
<script>
    $(document).ready(function(){
   
     $('body').on('click','.find_all_size',function(){
                                                         
                  let color_id=$(this).val();
                  let product_id="{{$product->id}}";
                  $.ajax({
                  url: $(this).attr('data-action'),
                  method: "POST",
                  data:{color_id:color_id,product_id:product_id},

                  success:function(response){
                    var setItem='';
                    setItem+='<h6 class="font-size-14 mb-2"><strong>@lang('title.size')</strong></h6>';
                    response.sizes.forEach(function(item,index){

                        setItem+='<li><label><input type="radio" class="available_quantity" name="size_id" size_id="'+item.size_id+'" color_id="'+item.color_id+'" value="'+item.size_id+'" data-action="{{route('available_quantity')}}"><span class="swatch" style="background-color:#000"></span>'+item.size.size_name+'</label></li>'
                    });
                    $('.load_size').html(setItem);
                    $('.load_quantity').html('<option value="">@lang('title.quantity')</option>'); 
                     
                  },

                  error:function(response){
                  }
                });
          });

          $('body').on('click','.available_quantity',function(){
                 
                  let color_id=$(this).attr('color_id');
                  let size_id=$(this).attr('size_id');
                  let product_id="{{$product->id}}";
                 
                if (size_id ==="" || color_id ==="") 
                {
                     $('.load_quantity').html('<option value="">Quantity</option>'); 
                }else
                {
                      $.ajax({
                      url: $(this).attr('data-action'),
                      method: "POST",
                      data:{color_id:color_id,size_id:size_id,product_id:product_id},
                      success:function(response){ 
                        var setItem='';
                        setItem+='<option value="">@lang('title.quantity')</option>'
                       console.log(response.quantity.quantity);
                       for (var i = 1; i <=response.quantity.quantity; i++) {
                            setItem+='<option value="'+i+'">'+i+' Only'+'</option>'
                       }  
                        $('.load_quantity').html(setItem); 
                      },
                      error:function(response){
                      }
                    });
                    
                }   
          });


    });

   
</script>

<script>
    var count;
    function starmark(item)
    {
        count=item.id[0];
        sessionStorage.starRating = count;
        var subid= item.id.substring(1);
        $('#ratingCount').val(count);
        for(var i=0;i<5;i++)
        {
            if(i<count)
            {
              document.getElementById((i+1)+subid).style.color="#ffe00d";
            }
            else
            {
              document.getElementById((i+1)+subid).style.color="black";
            }
        }
    }

</script>
@endsection