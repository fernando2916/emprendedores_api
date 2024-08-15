<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegistroRequest;
use App\Mail\ResetVerifyCodeMail;
use App\Mail\VerificationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function register(RegistroRequest $request) {
        $expiration = now()->addMinutes(10);
        // validar el registro
        $data = $request->validated();
        
        // Crear el usuario
        $user = User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'verification_code' => random_int('100000', '999999'),
            'verification_code_expires_at' => $expiration,
            'verification_id' => uniqid(),
        ]);
               
        // enviar correo de confirmación
        Mail::to($user->email)->send(new VerificationMail($user));
        
        return response()->json([
            // 'user' => $user,
            'message' => 'Usuario registrado correctamente. Por favor, revisa tu correo para verificar tu cuenta.',

        ], 201);
        
    }

    public function verify($id, $verification_code) {
       // Busca al usuario por el identificador único
       $user = User::where('verification_id', $id)->first();

       if (!$user) {
           return response()->json(['message' => 'Identificador no encontrado.'], 404);
       }

       // Verifica que el código de verificación sea correcto
       if ($user->verification_code != $verification_code) {
           return response()->json(['message' => 'Código de verificación inválido.'], 400);
       }

       // Verifica que el código no haya expirado
       if (now()->greaterThan($user->verification_code_expires_at)) {
           return response()->json(['message' => 'El código de verificación ha expirado.'], 400);
       }

       // Marca al usuario como verificado
       $user->is_verified = true;
       $user->email_verified_at = now();
       $user->verification_code = null; // Limpia el token de verificación
       $user->verification_code_expires_at = null;
       $user->verification_id = null; // Opcional: Limpia el identificador único después de la verificación
       $user->save();

       return response()->json(['message' => 'Correo electrónico verificado exitosamente.'], 200);
    }
    
    
    public function reset_Code(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = $validator->validated();

    
        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            return response()->json(['message' => 'No se encontró el usuario'], 404);
        }
    
        if ($user->email_verified_at) {
            return response()->json(['message' => 'La cuenta ya está verificada'], 400);
        }
    
        $user->verification_code = rand(100000, 999999);
        $user->verification_code_expires_at = now()->addMinutes(10);
        $user->save();
    
        Mail::to($user->email)->send(new ResetVerifyCodeMail($user));
    
        return response()->json(['message' => 'Nuevo token enviado al correo electrónico'], 200);
    }

    public function login(Request $request) {
    
        $credentials = $request->only(['email', 'password']);

        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Intento de Inicio de Sesión
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['message' => 'El Correo o la contraseña son incorrectos'], 422);
        }
         
        // Verificación de Email
        $user = auth('api')->user();
        if (!$user->is_verified) {
            return response()->json(['message' => 'El correo electrónico no ha sido verificado'], 401);
        }

        return response()->json([
            'message' => 'Inicio de sesión exitoso',
            'token' => $token,
        ], 200);

    }

    public function refreshToken(){
        try {

            $newToken = JWTAuth::parseToken()->refresh();

            return response()->json([
                'message' => 'token actualiado',
                'token' => $newToken,
            ], 200);

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['message' => 'token no inválido'], 401);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['message' => 'token expirado'], 401);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ocurrió un error al actualizar el token '], 500);
        }
    }

    public function me() {
        return response()->json(auth('api')->user());
    }

    public function logout() {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json([
                'message' => 'Sesión cerrada exitosamente'
            ], 200);

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json([
                'message' => 'Error al cerrar sesión, por favor intente nuevamente'
            ], 500);
        }
    }
}
