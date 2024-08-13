@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Carousel Section -->
    <section class="row justify-content-center mb-5">
        <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
            {{-- <div class="carousel-indicators">
                @for ($i = 0; $i < 3; $i++)
                    <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="{{ $i }}" 
                        {{ $i == 0 ? 'class=active aria-current=true' : '' }} aria-label="Slide {{ $i + 1 }}"></button>
                @endfor
            </div> --}}
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

    <!-- Course Selection Section -->
    <section class="row mb-5">
        <div class="col-12">
            <h2 class="fw-bold fs-1 mb-3">A Broad Selection of Courses</h2>
            <p class="fs-5 mb-4">Explore our wide range of courses designed to enhance your skills and knowledge in various fields.</p>
            
            <ul class="nav nav-tabs" id="courseTabs" role="tablist">
                @php
                    $categories = [
                        'Python' => ['description' => 'Expand your career opportunities with Python', 'cta' => 'Explore Python'],
                        'Microsoft Word' => ['description' => 'Master essential office skills with Microsoft Word', 'cta' => 'Discover Word Courses'],
                        'Web Design' => ['description' => 'Create stunning websites and launch your design career', 'cta' => 'Start Designing']
                    ];
                @endphp
                @foreach ($categories as $category => $details)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-success border-0 {{ $loop->first ? 'active' : '' }}" id="{{ Str::slug($category) }}-tab" 
                            data-bs-toggle="tab" data-bs-target="#{{ Str::slug($category) }}" type="button" 
                            role="tab" aria-controls="{{ Str::slug($category) }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                            {{ $category }}
                        </button>
                    </li>
                @endforeach
            </ul>
            
            <div class="tab-content p-3" id="courseTabContent">
                @foreach ($categories as $category => $details)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ Str::slug($category) }}" role="tabpanel" aria-labelledby="{{ Str::slug($category) }}-tab">
                        <div class="row">
                            <div class="course-content col-12 mb-4">
                                <h3 class="fs-2 mb-3">{{ $details['description'] }}</h3>
                                <p class="text-secondary w-75">Our {{ $category }} courses are designed to take you from beginner to expert. Whether you're looking to start a new career or enhance your current skills, we have the perfect course for you.</p>
                                <a href="#" class="btn btn-outline-success rounded-medium border-1">{{ $details['cta'] }}</a>
                            </div>
                            @for ($i = 1; $i <= 6; $i++)
                                @php
                                    $imageIndex = ($loop->index * 6) + $i;
                                    $imageName = $imageIndex . '.jpg';
                                @endphp
                                <div class="col-md-4 col-lg-2 mb-4 shadow-sm course-card">
                                    <div class="card h-100 border-0">
                                        <a href="#"><img src="{{ asset('assets/images/' . $imageName) }}" class="card-img-top" alt="{{ $category }} course {{ $i }}"></a>
                                        <div class="card-body d-flex flex-column">
                                            <span class="card-title fs-6 fw-bold">{{ $category }} Masterclass {{ $i }}</span>
                                            <p class="card-text text-muted">Dr. Expert {{ $i }}</p>
                                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                                <span class="fw-bold">TZS {{ number_format(rand(40000, 60000), 0) }}/-</span>
                                                <a href="#" class="btn btn-sm rounded-0 "><i class="fa text-success fa-cart-plus" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection
