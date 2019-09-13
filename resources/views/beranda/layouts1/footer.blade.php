<?php
	$al = \DB::table('Alamat')->first();
?>
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