     @php
                $features_three=App\Models\Seller\Product::where('featured',"=","0")->latest()->take(3)->get();
                $top_sales_three=App\Models\Seller\Product::where('top_sale',"=","0")->latest()->take(3)->get();
                $trendings_threee=App\Models\Seller\Product::where('trending',"=","0")->latest()->take(3)->get();
            @endphp
            <div class="container d-none d-lg-block mb-3">
                <div class="row">
                    <div class="col-wd-3 col-lg-4">
                        <div class="widget-column">
                            <div class="border-bottom border-color-1 mb-5">
                                <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">@lang('title.featured_product')</h3>
                            </div>
                            <ul class="list-unstyled products-group">
                                @foreach ($features_three as $f_three)
                                <li class="product-item product-item__list row no-gutters mb-6 remove-divider">
                                    <div class="col-auto">
                                        <a href="{{ route('product.detail',$f_three->slug) }}" class="d-block width-75 text-center"><img class="img-fluid" src="{{ asset('assets/backend/image/product/small/'.$f_three->thumbnail)}}" alt="Image Description"></a>
                                    </div>
                                    <div class="col pl-4 d-flex flex-column">
                                        <h5 class="product-item__title mb-0"><a href="{{ route('product.detail',$f_three->slug) }}" class="text-blue font-weight-bold">{{$f_three->name}}</a></h5>
                                        <div class="prodcut-price mt-auto">
                                            <div class="font-size-15">{{currency().$f_three->current_price}}</div>
                                        </div>
                                    </div>
                                </li>
                           @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-wd-3 col-lg-4">
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">@lang('title.onsale_product')</h3>
                        </div>
                        <ul class="list-unstyled products-group">
                            @foreach ($top_sales_three as $t_three)
                            <li class="product-item product-item__list row no-gutters mb-6 remove-divider">
                                <div class="col-auto">
                                    <a href="{{ route('product.detail',$t_three->slug) }}" class="d-block width-75 text-center"><img class="img-fluid" src="{{ asset('assets/backend/image/product/small/'.$t_three->thumbnail)}}" alt="Image Description"></a>
                                </div>
                                <div class="col pl-4 d-flex flex-column">
                                    <h5 class="product-item__title mb-0"><a href="{{ route('product.detail',$t_three->slug) }}" class="text-blue font-weight-bold">{{$t_three->name}}</a></h5>
                                    <div class="prodcut-price mt-auto flex-horizontal-center">
                                        <ins class="font-size-15 text-decoration-none">{{currency().$t_three->current_price}}</ins>
                                        <del class="font-size-12 text-gray-9 ml-2">{{currency(). $t_three->previous_price}}</del>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                          </ul>
                    </div>
                    <div class="col-wd-3 col-lg-4">
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">@lang('title.trending_product')</h3>
                        </div>
                        <ul class="list-unstyled products-group">
                            @foreach ($trendings_threee as $tr_three)
                            <li class="product-item product-item__list row no-gutters mb-6 remove-divider">
                                <div class="col-auto">
                                    <a href="{{ route('product.detail',$tr_three->slug) }}" class="d-block width-75 text-center"><img class="img-fluid" src="{{ asset('assets/backend/image/product/small/'.$tr_three->thumbnail)}}" alt="Image Description"></a>
                                </div>
                                <div class="col pl-4 d-flex flex-column">
                                    <h5 class="product-item__title mb-0"><a href="{{ route('product.detail',$tr_three->slug) }}" class="text-blue font-weight-bold">{{$tr_three->name}}</a></h5>
                                    
                                    <div class="prodcut-price mt-auto">
                                        <div class="font-size-15">{{currency(). $t_three->current_price}}</div>
                                    </div>
                                </div>
                            </li>
                           @endforeach
                        </ul>
                    </div>
                    <div class="col-wd-3 d-none d-wd-block">
                        <a href="../shop/shop.html" class="d-block"><img class="img-fluid" src="{{ asset('assets/frontend/assets/img/330X360/img1.jpg')}}" alt="Image Description"></a>
                    </div>
                </div>
            </div>