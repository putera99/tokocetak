@extends('beranda.layouts2.master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('onetech/styles/bootstrap4/bootstrap.min.css') }}">
<link href="{{ asset('onetech/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('onetech/styles/cart_styles.css') }}">
<div class="shop">
    <div class="container">

        <div class="row">
            <div class="col-lg-3">
                @include('user.sidebar')
            </div>
            <br>
            
            <div class="col-lg-9">
				<form action="{{ route('save_address') }}" method="post">
					<div class="row">
					    <div class="col-md-12">
							<fieldset>
								@if($userAddress['UserAddressID'])
								<h5>Ubah Alamat Pengiriman</h5>
								@else
								<h5>Tambah Alamat Pengiriman</h5>
								@endif
								<hr>
								<input name="_token" type="hidden" value="{{ csrf_token() }}"/>
								<input name="UAID" type="hidden" value="{{ $userAddress['UserAddressID'] }}"/>
								<div class="form-group row">
									<label for="exampleInputEmail1" class="col-sm-4 col-form-label" required>Nama</label>
									<div class="col-sm-4">
										@if($userAddress['UserAddressID'])
										<input type="text" name="nama1" value="{{$userAddress['Receiver']}}" class="form-control" required>
										@else
										<input type="text" name="nama1" class="form-control" required>
										@endif
									</div>
								</div>
								<div class="form-group row">
									<label for="exampleInputEmail1" class="col-sm-4 col-form-label" required>Provinsi</label>
									<div class="col-sm-8">
										<select class="addProvince form-control" name="addProvince" style="margin-left: 0px;" required>
											@if($userAddress['UserAddressID'])
											<option selected value="{{ $userAddress['ProvinceCode'] }}" >{{ $userAddress->provinsi['Name'] }}</option>
											@else
											<option selected>-- Please Select --</option>
											@endif
											<?php
												$dataProvince = \App\Models\Provinsi::get();
											?>
											@foreach($dataProvince as $key => $prov)
												<option value="{{$prov->Code}}">{{$prov->Name}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="exampleInputPassword1" class="col-sm-4 col-form-label" required>Kota</label>
									<div class="col-sm-4">
										<select class="addCity form-control" name="addCity" style="margin-left: 0px;" required>
											@if($userAddress['UserAddressID'])
											<option selected>{{ $userAddress->postal_code['City'] }}</option>
											@else
											<option selected>-- Please Select --</option>
											@endif
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="addKecamatan" class="col-sm-4 col-form-label" required>Kecamatan</label>
									<div class="col-sm-8">
										<select class="addKecamatan form-control" name="addKecamatan" style="margin-left: 0px;" required>
											@if($userAddress['UserAddressID'])
											<option selected>{{ $userAddress->postal_code['District'] }}</option>
											@else
											<option selected>-- Please Select --</option>
											@endif
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="addKelurahan" class="col-sm-4 col-form-label" required>Kelurahan</label>
									<div class="col-sm-8">
										<select class="addKelurahan form-control" name="addKelurahan" style="margin-left: 0px;" required>
											@if($userAddress['UserAddressID'])
											<option selected>{{ $userAddress->postal_code['SubDistrict'] }}</option>
											@else
											<option selected>-- Please Select --</option>
											@endif
										</select>
									</div>
								</div>
							</fieldset>
					    </div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group row">
								<label for="exampleInputEmail1" class="col-sm-4 col-form-label" required>Kode Pos</label>
								<div class="col-sm-4">
									<select class="addPos form-control" name="addPos" style="margin-left: 0px;" readonly required>
										@if($userAddress['UserAddressID'])
										<option selected value="{{$userAddress->postal_code['ID']}}">{{$userAddress->postal_code['PostalCode']}}</option>
										@else
										<option selected>-- Please Select --</option>
										@endif
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="exampleInputPassword1" class="col-sm-4 col-form-label" required>Nomor Kontak</label>
								<div class="col-sm-4">
									@if($userAddress['UserAddressID'])
									<input type="number" class="form-control" name="nope" value="{{ $userAddress['ContactNumber'] }}" required>
									@else
									<input type="number" class="form-control" name="nope" required>
									@endif
								</div>
							</div>
							<div class="form-group row">
								<label for="exampleInputPassword1" class="col-sm-4 col-form-label" required>Alamat Lengkap</label>
								<div class="col-sm-8">
									@if($userAddress['UserAddressID'])
									<textarea style="height: 100px;" class="form-control" name="alamat" rows="10" required>{{$userAddress['Address']}}</textarea>
									@else
									<textarea style="height: 100px;" class="form-control" name="alamat" rows="10" required></textarea>
									@endif
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group row">
								<label for="exampleInputPassword1" class="col-sm-4 col-form-label"></label>
								<div class="col-sm-8">
									<button type="submit" class="btn btn-md btn-success">Simpan</button>
									<a class="btn btn-md btn-danger" href="{{url('/settings')}}" style="color:#fff;">Batalkan</a>
								</div>
							</div>
						</div>
					</div>
				</form>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('onetech/js/jquery-3.3.1.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function(){
	var flash = "{{ Session::has('pesan') }}";
	if(flash){
		var pesan = "{{ Session::get('pesan') }}";
		alert(pesan);
	}

	var masalah = "{{ $errors->any() }}";
	if(masalah){
		alert('Semua form wajib diisi');
	}

	$('.addProvince').on('change',function(e){
		e.preventDefault();
		var id = $(this).val();
		// console.log(id);
		$('.addCity').empty();
		$('.addKecamatan').empty();
		$('.addKelurahan').empty();
		$('.addPos').empty();
		$.ajax({
			type:'get',
			dataType:'json',
			url:"{{ url('checkout/get_city') }}"+'/'+id,
			success:function(data){
				var hasil = '<option value="">-- Please Select --</option>';
				$.each(data.hasil,function(i,v){
					hasil += '<option value="'+v.City+'">';
					
					hasil += v.City
					
					hasil += '</option>';
				})
				
				$('.addCity').append(hasil)
			}
		})
	})

	$('.addCity').on('change',function(e){
		e.preventDefault();
		var id = $(this).val();
		$('.addKecamatan').empty();
		$('.addKelurahan').empty();
		$('.addPos').empty();
		$.ajax({
			type:'get',
			dataType:'json',
			url:"{{ url('checkout/get_kecamatan') }}"+'/'+id,
			success:function(data){
				var hasil = '<option value="">-- Please Select --</option>';
				$.each(data.hasil,function(i,v){
					hasil += '<option value="'+v.District+'">';
					
					hasil += v.District
					
					hasil += '</option>';
				})
				
				$('.addKecamatan').append(hasil)
			}
		})
	})

	$('.addKecamatan').on('change',function(e){
		e.preventDefault();
		var id = $(this).val();
		$('.addKelurahan').empty();
		$('.addPos').empty();
		$.ajax({
			type:'get',
			dataType:'json',
			url:"{{ url('checkout/get_kelurahan') }}"+'/'+id,
			success:function(data){
				var hasil = '<option value="">-- Please Select --</option>';
				$.each(data.hasil,function(i,v){
					hasil += '<option value="'+v.SubDistrict+'">';
					
					hasil += v.SubDistrict
					
					hasil += '</option>';
				})
				
				$('.addKelurahan').append(hasil)
			}
		})
	})

	$('.addKelurahan').on('change',function(e){
		e.preventDefault();
		var id = $(this).val();
		$('.addPos').empty();
		$.ajax({
			type:'get',
			dataType:'json',
			url:"{{ url('checkout/get_pos') }}"+'/'+id,
			success:function(data){
				var hasil = '<option value="">-- Please Select --</option>';
				$.each(data.hasil,function(i,v){
					hasil += '<option value="'+v.ID+'">';
					
					hasil += v.PostalCode
					
					hasil += '</option>';
				})
				
				$('.addPos').append(hasil)
			}
		})
	})

});
</script>
@endsection