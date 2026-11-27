<?php

use App\Http\Controllers\AuthController;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

// ======================================================
// GUEST ROUTES
// ======================================================

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

    Route::post('/register', [AuthController::class, 'register']);
});

// ======================================================
// AUTHENTICATED ROUTES
// ======================================================

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ======================================================
    // STUDENT CREATE FORM
    // ======================================================

    Route::get('/student/create', function () {
        return view('student.create');
    })->name('students.create');

    // ======================================================
    // STUDENT LIST
    // ======================================================

    Route::get('/students', function () {

        $students = Student::all();

        return view('student.list', [
            'students' => $students,
        ]);

    })->name('students.index');

    // ======================================================
    // STUDENT EDIT FORM
    // IMPORTANT: Keep this BEFORE /students/{id}
    // ======================================================

    Route::get('/students/{id}/edit', function ($id) {

        $student = Student::findOrFail($id);

        return view('student.edit', [
            'student' => $student,
        ]);

    })->name('students.edit');

    // ======================================================
    // STUDENT DETAILS
    // ======================================================

    Route::get('/students/{id}', function ($id) {

        $student = Student::findOrFail($id);

        return view('student.detail', [
            'student' => $student,
        ]);

    })->name('students.show');

    // ======================================================
    // STORE NEW STUDENT
    // ======================================================

    Route::post('/student', function (Request $request) {

        $validated = $request->validate([

            'name' => 'required|string|max:255',

            'email' => 'required|email|max:255|unique:students,email',

            'phone' => 'required|string|max:20',

            'address' => 'nullable|string|max:500',

            'date_of_birth' => 'nullable|date',

        ]);

        Student::create($validated);

        return redirect()
            ->route('students.index')
            ->with('success', 'Student created successfully!');

    })->name('students.store');

    // ======================================================
    // UPDATE STUDENT
    // ======================================================

    Route::put('/students/{id}', function (Request $request, $id) {

        $student = Student::findOrFail($id);

        $validated = $request->validate([

            'name' => 'required|string|max:255',

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('students', 'email')->ignore($student->id),
            ],

            'phone' => 'required|string|max:20',

            'address' => 'nullable|string|max:500',

            'date_of_birth' => 'nullable|date',

        ]);

        $student->update($validated);

        return redirect()
            ->route('students.show', $student->id)
            ->with('success', 'Student updated successfully!');

    })->name('students.update');

    // ======================================================
    // DELETE STUDENT
    // ======================================================

    Route::delete('/students/{id}', function ($id) {

        $student = Student::findOrFail($id);

        $student->delete();

        return redirect()
            ->route('students.index')
            ->with('success', 'Student deleted successfully!');

    })->name('students.destroy');

    // ======================================================
    // COURSE CREATE FORM
    // ======================================================

    Route::get('/courses/create', function () {
        return view('course.create');
    })->name('courses.create');

    // ======================================================
    // COURSE LIST
    // ======================================================

    Route::get('/courses', function (Request $request) {

        $courses = $request->user()->role === 'admin'
            ? Course::latest()->get()
            : $request->user()->courses()->latest()->get();

        return view('course.list', [
            'courses' => $courses,
        ]);

    })->name('courses.index');

    // ======================================================
    // COURSE EDIT FORM
    // IMPORTANT: Keep this BEFORE /courses/{id}
    // ======================================================

    Route::get('/courses/{id}/edit', function ($id) {

        $course = Course::findOrFail($id);

        Gate::authorize('manage-course', $course);

        return view('course.edit', [
            'course' => $course,
        ]);

    })->name('courses.edit');

    // ======================================================
    // COURSE DETAILS
    // ======================================================

    Route::get('/courses/{id}', function ($id) {

        $course = Course::findOrFail($id);

        Gate::authorize('manage-course', $course);

        return view('course.detail', [
            'course' => $course,
        ]);

    })->name('courses.show');

    // ======================================================
    // STORE NEW COURSE
    // ======================================================

    Route::post('/courses', function (Request $request) {

        $validated = $request->validate([

            'name' => 'required|string|max:255',

            'description' => 'nullable|string|max:1000',

            'duration' => 'required|integer|min:1',

            'fee' => 'required|numeric|min:0',

            'difficulty' => 'required|in:Easy,Medium,Hard',

        ]);

        $validated['is_active'] = $request->has('is_active');

        $request->user()->courses()->create($validated);

        return redirect()
            ->route('courses.index')
            ->with('success', 'Course created successfully!');

    })->name('courses.store');

    // ======================================================
    // UPDATE COURSE
    // ======================================================

    Route::put('/courses/{id}', function (Request $request, $id) {

        $course = Course::findOrFail($id);

        Gate::authorize('manage-course', $course);

        $validated = $request->validate([

            'name' => 'required|string|max:255',

            'description' => 'nullable|string|max:1000',

            'duration' => 'required|integer|min:1',

            'fee' => 'required|numeric|min:0',

            'difficulty' => 'required|in:Easy,Medium,Hard',

        ]);

        $validated['is_active'] = $request->has('is_active');

        $course->update($validated);

        return redirect()
            ->route('courses.show', $course->id)
            ->with('success', 'Course updated successfully!');

    })->name('courses.update');

    // ======================================================
    // DELETE COURSE
    // ======================================================

    Route::delete('/courses/{id}', function ($id) {

        $course = Course::findOrFail($id);

        Gate::authorize('manage-course', $course);

        $course->delete();

        return redirect()
            ->route('courses.index')
            ->with('success', 'Course deleted successfully!');

    })->name('courses.destroy');
});
