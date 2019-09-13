@extends('admin.layouts.master')

@section('content')

<div class="box">
	<div class="box-body">
		
		<a href="{{ url('admin/warna/tambah') }}" class="btn btnCustom btn-primary btn-flat"><span class="glyphicon glyphicon-plus"></span> Tambah Warna</a>
		<table class="table table-bordered myTable">
			<thead>
				<tr>
					<th>#</th>
					<th><center>Kode</center></th>
					<th>Nama</th>
					<th><center>Action</center></th>
				</tr>
			</thead>
			<tbody>
				@foreach($data as $index=>$dt)
				<tr>
					<td>{{ $index+1 }}</td>
					<td><center>
						<div style="background-color: {{$dt->kode}}" class="square"></div>
					</center></td>
					<td>{{ $dt->nama }}</td>
					<td><center><a href="{{ url('admin/warna/'.$dt->warna_id) }}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a> <a href="{{ url('admin/warna/delete/'.$dt->warna_id) }}" class="btn btn-xs btn-danger btn-hapus"><i class="glyphicon glyphicon-edit"></i> Hapus</a></center></td>
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
        <p><b><i>Yakin ingin menghapus kategori ini?</i></b></p>
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
	});
</script>

@endsection