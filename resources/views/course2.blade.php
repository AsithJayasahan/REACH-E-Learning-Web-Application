<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Digital Finance Education - Course Introduction</title>
       <!-- Favicon -->
    <link href="img/3541249.png" rel="icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #06BBCC;
            --primary-dark: #05a3b3;
            --secondary-color: #2a2d2d;
            --accent-color: #4CAF50;
            --light-gray: #f5f5f5;
            --dark-gray: #696969;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            color: #333;
        }

        .navbar {
            background-color: var(--primary-color);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand img {
            height: 40px;
        }

        .course-header {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 4px 20px rgba(6, 187, 204, 0.3);
        }

        .course-title {
            font-weight: 700;
            margin-bottom: 15px;
        }

        .course-meta {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.95rem;
        }

        .course-image {
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .section-title {
            font-weight: 600;
            color: var(--secondary-color);
            margin: 25px 0 15px;
            position: relative;
            padding-bottom: 8px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background-color: var(--primary-color);
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            font-weight: 600;
            padding: 15px 20px;
        }

        .list-group-item {
            border-left: none;
            border-right: none;
            padding: 12px 20px;
        }

        .list-group-item:first-child {
            border-top: none;
        }

        .list-group-item:last-child {
            border-bottom: none;
        }

        .badge-expand {
            background-color: var(--primary-color);
            cursor: pointer;
            font-weight: 500;
        }

        .translate-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 999;
            background-color: var(--primary-color);
            color: white;
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }

        .translate-button:hover {
            background-color: var(--primary-dark);
            transform: translateY(-3px);
        }

        .btn-enroll {
            background-color: var(--accent-color);
            color: white;
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 30px;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-enroll:hover {
            background-color: #3d8b40;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.4);
        }

        .btn-enroll:disabled {
            background-color: #a5d6a7;
            transform: none;
            box-shadow: none;
        }

        @media (max-width: 768px) {
            .course-header {
                padding: 20px;
            }

            .course-meta {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="/img/logo.png" alt="Digital Finance Education">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/Home"><i class="fas fa-home me-1"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/profile"><i class="fas fa-user me-1"></i> Profile</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-5">
        <!-- Course Header -->
        <div class="course-header">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="course-title" id="course-title">Digital Finance Education</h1>
                    <p class="lead" id="course-subtitle">Master essential digital finance skills for the modern world</p>
                    <div class="course-meta">
                        <span class="meta-item"><i class="fas fa-clock"></i> 5 Modules</span>
                        <span class="meta-item"><i class="fas fa-chart-line"></i> Beginner Level</span>
                        <span class="meta-item"><i class="fas fa-certificate"></i> Certificate</span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                         alt="Digital Finance Education" class="course-image">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <!-- Course Description -->
                <div class="card">
                    <div class="card-body">
                        <h3 class="section-title">Course Description</h3>
                        <p id="course-description">
                            The Digital Finance Education course is designed to empower individuals with the essential skills and knowledge required to confidently navigate today's digital financial world. This comprehensive program covers everything from basic money management to advanced digital payment systems, helping you become financially literate in the digital age.
                        </p>

                        <h3 class="section-title mt-5">What You'll Learn</h3>
                        <ul class="list-group list-group-flush" id="learning-outcomes">
                            <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i> Create and manage a personal budget effectively</li>
                            <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i> Understand and use digital payment methods safely</li>
                            <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i> Operate ATMs and online banking platforms with confidence</li>
                            <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i> Identify and avoid financial scams and fraud</li>
                            <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i> Buy and sell goods securely on online marketplaces</li>
                        </ul>
                    </div>
                </div>

                <!-- Course Content -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="section-title mb-0">Course Content</h3>
                            <span class="badge bg-primary badge-expand px-3 py-2" id="toggleAll">Expand All</span>
                        </div>

                        <div class="accordion mt-4" id="courseAccordion">
                            <!-- Module 1 -->
                            <div class="accordion-item mb-2 border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#module1">
                                        <i class="fas fa-wallet me-3"></i> Module 1: Introduction to Money Management
                                    </button>
                                </h2>
                                <div id="module1" class="accordion-collapse collapse" data-bs-parent="#courseAccordion">
                                    <div class="accordion-body">
                                        <ul class="list-unstyled">
                                            <li class="py-2"><i class="fas fa-play-circle text-primary me-2"></i> What is Money Management?</li>
                                            <li class="py-2"><i class="fas fa-play-circle text-primary me-2"></i> Creating a Personal Budget</li>
                                            <li class="py-2"><i class="fas fa-play-circle text-primary me-2"></i> Saving Strategies</li>
                                            <li class="py-2"><i class="fas fa-play-circle text-primary me-2"></i> Tracking Expenses</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Module 2 -->
                            <div class="accordion-item mb-2 border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#module2">
                                        <i class="fas fa-credit-card me-3"></i> Module 2: Understanding Digital Payments
                                    </button>
                                </h2>
                                <div id="module2" class="accordion-collapse collapse" data-bs-parent="#courseAccordion">
                                    <div class="accordion-body">
                                        <ul class="list-unstyled">
                                            <li class="py-2"><i class="fas fa-play-circle text-primary me-2"></i> Types of Digital Payments</li>
                                            <li class="py-2"><i class="fas fa-play-circle text-primary me-2"></i> Mobile Payment Apps</li>
                                            <li class="py-2"><i class="fas fa-play-circle text-primary me-2"></i> Online Banking</li>
                                            <li class="py-2"><i class="fas fa-play-circle text-primary me-2"></i> Safety Tips</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Module 3 -->
                            <div class="accordion-item mb-2 border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#module3">
                                        <i class="fas fa-money-check-alt me-3"></i> Module 3: How to Use an ATM
                                    </button>
                                </h2>
                                <div id="module3" class="accordion-collapse collapse" data-bs-parent="#courseAccordion">
                                    <div class="accordion-body">
                                        <ul class="list-unstyled">
                                            <li class="py-2"><i class="fas fa-play-circle text-primary me-2"></i> ATM Basics</li>
                                            <li class="py-2"><i class="fas fa-play-circle text-primary me-2"></i> Withdrawing Cash</li>
                                            <li class="py-2"><i class="fas fa-play-circle text-primary me-2"></i> Checking Balances</li>
                                            <li class="py-2"><i class="fas fa-play-circle text-primary me-2"></i> Safety Precautions</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Module 4 -->
                            <div class="accordion-item mb-2 border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#module4">
                                        <i class="fas fa-shield-alt me-3"></i> Module 4: Avoiding Scams & Fraud
                                    </button>
                                </h2>
                                <div id="module4" class="accordion-collapse collapse" data-bs-parent="#courseAccordion">
                                    <div class="accordion-body">
                                        <ul class="list-unstyled">
                                            <li class="py-2"><i class="fas fa-play-circle text-primary me-2"></i> Common Scam Types</li>
                                            <li class="py-2"><i class="fas fa-play-circle text-primary me-2"></i> Red Flags to Watch For</li>
                                            <li class="py-2"><i class="fas fa-play-circle text-primary me-2"></i> Protecting Your Accounts</li>
                                            <li class="py-2"><i class="fas fa-play-circle text-primary me-2"></i> Reporting Fraud</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Module 5 -->
                            <div class="accordion-item mb-2 border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#module5">
                                        <i class="fas fa-shopping-cart me-3"></i> Module 5: Online Marketplaces
                                    </button>
                                </h2>
                                <div id="module5" class="accordion-collapse collapse" data-bs-parent="#courseAccordion">
                                    <div class="accordion-body">
                                        <ul class="list-unstyled">
                                            <li class="py-2"><i class="fas fa-play-circle text-primary me-2"></i> How Marketplaces Work</li>
                                            <li class="py-2"><i class="fas fa-play-circle text-primary me-2"></i> Setting Up Accounts</li>
                                            <li class="py-2"><i class="fas fa-play-circle text-primary me-2"></i> Safe Shopping Practices</li>
                                            <li class="py-2"><i class="fas fa-play-circle text-primary me-2"></i> Selling Items Online</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Enrollment Card -->
                <div class="card sticky-top" style="top: 20px;">
                    <div class="card-body text-center">
                        <h4 class="card-title mb-4">Start Learning Today</h4>
                        <p class="text-muted mb-4">Enroll now to gain essential digital finance skills</p>

                        <div class="d-grid gap-2">
                            <button class="btn btn-enroll btn-lg" id="enrollButton" onclick="enrollNow()">
                                <span id="enrollText">Enroll Now</span>
                                <span id="enrollSpinner" class="spinner-border spinner-border-sm d-none" role="status"></span>
                            </button>
                        </div>

                        <hr class="my-4">

                        <div class="text-start">
                            <h5 class="mb-3">This course includes:</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-video text-primary me-2"></i> 5 hours of video content</li>
                                <li class="mb-2"><i class="fas fa-file-alt text-primary me-2"></i> Downloadable resources</li>
                                <li class="mb-2"><i class="fas fa-mobile-alt text-primary me-2"></i> Mobile access</li>
                                <li class="mb-2"><i class="fas fa-certificate text-primary me-2"></i> Certificate of completion</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Translate Button -->
    <button class="translate-button" onclick="translateContent()" title="Translate to Sinhala">
        <i class="fas fa-language fa-lg"></i>
    </button>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Expand/Collapse All functionality
        document.getElementById('toggleAll').addEventListener('click', function() {
            const accordions = document.querySelectorAll('.accordion-collapse');
            const isExpanded = this.textContent.includes('Expand');

            accordions.forEach(accordion => {
                const bsCollapse = bootstrap.Collapse.getOrCreateInstance(accordion, { toggle: false });
                isExpanded ? bsCollapse.show() : bsCollapse.hide();
            });

            this.textContent = isExpanded ? 'Collapse All' : 'Expand All';
        });

        // Translation function
        async function translateContent() {
            const translateBtn = document.querySelector('.translate-button');
            const icon = translateBtn.querySelector('i');
            const originalIcon = icon.className;

            // Show loading state
            icon.className = 'fas fa-spinner fa-spin';

            try {
                // Get all text elements to translate
                const elements = [
                    document.getElementById('course-title'),
                    document.getElementById('course-subtitle'),
                    document.getElementById('course-description'),
                    ...document.querySelectorAll('#learning-outcomes li'),
                    ...document.querySelectorAll('.accordion-button'),
                    ...document.querySelectorAll('.accordion-body li')
                ];

                // Store original text for toggling
                if (!translateBtn.dataset.originalText) {
                    translateBtn.dataset.originalText = JSON.stringify(elements.map(el => el.textContent));
                    translateBtn.dataset.translated = 'false';
                }

                // Check if we need to translate or revert
                const shouldTranslate = translateBtn.dataset.translated === 'false';

                if (shouldTranslate) {
                    // Prepare text for translation
                    const textToTranslate = elements.map(el => el.textContent).join('\n---\n');

                    // Send to translation API
                    const response = await fetch('/translate', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ text: textToTranslate })
                    });

                    const data = await response.json();

                    if (data.translated_text) {
                        const translatedParts = data.translated_text.split('\n---\n');

                        // Apply translation
                        elements.forEach((el, index) => {
                            if (translatedParts[index]) {
                                el.textContent = translatedParts[index];
                            }
                        });

                        translateBtn.dataset.translated = 'true';
                        translateBtn.title = 'Translate to English';
                    }
                } else {
                    // Revert to original text
                    const originalTexts = JSON.parse(translateBtn.dataset.originalText);
                    elements.forEach((el, index) => {
                        el.textContent = originalTexts[index];
                    });

                    translateBtn.dataset.translated = 'false';
                    translateBtn.title = 'Translate to Sinhala';
                }
            } catch (error) {
                console.error('Translation error:', error);
                alert('Translation failed. Please try again.');
            } finally {
                // Restore icon
                icon.className = originalIcon;
            }
        }

        // Enroll function
        async function enrollNow() {
            const btn = document.getElementById('enrollButton');
            const enrollText = document.getElementById('enrollText');
            const spinner = document.getElementById('enrollSpinner');

            // Disable button and show spinner
            btn.disabled = true;
            enrollText.textContent = 'Enrolling...';
            spinner.classList.remove('d-none');

            try {
                const response = await fetch('/enroll', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        courseName: 'Digital Finance Education'
                    })
                });

                const data = await response.json();

                if (data.success) {
                    // Update button to show success
                    enrollText.textContent = 'Enrolled!';
                    btn.classList.remove('btn-enroll');
                    btn.classList.add('btn-success');

                    // Redirect to course page after short delay
                    setTimeout(() => {
                        window.location.href = '/Digital-Finance-Education';
                    }, 1500);
                } else {
                    alert(data.message || 'Enrollment failed. Please try again.');
                    resetEnrollButton();
                }
            } catch (error) {
                console.error('Enrollment error:', error);
                alert('An error occurred. Please try again.');
                resetEnrollButton();
            }

            function resetEnrollButton() {
                btn.disabled = false;
                enrollText.textContent = 'Enroll Now';
                spinner.classList.add('d-none');
            }
        }
    </script>
</body>
</html>
