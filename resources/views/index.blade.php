@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Carousel Section -->
    <section class="row justify-content-center mb-5">
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
                        ['image' => '1.jpg', 'title' => 'Unlock Your Potential', 'description' => 'Discover a world of knowledge with our diverse range of courses.'],
                        ['image' => '2.jpg', 'title' => 'Learn from Experts', 'description' => 'Our instructors are industry professionals ready to share their expertise.'],
                        ['image' => '3.jpg', 'title' => 'Flexible Learning', 'description' => 'Study at your own pace with our online and on-demand courses.']
                    ];
                @endphp

                @foreach ($carouselItems as $index => $item)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" data-bs-interval="{{ 10000 - ($index * 4000) }}">
                        <div class="carousel-img-container d-flex justify-content-around align-items-center">
                            <div class="carousel-image-wrapper col-md-6">
                                <img class="carousel-img img-fluid" src="{{ asset('assets/images/' . $item['image']) }}" alt="Slide {{ $index + 1 }}">
                            </div>
                            <div class="carousel-text-wrapper col-md-5 d-md-block d-none">
                                <h2 class="fw-bold mb-3">{{ $item['title'] }}</h2>
                                <p class="fs-5 w-75">{{ $item['description'] }}</p>
                                <a href="#" class="btn btn-success rounded-medium mt-3">Explore Courses</a>
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
                    @foreach ($courses->groupBy(function($course) { return $course->categories->name; }) as $category => $coursesInCategory)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link border-0 @if ($loop->first) active @endif" id="{{ Str::slug($category) }}-tab" data-bs-toggle="tab" data-bs-target="#{{ Str::slug($category) }}" type="button" role="tab" aria-controls="{{ Str::slug($category) }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                {{ $category }}
                            </button>
                        </li>
                    @endforeach
                @endif
            </ul>

            <div class="tab-content p-3" id="courseTabContent">
                @foreach ($courses->groupBy(function($course) { return $course->categories->name; }) as $category => $coursesInCategory)
                    <div class="tab-pane fade @if ($loop->first) show active @endif" id="{{ Str::slug($category) }}" role="tabpanel" aria-labelledby="{{ Str::slug($category) }}-tab">
                        <div class="row">
                            @foreach ($coursesInCategory as $course)
                            <a class="nav-link text-success" href="{{ route('course', ['id' => $course->id]) }}">
                                <div class="col-md-4 col-lg-2 mb-4 shadow-sm course-card">
                                    <div class="card h-100 border-0">
                                            <img src="{{ asset('assets/images/' . $course->thumbnail) }}" class="card-img-top" alt="{{ $course->name }} course">
                                            <div class="card-body d-flex flex-column">
                                                <span class="card-title fs-6 fw-bold">Masterclass {{ $course->name }}</span>
                                                <p class="card-text text-muted">Expert {{ $course->instructor->user->name }}</p>
                                                <div class="mt-auto d-flex justify-content-between align-items-center">
                                                <span class="fw-bold">TZS {{ $course->price }}/-</span>
                                                <a href="{{ route('course', ['id' => $course->id]) }}" class="btn btn-sm rounded-0">
                                                    <i class="fa text-success fa-cart-plus" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection
