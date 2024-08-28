@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-center justify-content-center vh-100">
    <div class="row w-100 align-items-center justify-content-center">
        <!-- Illustration Section -->
        <div class="col-md-6 text-center d-none d-md-block">
            <img src="/path/to/your/illustration.png" alt="Illustration" class="img-fluid">
        </div>

        <!-- Login Form Section -->
        <div class="col-md-3">
            <h2 class="mb-4 text-center">Log in to continue your learning journey</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Field -->
                <div class="mb-3">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autofocus placeholder="Email Address">
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

                <!-- Login Button -->
                <button type="submit" class="btn btn-success w-100 mb-3 custom-btn">
                    Log in with Email
                </button>

                <!-- Password Reset Link -->
                <div class="text-center mb-3">
                    @if (Route::has('password.request'))
                        <a class="text-success`" href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a>
                    @endif
                </div>

                <!-- Registration and Organization Login Links -->
                <div class="text-center">
                    <p>Don't have an account? <a href="{{ route('register') }}" class="text-success">Sign up</a></p>
                    {{-- <p><a href="#" class="text-primary">Log in with your organization</a></p> --}}
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .custom-btn {
        background-color: #28a745; /* Green color */
        border: none;
        color: white;
        font-weight: bolder;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .custom-btn:hover {
        background-color: #90ee90; /* Light Green color */
        color: black;
    }
</style>
@endsection
