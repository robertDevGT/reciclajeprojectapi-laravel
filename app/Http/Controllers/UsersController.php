<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Resources\UsersResource;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{

    public function index(Request $request)
    {
        $query = User::query();

        if ($request->query('paginated')) {
            return UsersResource::collection($query->paginate(10));
        }

        return UsersResource::collection($query->get());
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $data = $request->validated();

        try {
            $role = Role::find($data['role_id']);

            $user = User::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => $data['password']
            ])->assignRole($role->name);

            foreach ($data['direcciones'] as $key => $value) {
                UserAddress::create([
                    'user_id' => $user->id,
                    'address_id' => $value
                ]);
            }

            return response()->json('Usuario Creado Correctamente', 200);
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
}
