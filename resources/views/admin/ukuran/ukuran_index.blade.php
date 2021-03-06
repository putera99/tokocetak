@extends('admin.layouts.master')

@section('content')

<div class="box">
	<div class="box-body">
		
		<a href="{{ url('admin/ukuran/tambah') }}" class="btn btnCustom btn-primary btn-flat"><span class="glyphicon glyphicon-plus"></span> Tambah Ukuran</a>
		<table class="table myTable table-bordered">
			<thead>
				<tr>
					<th style="width: 10px;">#</th>
					<th>Nama</th>
					<th><center>Action</center></th>
				</tr>
			</thead>
			<tbody>
				@foreach($data as $index=>$dt)
				<tr>
					<td>{{ $index+1 }}</td>
					<td>{{ $dt->nama }}</td>
					<td><center><a href="{{ url('admin/ukuran/'.$dt->ukuran_id) }}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a> <a href="{{ url('admin/ukuran/delete/'.$dt->ukuran_id) }}" class="btn btn-xs btn-danger btn-hapus"><i class="glyphicon glyphicon-edit"></i> Hapus</a></center></td>
				</tr>
				@endforeach
			</tbody>
		</table>

	</div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="modal-hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Hapus Product</h4>
      </div>
      <div class="modal-body">
        <p><b><i>Yakin ingin menghapus product ini?</i></b></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a href="#" class="btn btn-primary">Hapus</a>
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
	})
</script>

@endsection