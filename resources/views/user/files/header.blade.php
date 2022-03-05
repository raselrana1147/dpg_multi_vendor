<header id="header" class="u-header u-header-left-aligned-nav">
            <div class="u-header__section">
                <!-- Topbar -->
                <div class="u-header-topbar py-2 d-none d-xl-block">
                    <div class="container">
                        <div class="d-flex align-items-center">
                            <div class="topbar-left">
                               <div class="position-relative">
                                   <a id="languageDropdownInvoker" class="dropdown-nav-link dropdown-toggle d-flex align-items-center u-header-topbar__nav-link font-weight-normal" href="javascript:;" role="button"
                                       aria-controls="languageDropdown"
                                       aria-haspopup="true"
                                       aria-expanded="false"
                                       data-unfold-event="hover"
                                       data-unfold-target="#languageDropdown"
                                       data-unfold-type="css-animation"
                                       data-unfold-duration="300"
                                       data-unfold-delay="300"
                                       data-unfold-hide-on-scroll="true"
                                       data-unfold-animation-in="slideInUp"
                                       data-unfold-animation-out="fadeOut">
                                       <span class="d-inline-block d-sm-none">BN</span>
                                       <span class="d-none d-sm-inline-flex align-items-center">@lang('menu.language')<span class="pl-1">
                                         <img src="{{ asset('assets/backend/image/flag/small/'.locale()) }}" style="width: 25px;height: 15px">
                                       </span></span>
                                   </a>
                                  <div id="languageDropdown" class="dropdown-menu dropdown-unfold" aria-labelledby="languageDropdownInvoker">
                                      <a class="dropdown-item active" href="{{ route('set.locale','bn') }}">
                                       <img src="{{ asset('assets/backend/image/flag/small/bn.png') }}" class="locale-flag">Bangla</a>
                                      <a class="dropdown-item" href="{{ route('set.locale','en') }}">
                                       <img src="{{ asset('assets/backend/image/flag/small/us.png') }}" class="locale-flag">English</a>
                                  </div>
                               </div>
                            </div>
                            <div class="topbar-right ml-auto">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                      <a href="#" class="u-header-topbar__nav-link"><i class="ec ec-map-pointer mr-1"></i>@lang('menu.store_locator')</a>
                                    </li>
                                    <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                        <a href="../shop/track-your-order.html" class="u-header-topbar__nav-link"><i class="ec ec-transport mr-1"></i>@lang('menu.track_order')</a>
                                    </li>

                                 <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border u-header-topbar__nav-item-no-border u-header-topbar__nav-item-border-single">
                                     <div class="d-flex align-items-center">
                                         <!-- Language -->
                                         <div class="position-relative">
                                             <a id="accountDropdownInvoker" class="dropdown-nav-link dropdown-toggle d-flex align-items-center u-header-topbar__nav-link font-weight-normal" href="javascript:;" role="button"
                                                 aria-controls="accountDropdown"
                                                 aria-haspopup="true"
                                                 aria-expanded="false"
                                                 data-unfold-event="hover"
                                                 data-unfold-target="#accountDropdown"
                                                 data-unfold-type="css-animation"
                                                 data-unfold-duration="300"
                                                 data-unfold-delay="300"
                                                 data-unfold-hide-on-scroll="true"
                                                 data-unfold-animation-in="slideInUp"
                                                 data-unfold-animation-out="fadeOut">
                                                 <span class="d-none d-sm-inline-flex align-items-center">  <i class="ec ec-user mr-1"></i></i>@lang('menu.my_account')</span>
                                             </a>

                                             <div id="accountDropdown" class="dropdown-menu dropdown-unfold" aria-labelledby="accountDropdownInvoker">
                                               @if (Auth::check() && (Auth::user()->user_type == 'customer'))
                                               <a  href="{{ route('customer.dashboard') }}" class="u-header-topbar__nav-link p-2"
                                                   >
                                                   <i class="ec ec-user mr-1"></i>@lang('menu.user_panel')
                                               </a>
                                                  <a  href="javascript:;" role="button" class="u-header-topbar__nav-link p-2"
                                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form-admin').submit();">
                                                 <i class="fas fa-sign-out-alt p-2"></i>@lang('auth.logout')</span>
                                                  </a>
                                                  <form id="logout-form-admin" action="{{ route('logout') }}" method="POST" class="d-none">
                                                      @csrf
                                                  </form>
                                               @else
                                               <a  href="{{ route('customer.login') }}" class="u-header-topbar__nav-link p-2"
                                                   >
                                                   <i class="ec ec-user mr-1"></i>@lang('auth.signin')
                                               </a><br>
                                                <a href="{{ route('register') }}" class="u-header-topbar__nav-link p-2"
                                                    >
                                                    <i class="ec ec-user mr-1"></i>@lang('auth.signup')
                                                </a>
                                                <a id="sidebarNavToggler" href="javascript:;" role="button" class="u-header-topbar__nav-link"
                                                    aria-controls="sidebarContent"
                                                    aria-haspopup="true"
                                                    aria-expanded="false"
                                                    data-unfold-event="click"
                                                    data-unfold-hide-on-scroll="false"
                                                    data-unfold-target="#sidebarContent"
                                                    data-unfold-type="css-animation"
                                                    data-unfold-animation-in="fadeInRight"
                                                    data-unfold-animation-out="fadeOutRight"
                                                    data-unfold-duration="500" style="display: none">
                                                    <i class="ec ec-user mr-1"></i>@lang('auth.signin')
                                                </a>

                                                
                                                @endif
                                             </div>
                                         </div>
                                         <!-- End Language -->
                                     </div>
                                 </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Topbar -->

                <!-- Logo and Menu -->
                <div class="py-2 py-xl-4 bg-primary-down-lg">
                    <div class="container my-0dot5 my-xl-0">
                        <div class="row align-items-center">
                            <!-- Logo-offcanvas-menu -->
                            <div class="col-auto">
                                <!-- Nav -->
                                <nav class="navbar navbar-expand u-header__navbar py-0 justify-content-xl-between max-width-270 min-width-270">
                                    <!-- Logo -->
                                    <a class="order-1 order-xl-0 navbar-brand u-header__navbar-brand u-header__navbar-brand-center" href="{{ route('home.page') }}" aria-label="Electro">
                                        <img src="{{ asset('assets/backend/image/logo/'.logo()) }}" style="width: 45px;height: 45px">
                                    </a>
                                    <!-- End Logo -->

                                    <!-- Fullscreen Toggle Button -->
                                    <button id="sidebarHeaderInvokerMenu" type="button" class="navbar-toggler d-block btn u-hamburger mr-3 mr-xl-0"
                                        aria-controls="sidebarHeader"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                        data-unfold-event="click"
                                        data-unfold-hide-on-scroll="false"
                                        data-unfold-target="#sidebarHeader1"
                                        data-unfold-type="css-animation"
                                        data-unfold-animation-in="fadeInLeft"
                                        data-unfold-animation-out="fadeOutLeft"
                                        data-unfold-duration="500">
                                        <span id="hamburgerTriggerMenu" class="u-hamburger__box">
                                            <span class="u-hamburger__inner"></span>
                                        </span>
                                    </button>
                                    <!-- End Fullscreen Toggle Button -->
                                </nav>
                                <!-- End Nav -->

                                <!-- ========== HEADER SIDEBAR ========== -->
                                @include('user.files.navigation')
                                <!-- ========== END HEADER SIDEBAR ========== -->
                            </div>
                            <!-- End Logo-offcanvas-menu -->
                            <!-- Primary Menu -->
                            <div class="col d-none d-xl-block">
                                <!-- Nav -->
                                <nav class="js-mega-menu navbar navbar-expand-md u-header__navbar u-header__navbar--no-space">
                                    <!-- Navigation -->
                                    <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse">
                                        <ul class="navbar-nav u-header__navbar-nav">
                                            <!-- Home -->
                                            <li class="nav-item u-header__nav-item"
                                                data-event="hover"
                                                data-animation-in="slideInUp"
                                                data-animation-out="fadeOut">
                                                <a id="HomeMegaMenu" class="nav-link u-header__nav-link" href="{{ route('home.page') }}">@lang('menu.home')</a>
                                            </li>

                                            <li class="nav-item u-header__nav-item"
                                                data-event="hover"
                                                data-animation-in="slideInUp"
                                                data-animation-out="fadeOut">
                                                <a id="HomeMegaMenu" class="nav-link u-header__nav-link" href="{{ route('product.shop') }}">@lang('menu.shop')</a>
                                            </li>
                                        
                                            <li class="nav-item u-header__nav-item">
                                                <a class="nav-link u-header__nav-link" href="#">@lang('menu.about_us')</a>
                                            </li>
                                           
                                            <li class="nav-item u-header__nav-item">
                                                <a class="nav-link u-header__nav-link" href="#">@lang('menu.faq')</a>
                                            </li>
                                          
                                            <li class="nav-item u-header__nav-item">
                                                <a class="nav-link u-header__nav-link" href="#">@lang('menu.contact_us')</a>
                                            </li>
                                        
                                        </ul>
                                    </div>
                                    <!-- End Navigation -->
                                </nav>
                                <!-- End Nav -->
                            </div>
                            <!-- End Primary Menu -->
                            <!-- Customer Care -->
                            <div class="d-none d-xl-block col-md-auto">
                                <div class="d-flex">
                                    <i class="ec ec-support font-size-50 text-primary"></i>
                                    <div class="ml-2">
                                        <div class="phone">
                                            <strong>Support</strong> <a href="tel:800856800604" class="text-gray-90">(+800) 856 800 604</a>
                                        </div>
                                        <div class="email">
                                            E-mail: <a href="mailto:info@electro.com?subject=Help Need" class="text-gray-90">info@electro.com</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Customer Care -->
                            <!-- Header Icons -->
                            <div class="d-xl-none col col-xl-auto text-right text-xl-left pl-0 pl-xl-3 position-static">
                                <div class="d-inline-flex">
                                    <ul class="d-flex list-unstyled mb-0 align-items-center">
                                        <!-- Search -->
                                        <li class="col d-xl-none px-2 px-sm-3 position-static">
                                            <a id="searchClassicInvoker" class="font-size-22 text-gray-90 text-lh-1 btn-text-secondary" href="javascript:;" role="button"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title="Search"
                                                aria-controls="searchClassic"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                                data-unfold-target="#searchClassic"
                                                data-unfold-type="css-animation"
                                                data-unfold-duration="300"
                                                data-unfold-delay="300"
                                                data-unfold-hide-on-scroll="true"
                                                data-unfold-animation-in="slideInUp"
                                                data-unfold-animation-out="fadeOut">
                                                <span class="ec ec-search"></span>
                                            </a>

                                            <!-- Input -->
                                            <div id="searchClassic" class="dropdown-menu dropdown-unfold dropdown-menu-right left-0 mx-2" aria-labelledby="searchClassicInvoker">
                                                <form class="js-focus-state input-group px-3">
                                                    <input class="form-control" type="search" placeholder="Search Product">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary px-3" type="button"><i class="font-size-18 ec ec-search"></i></button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- End Input -->
                                        </li>
                                        <!-- End Search -->
                                      @if (Auth::check() && (Auth::user()->user_type == 'customer'))
                                        <li class="col d-none d-xl-block"><a href="{{ route('view.comparelist') }}" class="text-gray-90" data-toggle="tooltip" data-placement="top" title="Compare"><i class="font-size-22 ec ec-compare"></i></a></li>
                                       @else
                                       <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                           <!-- Account Sidebar Toggle Button -->
                                           <a id="sidebarNavToggler" href="javascript:;" role="button" class="u-header-topbar__nav-link"
                                               aria-controls="sidebarContent"
                                               aria-haspopup="true"
                                               aria-expanded="false"
                                               data-unfold-event="click"
                                               data-unfold-hide-on-scroll="false"
                                               data-unfold-target="#sidebarContent"
                                               data-unfold-type="css-animation"
                                               data-unfold-animation-in="fadeInRight"
                                               data-unfold-animation-out="fadeOutRight"
                                               data-unfold-duration="500">
                                               <i class="font-size-22 ec ec-favorites"></i> Wishlist
                                           </a>
                                           <!-- End Account Sidebar Toggle Button -->
                                       </li>
                                       @endif
                                       

                                        @if (Auth::check() && (Auth::user()->user_type == 'customer'))
                                         <li class="col d-none d-xl-block"><a href="{{ route('view.wishlist') }}" class="text-gray-90" data-toggle="tooltip" data-placement="top" title="Favorites"><i class="font-size-22 ec ec-favorites"></i></a></li>

                                         @else
                                         
                                         <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                             <!-- Account Sidebar Toggle Button -->
                                             <a id="sidebarNavToggler" href="javascript:;" role="button" class="u-header-topbar__nav-link"
                                                 aria-controls="sidebarContent"
                                                 aria-haspopup="true"
                                                 aria-expanded="false"
                                                 data-unfold-event="click"
                                                 data-unfold-hide-on-scroll="false"
                                                 data-unfold-target="#sidebarContent"
                                                 data-unfold-type="css-animation"
                                                 data-unfold-animation-in="fadeInRight"
                                                 data-unfold-animation-out="fadeOutRight"
                                                 data-unfold-duration="500">
                                                 <i class="font-size-22 ec ec-favorites"></i> Wishlist
                                             </a>
                                             <!-- End Account Sidebar Toggle Button -->
                                         </li>
                                        @endif

                                        <li class="col d-xl-none px-2 px-sm-3"><a href="../shop/my-account.html" class="text-gray-90" data-toggle="tooltip" data-placement="top" title="My Account"><i class="font-size-22 ec ec-user"></i></a></li>

                                        <li class="col pr-xl-0 px-2 px-sm-3">
                                            <a href="../shop/cart.html" class="text-gray-90 position-relative d-flex " data-toggle="tooltip" data-placement="top" title="@lang('title.cart')">
                                                <i class="font-size-22 ec ec-shopping-bag"></i>
                                                <span class="width-22 height-22 bg-dark position-absolute d-flex align-items-center justify-content-center rounded-circle left-12 top-8 font-weight-bold font-size-12 text-white">2</span>
                                                <span class="d-none d-xl-block font-weight-bold font-size-16 text-gray-90 ml-3">$1785.00</span>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <!-- End Header Icons -->
                        </div>
                    </div>
                </div>
                <!-- End Logo and Menu -->

                <!-- Vertical-and-Search-Bar -->
                <div class="d-none d-xl-block bg-primary">
                    <div class="container">
                        <div class="row align-items-stretch min-height-50">
                            <!-- Vertical Menu -->
                            <div class="col-md-auto d-none d-xl-flex align-items-end">
                                <div class="max-width-270 min-width-270">
                                    <!-- Basics Accordion -->
                                    <div id="basicsAccordion">
                                        <!-- Card -->
                                        <div class="card border-0 rounded-0">
                                            <div class="card-header bg-primary rounded-0 card-collapse border-0" id="basicsHeadingOne">
                                                <button type="button" class="btn-link btn-remove-focus btn-block d-flex card-btn py-3 text-lh-1 px-4 shadow-none btn-primary rounded-top-lg border-0 font-weight-bold text-gray-90"
                                                    data-toggle="collapse"
                                                    data-target="#basicsCollapseOne"
                                                    aria-expanded="true"
                                                    aria-controls="basicsCollapseOne">
                                                    <span class="pl-1 text-gray-90">@lang('title.all_departments')</span>
                                                    <span class="text-gray-90 ml-3">
                                                        <span class="ec ec-arrow-down-search"></span>
                                                    </span>
                                                </button>
                                            </div>
                                            <div id="basicsCollapseOne" class="collapse vertical-menu v1"
                                                aria-labelledby="basicsHeadingOne"
                                                data-parent="#basicsAccordion">
                                                <div class="card-body p-0">
                                                    <nav class="js-mega-menu navbar navbar-expand-xl u-header__navbar u-header__navbar--no-space hs-menu-initialized">
                                                        <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse">
                                                           <ul class="navbar-nav u-header__navbar-nav">
                                                           @php
                                                               $categories=App\Models\Admin\Category::where('parent_id','=',null)->get();
                                                           @endphp
                                                           @foreach ($categories as $category)

                                                                <li class="nav-item hs-has-mega-menu u-header__nav-item"
                                                               data-event="hover"
                                                               data-animation-in="slideInUp"
                                                               data-animation-out="fadeOut"
                                                               data-position="left">
                                                               <a id="basicMegaMenu" class="nav-link u-header__nav-link u-header__nav-link-toggle" href="{{ route('product.category_wise',$category->id) }}" aria-haspopup="true" aria-expanded="false">{{$category->category_name}}</a>

                                                               <!-- Nav Item - Mega Menu -->
                                                               <div class="hs-mega-menu vmm-tfw u-header__sub-menu" aria-labelledby="basicMegaMenu">
                                                                   <div class="vmm-bg">
                                                                   </div>
                                                                   <div class="row u-header__mega-menu-wrapper">
                                                                       
                                                                           <ul class="u-header__sub-menu-nav-group mb-3">
                                                                                @foreach ($category->sub_category as $sub_cat)
                                                                               <li><a class="nav-link u-header__sub-menu-nav-link" href="{{ route('product.subcategory_wise',$sub_cat->id) }}">{{$sub_cat->category_name}}</a></li>
                                                                              @endforeach
                                                                           </ul>
                                                               
                                                                   </div>
                                                               </div>
                                                           </li>
                                                           @endforeach
                                                                                                       
                                                           </ul>
                                                        </div>
                                                    </nav>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Card -->
                                    </div>
                                    <!-- End Basics Accordion -->
                                </div>
                            </div>
                            <!-- End Vertical Menu -->
                            <!-- Search bar -->
                            <div class="col align-self-center">
                                <!-- Search-Form -->
                                <form class="js-focus-state" action="{{ route('product_search') }}" method="post">
                                  @csrf
                                    <label class="sr-only" for="searchProduct">Search</label>
                                    <div class="input-group">
                                        <input id="transcript" type="text" class="form-control py-2 pl-5 font-size-15 border-0 height-40 rounded-left-pill" name="search_key" id="searchProduct" placeholder="@lang('title.search_product')" aria-label="" aria-describedby="searchProduct1">
                              
                                        <div class="input-group-append">
                                            <!-- Select -->
                                            <select class="js-select selectpicker dropdown-select custom-search-categories-select"
                                                data-style="btn height-40 text-gray-60 font-weight-normal border-0 rounded-0 bg-white px-5 py-2" name="category_id">
                                                <option value="" selected>@lang('title.all_category')</option>
                                               @php
                                                   $categories=DB::table('categories')->where('parent_id','=',null)->get();
                                               @endphp
                                               @foreach ($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                                @endforeach
                                            </select>
                                            <!-- End Select -->
                                            <button class="btn btn-dark height-40 py-2 px-3 rounded-right-pill" type="submit" id="searchProduct1">
                                                <span class="ec ec-search font-size-24"></span>
                                            </button>

                                            {{-- <button onclick="startDictation()" class="btn btn-dark height-40 py-2 px-3 rounded-right-pill" type="button">
                                                <span class="ec font-size-24">
                                                   <i class="fas fa-microphone-alt pb-4"></i>
                                                </span>
                                            </button> --}}
                                        </div>
                                    </div>
                                </form>
                                <!-- End Search-Form -->
                            </div>
                            <!-- End Search bar -->
                            <!-- Header Icons -->
                            <div class="col-md-auto align-self-center">
                                <div class="d-flex">
                                    <ul class="d-flex list-unstyled mb-0">
                                        <li class="col"><a href="../shop/compare.html" class="text-gray-90" data-toggle="tooltip" data-placement="top" title="@lang('title.compare')"><i class="font-size-22 ec ec-compare"></i></a></li>
                                        <li class="col"><a href="{{ route('view.wishlist') }}" class="text-gray-90" data-toggle="tooltip" data-placement="top" title="@lang('title.favorite')"><i class="font-size-22 ec ec-favorites"></i></a></li>
                                        <li class="col pr-xl-0 px-2 px-sm-3 d-none d-xl-block">
                                            <div id="basicDropdownHoverInvoker" class="text-gray-90 position-relative d-flex " data-toggle="tooltip" data-placement="top" title="@lang('title.cart')"
                                                aria-controls="basicDropdownHover"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                                data-unfold-event="click"
                                                data-unfold-target="#basicDropdownHover"
                                                data-unfold-type="css-animation"
                                                data-unfold-duration="300"
                                                data-unfold-delay="300"
                                                data-unfold-hide-on-scroll="true"
                                                data-unfold-animation-in="slideInUp"
                                                data-unfold-animation-out="fadeOut">
                                                <i class="font-size-22 ec ec-shopping-bag"></i>
                                                <span class="width-22 height-22 bg-dark position-absolute flex-content-center text-white rounded-circle left-12 top-8 font-weight-bold font-size-12 cart-count">{{App\Models\Cart::total_item()}}</span>
                                                <span class="font-weight-bold font-size-16 text-gray-90 ml-3">
                                                    {{currency()}}<span class="cart-total">{{App\Models\Cart::total_price()}}</span>
                                            </span>
                                                
                                            </div>
                                            <div id="basicDropdownHover" class="cart-dropdown dropdown-menu dropdown-unfold border-top border-top-primary mt-3 border-width-2 border-left-0 border-right-0 border-bottom-0 left-auto right-0 cart-item-added" aria-labelledby="basicDropdownHoverInvoker">
                                                <ul class="list-unstyled px-3 pt-3">
                                                    @if (App\Models\Cart::total_item()>0)

                                                    @foreach (App\Models\Cart::carts() as $cart)
                                                        <li class="border-bottom pb-3 mb-3">
                                                            <div class="">
                                                                <ul class="list-unstyled row mx-n2">
                                                                    <li class="px-2 col-auto">
                                                                        <img class="img-fluid" src="{{ asset('assets/backend/image/product/small/'.$cart->product->thumbnail)}}" alt="Image Description" style="max-width: 100px;max-height: 80px">
                                                                    </li>
                                                                    <li class="px-2 col">
                                                                        <h5 class="text-blue font-size-14 font-weight-bold">{{$cart->product->name}}</h5>
                                                                        <span class="font-size-14">{{$cart->quantity}} × {{$cart->product->current_price}}</span>
                                                                    </li>
                                                                    <li class="px-2 col-auto">
                                                                        <a href="javascript:void(0)" class="text-gray-90 delete_cart" cart_id="{{$cart->id}}" data-action="{{ route('delete.cart') }}"><i class="ec ec-close-remove"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </li>
                                                     
                                                    @endforeach

                                                </ul>
                                                <div class="flex-center-between px-4 pt-2">
                                                    <a href="{{ route('view.cart') }}" class="btn btn-soft-secondary mb-3 mb-md-0 font-weight-normal px-5 px-md-4 px-lg-5">@lang('title.view_cart')</a>
                                                    <a href="{{ route('checkout') }}" class="btn btn-primary-dark-w ml-md-2 px-5 px-md-4 px-lg-5">@lang('menu.checkout')</a>
                                                </div>
                                            @else
                                            <h5>@lang('title.empty_cart')</h5>
                                            @endif
                                            </div>
                                        </li>


                                    </ul>
                                </div>
                            </div>
                            <!-- End Header Icons -->
                        </div>
                    </div>
                </div>
                <!-- End Vertical-and-secondary-menu -->
            </div>
        </header>