<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCollectorRequest;
use App\Http\Resources\CollectorsResource;
use App\Models\Collector;
use Illuminate\Http\Request;

class CollectorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Collector::query();

        if ($request->query('paginated')) {
            return CollectorsResource::collection($query->paginate(10));
        }

        return CollectorsResource::collection($query->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCollectorRequest $request)
    {
        $data = $request->validated();

        try {
            Collector::create($data);

            return response()->json('Recolector creado correctamente', 200);
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'Hubo un error al crear el recolector'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $collector = Collector::find($id);

        if (!$collector) {
            return response()->json([
                'msg' => 'Recolector no Encontrado'
            ], 404);
        }

        return new CollectorsResource($collector);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateCollectorRequest $request, string $id)
    {
        $collector = Collector::find($id);
        $data = $request->validated();

        if (!$collector) {
            return response()->json([
                'msg' => 'Recolector no Encontrado'
            ], 404);
        }


        try {
            $collector->update($data);

            return response()->json('Recolector Actualizado correctamente', 200);
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'Hubo un error al actualizar el recolector'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $collector = Collector::find($id);

        if (!$collector) {
            return response()->json([
                'msg' => 'Recolector no Encontrado'
            ], 404);
        }

        try {
            $collector->delete();


            return response()->json('Recolector Eliminado correctamente', 200);
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'Hubo un error al eliminar el recolector'
            ], 500);
        }
    }
}
