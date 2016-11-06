<?php

namespace App\Http\Controllers;

use App\Administrador;
use App\User;
use Illuminate\Http\Request;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class AuthController extends Controller
{

    public function userAuth(Request $request){

        $this->validate($request,[
            'email' => 'required',
            'password' => 'required',
            'rol' => 'required',
        ]);

        $credentials = $request->only('email','password');
        $email = $request->input('email');
        $rol = $request->input('rol');

        $user = User::where('email',$email)->get();

        switch ( $rol ){
            case 'ADMINISTRADOR':
                if (! $user[0]->administrador){
                    return response()->json(['error' => 'Credenciales Invalidas'], 401);
                }
            break;

            case 'DOCENTE':
                if (! $user[0]->docente){
                    return response()->json(['error' => 'Credenciales Invalidas'], 401);
                }
                break;

            case 'ESTUDIANTE':
                if (! $user[0]->estudiante){
                    return response()->json(['error' => 'Credenciales Invalidas'], 401);
                }
                break;
            default:
                    return response()->json(['error' => 'Credenciales Invalidas'], 401);

        }

        try {
            if (! $token = JWTAuth::attempt($credentials) ) {
                return response()->json(['error' => 'Credenciales Invalidas'], 401);
            }
        } catch (JWTException $e) {

            return response()->json(['error' => 'No se pudo crear el Token'], 500);
        }

        $user = JWTAuth::toUser($token);

        return response()->json(compact('token','user','rol'));

    }

}
