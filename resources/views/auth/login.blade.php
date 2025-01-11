@extends('layouts.base_admin.base_auth')
@section('judul', 'Halaman Login')
@section('content')
<style>
    body {
        background-image: url({{ asset('frontend/assets/images/lampos.jpg') }});
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
    }
    .login-box {
        background: rgba(255, 255, 255, 0.8); /* Optional: to make the login box slightly transparent */
        padding: 20px;
        border-radius: 10px;
    }
</style>
<div class="login-box">
    <div class="login-logo">
        <h3>Selera Kampung</h3>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Masuk</p>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input
                        id="email"
                        type="email"
                        placeholder="Email"
                        class="form-control @error('email') is-invalid @enderror"
                        name="email"
                        value="{{ old('email') }}"
                        required="required"
                        autocomplete="email"
                        autofocus="autofocus">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input
                        id="password"
                        type="password"
                        placeholder="Password"
                        class="form-control @error('password') is-invalid @enderror"
                        name="password"
                        required="required"
                        autocomplete="current-password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
