@extends('layouts.app')

@section('app.name', 'courses')
@section('content')
<div class="container-fluid p-0">
    <!-- Hero Section -->
    <div class="row align-items-center justify-content-center text-white hero-section mb-5">
        <div class="col-md-8 text-center">
            <h1 class="display-4 fw-bold mb-3">{{ $courses->title }}</h1>
            <p class="lead mb-4">{{ $courses->description }}</p>
            <a href="#courseContent" class="btn btn-light btn-lg mt-2 animate__animated animate__pulse animate__infinite">Explore Course Content</a>
        </div>
    </div>

    <div class="container">
        <!-- Main Content and Sidebar -->
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Course Meta Data -->
                <div class="course-meta mb-5">
                    <div class="card shadow-lg border-0 rounded-lg">
                        <div class="card-body">
                            <h3 class="card-title text-primary mb-4">What You'll Learn</h3>
                            <div class="row">
                                @foreach(['Master Python 2 and 3 professionally',
                                          'Create exciting games like Tic Tac Toe and Blackjack',
                                          'Explore advanced Python features',
                                          'Grasp complex topics such as decorators',
                                          'Utilize the Jupyter Notebook Environment',
                                          'Apply Object-Oriented Programming concepts'] as $item)
                                    <div class="col-md-6 mb-3">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-check-circle text-success me-2 fa-lg"></i>
                                            <span>{{ $item }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course Description -->
                <div class="course-description mb-5">
                    <h3 class="fw-bold mb-3">Course Overview</h3>
                    <p class="lead">{{ $courses->description }}</p>
                    <div class="mt-4">
                        <button class="btn btn-outline-success me-2 mb-2" data-bs-toggle="modal" data-bs-target="#courseDemo">
                            <i class="fas fa-play-circle me-2"></i>Watch Course Demo
                        </button>
                        <button class="btn btn-outline-secondary mb-2" data-bs-toggle="modal" data-bs-target="#syllabusModal">
                            <i class="fas fa-file-alt me-2"></i>View Full Syllabus
                        </button>
                    </div>
                </div>

                <!-- Instructor Info -->
                <div class="instructor-info mb-5">
                    <h3 class="fw-bold mb-4">Meet Your Instructor</h3>
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('uploads/files/3.jpg') }}" class="rounded-circle me-4 border border-success p-1" width="100" height="100" alt="Instructor">
                                <div>
                                    <h4 class="mb-1">{{ $courses->instructor->name }}</h4>
                                    <p class="text-muted mb-2">{{ $courses->instructor->title }}</p>
                                    <p>{{ $courses->instructor->instructor_description }}</p>
                                    <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#instructorBio">
                                        <i class="fas fa-user me-2"></i>Full Bio
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Coding Exercises Section -->
                <div class="coding-exercises mb-5">
                    <div class="card border-0 shadow-lg rounded-lg">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-4 text-center">
                                    <img src="{{ asset('uploads/files/2.jpg') }}" class="img-fluid rounded" alt="Coding Exercise">
                                </div>
                                <div class="col-md-8">
                                    <h3 class="fw-bold mb-3">Hands-on Coding Exercises</h3>
                                    <p class="lead">Practice your skills with our updated, interactive coding exercises. Apply what you learn in real-time!</p>
                                    <button class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#exerciseDemo">
                                        <i class="fas fa-laptop-code me-2"></i>Try a Sample Exercise
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course Content Section -->
                <div class="course-content mb-5" id="courseContent">
                    <h3 class="fw-bold mb-3">Course Curriculum</h3>
                    <p class="text-muted mb-4">{{ $totalLessons }} Lessons • {{ $totalLessonTypes }} lectures • Lifetime Access</p>

                    <div class="accordion shadow-sm" id="courseContentAccordion">
                        <!-- First Lesson -->
                        @if ($firstLesson)
                        <div class="accordion-item border-0">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <i class="fas fa-book-open me-2"></i>
                                    {{ $firstLesson->title }} (First Lesson)
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#courseContentAccordion">
                                <div class="accordion-body">
                                    <p class="alert alert-info">{{ $firstLesson->duration }} minutes - {{ $firstLesson->description }}</p>
                                    <ul class="list-group">
                                        @foreach($firstLesson->lessonTypes as $type)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span><i class="fas fa-file-alt me-2 text-primary"></i>{{ $firstLesson->title }}</span>
                                                <a href="{{ asset('uploads/' . $type->reading) }}" target="_blank" class="btn btn-sm btn-outline-success">
                                                    <i class="fas fa-eye me-1"></i>Preview
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Remaining Lessons -->
                        @foreach ($remainingLessons as $index => $lesson)
                        <div class="accordion-item border-0">
                            <h2 class="accordion-header" id="headingTwo-{{ $index }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo-{{ $index }}" aria-expanded="false" aria-controls="collapseTwo-{{ $index }}">
                                    <i class="fas fa-book-open me-2"></i>
                                    {{ $lesson->title }}
                                    @if(!$enrolled || $enrolled->status !== 'enrolled')
                                        <span class="ms-2 badge bg-warning text-dark"><i class="fas fa-lock fa-sm fa-fw"></i> Locked</span>
                                    @endif
                                </button>
                            </h2>
                            <div id="collapseTwo-{{ $index }}" class="accordion-collapse collapse" aria-labelledby="headingTwo-{{ $index }}" data-bs-parent="#courseContentAccordion">
                                <div class="accordion-body">
                                    <p class="alert alert-info">{{ $lesson->duration }} minutes - {{ $lesson->description }}</p>
                                    <ul class="list-group">
                                        @foreach($lesson->lessonTypes as $type)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span><i class="fas fa-file-alt me-2 text-primary"></i>{{ $lesson->title }}</span>
                                                @if($enrolled && $enrolled->status === 'enrolled')
                                                    <a href="{{ asset('uploads/'. $type->reading) }}" target="_blank" class="btn btn-sm btn-outline-success">
                                                        <i class="fas fa-eye me-1"></i>View
                                                    </a>
                                                @else
                                                    <span class="btn btn-sm btn-outline-secondary" style="cursor: not-allowed;">
                                                        <i class="fas fa-lock me-1"></i>Locked
                                                    </span>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                    @if(!$enrolled || $enrolled->status !== 'enrolled')
                                        <div class="alert alert-warning mt-3">
                                            <i class="fas fa-info-circle me-2"></i>This lesson is locked. Enroll in the course to access all content.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Sticky Sidebar -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 5rem; z-index: 0 !important;">
                    <div class="card shadow-lg border-0 rounded-lg mb-5">
                        <div class="card-body">
                            <h3 class="fw-bold mb-3">Enroll Now</h3>
                            <p class="lead">Join now to gain access to exclusive course materials and instructor support!</p>
                            @if($enrolled && $enrolled->status === 'enrolled')
                                <a href="#" class="btn btn-success w-100">
                                    <i class="fas fa-check-circle me-2"></i>Continue Learning
                                </a>
                            @else
                                @if(auth()->check())
                                    <form action="{{ route('course.enroll', ['course_id' => $courses->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-secondary w-100"><i class="fas fa-user-plus me-2"></i>Enroll Now</button>
                                    </form>
                                @else
                                    <button class="btn btn-outline-success w-100" data-bs-toggle="modal" data-bs-target="#loginModal">
                                        <i class="fas fa-user me-2"></i>Login to Enroll
                                    </button>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="card shadow-lg border-0 rounded-lg mb-4">
                        <div class="card-body text-center">
                            <h2 class="fw-bold text-success mb-3">TZS {{ number_format($courses->price, 0) }}/-</h2>
                            <p class="text-muted mb-3"><s>TZS {{ number_format(rand(40000, 60000), 0) }}/-</s> <span class="badge bg-danger">90% off</span></p>

                            @auth
                                @php
                                    $userId = Auth::id();
                                    $enrolled = \App\Models\Enrollments::where('user_id', $userId)
                                        ->where('course_id', $courses->id)
                                        ->exists();
                                    $inCart = \App\Models\Carts::where('user_id', $userId)
                                        ->where('course_id', $courses->id)
                                        ->exists();
                                @endphp

                                @if (!$enrolled)
                                    @if ($inCart)
                                        <a href="{{ route('cart') }}" class="btn btn-outline-success btn-sm w-100 mb-3">
                                            <i class="fas fa-shopping-cart me-2"></i>Go to Cart
                                        </a>
                                    @else
                                        <a href="{{ route('cart.add', ['course_id' => $courses->id]) }}" class="btn btn-success btn-sm w-100 mb-3">
                                            <i class="fas fa-cart-plus me-2"></i>Add to Cart
                                        </a>
                                    @endif
                                    <form action="{{ route('course.enroll', ['course_id' => $courses->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-secondary btn-sm w-100">Enroll Now</button>
                                    </form>
                                @else
                                    <button class="btn btn-secondary btn-sm w-100" disabled>
                                        <i class="fas fa-check-circle me-2"></i>Enrolled
                                    </button>
                                @endif
                            @else
                                <a href="{{ route('cart.add', ['course_id' => $courses->id]) }}" class="btn btn-success btn-sm w-100 mb-3">
                                    <i class="fas fa-cart-plus me-2"></i>Add to Cart
                                </a>
                                <a href="{{ route('course.enroll.link', ['course_id' => $courses->id]) }}" class="btn btn-outline-success btn-sm w-100">Enroll Now</a>
                            @endauth

                            <p class="text-muted mt-3">
                                <i class="fas fa-shield-alt me-2"></i>30-Day Money-Back Guarantee
                            </p>
                        </div>
                    </div>

                    <div class="card shadow border-0 rounded-lg mb-4">
                        <div class="card-body">
                            <h4 class="fw-bold mb-3">This Course Includes:</h4>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-video text-success me-2"></i> {{ $totalLessons }} on-demand video lessons</li>
                                <li class="mb-2"><i class="fas fa-file-download text-success me-2"></i> Downloadable resources</li>
                                <li class="mb-2"><i class="fas fa-infinity text-success me-2"></i> Full lifetime access</li>
                                <li class="mb-2"><i class="fas fa-mobile-alt text-success me-2"></i> Access on mobile and TV</li>
                                <li class="mb-2"><i class="fas fa-certificate text-success me-2"></i> Certificate of completion</li>
                                <li><i class="fas fa-headset text-success me-2"></i> 24/7 Support</li>
                            </ul>
                        </div>
                    </div>

                    <div class="card shadow border-0 rounded-lg mb-4">
                        <div class="card-body">
                            <h4 class="fw-bold mb-3">Similar Courses</h4>
                            <ul class="list-group list-group-flush">
                                {{-- @foreach ($similarCourses as $similarCourse) --}}
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="#" class="text-decoration-none text-primary">
                                            <i class="fas fa-book-open text-success me-2"></i> New similar course
                                        </a>
                                        <span class="badge bg-primary rounded-pill">TZS {{ number_format(rand(40000, 60000), 0) }}/-</span>
                                    </li>
                                {{-- @endforeach --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals -->
<!-- Course Demo Modal -->
<div class="modal fade" id="courseDemo" tabindex="-1" role="dialog" aria-labelledby="courseDemoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="courseDemoLabel">Course Demo Video</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <video controls class="w-100">
                    <source src="{{ asset('uploads/demo/demo-video.mp4') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
    </div>
</div>

<!-- Syllabus Modal -->
<div class="modal fade" id="syllabusModal" tabindex="-1" role="dialog" aria-labelledby="syllabusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="syllabusModalLabel">Course Syllabus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4>Syllabus Overview</h4>
                <p>{{ $courses->syllabus }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Instructor Bio Modal -->
<div class="modal fade" id="instructorBio" tabindex="-1" role="dialog" aria-labelledby="instructorBioLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="instructorBioLabel">Instructor Bio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>{{ $courses->instructor->bio }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Exercise Demo Modal -->
<div class="modal fade" id="exerciseDemo" tabindex="-1" role="dialog" aria-labelledby="exerciseDemoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exerciseDemoLabel">Sample Exercise</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Try your skills with a sample exercise below:</p>
                <!-- Embed exercise code or content -->
            </div>
        </div>
    </div>
</div>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login to Enroll</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-success btn-sm w-100">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('styles')
<style>
    .hero-section {
        background: linear-gradient(135deg, #3d4058a8 0%, #09802d 100%);
        color: white;
    }
</style>
@endpush
