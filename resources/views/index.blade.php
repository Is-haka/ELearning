@extends('layouts.app')

@section('content')
@push('styles')
<style>
    .course-tabs-container {
        overflow: hidden;
        border-radius: 25px;
    }

    .tab-backdrop {
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, #28a745, #20c997);
        filter: blur(5px);
        opacity: 0.8;
        z-index: 0;
    }

    #courseTabs {
        background-color: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(5px);
        z-index: 1;
    }

    #courseTabs .nav-link {
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
        border: 1px solid transparent;
        padding: 8px 12px;
        margin: 0 3px;
        font-size: 0.9rem;
    }

    #courseTabs .nav-link:not(.active):hover {
        background-color: rgba(255, 255, 255, 0.2);
        border-color: white;
        transform: translateY(-2px);
    }

    #courseTabs .nav-link.active {
        background-color: white;
        color: #28a745;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }

    .tab-icon {
        display: inline-block;
        margin-right: 4px;
        font-size: 1em;
    }

    .course-card {
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .course-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.03); }
        100% { transform: scale(1); }
    }

    #courseTabs .nav-link.active {
        animation: pulse 2s infinite;
    }

    .btn-success, .btn-outline-success:hover {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-outline-success {
        color: #28a745;
        border-color: #28a745;
    }

    .text-success {
        color: #28a745 !important;
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

    .btn-outline-success {
        border-width: 2px;
    }

    .btn-outline-success:hover {
        background-color: #09802d;
        color: white;
    }
</style>
@endpush
<div class="container">
    <!-- Carousel Section -->
    <section class="row justify-content-center mb-5 pt-5">
        <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @for ($i = 0; $i < 3; $i++)
                    <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="{{ $i }}"
                        {{ $i == 0 ? 'class=active aria-current=true' : '' }} aria-label="Slide {{ $i + 1 }}"></button>
                @endfor
            </div>
            <div class="carousel-inner">
                @php
                    $carouselItems = [
                        ['image' => '1.png', 'title' => 'Unlock Your Potential', 'description' => 'Discover a world of knowledge with our diverse range of courses.'],
                        ['image' => '2.png', 'title' => 'Learn from Experts', 'description' => 'Our instructors are industry professionals ready to share their expertise.'],
                        ['image' => '3.png', 'title' => 'Flexible Learning', 'description' => 'Study at your own pace with our online and on-demand courses.']
                    ];
                @endphp

                @foreach ($carouselItems as $index => $item)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" data-bs-interval="{{ 10000 - ($index * 4000) }}">
                        <div class="carousel-img-container d-flex justify-content-around align-items-center">
                            <div class="carousel-image-wrapper col-md-6">
                                <img class="carousel-img img-fluid" src="{{ asset('uploads/files/' . $item['image']) }}" alt="Slide {{ $index + 1 }}">
                            </div>
                            <div class="carousel-text-wrapper col-md-5 d-md-block d-none">
                                <h2 class="fw-bold mb-3">{{ $item['title'] }}</h2>
                                <p class="fs-5 w-75">{{ $item['description'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-success rounded-circle shadow" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-success rounded-circle shadow" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <section class="row mb-5">
        <div class="col-12">
            <h2 class="fw-bold fs-1 mb-3">Top selling course from different department</h2>
            <p class="fs-5 mb-4">Discover our top-selling courses, carefully curated to boost your skills and expertise across a wide range of disciplines.</p>

            <div class="course-tabs-container position-relative mb-5">
                <div class="tab-backdrop position-absolute"></div>
                <ul class="nav nav-pills nav-fill p-2 position-relative" id="courseTabs" role="tablist">
                    @if ($courses->isEmpty())
                        <p>No course available</p>
                    @else
                        @foreach ($cat as $category)
                            <li class="nav-item m-1" role="presentation">
                                <button class="nav-link rounded-pill @if ($loop->first) active @endif"
                                        id="{{ Str::slug($category->name) }}-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#{{ Str::slug($category->name) }}"
                                        type="button"
                                        role="tab"
                                        aria-controls="{{ Str::slug($category->name) }}"
                                        aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                    <span class="tab-icon">
                                        <i class="fas fa-{{ $loop->index == 0 ? 'laptop-code' : ($loop->index == 1 ? 'chart-line' : 'paint-brush') }}"></i>
                                    </span>
                                    {{ $category->name }}
                                </button>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>

            <div class="tab-content p-3" id="courseTabContent">
                @foreach ($cat as $category)
                    <div class="tab-pane fade @if ($loop->first) show active @endif" id="{{ Str::slug($category->name) }}" role="tabpanel" aria-labelledby="{{ Str::slug($category->name) }}-tab">
                        @php
                            $coursesInCategory = $courses->filter(function($course) use ($category) {
                                return $course->categories->name === $category->name;
                            });
                        @endphp

                        @if ($coursesInCategory->isNotEmpty())
                            <div class="course-content col-12 mb-4">
                                <h3 class="fs-2 mb-3">Courses offered by {{ $category->name }} Department</h3>
                                <p class="text-secondary w-75">Our {{ $category->description }} courses are designed to take you from beginner to expert. Whether you're looking to start a new career or enhance your current skills, we have the perfect course for you.</p>
                                <a href="{{ route('departments', ['id' => strtolower($category->id)]) }}" class="btn btn-success rounded-pill border-0 px-4 py-2 mt-2">Explore {{ $category->name }} Courses</a>
                            </div>
                        @endif

                        <div class="row g-4">
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
                                            <span class="fw-bold text-success">TZS {{ number_format($course->price, 2) }}/-</span>
                                            <a href="{{ route('course', ['id' => $course->id]) }}" class="btn btn-outline-success btn-sm">
                                                <i class="fas fa-clipboard fa-sm fa-fw"></i> Course details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="row mb-5">
        <div class="container mt-5">
            <h2 class="mb-4">All Courses by Department</h2>

            <ul class="nav nav-tabs" id="courseTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="ict-tab" data-bs-toggle="tab" data-bs-target="#ict" type="button" role="tab" aria-controls="ict" aria-selected="true">ICT Department</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="civil-tab" data-bs-toggle="tab" data-bs-target="#civil" type="button" role="tab" aria-controls="civil" aria-selected="false">Civil Engineering Department</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="electrical-tab" data-bs-toggle="tab" data-bs-target="#electrical" type="button" role="tab" aria-controls="electrical" aria-selected="false">Electrical Department</button>
                </li>
            </ul>

            <div class="tab-content" id="courseTabsContent">
                <div class="tab-pane fade show active" id="ict" role="tabpanel" aria-labelledby="ict-tab">
                    <div class="table-responsive mt-3">
                        <table class="table table-hover table-inverse">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>SN</th>
                                    <th>Course Name</th>
                                    <th>Course Descriptions</th>
                                    <th>Mode of Delivery</th>
                                    <th>Delivery Location</th>
                                    <th>Duration</th>
                                    <th>Entry Qualification</th>
                                    <th>Starting Date</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">1</td>
                                    <td>Web Design & Development</td>
                                    <td>Comprehensive course on web design and development</td>
                                    <td>Remote/Online</td>
                                    <td>Online Platform</td>
                                    <td>3 months</td>
                                    <td>Basic Computer Knowledge</td>
                                    <td>October 1, 2024</td>
                                    <td>TZS 500,000/-</td>
                                </tr>
                                <tr>
                                    <td scope="row">2</td>
                                    <td>CCNA</td>
                                    <td>Networking fundamentals and Cisco technologies</td>
                                    <td>Physical/On-site</td>
                                    <td>Dar es Salaam, Tanzania</td>
                                    <td>6 months</td>
                                    <td>High School Diploma</td>
                                    <td>November 10, 2024</td>
                                    <td>TZS 700,000/-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="civil" role="tabpanel" aria-labelledby="civil-tab">
                    <div class="table-responsive mt-3">
                        <table class="table table-hover table-inverse">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>SN</th>
                                    <th>Course Name</th>
                                    <th>Course Descriptions</th>
                                    <th>Mode of Delivery</th>
                                    <th>Delivery Location</th>
                                    <th>Duration</th>
                                    <th>Entry Qualification</th>
                                    <th>Starting Date</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">1</td>
                                    <td>Structural Engineering</td>
                                    <td>Fundamentals of structural design and analysis</td>
                                    <td>Physical/On-site</td>
                                    <td>Dar es Salaam, Tanzania</td>
                                    <td>5 months</td>
                                    <td>High School Diploma with Mathematics and Physics</td>
                                    <td>September 15, 2024</td>
                                    <td>TZS 800,000/-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="electrical" role="tabpanel" aria-labelledby="electrical-tab">
                    <div class="table-responsive mt-3">
                        <table class="table table-hover table-inverse">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>SN</th>
                                    <th>Course Name</th>
                                    <th>Course Descriptions</th>
                                    <th>Mode of Delivery</th>
                                    <th>Delivery Location</th>
                                    <th>Duration</th>
                                    <th>Entry Qualification</th>
                                    <th>Starting Date</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">1</td>
                                    <td>Electrical Engineering Basics</td>
                                    <td>Introduction to electrical engineering principles</td>
                                    <td>Physical/On-site</td>
                                    <td>Arusha, Tanzania</td>
                                    <td>5 months</td>
                                    <td>High School Diploma with Physics</td>
                                    <td>October 20, 2024</td>
                                    <td>TZS 750,000/-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
