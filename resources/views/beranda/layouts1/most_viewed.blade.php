<div class="viewed">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="viewed_title_container">
						<h3 class="viewed_title">Paling Banyak Dilihat</h3>
						<div class="viewed_nav_container">
							<div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
							<div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
						</div>
					</div>

					<div class="viewed_slider_container">
						
						<!-- Recently Viewed Slider -->

						<div class="owl-carousel owl-theme viewed_slider">
							
							<!-- Recently Viewed Item -->
							<?php
								$data = App\Models\InfoProductLastView::select('StoreProductID',DB::raw('count(StoreProductID) as product_count'))
								->groupBy('StoreProductID')
								->orderBy('product_count')
								->limit(15)->get();
							?>
							@foreach($data as $dt)
							<div class="owl-item">
								<div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
									<div class="viewed_image"><img style="max-width:100%;max-height:100%" src="{{ asset('uploads/'.$dt->produk->FotoThumbnail) }}" alt=""></div>
									<div class="viewed_content text-center">
										<div class="viewed_price" style="color: #008080;">Rp. {{ str_replace(',','.',number_format($dt->produk->PriceFrom,0)) }}
										<!-- <span style="color: black;">$300</span> -->
										</div>
										<p>{{ $dt->produk->ProductName }}</p>
										<div class="viewed_name"><a href="#">{{ $dt->produk->Title }}</a></div>
									</div>
									<ul class="item_marks">
										@if($dt->produk->discount > 0)
										<li class="item_mark item_discount">-{{ $dt->produk->discount }}%</li>
										@endif
										<li class="item_mark item_new">new</li>
									</ul>
								</div>
							</div>
							@endforeach

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>