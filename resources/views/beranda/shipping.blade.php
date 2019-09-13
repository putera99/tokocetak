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
                <form class="form-group" action="{{ route('payment') }}" method="post">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    <input name="tokenCourier" id="tokenCourier" type="hidden" value=""/>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Nama</label>
                        <div class="col-sm-8">
                            <input type="text" name="nama1" value="{{$arrData['nama1']}}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Provinsi</label>
                        <div class="col-sm-8">
                            <input type="text" id="provinsi1" name="provinsi1" value="{{$userAddr->provinsi->Name}}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Kota</label>
                        <div class="col-sm-8">
                            <input type="text" id="kota1" name="kota1" value="{{$arrData['kota1']}}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Kecamatan</label>
                        <div class="col-sm-8">
                            <input type="text" id="kecamatan1" name="kecamatan1" value="{{$userAddr->postal_code->District}}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Kelurahan</label>
                        <div class="col-sm-8">
                            <input type="text" id="kelurahan1" name="kelurahan1" value="{{$userAddr->postal_code->SubDistrict}}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Kode Pos</label>
                        <div class="col-sm-8">
                            <input type="text" id="kode_pos" name="kode_pos" value="{{$arrData['kode_pos']}}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Nomor Kontak</label>
                        <div class="col-sm-8">
                            <input type="text" id="nope" name="nope" value="{{$arrData['nope']}}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Alamat</label>
                        <div class="col-sm-8">
                            <textarea style="height: 100px;" id="alamat" class="form-control" name="alamat" rows="10" readonly>{{$arrData['alamat']}}</textarea>
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label class="col-sm-4 col-form-label" >Kurir</label>
                        <div class="col-sm-8">
                            <select class="kurir form-control" id="kurir" name="kurir" style="margin: 0px; 0px; 0px; 0px;">
                                <option selected="" disabled="">Pilih Kurir</option>
                                <option value="jne">JNE</option>
                                <option value="tiki">TIKI</option>
                                <option value="pos">POS</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label"></label>
                        <div class="col-sm-8">
                        <button type="button" class="btn btn-md btn-success"><a href="#" class="cek-ongkir" style="color:#fff;">Cek Biaya Kirim</a></button>
                        </div>
                    </div> -->
                    
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" >Kurir</label>
                        <div class="col-sm-4">
                            <select class="kurir form-control" id="kurir" name="kurir" style="margin: 0px; 0px; 0px; 0px;">
                                <option value="">-- Please Select --</option>
                                <option value="tiki">TIKI</option>
                            </select>
                            <br>
                            <img id="tikiLogo" style="max-width:50%;display:none;" src="{{asset('images/logo/tiki-logo.png')}}" class="img-fluid" alt="Responsive image">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Layanan</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="layananNya" name="layanan" style="margin: 0px; 0px; 0px; 0px;">
                                <option selected="" disabled="">-- Please Select --</option>
                            </select>
                        </div>
                        <label class="col-sm-4 col-form-label"><span class="badge badge-pill badge-success" id="est" style="font-size:15px;"></span></label>
                    </div>
                    <div class="cart_buttons">
						<button class="btn btn-md btn-success">Selanjutnya</button>
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

        // Cek Ongkir
        $('.cek-ongkir').click(function(e){
            e.preventDefault();
            $('.hasil-ongkir').empty();
            $('#modal-ongkir').modal();
            $("select[name='layanan']").empty();
            
            var kota_tujuan = $('#kode_pos').val();
            var kurir = $('.kurir').val();
            var berat = "{{ $berat }}";
            
            $.ajax({
                type:'get',
                url:"{{ url('checkout/cek') }}",
                data:{
                    kota_tujuan: kota_tujuan,
                    kurir: kurir,
                    berat: berat,
                },
                success: function(data){
                    $.each(data.hasil.rajaongkir.results,function(i,v){
                    
                    // var hasil = '<table class="table table-bordered">';
                    // var hasil = '<tbody>';
                    
                        $.each(v.costs,function(i,v){
                            console.log(v);

                            var layanan = v.service;
                            var cost = 0;
                            
                            $.each(v.cost,function(i,v){
                                cost = v.value;
                            })
                            
                            // console.log(layanan+'-'+cost);
                            
                            var hasil = '';
                            
                            hasil += '<option value="'+layanan+'-'+cost+'">';
                            hasil += layanan+'-'+cost;
                            hasil += '</option>';
                            
                            $('#layananNya').append(hasil);
                            
                        });

                        // hasil+='</tbody>'
                        // hasil+= '</table>';

                        
                    })
                    $('.cart_button_checkout').show();
                    $('#modal-ongkir').modal('hide');
                }
            })
        })
        
        //  TEST API
        $("#kurir").on('change',function(e){
            e.preventDefault();
            $("#est").html("");
            $("select[name='layanan']").empty();
            $("select[name='layanan']").append("<option>-- Please Select --</option>");
            var kurir = $(this).val()
            var kode_pos = $("#kode_pos").val();

            if(kurir=='tiki'){
                $("#tikiLogo").css("display","block");
                    $.ajax({
                    url: "{{route('get_tiki_token')}}",
                    type: 'POST',
                    data: {_token: "{{ csrf_token() }}", kurir:kurir},
                    dataType: 'JSON',
                    success: function (data){
                        if(data){
                            // console.log(data.result);
                            var tokenCourier = data.result;
                            $("#tokenCourier").val(tokenCourier);
                            $.ajax({
                                url: "{{route('get_layanan_tiki')}}",
                                type: 'POST',
                                data: {_token: "{{ csrf_token() }}", kurir:kurir,kode_pos:kode_pos,tikiToken:data.result},
                                dataType: 'JSON',
                                success: function (r){
                                    
                                    //  RETURN DATA FROM API NO ERROR
                                    if(!r.result.msg){
                                        // console.log(r.result.response);
                                        // var hasil = '<option value="">-- Please Select --</option>';
                                        $.each(r.result.response,function(i,v){
                                            var layanan = v.SERVICE + "-" + v.DESCRIPTION + "-" + v.TARIFF + "-" + v.EST_DAY + "-" + v.KGP;
                                            var textLayanan = v.DESCRIPTION + ' - ' + v.SERVICE + ' - ' + v.TARIFF;
                                            var dataEst = v.EST_DAY;
                                            
                                            var hasil = '';
                                            hasil += '<option data-est="'+dataEst+'" value="'+layanan+'">';
                                            hasil += textLayanan;
                                            hasil += '</option>';
                                            
                                            $('#layananNya').append(hasil);

                                            $("#layananNya").on('change',function(e){
                                                // console.log($(this).find(':selected').attr('data-est'));
                                                // console.log($(this).val());
                                                if($(this).val()!='-- Please Select --'){
                                                    $("#est").html("Estimasi Sampai " + $(this).find(':selected').attr('data-est') + " Hari");
                                                }
                                                if($(this).val()=='-- Please Select --'){
                                                    $("#est").html("");
                                                }
                                            })
                                        })
                                    }
                                }
                            })
                        }
                        // console.log(data);
                        // alert("adsadasd");
                        

                    }
			    })
            }
            else{
                $("#tikiLogo").css("display","none");
            }

        });

    });
</script>

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

@endsection