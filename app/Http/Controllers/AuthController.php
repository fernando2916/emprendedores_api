<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegistroRequest;
use App\Http\Requests\VerificationRequest;
use App\Mail\VerificationMail;
use Illuminate\Support\Facades\Mail;
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
            'verification_code' => random_int('100000', '999999'),
        ]);
        
        // enviar correo de confirmación
        Mail::to($user->email)->send(new VerificationMail($user));
        
        $token = JWTAuth::fromUser($user); 
        
        // return response()->json(compact(
        //     'user', 
        //     'token', 
        //     'message' => 'Usuario registrado. Por favor, verifique su correo electrónico.'), 201);
        
        return response()->json([
            'user' => $user,
            'token' => $token,
            'message' => 'Usuario registrado. Por favor, verifique su correo electrónico.',

        ], 201);
        
    }
    public function verify(VerificationRequest $request) {

        $data = $request->validated();

        if ($data->fails()) {
            return response()->json($data->errors(), 400);
        }

        $user = User::where([
            'verification_token' => $data['token'],
            
        ]);
    }
    public function login(LoginRequest $request) {

    }
    public function logout(Request $request) {

    }
}
