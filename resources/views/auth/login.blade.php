@extends('beranda.layouts2.master')
<link rel="stylesheet" type="text/css" href="{{ asset('onetech/styles/bootstrap4/bootstrap.min.css') }}">
<link href="{{ asset('onetech/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('onetech/styles/cart_styles.css') }}">
@section('content')
<div class="cart_section">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 offset-3">
        <form method="POST" action="{{ route('login') }}">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="exampleInputEmail1">Email Address</label>
            <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email Address">
            @if ($errors->has('email'))
                <span class="help-block" style="color:red">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
            <span></span>
            <small id="emailHelp" class="form-text text-muted">Gunakan email pada saat anda mendaftar di tokocetak</small>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password">
            @if ($errors->has('password'))
                <span class="help-block" style="color:red">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
            <span></span>
          </div>
          <div class="form group">
            <div class="form-check">
              <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} class="form-check-input" style="margin: 5px 0px 0px 0px;">
              <label class="form-check-label" for="exampleCheck1" style="margin: 0px 0px 0px 0px">Remember Me</label>
              <label class="form-check-label" for="exampleCheck1" style="margin: 0px 0px 0px 0px;"><a href="{{route('password.reset')}}">Forgot Password</a></label>
            </div>
            <button type="submit" class="btn btn-primary">Sign In</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
