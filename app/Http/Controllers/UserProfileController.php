<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Illuminate\Support\Facades\Session;
use Kreait\Firebase\Exception\DatabaseException;
use Exception;

class UserProfileController extends Controller
{
private $database;
    private $auth;

    public function __construct()
    {
        $factory = (new Factory)
            ->withServiceAccount(base_path('app/firebase/reach-a3367-firebase-adminsdk-fbsvc-d5dcc96e70.json'))
            ->withDatabaseUri('https://reach-a3367-default-rtdb.firebaseio.com/');

        $this->database = $factory->createDatabase();
        $this->auth = $factory->createAuth();
    }

    /**
     * Update the user's username and/or password.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'username' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $firebaseUser = Session::get('firebase_user');

        if (!$firebaseUser || !isset($firebaseUser['localId'])) {
            return response()->json([
                'success' => false,
                'message' => 'User not logged in or session expired.',
            ], 401);
        }

        $uid = $firebaseUser['localId'];

        try {
            // Get the Firebase user
            $user = $this->auth->getUser($uid);

            // Update username (displayName) if provided
            if ($request->filled('username')) {
                $newUsername = trim($request->input('username'));

                // Update Firebase Authentication profile
                $this->auth->updateUser($uid, [
                    'displayName' => $newUsername,
                ]);

                // Update Firebase Realtime Database
                $this->database->getReference("users/{$uid}")->update([
                    'name' => $newUsername,
                ]);

                // Update session data
                $firebaseUser['displayName'] = $newUsername;
                Session::put('firebase_user', $firebaseUser);
                Session::put('firebase_user_data', array_merge(
                    Session::get('firebase_user_data', []),
                    ['name' => $newUsername]
                ));
            }

            // Update password if provided
            if ($request->filled('password')) {
                $newPassword = $request->input('password');
                $this->auth->changeUserPassword($uid, $newPassword);
            }

            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully!',
            ]);

        } catch (AuthException $e) {
            \Log::error('Firebase Auth error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update profile: ' . $e->getMessage(),
            ], 500);
        } catch (DatabaseException $e) {
            \Log::error('Firebase Database error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update profile data: ' . $e->getMessage(),
            ], 500);
        } catch (\Throwable $e) {
            \Log::error('General error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Unexpected error. Please try again.',
            ], 500);
        }
    }

    public function showProfile(Request $request)
    {
        $firebaseUser = Session::get('firebase_user');

        if (!$firebaseUser || !isset($firebaseUser['localId'])) {
            Session::flash('error', 'No authenticated user found.');
            return redirect()->route('signIn.index');
        }

        $uid = $firebaseUser['localId'];

        try {
            $userRef = $this->database->getReference('users/' . $uid);
            $userData = $userRef->getValue();

            if (!$userData) {
                Session::flash('error', 'User data not found.');
                return redirect()->route('signIn.index');
            }

            Session::put('firebase_user_data', [
                'name' => $this->getUserDisplayName($userData),
                'full_data' => $userData
            ]);

            // ENROLLMENTS
            $enrollments = $this->database->getReference("users/{$uid}/EnrollCourse")->getValue();
            $completedRef = $this->database->getReference("users/{$uid}/CompletedCourses");
            $completedCourses = $completedRef->getValue();

            $transformedEnrollments = [];
            $courseRoutes = [];
            $completedCourseList = [];
            $inProgressCourseList = [];

            foreach ($enrollments ?? [] as $courseId => $course) {
                $status = $course['status'] ?? 'in_progress';
                $entry = [
                    'courseName' => $course['courseName'] ?? 'Untitled Course',
                    'enrollmentDate' => $course['courseEnrollmentDate'] ?? 'Unknown',
                    'progress' => $status === 'completed' ? 100 : ($course['progress'] ?? 30),
                    'slug' => $this->generateCourseSlug($course['courseName'] ?? ''),
                    'status' => $status,
                    'completionDate' => $course['completionDate'] ?? null
                ];
                $transformedEnrollments[$courseId] = $entry;
                $courseRoutes[$courseId] = $this->getCourseRoute($course['courseName'] ?? '', $courseId);

                if ($status === 'completed') {
                    $completedCourseList[$courseId] = $entry;
                } else {
                    $inProgressCourseList[$courseId] = $entry;
                }
            }

            // COURSE MATERIAL VIEW (optional)
            $courseId = $request->query('courseId');
            $courseViewData = null;
            if ($courseId) {
                $course = $this->database->getReference("courses/{$courseId}")->getValue();
                if ($course) {
                    $slug = $this->generateCourseSlug($course['courseName'] ?? '');
                    $viewName = view()->exists("courses.{$slug}") ? "courses.{$slug}" : "course-generic";
                    $isEnrolled = isset($transformedEnrollments[$courseId]);
                    $courseViewData = view($viewName, [
                        'course' => $course,
                        'courseId' => $courseId,
                        'isEnrolled' => $isEnrolled
                    ])->render();
                }
            }

            return view('userProfile', [
                'user' => $userData,
                'enrolledCourseCount' => count($transformedEnrollments),
                'enrolledCourses' => $inProgressCourseList,
                'completedCourses' => $completedCourseList,
                'completedCourseCount' => count($completedCourseList),
                'courseRoutes' => $courseRoutes,
                'learningTime' => $userData['learningTime'] ?? '0h 0m',
                'achievementsCount' => $userData['achievements'] ?? 0,
                'userName' => $this->getUserDisplayName($userData),
                'courseViewHtml' => $courseViewData
            ]);

        } catch (\Throwable $e) {
            \Log::error('Merged showProfile error: ' . $e->getMessage());
            Session::flash('error', 'Unable to load profile data.');
            return redirect()->route('signIn.index');
        }
    }

    private function getUserDisplayName(array $userData): string
    {
        $nameFields = ['name', 'username', 'displayName', 'email'];

        foreach ($nameFields as $field) {
            if (!empty($userData[$field])) {
                return $userData[$field];
            }
        }

        return 'User';
    }

    private function generateCourseSlug($courseName): string
    {
        return strtolower(preg_replace([
            '/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'
        ], ['', '-', ''], $courseName));
    }
private function getCourseRoute($courseName, $courseId): string
{
    $normalizedName = strtolower(trim($courseName));
    $mapping = [
        'digital literacy training' => 'course.digital-literacy',
        'digital finance education' => 'course.digital-finance',
        'fundamentals of english training' => 'course.english',
    ];
    return $mapping[$normalizedName] ?? 'course.show';
}

      public function destroy(Request $request)
    {
        // Clear all user-related session data when logging out
        Session::forget('firebase_user_data');
        Session::forget('certificate_user_name');

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }


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

public function show($courseId)
{
    try {
        // Get course details
        $courseRef = $this->database->getReference('courses/' . $courseId);
        $course = $courseRef->getValue();

        if (!$course) {
            abort(404, 'Course not found');
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
            '-OTgn2pZ-XCIIRaIk125' => 'course3-content', // Fundamentals of English Training
            '-OThXzecvpxT2o59n-sX' => 'course3-content', // Add the missing course ID
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



    public function fixCourseName(Request $request)
{
    $uid = 'KrzxG9fA6ef2GQSyrC3sXtgfGxi1';
    $courseId = '-OTgn2pZ-XCIIRaIk125';

    try {
        $enrollmentRef = $this->database->getReference("users/{$uid}/EnrollCourse/{$courseId}");
        $enrollmentData = $enrollmentRef->getValue();

        if ($enrollmentData && $enrollmentData['courseName'] === 'Fundamantals English Training') {
            $enrollmentRef->update([
                'courseName' => 'Fundamental English Training'
            ]);
            return response()->json(['success' => true, 'message' => 'Course name fixed']);
        } else {
            return response()->json(['success' => false, 'message' => 'Enrollment not found or already correct']);
        }
    } catch (\Throwable $e) {
        \Log::error('Fix course name error: ' . $e->getMessage());
        return response()->json(['success' => false, 'message' => 'Failed to fix course name'], 500);
    }
}


}
