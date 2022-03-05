  <aside id="sidebarHeader1" class="u-sidebar u-sidebar--left" aria-labelledby="sidebarHeaderInvokerMenu">
                                    <div class="u-sidebar__scroller">
                                        <div class="u-sidebar__container">
                                            <div class="u-header-sidebar__footer-offset pb-0">
                                                <!-- Toggle Button -->
                                                <div class="position-absolute top-0 right-0 z-index-2 pt-4 pr-7">
                                                    <button type="button" class="close ml-auto"
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
                                                        <span aria-hidden="true"><i class="ec ec-close-remove text-gray-90 font-size-20"></i></span>
                                                    </button>
                                                </div>
                                                <!-- End Toggle Button -->

                                                <!-- Content -->
                                                <div class="js-scrollbar u-sidebar__body">
                                                    <div id="headerSidebarContent" class="u-sidebar__content u-header-sidebar__content">
                                                        <!-- Logo -->
                                                        <a class="d-flex ml-0 navbar-brand u-header__navbar-brand u-header__navbar-brand-vertical" href="../home/index.html" aria-label="Electro">
                                                            <img src="{{ asset('assets/backend/image/logo/'.logo()) }}" style="width: 45px;height: 45px">
                                                        </a>
                                                        <!-- End Logo -->

                                                        <!-- List -->
                                                        <ul id="headerSidebarList" class="u-header-collapse__nav">
                                                            <!-- Home Section -->
                                                           
                                                                @php
                                                                    $categories=App\Models\Admin\Category::where('parent_id','=',null)->get();
                                                                @endphp
                                                            @foreach ($categories as $category)
                                                                {{-- expr --}}
                                                           
                                                            <li class="u-has-submenu u-header-collapse__submenu">
                                                                <a class="u-header-collapse__nav-link {{count($category->sub_category)>0 ? 'u-header-collapse__nav-pointer': ''}}" href="javascript:;" role="button" data-toggle="{{count($category->sub_category)>0 ? 'collapse': ''}}" aria-expanded="false" aria-controls="headerSidebarHomeCollapse" data-target="#headerSidebarHomeCollapse{{$category->id}}">
                                                                    {{$category->category_name}} 
                                                                </a>

                                                                <div id="headerSidebarHomeCollapse{{$category->id}}" class="collapse" data-parent="#headerSidebarContent">
                                                                    <ul id="headerSidebarHomeMenu" class="u-header-collapse__nav-list">
                                                                        @foreach ($category->sub_category as $sub_cat)
                                                                          <li><a class="u-header-collapse__submenu-nav-link" href="../home/index.html">{{$sub_cat->category_name}}</a></li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </li>

                                                        @endforeach
                                                        </ul>
                                                        <!-- End List -->
                                                    </div>
                                                </div>
                                                <!-- End Content -->
                                            </div>
                                        </div>
                                    </div>
                                </aside>