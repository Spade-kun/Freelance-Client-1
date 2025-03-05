<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Subject;

use App\Models\Enrollment;
use App\Http\Requests\EnrollmentRequest;

class EnrollmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $enrollments = Enrollment::all();
        return view('enrollments.index', ['enrollments' => $enrollments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $students = Student::pluck('last_name', 'id'); // Fetch students with last_name
        $subjects = Subject::selectRaw("CONCAT(name, ' (', code, ')') as subject, id")->pluck('subject', 'id'); // Fetch subjects with name + code
        return view('enrollments.create', compact('students', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EnrollmentRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(EnrollmentRequest $request)
    {
        $enrollment = new Enrollment;
        $enrollment->student_id = $request->input('student_id');
        $enrollment->subject_id = $request->input('subject_id');
        $enrollment->enrollment_date = $request->input('enrollment_date');
        $enrollment->save();

        return to_route('enrollments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $enrollment = Enrollment::with(['student.user', 'subject'])->findOrFail($id);
        return view('enrollments.show', compact('enrollment'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $students = Student::pluck('last_name', 'id');
        $subjects = Subject::selectRaw("CONCAT(name, ' (', code, ')') as subject, id")->pluck('subject', 'id');

        return view('enrollments.edit', compact('enrollment', 'students', 'subjects'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  EnrollmentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EnrollmentRequest $request, $id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->student_id = $request->input('student_id');
        $enrollment->subject_id = $request->input('subject_id');
        $enrollment->enrollment_date = $request->input('enrollment_date');
        $enrollment->save();

        return to_route('enrollments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->delete();

        return to_route('enrollments.index');
    }
}
