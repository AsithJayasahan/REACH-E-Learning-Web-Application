<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('style.css') }}">
   <!-- Favicon -->
    <link href="img/3541249.png" rel="icon">
    <style>
        /* Additional Styles for Courses Grid */
        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .course-card {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .course-card:hover {
            transform: translateY(-5px);
        }

        .course-image {
            height: 160px;
            overflow: hidden;
        }

        .course-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .course-content {
            padding: 20px;
        }

        .course-title {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: #333;
        }

        .course-meta {
            display: flex;
            flex-direction: column;
            gap: 5px;
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 15px;
        }

        .course-meta i {
            margin-right: 5px;
        }

        .course-progress {
            height: 6px;
            background: #f0f0f0;
            border-radius: 3px;
            margin-bottom: 15px;
        }

        .progress-bar {
            height: 100%;
            background: #4CAF50;
            border-radius: 3px;
        }

        .course-actions {
            display: flex;
            justify-content: flex-end;
        }

        .btn-view {
            background: #4CAF50;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 0.9rem;
            transition: background 0.3s;
        }

        .btn-view:hover {
            background: #3e8e41;
        }

        .no-courses {
            text-align: center;
            padding: 40px 20px;
        }

        .no-courses img {
            max-width: 200px;
            margin-bottom: 20px;
        }

        .no-courses h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #333;
        }

        .no-courses p {
            color: #666;
            margin-bottom: 20px;
        }

        .btn-browse {
            background: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: background 0.3s;
        }

        .btn-browse:hover {
            background: #3e8e41;
        }
    </style>
</head>
<body class="user">
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="/Home" class="brand">
            <img src="/img/logo.png" alt="" style="width: 40%">
        </a>
        <ul class="side-menu top">
            <li class="active">
                <a href="#profile-section">
                    <i class='bx bxs-user-circle'></i>
                    <span class="text">Profile Details</span>
                </a>
            </li>
            <li>
                <a href="#courses-section">
                    <i class='bx bxs-book-open'></i>
                    <span class="text">Courses</span>
                </a>
            </li>
            <li>
                <a href="#enroll-section">
                    <i class='bx bxs-book-add'></i>
                    <span class="text">My Courses</span>
                </a>
            </li>
            <li>
                <a href="#completed-section">
                    <i class='bx bxs-check-circle'></i>
                    <span class="text">Completed</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <!-- In your sidebar menu (replace the current logout link) -->
<li>
    <a href="#"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class='bx bxs-log-out-circle'></i>
        <span class="text">Logout</span>
    </a>

    <!-- Add this hidden form somewhere in your HTML (right before </body> is good) -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</li>
        </ul>
    </section>

    <!-- CONTENT -->
    <section id="content">
        <nav>
            <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search courses...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
            <a href="#courses-section" class="profile">
                <img src="{{ asset('assets/user-avatar.jpg') }}" alt="User Avatar">
            </a>
        </nav>

        <main>
            <!-- Profile Section -->
            <div id="profile-section" class="section-content active-section">
                <div class="head-title">
                    <div class="left">
                        <h1>My Profile</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">User</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="#">Profile Details</a></li>
                        </ul>
                    </div>
                    <button class="btn-edit-profile">
                        <i class='bx bxs-edit'></i>
                        <span class="text">Edit Profile</span>
                    </button>
                </div>

                <div class="profile-container">
                    <div class="profile-header">
                        <div class="profile-avatar">
                            <img src="{{ asset('assets/user-avatar.jpg') }}" alt="Profile Picture">
                        </div>
                        <div class="profile-info">
                            <h2>{{ $user['name'] ?? 'N/A' }}</h2>
                            <p>{{ $user['email'] ?? 'N/A' }}</p>
                            <p>Member since: <span>{{ $user['created_at'] ?? 'N/A' }}</span></p>
                        </div>
                    </div>

                    <div class="profile-details">
                        <div class="detail-card">
                            <h3><i class='bx bxs-id-card'></i> Personal Information</h3>
                            <div class="detail-row">
                                <span class="detail-label">Full Name:</span>
                                <span class="detail-value">{{ $user['name'] ?? 'N/A' }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Email:</span>
                                <span class="detail-value">{{ $user['email'] ?? 'N/A' }}</span>
                            </div>

                        </div>

                        <div class="detail-card">
                            <h3><i class='bx bxs-graduation'></i> Learning Statistics</h3>
                            <div class="stats-grid">
                                <div class="stat-item"><i class='bx bxs-book'></i><div><span class="stat-value">{{ $enrolledCourseCount ?? 0 }}</span><span class="stat-label">Enrolled Courses</span></div></div>
                                <div class="stat-item"><i class='bx bxs-check-circle'></i><div><span class="stat-value">{{ $completedCourseCount ?? 0 }}</span><span class="stat-label">Completed</span></div></div>
                                <div class="stat-item"><i class='bx bxs-check-circle'></i><div><span class="stat-value">{{ count($enrolledCourses)  ?? 0 }}</span><span class="stat-label">Progress</span></div></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Courses Section -->
            <div id="courses-section" class="section-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Available Courses</h1>
                        <ul class="breadcrumb">
                            <li>
                                <a href="#">User</a>
                            </li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li>
                                <a class="active" href="#">Courses</a>
                            </li>
                        </ul>
                    </div>
                    <a href="#" class="btn-download">
                        <i class='bx bxs-download'></i>
                        <span class="text">Course Catalog</span>
                    </a>
                </div>

                <div class="courses-container">
                    <!-- Digital Literacy -->
                    <div class="course-card" data-course-id="1">
                        <div class="course-image">
                            <img src="assets/course1.png" alt="Digital Literacy" loading="lazy">
                            <span class="course-category">Technology</span>
                        </div>
                        <div class="course-details">
                            <h3>Digital Literacy Training</h3>
                            <p class="course-description">
                                Master essential digital skills from basic computer operations to online safety and productivity tools.
                            </p>
                            {{-- <div class="course-meta">
                                <span><i class='bx bxs-time'></i> 6 Weeks</span>
                                <span><i class='bx bxs-videos'></i> 24 Lessons</span>
                                <span><i class='bx bxs-star'></i> Beginner</span>
                            </div> --}}
                            <div>
                                <a href="/Digital-Literacy"><button class="btn-outline">View Details</button></a>
                            </div>
                        </div>
                    </div>

                    <!-- Financial Education -->
                    <div class="course-card" data-course-id="2">
                        <div class="course-image">
                            <img src="assets/course2.png" alt="Financial Education" loading="lazy">
                            <span class="course-category">Finance</span>
                        </div>
                        <div class="course-details">
                            <h3>Digital Financial Education</h3>
                            <p class="course-description">
                                Learn personal budgeting, saving strategies, and basic investment principles for financial stability.
                            </p>
                            {{-- <div class="course-meta">
                                <span><i class='bx bxs-time'></i> 4 Weeks</span>
                                <span><i class='bx bxs-videos'></i> 18 Lessons</span>
                                <span><i class='bx bxs-star'></i> Beginner</span>
                            </div> --}}
                            <div>
                                 <a href="/Digital-Finance"><button class="btn-outline">View Details</button></a>
                            </div>
                        </div>
                    </div>

                    <!-- Language Learning -->
                    <div class="course-card" data-course-id="3">
                        <div class="course-image">
                            <img src="assets/course3.png" alt="Language Learning" loading="lazy">
                            <span class="course-category">Language</span>
                        </div>
                        <div class="course-details">
                            <h3>Fundamentals of English Training</h3>
                            <p class="course-description">
                                Develop practical communication skills in your local language for daily life and professional settings.
                            </p>
                            {{-- <div class="course-meta">
                                <span><i class='bx bxs-time'></i> 8 Weeks</span>
                                <span><i class='bx bxs-videos'></i> 30 Lessons</span>
                                <span><i class='bx bxs-star'></i> All Levels</span>
                            </div> --}}
                            <div>
                                 <a href="/English-Training"><button class="btn-outline">View Details</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Enrolled Courses Section -->
            <div id="enroll-section" class="section-content">
                <div class="head-title">
                    <div class="left">
                        <h1>My Enrolled Courses</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">User</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="#">My Courses</a></li>
                        </ul>
                    </div>
                </div>

                <div class="container">
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    @if(isset($enrolledCourses) && $enrolledCourseCount > 0)
                        <div class="alert alert-info">
                            You are enrolled in {{ $enrolledCourseCount }} course(s).
                        </div>

                        <div class="courses-grid">
                            @foreach($enrolledCourses as $courseId => $course)
                                <div class="course-card">
                                    {{-- <div class="course-image">
                                        <img src="{{ $course['courseImage'] ?? asset('assets/default-course.jpg') }}" alt="{{ $course['courseName'] ?? 'Course Image' }}">
                                    </div> --}}
                                    <div class="course-content">
                                        <h3 class="course-title">{{ $course['courseName'] ?? 'Untitled Course' }}</h3>
                                    <p class="course-meta">
                                        <span><i class='bx bxs-calendar'></i> Enrolled: {{ $course['enrollmentDate'] ?? 'Date not available' }}</span>
                                    </p>
                                        <div class="course-progress">
                                            <div class="progress-bar" style="width: {{ $course['progress'] ?? '0' }}%"></div>
                                        </div>

                                        <div class="course-actions">
                                            <a href="{{ route($courseRoutes[$courseId] ?? 'course.show', ['courseId' => $courseId]) }}" class="btn-view">
                                                Continue Learning
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="no-courses">
                            <img src="{{ asset('assets/no-courses.png') }}" alt="No courses enrolled">
                            <h3>No enrolled courses yet</h3>
                            <p>Browse our courses and start learning today!</p>
                        </div>
                    @endif
                </div>
            </div>


           <!-- Completed Courses Section -->
<div id="completed-section" class="section-content">
    <div class="head-title">
        <div class="left">
            <h1>Completed Courses</h1>
            <ul class="breadcrumb">
                <li><a href="#">User</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a class="active" href="#">Completed</a></li>
            </ul>
        </div>
    </div>

    <div class="completed-courses-container">
        @if(isset($completedCourses) && count($completedCourses) > 0)
                <p>You've successfully completed {{ count($completedCourses) }} course(s)</p>
            </div>

            <div class="courses-grid">
                @foreach($completedCourses as $courseId => $course)
                <div class="completed-course-card">
                    <!-- Ribbon for completed course -->
                    <div class="completed-ribbon">COMPLETED</div>

                    <!-- Medal based on score -->
                    @php
                        $score = $course['score'] ?? 0;
                        $medal = '';
                        if ($score >= 90) {
                            $medal = 'gold';
                        } elseif ($score >= 75) {
                            $medal = 'silver';
                        } elseif ($score >= 60) {
                            $medal = 'bronze';
                        }
                    @endphp

                    @if($medal)
                    <div class="achievement-medal {{ $medal }}">
                        <i class='bx bxs-medal'></i>
                    </div>
                    @endif

                             <div class="trophy-container">
                    <i class='bx bxs-trophy trophy-icon'></i>
                </div>
                    <div class="course-content">
                        <h3 class="course-title">{{ $course['courseName'] ?? 'Untitled Course' }}</h3>

                        <div class="completion-details">
                            <div class="detail-item">
                                <i class='bx bxs-calendar'></i>
                                <span>{{ date('M d, Y', strtotime($course['completionDate'] ?? now())) }}</span>
                            </div>
                        </div>


                        <div class="course-actions">
                            <button class="btn-share" onclick="shareAchievement('{{ $course['courseName'] }}', {{ $score }})">
                                <i class='bx bxs-share-alt'></i> Share
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="celebration-message">
                <i class='bx bxs-party'></i>
                <p>Keep up the great work! Your dedication to learning is impressive.</p>
            </div>
        @else
            <div class="no-courses">
                <div class="empty-state">
                    <img src="{{ asset('assets/no-completed.png') }}" alt="No courses completed">
                    <h3>Your Achievement Wall is Empty</h3>
                    <p>Complete your enrolled courses to unlock badges and certificates</p>
                    <a href="#enroll-section" class="btn-browse">View My Courses</a>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
    /* Completed Courses Section Styles */
    .achievement-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .achievement-header h2 {
        font-size: 28px;
        color: #333;
        margin-bottom: 5px;
    }

    .achievement-header p {
        color: #666;
        font-size: 16px;
    }

    .completed-course-card {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        position: relative;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .completed-course-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .completed-ribbon {
        position: absolute;
        top: 15px;
        right: -30px;
        background: #4CAF50;
        color: white;
        padding: 5px 30px;
        transform: rotate(45deg);
        font-size: 12px;
        font-weight: bold;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .achievement-medal {
        position: absolute;
        top: 15px;
        left: 15px;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        z-index: 1;
    }

    .achievement-medal.gold {
        background: linear-gradient(135deg, #FFD700, #D4AF37);
        color: #FFF;
        text-shadow: 0 1px 2px rgba(0,0,0,0.3);
    }

    .achievement-medal.silver {
        background: linear-gradient(135deg, #C0C0C0, #A8A8A8);
        color: #FFF;
        text-shadow: 0 1px 2px rgba(0,0,0,0.3);
    }

    .achievement-medal.bronze {
        background: linear-gradient(135deg, #CD7F32, #A67C52);
        color: #FFF;
        text-shadow: 0 1px 2px rgba(0,0,0,0.3);
    }

    .trophy-container {
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f5f7fa 0%, #e4e8eb 100%);
    }

    .trophy-icon {
        font-size: 60px;
        color: #FFD700;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .completed-course-card .course-content {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .completed-course-card .course-title {
        font-size: 18px;
        margin-bottom: 15px;
        color: #333;
        text-align: center;
    }

    .completion-details {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 10px;
    }

    .detail-item {
        display: flex;
        align-items: center;
        color: #666;
        font-size: 14px;
        background: #f8f9fa;
        padding: 5px 10px;
        border-radius: 20px;
    }

    .detail-item i {
        margin-right: 5px;
        font-size: 16px;
    }

    .course-actions {
        margin-top: auto;
        display: flex;
        justify-content: center;
    }

    .btn-share {
        padding: 8px 20px;
        border-radius: 5px;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        transition: all 0.3s ease;
        background: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
    }

    .btn-share:hover {
        background: #3e8e41;
    }

    .celebration-message {
        text-align: center;
        margin-top: 30px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .celebration-message i {
        font-size: 24px;
        color: #FFD700;
    }

    .celebration-message p {
        margin: 0;
        font-size: 16px;
        color: #555;
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        background: #f8f9fa;
        border-radius: 10px;
    }

    .empty-state img {
        max-width: 200px;
        margin-bottom: 20px;
        opacity: 0.7;
    }

    .empty-state h3 {
        font-size: 20px;
        color: #555;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #777;
        margin-bottom: 20px;
    }

    .btn-browse {
        display: inline-block;
        padding: 10px 20px;
        background: #4CAF50;
        color: white;
        border-radius: 5px;
        text-decoration: none;
        transition: background 0.3s;
    }

    .btn-browse:hover {
        background: #3e8e41;
    }

    /* Social Share Button Styles */
    .social-share-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        color: white;
        padding: 8px 15px;
        border-radius: 5px;
        text-decoration: none;
        font-size: 14px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .social-share-btn:hover {
        opacity: 0.9;
        transform: translateY(-2px);
    }

    .social-share-btn i {
        font-size: 16px;
    }

    .facebook { background: #4267B2 !important; }
    .twitter { background: #1DA1F2 !important; }
    .linkedin { background: #0077B5 !important; }
    .copy { background: #6c757d !important; }
</style>

<script>
    function shareAchievement(courseName, score) {
        const shareText = `I just completed "${courseName}" with a score of ${score}%! Check out my achievement on REACH Learning Platform.`;
        const shareUrl = window.location.href;

        // Encode the text and URL for each platform
        const twitterUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(shareText)}&url=${encodeURIComponent(shareUrl)}`;
        const facebookUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(shareUrl)}&quote=${encodeURIComponent(shareText)}`;
        const linkedinUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(shareUrl)}`;

        Swal.fire({
            title: 'Share Your Achievement',
            html: `
                <div style="text-align: center; margin-bottom: 20px;">
                    <p style="margin-bottom: 20px;">${shareText}</p>
                    <div style="display: flex; justify-content: center; gap: 10px; flex-wrap: wrap;">
                        <a href="${facebookUrl}" target="_blank" class="social-share-btn facebook">
                            <i class='bx bxl-facebook'></i> Facebook
                        </a>
                        <a href="${twitterUrl}" target="_blank" class="social-share-btn twitter">
                            <i class='bx bxl-twitter'></i> Twitter
                        </a>
                        <a href="${linkedinUrl}" target="_blank" class="social-share-btn linkedin">
                            <i class='bx bxl-linkedin'></i> LinkedIn
                        </a>
                        <button onclick="copyToClipboard('${shareText.replace(/'/g, "\\'")}')" class="social-share-btn copy">
                            <i class='bx bx-copy'></i> Copy
                        </button>
                    </div>
                </div>
            `,
            showConfirmButton: false,
            showCloseButton: true
        });
    }

    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            Swal.fire({
                icon: 'success',
                title: 'Copied!',
                text: 'Achievement text copied to clipboard',
                timer: 2000,
                showConfirmButton: false
            });
        }).catch(err => {
            console.error('Failed to copy:', err);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to copy text',
                timer: 2000,
                showConfirmButton: false
            });
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Set up circular progress indicators if needed
        document.querySelectorAll('.progress-circle').forEach(circle => {
            const progress = circle.dataset.progress;
            const normalizedRadius = 26;
            const circumference = normalizedRadius * 2 * Math.PI;
            const strokeDashoffset = circumference - (progress / 100) * circumference;

            const ring = circle.querySelector('.progress-ring-circle');
            ring.style.strokeDasharray = `${circumference} ${circumference}`;
            ring.style.strokeDashoffset = strokeDashoffset;

            // Set color based on progress
            if (progress >= 90) {
                ring.style.stroke = '#FFD700'; // Gold
            } else if (progress >= 75) {
                ring.style.stroke = '#C0C0C0'; // Silver
            } else if (progress >= 60) {
                ring.style.stroke = '#CD7F32'; // Bronze
            } else {
                ring.style.stroke = '#4CAF50'; // Green
            }
        });
    });
</script>

            <!-- Course Preview Section (Optional Rendering) -->
            @if(isset($courseViewHtml))
                <div class="course-preview-section" style="margin-top: 40px;">
                    {!! $courseViewHtml !!}
                </div>
            @endif

        </main>
    </section>

        </main>
    </section>


    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom JS -->
    <script src="{{ asset('script.js') }}"></script>
    <script>
        // Section switching functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Get all section links
            const sectionLinks = document.querySelectorAll('.side-menu a[href^="#"]');

            // Get all sections
            const sections = document.querySelectorAll('.section-content');

            // Add click event listeners to section links
            sectionLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Get the target section ID
                    const targetId = this.getAttribute('href');
                    const targetSection = document.querySelector(targetId);

                    // Hide all sections
                    sections.forEach(section => {
                        section.classList.remove('active-section');
                    });

                    // Show the target section
                    if (targetSection) {
                        targetSection.classList.add('active-section');
                    }

                    // Update active state in sidebar
                    sectionLinks.forEach(link => {
                        link.parentElement.classList.remove('active');
                    });
                    this.parentElement.classList.add('active');
                });
            });

            // Initialize the first section as active
            if (sections.length > 0) {
                sections[0].classList.add('active-section');
            }
        });
    </script>

    <script>
// Add this to your script.js or <script> tags
document.querySelector('.logout').addEventListener('click', function(e) {
    e.preventDefault();

    Swal.fire({
        title: 'Logout?',
        text: "Are you sure you want to sign out?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#4CAF50',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, logout!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('logout-form').submit();
        }
    });
});
    </script>

</body>
</html>
