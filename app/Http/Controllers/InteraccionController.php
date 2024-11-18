<?php

namespace App\Http\Controllers;

use App\Models\Interaccion;
use Illuminate\Http\Request;

class InteraccionController extends Controller
{
    public function index()
    {
        $mensajes = Interaccion::all();
        return response()->json($mensajes);
    }

    public function show($id)
    {
        $mensaje = Interaccion::find($id);

        if (!$mensaje) {
            return response()->json(['message' => 'Interaccion no encontrado'], 404);
        }

        return response()->json($mensaje);
    }

    public function store(Request $request)
    {
        $mensaje = Interaccion::create($request->all());
        return response()->json($mensaje, 201);
    }

    public function update(Request $request, $id)
    {
        $mensaje = Interaccion::find($id);

        if (!$mensaje) {
            return response()->json(['message' => 'Interaccion no encontrado'], 404);
        }

        $mensaje->update($request->all());
        return response()->json($mensaje);
    }

    public function destroy($id)
    {
        $mensaje = Interaccion::find($id);

        if (!$mensaje) {
            return response()->json(['message' => 'Interaccion no encontrado'], 404);
        }

        $mensaje->delete();
        return response()->json(['message' => 'Interaccion eliminado con éxito']);
    }
    
    public function search(Request $request)
    {
        $conversation_id = $request->input('conversation_id');
        $paginate = $request->input('paginate') ?? 100;

        $mensajes = Interaccion::query();

        if ($conversation_id) {
            $mensajes->where('conversation_id', '=', $conversation_id);
        }

        $mensajes = $mensajes->paginate($paginate);

        return response()->json($mensajes);
    }
}
