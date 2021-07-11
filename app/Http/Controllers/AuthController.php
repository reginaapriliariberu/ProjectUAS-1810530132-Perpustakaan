<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'me', 'daftar']]);
        // $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['name', 'email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            // return response()->json(['error' => 'Unauthorized'], 401);
            return response()->json([


                'errors' => [
                    'msg' => ['Username atau Nama atau Password anda Salah']
                ]
            ], 404);
        }

        // return $this->respondWithToken($token);
        return response()->json([
            'type' => 'success',
            'message' => 'Anda berhasil Login, silahkan masukan token di bawah untuk halaman yang ingin di akses',
            'token' => $token
        ]);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        // return response()->json(auth()->user());
        return response()->json([
            'Pesan' => 'Halaman dapat diakses bebas'
        ]);
    }

    public function wajiblogin()
    {
        // return response()->json(auth()->user());
        return response()->json([
            'Pesan' => 'Halaman dapat diakses'
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Anda berhasil logout']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function daftar(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',

        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            // 'api_token' => Str::random(4),

        ]);
        return response()->json([
            'pesan' => 'Anda berhasil registrasi, silahkan akses halaman login',
            'data' => $user

        ], 200);
    }
}
