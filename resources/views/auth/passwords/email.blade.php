@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-center justify-content-center vh-100">
    <div class="row w-100 align-items-center justify-content-center">
        <!-- Illustration Section -->
        <div class="col-md-6 text-center d-none d-md-block">
            <img src="/path/to/your/illustration.png" alt="Illustration" class="img-fluid">
        </div>

        <!-- Reset Password Form Section -->
        <div class="col-md-3">
            <h2 class="mb-4">Reset Password</h2>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-3">

                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required placeholder="Email Address">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Green Reset Password Button -->
                <button type="submit" class="btn btn-success w-100 mb-3">Send Password Reset Link</button>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="btn btn-link">Back to Login</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
