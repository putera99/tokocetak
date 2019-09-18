<!DOCTYPE html>
<html lang="en">
<head>
<title>{{ $title }}</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="OneTech shop project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="{{asset('onetech/styles/bootstrap4/bootstrap.min.css')}}">
<link href="{{asset('onetech/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('onetech/plugins/OwlCarousel2-2.2.1/owl.carousel.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('onetech/plugins/OwlCarousel2-2.2.1/owl.theme.default.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('onetech/plugins/OwlCarousel2-2.2.1/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('onetech/plugins/jquery-ui-1.12.1.custom/jquery-ui.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('onetech/plugins/slick-1.8.0/slick.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('onetech/styles/shop_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('onetech/styles/shop_responsive.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('onetech/styles/main_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('onetech/styles/responsive.css')}}">

</head>

<body>

<div class="super_container">


	
	<!-- Header -->
	
	<header class="header">

		<!-- Top Bar -->

		@include('beranda.layouts2.top_bar')

		<!-- Header Main -->

		@include('beranda.layouts2.header')
		
		<!-- Main Navigation -->

		@include('beranda.layouts2.navbar')
		
		<!-- Menu -->

		

	</header>
	
	<!-- Home -->

	

	<!-- Shop -->

	@yield('content')

	<!-- Recently Viewed -->
	@if(\Auth::user())
	@include('beranda.layouts2.recent_view')
	@else
	@include('beranda.layouts2.most_viewed')
	@endif
	<!-- Brands -->


	<!-- Newsletter -->

	<!-- <div class="newsletter">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
						<div class="newsletter_title_container">
							<div class="newsletter_icon"><img src="images/send.png" alt=""></div>
							<div class="newsletter_title">Sign up for Newsletter</div>
							<div class="newsletter_text"><p>...and receive %20 coupon for first shopping.</p></div>
						</div>
						<div class="newsletter_content clearfix">
							<form action="#" class="newsletter_form">
								<input type="email" class="newsletter_input" required="required" placeholder="Enter your email address">
								<button class="newsletter_button">Subscribe</button>
							</form>
							<div class="newsletter_unsubscribe_link"><a href="#">unsubscribe</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> -->

	<!-- Footer -->

<?php
	$al = \DB::table('Alamat')->first();
?>
</div>
<footer class="footer">
		<div class="container">
			<div class="row">

				<div class="col-lg-4 col-lg-offset-4 footer_col">
					<center>
						<div class="footer_column footer_contact">
						<div class="logo_container">
							<div class="logo"><a href="{{ url('/') }}"><img style="width: 25%;" src="{{asset('images/logo/Toko-cetak-1.png')}}"></a></div>
						</div>
						<div class="footer_title">Hubungi kami :</div>
						<div class="footer_phone">{{ $al->Phone }}</div>
						<div class="footer_contact_text">
							<p>{{ $al->Email }}</p>
							<p>{{ $al->Address }}</p>
						</div>
						<div class="footer_social">
							<ul>
								<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
								<li><a href="#"><i class="fab fa-twitter"></i></a></li>
								<li><a href="#"><i class="fab fa-youtube"></i></a></li>
								<li><a href="#"><i class="fab fa-google"></i></a></li>
								<li><a href="#"><i class="fab fa-vimeo-v"></i></a></li>
							</ul>
						</div>
					</div>
					</center>
				</div>

			</div>
		</div>
	</footer>

<script src="{{asset('onetech/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('onetech/styles/bootstrap4/popper.js')}}"></script>
<script src="{{asset('onetech/styles/bootstrap4/bootstrap.min.js')}}"></script>
<script src="{{asset('onetech/plugins/greensock/TweenMax.min.js')}}"></script>
<script src="{{asset('onetech/plugins/greensock/TimelineMax.min.js')}}"></script>
<script src="{{asset('onetech/plugins/scrollmagic/ScrollMagic.min.js')}}"></script>
<script src="{{asset('onetech/plugins/greensock/animation.gsap.min.js')}}"></script>
<script src="{{asset('onetech/plugins/greensock/ScrollToPlugin.min.js')}}"></script>
<script src="{{asset('onetech/plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
<script src="{{asset('onetech/plugins/easing/easing.js')}}"></script>
<script src="{{asset('onetech/plugins/jquery-ui-1.12.1.custom/jquery-ui.js')}}"></script>
<script src="{{asset('onetech/plugins/parallax-js-master/parallax.min.js')}}"></script>
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/jquery.redirect.js')}}"></script>
<script src="{{asset('onetech/js/custom.js')}}"></script>
<script src="{{asset('onetech/plugins/slick-1.8.0/slick.js')}}"></script>
</body>

</html>