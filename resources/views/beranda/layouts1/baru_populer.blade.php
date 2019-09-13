<div class="new_arrivals">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="tabbed_container">
						<div class="tabs clearfix tabs-right">
							<div class="new_arrivals_title">List produk</div>
							<ul class="clearfix">
								<li class="active"></li>
								<li></li>
								<li></li>
							</ul>
							<div class="tabs_line"><span></span></div>
						</div>
						<div class="row">
							<div class="col-lg-12" style="z-index:1;">

								<!-- Product Panel -->
								<div class="product_panel panel active">
									<div class="arrivals_slider slider">

										<!-- Slider Item -->
										<?php $produk = \App\Models\viewStoreProducts::where('StoreProductStatus',1)->orderBy('created_at','desc')->limit(10)->get(); ?>

										@foreach($produk as $pr)
										<div class="arrivals_slider_item" style="width: 300px;">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center">
													<a href="{{route('detail', ['s' => str_replace(' ','-',strtolower($pr->StoreName)),'p'=>str_replace(' ','-',strtolower($pr->ProductName)),'title'=>str_replace(' ','-',strtolower($pr->Title)).'?id='.$pr->StoreProductID ])}}">
														<img style="width: 115px;" src="{{asset('uploads/'.$pr->gambar->FotoThumbnail)}}" alt="">
													</a>
												</div>
												<div class="product_content">
													<a style="color: #008080" href="{{route('detail', ['s' => str_replace(' ','-',strtolower($pr->StoreName)),'p'=>str_replace(' ','-',strtolower($pr->ProductName)),'title'=>str_replace(' ','-',strtolower($pr->Title)).'?id='.$pr->StoreProductID ])}}">
														<div class="product_price">
															Rp. {{ str_replace(',','.',number_format($pr->PriceFrom,0)) }}
														</div>
													</a>
													<div class="product_name">
														<div>
															<a href="{{route('detail', ['s' => str_replace(' ','-',strtolower($pr->StoreName)),'p'=>str_replace(' ','-',strtolower($pr->ProductName)),'title'=>str_replace(' ','-',strtolower($pr->Title)).'?id='.$pr->StoreProductID ])}}">
																<p style="word-wrap: break-word;">
																	{{ $pr->ProductName }}
																</p>
															</a>
														</div>
													</div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color">
														</div>
													</div>
												</div>
												@if(\Auth::user())
												<?php $whislist = Wishlist::getWishListItem($pr->StoreProductID, \Auth::user()->id); ?>
												@else
												<?php $whislist = null; ?>
												@endif

												@if($whislist)
													<div id="listProduct" class="product_fav active" data-wishlist="{{$whislist['item_id']}}" data-id="{{ $pr->StoreProductID }}"><i class="fas fa-heart"></i></div>
												@else
												<div class="product_fav" id="listProduct" data-id="{{ $pr->StoreProductID }}"><i class="fas fa-heart"></i></div>
												@endif
												<ul class="product_marks">
												<li class="product_mark product_discount" style="background-color:#0E8CE4;display:block;visibility:visible;opacity:inherit;">New</li>
												</ul>
											</div>
										</div>
										@endforeach

									</div>
									<div class="arrivals_slider_dots_cover"></div>
								</div>

								<!-- Product Panel -->
							</div>

						</div>
								
					</div>
				</div>
			</div>
		</div>		
	</div>
<script src="{{asset('onetech/js/jquery-3.3.1.min.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#listProduct").each(function (i) {
			$(this).click(function () {
				var StoreProductID = $(this).attr("data-id");
				$.ajax({
					url: "{{route('update_wishlist')}}",
					type: 'POST',
					data: {_token: "{{ csrf_token() }}", StoreProductID:StoreProductID},
					dataType: 'JSON',
					success: function (data){
						
						if(data.success==1){
							var pesan = data.result;
							alert(pesan);
							window.location.reload();
						}
						if(data.success==11){
							var pesan = data.result;
							alert(pesan);
							window.location.reload();
						}
						if(data.success==0)
						{
							var pesan = data.result;
							alert(pesan);
						}
						if(data.success==999){
							var pesan = data.result;
							alert(pesan);
							window.location.href = "{{URL::to('login')}}";
						}
					}
				})
			})
		})
	})
</script>