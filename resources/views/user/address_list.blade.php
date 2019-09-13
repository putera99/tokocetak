<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <a class="btn btn-md btn-success" href="{{url('edit_address')}}" style="color:#fff;">Tambah Alamat Baru</a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-hover" id="laravel_datatable" style="font-size:10px;">
                <thead>
                    <td>Penerima</td>
                    <td>No. HP</td>
                    <td>Provinsi</td>
                    <td>Kota</td>
                    <td>Kecamatan</td>
                    <td>Kelurahan</td>
                    <td>Kode Pos</td>
                    <td>Alamat</td>
                    <td>Action</td>
                </thead>
            </table>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#laravel_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
        url: "{{route('address_list')}}",
        type: 'GET',
        },
        columns: [
            {data:'Receiver',name:'Receiver'},
            {data:'ContactNumber',name:'ContactNumber'},
            {data:'provinsi.Name',name:'provinsi.Name'},
            {data:'postal_code.City',name:'postal_code.City'},
            {data:'postal_code.District',name:'postal_code.District'},
            {data:'postal_code.SubDistrict',name:'postal_code.SubDistrict'},
            {data:'postal_code.PostalCode',name:'postal_code.PostalCode'},
            {data:'Address',name:'Address'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        order: [[0, 'desc']]
      });
})
</script>