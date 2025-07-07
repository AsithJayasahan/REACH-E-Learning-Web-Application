<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Illuminate\Support\Facades\Session;
use Kreait\Firebase\Exception\DatabaseException;

class EnrollController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'courseName' => 'required|string|max:255',
        ]);

        $firebaseUser = Session::get('firebase_user');

        if (!$firebaseUser || !isset($firebaseUser['localId'])) {
            return response()->json([
                'success' => false,
                'message' => 'User not logged in or session expired.',
            ], 401);
        }

        $uid = $firebaseUser['localId'];
        $courseName = trim($request->input('courseName'));

        try {
            $factory = (new Factory)
                ->withServiceAccount(base_path('app/firebase/reach-a3367-firebase-adminsdk-fbsvc-d5dcc96e70.json'))
                ->withDatabaseUri('https://reach-a3367-default-rtdb.firebaseio.com/');

            $database = $factory->createDatabase();

            // Check for existing enrollment
            $enrollments = $database->getReference("users/{$uid}/EnrollCourse")->getValue();

            $alreadyEnrolled = false;
            $enrollmentKey = null;
            if ($enrollments) {
                foreach ($enrollments as $key => $entry) {
                    if (isset($entry['courseName']) && trim($entry['courseName']) === $courseName) {
                        $alreadyEnrolled = true;
                        $enrollmentKey = $key;
                        break;
                    }
                }
            }

            if ($alreadyEnrolled) {
                return response()->json([
                    'success' => false,
                    'message' => 'You are already enrolled in this course: ' . $courseName,
                ], 409);
            }

            // Enroll new course with initial status
            $ref = $database->getReference("users/{$uid}/EnrollCourse")->push([
                'courseName' => $courseName,
                'courseEnrollmentDate' => now()->toDateTimeString(),
                'status' => 'in_progress',
                'completionDate' => null
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Course enrolled successfully!',
                'data' => [
                    'courseName' => $courseName,
                    'key' => $ref->getKey()
                ],
            ]);
        } catch (DatabaseException $e) {
            \Log::error('Firebase Database error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Enrollment failed. Please try again later.',
            ], 500);
        } catch (\Throwable $e) {
            \Log::error('General error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Unexpected error. Please try again.',
            ], 500);
        }
    }

    public function markCourseCompleted(Request $request)
    {
        $request->validate([
            'courseName' => 'required|string|max:255',
        ]);

        $firebaseUser = Session::get('firebase_user');

        if (!$firebaseUser || !isset($firebaseUser['localId'])) {
            return response()->json([
                'success' => false,
                'message' => 'User not logged in or session expired.',
            ], 401);
        }

        $uid = $firebaseUser['localId'];
        $courseName = trim($request->input('courseName'));

        try {
            $factory = (new Factory)
                ->withServiceAccount(base_path('app/firebase/reach-a3367-firebase-adminsdk-fbsvc-d5dcc96e70.json'))
                ->withDatabaseUri('https://reach-a3367-default-rtdb.firebaseio.com/');

            $database = $factory->createDatabase();

            // Find the enrollment to update
            $enrollments = $database->getReference("users/{$uid}/EnrollCourse")->getValue();

            $updated = false;
            if ($enrollments) {
                foreach ($enrollments as $key => $entry) {
                    if (isset($entry['courseName']) && trim($entry['courseName']) === $courseName) {
                        // Update the enrollment status
                        $database->getReference("users/{$uid}/EnrollCourse/{$key}")
                            ->update([
                                'status' => 'completed',
                                'completionDate' => now()->toDateTimeString()
                            ]);
                        $updated = true;
                        break;
                    }
                }
            }

            if (!$updated) {
                return response()->json([
                    'success' => false,
                    'message' => 'Course enrollment not found.',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Course marked as completed!',
            ]);
        } catch (DatabaseException $e) {
            \Log::error('Firebase Database error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Update failed. Please try again later.',
            ], 500);
        } catch (\Throwable $e) {
            \Log::error('General error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Unexpected error. Please try again.',
            ], 500);
        }
    }

public function getEnrollments()
{
    $firebaseUser = Session::get('firebase_user');

    if (!$firebaseUser || !isset($firebaseUser['localId'])) {
        return redirect()->route('login')->withErrors(['message' => 'User not logged in or session expired.']);
    }

    $uid = $firebaseUser['localId'];

    try {
        $factory = (new Factory)
            ->withServiceAccount(base_path('app/firebase/reach-a3367-firebase-adminsdk-fbsvc-d5dcc96e70.json'))
            ->withDatabaseUri('https://reach-a3367-default-rtdb.firebaseio.com/');

        $database = $factory->createDatabase();
        $enrollments = $database->getReference("users/{$uid}/EnrollCourse")->getValue();

        // Initialize arrays and counters
        $allCourses = [];
        $completedCourses = [];
        $inProgressCourses = [];
        $completedCourseCount = 0;
        $inProgressCourseCount = 0;

        if (!empty($enrollments)) {
            foreach ($enrollments as $key => $course) {
                if (!is_array($course) || !isset($course['courseName'])) {
                    continue;
                }

                $status = $course['status'] ?? 'in_progress';
                $courseData = [
                    'key' => $key,
                    'courseName' => $course['courseName'],
                    'enrollmentDate' => $course['courseEnrollmentDate'] ?? 'Unknown',
                    'status' => $status,
                    'completionDate' => $course['completionDate'] ?? null,
                    'progress' => $status === 'completed' ? 100 : 30 // Example progress values
                ];

                $allCourses[$key] = $courseData;

                if ($status === 'completed') {
                    $completedCourses[$key] = $courseData;
                    $completedCourseCount++;
                } else {
                    $inProgressCourses[$key] = $courseData;
                    $inProgressCourseCount++;
                }
            }
        }

        $enrolledCourseCount = count($allCourses);

        // Debug output - check what's being collected
        \Log::debug('Enrollments Data', [
            'all_courses' => $allCourses,
            'completed_courses' => $completedCourses,
            'in_progress_courses' => $inProgressCourses,
            'counts' => [
                'total' => $enrolledCourseCount,
                'completed' => $completedCourseCount,
                'in_progress' => $inProgressCourseCount
            ]
        ]);

        return view('user.dashboard', [
            'user' => $firebaseUser,
            'enrolledCourses' => $inProgressCourses,
            'completedCourses' => $completedCourses,
            'enrolledCourseCount' => $enrolledCourseCount,
            'completedCourseCount' => $completedCourseCount,
            'inProgressCourseCount' => $inProgressCourseCount,
            'courseRoutes' => [
                'Digital Literacy Training' => 'course.digital-literacy',
                'Digital Finance Education' => 'course.finance',
                'Fundamental of English Training' => 'course.english'
            ]
        ]);

    } catch (DatabaseException $e) {
        \Log::error('Firebase Database error: ' . $e->getMessage());
        return redirect()->back()->withErrors(['message' => 'Failed to load courses due to database error.']);
    } catch (\Throwable $e) {
        \Log::error('Error fetching enrolled courses: ' . $e->getMessage());
        return redirect()->back()->withErrors(['message' => 'Failed to load courses. Please try again.']);
    }
}



    public function show($courseId)
    {
        try {
            // Get course details
            $courseRef = $this->database->getReference('courses/' . $courseId);
            $course = $courseRef->getValue();

            if (!$course) {
                abort(404);
            }

            // Check if user is enrolled
            $isEnrolled = false;
            $firebaseUser = Session::get('firebase_user');
            if ($firebaseUser && isset($firebaseUser['localId'])) {
                $enrollmentRef = $this->database->getReference("users/{$firebaseUser['localId']}/EnrollCourse/{$courseId}");
                $isEnrolled = (bool)$enrollmentRef->getValue();
            }

            // Map to course views
            $viewMap = [
                '017rG14DUGdT-YGGdAR' => 'course1-content', // Digital Literacy
                '017s9fbHcK924e5v5dj' => 'course2-content', // Digital Finance
                '-OTB9rcTixUuyuM6TcbK' => 'course3-content', // English
            ];

            $view = $viewMap[$courseId] ?? 'course-generic';

            return view($view, [
                'course' => $course,
                'courseId' => $courseId,
                'isEnrolled' => $isEnrolled
            ]);

        } catch (DatabaseException $e) {
            \Log::error('Firebase error: ' . $e->getMessage());
            abort(500, 'Error loading course content');
        }
    }

    public function completeCourse($courseId)
    {
        $firebaseUser = Session::get('firebase_user');

        if (!$firebaseUser || !isset($firebaseUser['localId'])) {
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated'
            ], 401);
        }

        $uid = $firebaseUser['localId'];

        try {
            // 1. Get the enrolled course
            $enrolledRef = $this->database->getReference("users/{$uid}/EnrollCourse/{$courseId}");
            $course = $enrolledRef->getValue();

            if (!$course) {
                return response()->json([
                    'success' => false,
                    'message' => 'Course not found in your enrollments'
                ], 404);
            }

            // 2. Add to completed courses
            $completedRef = $this->database->getReference("users/{$uid}/CompletedCourses/{$courseId}");
            $completedRef->set([
                'courseName' => $course['courseName'],
                'completionDate' => now()->toDateTimeString(),
                'score' => 100, // Default score
                'enrollmentDate' => $course['courseEnrollmentDate'] ?? now()->toDateTimeString()
            ]);

            // 3. Remove from enrolled courses
            $enrolledRef->remove();

            // 4. Update user achievements
            $userRef = $this->database->getReference("users/{$uid}");
            $userRef->update([
                'achievements' => $this->database->getReference("users/{$uid}/achievements")->getValue() + 1
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Course completed successfully!',
                'redirect' => route('profile.show')
            ]);

        } catch (DatabaseException $e) {
            \Log::error('Complete course error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to complete course'
            ], 500);
        }
    }

    public function getCourseProgress($courseId)
    {
        $firebaseUser = Session::get('firebase_user');

        if (!$firebaseUser || !isset($firebaseUser['localId'])) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        try {
            $progressRef = $this->database->getReference(
                "users/{$firebaseUser['localId']}/EnrollCourse/{$courseId}/progress"
            );

            return response()->json([
                'progress' => $progressRef->getValue() ?? 0
            ]);

        } catch (DatabaseException $e) {
            \Log::error('Progress check error: ' . $e->getMessage());
            return response()->json(['error' => 'Database error'], 500);
        }
    }


}
