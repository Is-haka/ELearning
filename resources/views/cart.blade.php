@extends('layouts.app')

@section('app.name', 'Cart')
@section('content')
<div class="container mt-5">
    <div class="row cart-header">
        <div class="col-md-12">
            <h1>Shopping Cart</h1>
            <p class="text-left">{{ $cartItems->count() }} Courses in Cart</p>
        </div>
    </div>

    @if($cartItems->isEmpty())
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="empty-cart text-center">
                    <img src="{{ asset('assets/images/empty-cart.png') }}" alt="Empty Cart" class="img-fluid">
                    <p>Your cart is empty. Keep shopping to find a course!</p>
                    <a href="{{ url('/') }}" class="btn btn-success btn-sm">Keep shopping</a>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-8">
                @foreach($cartItems as $item)
                    <div class="card mb-3">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="d-flex">
                                <img src="{{ asset('uploads/' . $item->courses->thumbnail) }}" alt="{{ $item->courses->title }}" class="img-thumbnail" style="width: 100px;">
                                <div class="ms-3">
                                    <h5 class="card-title">{{ $item->courses->title }}</h5>
                                    <p class="card-text">Price: TZS {{ $item->courses->price }}</p>
                                    <p class="card-text">Quantity: {{ $item->quantity }}</p>
                                </div>
                            </div>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i> Remove
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-4">
                <div class="card sticky-top">
                    <div class="card-body">
                        <h5 class="card-title">Cart Summary</h5>
                        <p class="card-text">Total Courses: {{ $cartItems->count() }}</p>
                        <p class="card-text">Total Price: TZS {{ $totalPrice }}</p>
                        <!-- Enroll Form -->
                        <form action="{{ route('cart.enroll') }}" method="POST">
                            @csrf
                            @foreach($cartItems as $item)
                                <input type="hidden" name="course_ids[]" value="{{ $item->courses->id }}">
                            @endforeach
                            <button type="submit" class="btn btn-sm btn-secondary w-100"> <i class="fas fa-money-check fa-sm fa-fw"></i> Enroll Now</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
