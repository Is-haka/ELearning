@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Course Selection Section -->
    <section class="row mb-5">
        <div class="col-12 mt-5">
            <h2 class="fw-bold fs-1 mb-3">{{ $category->description }}</h2>
            <h3 class="fw-bold">Courses to get you started</h3>
            <p class="fs-5 mb-4">Explore our wide range of courses designed to enhance your skills and knowledge in {{ $category->name }} Fields.</p>

            {{-- <ul class="nav nav-tabs" id="courseTabs" role="tablist">
                @if ($courses->isEmpty())
                    <p>No course available</p>
                @else
                    @foreach ($courses as $category)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link border-0 @if ($loop->first) active @endif" id="{{ Str::slug($category->name) }}-tab" data-bs-toggle="tab" data-bs-target="#{{ Str::slug($category->name) }}" type="button" role="tab" aria-controls="{{ Str::slug($category->name) }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                {{ $category->name }}
                            </button>
                        </li>
                    @endforeach
                @endif
            </ul> --}}

            <!-- Loop through the categories to generate the tab content -->
            <div class="tab-content p-3" id="courseTabContent">
                @foreach ($cat as $category)
                    <div class="tab-pane fade show active" id="{{ Str::slug($category->name) }}" role="tabpanel" aria-labelledby="{{ Str::slug($category->name) }}-tab">
                        <!-- Display the course content section for each category -->
                        @php
                            $coursesInCategory = $courses->filter(function($course) use ($category) {
                                return $course->categories->name === $category->name;
                            });
                        @endphp
                        @if ($coursesInCategory->isNotEmpty())
                            <div class="course-content col-12 mb-4">
                                <p class="text-secondary w-75">Our {{ $category->description }} courses are designed to take you from beginner to expert. Whether you're looking to start a new career or enhance your current skills, we have the perfect course for you.</p>
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
</div>
@endsection
