<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Digital Literacy Training Course</title>
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
            width: 25%;
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
            <h1 class="header-title">Digital Literacy Training</h1>
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
                        <span>25%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill"></div>
                    </div>
                </div>
            </div>
            <ul class="sidebar-menu">
                <li class="menu-section">
                    <h3 class="menu-section-title">Digital Literacy Training</h3>
                    <ul>
                        <li class="menu-item">
                            <a href="#" class="menu-link active" onclick="showChapter(4)">
                                <i class="fas fa-home menu-icon"></i>
                                Course Overview
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="menu-link" onclick="showChapter(5)">
                                <i class="fas fa-laptop menu-icon"></i>
                                Module 1: What Is A Computer
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="menu-link" onclick="showChapter(6)">
                                <i class="fas fa-plug menu-icon"></i>
                                Module 2: Buttons And Ports On A Computer
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="menu-link" onclick="showChapter(7)">
                                <i class="fas fa-desktop menu-icon"></i>
                                Module 3: Basic Parts Of A Computer
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="menu-link" onclick="showChapter(8)">
                                <i class="fas fa-wifi menu-icon"></i>
                                Module 4: Connecting To The Internet
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="menu-link" onclick="showChapter(9)">
                                <i class="fas fa-shield-alt menu-icon"></i>
                                Module 5: Protecting Your Computer
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="menu-link" onclick="showChapter(10)">
                                <i class="fas fa-exclamation-triangle menu-icon"></i>
                                Module 6: Understanding Spam And Phishing
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
                            <a href="#"><i class="fas fa-home"></i> Home</a>
                            <span class="breadcrumb-separator">/</span>
                            <span>Course Overview</span>
                        </div>
                        <h1 class="chapter-title">Digital Literacy Training</h1>
                        <div class="content-text">
                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-bullseye"></i>
                                    Course Aim
                                </h2>
                                <p>Help learners understand basic digital skills to use computers, smartphones, and the internet effectively and safely in their daily lives.</p>
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
                                            <td>Introduction to Digital Devices (Computers, Smartphones, Tablets)</td>
                                            <td>30 min</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Basic Computer Skills (Operating System, Keyboard, Mouse, File Management)</td>
                                            <td>45 min</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Internet Basics (How to access, browse, and search safely)</td>
                                            <td>40 min</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Communication Tools (Email, Messaging Apps, Video Calls)</td>
                                            <td>35 min</td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Online Safety & Digital Citizenship (Privacy, Security, Responsible Behavior)</td>
                                            <td>50 min</td>
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
                                    <li>Understand basic computer operations and terminology</li>
                                    <li>Navigate operating systems and file management</li>
                                    <li>Connect to and use the internet safely</li>
                                    <li>Communicate effectively using digital tools</li>
                                    <li>Protect personal information and devices</li>
                                    <li>Recognize and avoid online threats</li>
                                </ul>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-certificate"></i>
                                    Certification
                                </h2>
                                <p>Upon completion of all modules and passing the final assessment, you will receive a Digital Literacy Certificate that you can download and print.</p>
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
                            <a href="#" onclick="showChapter(4)">Digital Literacy Training</a>
                            <span class="breadcrumb-separator">/</span>
                            <span>Module 1: What Is A Computer</span>
                        </div>
                        <h1 class="chapter-title">Module 1: What Is A Computer</h1>

                        <div class="video-container">
                            <iframe src="https://drive.google.com/file/d/1ycwDmJg2f8ZbocItL8bueLcdCiexb5lL/preview" width="100%" height="480" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        </div>

                        <div class="content-text">
                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-question-circle"></i>
                                    What Is A Computer?
                                </h2>
                                <p>A computer is an electronic machine that takes data, processes it, and gives results. We use computers at home, school, offices, and more. It makes tasks faster and easier in our daily lives.</p>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-brain"></i>
                                    Definition of a Computer
                                </h2>
                                <p>A computer is a device that follows instructions (called programs) to do different tasks. It does not think on its own — we must tell it what to do.</p>
                                <p><strong>Example:</strong> Typing on a keyboard shows letters on the screen — the computer follows your input.</p>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-star"></i>
                                    Characteristics of a Computer
                                </h2>
                                <ul>
                                    <li><strong>Speed:</strong> Works very fast.</li>
                                    <li><strong>Accuracy:</strong> Gives correct results.</li>
                                    <li><strong>Automation:</strong> Works on its own after input.</li>
                                    <li><strong>Storage:</strong> Saves lots of data.</li>
                                    <li><strong>Versatility:</strong> Can do many tasks.</li>
                                </ul>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-cogs"></i>
                                    Basic Functions of a Computer
                                </h2>
                                <ul>
                                    <li><strong>Input:</strong> Entering data using keyboard, mouse, etc.</li>
                                    <li><strong>Processing:</strong> CPU processes the data.</li>
                                    <li><strong>Storage:</strong> Saves data temporarily or permanently.</li>
                                    <li><strong>Output:</strong> Shows results using monitor, printer, speakers.</li>
                                </ul>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-puzzle-piece"></i>
                                    Main Parts of a Computer
                                </h2>
                                <ul>
                                    <li><strong>Monitor:</strong> Displays information.</li>
                                    <li><strong>Keyboard:</strong> Used for typing.</li>
                                    <li><strong>Mouse:</strong> Used to point and click.</li>
                                    <li><strong>CPU:</strong> Brain of the computer.</li>
                                    <li><strong>RAM/ROM:</strong> Memory for temporary/permanent tasks.</li>
                                    <li><strong>Hard Drive/SSD:</strong> Data storage.</li>
                                    <li><strong>Other Devices:</strong> Webcam, microphone, speakers, USB drives.</li>
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
                            <a href="#" onclick="showChapter(4)">Digital Literacy Training</a>
                            <span class="breadcrumb-separator">/</span>
                            <span>Module 2: Buttons And Ports On A Computer</span>
                        </div>
                        <h1 class="chapter-title">Module 2: Buttons And Ports On A Computer</h1>

                        <div class="video-container">
                            <iframe src="https://drive.google.com/file/d/10I1Orij9rjbrRdEMQcGsv9LPeBMzMFK-/preview" width="100%" height="480" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        </div>

                        <div class="content-text">
                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-info-circle"></i>
                                    Introduction
                                </h2>
                                <p>On every computer, there are buttons and ports that help us turn it on, connect devices, and use it properly. Knowing what these buttons and ports do is important for using a computer safely and correctly.</p>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-power-off"></i>
                                    Power Button
                                </h2>
                                <p>The <strong>power button</strong> is used to turn the computer on or off.</p>
                                <ul>
                                    <li>Located on the front or top of desktops, or above the keyboard on laptops.</li>
                                    <li>Hold for 2-3 seconds to turn the computer on or shut it down.</li>
                                </ul>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-redo"></i>
                                    Restart / Reset Button
                                </h2>
                                <p>This button restarts the computer. It is useful when the computer is not responding.</p>
                                <ul>
                                    <li>Not available on all laptops.</li>
                                    <li>Use carefully, as it can close programs suddenly.</li>
                                </ul>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-usb"></i>
                                    USB Ports
                                </h2>
                                <p><strong>USB (Universal Serial Bus)</strong> ports are used to connect many devices:</p>
                                <ul>
                                    <li>Printers</li>
                                    <li>Mouse</li>
                                    <li>Keyboard</li>
                                    <li>Phones</li>
                                    <li>Pen drives</li>
                                </ul>
                                <p>Modern computers have multiple USB ports (USB 2.0, 3.0, or USB-C).</p>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-headphones"></i>
                                    Audio Ports
                                </h2>
                                <p>Audio ports are used to connect sound devices:</p>
                                <ul>
                                    <li>Headphones</li>
                                    <li>Microphones</li>
                                    <li>Speakers</li>
                                </ul>
                                <p>These ports are usually color-coded:</p>
                                <ul>
                                    <li>Blue or pink for mic in</li>
                                    <li>Green for audio out</li>
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
                            <a href="#" onclick="showChapter(4)">Digital Literacy Training</a>
                            <span class="breadcrumb-separator">/</span>
                            <span>Module 3: Basic Parts Of A Computer</span>
                        </div>
                        <h1 class="chapter-title">Module 3: Basic Parts Of A Computer</h1>

                        <div class="video-container">
                            <iframe src="https://drive.google.com/file/d/1AgjkGXW89O4HCe55l0KhE_z7iVLKLSfK/preview" width="100%" height="480" allow="autoplay"></iframe>
                        </div>

                        <div class="content-text">
                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-info-circle"></i>
                                    Introduction
                                </h2>
                                <p>A computer is made up of several important parts. Each part has a special job to help the computer work. In this module, we will learn about the basic parts of a computer.</p>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-desktop"></i>
                                    Monitor
                                </h2>
                                <p>The monitor displays what the computer is doing. It shows pictures, videos, texts, and more. It is also called a screen or display.</p>
                                <ul>
                                    <li>Looks like a TV</li>
                                    <li>Used to see the output of the computer</li>
                                </ul>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-keyboard"></i>
                                    Keyboard
                                </h2>
                                <p>The keyboard is used to type letters, numbers, and symbols into the computer.</p>
                                <ul>
                                    <li>Has keys for letters (A-Z), numbers (0-9), and function keys (F1–F12)</li>
                                    <li>Used for typing commands or writing text</li>
                                </ul>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-mouse"></i>
                                    Mouse
                                </h2>
                                <p>The mouse is used to move the pointer (cursor) on the screen and click to open files or select things.</p>
                                <ul>
                                    <li>Has two main buttons: left-click and right-click</li>
                                    <li>Helps in navigation and selection</li>
                                </ul>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-microchip"></i>
                                    Central Processing Unit (CPU)
                                </h2>
                                <p>The CPU is the brain of the computer. It processes all instructions and controls all operations.</p>
                                <ul>
                                    <li>Does the thinking and calculations</li>
                                    <li>Usually inside the system unit (for desktops)</li>
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
                            <a href="#" onclick="showChapter(4)">Digital Literacy Training</a>
                            <span class="breadcrumb-separator">/</span>
                            <span>Module 4: Connecting To The Internet</span>
                        </div>
                        <h1 class="chapter-title">Module 4: Connecting To The Internet</h1>

                        <div class="video-container">
                            <iframe src="https://drive.google.com/file/d/1ZNJOYeR8ui_Bs5ebgH1CPQpcyd0_MxWJ/preview" width="100%" height="480" allow="autoplay"></iframe>
                        </div>

                        <div class="content-text">
                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-info-circle"></i>
                                    Introduction
                                </h2>
                                <p>The internet connects your computer to a world of information. You can visit websites, send emails, watch videos, and more. Let's learn how to connect a computer to the internet.</p>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-globe"></i>
                                    What is the Internet?
                                </h2>
                                <p>The internet is a global network that links computers together. It lets you:</p>
                                <ul>
                                    <li>Search for information</li>
                                    <li>Send and receive emails</li>
                                    <li>Watch videos</li>
                                    <li>Use apps and websites</li>
                                </ul>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-link"></i>
                                    Ways to Connect to the Internet
                                </h2>
                                <p>There are two main ways to connect your computer:</p>
                                <ul>
                                    <li><strong>Wi-Fi</strong> – Wireless connection through a router</li>
                                    <li><strong>Ethernet</strong> – Wired connection using a LAN cable</li>
                                </ul>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-wifi"></i>
                                    Connecting through Wi-Fi
                                </h2>
                                <p>Wi-Fi lets you connect to the internet without cables.</p>
                                <ol>
                                    <li>Click the Wi-Fi icon on your taskbar</li>
                                    <li>Choose your network name (SSID)</li>
                                    <li>Enter the password</li>
                                    <li>Click "Connect"</li>
                                </ol>
                                <p>You are now online wirelessly!</p>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-network-wired"></i>
                                    Connecting through Ethernet
                                </h2>
                                <p>Ethernet gives a faster and more stable internet connection.</p>
                                <ol>
                                    <li>Plug one end of the LAN cable into your computer</li>
                                    <li>Plug the other end into the router or modem</li>
                                    <li>The internet should connect automatically</li>
                                </ol>
                                <p>No password is usually needed for Ethernet.</p>
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
                            <a href="#" onclick="showChapter(4)">Digital Literacy Training</a>
                            <span class="breadcrumb-separator">/</span>
                            <span>Module 5: Protecting Your Computer</span>
                        </div>
                        <h1 class="chapter-title">Module 5: Protecting Your Computer</h1>

                        <div class="video-container">
                            <iframe src="https://drive.google.com/file/d/1IUjKdyAbGKyc_4JeBecdemEXYs4goh0I/preview" width="100%" height="480" allow="autoplay"></iframe>
                        </div>

                        <div class="content-text">
                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-info-circle"></i>
                                    Introduction
                                </h2>
                                <p>Keeping your computer safe is very important. Just like you lock your house to protect your things, you must also protect your computer from harm.</p>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    What Can Harm Your Computer?
                                </h2>
                                <p>Your computer can be harmed in many ways. Here are some common dangers:</p>
                                <ul>
                                    <li><strong>Viruses</strong> – Bad programs that damage files</li>
                                    <li><strong>Phishing</strong> – Fake messages to steal your info</li>
                                    <li><strong>Malware</strong> – Software made to harm your system</li>
                                    <li><strong>Hackers</strong> – People who try to break into your system</li>
                                </ul>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-shield-alt"></i>
                                    Use Antivirus Software
                                </h2>
                                <p>Antivirus software protects your computer by detecting and removing viruses.</p>
                                <ul>
                                    <li>Scan files regularly</li>
                                    <li>Update antivirus often</li>
                                    <li>Popular ones: Avast, Kaspersky, Norton, Windows Defender</li>
                                </ul>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-sync-alt"></i>
                                    Keep Your Software Updated
                                </h2>
                                <p>Updates fix bugs and add protection against new threats.</p>
                                <ul>
                                    <li>Update your operating system (Windows, macOS, Linux)</li>
                                    <li>Update apps and browsers</li>
                                    <li>Turn on automatic updates if possible</li>
                                </ul>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-key"></i>
                                    Use Strong Passwords
                                </h2>
                                <p>Passwords protect your accounts and personal information.</p>
                                <ul>
                                    <li>Use at least 8 characters</li>
                                    <li>Mix of letters, numbers, and symbols</li>
                                    <li>Don't use names or birthdays</li>
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

                <!-- Module 6 -->
                <div class="chapter" id="chapter10">
                    <div class="chapter-container">
                        <div class="breadcrumb">
                            <a href="#"><i class="fas fa-home"></i> Home</a>
                            <span class="breadcrumb-separator">/</span>
                            <a href="#" onclick="showChapter(4)">Digital Literacy Training</a>
                            <span class="breadcrumb-separator">/</span>
                            <span>Module 6: Understanding Spam And Phishing</span>
                        </div>
                        <h1 class="chapter-title">Module 6: Understanding Spam And Phishing</h1>

                        <div class="video-container">
                            <iframe src="https://drive.google.com/file/d/1hUxLlL3UCINBDfLU7en2xqAM2KscKLbX/preview" width="100%" height="480" allow="autoplay"></iframe>
                        </div>

                        <div class="content-text">
                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-info-circle"></i>
                                    Introduction
                                </h2>
                                <p>Every day, people receive unwanted emails called <strong>spam</strong>, and some of them are <strong>phishing</strong> emails that try to trick you. In this module, you'll learn how to spot them and stay safe.</p>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-ban"></i>
                                    What is Spam?
                                </h2>
                                <p><strong>Spam</strong> is junk email sent to many people. It is usually unwanted and sometimes dangerous.</p>
                                <ul>
                                    <li>Promises you free money or prizes</li>
                                    <li>Advertises products you didn't ask for</li>
                                    <li>Sent from unknown or fake email addresses</li>
                                </ul>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-fish"></i>
                                    What is Phishing?
                                </h2>
                                <p><strong>Phishing</strong> is when someone tries to steal your personal information (like passwords or bank details) by pretending to be someone you trust.</p>
                                <ul>
                                    <li>They may ask you to "verify" your account</li>
                                    <li>Pretend to be from your bank or email provider</li>
                                    <li>Ask you to click a link or open a file</li>
                                </ul>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-search"></i>
                                    How to Identify Spam and Phishing Emails
                                </h2>
                                <ul>
                                    <li>Check the sender's email address (is it real?)</li>
                                    <li>Be careful with links (hover over them before clicking)</li>
                                    <li>Poor grammar and spelling = suspicious</li>
                                    <li>Urgent language like "Act now!" or "Your account will be closed"</li>
                                </ul>
                            </div>

                            <div class="content-section">
                                <h2 class="section-title">
                                    <i class="fas fa-shield-virus"></i>
                                    What To Do When You Receive Them
                                </h2>
                                <ul>
                                    <li>Don't reply</li>
                                    <li>Don't click on any links or open attachments</li>
                                    <li>Mark the email as spam or phishing in your inbox</li>
                                    <li>Delete the message immediately</li>
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
                                <p>1. What are the four main functions of a computer?</p>
                                <textarea name="q1" rows="3" required placeholder="Type your answer here..."></textarea>
                            </div>

                            <div class="quiz-question">
                                <p>2. Which port would you use to connect to a wired internet connection?</p>
                                <select name="q2" required>
                                    <option value="">Select an answer</option>
                                    <option value="usb">USB</option>
                                    <option value="hdmi">HDMI</option>
                                    <option value="ethernet">Ethernet</option>
                                    <option value="audio">Audio port</option>
                                </select>
                            </div>

                            <div class="quiz-question">
                                <p>3. What should you do if you receive a suspicious email asking for your password?</p>
                                <div class="quiz-options">
                                    <label class="option-label">
                                        <input type="radio" name="q3" value="reply" class="option-input" required>
                                        Reply with your password
                                    </label>
                                    <label class="option-label">
                                        <input type="radio" name="q3" value="delete" class="option-input">
                                        Delete it immediately
                                    </label>
                                    <label class="option-label">
                                        <input type="radio" name="q3" value="click" class="option-input">
                                        Click on any links in the email
                                    </label>
                                </div>
                            </div>

                            <div class="quiz-question">
                                <p>4. Which of these is NOT a type of computer?</p>
                                <div class="quiz-options">
                                    <label class="option-label">
                                        <input type="checkbox" name="q4" value="desktop" class="option-input">
                                        Desktop
                                    </label>
                                    <label class="option-label">
                                        <input type="checkbox" name="q4" value="laptop" class="option-input">
                                        Laptop
                                    </label>
                                    <label class="option-label">
                                        <input type="checkbox" name="q4" value="toaster" class="option-input">
                                        Toaster
                                    </label>
                                    <label class="option-label">
                                        <input type="checkbox" name="q4" value="tablet" class="option-input">
                                        Tablet
                                    </label>
                                </div>
                            </div>

                            <div class="quiz-question">
                                <p>5. True or False: You should always keep your antivirus software updated.</p>
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
    <button class="translate-button" onclick="translateContent()" >
        <i class="fas fa-language"></i>
        Translate To Sinhala
    </button>

    <script>
        // Current chapter tracking
        let currentChapter = 4; // default start on Course Overview
        const totalChapters = 11;

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

            // Update progress (example: 25% for chapter 4, 50% for chapter 5, etc.)
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
                q1: ['input', 'processing', 'output', 'storage'],
                q2: 'ethernet',
                q3: 'delete',
                q4: ['toaster'],
                q5: 'true'
            };

            // Check answers
            let score = 0;
            let resultsHTML = '<div class="quiz-feedback">';

            // Question 1
            const q1Keywords = answers.q1.split(/[\s,]+/);
            const matchedKeywords = q1Keywords.filter(word =>
                correctAnswers.q1.some(correct => word.includes(correct)))
                .length;

            if (matchedKeywords >= 3) {
                score++;
                resultsHTML += `<p class="correct-answer">1. Correct! The four main functions are: Input, Processing, Output, and Storage.</p>`;
            } else {
                resultsHTML += `<p class="wrong-answer">1. Almost! The four main functions are: Input, Processing, Output, and Storage.</p>`;
            }

            // Question 2
            if (answers.q2 === correctAnswers.q2) {
                score++;
                resultsHTML += `<p class="correct-answer">2. Correct! Ethernet port is used for wired internet connection.</p>`;
            } else {
                resultsHTML += `<p class="wrong-answer">2. Incorrect. The correct answer is Ethernet port.</p>`;
            }

            // Question 3
            if (answers.q3 === correctAnswers.q3) {
                score++;
                resultsHTML += `<p class="correct-answer">3. Correct! You should never reply to or click links in suspicious emails.</p>`;
            } else {
                resultsHTML += `<p class="wrong-answer">3. Incorrect. You should delete suspicious emails immediately.</p>`;
            }

            // Question 4
            if (answers.q4.length === 1 && answers.q4[0] === 'toaster') {
                score++;
                resultsHTML += `<p class="correct-answer">4. Correct! A toaster is not a type of computer.</p>`;
            } else {
                resultsHTML += `<p class="wrong-answer">4. Incorrect. The correct answer is Toaster.</p>`;
            }

            // Question 5
            if (answers.q5 === correctAnswers.q5) {
                score++;
                resultsHTML += `<p class="correct-answer">5. Correct! Keeping antivirus updated is crucial for security.</p>`;
            } else {
                resultsHTML += `<p class="wrong-answer">5. Incorrect. You should always keep your antivirus updated.</p>`;
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

    // Get course name (you'll need to set this somewhere in your view)
    const courseName = 'Digital Literacy Training'; // Update this with dynamic value if needed

    // First mark course as completed
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
            // Now generate/download the certificate
            alert('Congratulations! Your certificate is being generated...');
            window.location.href = '/Digital-Literacy-certificate';
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

        // Check if already translated (button says "Translate To English")
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
                    translatedText: item.text // Fallback to original if translation fails
                };
            });
        });

        // Execute all translations
        const results = await Promise.all(translationPromises);

        // Apply translations
        results.forEach(result => {
            if (result.element.tagName === 'LI') {
                // Preserve bullet points in lists
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
