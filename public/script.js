document.addEventListener('DOMContentLoaded', function() {
    // DOM Elements
    const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');
    const menuBar = document.querySelector('#content nav .bx.bx-menu');
    const sidebar = document.getElementById('sidebar');
    const searchButton = document.querySelector('#content nav form .form-input button');
    const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
    const searchForm = document.querySelector('#content nav form');
    const switchMode = document.getElementById('switch-mode');
    const logoutBtn = document.querySelector('.logout');
    const sectionContents = document.querySelectorAll('.section-content');
    const enrolledCoursesContainer = document.querySelector('.enrolled-courses-container');
    const completedCoursesContainer = document.querySelector('.completed-courses-container');
    const profileLink = document.querySelector('#content nav .profile');

    // Initialize with Profile section active
    document.querySelector('#profile-section').classList.add('active-section');
    document.querySelector('#sidebar .side-menu.top li:first-child').classList.add('active');

    // Sample course data
    const courses = [
        {
            id: 1,
            title: "Digital Literacy Training",
            description: "Master essential digital skills from basic computer operations to online safety and productivity tools.",
            category: "Technology",
            duration: "6 Weeks",
            lessons: "24 Lessons",
            level: "Beginner",
            image: "assets/course1.png"
        },
        {
            id: 2,
            title: "Financial Education",
            description: "Learn personal budgeting, saving strategies, and basic investment principles for financial stability.",
            category: "Finance",
            duration: "4 Weeks",
            lessons: "18 Lessons",
            level: "Beginner",
            image: "assets/course2.png"
        },
        {
            id: 3,
            title: "Local Language Learning",
            description: "Develop practical communication skills in your local language for daily life and professional settings.",
            category: "Language",
            duration: "8 Weeks",
            lessons: "30 Lessons",
            level: "All Levels",
            image: "assets/course3.png"
        }
    ];

    // Initialize user data
    const user = {
        id: 1,
        fullName: "Alex Johnson",
        email: "alex.johnson@example.com",
        phone: "+1 (555) 123-4567",
        joinDate: "January 15, 2023",
        avatar: "assets/user-avatar.jpg",
        enrolledCourses: [],
        completedCourses: []
    };

    // Load user data from localStorage if available
    function loadUserData() {
        try {
            const savedUser = localStorage.getItem('ruralSkillsUser');
            if (savedUser) {
                Object.assign(user, JSON.parse(savedUser));
            }
        } catch (error) {
            console.error('Failed to load user data:', error);
            Swal.fire('Error', 'Failed to load user data. Please try again.', 'error');
        }
        
        // Populate profile data
        document.getElementById('user-fullname').textContent = user.fullName;
        document.getElementById('user-email').textContent = user.email;
        document.getElementById('join-date').textContent = user.joinDate;
        document.getElementById('profile-name').textContent = user.fullName;
        document.getElementById('profile-email').textContent = user.email;
        document.getElementById('profile-phone').textContent = user.phone;
        
        // Update stats
        document.querySelectorAll('.stat-value')[0].textContent = user.enrolledCourses.length;
        document.querySelectorAll('.stat-value')[1].textContent = user.completedCourses.length;
        document.querySelectorAll('.stat-value')[2].textContent = "12h 45m";
        document.querySelectorAll('.stat-value')[3].textContent = user.completedCourses.length;
        
        // Update enrolled and completed courses
        updateEnrolledCourses();
        updateCompletedCourses();
    }

    // Update enrolled courses display
    function updateEnrolledCourses() {
        enrolledCoursesContainer.innerHTML = '<div class="loading"></div>';
        setTimeout(() => {
            enrolledCoursesContainer.innerHTML = '';
            
            if (user.enrolledCourses.length === 0) {
                enrolledCoursesContainer.innerHTML = `
                    <div class="no-courses">
                        <img src="assets/no-courses.png" alt="No courses enrolled">
                        <h3>You haven't enrolled in any courses yet</h3>
                        <p>Browse our available courses and start learning today!</p>
                        <a href="#courses-section" class="btn-enroll">Browse Courses</a>
                    </div>
                `;
                return;
            }
            
            user.enrolledCourses.forEach(courseId => {
                const course = courses.find(c => c.id === courseId);
                if (course) {
                    const progress = Math.floor(Math.random() * 100); // Random progress for demo
                    
                    const courseCard = document.createElement('div');
                    courseCard.className = 'enrolled-course-card';
                    courseCard.innerHTML = `
                        <h3>${course.title}</h3>
                        <div class="progress-container">
                            <div class="progress-bar">
                                <div class="progress" style="width: ${progress}%"></div>
                            </div>
                            <div class="progress-text">${progress}% complete</div>
                        </div>
                        <div class="course-meta">
                            <span><i class='bx bxs-time'></i> ${course.duration}</span>
                            <span><i class='bx bxs-videos'></i> ${course.lessons}</span>
                        </div>
                        <div class="course-actions">
                            <button class="btn-continue" data-course-id="${course.id}">Continue</button>
                            <button class="btn-drop" data-course-id="${course.id}">Drop</button>
                        </div>
                    `;
                    enrolledCoursesContainer.appendChild(courseCard);
                }
            });
        }, 500);
    }

    // Update completed courses display
    function updateCompletedCourses() {
        completedCoursesContainer.innerHTML = '<div class="loading"></div>';
        setTimeout(() => {
            completedCoursesContainer.innerHTML = '';
            
            if (user.completedCourses.length === 0) {
                completedCoursesContainer.innerHTML = `
                    <div class="no-courses">
                        <img src="assets/no-completed.png" alt="No courses completed">
                        <h3>No completed courses yet</h3>
                        <p>Finish your enrolled courses to see them here</p>
                    </div>
                `;
                return;
            }
            
            user.completedCourses.forEach(courseId => {
                const course = courses.find(c => c.id === courseId);
                if (course) {
                    const completionDate = new Date();
                    completionDate.setDate(completionDate.getDate() - Math.floor(Math.random() * 30)); // Random date for demo
                    
                    const courseCard = document.createElement('div');
                    courseCard.className = 'completed-course-card';
                    courseCard.innerHTML = `
                        <h3>${course.title}</h3>
                        <p class="completion-date">Completed on ${completionDate.toLocaleDateString()}</p>
                        <p class="course-description">${course.description}</p>
                        <button class="certificate-btn" data-course-id="${course.id}">
                            <i class='bx bxs-certificate'></i> Download Certificate
                        </button>
                    `;
                    completedCoursesContainer.appendChild(courseCard);
                }
            });
        }, 500);
    }

    // SIDEBAR TOGGLE
    menuBar.addEventListener('click', function() {
        sidebar.classList.toggle('hide');
    });

    // MENU ITEM CLICK HANDLER
    allSideMenu.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all menu items and sections
            allSideMenu.forEach(i => {
                i.parentElement.classList.remove('active');
            });
            sectionContents.forEach(section => {
                section.classList.remove('active-section');
            });

            // Add active class to clicked menu item
            this.parentElement.classList.add('active');

            // Show corresponding section
            const targetSection = this.getAttribute('href');
            document.querySelector(targetSection).classList.add('active-section');
        });
    });

    // PROFILE LINK HANDLER
    profileLink.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Remove active class from all menu items and sections
        allSideMenu.forEach(i => {
            i.parentElement.classList.remove('active');
        });
        sectionContents.forEach(section => {
            section.classList.remove('active-section');
        });

        // Add active class to courses menu item
        document.querySelector('a[href="#courses-section"]').parentElement.classList.add('active');

        // Show courses section
        document.querySelector('#courses-section').classList.add('active-section');
    });

    // SEARCH FORM TOGGLE (MOBILE)
    searchButton.addEventListener('click', function(e) {
        if (window.innerWidth < 576) {
            e.preventDefault();
            searchForm.classList.toggle('show');
            if (searchForm.classList.contains('show')) {
                searchButtonIcon.classList.replace('bx-search', 'bx-x');
            } else {
                searchButtonIcon.classList.replace('bx-x', 'bx-search');
            }
        }
    });

    // DARK/LIGHT MODE TOGGLE
    if (localStorage.getItem('darkMode') === 'enabled') {
        document.body.classList.add('dark');
        switchMode.checked = true;
    }

    switchMode.addEventListener('change', function() {
        if (this.checked) {
            document.body.classList.add('dark');
            localStorage.setItem('darkMode', 'enabled');
        } else {
            document.body.classList.remove('dark');
            localStorage.setItem('darkMode', 'disabled');
        }
    });

    // LOGOUT FUNCTIONALITY
    logoutBtn.addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Log Out?',
            text: "Are you sure you want to log out?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#2563EB',
            cancelButtonColor: '#F43F5E',
            confirmButtonText: 'Yes, log out'
        }).then((result) => {
            if (result.isConfirmed) {
                localStorage.removeItem('ruralSkillsUser');
                window.location.href = 'login.html';
            }
        });
    });

    // COURSE ENROLLMENT
    document.addEventListener('click', function(e) {
        // Enroll button
        if (e.target.classList.contains('btn-enroll')) {
            const courseCard = e.target.closest('.course-card');
            const courseId = parseInt(courseCard.dataset.courseId);
            const course = courses.find(c => c.id === courseId);
            
            Swal.fire({
                title: `Enroll in ${course.title}?`,
                text: "Confirm to enroll in this course",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#2563EB',
                cancelButtonColor: '#F43F5E',
                confirmButtonText: 'Yes, enroll'
            }).then((result) => {
                if (result.isConfirmed) {
                    if (!user.enrolledCourses.includes(courseId)) {
                        user.enrolledCourses.push(courseId);
                        localStorage.setItem('ruralSkillsUser', JSON.stringify(user));
                        
                        Swal.fire(
                            'Enrolled!',
                            `You've successfully enrolled in ${course.title}`,
                            'success'
                        );
                        
                        // Update displays
                        loadUserData();
                    } else {
                        Swal.fire(
                            'Already Enrolled',
                            `You're already enrolled in ${course.title}`,
                            'info'
                        );
                    }
                }
            });
        }
        
        // View details button
        if (e.target.classList.contains('btn-outline')) {
            const courseCard = e.target.closest('.course-card');
            const courseId = parseInt(courseCard.dataset.courseId);
            const course = courses.find(c => c.id === courseId);
            
            Swal.fire({
                title: course.title,
                html: `
                    <div style="text-align: left;">
                        <p style="margin-bottom: 15px;">${course.description}</p>
                        <div style="display: flex; gap: 10px; margin-bottom: 15px; flex-wrap: wrap;">
                            <span><i class='bx bxs-time'></i> ${course.duration}</span>
                            <span><i class='bx bxs-videos'></i> ${course.lessons}</span>
                            <span><i class='bx bxs-star'></i> ${course.level}</span>
                        </div>
                        <img src="${course.image}" 
                             style="width: 100%; border-radius: 8px; margin-bottom: 15px;">
                    </div>
                `,
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: 'Enroll Now',
                cancelButtonText: 'Close',
                confirmButtonColor: '#2563EB'
            });
        }
        
        // Continue button (enrolled courses)
        if (e.target.classList.contains('btn-continue')) {
            const courseId = parseInt(e.target.dataset.courseId);
            const course = courses.find(c => c.id === courseId);
            Swal.fire(
                'Continue Learning',
                `Redirecting to ${course.title}...`,
                'info'
            );
        }
        
        // Drop button (enrolled courses)
        if (e.target.classList.contains('btn-drop')) {
            const courseId = parseInt(e.target.dataset.courseId);
            const course = courses.find(c => c.id === courseId);
            
            Swal.fire({
                title: `Drop ${course.title}?`,
                text: "You can re-enroll later if you change your mind",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#F43F5E',
                cancelButtonColor: '#2563EB',
                confirmButtonText: 'Yes, drop course'
            }).then((result) => {
                if (result.isConfirmed) {
                    user.enrolledCourses = user.enrolledCourses.filter(id => id !== courseId);
                    localStorage.setItem('ruralSkillsUser', JSON.stringify(user));
                    
                    Swal.fire(
                        'Course Dropped',
                        `You've dropped ${course.title}`,
                        'success'
                    );
                    
                    // Update displays
                    loadUserData();
                }
            });
        }
        
        // Certificate button (completed courses)
        if (e.target.classList.contains('certificate-btn')) {
            const courseId = parseInt(e.target.dataset.courseId);
            const course = courses.find(c => c.id === courseId);
            Swal.fire(
                'Certificate Generated',
                `Your certificate for ${course.title} is ready to download!`,
                'success'
            );
        }
    });

    // Initialize user data
    loadUserData();

    // RESPONSIVE ADJUSTMENTS
    if (window.innerWidth < 768) {
        sidebar.classList.add('hide');
    } else if (window.innerWidth > 576) {
        searchButtonIcon.classList.replace('bx-x', 'bx-search');
        searchForm.classList.remove('show');
    }

    window.addEventListener('resize', function() {
        if (this.innerWidth > 576) {
            searchButtonIcon.classList.replace('bx-x', 'bx-search');
            searchForm.classList.remove('show');
        }
    });
});