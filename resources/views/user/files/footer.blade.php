  <footer>
            <!-- Footer-top-widget -->
        @if (!Route::is(['customer.login','register','view.cart']))
          @include('user.files.footer_fst');
            
      @endif

            <!-- End Footer-top-widget -->
            <!-- Footer-newsletter -->
            <div class="bg-primary py-3">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-7 mb-md-3 mb-lg-0">
                            <div class="row align-items-center">
                                <div class="col-auto flex-horizontal-center">
                                    <i class="ec ec-newsletter font-size-40"></i>
                                    <h2 class="font-size-20 mb-0 ml-3">@lang('footer.sign_up_to_newsletter')</h2>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <!-- Subscribe Form -->
                            <form class="js-validate js-form-message">
                                <label class="sr-only" for="subscribeSrEmail">Email address</label>
                                <div class="input-group input-group-pill">
                                    <input type="email" class="form-control border-0 height-40" name="email" id="subscribeSrEmail" placeholder="@lang('auth.email_address')" aria-label="Email address" aria-describedby="subscribeButton" required
                                    data-msg="Please enter a valid email address.">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-dark btn-sm-wide height-40 py-2" id="subscribeButton">@lang('auth.signup')</button>
                                    </div>
                                </div>
                            </form>
                            <!-- End Subscribe Form -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Footer-newsletter -->
            <!-- Footer-bottom-widgets -->
            <div class="pt-8 pb-4 bg-gray-13">
                <div class="container mt-1">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="mb-6">
                                <a href="#" class="d-inline-block">
                                   <img src="{{ asset('assets/backend/image/logo/'.logo()) }}" style="max-width: 100px;max-height: 100px">
                                </a>
                            </div>
                            <div class="mb-4">
                                <div class="row no-gutters">
                                    <div class="col-auto">
                                        <i class="ec ec-support text-primary font-size-56"></i>
                                    </div>
                                    <div class="col pl-3">
                                        <div class="font-size-13 font-weight-light">Got questions? Call us 24/7!</div>
                                        <a href="tel:+80080018588" class="font-size-20 text-gray-90">{{company_phone()}}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <h6 class="mb-1 font-weight-bold">@lang('footer.contact_info')</h6>
                                <address class="">
                                   {{company_address()}}
                                </address>
                            </div>
                            <div class="my-4 my-md-4">
                                <ul class="list-inline mb-0 opacity-7">
                                    <li class="list-inline-item mr-0">
                                        <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="#">
                                            <span class="fab fa-facebook-f btn-icon__inner"></span>
                                        </a>
                                    </li>
                                    <li class="list-inline-item mr-0">
                                        <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="#">
                                            <span class="fab fa-google btn-icon__inner"></span>
                                        </a>
                                    </li>
                                    <li class="list-inline-item mr-0">
                                        <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="#">
                                            <span class="fab fa-twitter btn-icon__inner"></span>
                                        </a>
                                    </li>
                                    <li class="list-inline-item mr-0">
                                        <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="#">
                                            <span class="fab fa-github btn-icon__inner"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="row">
                                <div class="col-12 col-md mb-4 mb-md-0">
                                    <h6 class="mb-3 font-weight-bold">@lang('footer.find_fast')</h6>
                                    <!-- List Group -->
                                    <ul class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent">
                                        <li><a class="list-group-item list-group-item-action" href="../shop/product-categories-5-column-sidebar.html">Laptops & Computers</a></li>
                                        <li><a class="list-group-item list-group-item-action" href="../shop/product-categories-5-column-sidebar.html">Cameras & Photography</a></li>
                                        <li><a class="list-group-item list-group-item-action" href="../shop/product-categories-5-column-sidebar.html">Smart Phones & Tablets</a></li>
                                        <li><a class="list-group-item list-group-item-action" href="../shop/product-categories-5-column-sidebar.html">Video Games & Consoles</a></li>
                                        <li><a class="list-group-item list-group-item-action" href="../shop/product-categories-5-column-sidebar.html">TV & Audio</a></li>
                                        <li><a class="list-group-item list-group-item-action" href="../shop/product-categories-5-column-sidebar.html">Gadgets</a></li>
                                        <li><a class="list-group-item list-group-item-action" href="../shop/product-categories-5-column-sidebar.html">Car Electronic & GPS</a></li>
                                    </ul>
                                    <!-- End List Group -->
                                </div>

                                <div class="col-12 col-md mb-4 mb-md-0">
                                    <!-- List Group -->
                                    <ul class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent mt-md-6">
                                        <li><a class="list-group-item list-group-item-action" href="../shop/product-categories-5-column-sidebar.html">Printers & Ink</a></li>
                                        <li><a class="list-group-item list-group-item-action" href="../shop/product-categories-5-column-sidebar.html">Software</a></li>
                                        <li><a class="list-group-item list-group-item-action" href="../shop/product-categories-5-column-sidebar.html">Office Supplies</a></li>
                                        <li><a class="list-group-item list-group-item-action" href="../shop/product-categories-5-column-sidebar.html">Computer Components</a></li>
                                        <li><a class="list-group-item list-group-item-action" href="">Accesories</a></li>
                                    </ul>
                                    <!-- End List Group -->
                                </div>

                                <div class="col-12 col-md mb-4 mb-md-0">
                                    <h6 class="mb-3 font-weight-bold">@lang('footer.customer_care')</h6>
                                    <!-- List Group -->
                                    <ul class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent">

                                        <li><a class="list-group-item list-group-item-action" href="">@lang('menu.my_account')</a></li>
                                        <li><a class="list-group-item list-group-item-action" href="">@lang('menu.track_order')</a></li>
                                        <li><a class="list-group-item list-group-item-action" href="">@lang('title.favorite')</a></li>
                                    
                                        <li><a class="list-group-item list-group-item-action" href="#">@lang('menu.faq')</a></li>

                                        <li><a class="btn btn-primary-dark-w px-5" href="{{ route('seller.register') }}">@lang('title.seller_resgistration')</a></li> <br>

                                        <li><a class="btn btn-primary-dark-w px-5" href="{{ route('seller.login') }}">@lang('title.seller_login')</a></li> 
                                       
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Footer-bottom-widgets -->
            <!-- Footer-copy-right -->
            
            <!-- End Footer-copy-right -->
        </footer>