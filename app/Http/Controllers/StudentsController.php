<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Http\Requests\StudentRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *@return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $students = Student::with('user')->get(); // Eager load the associated user
        return view('students.index', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StudentRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StudentRequest $request)
    {

        $user = new User();
        if ($request->input('name')) {
            $user->name = $request->input('name');
        } else {
            $user->name = $request->input('first_name') . ' ' . $request->input('last_name');
        }
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->assignRole('user');
        $user->save();


        $student = new Student();
        $student->user_id = $user->id;
        $student->first_name = $request->input('first_name');
        $student->middle_name = $request->input('middle_name');
        $student->last_name = $request->input('last_name');
        $student->phone = $request->input('phone');
        $student->address = $request->input('address');
        $student->date_of_birth = $request->input('date_of_birth');
        $student->save();

        return to_route('students.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $student = Student::with('user')->findOrFail($id); // Eager load the associated user
        return view('students.show', ['student' => $student]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $student = Student::with('user')->findOrFail($id); // Eager load the associated user
        return view('students.edit', ['student' => $student]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StudentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StudentRequest $request, $id)
    {
        $student = Student::findOrFail($id);

        // Update the student details
        $student->first_name = $request->input('first_name');
        $student->middle_name = $request->input('middle_name');
        $student->last_name = $request->input('last_name');
        $student->phone = $request->input('phone');
        $student->address = $request->input('address');
        $student->date_of_birth = $request->input('date_of_birth');
        $student->save();

        // Update the associated user (email and password)
        $student->user->email = $request->input('email');
        $student->user->name = $request->input('name');
        if ($request->input('password')) {
            $student->user->password = Hash::make($request->input('password'));
        }
        $student->user->save();

        return to_route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);

        // First, delete the associated user to maintain consistency
        $student->user->delete();

        // Then delete the student record
        $student->delete();

        return to_route('students.index');
    }
}
