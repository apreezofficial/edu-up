<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lecturer;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // List all courses (Read)
    public function index()
    {
        // Eager load lecturer and their user info for display efficiency
        $courses = Course::with('lecturer.user')->get(); 
        return view('admin.courses.index', compact('courses'));
    }

    // Show the creation form (Create)
    public function create()
    {
        // Fetch all lecturers to populate the dropdown menu
        $lecturers = Lecturer::with('user')->get();
        return view('admin.courses.create', compact('lecturers'));
    }

    // Store the new course (Create)
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:courses,code',
            'title' => 'required|string',
            'credit_unit' => 'required|integer|min:1|max:6',
            'lecturer_id' => 'nullable|exists:lecturers,id',
        ]);

        Course::create($request->all());

        return redirect()->route('admin.courses.index')->with('success', 'Course created and assigned.');
    }
}
