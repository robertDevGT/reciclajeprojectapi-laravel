<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Resources\RolesResource;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Role::query();

        if ($request->query('paginated')) {
            return RolesResource::collection($query->paginate(10));
        }

        return RolesResource::collection($query->get());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRoleRequest $request)
    {
        $data = $request->validated();

        try {
            Role::create([
                'name' => $data['name'],
                'guard_name' => 'web'
            ]);

            return response()->json('Rol creado Correctamente', 200);
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'Hubo un error al crear el Rol'
            ], 500);
        }
    }
}
