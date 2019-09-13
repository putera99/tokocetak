<div class="popular_categories">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">
					<div class="popular_categories_content">
						<div class="popular_categories_title">Kategori</div>
						<div class="popular_categories_slider_nav">
							<div class="popular_categories_prev popular_categories_nav"><i class="fas fa-angle-left ml-auto"></i></div>
							<div class="popular_categories_next popular_categories_nav"><i class="fas fa-angle-right ml-auto"></i></div>
						</div>
						<div class="popular_categories_link"><a href="#"></a></div>
					</div>
				</div>
				
				<!-- Popular Categories Slider -->
				
				<div class="col-lg-9">
					<div class="popular_categories_slider_container">
						<div class="owl-carousel owl-theme popular_categories_slider">

							<!-- Popular Categories Item -->
							<?php $kategori = \App\Models\ProductCategories::orderBy('Name','asc')->get(); ?>
							@foreach($kategori as $kt)
							<div class="owl-item">
								<div class="popular_category d-flex flex-column align-items-center justify-content-center">
									<div class="popular_category_image">
										<a href="{{route('product', ['cat' => str_replace(' ','-',strtolower($kt->Name))])}}">
											<img src="{{asset('uploads/'.$kt->Img)}}" alt="">
										</a>
									</div>
									<div class="popular_category_text">
										<a style="color: #008080;" href="{{route('product', ['cat' => str_replace(' ','-',strtolower($kt->Name))])}}">
											<b>{{ $kt->Name }}</b>
										</a>
									</div>
								</div>
							</div>
							@endforeach

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>