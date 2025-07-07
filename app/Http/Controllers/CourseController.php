<!-- <?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Exception\DatabaseException;
use Illuminate\Support\Facades\Session;

class CourseController extends Controller
{
    private $database;

    public function __construct()
    {
        $factory = (new Factory)
            ->withServiceAccount(base_path('app/firebase/reach-a3367-firebase-adminsdk-fbsvc-d5dcc96e70.json'))
            ->withDatabaseUri('https://reach-a3367-default-rtdb.firebaseio.com/');

        $this->database = $factory->createDatabase();
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

    //completed courses

} -->
