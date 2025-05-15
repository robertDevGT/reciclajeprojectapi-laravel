<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStatusRequest;
use App\Http\Resources\StatusesResource;
use App\Models\Status;
use Illuminate\Http\Request;

class StatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Status::query();

        if ($request->query('paginated')) {
            return StatusesResource::collection($query->paginate(10));
        }

        return StatusesResource::collection($query->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateStatusRequest $request)
    {
        $data = $request->validated();

        try {
            Status::create($data);

            return response()->json('Status Creado Correctamente', 200);
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'Hubo un error al crear el estado'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $status = Status::find($id);

        if (!$status) {
            return response()->json([
                'msg' => 'Estado no Encontrado'
            ], 404);
        }

        return new StatusesResource($status);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateStatusRequest $request, string $id)
    {
        $data = $request->validate();

        $status = Status::find($id);

        if (!$status) {
            return response()->json([
                'msg' => 'Estado no Encontrado'
            ], 404);
        }

        try {
            $status->update($data);

            return response()->json('Status Actualizado Correctamente', 200);
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'Hubo un error al actualizar el estado'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $status = Status::find($id);

        if (!$status) {
            return response()->json([
                'msg' => 'Estado no Encontrado'
            ], 404);
        }

        try {
            $status->delete();
            return response()->json('Status Eliminado Correctamente', 200);
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'Hubo un error al eliminar el estado'
            ], 500);
        }
    }
}
