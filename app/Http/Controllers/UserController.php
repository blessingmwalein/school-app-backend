<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\PasswordReset;
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

    public function resetPassword(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed',
            'token' => 'required'
        ]);
        $tokenData = PasswordReset::where('token', $data['token'])->first();
        // dd($tokenData);
        if(!$tokenData){
            return $this->responseMessage('Invalid Link', 403);
        }

        $user = User::where('email', $data['email'])->first();
        $user->password = Hash::make($data['password']);
        $user->update(); //or $user->save();
        $tokenData->delete();

        return $this->responseMessage('Password Changed Can Login', 200);
    }
}
