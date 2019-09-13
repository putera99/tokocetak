@extends('beranda.layouts2.master')

@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('onetech/styles/bootstrap4/bootstrap.min.css') }}">
<link href="{{ asset('onetech/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('onetech/styles/cart_styles.css') }}">

<style>
/* @font-face {
    font-family: 'Glyphicons Halflings';
    src: url("{{asset('onetech/fonts/glyphicons-halflings-regular.eot')}}");
    src: url("{{asset('onetech/fonts/glyphicons-halflings-regular.eot?#iefix')}}") format('embedded-opentype'), url("{{asset('onetech/fonts/glyphicons-halflings-regular.woff')}}") format('woff'), url("{{asset('onetech/fonts/glyphicons-halflings-regular.ttf')}}") format('truetype'), url("{{asset('onetech/fonts/glyphicons-halflings-regular.svg#glyphicons-halflingsregular')}}") format('svg');
} */
</style>

<div class="cart_section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form class="form-horizontal" id="submitPayment" onsubmit="return submitForm()">
                    <input name="OrderID" id="OrderID" type="hidden" value="{{ $OrderID }}"/>
                    <input name="StoreProductID" id="StoreProductID" type="hidden" value="{{ $arrData['StoreProductID'] }}"/>
                    <input name="qty" id="qty" type="hidden" value="{{ $qty }}"/>
                    <input name="brt" id="brt" type="hidden" value="{{ $brt }}"/>
                    <input name="berat" id="berat" type="hidden" value="{{ $berat }}"/>
                    <input name="price" id="price" type="hidden" value="{{ $price }}"/>
                    <input name="totalPrice" id="totalPrice" type="hidden" value="{{ $totalPrice }}"/>
                    <input name="nama1" id="nama1" type="hidden" value="{{ $arrData['nama1'] }}"/>
                    <input name="provinsi1" id="provinsi1" type="hidden" value="{{ $arrData['provinsi1'] }}"/>
                    <input name="kota1" id="kota1" type="hidden" value="{{ $arrData['kota1'] }}"/>
                    <input name="kecamatan1" id="kecamatan1" type="hidden" value="{{ $arrData['kecamatan1'] }}"/>
                    <input name="kelurahan1" id="kelurahan1" type="hidden" value="{{ $arrData['kelurahan1'] }}"/>
                    <input name="kurir" id="kurir" type="hidden" value="{{ $arrData['kurir'] }}"/>
                    <input name="kode_pos" id="kode_pos" type="hidden" value="{{ $arrData['kode_pos'] }}"/>
                    <input name="nope" id="nope" type="hidden" value="{{ $arrData['nope'] }}"/>
                    <input name="alamat" id="alamat" type="hidden" value="{{ $arrData['alamat'] }}"/>
                    <input name="biayaKirim" id="biayaKirim" type="hidden" value="{{ $arrData['biayaKirim'] }}"/>
                    
                        <div class="table-responsive-lg" style="font-size: 11px;">
                        <legend>Informasi Alamat Pengririman</legend>
                        <br>
							<table class="table table-hover">
								<tbody>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>{{ \Auth::user()->name }}</td>
								</tbody>
                                <tbody>
                                    <td>Nomor Kontak</td>
                                    <td>:</td>
                                    <td>{{ $arrData['nope'] }}</td>
                                </tbody>
                                <tbody>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td>{{ \Auth::user()->email }}</td>
                                </tbody>
                                <tbody>
                                    <td>Provinsi</td>
                                    <td>:</td>
                                    <td>{{ $arrData['provinsi1'] }}</td>
                                </tbody>
                                <tbody>
                                    <td>Kota</td>
                                    <td>:</td>
                                    <td>{{ $arrData['kota1'] }}</td>
                                </tbody>
                                <tbody>
                                    <td>Kecamatan</td>
                                    <td>:</td>
                                    <td>{{ $arrData['kecamatan1'] }}</td>
                                </tbody>
                                <tbody>
                                    <td>Kelurahan</td>
                                    <td>:</td>
                                    <td>{{ $arrData['kelurahan1'] }}</td>
                                </tbody>
                                <tbody>
                                    <td>Kode Pos</td>
                                    <td>:</td>
                                    <td>{{ $arrData['kode_pos'] }}</td>
                                </tbody>
                                <tbody>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td>{{ $arrData['alamat'] }}</td>
                                </tbody>
							</table>
						</div>
                        <br>
                        <div class="table-responsive-lg" style="font-size: 11px;">
                        <legend>Informasi Layanan Pengririman</legend>
                        <br>
							<table class="table table-hover">
								<tbody>
                                    <td>Nama Layanan</td>
                                    <td>:</td>
                                    <td>{{ $arrData['layanan'] }}</td>
								</tbody>
                                <tbody>
                                    <td>Kurir</td>
                                    <td>:</td>
                                    <td>{{ strtoupper($arrData['kurir']) }}</td>
                                </tbody>
                                <tbody>
                                    <td>Biaya Pengiriman</td>
                                    <td>:</td>
                                    <td>Rp. {{ number_format($arrData['biayaKirim'],2,",",".") }}</td>
                                </tbody>
                                <tbody>
                                    <td>Estimasi Pengiriman</td>
                                    <td>:</td>
                                    <td>{{ $arrData['estimasi'] }} Hari</td>
                                </tbody>
							</table>
						</div>
                        <div class="cart_items">
                            <legend>Informasi Pemesanan</legend>
                            @foreach(\Cart::content() as $ct)
                            <ul class="cart_list">
                                <li class="cart_item clearfix">
                                    <?php
                                        $gambar = \App\Models\viewStoreProducts::where('StoreProductID',$ct->id)->first();
                                    ?>
                                    <div class="cart_item_image"><img style="max-height: 110%;" src="{{ asset('uploads/'.$gambar->gambar->FotoThumbnail) }}" alt=""></div>
                                    <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                        <div class="cart_item_name cart_info_col">
                                            <div class="cart_item_title">Name</div>
                                            <div class="cart_item_text">{{ $ct->name }}</div>
                                        </div>
                                        <div class="cart_item_quantity cart_info_col">
                                            <div class="cart_item_title">Quantity</div>
                                            <div class="cart_item_text">{{ $ct->qty }}</div>
                                        </div>
                                        <div class="cart_item_price cart_info_col">
                                            <div class="cart_item_title">Price</div>
                                            <div class="cart_item_text">Rp. {{ number_format($ct->price,0) }}</div>
                                        </div>
                                        <div class="cart_item_total cart_info_col">
                                            <div class="cart_item_title">Total</div>
                                            <div class="cart_item_text">Rp. {{ number_format($ct->price * $ct->qty,0) }}</div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            @endforeach
					    </div>
                        <div class="order_total">
                            <div class="order_total_content text-md-right">
                                <div class="order_total_title">Order Total</div>
                                <div class="order_total_amount">Rp. {{ number_format($price,2,",",".") }}</div>
                            </div>
                        </div>
                        <div class="order_total">
                            <div class="order_total_content text-md-right">
                                <div class="order_total_title">Total Yang Harus Dibayarkan (termasuk biaya kirim)</div>
                                <div class="order_total_amount">Rp.  {{ number_format($totalPrice,2,",",".") }}</div>
                            </div>
                        </div>
                    <!-- <div class="form-group row">
                        <label class="col-sm-4 col-form-label" >Kurir</label>
                        <div class="col-sm-4">
                            <select class="kurir form-control" id="payment_method" name="payment_method" style="margin: 0px; 0px; 0px; 0px;">
                                <option selected>Pilih Metode Pembayaran</option>
                                <?php 
                                    $paymentMethods = \App\Models\Payments::where('Active', 1)->get(); 
                                ?>
                                @foreach($paymentMethods as $key => $pay)
                                <option name="pm{{$pay->Name}}" id="pm{{$pay->Name}}" value="{{$pay->ID}}">{{$pay->Name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> -->

                    <div class="cart_buttons">
						<button class="btn btn-md btn-success" id="submit">Submit Pembayaran</button>
					</div>

                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('onetech/js/jquery-3.3.1.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){

        
    });
</script>
<script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
<script src="{{ !config('services.midtrans.isProduction') ? 'https://app.sandbox.midtrans.com/snap/snap.js' : 'https://app.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
<script type="text/javascript">
    function submitForm() {
        var redirectFinish = "{{ env('APP_URL') }}" + "/finish_payment";
        var redirectUnfinish = "{{ env('APP_URL') }}" + "/unfinish_payment";
        var redirectError = "{{ env('APP_URL') }}" + "/error_payment";
        $.post("{{ route('submit') }}",
        {
            _method: 'POST',
            _token: '{{ csrf_token() }}',
            OrderID: $('#OrderID').val(),
            StoreProductID: $('#StoreProductID').val(),
            brt: $('#brt').val(),
            berat: $('#berat').val(),
            qty: $('#qty').val(),
            totalPrice: $('#totalPrice').val(),
            price: $('#price').val(),
            provinsi1: $('#provinsi1').val(),
            kota1: $('#kota1').val(),
            kecamatan1: $('#kecamatan1').val(),
            kelurahan1: $('#kelurahan1').val(),
            kurir: $('#kurir').val(),
            kode_pos: $('#kode_pos').val(),
            nope: $('#nope').val(),
            alamat: $('#alamat').val(),
            nama1: $('#nama1').val(),
            biayaKirim: $('#biayaKirim').val()
        },
        function (data, status) {
            // console.log(data);
            snap.pay(data.snap_token, {
                // Optional
                onSuccess: function (result) {
                    // console.log(result);
                    // alert("MIDTRANS NOTIFICATION");
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2)
                    // location.reload();
                    // window.location = '{{ route("finish_payment") }}';
                    $.redirect(redirectFinish,
                    {
                        _token: '{{ csrf_token() }}',
                        OrderID: $('#OrderID').val(),
                        StoreProductID: $('#StoreProductID').val(),
                        brt: $('#brt').val(),
                        berat: $('#berat').val(),
                        qty: $('#qty').val(),
                        totalPrice: $('#totalPrice').val(),
                        price: $('#price').val(),
                        provinsi1: $('#provinsi1').val(),
                        kota1: $('#kota1').val(),
                        kecamatan1: $('#kecamatan1').val(),
                        kelurahan1: $('#kelurahan1').val(),
                        kurir: $('#kurir').val(),
                        kode_pos: $('#kode_pos').val(),
                        nope: $('#nope').val(),
                        alamat: $('#alamat').val(),
                        nama1: $('#nama1').val(),
                        biayaKirim: $('#biayaKirim').val()
                    });
                },
                // Optional
                onPending: function (result) {
                    // console.log(result);
                    // alert("MIDTRANS NOTIFICATION");
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2)
                    // location.reload();
                    $.redirect(redirectUnfinish,
                    {
                        _token: '{{ csrf_token() }}',
                        OrderID: $('#OrderID').val(),
                        StoreProductID: $('#StoreProductID').val(),
                        brt: $('#brt').val(),
                        berat: $('#berat').val(),
                        qty: $('#qty').val(),
                        totalPrice: $('#totalPrice').val(),
                        price: $('#price').val(),
                        provinsi1: $('#provinsi1').val(),
                        kota1: $('#kota1').val(),
                        kecamatan1: $('#kecamatan1').val(),
                        kelurahan1: $('#kelurahan1').val(),
                        kurir: $('#kurir').val(),
                        kode_pos: $('#kode_pos').val(),
                        nope: $('#nope').val(),
                        alamat: $('#alamat').val(),
                        nama1: $('#nama1').val(),
                        biayaKirim: $('#biayaKirim').val()
                    });
                },
                // Optional
                onError: function (result) {
                    // console.log(result);
                    // alert("MIDTRANS NOTIFICATION");
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2)
                    // location.reload();
                    $.redirect(redirectError,
                    {
                        _token: '{{ csrf_token() }}',
                        OrderID: $('#OrderID').val(),
                        StoreProductID: $('#StoreProductID').val(),
                        brt: $('#brt').val(),
                        berat: $('#berat').val(),
                        qty: $('#qty').val(),
                        totalPrice: $('#totalPrice').val(),
                        price: $('#price').val(),
                        provinsi1: $('#provinsi1').val(),
                        kota1: $('#kota1').val(),
                        kecamatan1: $('#kecamatan1').val(),
                        kelurahan1: $('#kelurahan1').val(),
                        kurir: $('#kurir').val(),
                        kode_pos: $('#kode_pos').val(),
                        nope: $('#nope').val(),
                        alamat: $('#alamat').val(),
                        nama1: $('#nama1').val(),
                        biayaKirim: $('#biayaKirim').val()
                    });
                }
            });
        });
        return false;
    }
</script>


	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

@endsection