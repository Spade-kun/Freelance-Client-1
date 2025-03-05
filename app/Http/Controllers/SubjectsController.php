<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Subject;
use App\Http\Requests\SubjectRequest;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $subjects= Subject::all();
        return view('subjects.index', ['subjects'=>$subjects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SubjectRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SubjectRequest $request)
    {
        $subject = new Subject;
		$subject->name = $request->input('name');
		$subject->code = $request->input('code');
        $subject->save();

        return to_route('subjects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $subject = Subject::findOrFail($id);
        return view('subjects.show',['subject'=>$subject]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        return view('subjects.edit',['subject'=>$subject]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SubjectRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SubjectRequest $request, $id)
    {
        $subject = Subject::findOrFail($id);
		$subject->name = $request->input('name');
		$subject->code = $request->input('code');
        $subject->save();

        return to_route('subjects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return to_route('subjects.index');
    }
}
