<!-- Header -->
<header class="header1">
		<!-- Header desktop -->
		<div class="container-menu-header">
			<div class="wrap_header">
				<!-- Logo -->
				<a href="{{route('property.all', ['type'=>'all'])}}" class="logo" >
					<img src="{{asset('images/icons/logo.png')}}" alt="IMG-LOGO" style="max-height: 86px" height="86" width="153">
				</a>

				<!-- Menu -->
				<div class="wrap_menu">
					<nav class="menu">
						<ul class="main_menu">
                            @auth
							<li>
                            <a href="{{route('property.me')}}">My Properties</a>
							</li>
                            @endauth
							<li class="sale-noti">
                                <a href="{{route('property.all', ['type' => 'all'])}}">Browse Properties</a>
                                <ul class="sub_menu">
                                        <li>
                                            <a href="{{route('property.all', ['type' => 'rent'])}}">
                                                Rent
                                            </a>
                                        </li>
                                        <li>
                                                <a href="{{route('property.all', ['type' => 'buy'])}}">
                                                    Buy
                                                </a>
                                        </li>
                                        <li>
                                                <a href="{{route('property.all',['type' => 'all'])}}">
                                                    All
                                                </a>
                                            </li>
                                </ul>
							</li>

							<li>

							</li>
						</ul>
					</nav>
				</div>

				<!-- Header Icon -->
				<div class="header-icons">
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest

					<span class="linedivide1"></span>
				</div>
			</div>
		</div>

		<!-- Header Mobile -->
		<div class="wrap_header_mobile">
			<!-- Logo moblie -->
			<a href="index.html" class="logo-mobile">
				<img src="{{asset('images/icons/logo.png')}}" alt="IMG-LOGO">
			</a>

			<!-- Button show menu -->

		</div>

		<!-- Menu Mobile -->

	</header>
