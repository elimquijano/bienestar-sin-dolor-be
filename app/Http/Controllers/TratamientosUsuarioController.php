<?php

namespace App\Http\Controllers;

use App\Models\TratamientosUsuario; // Asegúrate de tener este modelo
use Illuminate\Http\Request;

class TratamientosUsuarioController extends Controller
{
    public function index()
    {
        $tratamientosUsuario = TratamientosUsuario::all();
        return response()->json($tratamientosUsuario);
    }

    public function show($id)
    {
        $tratamientoUsuario = TratamientosUsuario::find($id);

        if (!$tratamientoUsuario) {
            return response()->json(['message' => 'TratamientoUsuario no encontrado'], 404);
        }

        return response()->json($tratamientoUsuario);
    }

    public function store(Request $request)
    {
        $tratamientoUsuario = TratamientosUsuario::create($request->all());
        return response()->json($tratamientoUsuario, 201);
    }

    public function update(Request $request, $id)
    {
        $tratamientoUsuario = TratamientosUsuario::find($id);

        if (!$tratamientoUsuario) {
            return response()->json(['message' => 'TratamientoUsuario no encontrado'], 404);
        }

        $tratamientoUsuario->update($request->all());
        return response()->json($tratamientoUsuario);
    }

    public function destroy($id)
    {
        $tratamientoUsuario = TratamientosUsuario::find($id);

        if (!$tratamientoUsuario) {
            return response()->json(['message' => 'TratamientoUsuario no encontrado'], 404);
        }

        $tratamientoUsuario->delete();
        return response()->json(['message' => 'TratamientoUsuario eliminado con éxito']);
    }

    public function search(Request $request)
    {
        $usuario_id = $request->input('usuario_id');
        $paginate = $request->input('paginate') ?? 10;

        $tratamientosUsuario = TratamientosUsuario::query();

        if ($usuario_id) {
            $tratamientosUsuario->where('usuario_id', $usuario_id);
        }
        $tratamientosUsuario->orderBy('id', 'desc');

        $tratamientosUsuario = $tratamientosUsuario->paginate($paginate);

        return response()->json($tratamientosUsuario);
    }
}
