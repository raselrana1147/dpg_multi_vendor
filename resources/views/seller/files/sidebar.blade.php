 <div class="left side-menu">
                <div class="slimscroll-menu" id="remove-scroll">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu" id="side-menu">
                            <li class="menu-title">Overview</li>
                            <li>
                                <a href="{{ route('seller.dashboard') }}" class="waves-effect">
                                    <i class="ion ion-md-speedometer"></i><span>@lang('seller.dashboard')</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-list"></i><span>@lang('seller.report')<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="{{ route('seller.custom_report') }}">@lang('seller.custom_report')</a></li>
                                    <li><a href="{{ route('seller.daily_report') }}">@lang('seller.daily_report')</a></li>
                                    <li><a href="{{ route('seller.weekly_report') }}">@lang('seller.weekly_report')</a></li>
                                    <li><a href="{{ route('seller.monthly_report') }}">@lang('seller.monthly_report')</a></li>
                                </ul>
                            </li>
                            
                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-list"></i><span>@lang('seller.product')<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="{{ route('seller.product_create') }}">@lang('seller.create_product')</a></li>
                                    <li><a href="{{ route('seller.product_list') }}">@lang('seller.product_list')</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-list"></i><span>@lang('seller.seller_order')<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="{{ route('seller.order_list') }}">@lang('seller.order_list')</a></li>
                                    
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-list"></i><span>@lang('seller.wallet_withdraw')<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="{{ route('seller.balance') }}">@lang('seller.balance')</a></li>
                                    <li><a href="{{ route('seller.withdraw.history') }}">@lang('seller.withdrawal_history')</a></li>
                                    
                                </ul>
                            </li>
                           
                        </ul>

                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>