@extends('layouts.app')

@section('app.name', 'cart')
@section('content')

<div class="container mt-5">
    <!-- Cart Header -->
    <div class="row cart-header">
        <div class="col-md-12">
            <h1>Shopping Cart</h1>
        </div>
    </div>

    <!-- Cart Items -->
    <div class="row">
        <div class="col-md-8">
            <!-- Cart Item 1 -->
            <div class="row cart-item">
                <div class="col-md-2">
                    <img src="{{ asset('assets/images/python-bootcamp.jpg') }}" class="img-fluid rounded" alt="100 Days of Code: The Complete Python Pro Bootcamp">
                </div>
                <div class="col-md-8 item-details">
                    <h5 class="item-title">100 Days of Code: The Complete Python Pro Bootcamp</h5>
                    <p class="item-instructor text-muted">Dr. Angela Yu, Developer and Lead Instructor</p>
                    <p class="item-rating text-warning">Rating: 4.7 out of 5 (316,861 reviews)</p>
                    <p class="item-duration text-muted">56.5 total hours, 592 lectures, All Levels</p>
                </div>
                <div class="col-md-2 text-right">
                    <p class="item-price font-weight-bold">$9.99</p>
                    <p class="item-original-price text-muted"><del>$74.99</del></p>
                </div>
            </div>

            <!-- Repeat for other items in the cart -->

        </div>

        <!-- Cart Summary -->
        <div class="col-md-4">
            <div class="cart-summary p-4 bg-light rounded shadow-sm">
                <h4>Order Summary</h4>
                <div class="summary-item d-flex justify-content-between">
                    <span>Subtotal</span>
                    <span>$29.97</span>
                </div>
                <div class="summary-item d-flex justify-content-between">
                    <span>Original Price</span>
                    <span><del>$224.97</del></span>
                </div>
                <div class="summary-item total-price d-flex justify-content-between font-weight-bold">
                    <span>Total</span>
                    <span>$29.97</span>
                </div>
                <a href="#" class="btn btn-success btn-lg w-100 mt-3">Proceed to Checkout</a>
            </div>
        </div>
    </div>

    <!-- Frequently Bought Together -->
    <div class="row frequently-bought mt-5">
        <div class="col-md-12">
            <h3>Frequently Bought Together</h3>
            <div class="card mb-3 border-0 rounded-lg">
                <div class="row g-0">
                    <div class="col-md-2">
                        <img src="{{ asset('assets/images/python-bootcamp.jpg') }}" class="img-fluid rounded-start" alt="100 Days of Code: The Complete Python Pro Bootcamp">
                    </div>
                    <div class="col-md-10">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold">100 Days of Code: The Complete Python Pro Bootcamp</h5>
                            <p class="card-text text-muted">Master Python by building 100 projects in 100 days. Learn data science, automation, build websites, games and apps!</p>
                            <p class="item-rating text-warning">Rating: 4.7 out of 5 (316,861 reviews)</p>
                            <p class="item-price font-weight-bold">Current price: $9.99 <del>$74.99</del></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Repeat for other frequently bought together items -->

        </div>
    </div>

    <!-- Related Topics -->
    <div class="row related-topics mt-5">
        <div class="col-md-12">
            <h4>Related Topics</h4>
            <!-- Add related topics content here -->
        </div>
    </div>
</div>

@endsection
