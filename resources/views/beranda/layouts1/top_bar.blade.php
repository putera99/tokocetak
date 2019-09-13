<?php
$al = \DB::table('Alamat')->first();
?>
<div class="top_bar">
	<div class="container">
		<div class="row">
			<div class="col d-flex flex-row">
				<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{asset('onetech/images/phone.png')}}" alt=""></div>{{ $al->Phone }}</div>
				<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{asset('onetech/images/mail.png')}}" alt=""></div><a href="mailto:fastsales@gmail.com">{{ $al->Email }}</a></div>
				<div class="top_bar_content ml-auto">
					
					<div class="top_bar_user">
						@if (Auth::guest())
							<div class="user_icon"><img src="{{asset('onetech/images/user.svg')}}" alt=""></div>
							<div><a href="{{ url('register') }}">Daftar</a></div>
							<div><a href="{{ url('login') }}">Masuk</a></div>
						@else
							<div class="user_icon"><img src="{{asset('onetech/images/user.svg')}}" alt=""></div>
							<div><a href="{{ url('user_profile') }}">Profil Saya</a></div>
							<div class="user_icon"></div>
							<div><a href="{{ url('logout') }}">Keluar</a></div>
							<div class="user_icon"></div>
							<div><a href="{{ url('user/order') }}">Telusuri Pesanan</a></div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>		
</div>