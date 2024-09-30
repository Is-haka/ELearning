@extends('layouts.app')

@section('app.name', 'courses')
@section('content')
<div class="container-fluid">
    <!-- Hero Section -->
    <div class="row align-items-center justify-content-center bg-dark text-white hero-section">
        <div class="col-md-8">
            <h1 class="display-4 fw-bold">{{ $courses->title }}</h1>
            <p class="lead">{{ $courses->description }}</p>
        </div>
    </div>

    <!-- Main Content and Sidebar -->
    <div class="row mt-5">
        <!-- Main Content -->
        <div class="col-md-8">

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
                <p>{{ $courses->description }}</p>
            </div>

            <!-- Instructor Info -->
            <div class="instructor-info mt-5">
                <h5 class="fw-bold">Instructor</h5>
                <div class="d-flex align-items-center">
                    <img src="{{ asset('uploads/files/3.jpg') }}" class="rounded-circle me-3" width="80" height="80" alt="Instructor">
                    <div>
                        <h6 class="mb-1">Expert {{ $courses->instructor->name }} </h6>
                        <p class="text-muted mb-0">{{ $courses->instructor->instructor_description }}</p>
                    </div>
                </div>
            </div>

            <!-- Coding Exercises Section -->
            <div class="coding-exercises mb-5">
                <div class="card border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="col-md-4 text-center p-3">
                            <img src="{{ asset('uploads/files/2.jpg') }}" class="img-fluid rounded" alt="Coding Exercise">
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
                <p class="text-muted">{{ $totalLessons }} Lessons • {{ $totalLessonTypes }} lectures</p>

                <div class="accordion" id="courseContentAccordion">
                    <!-- First Lesson -->
                    @if ($firstLesson)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                {{ $firstLesson->title }} (First Lesson)
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#courseContentAccordion">
                            <div class="accordion-body">
                                <ul>
                                    <p class="p-2 alert alert-secondary text-success">{{ $firstLesson->duration }} minutes - {{ $firstLesson->description }}</p>
                                    @foreach($firstLesson->lessonTypes as $type)
                                        <li>Type: Reading - <a href="{{ asset('uploads/' . $type->reading) }}" target="_blank">{{ $firstLesson->title }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Remaining Lessons -->
                    @foreach ($remainingLessons as $index => $lesson)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo-{{ $index }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo-{{ $index }}" aria-expanded="false" aria-controls="collapseTwo-{{ $index }}">
                                {{ $lesson->title }}
                                <!-- Show "Locked" badge if not enrolled -->
                                @if(!$enrolled || $enrolled->status !== 'enrolled')
                                    <span class="ms-2 badge bg-secondary"><i class="fas fa-lock fa-sm fa-fw"></i></span>
                                @endif
                            </button>
                        </h2>
                        <div id="collapseTwo-{{ $index }}" class="accordion-collapse collapse" aria-labelledby="headingTwo-{{ $index }}" data-bs-parent="#courseContentAccordion">
                            <div class="accordion-body">
                                <p class="alert alert-secondary text-success p-2">{{ $lesson->duration }} minutes - {{ $lesson->description }}</p>
                                <ul>
                                    @foreach($lesson->lessonTypes as $type)
                                        <li class="p-2">
                                            <!-- Check if $enrolled is not null and status is 'enrolled' -->
                                            @if($enrolled && $enrolled->status === 'enrolled')
                                                <!-- Links are clickable if the user is enrolled -->
                                                Type: Reading - <a href="{{ asset('uploads/'. $type->reading) }}" target="_blank">{{ $lesson->title }}</a>
                                            @else
                                                <!-- Links are disabled if the user is not enrolled -->
                                                <span class="text-primary" style="text-decoration: underline; cursor: not-allowed;">{{ $lesson->title }}</span>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                                <!-- Display warning if not enrolled -->
                                @if(!$enrolled || $enrolled->status !== 'enrolled')
                                    <p class="alert alert-warning mt-2">This lesson content is locked. Please enroll in the course to access it.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>



        </div>

        <!-- Sticky Sidebar -->
        <div class="col-md-3 col-lg-3 sticky-sidebar">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body text-center">
                    <h3 class="fw-bold">TZS {{ $courses->price }}/- </h3>
                    <p class="text-muted"><s>TZS {{ number_format(rand(40000, 60000), 0) }}/-</s> 90% off</p>

                    @auth
                        @php
                            $userId = Auth::id();
                            $enrolled = \App\Models\Enrollments::where('user_id', $userId)
                                ->where('course_id', $courses->id)
                                ->exists();

                            // Check if the course is already in the cart (using session or Cart model)
                            $inCart = \App\Models\Carts::where('user_id', $userId)
                                ->where('course_id', $courses->id)
                                ->exists(); // Or use session-based check
                        @endphp

                        @if (!$enrolled)
                            <!-- If course is not enrolled -->
                            @if ($inCart)
                                <!-- If the course is already in the cart, show 'Go to Cart' button -->
                                <a href="{{ route('cart') }}" class="btn btn-secondary btn-sm w-100 mb-3"> <i class="fas fa-cart-arrow-down fa-sm fa-fw"></i> Go to Cart</a>
                            @else
                                <!-- If the course is not in the cart, show 'Add to Cart' button -->
                                <a href="{{ route('cart.add', ['course_id' => $courses->id]) }}" class="btn btn-success btn-sm w-100 mb-3"> <i class="fas fa-cart-plus fa-sm fa-fw"></i> Add to Cart</a>
                            @endif

                            <!-- Enroll Now Form -->
                            <form action="{{ route('course.enroll', ['course_id' => $courses->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-secondary btn-sm w-100">Enroll Now</button>
                            </form>
                        @else
                            <!-- If already enrolled -->
                            <button class="btn btn-outline-secondary btn-sm w-100" disabled>Enrolled</button>
                        @endif
                    @else
                        <!-- For guest users, show only the Add to Cart button and Enroll Now form -->
                        <a href="{{ route('cart.add', ['course_id' => $courses->id]) }}" class="btn btn-success btn-sm w-100 mb-3">Add to Cart</a>
                        <a href="{{ route('course.enroll.link', ['course_id' => $courses->id]) }}" class="btn btn-outline-secondary btn-sm w-100">Enroll Now</a>
                    @endauth

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
        </div>
    </div>
</div>
@endsection
