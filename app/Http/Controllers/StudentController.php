<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentResource;
use App\Models\Role;
use App\Models\Student;
use App\Models\StudentSubject;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\SmsController;
use App\Models\PasswordReset;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $school;
    public $password_reset;
    protected $smsController;
    public function __construct(SmsController $smsController)
    {
        $this->smsController = $smsController;
        $this->school = getenv('SCHOOL');
        $this->password_reset = getenv('password_reset');
    }

    public function all()
    {
        return StudentResource::collection(Student::all());
    }
    public function index()
    {
        return StudentResource::collection(Student::paginate(20));
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
            'phone_number' => 'required |unique:students',
            'email' => 'required | email | unique:users'
        ]);

        $user = $this->createUser($data['email'], $data['first_name'], $data['last_name']);
        $student = Student::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone_number' => $data['phone_number'],
            'user_id' => $user->id,
            'enrollment_number' => $this->enrollmentNumber($user),
        ]);

        $password_reset = PasswordReset::create([
            'email' => $request->email,
            'token' => Str::random(60),
        ]);
        $this->smsController->sendSms($student->phone_number, "Hey $student->first_name $student->last_name your account for $this->school have been created use $user->email as username her is password reset link: $this->password_reset$password_reset->token");
        return new StudentResource($student);
    }

    public function enrollmentNumber($user)
    {
        return 'CS21' . $user->id . rand(1, 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return new StudentResource($student);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required'
        ]);
        $student->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone_number' => $data['phone_number'],
            'user_id' => $student->user_id,
            'enrollment_number' => $student->enrollment_number,
        ]);
        return new StudentResource($student);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }

    public function search(Request $request)
    {
        $students = Student::query()->where('first_name', 'LIKE', "%{$request['query']}%")
            ->orWhere('last_name', 'LIKE', "%{$request['query']}%")
            ->orWhere('enrollment_number', 'LIKE', "%{$request['query']}%")
            ->get();
        return StudentResource::collection($students);
    }
}
