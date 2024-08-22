@extends('layouts.app')

@section('app.name', 'courses')
@section('content')
<style>
/* Your existing CSS */

/* Sticky Sidebar */
.sticky-sidebar {
    position: sticky;
    top: 0;
    align-self: start;
}

/* Hero Section */
.hero-section {
    background-image: url('{{ asset('assets/images/hero-bg.jpg') }}');
    background-size: cover;
    background-position: center;
    padding: 100px;
    color: #fff;
    text-align: center;
}

.hero-section h1 {
    font-size: 3rem;
    font-weight: 700;
}

.hero-section p.lead {
    font-size: 1.25rem;
    margin-bottom: 20px;
}

.hero-section .btn-success {
    padding: 10px 20px;
    font-size: 1.25rem;
    border-radius: 5px;
}
</style>

<div class="container-fluid mt-5">
    <!-- Hero Section -->
    <div class="row align-items-center bg-dark text-white hero-section">
        <div class="col-md-8">
            <h1 class="display-4 fw-bold">The Complete Python Bootcamp From Zero to Hero in Python</h1>
            <p class="lead">Learn Python like a Professional. Start from the basics and go all the way to creating your own applications and games.</p>
            <a href="#" class="btn btn-success btn-lg">Get Started</a>
        </div>
    </div>

    <!-- Main Content and Sidebar -->
    <div class="row mt-5">
        <!-- Main Content -->
        <div class="col-md-8">
            <!-- Course Header -->
            <div class="course-header">
                <h1 class="fw-bold">The Complete Python Bootcamp From Zero to Hero in Python</h1>
                <p class="lead text-muted">Learn Python like a Professional Start from the basics and go all the way to creating your own applications and games.</p>
                <p class="mb-2">1,947,835 students</p>
                <p class="mb-2">Created by <span class="fw-bold">Dr. John Doe</span></p>
                <p class="text-muted">Last updated 7/2023</p>
                <p>English <span class="text-muted">• English [Auto], Arabic [Auto]</span></p>
            </div>

            <!-- Course Meta Data -->
            <div class="course-meta mt-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title">What you'll learn</h5>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check-circle text-success me-2"></i> Learn to use Python professionally, learning both Python 2 and Python 3!</li>
                            <li><i class="fas fa-check-circle text-success me-2"></i> Create games with Python, like Tic Tac Toe and Blackjack!</li>
                            <li><i class="fas fa-check-circle text-success me-2"></i> Learn advanced Python features, like the collections module and how to work with timestamps!</li>
                            <li><i class="fas fa-check-circle text-success me-2"></i> Understand complex topics, like decorators.</li>
                            <li><i class="fas fa-check-circle text-success me-2"></i> Work with the Jupyter Notebook Environment!</li>
                            <li><i class="fas fa-check-circle text-success me-2"></i> Learn to use Object-Oriented Programming with classes!</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Course Description -->
            <div class="course-description mt-5">
                <h5 class="fw-bold">Course Description</h5>
                <p>This course will give you a full introduction into all of the core concepts in Python. Follow along with the lessons and you'll be a Python programmer in no time!</p>
                <p>Python is a powerful, high-level, interpreted language that is easy to learn and fun to work with. This course is perfect for beginners to learn Python in an easy and friendly way.</p>
                <p>You'll build a complete Python project from scratch by the end of this course. Enroll now and start your journey towards Python mastery.</p>
            </div>

            <!-- Instructor Info -->
            <div class="instructor-info mt-5">
                <h5 class="fw-bold">Instructor</h5>
                <div class="d-flex align-items-center">
                    <img src="{{ asset('assets/images/instructor.jpg') }}" class="rounded-circle me-3" width="80" height="80" alt="Instructor">
                    <div>
                        <h6 class="mb-1">Dr. John Doe</h6>
                        <p class="text-muted mb-0">PhD in Computer Science with 10+ years of experience in teaching Python.</p>
                    </div>
                </div>
            </div>

            <!-- Explore Related Topics Section -->
            <div class="explore-related mt-5 alert alert-info">
                <h4 class="fw-bold">Explore Related Topics</h4>
                <p>Top companies offer this course to their employees. This course was selected for our collection of top-rated courses trusted by businesses worldwide. <a href="#" class="text-primary">Learn more</a></p>
            </div>

            <!-- Top Companies Section -->
            <div class="top-companies mb-5 text-center">
                <h5 class="fw-bold">Trusted by companies like</h5>
                <div class="d-flex justify-content-center align-items-center flex-wrap mt-3">
                    <img src="{{ asset('assets/images/nasdaq-logo.png') }}" alt="Nasdaq" class="mx-3" width="100">
                    <img src="{{ asset('assets/images/volkswagen-logo.png') }}" alt="Volkswagen" class="mx-3" width="100">
                    <img src="{{ asset('assets/images/box-logo.png') }}" alt="Box" class="mx-3" width="100">
                    <img src="{{ asset('assets/images/netapp-logo.png') }}" alt="NetApp" class="mx-3" width="100">
                    <img src="{{ asset('assets/images/eventbrite-logo.png') }}" alt="Eventbrite" class="mx-3" width="100">
                </div>
            </div>

            <!-- Coding Exercises Section -->
            <div class="coding-exercises mb-5">
                <div class="card border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="col-md-4 text-center">
                            <img src="{{ asset('assets/images/coding-exercise.jpg') }}" class="img-fluid" alt="Coding Exercise">
                        </div>
                        <div class="col-md-8">
                            <h5 class="fw-bold">Coding Exercises</h5>
                            <p class="text-muted">This course includes our updated coding exercises so you can practice your skills as you learn.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Course Content Section -->
            <div class="course-content mb-5">
                <h5 class="fw-bold">Course Content</h5>
                <p class="text-muted">23 sections • 156 lectures • 22h 13m total length</p>

                <div class="accordion" id="courseContentAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Auto-Welcome Message
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#courseContentAccordion">
                            <div class="accordion-body">
                                <ul>
                                    <li>00:44 - Welcome Message</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Course Curriculum Overview
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#courseContentAccordion">
                            <div class="accordion-body">
                                <ul>
                                    <li>06:39 - Course Curriculum Overview</li>
                                    <li>04:00 - Why Python?</li>
                                    <li>05:17 - Course FAQs</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Add more sections similarly -->
                </div>
            </div>
        </div>

        <!-- Sticky Sidebar -->
        <div class="col-md-3 sticky-sidebar">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body text-center">
                    <h3 class="fw-bold">$9.99</h3>
                    <p class="text-muted"><s>$99.99</s> 90% off</p>
                    <button class="btn btn-success btn-lg w-100 mb-3">Add to Cart</button>
                    <button class="btn btn-outline-secondary btn-lg w-100">Buy Now</button>
                    <p class="text-muted mt-2">30-Day Money-Back Guarantee</p>
                </div>
            </div>

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h5 class="fw-bold">This course includes:</h5>
                    <ul class="list-unstyled mt-3">
                        <li class="mb-2"><i class="fas fa-video me-2"></i> 22 hours on-demand video</li>
                        <li class="mb-2"><i class="fas fa-file me-2"></i> 6 articles</li>
                        <li class="mb-2"><i class="fas fa-download me-2"></i> 10 downloadable resources</li>
                        <li class="mb-2"><i class="fas fa-infinity me-2"></i> Full lifetime access</li>
                        <li class="mb-2"><i class="fas fa-tv me-2"></i> Access on mobile and TV</li>
                        <li class="mb-2"><i class="fas fa-certificate me-2"></i> Certificate of completion</li>
                    </ul>
                </div>
            </div>

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h5 class="fw-bold">Training 5 or more people?</h5>
                    <p class="text-muted">Get your team access to 22,000+ top Udemy courses anytime, anywhere.</p>
                    <button class="btn btn-outline-primary btn-lg w-100">Try Udemy Business</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
