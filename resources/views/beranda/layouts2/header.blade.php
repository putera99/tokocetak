<div class="header_main">
			<div class="container">
				<div class="row">

					<!-- Logo -->
					<div class="col-lg-2 col-sm-3 col-3 order-1">
						<div class="logo_container">
							<div class="logo"><a href="{{ url('/') }}"><img style="width: 80%;margin-left: 25px;" src="{{asset('images/logo/Toko-cetak-1.png')}}"></a></div>
						</div>
					</div>

					<!-- Search -->
					<div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
						<div class="header_search">
							<div class="header_search_content">
								<div class="header_search_form_container">
									<form action="{{ url('cari') }}" method="get" class="header_search_form clearfix">
										<input type="search" name="keywod" required="required" class="header_search_input" placeholder="Search for products...">
										<div class="custom_dropdown" style="display: none;">
											<div class="custom_dropdown_list">
												<span class="custom_dropdown_placeholder clc">Pilih Kategori</span>
												<i class="fas fa-chevron-down"></i>
												<ul class="custom_list clc">
													<li><a class="clc" href="#">All Categories</a></li>
													@foreach(\App\Models\ProductCategories::get() as $kt)

													@endforeach
												</ul>
											</div>
										</div>
										<button style="background: #008080;" type="submit" class="header_search_button trans_300" value="Submit"><img src="{{asset('onetech/images/search.png')}}" alt=""></button>
									</form>
								</div>
							</div>
						</div>
					</div>

					<!-- Wishlist -->
					<div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
						<div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
							<div class="wishlist d-flex flex-row align-items-center justify-content-end">
								<div class="wishlist_icon"><img src="{{asset('onetech/images/heart.png')}}" alt=""></div>
								<div class="wishlist_content">
									<div class="wishlist_text"><a href="{{ url('wishlist') }}">Wishlist</a></div>
									@if(\Auth::user())
									<div class="wishlist_count" style="color:#0E8CE4;">{{Wishlist::count(\Auth::user()->id)}} Item</div>
									@else
									<div class="wishlist_count" style="color:#0E8CE4;">0 Item</div>
									@endif
								</div>
							</div>

							<!-- Cart -->
							@if(\Auth::user())
							<?php
								$arrCart = [];
								$subtotal = 0;
								$userCart = \Cart::content(\Auth::user()->id);
								foreach($userCart as $key => $cartData){
									// dd($cartData);
									$subtotal += floatval($cartData->price * $cartData->qty);
									// dd($subtotal);
								}
							?>
							<div class="cart">
								<div class="cart_container d-flex flex-row align-items-center justify-content-end">
									<div class="cart_icon">
										<img src="{{asset('onetech/images/cart.png')}}" alt="">
										<div class="cart_count"><span>{{ count(\Cart::content(\Auth::user()->id)) }}</span></div>
									</div>
									<div class="cart_content">
										<div class="cart_text"><a href="{{ url('cart') }}">Cart</a></div>
										<!-- <div class="cart_price">Rp. {{ str_replace(',','.',\Cart::subtotal()) }}</div> -->
										<div class="cart_price">Rp. {{ number_format($subtotal,2,".",",") }}</div>
									</div>
								</div>
							</div>
							@else
							<div class="cart">
								<div class="cart_container d-flex flex-row align-items-center justify-content-end">
									<div class="cart_icon">
										<img src="{{asset('onetech/images/cart.png')}}" alt="">
										<div class="cart_count"><span>{{ \Cart::count( \Auth::user() ) }}</span></div>
									</div>
									<div class="cart_content">
										<div class="cart_text"><a href="{{ url('cart') }}">Cart</a></div>
										<div class="cart_price">Rp. {{ str_replace(',','.',\Cart::subtotal()) }}</div>
									</div>
								</div>
							</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>