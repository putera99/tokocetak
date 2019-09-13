<div class="banner">
		<div class="banner_background" style="background-image:url({{asset('onetech/images/banner_background.jpg')}})"></div>
		<div class="container fill_height">
			<div class="row fill_height">
				<div class="banner_product_image"><img src="{{asset('uploads/'.$banner->produk->gambar->nama)}}" alt=""></div>
				<div class="col-lg-5 offset-lg-4 fill_height">
					<div class="banner_content">
						<h1 class="banner_text"></h1>
						<div class="banner_price">
							@if($banner->produk->discount > 0)
							<span>
								Rp. {{ str_replace(',','.',number_format($banner->produk->harga_awal,0)) }}
							</span>
							@endif
							Rp. {{ str_replace(',','.',number_format($banner->produk->harga_akhir,0)) }}
						</div>
						<div class="banner_product_name">{{ $banner->produk->nama }}</div>
						<div class="button banner_button"><a href="#">Shop Now</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>