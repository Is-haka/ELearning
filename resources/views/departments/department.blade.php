@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-5 my-5 text-center department-container">
    <div class="lc-block mb-4">
        <div editable="rich">
            <h2 class="display-2 fw-bold">{{ $category->description }}</h2>
        </div>
    </div>
    <div class="lc-block col-lg-6 mx-auto mb-5">
        <div editable="rich">
            <h3 class="lead fw-bold mb-3">Courses to get you started</h3>
            <p class="lead">Explore our wide range of courses designed to enhance your skills and knowledge in {{ $category->name }} Fields.</p>
        </div>
    </div>
</div>

<div class="container">
    <!-- Course Selection Section -->
    <section class="row g-4 mb-5">
        @foreach ($cat as $category)
            @php
                $coursesInCategory = $courses->filter(function($course) use ($category) {
                    return $course->categories->name === $category->name;
                });
            @endphp
            @if ($coursesInCategory->isNotEmpty())
                <div class="col-12 mb-4">
                    <p class="text-muted">Our {{ $category->description }} courses are designed to take you from beginner to expert. Whether you're looking to start a new career or enhance your current skills, we have the perfect course for you.</p>
                </div>
                @foreach ($coursesInCategory as $course)
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card h-100 border-0 course-card">
                            <a href="{{ route('course', ['id' => $course->id]) }}">
                                <div class="card-img-top-wrapper">
                                    <img src="{{ asset('uploads/' . $course->thumbnail) }}" class="card-img-top" alt="{{ $course->name }} course">
                                    <div class="card-img-overlay d-flex align-items-start justify-content-end">
                                        <span class="badge bg-success">{{ $category->name }}</span>
                                    </div>
                                </div>
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">{{ $course->name }}</h5>
                                <p class="card-text text-muted">{{ $course->instructor->user->name }}</p>
                            </div>
                            <div class="card-footer bg-white border-top-0 d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-success">TZS {{ number_format($course->price,2) }}/-</span>
                                <a href="{{ route('course', ['id' => $course->id]) }}" class="btn btn-outline-success btn-sm">
                                    <i class="fas fa-clipboard fa-sm fa-fw"></i> Course details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        @endforeach
    </section>
</div>
@endsection

@push('styles')
<style>
    body {
        background-color: #f8f9fa;
    }

    .department-container {
        background: linear-gradient(135deg, #3d4058a8 0%, #09802d 100%);
        color: white;
    }

    .display-2 {
        font-size: 3.5rem;
        letter-spacing: -0.02em;
    }

    .lead {
        font-size: 1.25rem;
    }

    .course-card {
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 15px;
        overflow: hidden;
    }

    .course-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 16px rgba(0, 0, 0, 0.1);
    }

    .card-img-top-wrapper {
        position: relative;
        overflow: hidden;
        padding-top: 56.25%; /* 16:9 Aspect Ratio */
    }

    .card-img-top {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .course-card:hover .card-img-top {
        transform: scale(1.05);
    }

    .card-img-overlay {
        background: linear-gradient(to bottom, rgba(207, 235, 206, 0.4) 0%, rgba(255, 255, 255, 0) 100%);
    }

    .badge {
        font-size: 0.8rem;
        font-weight: 500;
        padding: 0.5em 1em;
    }

    .card-body {
        padding: 1.5rem;
    }

    .card-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .card-text {
        font-size: 0.9rem;
    }

    .card-footer {
        padding: 1rem 1.5rem;
    }

    .btn-outline-primary {
        border-width: 2px;
    }

    .btn-outline-primary:hover {
        background-color: #09802d;
        color: white;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .display-2 {
            font-size: 2.5rem;
        }

        .lead {
            font-size: 1rem;
        }
    }
</style>
@endpush
