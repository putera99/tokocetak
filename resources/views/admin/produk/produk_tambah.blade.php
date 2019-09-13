@extends('admin.layouts.master')

@section('content')

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="box">
			<div class="box-body">
				
				<form role="form" action="{{ url('admin/produk/tambah') }}" method="post" enctype="multipart/form-data">
					{{ csrf_field() }}
		          <div class="box-body">

		            <div class="form-group">
		              <label for="exampleInputEmail1">Nama Product</label>
		              <input type="text" name="nama" value="{{ old('nama') }}" class="form-control" id="exampleInputEmail1" placeholder="Nama Product">
		              @if ($errors->has('nama'))
				            <span class="help-block">
				                <strong>{{ $errors->first('nama') }}</strong>
				            </span>
				        @endif
		            </div>

		            <div class="form-group">
		              <label for="exampleInputEmail1">Kategori</label>
		              <select class="form-control select2" name="kategori_id">
		              	<option selected="" disabled="">Pilih Kategori</option>
		              	@foreach($kategori as $kt)
		              	<option value="{{ $kt->kategori_id }}">{{ $kt->nama }}</option>
		              	@endforeach
		              </select>
		              @if ($errors->has('nama'))
				            <span class="help-block">
				                <strong>{{ $errors->first('nama') }}</strong>
				            </span>
				        @endif
		            </div>

		            <div class="form-group">
		              <label for="exampleInputPassword1">Harga</label>
		              <input type="number" name="harga_awal" value="{{ old('harga_awal') }}" class="form-control" id="exampleInputPassword1" placeholder="Harga">
		              @if ($errors->has('harga_awal'))
				            <span class="help-block">
				                <strong>{{ $errors->first('harga_awal') }}</strong>
				            </span>
				        @endif
		            </div>

		            <div class="form-group">
		              <label for="exampleInputPassword1">Discount (%)</label>
		              <input type="number" name="discount" value="{{ old('discount') }}" class="form-control" id="exampleInputPassword1" placeholder="Discount">
		              @if ($errors->has('discount'))
				            <span class="help-block">
				                <strong>{{ $errors->first('discount') }}</strong>
				            </span>
				        @endif
		            </div>

		            <div class="form-group">
		              <label for="exampleInputPassword1">Stock</label>
		              <input type="number" name="stock" value="{{ old('stock') }}" class="form-control" id="exampleInputPassword1" placeholder="stock">
		              @if ($errors->has('stock'))
				            <span class="help-block">
				                <strong>{{ $errors->first('stock') }}</strong>
				            </span>
				        @endif
		            </div>

		            <div class="form-group">
		              <label for="exampleInputPassword1">Berat (gram)</label>
		              <input type="number" name="berat" value="{{ old('berat') }}" class="form-control" id="exampleInputPassword1" placeholder="Berat">
		              @if ($errors->has('berat'))
				            <span class="help-block">
				                <strong>{{ $errors->first('berat') }}</strong>
				            </span>
				        @endif
		            </div>

		            <div class="form-group">
		              <label for="exampleInputPassword1">Keterangan</label>
		              <textarea class="form-control summernote" name="keterangan"></textarea>
		              @if ($errors->has('keterangan'))
				            <span class="help-block">
				                <strong>{{ $errors->first('keterangan') }}</strong>
				            </span>
				        @endif
		            </div>

		            <table class="table">
		            	<tbody>
		            		@foreach($warna->chunk(3) as $warnaChunk)
			            	<tr>
			            		@foreach($warnaChunk as $wn)
			            		<td><input type="checkbox" value="{{ $wn->warna_id }}" name="warna_id[]"><span style="background-color: {{$wn->kode}}" class="square"></span> {{ $wn->nama }}</td>
			            		@endforeach
			            	</tr>
			            	@endforeach
		            	</tbody>
		            </table>

		            <div class="form-group">
		              <label for="exampleInputFile">Ukuran</label>
		              <table class="table">
		              	<tbody>
		              		@foreach($ukuran->chunk(3) as $ukuranChunk)
		              		<tr>
		              			@foreach($ukuranChunk as $uk)
		              			<td><input type="checkbox" name="ukuran_id[]" value="{{ $uk->ukuran_id }}"> {{ $uk->nama }}</td>
		              			@endforeach
		              		</tr>
		              		@endforeach
		              	</tbody>
		              </table>
		            </div>

		            <div class="form-group">
		              <label for="exampleInputFile">File input</label>
		              <input type="file" name="gambar[]" id="exampleInputFile" multiple="">

		              <p class="help-block">Upload Gambar Produk.</p>
		            </div>
		          </div>
		          <!-- /.box-body -->

		          	<div class="form-group">
		              	<label for="exampleInputPassword1">status</label>
		              	<select class="form-control select2" name="status">
		              		<option value="1">Aktifkan</option>
		              		<option value="2">Non-Aktifkan</option>
		              	</select>
		              	@if ($errors->has('status'))
				            <span class="help-block">
				                <strong>{{ $errors->first('status') }}</strong>
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