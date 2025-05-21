<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getRole(Request $request)
    {
        $user = $request->user();

        return response()->json($user->getRoleNames()->first(), 200);
    }
}
