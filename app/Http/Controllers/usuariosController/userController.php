<?php

namespace App\Http\Controllers\usuariosController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Generador de token
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


//Modelos
use App\modelos\Usuario;

class userController extends Controller
{
   //Login 
   public function loginUser(Request $request){
       
    $credentials = $request->only('username','password');

    $token = JWTAuth::attempt($credentials); 

    if($token){
       return response()->json([
         'Mensaje' => 'Has iniciado sesion correctamente',
         'status' => 200,
         'token' => $token
       ]);
    } else{
       return response()->json([ 
         'Mensaje' => 'No estas registrado',
         'status' => 200 
       ]);
    }
   }

   public function validateToken(){
      return response()->json([
         auth()->user(),
         'Mensaje' => 'El usuario esta logueado correctamente',
         'status' => 200
         ]);
   }


}
