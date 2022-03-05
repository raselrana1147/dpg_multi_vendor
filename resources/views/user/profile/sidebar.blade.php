<ul class="list-group list-group-flush customer-menu-list">
	<li class="list-group-item"><a href="{{ route('customer.dashboard') }}" class="{{Route::is('customer.dashboard') ? 'menu-active' : ''}}"><span><i class="fas fa-home"></i></span>@lang('title.dashboard')</a></li>
	<li class="list-group-item"><a href="{{ route('customer.order') }}" class="{{Route::is('customer.order') ? 'menu-active' : ''}}"><span><i class="fas fa-list"></i></span>@lang('title.my_order')</a></li>
	<li class="list-group-item"><a href="{{ route('customer.order_track') }}" class="{{Route::is('customer.order_track') ? 'menu-active' : ''}}"><span><i class="fa fa-shopping-basket"></i></span>@lang('title.track_order')</a></li>
	<li class="list-group-item"><a href="{{ route('customer.profile') }}" class="{{Route::is('customer.profile') ? 'menu-active' : ''}}"><span><i class="fas fa-user"></i></span>@lang('title.my_profile')</a></li>
	<li class="list-group-item"><a href="{{ route('customer.password') }}" class="{{Route::is('customer.password') ? 'menu-active' : ''}}"><span><i class="fas fa-lock"></i></span>@lang('title.change_password')</a></li>
	<li class="list-group-item">
		<a href="javascript:;" onclick="event.preventDefault();
		    document.getElementById('logout-form-customer').submit();">
		    <span><i class="fas fa-sign-out-alt" ></i></span>@lang('title.logout')</a>
		 
		 <form id="logout-form-customer" action="{{ route('logout') }}" method="POST" class="d-none">
		     @csrf
		 </form>
	</li>
</ul>