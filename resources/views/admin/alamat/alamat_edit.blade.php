@extends('admin.layouts.master')

@section('content')

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="box">
			<div class="box-body">
				
			</div>
			<div class="box-header">
				<form role="form" method="POST" action="{{ url('admin/alamat') }}">
					{{ csrf_field() }}
                    {{ method_field('put') }}
					<div class="form-group">
						<textarea name="alamat" class="form-control textarea" rows="10">{{ $dt->alamat }}</textarea>
					</div>
                                       <div class="form-group">
						<input type="email" class="form-control" name="email" value="{{ $dt->email }}">
					</div>
                                        <div class="form-group">
						<input type="number" class="form-control" name="nope" value="{{ $dt->nope }}">
					</div>
					<button type="submit" class="form-control btn-primary">Update <i class="fa fa-fw fa-edit"></i></button>
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
	})
</script>

@endsection