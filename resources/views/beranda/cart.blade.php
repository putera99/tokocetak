@extends('beranda.layouts2.master')

@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('onetech/styles/bootstrap4/bootstrap.min.css') }}">
<link href="{{ asset('onetech/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('onetech/styles/cart_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('onetech/styles/cart_responsive.css') }}">
<style>
.input-group {
	width:75%;
}
</style>
<div class="cart_section">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 offset-lg-1">
				<div class="cart_container">
					<div class="cart_title">Keranjang Belanja</div>
					<div class="cart_items">
					    @foreach(\Cart::content() as $key => $ct)
						<ul class="cart_list">
							<li class="cart_item clearfix">
							    <?php
							        $gambar = \App\Models\viewStoreProducts::where('StoreProductID',$ct->id)->first();
							    ?>
								<form id="cartForm">
									<input type="hidden" name="rowId" id="rowId" class="rowId" value="{{ $ct->rowId }}" />
									<div class="cart_item_image"><img src="{{ asset('uploads/'.$gambar->gambar->FotoThumbnail) }}" alt=""></div>
									<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
										<div class="cart_item_name cart_info_col">
											<div class="cart_item_title">Name</div>
											<div class="cart_item_text">{{ $ct->name }}</div>
										</div>
										<div class="cart_item_quantity cart_info_col">
											<div class="cart_item_title">Quantity</div>
											<div class="cart_item_text">
												<!-- {{ $ct->qty }} -->
												<input row-id="{{$ct->rowId}}"  id="qty" class="form-control form-control-sm" name="qty" placeholder="" required type="number" value="{{ $ct->qty }}" min="1" max="100">
											</div>
										</div>
										<div class="cart_item_price cart_info_col">
											<div class="cart_item_title">Price</div>
											<div class="cart_item_text">Rp. {{ number_format($ct->price,0) }}</div>
										</div>
										<div class="cart_item_total cart_info_col">
											<div class="cart_item_title">Total</div>
											<div class="cart_item_text">Rp. {{ number_format($ct->price * $ct->qty,0) }}</div>
										</div>
										<div class="cart_item_total cart_info_col">
											<div class="cart_item_title"></div>
											<div class="cart_item_text">
												<button class="btn btn-danger btn-sm" id="removeCart" data-id="{{$ct->rowId}}" style="margin-top: 17px;" type="button">Hapus</button>
											</div>
										</div>
									</div>
								</form>
							</li>
						</ul>
						@endforeach
					</div>
					<!-- Order Total -->
					<div class="order_total">
						<div class="order_total_content text-md-right">
							<div class="order_total_title">Order Total:</div>
							<div class="order_total_amount">Rp. {{ str_replace(',','.',\Cart::subtotal()) }}</div>
						</div>
					</div>
					<div class="cart_buttons">
						@if(count(Cart::content())>0)
						<button type="button" class="btn btn-dark"><a href="{{ url('cart/remove') }}" style="color:#fff;">Kosongkan Semua Keranjang</a></button>
						@endif
						<button type="button" class="btn btn-success"><a href="{{ url('/') }}" style="color:#fff;">Lanjut Belanja</a></button>
						@if(count(Cart::content())>0)
						<button type="button" class="btn btn-primary"><a id="bayar" href="{{ url('checkout/index') }}" style="color:#fff">Lanjut Bayar</a></button>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="{{asset('onetech/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('onetech/styles/bootstrap4/bootstrap-input-spinner.js')}}"></script>
<script type="text/javascript">
	$("input[type='number']").inputSpinner()
	$(document).ready(function(){

		var total = "{{Cart::subtotal()}}";
		if(parseInt(total)==0){
			$(".btn.btn-primary").prop('disabled', true);
			$('#bayar').click(function(e) {
				e.preventDefault();
				return false;
			});
		}
		
		var flash = "{{ Session::has('pesan') }}";
		if(flash){
			var pesan = "{{ Session::get('pesan') }}";
			alert(pesan);
		}
		
		$('.btn-cart').click(function(e){
			e.preventDefault();
			$('#modal-cart').modal();
		});

		$(".input-group-prepend").click(function() {
			var formData = $(".cart_list").find("#cartForm").serializeArray();
			$.ajax({
				url: "{{route('update_cart')}}",
				type: 'POST',
				data: {_token: "{{ csrf_token() }}", arrData:formData},
				dataType: 'JSON',
				success: function (data){
					window.location.reload();
				}
			})
		})

		$(".input-group-append").click(function() {
			var formData = $(".cart_list").find("#cartForm").serializeArray();
			$.ajax({
				url: "{{route('update_cart')}}",
				type: 'POST',
				data: {_token: "{{ csrf_token() }}", arrData:formData},
				dataType: 'JSON',
				success: function (data){
					window.location.reload();
				}
			})
		})

		$("button[id='removeCart']").each(function(i){
			$(this).click(function(){
				var rowId = $(this).attr("data-id");
				var r = confirm('Hapus Terpilih ?');
				if (r) {
					$.ajax({
						url: "{{route('delete_cart')}}",
						type: 'POST',
						data: {_token: "{{ csrf_token() }}", rowId:rowId},
						dataType: 'JSON',
						success: function (data){
							window.location.reload();
						}
					})
				}
			})
		})
		
	});
</script>

@endsection