<div class="row">	
	<div class="col-lg-12">
		<div class="table-responsive-lg">
			<table class="table table-hover">
				<thead>
					<tr>
						<th style="width: 10px;">#</th>
						<th>Nomor Order</th>
						<th>Layanan</th>
						<th>Metode Pembayaran</th>
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
						<td>{{ $dt->pesanan_id }}</td>
						<td>{{ $dt->address->layanan }}</td>
						<td>{{ $dt->payment_method->Name }}</td>
						<td>{{ date('d-M-Y H:i:s',strtotime($dt->tanggal)) }}</td>
						<td>Rp. {{ str_replace(',','.',number_format($dt->total_harga,0)) }}</td>
						<td>{{ $dt->order_status->Name }}</td>
						<td>
							<center>
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