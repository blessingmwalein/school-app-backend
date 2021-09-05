<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function responseMessage($message, $statusCode=200)
    {
        return response()->json(['message' => $message ], $statusCode);
    }

    public function createUser($email, $first_name, $last_name)
    {
        $role = Role::where('name', '=', 'student')->first();
        $password =  bcrypt($first_name . "." . $last_name);

        return User::create([
            'email' => $email,
            'role_id' => $role->id,
            'password' => $password,
        ]);
    }

}
