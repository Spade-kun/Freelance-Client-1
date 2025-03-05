<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Grade;
use App\Http\Requests\GradeRequest;
use App\Models\Enrollment;

class GradesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $grades = Grade::all();
        return view('grades.index', ['grades' => $grades]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */ public function create()
    {
        // Fetch enrollments with the student and subject information for the dropdown
        $enrollments = Enrollment::with(['student', 'subject'])
            ->get()
            ->mapWithKeys(function ($enrollment) {
                return [$enrollment->id => $enrollment->student->last_name . ' - ' . $enrollment->subject->name];
            });

        return view('grades.create', compact('enrollments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  GradeRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(GradeRequest $request)
    {
        $grade = new Grade;
        $grade->enrollment_id = $request->input('enrollment_id');
        $grade->grade = $request->input('grade');
        $grade->remarks = $request->input('remarks');
        $grade->save();

        return to_route('grades.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $grade = Grade::with(['enrollment.student.user', 'enrollment.subject'])->findOrFail($id);
        return view('grades.show', compact('grade'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $grade = Grade::findOrFail($id);

        // Fetch enrollments with student and subject information
        $enrollments = Enrollment::with(['student', 'subject'])
            ->get()
            ->mapWithKeys(function ($enrollment) {
                return [$enrollment->id => $enrollment->student->last_name . ' - ' . $enrollment->subject->name];
            });

        return view('grades.edit', compact('grade', 'enrollments'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  GradeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(GradeRequest $request, $id)
    {
        $grade = Grade::findOrFail($id);
        $grade->enrollment_id = $request->input('enrollment_id');
        $grade->grade = $request->input('grade');
        $grade->remarks = $request->input('remarks');
        $grade->save();

        return to_route('grades.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $grade = Grade::findOrFail($id);
        $grade->delete();

        return to_route('grades.index');
    }
}
