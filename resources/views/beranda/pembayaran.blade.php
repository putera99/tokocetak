@extends('beranda.layouts2.master')

@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('onetech/styles/bootstrap4/bootstrap.min.css') }}">
<link href="{{ asset('onetech/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('onetech/styles/cart_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('onetech/styles/cart_responsive.css') }}">

<div class="cart_section">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 offset-lg-1">
				<div class="cart_container">
					<div class="cart_title">{{ $title }}</div>
					
					<div class="cart_items">
					    
					    <center>
					    	<h2>Silahkan Melakukan Pembayaran ke No. Rek</h2>
					    	<h3><i>BCA : 0123345789</i></h3>
					    	<h2>A/N</h2>
					    	<h3><i>Fulan Bin Fulan</i></h3>
					    	<br>
					    	<br>
					    	<h4>Setelah itu lakukan konfirmasi pembayaran di dalam Dashboard Kamu, <a href="">Klik Disini</a></h4>
					    </center>
						
					</div>
					
					<!-- Order Total -->


				
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
		    var flash = "{{ Session::has('pesan') }}";
		    if(flash){
		        var pesan = "{{ Session::get('pesan') }}";
		        alert(pesan);
		    }

		    var masalah = "{{ $errors->any() }}";
		    if(masalah){
		    	alert('Semua form wajib diisi');
		    }

		    
		});
	</script>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

@endsection