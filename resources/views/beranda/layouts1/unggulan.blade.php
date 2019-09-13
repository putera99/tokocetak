<div class="featured">
	<div class="tabbed_container">
		<div class="tabs">
			<ul class="clearfix">
				<li class="active">Unggulan</li>
				<!-- <li>On Sale</li> -->
				<!-- <li>Best Rated</li> -->
			</ul>
			<div class="tabs_line"><span></span></div>
		</div>

		<!-- Product Panel -->
		<div class="product_panel panel active">
			<div class="featured_slider slider">

				<!-- Slider Item -->
				@foreach($unggulan as $ug)
				<div class="featured_slider_item">
					<div class="border_active"></div>
					<div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
						<div class="product_image d-flex flex-column align-items-center justify-content-center">
							<a href="{{route('detail', ['s' => str_replace(' ','-',strtolower($ug->produk->StoreName)),'p'=>str_replace(' ','-',strtolower($ug->produk->ProductName)),'title'=>str_replace(' ','-',strtolower($ug->produk->Title)).'?id='.$ug->produk->StoreProductID ])}}">
								<img style="width: 115px;" src="{{asset('uploads/'.$ug->produk->FotoThumbnail)}}" alt="">
							</a>
						</div>
						<div class="product_content">
							<div class="product_price discount">
								<span style="color: #008080;">Rp. {{ str_replace(',','.',number_format($ug->produk->PriceFrom,0)) }}</span>

								@if($ug->produk->discount > 0)
								<span>
									Rp. {{ str_replace(',','.',number_format($ug->produk->PriceFrom,0)) }}
								</span>
								@endif

							</div>
							<div class="product_name"><div><a href="{{route('detail', ['s' => str_replace(' ','-',strtolower($ug->produk->StoreName)),'p'=>str_replace(' ','-',strtolower($ug->produk->ProductName)),'title'=>str_replace(' ','-',strtolower($ug->produk->Title)).'?id='.$ug->produk->StoreProductID ])}}">{{ str_limit($ug->produk->ProductName,15) }}</a></div></div>
							<div class="product_extras">
								<div class="product_color">
									<input type="radio" checked name="product_color">
								</div>
							</div>
						</div>

						@if(\Auth::user())
						<?php $whislist = Wishlist::getWishListItem($ug->StoreProductID, \Auth::user()->id); ?>
						@else
						<?php $whislist = null; ?>
						@endif

						@if($whislist)
							<div class="product_fav active" data-wishlist="{{$whislist['item_id']}}" data-id="{{ $ug->StoreProductID }}"><i class="fas fa-heart"></i></div>
						@else
						<div class="product_fav" data-id="{{ $ug->StoreProductID }}"><i class="fas fa-heart"></i></div>
						@endif
						<ul class="product_marks">
							<li class="product_mark product_discount" style="background-color:#0E8CE4;">New</li>
						</ul>
					</div>
				</div>
				@endforeach

			</div>
			<div class="featured_slider_dots_cover"></div>
		</div>
	</div>
</div>
<script src="{{asset('onetech/js/jquery-3.3.1.min.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".product_fav").each(function (i) {
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