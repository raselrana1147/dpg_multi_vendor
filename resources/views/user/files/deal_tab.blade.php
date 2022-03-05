 <div class="mb-5">
                    <div class="row">
                        <!-- Deal -->
                       {{--  <div class="col-md-auto mb-6 mb-md-0">
                            <div class="p-3 border border-width-2 border-primary borders-radius-20 bg-white min-width-370">
                                <div class="d-flex justify-content-between align-items-center m-1 ml-2">
                                    <h3 class="font-size-22 mb-0 font-weight-normal text-lh-28 max-width-120">Special Offer</h3>
                                    <div class="d-flex align-items-center flex-column justify-content-center bg-primary rounded-pill height-75 width-75 text-lh-1">
                                        <span class="font-size-12">Save</span>
                                        <div class="font-size-20 font-weight-bold">$120</div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="{{ asset('assets/frontend/assets/img/320X300/img1.jpg')}}" alt="Image Description"></a>
                                </div>
                                <h5 class="mb-2 font-size-14 text-center mx-auto max-width-180 text-lh-18"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Game Console Controller + USB 3.0 Cable</a></h5>
                                <div class="d-flex align-items-center justify-content-center mb-3">
                                    <del class="font-size-18 mr-2 text-gray-2">$99,00</del>
                                    <ins class="font-size-30 text-red text-decoration-none">$79,00</ins>
                                </div>
                                <div class="mb-3 mx-2">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="">Availavle: <strong>6</strong></span>
                                        <span class="">Already Sold: <strong>28</strong></span>
                                    </div>
                                    <div class="rounded-pill bg-gray-3 height-20 position-relative">
                                        <span class="position-absolute left-0 top-0 bottom-0 rounded-pill w-30 bg-primary"></span>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <h6 class="font-size-15 text-gray-2 text-center mb-3">Hurry Up! Offer ends in:</h6>
                                    <div class="js-countdown d-flex justify-content-center"
                                        data-end-date="2020/11/30"
                                        data-hours-format="%H"
                                        data-minutes-format="%M"
                                        data-seconds-format="%S">
                                        <div class="text-lh-1">
                                            <div class="text-gray-2 font-size-30 bg-gray-4 py-2 px-2 rounded-sm mb-2">
                                                <span class="js-cd-hours"></span>
                                            </div>
                                            <div class="text-gray-2 font-size-12 text-center">HOURS</div>
                                        </div>
                                        <div class="mx-1 pt-1 text-gray-2 font-size-24">:</div>
                                        <div class="text-lh-1">
                                            <div class="text-gray-2 font-size-30 bg-gray-4 py-2 px-2 rounded-sm mb-2">
                                                <span class="js-cd-minutes"></span>
                                            </div>
                                            <div class="text-gray-2 font-size-12 text-center">MINS</div>
                                        </div>
                                        <div class="mx-1 pt-1 text-gray-2 font-size-24">:</div>
                                        <div class="text-lh-1">
                                            <div class="text-gray-2 font-size-30 bg-gray-4 py-2 px-2 rounded-sm mb-2">
                                                <span class="js-cd-seconds"></span>
                                            </div>
                                            <div class="text-gray-2 font-size-12 text-center">SECS</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <!-- End Deal -->
                        <!-- Tab Prodcut -->
                        <div class="col">
                            <!-- Features Section -->
                            <div class="">
                                <!-- Nav Classic -->
                                <div class="position-relative bg-white text-center z-index-2">
                                    <ul class="nav nav-classic nav-tab justify-content-center" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active " id="pills-one-example1-tab" data-toggle="pill" href="#pills-one-example1" role="tab" aria-controls="pills-one-example1" aria-selected="true">
                                                <div class="d-md-flex justify-content-md-center align-items-md-center">
                                                    @lang('title.featured') 
                                                </div>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " id="pills-two-example1-tab" data-toggle="pill" href="#pills-two-example1" role="tab" aria-controls="pills-two-example1" aria-selected="false">
                                                <div class="d-md-flex justify-content-md-center align-items-md-center">
                                                   @lang('title.trending')
                                                </div>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " id="pills-three-example1-tab" data-toggle="pill" href="#pills-three-example1" role="tab" aria-controls="pills-three-example1" aria-selected="false">
                                                <div class="d-md-flex justify-content-md-center align-items-md-center">
                                                    @lang('title.topsale')
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- End Nav Classic -->

                                <!-- Tab Content -->
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade pt-2 show active" id="pills-one-example1" role="tabpanel" aria-labelledby="pills-one-example1-tab">
                                        <ul class="row list-unstyled products-group no-gutters">

                                            @foreach ($features as $feature)

                                            <li class="col-6 col-wd-3 col-md-4 product-item d-xl-none d-wd-block remove-divider-wd">
                                                <div class="product-item__outer h-100">
                                                    <div class="product-item__inner px-xl-4 p-3">
                                                        <div class="product-item__body pb-xl-2">
                                                            <div class="mb-2"><a href="{{ route('product.category_wise',$feature->category_id) }}" class="font-size-12 text-gray-5">{{$feature->category->category_name}}</a></div>
                                                            <h5 class="mb-1 product-item__title"><a href="{{ route('product.detail',$feature->slug) }}" class="text-blue font-weight-bold">{{$feature->name}}</a></h5>
                                                            <div class="mb-2">
                                                                <a href="{{ route('product.detail',$feature->slug) }}" class="d-block text-center"><img class="img-fluid" src="{{ asset('assets/backend/image/product/small/'.$feature->thumbnail)}}" alt="Image Description"></a>
                                                            </div>
                                                            <div class="flex-center-between mb-1">
                                                                <div class="prodcut-price">
                                                                    <div class="text-gray-100">{{currency()}} {{$feature->current_price}}</div>
                                                                </div>
                                                                <div class="d-none d-xl-block prodcut-add-cart">
                                                                    <a href="{{ route('product.detail',$feature->slug) }}" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-item__footer">
                                                            <div class="border-top pt-2 flex-center-between flex-wrap">

                                                                <a href="javascript:;" class="text-gray-6 font-size-13 add_to_comparelist" product_id="{{$feature->id}}" data-action="{{ route('add_to_comparelist') }}"><i class="ec ec-compare mr-1 font-size-15"></i>@lang('title.compare')</a>

                                                                <a href="javascript:;" class="text-gray-6 font-size-13 add_to_wishlist" product_id="{{$feature->id}}" data-action="{{ route('add_to_wishlist') }}"><i class="ec ec-favorites mr-1 font-size-15"></i>@lang('title.add_to_Wishlist')</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                             @endforeach


                                        </ul>
                                    </div>
                                    <div class="tab-pane fade pt-2" id="pills-two-example1" role="tabpanel" aria-labelledby="pills-two-example1-tab">
                                        <ul class="row list-unstyled products-group no-gutters">
                                           @foreach ($trendings as $trending)
                                            <li class="col-6 col-wd-3 col-md-4 product-item d-xl-none d-wd-block remove-divider-xl">
                                                <div class="product-item__outer h-100">
                                                    <div class="product-item__inner px-xl-4 p-3">
                                                        <div class="product-item__body pb-xl-2">
                                                            <div class="mb-2"><a href="{{ route('product.category_wise',$trending->category_id) }}" class="font-size-12 text-gray-5">{{$trending->category->category_name}}</a></div>
                                                            <h5 class="mb-1 product-item__title"><a href="{{ route('product.detail',$trending->slug) }}" class="text-blue font-weight-bold">{{$trending->name}}</a></h5>
                                                            <div class="mb-2">
                                                                <a href="{{ route('product.detail',$trending->slug) }}" class="d-block text-center"><img class="img-fluid" src="{{ asset('assets/backend/image/product/small/'.$trending->thumbnail)}}" alt="Image Description"></a>
                                                            </div>
                                                            <div class="flex-center-between mb-1">
                                                                <div class="prodcut-price">
                                                                    <div class="text-gray-100">{{currency()}} {{$trending->current_price}}</div>
                                                                </div>
                                                                <div class="d-none d-xl-block prodcut-add-cart">
                                                                    <a href="{{ route('product.detail',$trending->slug) }}" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-item__footer">
                                                            <div class="border-top pt-2 flex-center-between flex-wrap">

                                                              <a href="javascript:;" class="text-gray-6 font-size-13 add_to_comparelist" product_id="{{$trending->id}}" data-action="{{ route('add_to_comparelist') }}"><i class="ec ec-compare mr-1 font-size-15"></i>@lang('title.compare')</a>

                                                                <a href="javascript:;" class="text-gray-6 font-size-13 add_to_wishlist" product_id="{{$trending->id}}" data-action="{{ route('add_to_wishlist') }}"><i class="ec ec-favorites mr-1 font-size-15"></i>@lang('title.add_to_Wishlist')</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade pt-2" id="pills-three-example1" role="tabpanel" aria-labelledby="pills-three-example1-tab">
                                        <ul class="row list-unstyled products-group no-gutters">
                                            @foreach ($top_sales as $top)

                                            <li class="col-6 col-wd-3 col-md-4 product-item">
                                                <div class="product-item__outer h-100">
                                                    <div class="product-item__inner px-xl-4 p-3">
                                                        <div class="product-item__body pb-xl-2">
                                                            <div class="mb-2"><a href="{{ route('product.category_wise',$top->category_id) }}" class="font-size-12 text-gray-5">{{$top->category->category_name}}</a></div>
                                                            <h5 class="mb-1 product-item__title"><a href="{{ route('product.detail',$top->slug) }}" class="text-blue font-weight-bold">{{$top->name}}</a></h5>
                                                            <div class="mb-2">
                                                                <a href="{{ route('product.detail',$top->slug) }}" class="d-block text-center"><img class="img-fluid" src="{{ asset('assets/backend/image/product/small/'.$top->thumbnail)}}" alt="Image Description"></a>
                                                            </div>
                                                            <div class="flex-center-between mb-1">
                                                                <div class="prodcut-price">
                                                                    <div class="text-gray-100">{{currency()}}{{$top->current_price}}</div>
                                                                </div>
                                                                <div class="d-none d-xl-block prodcut-add-cart">
                                                                    <a href="{{ route('product.detail',$top->slug) }}" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-item__footer">
                                                            <div class="border-top pt-2 flex-center-between flex-wrap">

                                                               <a href="javascript:;" class="text-gray-6 font-size-13 add_to_comparelist" product_id="{{$top->id}}" data-action="{{ route('add_to_comparelist') }}"><i class="ec ec-compare mr-1 font-size-15"></i>@lang('title.compare')</a>

                                                                 <a href="javascript:;" class="text-gray-6 font-size-13 add_to_wishlist" product_id="{{$top->id}}" data-action="{{ route('add_to_wishlist') }}"><i class="ec ec-favorites mr-1 font-size-15"></i>@lang('title.add_to_Wishlist')</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                             @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <!-- End Tab Content -->
                            </div>
                            <!-- End Features Section -->
                        </div>
                        <!-- End Tab Prodcut -->
                    </div>
                </div>