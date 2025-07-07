<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
   <!-- Favicon -->
    <link href="img/3541249.png" rel="icon">
</head>
<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <i class='bx bxs-graduation'></i>
            <span class="text">RuralSkills Admin</span>
        </a>
        <ul class="side-menu top">
            <li class="active">
                <a href="#profile-section" data-tooltip="Profile">
                    <i class='bx bxs-user-detail'></i>
                    <span class="text">Profile Details</span>
                </a>
            </li>
            <li>
                <a href="#dashboard-section" data-tooltip="Dashboard">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#users-section" data-tooltip="Manage Users">
                    <i class='bx bxs-user'></i>
                    <span class="text">Manage Users</span>
                </a>
            </li>
            <li>
                <a href="#courses-section" data-tooltip="Manage Courses">
                    <i class='bx bxs-book'></i>
                    <span class="text">Manage Courses</span>
                </a>
            </li>
            <li>
                <a href="#reports-section" data-tooltip="Reports">
                    <i class='bx bxs-report'></i>
                    <span class="text">Reports</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="#" class="logout" data-tooltip="Logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden aria-label="Toggle dark mode">
            <label for="switch-mode" class="switch-mode"></label>
            <a href="#profile-section" class="profile">
                <img src="assets/user-avatar.jpg" alt="Admin Avatar">
            </a>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <!-- Profile Section -->
            <div id="profile-section" class="section-content active-section">
                <div class="head-title">
                    <div class="left">
                        <h1>Admin Profile</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">Admin</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="#">Profile</a></li>
                        </ul>
                    </div>
                    <a href="#" class="btn-download edit-profile-btn">
                        <i class='bx bxs-edit'></i>
                        <span class="text">Edit Profile</span>
                    </a>
                </div>
                <div class="profile-container">
                    <div class="profile-header">
                        <div class="profile-avatar">
                            <img src="assets/user-avatar.jpg" alt="Admin Profile">
                        </div>
                        <div class="profile-info">
                            <h2 data-field="name">Jane Doe</h2>
                            <p data-field="email">Email: <span>jane.doe@ruralskills.com</span></p>
                            <p data-field="role">Role: System Administrator</p>
                            <p class="member-since" data-field="last-login">Last Login: June 18, 2025, 11:01 PM</p>
                        </div>
                    </div>
                    <div class="profile-details">
                        <div class="detail-card">
                            <h3><i class='bx bxs-info-circle'></i> Personal Information</h3>
                            <div class="detail-row">
                                <span class="detail-label">Full Name</span>
                                <span class="detail-value" data-field="name">Jane Doe</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Phone</span>
                                <span class="detail-value" data-field="phone">+91 98765 43210</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Address</span>
                                <span class="detail-value" data-field="address">123 Rural Lane, Village City</span>
                            </div>
                        </div>
                        <div class="detail-card">
                            <h3><i class='bx bxs-lock'></i> Account Details</h3>
                            <div class="detail-row">
                                <span class="detail-label">Username</span>
                                <span class="detail-value" data-field="username">admin_jane</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Account Created</span>
                                <span class="detail-value" data-field="created">January 10, 2024</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Permissions</span>
                                <span class="detail-value" data-field="permissions">Full Admin Access</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dashboard Section -->
            <div id="dashboard-section" class="section-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Admin Dashboard</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">Admin</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="#">Dashboard</a></li>
                        </ul>
                    </div>
                    <a href="#" class="btn-download">
                        <i class='bx bxs-download'></i>
                        <span class="text">Export Summary</span>
                    </a>
                </div>
                <div class="stats-grid">
                    <div class="stat-item">
                        <i class='bx bxs-user'></i>
                        <div>
                            <span class="stat-value">120</span>
                            <span class="stat-label">Active Users</span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <i class='bx bxs-book'></i>
                        <div>
                            <span class="stat-value">15</span>
                            <span class="stat-label">Courses</span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <i class='bx bxs-certificate'></i>
                        <div>
                            <span class="stat-value">45</span>
                            <span class="stat-label">Completions</span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <i class='bx bxs-time'></i>
                        <div>
                            <span class="stat-value">1,200h</span>
                            <span class="stat-label">Learning Hours</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Manage Users Section -->
            <div id="users-section" class="section-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Manage Users</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">Admin</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="#">Manage Users</a></li>
                        </ul>
                    </div>
                    <a href="#" class="btn-download">
                        <i class='bx bxs-user-plus'></i>
                        <span class="text">Add User</span>
                    </a>
                </div>
                <div class="users-container" aria-live="polite">
                    <!-- Populated by JavaScript -->
                </div>
            </div>

            <!-- Manage Courses Section -->
            <div id="courses-section" class="section-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Manage Courses</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">Admin</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="#">Manage Courses</a></li>
                        </ul>
                    </div>
                    <a href="#" class="btn-download">
                        <i class='bx bxs-book-add'></i>
                        <span class="text">Add Course</span>
                    </a>
                </div>
                <div class="courses-container" aria-live="polite">
                    <!-- Populated by JavaScript -->
                </div>
            </div>

            <!-- Reports Section -->
            <div id="reports-section" class="section-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Reports</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">Admin</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="#">Reports</a></li>
                        </ul>
                    </div>
                    <a href="#" class="btn-download">
                        <i class='bx bxs-download'></i>
                        <span class="text">Generate Report</span>
                    </a>
                </div>
                <div class="reports-container">
                    <div class="report-card">
                        <h3>User Activity Report</h3>
                        <p>Summary of user logins and course interactions.</p>
                        <button class="btn-generate">Generate</button>
                    </div>
                    <div class="report-card">
                        <h3>Course Completion Report</h3>
                        <p>Details on course completions by users.</p>
                        <button class="btn-generate">Generate</button>
                    </div>
                    <div class="report-card">
                        <h3>Learning Hours Report</h3>
                        <p>Total learning hours across all users.</p>
                        <button class="btn-generate">Generate</button>
                    </div>
                </div>
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom JS -->
    <script src="script.js"></script>
</body>
</html>
