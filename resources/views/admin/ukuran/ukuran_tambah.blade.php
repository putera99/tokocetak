@extends('admin.layouts.master')

@section('content')

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="box">
			<div class="box-body">
				
				<form role="form" action="{{ url('admin/ukuran/tambah') }}" method="post">
					{{ csrf_field() }}
		          <div class="box-body">

		            <div class="form-group">
		              <label for="exampleInputEmail1">Nama</label>
		              <input type="text" name="nama" value="{{ old('nama') }}" class="form-control" id="exampleInputEmail1" placeholder="Nama Ukuran">
		              @if ($errors->has('nama'))
				            <span class="help-block">
				                <strong>{{ $errors->first('nama') }}</strong>
				            </span>
				        @endif
		            </div>

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



@endsection