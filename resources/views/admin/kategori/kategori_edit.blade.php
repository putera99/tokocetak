@extends('admin.layouts.master')

@section('content')

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="box">
			<div class="box-body">
				<center>
					<img style="width: 100px;" src="{{ asset('uploads/'.$data->gambar) }}">
				</center>
				<form role="form" action="{{ url('admin/kategori/'.$data->kategori_id) }}" method="post" enctype="multipart/form-data">
					{{ csrf_field() }}
					{{ method_field('put') }}
		          <div class="box-body">

		            <div class="form-group">
		              <label for="exampleInputEmail1">Nama Kategori</label>
		              <input type="text" name="nama" value="{{ $data->nama }}" class="form-control" id="exampleInputEmail1" placeholder="Nama Kategori">
		              @if ($errors->has('nama'))
				            <span class="help-block">
				                <strong>{{ $errors->first('nama') }}</strong>
				            </span>
				        @endif
		            </div>

		            <div class="form-group">
		              <label for="exampleInputFile">File input</label>
		              <input type="file" name="image" id="exampleInputFile" multiple="">

		              <p class="help-block">Ganti Gambar Kategori.</p>
		            </div>
		          </div>

		          <div class="box-footer">
		            <button type="submit" class="btn btn-primary">Update <span class="glyphicon glyphicon-pencil"></span></button>
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
			alert(pesan);
		}
	});
</script>

@endsection