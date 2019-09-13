<div class="deals">
	<div class="deals_title">Populer Minggu Ini</div>
	<div class="deals_slider_container">
		
		<!-- Deals Slider -->
		<div class="owl-carousel owl-theme deals_slider">
			
			<!-- Deals Item -->
			@foreach($flashSale as $pm)
			<div class="owl-item deals_item">
				<div class="deals_image">
					<a href="{{route('detail', ['s' => str_replace(' ','-',strtolower($pm->produk->StoreName)),'p'=>str_replace(' ','-',strtolower($pm->produk->ProductName)),'title'=>str_replace(' ','-',strtolower($pm->produk->Title)).'?id='.$pm->produk->StoreProductID ])}}">
						<img src="{{asset('uploads/'.$pm->produk->FotoDetail_0)}}" alt="">
					</a>
				</div>
				<div class="deals_content">
					<div class="deals_info_line d-flex flex-row justify-content-start">
						<div class="deals_item_category"><a href="#">{{ $pm->produk->ProductName }}</a></div>
						@if($pm->produk->discount > 0)
						<div class="deals_item_price_a ml-auto">Rp. {{ str_replace(',','.',number_format($pm->produk->PriceFrom)) }}</div>
						@endif
					</div>
					<div class="deals_info_line d-flex flex-row justify-content-start">
						<div class="deals_item_name" style="font-size:15px;">
							<a href="{{route('detail', ['s' => str_replace(' ','-',strtolower($pm->produk->StoreName)),'p'=>str_replace(' ','-',strtolower($pm->produk->ProductName)),'title'=>str_replace(' ','-',strtolower($pm->produk->Title)).'?id='.$pm->produk->StoreProductID ])}}">
								{{ $pm->produk->Title }}
							</a>
						</div>
						<div class="deals_item_price ml-auto" style="color: #008080;" style="font-size:15px;">Rp. {{ str_replace(',','.',number_format($pm->produk->PriceFrom)) }}</div>
					</div>
					<div class="available">
						<div class="available_line d-flex flex-row justify-content-start">
							<!-- <div class="available_title">Available: <span>6</span></div> -->
							<!-- <div class="sold_title ml-auto">Already sold: <span>28</span></div> -->
						</div>
						<!-- <div class="available_bar"><span style="width:17%"></span></div> -->
					</div>
					<div class="deals_timer d-flex flex-row align-items-center justify-content-start">
						<div class="deals_timer_title_container">
							<div class="deals_timer_title">Hurry Up</div>
							<div class="deals_timer_subtitle">Offer ends in:</div>
						</div>
						<div class="deals_timer_content ml-auto">
							<div class="deals_timer_box clearfix" data-target-time="">
								<div class="deals_timer_unit">
									<div id="deals_timer1_hr" class="deals_timer_hr"></div>
									<span>hours</span>
								</div>
								<div class="deals_timer_unit">
									<div id="deals_timer1_min" class="deals_timer_min"></div>
									<span>mins</span>
								</div>
								<div class="deals_timer_unit">
									<div id="deals_timer1_sec" class="deals_timer_sec"></div>
									<span>secs</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach

		</div>

	</div>

	<div class="deals_slider_nav_container">
		<div class="deals_slider_prev deals_slider_nav"><i class="fas fa-chevron-left ml-auto"></i></div>
		<div class="deals_slider_next deals_slider_nav"><i class="fas fa-chevron-right ml-auto"></i></div>
	</div>
</div>