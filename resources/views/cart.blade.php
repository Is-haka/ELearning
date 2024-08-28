@extends('layouts.app')

@section('app.name', 'Cart')
@section('content')
<style>
.empty-cart {
    text-align: center;
    padding: 50px;
    background-color: #f8f9fa;
    border-radius: 10px;
    margin-top: 30px;
}

.empty-cart img {
    width: 150px;
    height: auto;
    margin-bottom: 20px;
}

.empty-cart .btn-continue {
    background-color: #6f42c1;
    color: #615252;
}

.empty-cart .btn-continue:hover {
    background-color: #5a32a8;
    color: #413434;
}

.cart-header h1 {
    font-weight: 750; /* Make the title bold */
    text-align: left; /* Align the title to the left */
}
</style>

<div class="container mt-5">
    <div class="row cart-header">
        <div class="col-md-12">
            <h1>Shopping Cart</h1>
            <p class="text-left">0 Courses in Cart</p> <!-- Align the course count to the left as well -->
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="empty-cart">
                <img src="{{ asset('assets/images/empty-cart.png') }}" alt="Empty Cart">
                <p>Your cart is empty. Keep shopping to find a course!</p>
                <a href="{{ route('cart') }}" class="btn btn-success btn-sm">Keep shopping</a>
            </div>
        </div>
    </div>
</div>
@endsection
