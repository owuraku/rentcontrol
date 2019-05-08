<!-- Header -->
<header class="header1">
		<!-- Header desktop -->
		<div class="container-menu-header">
			<div class="wrap_header">
				<!-- Logo -->
				<a href="{{route('property.all', ['type'=>'all'])}}" class="logo">
					<img src="{{asset('images/icons/logo.png')}}" alt="IMG-LOGO">
				</a>

				<!-- Menu -->
				<div class="wrap_menu">
					<nav class="menu">
						<ul class="main_menu">

							<li>
                            <a href="{{route('property.me')}}">My Properties</a>
							</li>

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
					<a href="#" class="header-wrapicon1 dis-block">
						<img src="{{asset('images/icons/icon-header-01.png')}}" class="header-icon1" alt="ICON">
					</a>

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
