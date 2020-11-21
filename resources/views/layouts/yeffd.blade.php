<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<title>{{ config('app.name') }} - @yield('title')</title>

	<!-- FONT-ICON -->
	<link rel="stylesheet" href="/lib/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="/lib/themify-icons/themify-icons.css">
	<link rel="stylesheet" href="/lib/Icon-font-7-stroke-PIXEDEN/css/pe-icon-7-stroke.css">
	<link rel="stylesheet" href="/lib/et-line-font/style.css">

	<!-- LIB -->
	<link rel="stylesheet" href="/lib/animation/animate.css">
	<link rel="stylesheet" href="/css/custom-animation.css">
	<link rel="stylesheet" href="/lib/owl-carousel/owl.carousel.css">
	<link rel="stylesheet" href="/lib/sweetalert/sweetalert.css">
	<link rel="stylesheet" href="/lib/Magnific-Popup/magnific-popup.css">
	<link rel="stylesheet" href="/lib/Swiper/css/swiper.min.css">

	<!-- EFFECT -->
	<link rel="stylesheet" href="/lib/vegas/vegas.min.css">

	<!-- TEMPLATE -->
	<link rel="stylesheet" href="/lib/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/nc-grids.css">
	<link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" href="/css/helper.css">
	<link rel="stylesheet" href="/css/responsive.css">

	<!-- THEME -->
	<link rel="stylesheet" href="/css/themes/theme-05.css">
	<link rel="stylesheet" type="text/css" href="lib/star-animation/star-animation.css">
	
	<!-- CUSTOM -->
	<link rel="stylesheet" href="/css/custom.css">

	<!-- FAVICONS -->
	<link rel="apple-touch-icon" sizes="57x57" href="/images/favicons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/images/favicons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/images/favicons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/images/favicons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/images/favicons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/images/favicons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/images/favicons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/images/favicons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/favicons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/images/favicons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/images/favicons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicons/favicon-16x16.png">
    <link rel="manifest" href="/images/favicons/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/images/favicons/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

</head>
<body>
	
	<!-- MAIN-WRAPER -->
	<div class="nc-mainwrapper">

		<!-- MENU-ICON -->
		<a href="#nc-navigation" class="nc-menutrigger top-80 right-80" data-nc-sm="top-30 right-30">
			<span class="nc-menutrigger--span">Menu</span>
		</a><!-- / MENU-ICON -->
		
		<!-- CONTENT AREA -->
		<div id="nc-main" class="nc-main bg-cover bg-cc">

			<!-- SLIDESHOW -->
			<div class="full-wh">
				<div class="bgslider bg-cc bg-cover w100 h100"></div>
			</div>

			<div class="full-wh nc-background">
				<!-- STAR ANIMATION -->
				<div class="bg-animation">
					<div id='stars'></div>
					<div id='stars2'></div>
					<div id='stars3'></div>
					<div id='stars4'></div>
				</div><!-- / STAR ANIMATION -->
			</div>
			
			<!-- BACKGROUND OVERLAY -->
			<div class="nc-main--bgoverlay min-vh-h100 w100 pos-rel" data-bgcolor="rgba(0,0,0,0.6)">
				<!-- PAGEWRAPPER -->
				<div class="nc-main--pagewrapper nc-activeintro">
					
					<!-- INTRO SECTION -->
					<div id="nc-intropage" class="nc-intropage introsection min-vh-h100 flex-cc w100 pd-tb-small" data-nc-sm="flex-column">

						<!-- LOGO -->
						<div class="nc-logo align-c absolute top left animated s008" data-animIn="fadeInUp|0.1" data-animOut="fadeOutUp|0.1" data-nc-sm="pos-inherit pd-0 mr-b-60">
							<a href="{{ url('/') }}" class="inline-block">
								<img src="/images/yeffd-logo-2.png" alt="ncodeart">
							</a>
						</div><!-- / LOGO -->

						@yield('content')

					</div><!-- / INTRO SECTION -->

					<div class="nc-footer absolute bottom-80 left-80 align-c" data-nc-sm="pos-inherit pd-0 mr-t-60">
							
						<!-- SOCIAL-ICON -->						
						<div class="nc-sociallink">
							<div class="inner-wrapper inline-block">
								<a href="https://m.facebook.com/yeffd.inc/" title="Facebook" target="_blank" class="sq40 inline-flex flex-cc rd-50 txt-white hov-txt-white hov-bg-primary fs18 animated s008" data-animIn="fadeInDown|0.4" data-animOut="fadeOutDown|0.4"><i class="fa fa-facebook" aria-hidden="true"></i></a>

								<a href="https://instagram.com/y.e.f.f.d?igshid=rrecehc8xjju" title="YouTube" target="_blank" class="sq40 inline-flex flex-cc rd-50 txt-white hov-txt-white hov-bg-primary fs18 animated s008" data-animIn="fadeInDown|0.4" data-animOut="fadeOutDown|0.4"><i class="fa fa-instagram" aria-hidden="true"></i></a>
							</div>

							<div>&copy; {{ date('Y') }}<b> <a href="{{ url('/') }}">{{ config('app.name') }}</a> </b> All rights reserved.</div>
						</div><!-- / SOCIAL-ICON -->

					</div>


					<!-- AJAX PAGES -->
					<div id="nc-ajaxpage" class="nc-ajaxpage">
						
					</div><!-- / AJAX PAGES -->

				</div><!-- / PAGEWRAPPER -->

			</div><!-- / BACKGROUND OVERLAY -->

			<!-- PAGE OVERLAY -->
			<div class="nc-main--pageoverlay" data-bgcolor="rgba(0,0,0,0.6)">
				
			</div><!-- / PAGE OVERLAY -->

		</div><!-- / CONTENT AREA -->

		<!-- NAVIGATION -->
		<nav id="nc-navigation" class="nc-navigation bg-white shadow-large">
			<div class="min-vh-h100 flex-cc flex-column pd-tb-30">
				
				<!-- NAVIGATION HEADER -->
				<div class="nc-navigation--header">
					<a href="#" class="nc-navigation--close flex-cc sq40 fs36 rd-50 btn-primary solid bdr-1 mr-b-60"><i class="pe-7s-close"></i></a>
				</div><!-- / NAVIGATION HEADER -->

				<!-- NAVIGATION LIST -->
				<ul class="nc-navigation--ul list-reset w100">
					<li class="nc-navigation--li">
						<div class="nc-navigation--box info-obj img-l g10 middle-md tiny mr-b-0 pd-tiny bdr-b bdr-op-1">
							<a href="{{ url('/') }}" class="nc-pagelink nc-navigation--boxlink"></a>
							<div class="img txt-primary"><span class="iconwrp"><i class="pe-7s-home"></i></span></div>
							<div class="info">
								<h3 class="title mini mr-b-0 bold-3 f-2">Home</h3>
							</div>
						</div>	
					</li>

					<li class="nc-navigation--li">
						<div class="nc-navigation--box info-obj img-l g10 middle-md tiny mr-b-0 pd-tiny bdr-b bdr-op-1">
							<a href="{{ url('/about') }}" class="nc-pagelink nc-navigation--boxlink"></a>
							<div class="img txt-primary"><span class="iconwrp"><i class="pe-7s-notebook"></i></span></div>
							<div class="info">
								<h3 class="title mini mr-b-0 bold-3 f-2">About Us</h3>
							</div>
						</div>	
					</li>

					<li class="nc-navigation--li">
						<div class="nc-navigation--box info-obj img-l g10 middle-md tiny mr-b-0 pd-tiny bdr-b bdr-op-1">
							<a href="{{ url('/mission') }}" class="nc-pagelink nc-navigation--boxlink"></a>
							<div class="img txt-primary"><span class="iconwrp"><i class="pe-7s-timer"></i></span></div>
							<div class="info">
								<h3 class="title mini mr-b-0 bold-3 f-2">Mission</h3>
							</div>
						</div>	
					</li>

					<li class="nc-navigation--li">
						<div class="nc-navigation--box info-obj img-l g10 middle-md tiny mr-b-0 pd-tiny bdr-b bdr-op-1">
							<a href="{{ url('/events') }}" class="nc-pagelink nc-navigation--boxlink"></a>
							<div class="img txt-primary"><span class="iconwrp"><i class="pe-7s-map-marker"></i></span></div>
							<div class="info">
								<h3 class="title mini mr-b-0 bold-3 f-2">Events</h3>
							</div>
						</div>
					</li>

                    <li class="nc-navigation--li">
						<div class="nc-navigation--box info-obj img-l g10 middle-md tiny mr-b-0 pd-tiny bdr-b bdr-op-1">
							<a href="{{ url('/success-stories') }}" class="nc-pagelink nc-navigation--boxlink"></a>
							<div class="img txt-primary"><span class="iconwrp"><i class="pe-7s-note2"></i></span></div>
							<div class="info">
								<h3 class="title mini mr-b-0 bold-3 f-2">Success Story</h3>
							</div>
						</div>
					</li>

					<li class="nc-navigation--li">
						<div class="nc-navigation--box info-obj img-l g10 middle-md tiny mr-b-0 pd-tiny bdr-b bdr-op-1">
							<a href="{{ url('/donate') }}" class="nc-pagelink nc-navigation--boxlink"></a>
							<div class="img txt-primary"><span class="iconwrp"><i class="pe-7s-piggy"></i></span></div>
							<div class="info">
								<h3 class="title mini mr-b-0 bold-3 f-2">Donate</h3>
							</div>
						</div>
					</li>

				</ul><!-- / NAVIGATION LIST -->
			
			</div>
		</nav><!-- / NAVIGATION -->

	</div><!-- / MAIN-WRAPER -->

	<!-- FONT SELECTION -->
	<script>
		/* Use fonts with class name in sequence => f-1, f-2, f-3 .... */
		var fgroup = [
			'Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i',
			'Open Sans:400,300,300italic,400italic,600,700,600italic,700italic,800,800italic',
			'Pacifico'
		];
	</script>

	<!-- TEMPLATE -->
	<script type="text/javascript" src="/lib/jquery/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" src="/lib/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/lib/jquery-validation/jquery.validate.min.js"></script>
	<script type="text/javascript" src="/js/plugins.js"></script>
	<script type="text/javascript" src="/lib/Swiper/js/swiper.jquery.min.js"></script>
	<script type="text/javascript" data-pace-options='{ "ajax": true }' src="/lib/pace/pace.min.js"></script>
	<script type="text/javascript" src="/js/nc.js"></script>
	
	@stack('scripts')
</body>
</html>