<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Fundamentals of English Training Course</title>
       <!-- Favicon -->
    <link href="img/3541249.png" rel="icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #06BBCC;
            --primary-dark: #05a3b3;
            --secondary-color: #2a2d2d;
            --accent-color: #4CAF50;
            --danger-color: #f44336;
            --light-gray: #f5f5f5;
            --medium-gray: #e0e0e0;
            --dark-gray: #696969;
            --text-dark: #333;
            --text-light: #fff;
            --sidebar-width: 280px;
            --header-height: 70px;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            color: var(--text-dark);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Header Styles */
        header {
            height: var(--header-height);
            background-color: var(--secondary-color);
            color: var(--text-light);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 25px;
            box-shadow: var(--shadow);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo {
            height: 40px;
            width: 40px;
            object-fit: contain;
        }

        .header-title {
            font-size: 1.4rem;
            font-weight: 600;
            margin: 0;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .user-name {
            font-size: 0.9rem;
        }

        .logout-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 20px;
            cursor: pointer;
            font-weight: 600;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logout-btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        /* Main Layout */
        .container {
            display: flex;
            min-height: 100vh;
            padding-top: var(--header-height);
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--secondary-color);
            color: var(--text-light);
            padding: 20px 0;
            position: fixed;
            top: var(--header-height);
            left: 0;
            bottom: 0;
            overflow-y: auto;
            transition: var(--transition);
            z-index: 999;
        }

        .sidebar-header {
            padding: 0 20px 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 15px;
        }

        .sidebar-title {
            font-size: 1.1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-title i {
            color: var(--primary-color);
        }

        .progress-container {
            margin-top: 15px;
        }

        .progress-text {
            display: flex;
            justify-content: space-between;
            font-size: 0.8rem;
            margin-bottom: 5px;
        }

        .progress-bar {
            height: 6px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background-color: var(--primary-color);
            width: 20%;
            border-radius: 3px;
            transition: width 0.5s ease;
        }

        .sidebar-menu {
            list-style: none;
        }

        .menu-section {
            margin-bottom: 20px;
        }

        .menu-section-title {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.6);
            padding: 0 20px;
            margin-bottom: 10px;
        }

        .menu-item {
            padding: 0 15px;
        }

        .menu-link {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: var(--text-light);
            text-decoration: none;
            border-radius: 6px;
            transition: var(--transition);
            font-size: 0.95rem;
            position: relative;
        }

        .menu-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .menu-link.active {
            background-color: var(--primary-color);
            font-weight: 500;
        }

        .menu-link.completed::after {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            margin-left: auto;
            color: var(--accent-color);
            font-size: 0.8rem;
        }

        .menu-icon {
            margin-right: 12px;
            width: 20px;
            text-align: center;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .menu-link.active .menu-icon {
            color: white;
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 30px;
            transition: var(--transition);
        }

        /* Chapter Content Styles */
        .chapter-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: var(--shadow);
            padding: 30px;
            margin-bottom: 30px;
        }

        .breadcrumb {
            font-size: 0.85rem;
            color: var(--dark-gray);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .breadcrumb a {
            color: var(--dark-gray);
            text-decoration: none;
            transition: var(--transition);
        }

        .breadcrumb a:hover {
            color: var(--primary-color);
        }

        .breadcrumb-separator {
            color: var(--medium-gray);
            font-size: 0.7rem;
        }

        .chapter-title {
            font-size: 1.8rem;
            margin-bottom: 25px;
            color: var(--secondary-color);
            position: relative;
            padding-bottom: 10px;
        }

        .chapter-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background-color: var(--primary-color);
            border-radius: 3px;
        }

        .video-container {
            width: 100%;
            margin: 0 auto 30px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--shadow);
            position: relative;
        }

        .video-container video {
            width: 100%;
            height: auto;
            display: block;
        }

        .content-section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 1.3rem;
            margin-bottom: 15px;
            color: var(--secondary-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        .content-text {
            font-size: 1rem;
            line-height: 1.7;
            color: var(--text-dark);
        }

        .content-text p {
            margin-bottom: 15px;
        }

        .content-text ul {
            margin-bottom: 15px;
            padding-left: 20px;
        }

        .content-text li {
            margin-bottom: 8px;
            position: relative;
        }

        .content-text li::before {
            content: '•';
            color: var(--primary-color);
            font-weight: bold;
            display: inline-block;
            width: 1em;
            margin-left: -1em;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--medium-gray);
        }

        th {
            background-color: var(--light-gray);
            font-weight: 600;
            color: var(--secondary-color);
        }

        tr:hover {
            background-color: rgba(6, 187, 204, 0.05);
        }

        /* Navigation Buttons */
        .navigation-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            gap: 15px;
        }

        .nav-btn {
            padding: 12px 25px;
            border: none;
            border-radius: 30px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-btn i {
            font-size: 0.9rem;
        }

        .nav-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-prev {
            background-color: white;
            color: var(--secondary-color);
            border: 1px solid var(--medium-gray);
        }

        .btn-prev:hover {
            background-color: var(--light-gray);
        }

        .btn-next {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-next:hover {
            background-color: var(--primary-dark);
        }

        .btn-quiz {
            background-color: var(--accent-color);
            color: white;
        }

        .btn-quiz:hover {
            background-color: #3d8b40;
        }

        /* Quiz Styles */
        .quiz-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            margin: 30px 0;
            box-shadow: var(--shadow);
            display: none;
        }

        .quiz-title {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: var(--secondary-color);
        }

        .quiz-description {
            margin-bottom: 25px;
            color: var(--dark-gray);
        }

        .quiz-question {
            margin-bottom: 25px;
            padding: 20px;
            background: var(--light-gray);
            border-radius: 8px;
            border-left: 4px solid var(--primary-color);
        }

        .quiz-question p {
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--secondary-color);
        }

        .quiz-options {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .option-label {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            padding: 10px 15px;
            border-radius: 6px;
            transition: var(--transition);
            background-color: white;
        }

        .option-label:hover {
            background-color: rgba(6, 187, 204, 0.1);
        }

        .option-input {
            accent-color: var(--primary-color);
        }

        textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--medium-gray);
            border-radius: 6px;
            font-family: inherit;
            resize: vertical;
            min-height: 100px;
            transition: var(--transition);
        }

        textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(6, 187, 204, 0.2);
        }

        select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--medium-gray);
            border-radius: 6px;
            font-family: inherit;
            background-color: white;
            transition: var(--transition);
        }

        select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(6, 187, 204, 0.2);
        }

        .quiz-submit {
            background-color: var(--primary-color);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            font-weight: 600;
            font-size: 1rem;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 20px;
        }

        .quiz-submit:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Quiz Results */
        .quiz-results {
            background: white;
            padding: 30px;
            border-radius: 10px;
            margin: 30px 0;
            box-shadow: var(--shadow);
            display: none;
        }

        .results-title {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: var(--secondary-color);
        }

        .quiz-feedback {
            margin-top: 20px;
        }

        .correct-answer {
            color: var(--accent-color);
            font-weight: 500;
            margin-bottom: 10px;
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }

        .correct-answer::before {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
        }

        .wrong-answer {
            color: var(--danger-color);
            font-weight: 500;
            margin-bottom: 10px;
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }

        .wrong-answer::before {
            content: '\f00d';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
        }

        .score-display {
            font-size: 1.3rem;
            margin: 25px 0;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            background-color: rgba(6, 187, 204, 0.1);
        }

        .btn-certificate {
            background-color: var(--accent-color);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            font-weight: 600;
            font-size: 1rem;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 20px auto 0;
        }

        .btn-certificate:hover {
            background-color: #3d8b40;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Translate Button */
        .translate-button {
            position: fixed;
            bottom: 25px;
            left: 25px;
            z-index: 1000;
            padding: 12px 25px;
            border-radius: 30px;
            box-shadow: var(--shadow);
            background-color: var(--primary-color);
            color: white;
            border: none;
            cursor: pointer;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
        }

        .translate-button:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        /* Chapter Navigation */
        .chapter {
            display: none;
        }

        .chapter.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                z-index: 1001;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .menu-toggle {
                display: block;
                background: none;
                border: none;
                color: white;
                font-size: 1.2rem;
                cursor: pointer;
                margin-right: 15px;
            }
        }

        @media (max-width: 768px) {
            .header-title {
                font-size: 1.2rem;
            }

            .user-name {
                display: none;
            }

            .main-content {
                padding: 20px;
            }

            .chapter-container {
                padding: 20px;
            }

            .chapter-title {
                font-size: 1.5rem;
            }

            .navigation-buttons {
                flex-direction: column;
            }

            .nav-btn {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .header {
                padding: 0 15px;
            }

            .header-title {
                font-size: 1.1rem;
            }

            .main-content {
                padding: 15px;
            }

            .chapter-container {
                padding: 15px;
            }

            .chapter-title {
                font-size: 1.3rem;
            }

            .section-title {
                font-size: 1.1rem;
            }

            .translate-button {
                bottom: 15px;
                left: 15px;
                padding: 10px 15px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="header-left">
            <button class="menu-toggle" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <h1 class="header-title">Fundamentals of English Training</h1>
        </div>
        <div class="user-menu">
            <div class="user-profile" onclick="toggleUserDropdown()">
                <div class="user-avatar"><a href="{{ route('profile.show') }}"><i class="fa-solid fa-user"></i></a></div>
            </div>
            <a href="/logout" class="logout-btn" style="text-decoration: none;">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
    </header>

    <!-- Main Container -->
    <div class="container">
        <!-- Sidebar Navigation -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h2 class="sidebar-title">
                    <i class="fas fa-book-open"></i>
                    Course Content
                </h2>
                <div class="progress-container">
                    <div class="progress-text">
                        <span>Course Progress</span>
                        <span>20%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill"></div>
                    </div>
                </div>
            </div>
            <ul class="sidebar-menu">
                <li class="menu-section">
                    <h3 class="menu-section-title">Fundamentals of English Training</h3>
                    <ul>
                        <li class="menu-item">
                            <a href="#" class="menu-link active" onclick="showChapter(4)">
                                <i class="fas fa-home menu-icon"></i>
                                Course Overview
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="menu-link" onclick="showChapter(5)">
                                <i class="fas fa-handshake menu-icon"></i>
                                Module 1: Basic English Greetings & Introductions
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="menu-link" onclick="showChapter(6)">
                                <i class="fas fa-shopping-cart menu-icon"></i>
                                Module 2: Essential Vocabulary for Daily
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="menu-link" onclick="showChapter(7)">
                                <i class="fas fa-comments menu-icon"></i>
                                Module 3: Basic Conversational English
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="menu-link" onclick="showChapter(8)">
                                <i class="fas fa-book-open menu-icon"></i>
                                Module 4: Reading & Understanding Simple English Texts
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="menu-link" onclick="showChapter(9)">
                                <i class="fas fa-pen-alt menu-icon"></i>
                                Module 5: Writing Simple Sentences & Messages
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-section">
                    <h3 class="menu-section-title">Resources</h3>
                    <ul>
                        <li class="menu-item">
                            <a href="https://drive.google.com/file/d/1EbzCQeDlvDgb4j-p8rkv1tjXK5BwnCqi/view?usp=sharing" class="menu-link">
                                <i class="fas fa-download menu-icon"></i>
                                Download Materials
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        <!-- Main Content Area -->
        <div class="main-content">
            <div id="chapterContainer">
                <!-- Course Overview -->
                <div class="chapter active" id="chapter4">
                    <div class="chapter-container">
                        <div class="breadcrumb">
                            <a href="/Home"><i class="fas fa-home"></i> Home</a>
                            <span class="breadcrumb-separator">/</span>
                            <span>Course Overview</span>
                        </div>
                        <h1 class="chapter-title">Fundamentals of English Training</h1>
                        <div class="content-text">
                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-bullseye"></i>
                                    Course Aim
                                </h2>
                                <p>This course provides essential English language skills for everyday communication, helping learners build confidence in speaking, reading, and writing basic English for practical situations.</p>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-list-ol"></i>
                                    Course Modules
                                </h2>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Module</th>
                                            <th>Topic</th>
                                            <th>Duration</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Basic English Greetings & Introductions</td>
                                            <td>30 min</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Essential Vocabulary for Daily</td>
                                            <td>35 min</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Basic Conversational English</td>
                                            <td>25 min</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Reading & Understanding Simple English Texts</td>
                                            <td>30 min</td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Writing Simple Sentences & Messages</td>
                                            <td>30 min</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                    Learning Outcomes
                                </h2>
                                <ul>
                                    <li>Confidently greet people and introduce yourself in English</li>
                                    <li>Use essential vocabulary for daily situations (shopping, transport, health)</li>
                                    <li>Engage in basic conversations and ask common questions</li>
                                    <li>Read and understand simple English texts and signs</li>
                                    <li>Write basic messages and fill out simple forms</li>
                                </ul>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-certificate"></i>
                                    Certification
                                </h2>
                                <p>Upon completing all modules and passing the final quiz, you will receive a Fundamentals of English Training Certificate, which you can download and print.</p>
                            </div>

                            <div class="navigation-buttons">
                                <button class="nav-btn btn-prev" disabled>
                                    <i class="fas fa-arrow-left"></i>
                                    Previous
                                </button>
                                <button class="nav-btn btn-next" onclick="nextChapter()">
                                    Next Module
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Module 1 -->
                <div class="chapter" id="chapter5">
                    <div class="chapter-container">
                        <div class="breadcrumb">
                            <a href="#"><i class="fas fa-home"></i> Home</a>
                            <span class="breadcrumb-separator">/</span>
                            <a href="#" onclick="showChapter(4)">Fundamentals of English Training</a>
                            <span class="breadcrumb-separator">/</span>
                            <span>Module 1: Basic English Greetings & Introductions</span>
                        </div>
                        <h1 class="chapter-title">Module 1: Basic English Greetings & Introductions</h1>

                        <div class="video-container">
                            <iframe src="https://drive.google.com/file/d/1hex2qBolEgV1PJQslGZ93BC5HL6ypN2I/preview" width="100%" height="480" allow="autoplay"></iframe>
                        </div>

                        <div class="content-text">
                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-question-circle"></i>
                                    Basic Greetings
                                </h2>
                                <p>Learn common greetings for different times of day and situations:</p>
                                <ul>
                                    <li>"Good morning/afternoon/evening" - Formal greetings</li>
                                    <li>"Hello/Hi" - Informal greetings</li>
                                    <li>"How are you?" - Common question after greeting</li>
                                    <li>"Nice to meet you" - When meeting someone new</li>
                                </ul>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-user-friends"></i>
                                    Introducing Yourself
                                </h2>
                                <p>Basic phrases for self-introduction:</p>
                                <ul>
                                    <li>"My name is [name]" - Telling your name</li>
                                    <li>"I'm from [place]" - Sharing where you're from</li>
                                    <li>"I work as a [job]" - Talking about your work</li>
                                    <li>"I'm [age] years old" - Sharing your age (optional)</li>
                                </ul>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-exchange-alt"></i>
                                    Responding to Greetings
                                </h2>
                                <p>Common responses to greetings:</p>
                                <ul>
                                    <li>"I'm fine, thank you. And you?" - Response to "How are you?"</li>
                                    <li>"Nice to meet you too" - Response when meeting someone</li>
                                    <li>"Good morning" - Response to morning greeting</li>
                                    <li>"See you later" - When leaving</li>
                                </ul>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-globe"></i>
                                    Cultural Notes
                                </h2>
                                <ul>
                                    <li>In English-speaking countries, handshakes are common for first meetings</li>
                                    <li>Maintain eye contact when greeting someone</li>
                                    <li>Smiling is appropriate in most situations</li>
                                    <li>Use titles (Mr., Mrs., Ms.) with last names for formal situations</li>
                                </ul>
                            </div>

                            <div class="navigation-buttons">
                                <button class="nav-btn btn-prev" onclick="previousChapter()">
                                    <i class="fas fa-arrow-left"></i>
                                    Previous
                                </button>
                                <button class="nav-btn btn-next" onclick="nextChapter()">
                                    Next Module
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Module 2 -->
                <div class="chapter" id="chapter6">
                    <div class="chapter-container">
                        <div class="breadcrumb">
                            <a href="#"><i class="fas fa-home"></i> Home</a>
                            <span class="breadcrumb-separator">/</span>
                            <a href="#" onclick="showChapter(4)">Fundamentals of English Training</a>
                            <span class="breadcrumb-separator">/</span>
                            <span>Module 2: Essential Vocabulary for Daily</span>
                        </div>
                        <h1 class="chapter-title">Module 2: Essential Vocabulary for Daily</h1>

                        <div class="video-container">
                            <iframe src="https://drive.google.com/file/d/1KhjZdYiTaZINeik3zMvJ-7-eZT962aOL/preview" width="100%" height="480" allow="autoplay"></iframe>
                        </div>

                        <div class="content-text">
                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-shopping-basket"></i>
                                    Market Vocabulary
                                </h2>
                                <ul>
                                    <li><strong>Fruits & Vegetables:</strong> Apple, banana, potato, onion</li>
                                    <li><strong>Quantities:</strong> Kilogram, liter, piece</li>
                                    <li><strong>Questions:</strong> "How much is this?", "Do you have...?"</li>
                                    <li><strong>Payment:</strong> Price, discount, receipt</li>
                                </ul>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-bus"></i>
                                    Transportation Terms
                                </h2>
                                <ul>
                                    <li><strong>Modes:</strong> Bus, train, taxi, tuk-tuk</li>
                                    <li><strong>Directions:</strong> Left, right, straight ahead</li>
                                    <li><strong>Questions:</strong> "Where is the bus stop?", "How much to...?"</li>
                                    <li><strong>Tickets:</strong> One-way, return, fare</li>
                                </ul>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-heartbeat"></i>
                                    Health-Related Words
                                </h2>
                                <ul>
                                    <li><strong>Body Parts:</strong> Head, stomach, arm, leg</li>
                                    <li><strong>Symptoms:</strong> Pain, fever, cough, headache</li>
                                    <li><strong>Medicine:</strong> Tablet, syrup, doctor, hospital</li>
                                    <li><strong>Emergencies:</strong> "I need help", "Call a doctor"</li>
                                </ul>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-coins"></i>
                                    Numbers & Money
                                </h2>
                                <ul>
                                    <li>Numbers 1-100 for quantities and prices</li>
                                    <li>Currency words: Dollar, cent, rupee</li>
                                    <li>Asking about price: "How much does this cost?"</li>
                                    <li>Basic math terms: Plus, minus, total</li>
                                </ul>
                            </div>

                            <div class="navigation-buttons">
                                <button class="nav-btn btn-prev" onclick="previousChapter()">
                                    <i class="fas fa-arrow-left"></i>
                                    Previous
                                </button>
                                <button class="nav-btn btn-next" onclick="nextChapter()">
                                    Next Module
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Module 3 -->
                <div class="chapter" id="chapter7">
                    <div class="chapter-container">
                        <div class="breadcrumb">
                            <a href="#"><i class="fas fa-home"></i> Home</a>
                            <span class="breadcrumb-separator">/</span>
                            <a href="#" onclick="showChapter(4)">Fundamentals of English Training</a>
                            <span class="breadcrumb-separator">/</span>
                            <span>Module 3: Basic Conversational English</span>
                        </div>
                        <h1 class="chapter-title">Module 3: Basic Conversational English</h1>

                        <div class="video-container">
                            <iframe src="https://drive.google.com/file/d/1RQKr_BUeOSaqlpOIJsGXfgOeRiPjpHwJ/preview" width="100%" height="480" allow="autoplay"></iframe>
                        </div>

                        <div class="content-text">
                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-question"></i>
                                    Common Questions
                                </h2>
                                <ul>
                                    <li>"What is your name?"</li>
                                    <li>"Where are you from?"</li>
                                    <li>"How old are you?"</li>
                                    <li>"What do you do?" (asking about work)</li>
                                    <li>"Do you have children?"</li>
                                </ul>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-map-marked-alt"></i>
                                    Asking for Directions
                                </h2>
                                <ul>
                                    <li>"Where is the [place]?"</li>
                                    <li>"How do I get to...?"</li>
                                    <li>"Is it far from here?"</li>
                                    <li>"Can you show me on the map?"</li>
                                    <li>Understanding responses: "Turn left", "It's next to..."</li>
                                </ul>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-utensils"></i>
                                    Shopping & Dining
                                </h2>
                                <ul>
                                    <li>"How much does this cost?"</li>
                                    <li>"Do you have [item]?"</li>
                                    <li>"I would like to order..."</li>
                                    <li>"The bill, please"</li>
                                    <li>"Do you accept credit cards?"</li>
                                </ul>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-hands-helping"></i>
                                    Making Requests
                                </h2>
                                <ul>
                                    <li>"Can you help me?"</li>
                                    <li>"Please speak slowly"</li>
                                    <li>"Could you repeat that?"</li>
                                    <li>"I don't understand"</li>
                                    <li>"Thank you for your help"</li>
                                </ul>
                            </div>

                            <div class="navigation-buttons">
                                <button class="nav-btn btn-prev" onclick="previousChapter()">
                                    <i class="fas fa-arrow-left"></i>
                                    Previous
                                </button>
                                <button class="nav-btn btn-next" onclick="nextChapter()">
                                    Next Module
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Module 4 -->
                <div class="chapter" id="chapter8">
                    <div class="chapter-container">
                        <div class="breadcrumb">
                            <a href="#"><i class="fas fa-home"></i> Home</a>
                            <span class="breadcrumb-separator">/</span>
                            <a href="#" onclick="showChapter(4)">Fundamentals of English Training</a>
                            <span class="breadcrumb-separator">/</span>
                            <span>Module 4: Reading Simple Texts</span>
                        </div>
                        <h1 class="chapter-title">Module 4: Reading Simple Texts</h1>

                        <div class="video-container">
                            <iframe src="https://drive.google.com/file/d/1j-i_-55WAYjDl05lEfV7t7yxIyBGX43q/preview" width="100%" height="480" allow="autoplay"></iframe>
                        </div>

                        <div class="content-text">
                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-sign"></i>
                                    Understanding Signs
                                </h2>
                                <ul>
                                    <li>Recognizing common public signs: "Exit", "Toilet", "Danger"</li>
                                    <li>Traffic signs: "Stop", "No Parking", "One Way"</li>
                                    <li>Store signs: "Open", "Closed", "Sale"</li>
                                    <li>Directional signs: "Arrivals", "Departures", "Information"</li>
                                </ul>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-tag"></i>
                                    Product Labels
                                </h2>
                                <ul>
                                    <li>Food labels: Ingredients, expiry date</li>
                                    <li>Medicine labels: Dosage, warnings</li>
                                    <li>Clothing labels: Size, washing instructions</li>
                                    <li>Electronics: "On/Off", "Charge", "Warning"</li>
                                </ul>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-newspaper"></i>
                                    Simple Articles
                                </h2>
                                <ul>
                                    <li>Identifying key information in short texts</li>
                                    <li>Understanding headlines</li>
                                    <li>Weather forecasts</li>
                                    <li>Simple advertisements</li>
                                </ul>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-envelope"></i>
                                    Forms & Documents
                                </h2>
                                <ul>
                                    <li>Application forms: Name, address, date fields</li>
                                    <li>Hotel registration forms</li>
                                    <li>Simple contracts or agreements</li>
                                    <li>Understanding required vs. optional fields</li>
                                </ul>
                            </div>

                            <div class="navigation-buttons">
                                <button class="nav-btn btn-prev" onclick="previousChapter()">
                                    <i class="fas fa-arrow-left"></i>
                                    Previous
                                </button>
                                <button class="nav-btn btn-next" onclick="nextChapter()">
                                    Next Module
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Module 5 -->
                <div class="chapter" id="chapter9">
                    <div class="chapter-container">
                        <div class="breadcrumb">
                            <a href="#"><i class="fas fa-home"></i> Home</a>
                            <span class="breadcrumb-separator">/</span>
                            <a href="#" onclick="showChapter(4)">Fundamentals of English Training</a>
                            <span class="breadcrumb-separator">/</span>
                            <span>Module 5: Writing Simple Messages</span>
                        </div>
                        <h1 class="chapter-title">Module 5: Writing Simple Messages</h1>

                        <div class="video-container">
                            <iframe src="https://drive.google.com/file/d/1BX4yaO38Fkjw_iknPnC4yv8cwelm34AA/preview" width="100%" height="480" allow="autoplay"></iframe>
                        </div>

                        <div class="content-text">
                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-sms"></i>
                                    SMS & WhatsApp Messages
                                </h2>
                                <ul>
                                    <li>Basic message structure: Greeting + Content</li>
                                    <li>Common abbreviations: "Pls" (please), "Thx" (thanks)</li>
                                    <li>Making plans: "Can we meet at 5pm?"</li>
                                    <li>Confirming information: "Is our meeting still on?"</li>
                                </ul>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-envelope"></i>
                                    Simple Emails
                                </h2>
                                <ul>
                                    <li>Basic email structure: Subject, greeting, body, closing</li>
                                    <li>Common phrases: "I'm writing to...", "Thank you for..."</li>
                                    <li>Making requests: "Could you please...?"</li>
                                    <li>Closing: "Best regards", "Sincerely"</li>
                                </ul>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-file-alt"></i>
                                    Filling Out Forms
                                </h2>
                                <ul>
                                    <li>Personal information: Name, address, phone number</li>
                                    <li>Dates: Day/Month/Year format</li>
                                    <li>Checkboxes and radio buttons</li>
                                    <li>Signature lines</li>
                                </ul>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-list"></i>
                                    Lists & Notes
                                </h2>
                                <ul>
                                    <li>Shopping lists: Item + quantity</li>
                                    <li>To-do lists: Simple action items</li>
                                    <li>Reminders: Time + task</li>
                                    <li>Phone messages: "John called - please call back"</li>
                                </ul>
                            </div>

                            <div class="navigation-buttons">
                                <button class="nav-btn btn-prev" onclick="previousChapter()">
                                    <i class="fas fa-arrow-left"></i>
                                    Previous
                                </button>
                                <button class="nav-btn btn-quiz" onclick="showQuiz()">
                                    <i class="fas fa-question-circle"></i>
                                    Take Final Quiz
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Quiz Container -->
                    <div class="quiz-container" id="quizContainer">
                        <h2 class="quiz-title">Course Quiz</h2>
                        <p class="quiz-description">Please answer these 5 questions to complete the course and earn your certificate.</p>

                        <form id="quizForm">
                            <div class="quiz-question">
                                <p>1. What are three common English greetings?</p>
                                <textarea name="q1" rows="3" required placeholder="Type your answer here..."></textarea>
                            </div>

                            <div class="quiz-question">
                                <p>2. Which phrase would you use to ask for directions to a hospital?</p>
                                <select name="q2" required>
                                    <option value="">Select an answer</option>
                                    <option value="where_hospital">"Where is the hospital?"</option>
                                    <option value="how_are_you">"How are you today?"</option>
                                    <option value="what_time">"What time is it?"</option>
                                    <option value="my_name">"My name is John"</option>
                                </select>
                            </div>

                            <div class="quiz-question">
                                <p>3. What should you do if you don't understand what someone said in English?</p>
                                <div class="quiz-options">
                                    <label class="option-label">
                                        <input type="radio" name="q3" value="pretend" class="option-input" required>
                                        Pretend you understood
                                    </label>
                                    <label class="option-label">
                                        <input type="radio" name="q3" value="ask_repeat" class="option-input">
                                        Say "Could you repeat that please?"
                                    </label>
                                    <label class="option-label">
                                        <input type="radio" name="q3" value="walk_away" class="option-input">
                                        Walk away without responding
                                    </label>
                                </div>
                            </div>

                            <div class="quiz-question">
                                <p>4. Which of these are important when filling out forms? (Select all that apply)</p>
                                <div class="quiz-options">
                                    <label class="option-label">
                                        <input type="checkbox" name="q4" value="name" class="option-input">
                                        Writing your name clearly
                                    </label>
                                    <label class="option-label">
                                        <input type="checkbox" name="q4" value="date" class="option-input">
                                        Including the date
                                    </label>
                                    <label class="option-label">
                                        <input type="checkbox" name="q4" value="signature" class="option-input">
                                        Providing a signature if required
                                    </label>
                                </div>
                            </div>

                            <div class="quiz-question">
                                <p>5. True or False: It's okay to share personal information like your bank details with strangers online.</p>
                                <div class="quiz-options">
                                    <label class="option-label">
                                        <input type="radio" name="q5" value="true" class="option-input" required>
                                        True
                                    </label>
                                    <label class="option-label">
                                        <input type="radio" name="q5" value="false" class="option-input">
                                        False
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="quiz-submit">
                                <i class="fas fa-paper-plane"></i>
                                Submit Quiz
                            </button>
                        </form>
                    </div>

                    <!-- Quiz Results -->
                    <div class="quiz-results" id="quizResults">
                        <h2 class="results-title">Quiz Results</h2>
                        <div id="resultsContent"></div>

                        <div class="score-display">
                            <p>You scored: <strong>3 out of 5</strong> (60%)</p>
                            <p>You need at least 3 correct answers to pass.</p>
                        </div>

                        <button onclick="generateCertificate()" class="btn-certificate">
                            <i class="fas fa-certificate"></i>
                            Generate Certificate
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Translate Button -->
    <button class="translate-button" onclick="translateContent()">
        <i class="fas fa-language"></i>
        Translate To Sinhala
    </button>

    <script>
        // Current chapter tracking
        let currentChapter = 4; // default start on Course Overview
        const totalChapters = 10;

        // Toggle sidebar on mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }

        // Show specific chapter
        function showChapter(index) {
            currentChapter = index;
            updateChapterView();

            // Close sidebar on mobile after selection
            if (window.innerWidth < 992) {
                document.getElementById('sidebar').classList.remove('active');
            }
        }

        // Navigate to next chapter
        function nextChapter() {
            if (currentChapter < totalChapters - 1) {
                currentChapter++;
                updateChapterView();
            }
        }

        // Navigate to previous chapter
        function previousChapter() {
            if (currentChapter > 0) {
                currentChapter--;
                updateChapterView();
            }
        }

        // Update the visible chapter and menu highlights
        function updateChapterView() {
            // Hide all chapters and remove active class from menu items
            document.querySelectorAll('.chapter').forEach(chapter => {
                chapter.classList.remove('active');
            });

            document.querySelectorAll('.menu-link').forEach(link => {
                link.classList.remove('active');
            });

            // Show current chapter and highlight menu item
            const currentChapterElement = document.getElementById(`chapter${currentChapter}`);
            if (currentChapterElement) {
                currentChapterElement.classList.add('active');

                // Scroll to top of chapter
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }

            const currentMenuItem = document.querySelector(`.menu-link[onclick="showChapter(${currentChapter})"]`);
            if (currentMenuItem) {
                currentMenuItem.classList.add('active');
            }

            // Update progress (example: 20% for chapter 4, 40% for chapter 5, etc.)
            const progress = Math.min(100, Math.max(0, (currentChapter - 3) * 20));
            document.querySelector('.progress-fill').style.width = `${progress}%`;
            document.querySelector('.progress-text span:last-child').textContent = `${progress}%`;
        }

        // Show quiz container
        function showQuiz() {
            document.getElementById('quizContainer').style.display = 'block';
            document.getElementById('quizResults').style.display = 'none';

            // Scroll to quiz
            window.scrollTo({
                top: document.getElementById('quizContainer').offsetTop - 20,
                behavior: 'smooth'
            });
        }

        // Handle quiz submission
        document.getElementById('quizForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Get user answers
            const answers = {
                q1: this.q1.value.trim().toLowerCase(),
                q2: this.q2.value,
                q3: this.q3.value,
                q4: Array.from(this.q4).filter(opt => opt.checked).map(opt => opt.value),
                q5: this.q5.value
            };

            // Correct answers
            const correctAnswers = {
                q1: ['hello', 'hi', 'good morning', 'good afternoon', 'good evening'],
                q2: 'where_hospital',
                q3: 'ask_repeat',
                q4: ['name', 'date', 'signature'],
                q5: 'false'
            };

            // Check answers
            let score = 0;
            let resultsHTML = '<div class="quiz-feedback">';

            // Question 1
            const q1Keywords = answers.q1.split(/[\s,]+/);
            const matchedKeywords = q1Keywords.filter(word =>
                correctAnswers.q1.some(correct => word.includes(correct)))
                .length;

            if (matchedKeywords >= 2) {
                score++;
                resultsHTML += `<p class="correct-answer">1. Correct! Common greetings include Hello, Hi, Good morning/afternoon/evening.</p>`;
            } else {
                resultsHTML += `<p class="wrong-answer">1. Almost! Common greetings include Hello, Hi, Good morning/afternoon/evening.</p>`;
            }

            // Question 2
            if (answers.q2 === correctAnswers.q2) {
                score++;
                resultsHTML += `<p class="correct-answer">2. Correct! "Where is the hospital?" is the right way to ask.</p>`;
            } else {
                resultsHTML += `<p class="wrong-answer">2. Incorrect. The correct answer is "Where is the hospital?"</p>`;
            }

            // Question 3
            if (answers.q3 === correctAnswers.q3) {
                score++;
                resultsHTML += `<p class="correct-answer">3. Correct! Asking someone to repeat is the best approach.</p>`;
            } else {
                resultsHTML += `<p class="wrong-answer">3. Incorrect. You should ask the person to repeat what they said.</p>`;
            }

            // Question 4
            if (answers.q4.length === 3 &&
                answers.q4.includes('name') &&
                answers.q4.includes('date') &&
                answers.q4.includes('signature')) {
                score++;
                resultsHTML += `<p class="correct-answer">4. Correct! Name, date and signature are all important for forms.</p>`;
            } else {
                resultsHTML += `<p class="wrong-answer">4. Incorrect. All three (name, date, signature) are important when filling forms.</p>`;
            }

            // Question 5
            if (answers.q5 === correctAnswers.q5) {
                score++;
                resultsHTML += `<p class="correct-answer">5. Correct! Never share personal information with strangers online.</p>`;
            } else {
                resultsHTML += `<p class="wrong-answer">5. Incorrect. You should never share personal information with strangers.</p>`;
            }

            // Show results
            const passed = score >= 3;
            resultsHTML += `</div>`;

            document.getElementById('resultsContent').innerHTML = resultsHTML;
            document.getElementById('quizContainer').style.display = 'none';
            document.getElementById('quizResults').style.display = 'block';

            // Update score display
            const scoreDisplay = document.querySelector('.score-display');
            scoreDisplay.innerHTML = `
                <p>You scored: <strong>${score} out of 5</strong> (${Math.round(score/5*100)}%)</p>
                <p>${passed ? 'Congratulations! You passed the quiz!' : 'You need at least 3 correct answers to pass.'}</p>
            `;

            if (passed) {
                scoreDisplay.style.backgroundColor = 'rgba(76, 175, 80, 0.1)';
                document.querySelector('.btn-certificate').style.display = 'flex';
            } else {
                scoreDisplay.style.backgroundColor = 'rgba(244, 67, 54, 0.1)';
                document.querySelector('.btn-certificate').style.display = 'none';
            }

            // Scroll to results
            window.scrollTo({
                top: document.getElementById('quizResults').offsetTop - 20,
                behavior: 'smooth'
            });
        });

        // Generate certificate
        function generateCertificate() {
            // Show loading state
            const certBtn = document.querySelector('.btn-certificate');
            const originalBtnText = certBtn.innerHTML;
            certBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Generating...';
            certBtn.disabled = true;

            // Get course name
            const courseName = 'Fundamentals of English Training';

            // Mark course as completed
            fetch('/mark-course-completed', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ courseName: courseName })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Congratulations! Your certificate is being generated...');
                    window.location.href = '/Fundamantals-English-Training-certificate';
                } else {
                    throw new Error(data.message || 'Failed to update course status');
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Error: " + error.message);
            })
            .finally(() => {
                certBtn.innerHTML = originalBtnText;
                certBtn.disabled = false;
            });
        }

        // Translate content to Sinhala
        async function translateContent() {
            const activeChapter = document.querySelector('.chapter.active');
            if (!activeChapter) return;

            // Show loading state
            const translateBtn = document.querySelector('.translate-button');
            const originalBtnText = translateBtn.innerHTML;
            translateBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Translating...';
            translateBtn.disabled = true;

            try {
                // Get all text elements to translate
                const elementsToTranslate = [
                    activeChapter.querySelector('.breadcrumb'),
                    activeChapter.querySelector('.chapter-title'),
                    ...activeChapter.querySelectorAll('.content-section h2, .content-section p, .content-section li')
                ].filter(el => el !== null);

                // Store original texts for reverting
                const originalTexts = elementsToTranslate.map(el => {
                    return {
                        element: el,
                        text: el.textContent.trim(),
                        html: el.innerHTML
                    };
                });

                // Check if already translated
                if (translateBtn.textContent.includes('English')) {
                    // Revert to English
                    originalTexts.forEach(item => {
                        item.element.innerHTML = item.html;
                    });
                    translateBtn.innerHTML = '<i class="fas fa-language"></i> Translate To Sinhala';
                    return;
                }

                // Prepare translation requests
                const translationPromises = originalTexts.map(item => {
                    return fetch('/translate', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ text: item.text })
                    })
                    .then(response => response.json())
                    .then(data => {
                        return {
                            element: item.element,
                            translatedText: data.translated_text || item.text
                        };
                    })
                    .catch(() => {
                        return {
                            element: item.element,
                            translatedText: item.text
                        };
                    });
                });

                // Execute all translations
                const results = await Promise.all(translationPromises);

                // Apply translations
                results.forEach(result => {
                    if (result.element.tagName === 'LI') {
                        result.element.innerHTML = '• ' + result.translatedText;
                    } else {
                        result.element.textContent = result.translatedText;
                    }
                });

                // Change button to allow reverting
                translateBtn.innerHTML = '<i class="fas fa-language"></i> Translate To English';

            } catch (error) {
                console.error("Translation error:", error);
                alert("Translation failed. Please try again.");
            } finally {
                translateBtn.disabled = false;
            }
        }

        // Initialize view
        updateChapterView();
    </script>
</body>
</html>
