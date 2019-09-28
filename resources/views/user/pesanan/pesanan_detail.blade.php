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
	.breadcrumb-item+.breadcrumb-item::before {
		color: black;
	}
</style>
<div class="single_product">
	<div class="container" style="margin-top:-75px;">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb" style="background-color:#0E8CE4;">
				<li class="breadcrumb-item"><a href="{{url('/')}}" style="color:#fff">Home</a></li>
				<li class="breadcrumb-item"><a href="{{url('user/order')}}" style="color:#fff">Telusuri Pesanan</a></li>
				<li class="breadcrumb-item active" aria-current="page" style="color:#fff">Detail Pemesanan</li>
			</ol>
		</nav>
	</div>
	<br>	
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<legend>Informasi Alamat Pengiriman</legend>
				<div class="table-responsive-lg" style="font-size: 11px;">
					<table class="table table-hover">
						<tbody>
							<tr>
								<th style="width:100px;">Nama</th>
								<td>:</td>
								<td>{{ strtoupper($alamat->nama1) }}</td>
							</tr>
							<tr>
								<th style="width:100px;">No. Hp</th>
								<td>:</td>
								<td>{{ strtoupper($alamat->nope) }}</td>
							</tr>
							<tr>
								<th style="width:100px;">Kode Pos</th>
								<td>:</td>
								<td>{{ strtoupper($alamat->kode_pos) }}</td>
							</tr>
							<tr>
								<th style="width:100px;">Alamat</th>
								<td>:</td>
								<td>{{ strtoupper($alamat->alamat) }}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-md-6">
				<legend>Informasi Kurir</legend>
				<div class="table-responsive-lg" style="font-size: 11px;">
					<table class="table table-hover">
						<tbody>
							<tr>
								<th style="width:100px;">OrderID</th>
								<td>:</td>
								<td>{{ $alamat->pesanan_id }}</td>
							</tr>
							<tr>
								<th style="width:100px;">Kurir</th>
								<td>:</td>
								<td>{{ strtoupper($alamat->kurir) }}</td>
							</tr>
							<tr>
								<th style="width:100px;">Layanan Kurir</th>
								<td>:</td>
								<td>{{ strtoupper($alamat->layanan) }}</td>
							</tr>
							<tr>
								<th style="width:100px;">Biaya Kirim</th>
								<td>:</td>
								<td>Rp. {{ str_replace(',','.',number_format($alamat->ongkir,0)) }}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-body">
						<legend>Informasi Produk</legend>
						<div class="table-responsive-lg" style="font-size: 11px;">
							<table class="table table-hover">
								<thead>
									<tr>
										<!-- <th>Gambar</th> -->
										<th>Nama Produk</th>
										<th>Kategori Produk</th>
										<th>Tema Design</th>
										<th>Designer</th>
										<th>Qty</th>
										<th>Harga</th>
										<th>SubHarga</th>
										<th>Berat</th>
									</tr>
								</thead>
								<tbody>
									@foreach($barangs as $index=>$br)
									<tr>
										<!-- <td><img style="width: 50px;" src="{{ asset('uploads/'.$br->produk->FotoThumbnail) }}"></td> -->
										<td>{{ $br->produk->ProductName }}</td>
										<td>{{ $br->produk->CategoryName }}</td>
										<td>{{ $br->produk->Title }}</td>
										<td>{{ $br->produk->StoreName }}</td>
										<td>{{ $br->qty }}</td>
										<td>Rp. {{ str_replace(',','.',number_format($br->harga,0)) }}</td>
										<td>Rp. {{ str_replace(',','.',number_format($br->subharga,0)) }}</td>
										<td>{{ $br->berat*$br->qty }} Gram</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="accordion" id="accordionExample">
				<div class="card">
					<div class="card-header" id="headingOne">
					<h2 class="mb-0">
						<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						Deskripsi Produk
						</button>
					</h2>
					</div>

					<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
					<div class="card-body">
						<div class="product_text"><p>{!! $br->produk->Description !!}</p></div>
					</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header" id="headingTwo">
					<h2 class="mb-0">
						<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
						Gambar Design Produk
						</button>
					</h2>
					</div>
					<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
					<div class="card-body">
						<img src="{{ asset('uploads/'.$br->produk->FotoDetail_0) }}">
						<img src="{{ asset('uploads/'.$br->produk->FotoDetail_1) }}">
						<img src="{{ asset('uploads/'.$br->produk->FotoDetail_2) }}">
					</div>
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
