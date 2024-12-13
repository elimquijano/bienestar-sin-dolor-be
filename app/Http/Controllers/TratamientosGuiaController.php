<?php

namespace App\Http\Controllers;

use App\Models\TratamientosGuia; // Asegúrate de tener este modelo
use Illuminate\Http\Request;

class TratamientosGuiaController extends Controller
{
    public function index()
    {
        $tratamientosGuia = TratamientosGuia::all();
        return response()->json($tratamientosGuia);
    }

    public function show($id)
    {
        $tratamientoGuia = TratamientosGuia::find($id);

        if (!$tratamientoGuia) {
            return response()->json(['message' => 'TratamientoGuia no encontrado'], 404);
        }

        return response()->json($tratamientoGuia);
    }

    public function store(Request $request)
    {
        $tratamientoGuia = TratamientosGuia::create($request->all());
        return response()->json($tratamientoGuia, 201);
    }

    public function update(Request $request, $id)
    {
        $tratamientoGuia = TratamientosGuia::find($id);

        if (!$tratamientoGuia) {
            return response()->json(['message' => 'TratamientoGuia no encontrado'], 404);
        }

        $tratamientoGuia->update($request->all());
        return response()->json($tratamientoGuia);
    }

    public function destroy($id)
    {
        $tratamientoGuia = TratamientosGuia::find($id);

        if (!$tratamientoGuia) {
            return response()->json(['message' => 'TratamientoGuia no encontrado'], 404);
        }

        $tratamientoGuia->delete();
        return response()->json(['message' => 'TratamientoGuia eliminado con éxito']);
    }

    public function search(Request $request)
    {
        $enfermedad_id = $request->input('form_enfermedad_id');
        $paginate = $request->input('paginate') ?? 10;

        $tratamientosGuia = TratamientosGuia::query();

        if ($enfermedad_id) {
            $tratamientosGuia->where('enfermedad_id', '=', $enfermedad_id);
        }
        $tratamientosGuia->orderBy('id', 'desc');

        $tratamientosGuia = $tratamientosGuia->paginate($paginate);

        return response()->json($tratamientosGuia);
    }
}
