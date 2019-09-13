@extends('admin.layouts.master')

@section('content')

<div class="box">
	<div class="box-body">
		
		<p>
			<a style="float: right;" class="btn btnCustom btn-warning btn-flat daftar-kode"><span class="glyphicon glyphicon-list-alt"></span> Daftar Kode Warna</a>
		</p>

		<form method="post" action="{{ url('admin/warna/'.$data->warna_id) }}">
			{{ csrf_field() }}
			{{ method_field('put') }}
		  <div class="form-group">
		    <label for="exampleInputEmail1">Nama</label>
		    <input type="text" name="nama" value="{{ $data->nama }}" class="form-control" id="exampleInputEmail1" placeholder="Nama Warna">
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Kode Warna</label>
		    <input type="text" name="kode" value="{{ $data->kode }}" class="form-control" id="exampleInputPassword1" placeholder="Kode Warna">
		  </div>
		  <button type="submit" class="btn btn-primary">Update <span class="glyphicon glyphicon-pencil"></span></button>
		</form>

	</div>
</div>

<!-- Modal Warna -->
<div class="modal fade" id="modal-kode" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">List Kode Warna</h4>
      </div>
      <div class="modal-body">
        <center><img src="{{ asset('warna.PNG') }}"></center>
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

		$('body').on('click','.btn-hapus',function(e){
			e.preventDefault();
			var url = $(this).attr('href');
			$('#modal-hapus').find('a').attr('href',url);
			$('#modal-hapus').modal();
		})

		$('.daftar-kode').click(function(e){
			e.preventDefault();
			$('#modal-kode').modal();
		})
	});
</script>

@endsection