 <div class="left side-menu">
                <div class="slimscroll-menu" id="remove-scroll">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu" id="side-menu">
                            <li class="menu-title">Overview</li>
                            <li>
                                <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                                    <i class="ion ion-md-speedometer"></i><span>@lang('admin.dashboard')</span>
                                </a>
                            </li>

                            <li class="menu-title">Apps</li>

                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-user-cog"></i><span>@lang('admin.report')<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="{{ route('admin.custom_report') }}">@lang('admin.custom_report')</a></li>
                                    <li><a href="{{ route('admin.daily_report') }}">@lang('admin.daily_report')</a></li>
                                    <li><a href="{{ route('admin.weekly_report') }}">@lang('admin.weekly_report')</a></li>
                                    <li><a href="{{ route('admin.monthly_report') }}">@lang('admin.monthly_report')</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-user-cog"></i><span>@lang('admin.manage_order')<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="{{ route('admin.order_list') }}">@lang('admin.order_list')</a></li>
                                    
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-user-cog"></i><span>@lang('admin.commission')<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="{{ route('admin.order_commission') }}">@lang('admin.order_commission')</a></li>
                                    <li><a href="{{ route('admin.order_history') }}">@lang('admin.commission_history')</a></li>
                                    
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-user-cog"></i><span>@lang('admin.withdrawal')<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="{{ route('admin.withdraw_request_list') }}">@lang('admin.withdrawal_request')</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-user-cog"></i><span>@lang('admin.users')<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="{{ route('admin.seller_list') }}">@lang('admin.seller_list')</a></li>
                                    <li><a href="{{ route('admin.customer_list') }}">@lang('admin.customer_list')</a></li>
                                </ul>
                            </li>
                            
                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-list"></i><span>@lang('admin.category')<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="{{ route('admin.category_create') }}">@lang('admin.create_category')</a></li>
                                    <li><a href="{{ route('admin.category_list') }}">@lang('admin.category_list')</a></li>
                                    <li><a href="{{ route('admin.subcategory_list') }}">@lang('admin.subcategory_list')</a></li>
                                </ul>
                            </li>


                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-list"></i><span>@lang('admin.brand')<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="{{ route('admin.brand_create') }}">@lang('admin.create_brand')</a></li>
                                    <li><a href="{{ route('admin.brand_list') }}">@lang('admin.brand_list')</a></li>
                                    
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-list"></i><span>@lang('admin.color')<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="{{ route('admin.color_create') }}">@lang('admin.create_color')</a></li>
                                    <li><a href="{{ route('admin.color_list') }}">@lang('admin.color_list')</a></li>
                                    
                                </ul>
                            </li>

                             <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-list"></i><span>@lang('admin.size')<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="{{ route('admin.size_create') }}">@lang('admin.create_size')</a></li>
                                    <li><a href="{{ route('admin.size_list') }}">@lang('admin.size_list')</a></li>
                                    
                                </ul>
                            </li>
 
                             <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-settings"></i><span>@lang('admin.product')<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="{{ route('admin.product_list') }}">@lang('admin.product_list')</a></li>
                                    
                                </ul>
                            </li>

                             <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-settings"></i><span>@lang('admin.setting')<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="{{ route('admin.general_setting') }}">@lang('admin.general_setting')</a></li>
                                    <li><a href="{{ route('admin.slider_list') }}">@lang('admin.slider')</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-user-cog"></i><span>@lang('admin.transaction')<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="#">@lang('admin.transaction_history')</a></li>
                                    
                                </ul>
                            </li>
                           
                        </ul>

                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>