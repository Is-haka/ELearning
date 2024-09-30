@extends('layouts.app')

@section('content')
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
            <h2 class="fw-bold fs-1 mb-3">A Broad Selection of Courses</h2>
            <p class="fs-5 mb-4">Explore our wide range of courses designed to enhance your skills and knowledge in various fields.</p>

            <ul class="nav nav-tabs" id="courseTabs" role="tablist">
                @if ($courses->isEmpty())
                    <p>No course available</p>
                @else
                    @foreach ($cat as $category)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link border-0 @if ($loop->first) active @endif" id="{{ Str::slug($category->name) }}-tab" data-bs-toggle="tab" data-bs-target="#{{ Str::slug($category->name) }}" type="button" role="tab" aria-controls="{{ Str::slug($category->name) }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                {{ $category->name }}
                            </button>
                        </li>
                    @endforeach
                @endif
            </ul>

            <!-- Loop through the categories to generate the tab content -->
            <div class="tab-content p-3" id="courseTabContent">
                @foreach ($cat as $category)
                    <div class="tab-pane fade @if ($loop->first) show active @endif" id="{{ Str::slug($category->name) }}" role="tabpanel" aria-labelledby="{{ Str::slug($category->name) }}-tab">
                        <!-- Display the course content section for each category -->
                        @php
                            $coursesInCategory = $courses->filter(function($course) use ($category) {
                                return $course->categories->name === $category->name;
                            });
                        @endphp

                        @if ($coursesInCategory->isNotEmpty())
                            <div class="course-content col-12 mb-4">
                                <h3 class="fs-2 mb-3">Courses offered by {{ $category->name }} Department</h3>
                                <p class="text-secondary w-75">Our {{ $category->description }} courses are designed to take you from beginner to expert. Whether you're looking to start a new career or enhance your current skills, we have the perfect course for you.</p>
                                <a href="{{ route('departments', ['id' => strtolower($category->id)]) }}" class="btn btn-outline-success rounded-medium border-1">Explore {{ $category->name }} Courses</a>
                            </div>
                        @endif

                        <!-- Loop to display the course cards for each category -->
                        <div class="row d-flex">
                            @foreach ($coursesInCategory as $course)
                                <div class="col-md-4 col-lg-2 mb-4 shadow-sm bg-white course-card">
                                    <div class="card bg-white h-100 border-0">
                                        <a href="{{ route('course', ['id' => $course->id]) }}">
                                            <img src="{{ asset('uploads/' . $course->thumbnail) }}" class="card-img-top" alt="{{ $course->name }} course">
                                        </a>
                                        <div class="card-body d-flex flex-column">
                                            <span class="card-title fs-6 fw-bold">Masterclass {{ $course->name }}</span>
                                            <p class="card-text text-muted">Expert {{ $course->instructor->user->name }}</p>
                                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                                <span class="fw-bold">TZS {{ number_format($course->price,2) }}/-</span>
                                                <a href="{{ route('course', ['id' => $course->id]) }}" class="btn btn-sm rounded-0">
                                                    <i class="fa text-success fa-cart-plus" aria-hidden="true"></i>
                                                </a>
                                            </div>
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
