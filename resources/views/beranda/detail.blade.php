@extends('beranda.layouts2.master')

@section('content')

<title>Single Product</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="OneTech shop project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="{{asset('onetech/styles/bootstrap4/bootstrap.min.css')}}">
<link href="{{asset('onetech/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('onetech/plugins/OwlCarousel2-2.2.1/owl.carousel.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('onetech/plugins/OwlCarousel2-2.2.1/owl.theme.default.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('onetech/plugins/OwlCarousel2-2.2.1/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('onetech/styles/product_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('onetech/styles/product_responsive.css')}}">

<style type="text/css">
	tbody {
		border-top: 2px solid black;
	}
</style>

<div class="single_product">
	<div class="container">
		<div class="row">

				<!-- Images -->
				<div class="col-lg-2">
					<ul class="image_list">
						<li data-image="{{asset('uploads/'.$data->FotoDetail_0)}}"><img src="{{asset('uploads/'.$data->FotoDetail_0)}}" alt=""></li>
						<li data-image="{{asset('uploads/'.$data->FotoDetail_1)}}"><img src="{{asset('uploads/'.$data->FotoDetail_1)}}" alt=""></li>
						<li data-image="{{asset('uploads/'.$data->FotoDetail_2)}}"><img src="{{asset('uploads/'.$data->FotoDetail_2)}}" alt=""></li>
					</ul>
				</div>

				<!-- Selected Image -->
				<div class="col-lg-5">
					<div class="image_selected"><img src="{{asset('uploads/'.$data->FotoDetail_0)}}" alt=""></div>
				</div>

				<!-- Description -->
				<div class="col-lg-5">
					<div class="product_description">
						<div class="product_name">{{ $data->ProductName }}</div>
						<!-- <div class="rating_r rating_r_4 product_rating"><i></i><i></i><i></i><i></i><i></i></div> -->
						<table class="table">
							<tbody>
								<tr>
									<th>Title</th>
									<th>:</th>
									<td>{{ $data->Title }}</td>
								</tr>
								<tr>
									<th>Kategori</th>
									<th>:</th>
									<td>{{ $data->CategoryName }}</td>
								</tr>
								<tr>
									<th>Berat</th>
									<th>:</th>
									<td>{{ $data->WeightFrom }} gram</td>
								</tr>
								<!-- <tr>
									<th colspan="3"><button style="background: #008080;" type="button" class="button cart_button btn-cart">Masukkan ke Keranjang</button></th>
								</tr> -->
							</tbody>
						</table>
						<br>
						<div class="row">
							<div class="col-md-12">
								<div class="table-responsive-lg">
									<form id="frmAttr" action="{{ url('add-to-cart/'.$data->StoreProductID) }}">
										<table class="table">
											<thead>
												<td><label for="exampleInputEmail1">Quantity</label></td>
												<td>
													<input id="qty" class="form-control form-control-sm" name="qty" placeholder="" required type="number" value="1" min="1" max="100">
													<input id="StoreProductID" name="StoreProductID" value="{{$data->StoreProductID}}" hidden>
												</td>
											</thead>
											@foreach($headerColumn as $key => $header)
											<thead>
												<td><label for="{{$header->ParentAttributes}}">{{$header->ParentAttributes}}</label></td>
												<?php
													$attProd = \App\models\viewProductAttributes::select('AttributesName','StoreProductID',DB::raw('sum(TotalPrice) TotalPrice'))
													->where('ParentAttributes',$header->ParentAttributes)
													->where('StoreProductID',$data->StoreProductID)
													->groupBy('AttributesName','StoreProductID')->get();
												?>
												<td>
													<select class="form-control" id="cb{{$header->ParentAttributes}}" name="cb{{$header->ParentAttributes}}" style="margin:0px 0px 0px 0px;" requuired>
														<option value="">--Please Select--</option>
														@foreach($attProd as $key => $attribute)
															<option data-price="{{$attribute->TotalPrice}}" data-attr="{{$attribute->AttributesName}}">{{$attribute->AttributesName}}</option>
														@endforeach
													</select>
												</td>
											</thead>
											@endforeach
											<thead>
												<td>Harga</td>
												<td><b id="priceFrom">Rp. 0.00</b></td>
											</thead>
										</table>
										<button class="btn btn-success">Tambahkan ke keranjang</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

			<div class="row">
				<div class="col-lg-2">
				</div>
				<div class="col-lg-5">
					<div class="order_info d-flex flex-row">
							<form action="#">
								
								<div class="product_text"><p>{!! $data->Description !!}</p></div>
								
							</form>
						</div>
				</div>

				<div class="col-lg-5">
					<div class="product_description">
						
					</div>
				</div>

			</div>

		</div>
	</div>
</div>
<script src="{{asset('onetech/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('onetech/styles/bootstrap4/popper.js')}}"></script>
<script src="{{asset('onetech/styles/bootstrap4/bootstrap.min.js')}}"></script>
<script src="{{asset('onetech/styles/bootstrap4/bootstrap-input-spinner.js')}}"></script>
<script src="{{asset('onetech/plugins/greensock/TweenMax.min.js')}}"></script>
<script src="{{asset('onetech/plugins/greensock/TimelineMax.min.js')}}"></script>
<script src="{{asset('onetech/plugins/scrollmagic/ScrollMagic.min.js')}}"></script>
<script src="{{asset('onetech/plugins/greensock/animation.gsap.min.js')}}"></script>
<script src="{{asset('onetech/plugins/greensock/ScrollToPlugin.min.js')}}"></script>
<script src="{{asset('onetech/plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
<script src="{{asset('onetech/plugins/easing/easing.js')}}"></script>
<script src="{{asset('onetech/js/product_custom.js')}}"></script>

<script type="text/javascript">
	$("input[type='number']").inputSpinner()
	$(document).ready(function(){
		var formData = $(".table-responsive-lg").find("#frmAttr").serializeArray();
		$.ajax({
			url: "{{route('calculate')}}",
			type: 'POST',
			data: {_token: "{{ csrf_token() }}", arrData:formData},
			dataType: 'JSON',
			success: function (data){
				$("#priceFrom").html(data.total);
			}
		})  
		$("#frmAttr").submit(function(){
			var totalPrice = parseFloat($("#priceFrom").html().replace("Rp. ",""));
			if(totalPrice==0){
				alert("Silahkan periksa kembail inputan anda ...");
				return false;
			}
			else{
				return true;
			}
		});
		var flash = "{{ Session::has('pesan') }}";
		if(flash){
			var pesan = "{{ Session::get('pesan') }}";
			alert(pesan);
		}

		$('select').on('change', function() {
			var formData = $(".table-responsive-lg").find("#frmAttr").serializeArray();
			var id = $(this).attr("id");
			var cb = $("#" + id);
			$.ajax({
				url: "{{route('calculate')}}",
				type: 'POST',
				data: {_token: "{{ csrf_token() }}", arrData:formData},
				dataType: 'JSON',
				success: function (data){
					$("#priceFrom").html(data.total);
				}
			})  
		})

		$(".input-group-prepend").click(function () {
		var id = $(this).attr("id");
		var cb = $("#" + id);
		var formData = $(".table-responsive-lg").find("#frmAttr").serializeArray();
		$.ajax({
			url: "{{route('calculate')}}",
			type: 'POST',
			data: {_token: "{{ csrf_token() }}", arrData:formData},
			dataType: 'JSON',
			success: function (data){
				$("#priceFrom").html(data.total);
			}
		})
	})

	$(".input-group-append").click(function () {
		var id = $(this).attr("id");
		var cb = $("#" + id);
		var formData = $(".table-responsive-lg").find("#frmAttr").serializeArray();
		$.ajax({
			url: "{{route('calculate')}}",
			type: 'POST',
			data: {_token: "{{ csrf_token() }}", arrData:formData},
			dataType: 'JSON',
			success: function (data){
				$("#priceFrom").html(data.total);
			}
		})
	})

	});
</script>

@endsection