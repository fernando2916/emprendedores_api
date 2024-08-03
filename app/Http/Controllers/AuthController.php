<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegistroRequest;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
   
    public function register(RegistroRequest $request) {

        // validar el registro
        $data = $request->validated();
        
        // Crear el usuario
        $user = User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'verification_token' => rand(100000, 900000),
        ]);
        
        // enviar correo de confirmación
        Mail::to($user->email)->send(new VerificationMail($user));
        
        $token = JWTAuth::fromUser($user);
        
        return response()->json(compact('user', 'token'), 201);

    }
    public function verify(Request $request) {

    }
    public function login(LoginRequest $request) {

    }
    public function logout(Request $request) {

    }
}
