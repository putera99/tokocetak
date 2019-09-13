<div class="banner_2">
		<!-- <div class="banner_2_background" style="background-image:url({{asset('onetech/images/banner_2_background.jpg')}})"></div> -->
		<div class="banner_2_background"></div>
		<div class="banner_2_container">
			<div class="banner_2_dots"></div>
			<!-- Banner 2 Slider -->

			<div class="owl-carousel owl-theme banner_2_slider">

				<!-- Banner 2 Slider Item -->
				@foreach($slider as $sl)
				<div class="owl-item">
					<div class="banner_2_item">
						<div class="container fill_height">
							<div class="row fill_height">
								<div class="col-lg-4 col-md-6 fill_height">
									<div class="banner_2_content">
										<div class="banner_2_category">{{ $sl->produk->CategoryName }}</div>
										<div class="banner_2_title">
											<a style="color: black;" href="{{route('detail', ['s' => str_replace(' ','-',strtolower($sl->produk->StoreName)),'p'=>str_replace(' ','-',strtolower($sl->produk->ProductName)),'title'=>str_replace(' ','-',strtolower($sl->produk->Title)).'?id='.$sl->produk->StoreProductID ])}}">
												{{ $sl->produk->ProductName }}
											</a>
										</div>
										<div class="banner_2_text">
											<?php $ket = strip_tags($sl->produk->Description); ?>
											{{ str_limit($ket,150) }}
										</div>
										<div class="button banner_2_button" style="background: #008080;"><a href="{{route('detail', ['s' => str_replace(' ','-',strtolower($sl->produk->StoreName)),'p'=>str_replace(' ','-',strtolower($sl->produk->ProductName)),'title'=>str_replace(' ','-',strtolower($sl->produk->Title)).'?id='.$sl->produk->StoreProductID ])}}">Detail</a></div>
									</div>
									
								</div>
								<div class="col-lg-8 col-md-6 fill_height">
									<div class="banner_2_image_container">
										<div class="banner_2_image">
											<a href="{{route('detail', ['s' => str_replace(' ','-',strtolower($sl->produk->StoreName)),'p'=>str_replace(' ','-',strtolower($sl->produk->ProductName)),'title'=>str_replace(' ','-',strtolower($sl->produk->Title)).'?id='.$sl->produk->StoreProductID ])}}">
												<img style="width: 75%;" src="{{asset('uploads/'.$sl->produk->gambar->FotoThumbnail)}}" alt="">
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>			
					</div>
				</div>
				@endforeach

			</div>
		</div>
	</div>