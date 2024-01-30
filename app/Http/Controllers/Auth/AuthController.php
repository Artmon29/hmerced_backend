<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Exception;
use Validator;
class AuthController extends Controller
{
    public function __construct()
    {
        /* $this->middleware('auth:api', ['except' => ['login','register']]); */
        $this->middleware('auth:api', ['except' => ['login','register']]);

    }
    //usuario autentcado verificacion
    public function index()
    {
        $pacientes = User::all();
        return response()->json($pacientes);
        // El usuario no está autenticado
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required|string',
                'password' => 'required|string',
            ]);

            $credentials = $request->only('username', 'password');

            // usuario existe?
            if (!User::where('username', $credentials['username'])->exists()) {
                return response()->json([
                    'status' => '404',
                    'message' => 'El Usuario no Existe'
                ], 404);
            }

            // Verificando credenciales del usuario
             if (!Auth::attempt($credentials)) {
                return response()->json([
                    'status' => '401',
                    'message' => 'Usuario o Contraseña Incorrectos'], 401);
            }

            // Generate and return access token

            $token = Auth::attempt($credentials);
            /* $user = Auth::user(); */
            /* $user = Auth::user()->with('permissions')->first(); */
           /*  $user = Auth::user();
            $permissions = $user->permissions; */
            $user = Auth::user();
            $roles = $user->roles;

            return response()->json([
                'user' =>$user,
                'status' => '200',
                'token' => $token,
                'rol'=>$roles[0]->name], 200);
        } catch (Exception $e) {
            switch ($e->getCode()) {
                case 400:
                    return response()->json([
                        'status' => '400',
                        'message' => 'Bad request'], 400);
                case 401:
                    return response()->json([
                        'status' => '401',
                        'message' => 'Unauthorized'], 401);
                case 500:
                    return response()->json([
                        'status' => '500',
                        'message' => 'Internal server error'], 500);
                default:
                    return response()->json([
                        'status' => '500',
                        'message' => 'Unknown error'], 500);
            }
        }
    }
    //REGISTER
    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'estado'=>'required|string'
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'estado'=>$request->estado

        ]);

        $token = Auth::login($user);
        /* return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]); */
        return response()->json([
            'id'=>$user->id
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}
