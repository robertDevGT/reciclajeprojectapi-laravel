<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(LoginRequest $request)
    {
        $data = $request->validated();

        if (!Auth::attempt($data)) {
            return response()->json([
                'errors' => ['Credenciales Incorrectas']
            ], 422);
        }

        $user = Auth::user();
        return response()->json([
            'token' => $user->createToken('token')->plainTextToken,
        ]);
    }
}
