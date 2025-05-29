<?php

namespace App\Http\Controllers;

use App\Http\Resources\GarbageCollectionResource;
use App\Models\GarbageCollectionRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getRole(Request $request)
    {
        $user = $request->user();

        return response()->json($user->getRoleNames()->first(), 200);
    }

    public function GetRequestsByUser(Request $request)
    {
        $query = GarbageCollectionRequest::query();

        $query->where('user_id',$request->user()->id);
        
        if ($request->query('status')) {
            $query->where('status_id', $request->query('status'));
        }


        return GarbageCollectionResource::collection($query->get());
    }
}
