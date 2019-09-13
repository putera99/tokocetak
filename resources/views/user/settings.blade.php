@extends('beranda.layouts2.master')

@section('content')
<link  href="{{asset('css/jquery.dataTables.min.css')}}" rel="stylesheet">
<div class="shop">
    <div class="container">
        <div class="alert alert-success" role="alert">
            <p>Selamat datang dihalaman user profile <b>{{\Auth::user()->name}}</b>.</p>
        </div>
        <div class="row">
            <div class="col-lg-3">
                @include('user.sidebar')
            </div>
            <div class="col-lg-9">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Biodata Diri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Daftar Alamat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="security-tab" data-toggle="tab" href="#security" role="tab" aria-controls="security" aria-selected="false">Ubah Password</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab" style="padding-top:30px;">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h5>Biodata Diri</h5>
                                    <table class="table table-hover">
                                        <tbody>
                                            <td style="width: 25%;">Nama</td>
                                            <td></td>
                                            <td>{{\Auth::user()->name}}</td>
                                        </tbody>
                                        <tbody>
                                            <td style="width: 25%;">Tanggal Lahir</td>
                                            <td></td>
                                            @if(\Auth::user()->BirthDate)
                                                <td>{{\Auth::user()->BirthDate}}</td>
                                            @else
                                                <td><a href="#" data-toggle="modal" data-target="#modalTL">Tambahkan Tanggal Lahir</a></td>
                                            @endif
                                        </tbody>
                                        <tbody>
                                            <td style="width: 25%;">Jenis Kelamin</td>
                                            <td></td>
                                            @if(\Auth::user()->gender)
                                                @if(\Auth::user()->gender=='L')
                                                <td>Laki-Laki</td>
                                                @else
                                                <td>Wanita</td>
                                                @endif
                                            @else
                                                <td><a href="#" data-toggle="modal" data-target="#modalJK">Tambahkan Jenis Kelamin</a></td>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h5>Kontak</h5>
                                    <table class="table table-hover">
                                        <tbody>
                                            <td style="width: 29%;">Email</td>
                                            <td></td>
                                            <td>
                                                {{\Auth::user()->email}}&nbsp 
                                                @if(\Auth::user()->email_verified_at)
                                                    <div class="alert alert-success" role="alert" style="width: 23%;padding-bottom: 3px;">
                                                        <h5 class="alert-heading"><small><b>Terverifikasi</b></small></h5>
                                                    </div>
                                                @else
                                                    <div class="alert alert-warning" role="alert" style="width: 32%;padding-bottom: 3px;">
                                                        <h5 class="alert-heading"><small><b><a href="#" style="color:red;">Belum Terverifikasi</a></b></small></h5>
                                                    </div>
                                                @endif
                                            </td>
                                        </tbody>
                                        <tbody>
                                            <td style="width: 29%;">Nomor HP</td>
                                            <td></td>
                                            <td>{{\Auth::user()->phone}}</td>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab" style="padding-top:30px;">
                        @include('user.address_list')
                    </div>
                    <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab" style="padding-top:30px;">
                        @include('user.change_password')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalTL" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="container-fluid">
        <form action="{{route('save_birthdate')}}" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Informasi Tanggal Lahir</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                            <div class="form-group row">
                                <label for="staticEmail2" class="col-sm-6 col-form-label" required>&nbsp&nbspTanggal Lahir</label>
                                <div class="col-sm-6">
                                    <input type="date" id="date" name="birthDate" required>
                                </div>
                            </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-md btn-secondary" data-dismiss="modal">Tutup</button>
                    <button class="btn btn-md btn-success">Simpan</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalJK" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="container-fluid">
        <form action="{{route('save_gender')}}" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Informasi Jenis Kelamin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                        <label class="radio-inline col-sm-6"><input type="radio" name="optradio" checked value="L">&nbsp Laki-Laki</label>
                        <label class="radio-inline col-sm-6"><input type="radio" name="optradio" value="P">&nbsp Wanita</label>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-md btn-secondary" data-dismiss="modal">Tutup</button>
                    <button class="btn btn-md btn-success">Simpan</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
<script src="{{asset('onetech/js/jquery-3.3.1.min.js')}}"></script>
<script type="text/javascript">
$(function() {
    var flash = "{{ Session::has('pesan') }}";
    if(flash){
        var pesan = "{{ Session::get('pesan') }}";
        alert(pesan);
    }

    var masalah = "{{ $errors->any() }}";
    if(masalah){
        alert('Semua form wajib diisi');
    }
    // $( "#datepicker" ).datepicker();
});
</script>
@endsection