@extends('admin.layouts.master')

@section('content')

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="box">
			<div class="box-body">
				
				<form role="form" action="{{ url('admin/best-seller/tambah') }}" method="post">
					{{ csrf_field() }}
		          <div class="box-body">

		          	<div class="form-group">
		              <label for="exampleInputEmail1">Pilih Produk</label>
		              <select class="form-control select2" name="product_id">
		              	<option selected="" disabled="">Pilih Produk</option>
		              	@foreach($data as $dt)
		              	<option value="{{ $dt->product_id }}">{{ $dt->nama }}</option>
		              	@endforeach
		              </select>
		              @if ($errors->has('product_id'))
				            <span class="help-block">
				                <strong>{{ $errors->first('product_id') }}</strong>
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