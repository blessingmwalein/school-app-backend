<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentSubjectResource;
use App\Models\StudentSubject;
use Illuminate\Http\Request;

class StudentSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required',
            'subject_id'=> 'required'
        ]);

        $studentSubject = StudentSubject::where('student_id', $data['student_id'])->Where('subject_id', $data['subject_id'])->first();
        if ($studentSubject) {
            return $this->responseMessage('Student Is Aready Enrolled In This Subject', 422);
        }
        return new StudentSubjectResource(StudentSubject::create([
            'student_id' => $data['student_id'],
            'subject_id' => $data['subject_id']
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentSubject  $studentSubject
     * @return \Illuminate\Http\Response
     */
    public function show(StudentSubject $studentSubject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentSubject  $studentSubject
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentSubject $studentSubject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentSubject  $studentSubject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentSubject $studentSubject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentSubject  $studentSubject
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentSubject $studentSubject)
    {
        //
    }
}
