<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TranslateController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\CertificateController;

// Welcome and Static Pages
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/SignIn', function () {
    return view('SignIn');
})->name('signIn');

Route::get('/SignUp', function () {
    return view('SignUp');
})->name('signUp');

Route::get('/Home', function () {
    return view('home');
})->name('home');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');


// Authentication Routes
Route::get('/sign-up', [RegisterController::class, 'index'])->name('signUp.index');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/sign-in', [LoginController::class, 'index'])->name('signIn.index');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [LoginController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [LoginController::class, 'sendPasswordResetLink'])->name('password.email');

// Course Routes
Route::get('/course/{courseId}', [UserProfileController::class, 'show'])->name('course.show');

Route::get('/Digital-Literacy-Training', function () {
    return view('course1-content');
})->name('course.digital-literacy');

Route::get('/Digital-Finance-Education', function () {
    return view('course2-content');
})->name('course.digital-finance');

Route::get('/Fundamentals-English-Training', function () {
    return view('course3-content');
})->name('course.english');

// Certificate Routes
Route::get('/certificate/{courseId}', [CertificateController::class, 'generate'])->name('certificate.generate');
Route::post('/generate-certificate', [CertificateController::class, 'generate'])->name('certificate.generate.post');

Route::get('/Digital-Literacy-certificate', function () {
    return view('course1_certificate');
})->name('certificate.digital-literacy');

Route::get('/Digital-Finance-Education-certificate', function () {
    return view('course2_certificate');
})->name('certificate.digital-finance');

Route::get('/Fundamantals-English-Training-certificate', function () {
    return view('course3_certificate');
})->name('certificate.english');

// Translation Routes
Route::get('/Digital-Literacy', [TranslateController::class, 'index'])->name('translate.digital-literacy');
Route::get('/Digital-Finance', [TranslateController::class, 'index1'])->name('translate.digital-finance');
Route::get('/English-Training', [TranslateController::class, 'index3'])->name('translate.english');
Route::post('/translate', [TranslateController::class, 'translate'])->name('translate');

// User Profile and Enrollment Routes
Route::get('/UserProfile', function () {
    return view('UserProfile');
})->name('userProfile');

Route::get('/profile', [UserProfileController::class, 'showProfile'])->name('profile.show');
Route::post('/enroll', [UserProfileController::class, 'store'])->name('enroll');
Route::get('/user/enrollments', [UserProfileController::class, 'getEnrollments'])->name('user.enrollments');
Route::post('/mark-course-completed', [UserProfileController::class, 'markCourseCompleted'])->name('mark-course-completed');

// Admin Routes
Route::get('/AdminProfile', function () {
    return view('AdminDashboard');
})->name('Admin.Dashboard');

// Test Route for Debugging Enrollments
Route::get('/test-enrollments', function () {
    $uid = 'KrzxG9fA6ef2GQSyrC3sXtgfGxi1';
    $factory = (new \Kreait\Firebase\Factory)
        ->withServiceAccount(base_path('app/firebase/reach-a3367-firebase-adminsdk-fbsvc-d5dcc96e70.json'))
        ->withDatabaseUri('https://reach-a3367-default-rtdb.firebaseio.com/');

    $database = $factory->createDatabase();
    $enrollments = $database->getReference("users/{$uid}/EnrollCourse")->getValue();

    dd($enrollments);
})->name('test.enrollments');




Route::get('/test-enrollments', function () {
    $uid = 'KrzxG9fA6ef2GQSyrC3sXtgfGxi1';
    $factory = (new \Kreait\Firebase\Factory)
        ->withServiceAccount(base_path('app/firebase/reach-a3367-firebase-adminsdk-fbsvc-d5dcc96e70.json'))
        ->withDatabaseUri('https://reach-a3367-default-rtdb.firebaseio.com/');

    $database = $factory->createDatabase();
    $enrollments = $database->getReference("users/{$uid}/EnrollCourse")->getValue();

    dd($enrollments); // Line 133
})->name('test.enrollments');


Route::get('/course/{courseId}', [UserProfileController::class, 'show'])->name('course.show');


Route::get('/test-firebase', function () {
    $uid = 'KrzxG9fA6ef2GQSyrC3sXtgfGxi1';
    $factory = (new \Kreait\Firebase\Factory)
        ->withServiceAccount(base_path('app/firebase/reach-a3367-firebase-adminsdk-fbsvc-d5dcc96e70.json'))
        ->withDatabaseUri('https://reach-a3367-default-rtdb.firebaseio.com/');

    $database = $factory->createDatabase();
    $userData = $database->getReference("users/{$uid}")->getValue();
    $courses = $database->getReference("courses")->getValue();

    dd([
        'userData' => $userData,
        'courses' => $courses,
        'enrollments' => $database->getReference("users/{$uid}/EnrollCourse")->getValue()
    ]);
})->name('test.firebase');

