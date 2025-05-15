<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAddressRequest;
use App\Http\Resources\AddressesResource;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Address::query();

        if ($request->query('paginated')) {
            return AddressesResource::collection($query->paginate(10));
        }

        return AddressesResource::collection($query->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateAddressRequest $request)
    {
        $data = $request->validated();

        try {
            Address::create($data);

            return response()->json('Dirección Creada Correctamente', 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Hubo un error al crear la dirección'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $address = Address::find($id);

        if (!$address) {
            return response()->json(['msg' => 'Dirección No Encontrada'], 404);
        }

        return new AddressesResource($address);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateAddressRequest $request, string $id)
    {
        $data = $request->validated();

        $address = Address::find($id);

        if (!$address) {
            return response()->json(['msg' => 'Dirección No Encontrada'], 404);
        }

        try {
            $address->update($data);

            return response()->json('Dirección Actualizada Correctamente', 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Hubo un error al actualizar la dirección'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $address = Address::find($id);

        if (!$address) {
            return response()->json(['msg' => 'Dirección No Encontrada'], 404);
        }

        try {
            $address->delete();

            return response()->json('Dirección Actualizada Correctamente', 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Hubo un error al actualizar la dirección'], 500);
        }
    }
}
