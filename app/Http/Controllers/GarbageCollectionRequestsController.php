<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignCollectorRequest;
use App\Http\Requests\CreateGarbageCollectionRequestsRequest;
use App\Http\Requests\UpdateGarbageCollectionRequestsRequest;
use App\Http\Resources\GarbageCollectionResource;
use App\Models\GarbageCollectionRequest;
use App\Models\GarbageCollectionRequestCollector;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class GarbageCollectionRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = GarbageCollectionRequest::query();

        if($request->query('status')){
            $query->where('status_id', $request->query('status'));
        }

        return GarbageCollectionResource::collection($query->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateGarbageCollectionRequestsRequest $request)
    {
        $data = $request->validated();

        try {
            $data['user_id'] = $request->user()->id;
            GarbageCollectionRequest::create($data);

            return response()->json('Solicitud creada correctamente', 200);
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'Hubo un error al crear la solicitud'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $doc = GarbageCollectionRequest::find($id);

        if (!$doc) {
            return response()->json([
                'msg' => 'Solicitud no Encontrada'
            ], 404);
        }

        return new GarbageCollectionResource($doc);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGarbageCollectionRequestsRequest $request, string $id)
    {
        $data = $request->validated();
        $doc = GarbageCollectionRequest::find($id);
        if (!$doc) {
            return response()->json([
                'msg' => 'Solicitud no Encontrada'
            ], 404);
        }

        try {
            $doc->status_id = $data['status_id'];
            $doc->save();

            return response()->json('Solicitud actualizada correctamente', 200);
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'Hubo un error al actualizar la solicitud'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $doc = GarbageCollectionRequest::find($id);
        if (!$doc) {
            return response()->json([
                'msg' => 'Solicitud no Encontrada'
            ], 404);
        }

        try {
            $doc->delete();

            return response()->json('Solicitud eliminada correctamente', 200);
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'Hubo un error al eliminar la solicitud'
            ], 500);
        }
    }

    public function AssignCollector(AssignCollectorRequest $request)
    {
        $data = $request->validated();

        $garbageCollectionRequest = GarbageCollectionRequest::find($data['request_id']);

        if (!$garbageCollectionRequest) {
            return response()->json([
                'msg' => 'Solicitud no Encontrada'
            ], 404);
        }

        try {
            GarbageCollectionRequestCollector::create([
                'request_id' => $garbageCollectionRequest->id,
                'collector_id' => $data['collector_id'],
                'assigned_at' => Carbon::now(),
            ]);

            $garbageCollectionRequest->status_id = 2;
            $garbageCollectionRequest->save();

            return response()->json('Recolector asignado correctamente', 200);
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => $th->getMessage()
            ], 500);
        }
    }

}
