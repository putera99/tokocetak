@extends('user.layouts.master')

@section('content')


<div class="row">
	<div class="col-md-12">
		<div class="box">
			
			<div class="box-body">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th style="width: 10px;">#</th>
							<th>Tanggal</th>
							<th>Total Harga</th>
							<th>Status</th>
							<th><center>Detail</center></th>
						</tr>
					</thead>
					<tbody>
						@foreach($data as $index=>$dt)
						<tr>
							<td>{{ $index+1 }}</td>
							<td>{{ date('d-M-Y',strtotime($dt->tanggal)) }}</td>
							<td>Rp. {{ str_replace(',','.',number_format($dt->total_harga,0)) }}</td>
							<td>{{ $dt->statuss->nama }}</td>
							<td>
								<center>
									<a target="_blank" href="{{ url('user/pesanan/konfirmasi/'.$dt->pesanan_id) }}" class="btn bg-olive margin">Konfirmasi Pesanan</a>
									<a target="_blank" href="{{ url('user/pesanan/detail/'.$dt->pesanan_id) }}" class="btn bg-maroon margin">Detail Pesanan</a>
								</center>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
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