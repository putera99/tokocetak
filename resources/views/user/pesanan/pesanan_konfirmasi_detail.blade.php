@extends('user.layouts.master')

@section('content')


<div class="row">
	<div class="col-md-12">
		<div class="box">
			
			<div class="box-body">
				
				<form role="form" action="{{ url('user/pesanan/konfirmasi/'.$pesanan_id) }}" method="post" enctype="multipart/form-data">
	              <div class="box-body">
	                <div class="form-group">
	                  <label for="exampleInputEmail1">Pesanan ID</label>
	                  <input type="text" value="{{ $pesanan_id }}" class="form-control" id="exampleInputEmail1" placeholder="Pesanan ID" disabled="">
	                </div>
	                <div class="form-group">
	                  <label for="exampleInputFile">Upload Bukti Pembayaran</label>
	                  <input type="file" name="image" id="exampleInputFile">

	                  <p class="help-block">Example block-level help text here.</p>
	                </div>
	              </div>
	              <!-- /.box-body -->

	              <div class="box-footer">
	                <button type="submit" class="btn btn-primary">Submit</button>
	              </div>
	            </form>

			</div>

		</div>
	</div>
</div>


@endsection

@section('scripts')

<script type="text/javascript">
	$(document).ready(function(){
		var flash = "{{ Session::has('pesan') }}";
		if(flash){
			var pesan = "{{ Session::get('pesan') }}";
			swal('success',pesan,'success');
		}
	})
</script>

@endsection