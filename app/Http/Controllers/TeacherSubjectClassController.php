<?php

namespace App\Http\Controllers;

use App\Http\Resources\TeacherSubjectClassResource;
use App\Models\TeacherSubjectClass;
use Illuminate\Http\Request;

class TeacherSubjectClassController extends Controller
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
            'teacher_id' => 'required',
            'class_id' => 'required',
            'subject_id' => 'required'
        ]);

        $teacherSubjectClass = TeacherSubjectClass::where('teacher_id', $data['teacher_id'])->Where('subject_id', $data['subject_id'])->Where('class_id', $data['class_id'])->first();
        if ($teacherSubjectClass) {
            return $this->responseMessage('Teacher Is Aready Enrolled In This Subject', 422);
        }
        return new TeacherSubjectClassResource(TeacherSubjectClass::create($data));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TeacherSubjectClass  $teacherSubjectClass
     * @return \Illuminate\Http\Response
     */
    public function show(TeacherSubjectClass $teacherSubjectClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeacherSubjectClass  $teacherSubjectClass
     * @return \Illuminate\Http\Response
     */
    public function edit(TeacherSubjectClass $teacherSubjectClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TeacherSubjectClass  $teacherSubjectClass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeacherSubjectClass $teacherSubjectClass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeacherSubjectClass  $teacherSubjectClass
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeacherSubjectClass $teacherSubjectClass)
    {
        //
    }
}
