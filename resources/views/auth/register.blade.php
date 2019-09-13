@extends('beranda.layouts2.master')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('onetech/styles/bootstrap4/bootstrap.min.css') }}">
<link href="{{ asset('onetech/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('onetech/styles/cart_styles.css') }}">
{!! NoCaptcha::renderJs() !!}
<div class="cart_section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} row">
                        <label for="name" class="col-md-4 control-label">Nama Lengkap</label>

                        <div class="col-md-4">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block" style="color:red;">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }} row">
                        <label for="phone" class="col-md-4 control-label">Nomor Telepon Seluler</label>

                        <div class="col-md-4">
                            <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required autofocus>

                            @if ($errors->has('phone'))
                                <span class="help-block" style="color:red;">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} row">
                        <label for="email" class="col-md-4 control-label">Alamat Email</label>

                        <div class="col-md-4">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span style="color:red;" class="help-block" style="color:red;">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} row">
                        <label for="password" class="col-md-4 control-label">Password</label>

                        <div class="col-md-4">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block" style="color:red;">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                        <div class="col-md-4">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            {!! NoCaptcha::display(['data-theme' => 'white']) !!}
                            @if ($errors->has('g-recaptcha-response'))
                                <span class="help-block" style="color:red;">
                                    <strong>Invalid Captcha</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">
                                Register
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('onetech/js/jquery-3.3.1.min.js')}}"></script>
@endsection
