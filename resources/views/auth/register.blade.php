@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-center justify-content-center vh-100">
    <div class="row w-100 align-items-center justify-content-center">
        <!-- Illustration Section -->
        <div class="col-md-6 text-center d-none d-md-block">
            <img src="/path/to/your/illustration.png" alt="Illustration" class="img-fluid">
        </div>

        <!-- Registration Form Section -->
        <div class="col-md-3">
            <h2 class="mb-4 text-center">Sign up and start learning</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Full Name Field -->
                <div class="mb-3">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus placeholder="Full Name">
                    @error('name')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <input id="name" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autofocus placeholder="username">
                    @error('username')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="mb-3">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Email Address">
                    @error('email')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="mb-3">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Password">
                    @error('password')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Confirm Password Field -->
                <div class="mb-4">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm Password">
                </div>

                <!-- Register Button -->
                <button type="submit" class="btn btn-success w-100 mb-3">Create Account</button>

                <!-- Already Have an Account -->
                <div class="text-center">
                    <p>Already have an account? <a href="{{ route('login') }}" class="text-success">Log in</a></p>
                    {{-- <p><a href="#" class="text-primary">Sign up with your organization</a></p> --}}
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
