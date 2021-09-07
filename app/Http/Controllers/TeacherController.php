<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentResource;
use App\Http\Resources\TeacherResource;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TeacherResource::collection(Teacher::paginate(20));
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
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            'email' => 'required | email'
        ]);

        $user = $this->createUser($data['email'], $data['first_name'], $data['last_name']);
        $teacher = Teacher::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone_number' => $data['phone_number'],
            'user_id' => $user->id,
            'teacher_number' => $this->teacherNumber($user),
        ]);

        return new TeacherResource($teacher);
    }

    public function teacherNumber($user)
    {
        return 'CT21' . $user->id . rand(1, 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        return new TeacherResource($teacher);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required'
        ]);
        $teacher->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone_number' => $data['phone_number'],
            'user_id' => $teacher->user_id,
            'teacher_number' => $teacher->teacher_number,
        ]);
        return new TeacherResource($teacher);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
    }

    public function search(Request $request)
    {
        $teachers = Teacher::query()->where('first_name', 'LIKE', "%{$request['query']}%")
            ->orWhere('last_name', 'LIKE', "%{$request['query']}%")
            ->orWhere('teacher_number', 'LIKE', "%{$request['query']}%")
            ->get();
        return TeacherResource::collection($teachers);
    }
}
