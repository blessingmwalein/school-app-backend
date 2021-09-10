<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required | string |email',
            'password' => 'required'
        ]);

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response([
                'message' => "Credentials Dont Match Our Records"
            ], 422);
        }
        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user' => new UserResource($user),
            'token' => $token,
        ];
        return response($response, 201);
    }
}
