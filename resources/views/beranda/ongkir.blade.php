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
	
	@if($userAddr)
		<div class="modal fade" id="modalAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<!-- modal content -->
				<div class="modal-content">
					<!-- modal header -->
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Informasi Alamat Pengiriman</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<!-- modal body -->
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12">			
								<div class="accordion" id="accordionExample">
									@foreach($userAddr as $key => $addr)
									<div class="card text-white bg-light">
											<div class="card-header bg-info" id="heading{{$key+1}}">
											<h2 class="mb-0">
												<button style="color:#fff;" class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{$key+1}}" aria-expanded="true" aria-controls="collapse{{$key+1}}">
												Address #{{$key + 1}}
												</button>
											</h2>
											<div id="collapse{{$key+1}}" class="collapse" aria-labelledby="heading{{$key+1}}" data-parent="#accordionExample">
												<div class="card-body">
													<form action="{{ url('checkout/set_address/'.$addr->UserAddressID) }}" method="GET">
														<table class="table">
															<tbody>
																<td>Nama</td>
																<td>:</td>
																<td>{{$addr->Receiver}}</td>
															</tbody>
															<tbody>
																<td>Provinsi</td>
																<td>:</td>
																<td>{{$addr->provinsi->Name}}</td>
															</tbody>
															<tbody>
																<td>Kota</td>
																<td>:</td>
																<td>{{$addr->postal_code->City}}</td>
															</tbody>
															<tbody>
																<td>Kecamatan</td>
																<td>:</td>
																<td>{{$addr->postal_code->District}}</td>
															</tbody>
															<tbody>
																<td>Kelurahan</td>
																<td>:</td>
																<td>{{$addr->postal_code->SubDistrict}}</td>
															</tbody>
															<tbody>
																<td>Kode Pos</td>
																<td>:</td>
																<td>{{$addr->postal_code->PostalCode}}</td>
															</tbody>
															<tbody>
																<td>Nomor Kontak</td>
																<td>:</td>
																<td>{{$addr->ContactNumber}}</td>
															</tbody>
															<tbody>
																<td>Alamat</td>
																<td>:</td>
																<td>{{$addr->Address}}</td>
															</tbody>
														</table>
														@if($addr->IsDefault==0)
															<button class="btn btn-md btn-success">Jadikan Sebagai Alamat Pengiriman</button>						
														@endif
													</form>
												</div>
											</div>
										</div>
									</div>
									@endforeach
								</div>
							</div>
						</div>
					</div>
					<!-- modal footer -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	@endif
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<button type="button" class="btn btn-md btn-success" data-toggle="modal" data-target="#modalAddress">Tampilkan Informasi Alamat</button>	
				<button type="button" class="btn btn-md btn-success" data-toggle="modal" data-target="#newAddress">Tambah Alamat Baru</button>
			</div>
		</div>
	</div>
	<!-- Modal Add Alamat -->
	<div class="modal fade" id="newAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Tambah Alamat Baru</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12">
							<form method="get" action="{{url('checkout/add_address')}}">
								<div class="form-group row">
									<label for="addName" class="col-sm-4 col-form-label">Nama</label>
									<div class="col-sm-8">
										<input type="text" name="addName" class="form-control">
									</div>
								</div>
								<div class="form-group row">
									<label for="addPhone" class="col-sm-4 col-form-label">Nomor Kontak</label>
									<div class="col-sm-8">
										<input type="text" name="addPhone" class="form-control">
									</div>
								</div>
								<div class="form-group row">
									<label for="addProvince" class="col-sm-4 col-form-label">Provinsi</label>
									<div class="col-sm-8">
										<select class="addProvince form-control" name="addProvince" style="margin-left: 0px;">
											<option selected value="">-- Please Select --</option>
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
									<label for="addCity" class="col-sm-4 col-form-label">Kota</label>
									<div class="col-sm-8">
										<select class="addCity form-control" name="addCity" style="margin-left: 0px;">
											<option></option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="addKecamatan" class="col-sm-4 col-form-label">Kecamatan</label>
									<div class="col-sm-8">
										<select class="addKecamatan form-control" name="addKecamatan" style="margin-left: 0px;">
											<option></option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="addKelurahan" class="col-sm-4 col-form-label">Kelurahan</label>
									<div class="col-sm-8">
										<select class="addKelurahan form-control" name="addKelurahan" style="margin-left: 0px;">
											<option></option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="addPos" class="col-sm-4 col-form-label">Kode Pos</label>
									<div class="col-sm-8">
										<select class="addPos form-control" name="addPos" style="margin-left: 0px;" readonly>
											<option></option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="addAlamat" class="col-sm-4 col-form-label">Alamat</label>
									<div class="col-sm-8">
									<textarea style="height: 100px;" class="form-control" name="addAlamat" rows="10"></textarea>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-12">
										<button class="btn btn-md btn-success">Simpan</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="container">
		<div class="row">
			<div class="col-lg-10">
				<div class="cart_container">
					<div class="cart_title">Informasi Alamat Pengiriman</div>
					<div class="cart_items">
						@if(!$userAddrDefault)
						<div class="alert alert-warning" role="alert">
							<h4 class="alert-heading">Hallo, <b>{{ Auth::user()->name}}</b></h4>
							<p>Sepertinya anda belum menambahkan informasi alamat Pengiriman, silahkan tambahkan alamat pengiriman anda terlebih dahulu sebelum melakukan pemesanan di TokoCetak </p>
							<hr>
							<p class="mb-0">Terima kasih <b>{{ \Auth::user()->name }}</b>, salam <b>TokoCetak</b></p>
						</div>
						@endif
					</div>
				<!-- Order Total -->
				@if($userAddrDefault)
				<form action="{{ route('shipping') }}" method="post">
					<div class="row">
					    <div class="col-md-12">
							<fieldset>
								<input name="_token" type="hidden" value="{{ csrf_token() }}"/>
								<div class="form-group row">
									<label for="exampleInputEmail1" class="col-sm-4 col-form-label">Nama</label>
									<div class="col-sm-4">
										<input type="text" name="nama1" value="{{ $userAddrDefault->Receiver }}" class="form-control" readonly>
									</div>
								</div>
								<div class="form-group row">
									<label for="exampleInputEmail1" class="col-sm-4 col-form-label">Provinsi</label>
									<div class="col-sm-8">
										<select class="provinsi1 form-control" name="provinsi1" style="margin-left: 0px;" readonly>
											<option selected value="{{ $userAddrDefault->ProvinceCode }}" >{{ $userAddrDefault->provinsi->Name }}</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="exampleInputPassword1" class="col-sm-4 col-form-label">Kota</label>
									<div class="col-sm-4">
										<select class="kota1 form-control" name="kota1" style="margin-left: 0px;" readonly>
											<option selected>{{ $userAddrDefault->postal_code->City }}</option>
										</select>
									</div>
								</div>
							</fieldset>
					    </div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group row">
								<label for="exampleInputEmail1" class="col-sm-4 col-form-label">Kode Pos</label>
								<div class="col-sm-4">
									<input type="number" class="form-control" name="kode_pos" value="{{ $userAddrDefault->postal_code->PostalCode }}" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="exampleInputPassword1" class="col-sm-4 col-form-label">Nomor Kontak</label>
								<div class="col-sm-4">
									<input type="number" class="form-control" name="nope" value="{{ $userAddrDefault->ContactNumber }}" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="exampleInputPassword1" class="col-sm-4 col-form-label">Alamat Lengkap</label>
								<div class="col-sm-8">
									<textarea style="height: 100px;" class="form-control" name="alamat" rows="10" readonly>{{$userAddrDefault->Address}}</textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="cart_buttons">
						<button class="btn btn-md btn-success">Selanjutnya</button>
					</div>
				</form>
				@endif
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="modal-ongkir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <!--<h4 class="modal-title" id="myModalLabel">Modal title</h4>-->
      </div>
      <div class="modal-body">
        <p><b><i>Harap tunggu.. </i></b></p>
      </div>
    </div>
  </div>
</div>
<script src="{{asset('onetech/js/jquery-3.3.1.min.js')}}"></script>
<script type="text/javascript">
		$(document).ready(function(){

			$('#dropship_form').css('display','none');

		    var flash = "{{ Session::has('pesan') }}";
		    if(flash){
		        var pesan = "{{ Session::get('pesan') }}";
		        alert(pesan);
		    }

		    var masalah = "{{ $errors->any() }}";
		    if(masalah){
		    	alert('Semua form wajib diisi');
		    }

		    var provinsi1 = '';
		    var provinsi2 = '';
		    var kota1 = '';
		    var kota2 = '';
		    
		    // // Cek Ongkir
		    // $('.cek-ongkir').click(function(e){
		    //     e.preventDefault();
		    //     $('.hasil-ongkir').empty();
		    //     $('#modal-ongkir').modal();
		    //     $("select[name='layanan']").empty();
		        
		    //     var kota_asal = $('.kota1').val();
		    //     var kota_tujuan = $('.kota2').val();
		    //     var kurir = $('.kurir').val();
		    //     var berat = "{{ $berat }}";
		        
		    //     $.ajax({
		    //         type:'get',
		    //         url:"{{ url('checkout/cek') }}",
		    //         data:{
		    //             kota_asal: kota_asal,
		    //             kota_tujuan: kota_tujuan,
		    //             kurir: kurir,
		    //             berat: berat,
		    //         },
		    //         success: function(data){
		    //             $.each(data.hasil.rajaongkir.results,function(i,v){

            //             // var hasil = '<table class="table table-bordered">';
            //             // var hasil = '<tbody>';
                        
            //                 $.each(v.costs,function(i,v){
            //                     console.log(v);
    
            //                     var layanan = v.service;
            //                     var cost = 0;
                                
            //                     $.each(v.cost,function(i,v){
            //                         cost = v.value;
            //                     })
                                
            //                     console.log(layanan+'-'+cost);
                                
            //                     var hasil = '';
                                
            //                     hasil += '<option value="'+layanan+'-'+cost+'">';
            //                     hasil += layanan+'-'+cost;
            //                     hasil += '</option>';
                                
            //                     $('.layananNya').append(hasil);
                                
            //                 });
    
            //                 // hasil+='</tbody>'
            //                 // hasil+= '</table>';
    
                            
            //             })
            //             $('.cart_button_checkout').show();
            //             $('#modal-ongkir').modal('hide');
		    //         }
		    //     })
		    // })
		    
			// $('.btn-cart').click(function(e){
			// 	e.preventDefault();
			// 	$('#modal-cart').modal();
			// });
			
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
			
			// $('body').on('change','.provinsi2',function(e){
			//     e.preventDefault();
			//     var id = $(this).val();
			//     $('.kota2').empty();
			//     $.ajax({
			//         type:'get',
			//         dataType:'json',
			//         url:"{{ url('checkout/kota') }}"+'/'+id,
			//         success:function(data){
			//             console.log(data.data.rajaongkir.results);
			            
			//             var hasil = '';
			//             $.each(data.data.rajaongkir.results,function(i,v){
			//                 hasil += '<option value="'+v.city_id+'">';
			                
			//                 hasil += v.city_name
			                
			//                 hasil += '</option>';
			//             })
			            
			//             $('.kota2').append(hasil)
			//         }
			//     })
			// })

		});
	</script>


@endsection