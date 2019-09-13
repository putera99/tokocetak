@extends('beranda.layouts2.master')

@section('content')

<title>Pesanan Product</title>
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
			<div class="col-lg-12">
				<div class="table-responsive-lg" style="font-size: 11px;">
					<table class="table table-hover">
						<thead>
							<tr>
								<th style="width: 10px;">#</th>
								<th>Nomor Order</th>
								<th>Kurir</th>
								<th>Layanan</th>
								<th>Biaya Kirim</th>
								<th>Metode Pembayaran</th>
								<th>Tanggal</th>
								<th>Total Harga</th>
								<th>Status</th>
								<th><center>Detail</center></th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $index=>$dt)
							<tr>
								<td>{{ $index+1 }}</td>
								<td>{{ $dt->pesanan_id }}</td>
								<td>{{ $dt->address->kurir }}</td>
								<td>{{ $dt->address->layanan }}</td>
								<td>{{ $dt->address->ongkir }}</td>
								<td>{{ $dt->payment_method->Name }}</td>
								<td>{{ date('d-M-Y H:i:s',strtotime($dt->tanggal)) }}</td>
								<td>Rp. {{ str_replace(',','.',number_format($dt->total_harga,0)) }}</td>
								<td>
									@if($dt->order_status->Status==2)
										<button type="button" class="btn btn-small btn-link" style="font-size:11px;margin-top: -7px;">
									@elseif($dt->order_status->Status==3)
										<button type="button" class="btn btn-small btn-warning" style="font-size:11px;margin-top: -7px;">
									@elseif($dt->order_status->Status==4)
										<button type="button" class="btn btn-small btn-info" style="font-size:11px;margin-top: -7px;">
									@elseif($dt->order_status->Status==5)
										<button type="button" class="btn btn-small btn-secondary" style="font-size:11px;margin-top: -7px;">
									@elseif($dt->order_status->Status==6)
										<button type="button" class="btn btn-small btn-dark" style="font-size:11px;margin-top: -7px;">
									@elseif($dt->order_status->Status==7)
										<button type="button" class="btn btn-small btn-primary" style="font-size:11px;margin-top: -7px;">
									@elseif($dt->order_status->Status==8)
										<button type="button" class="btn btn-small btn-success" style="font-size:11px;margin-top: -7px;">
									@else
										<button type="button" class="btn btn-small btn-danger" style="font-size:11px;margin-top: -7px;">
									@endif
										{{ $dt->order_status->Name }}
									</button>
								</td>
								<td>
									<a href="{{ url('user/order/detail/'.$dt->pesanan_id) }}" style="font-size: 11px;">Detail Pesanan</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="viewed">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="viewed_title_container">
					<h3 class="viewed_title">Terakhir Dilihat</h3>
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
							$data = \App\Models\InfoProductLastView::select('StoreProductID')->groupBy('StoreProductID')->limit(10)->get();
						?>
						@foreach($data as $dt)
						<div class="owl-item">
							<div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
								<div class="viewed_image"><img src="{{ asset('uploads/'.$dt->produk->FotoThumbnail) }}" alt=""></div>
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
<script src="{{asset('onetech/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('onetech/styles/bootstrap4/popper.js')}}"></script>
<script src="{{asset('onetech/styles/bootstrap4/bootstrap.min.js')}}"></script>
<script src="{{asset('onetech/plugins/greensock/TweenMax.min.js')}}"></script>
<script src="{{asset('onetech/plugins/greensock/TimelineMax.min.js')}}"></script>
<script src="{{asset('onetech/plugins/scrollmagic/ScrollMagic.min.js')}}"></script>
<script src="{{asset('onetech/plugins/greensock/animation.gsap.min.js')}}"></script>
<script src="{{asset('onetech/plugins/greensock/ScrollToPlugin.min.js')}}"></script>
<script src="{{asset('onetech/plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
<script src="{{asset('onetech/plugins/easing/easing.js')}}"></script>
<script src="{{asset('onetech/js/product_custom.js')}}"></script>
@endsection