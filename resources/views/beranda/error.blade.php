@extends('beranda.layouts2.master')

@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('onetech/styles/bootstrap4/bootstrap.min.css') }}">
<link href="{{ asset('onetech/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('onetech/styles/cart_styles.css') }}">

<style>
/* @font-face {
    font-family: 'Glyphicons Halflings';
    src: url("{{asset('onetech/fonts/glyphicons-halflings-regular.eot')}}");
    src: url("{{asset('onetech/fonts/glyphicons-halflings-regular.eot?#iefix')}}") format('embedded-opentype'), url("{{asset('onetech/fonts/glyphicons-halflings-regular.woff')}}") format('woff'), url("{{asset('onetech/fonts/glyphicons-halflings-regular.ttf')}}") format('truetype'), url("{{asset('onetech/fonts/glyphicons-halflings-regular.svg#glyphicons-halflingsregular')}}") format('svg');
} */
</style>

<div class="cart_section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Terjadi Kesalahan</h4>
                    <p>Terjadi kesalahan pada saat melakukan pembayaran online</p>
                    <hr>
                    <p class="mb-0">Silahkan Hubungi Customer Service Kami</p>
                </div>
                
            </div>
        </div>
    </div>
</div>

<script src="{{asset('onetech/js/jquery-3.3.1.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){

        
    });
</script>


	

@endsection