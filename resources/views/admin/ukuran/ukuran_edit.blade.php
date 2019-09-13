@extends('admin.layouts.master')

@section('content')

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="box">
			<div class="box-body">
				
				<form role="form" action="{{ url('admin/ukuran/'.$data->ukuran_id) }}" method="post">
					{{ csrf_field() }}
					{{ method_field('put') }}
		          <div class="box-body">

		            <div class="form-group">
		              <label for="exampleInputEmail1">Nama</label>
		              <input type="text" name="nama" value="{{ $data->nama }}" class="form-control" id="exampleInputEmail1" placeholder="Nama Ukuran">
		              @if ($errors->has('nama'))
				            <span class="help-block">
				                <strong>{{ $errors->first('nama') }}</strong>
				            </span>
				        @endif
		            </div>

		          <div class="box-footer">
		            <button type="submit" class="btn btn-primary">Update</button>
		          </div>
		        </form>

			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')



@endsection