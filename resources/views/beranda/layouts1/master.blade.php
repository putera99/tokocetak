<!DOCTYPE html>
<html lang="en">
<head>
<title>TokoCetak</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="OneTech shop project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="{{asset('onetech/styles/bootstrap4/bootstrap.min.css')}}">
<link href="{{asset('onetech/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('onetech/plugins/OwlCarousel2-2.2.1/owl.carousel.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('onetech/plugins/OwlCarousel2-2.2.1/owl.theme.default.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('onetech/plugins/OwlCarousel2-2.2.1/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('onetech/plugins/slick-1.8.0/slick.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('onetech/styles/main_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('onetech/styles/responsive.css')}}">

</head>

<body>

<div class="super_container">
	
	<!-- Header -->
	
	<header class="header">

		<!-- Top Bar -->

		@include('beranda.layouts1.top_bar')

		<!-- Header Main -->

		@include('beranda.layouts1.header')
		
		<!-- Main Navigation -->
		@include('beranda.layouts1.navbar')
		
		<!-- Menu -->

		

	</header>
	
	<!-- Banner -->

	@include('beranda.layouts1.banner_slider')

	<!-- Characteristics -->

	@include('beranda.layouts1.kategori')

	<!-- Deals of the week -->

	<div class="deals_featured">
		<div class="container">
			<div class="row">
				<div class="col d-flex flex-lg-row flex-column align-items-center justify-content-start">
					
					<!-- Deals -->

					@include('beranda.layouts1.populer_minggu')
					
					<!-- Featured -->
					@include('beranda.layouts1.unggulan')

				</div>
			</div>
		</div>
	</div>

	<!-- Popular Categories -->

	

	<!-- Banner -->

	

	<!-- Barang Baru Populer -->

	@include('beranda.layouts1.baru_populer')

	<!-- Best Sellers -->


	<!-- Adverts -->

	

	<!-- Trends -->


	<!-- Reviews -->


	<!-- Recently Viewed -->
	@if(\Auth::user())
	@include('beranda.layouts1.recent_view')
	@else
	@include('beranda.layouts1.most_viewed')
	@endif
	<!-- Brands -->

	@include('beranda.layouts1.brands')

	<!-- Newsletter -->


	<!-- Footer -->

	@include('beranda.layouts1.footer')

	<!-- Copyright -->
</div>
<script src="{{asset('onetech/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('onetech/styles/bootstrap4/popper.js')}}"></script>
<script src="{{asset('onetech/styles/bootstrap4/bootstrap.min.js')}}"></script>
<script src="{{asset('onetech/plugins/greensock/TweenMax.min.js')}}"></script>
<script src="{{asset('onetech/plugins/greensock/TimelineMax.min.js')}}"></script>
<script src="{{asset('onetech/plugins/scrollmagic/ScrollMagic.min.js')}}"></script>
<script src="{{asset('onetech/plugins/greensock/animation.gsap.min.js')}}"></script>
<script src="{{asset('onetech/plugins/greensock/ScrollToPlugin.min.js')}}"></script>
<script src="{{asset('onetech/plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
<script src="{{asset('onetech/plugins/slick-1.8.0/slick.js')}}"></script>
<script src="{{asset('onetech/plugins/easing/easing.js')}}"></script>
<script src="{{asset('onetech/js/custom.js')}}"></script>

<script type="text/javascript">
		$(document).ready(function(){
			$('.detail').click(function(e){
				e.preventDefault();
				alert('asd');
			});
		});
	</script>

@yield('scripts')
</body>

</html>