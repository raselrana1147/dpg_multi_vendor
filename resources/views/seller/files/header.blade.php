  <div class="topbar">
                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="{{ route('seller.dashboard') }}" class="logo">
                        <span class="logo-light">
                            <img src="{{Auth::user()->shop_logo !=null ? asset('assets/backend/image/shop_logo/'.Auth::user()->shop_logo) : asset('assets/backend/image/'.default_image())}}" alt="" height="16">
                        </span>
                        <span class="logo-sm">
                            <img src="{{Auth::user()->shop_logo !=null ? asset('assets/backend/image/shop_logo/'.Auth::user()->shop_logo) : asset('assets/backend/image/'.default_image())}}" alt="" height="22">
                        </span>
                    </a>
                </div>

                <nav class="navbar-custom">
                    <ul class="navbar-right list-inline float-right mb-0">

                        <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                            <form role="search" class="app-search">
                                <div class="form-group mb-0">
                                    <input type="text" class="form-control" placeholder="Search..">
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </li>

                        <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                               <img src="{{ asset('assets/backend/image/flag/small/'.locale()) }}" style="width: 25px;height: 15px"> @lang('menu.language') <span class="mdi mdi-chevron-down"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right language-switch">
                                <a class="dropdown-item" href="{{ route('set.locale','bn') }}"><img src="{{ asset('assets/backend/image/flag/small/bn.png') }}" alt="" height="16" /><span>Bangla </span></a>
                                 <a class="dropdown-item" href="{{ route('set.locale','en') }}"><img src="{{ asset('assets/backend/image/flag/small/us.png') }}" alt="" height="16" /><span> English </span></a>
                               
                            </div>
                        </li>


                        <li class="dropdown notification-list list-inline-item">
                                    <div class="dropdown notification-list nav-pro-img">
                                        <a class="dropdown-toggle nav-link arrow-none nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                            <img src="{{ Auth::user()->profile_image_url !=null ? asset('assets/backend/image/profile/small/'.Auth::user()->profile_image_url) : asset('assets/backend/image/'.default_image()) }}" alt="user" class="rounded-circle">
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                            <!-- item-->
                                            <a class="dropdown-item" href="{{ route('seller.profile') }}"><i class="mdi mdi-account-circle"></i> @lang('seller.update_profile')</a>
                                            <a class="dropdown-item" href="{{ route('seller.change_password') }}"><i class="mdi mdi-wallet"></i>@lang('seller.change_password')</a>
                                            <a class="dropdown-item" href="{{ route('seller.shop_logo') }}"><i class="mdi mdi-wallet"></i>@lang('seller.set_logo')</a> 
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="javascript:;" onclick="event.preventDefault();
                                               document.getElementById('logout-form-admin').submit();">
                                                <i class="mdi mdi-power text-danger"></i> @lang('seller.logout')</a>
                                            
                                                  <form id="logout-form-admin" action="{{ route('logout') }}" method="POST" class="d-none">
                                                      @csrf
                                                  </form>
                                        </div>
                                    </div>
                        </li>

                    </ul>

                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left waves-effect">
                                <i class="mdi mdi-menu"></i>
                            </button>
                        </li>
                       
                    </ul>

                </nav>

            </div>