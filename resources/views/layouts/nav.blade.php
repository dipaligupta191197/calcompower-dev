<header class="header">
	<div class="row">
		<div class="col-sm-12 col-md-6 sitelogo"><a href="{{url('home')}}"><img src="{{ asset('images/logo.png') }}" alt="Logo"></a></div>
		<div class="col-sm-12 col-md-6 headermenu">
			<ul>
				@if(@Auth::user())
					@if(request()->segment(1) == 'settings')
						<li class="usermenu">
							<a class="dropdown-item logout" href="{{url('/')}}">Calibration History</a>
						</li>
					@endif
				<li class="usermenu">
					<a href="{{url('settings')}}" title="Username">
						<!-- <img height="32" width="32" src="@if(Auth::user()->avatar){{ Storage::disk(Config::get('constants.DISK'))->url('user_profiles/'.Auth::user()->avatar) }} @else {{asset('images/user.png')}} @endif" alt="">  -->
						<span>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span>
					</a>
				</li>
				<li class="usermenu">
					<a class="dropdown-item logout" href="{{url('logout')}}">Logout</a>
				</li>
				@else
					<li><a href="{{url('/')}}" title="LOGIN">LOGIN</a></li>
					<li><a href="{{url('signup')}}" title="SIGNUP">SIGNUP</a></li>
				@endif
			</ul>
		</div>
	</div>
</header>
