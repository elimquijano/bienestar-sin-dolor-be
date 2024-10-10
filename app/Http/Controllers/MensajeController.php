<?php

namespace App\Http\Controllers;

use App\Models\Mensaje;
use Illuminate\Http\Request;

class MensajeController extends Controller
{
    public function index()
    {
        $mensajes = Mensaje::all();
        return response()->json($mensajes);
    }

    public function show($id)
    {
        $mensaje = Mensaje::find($id);

        if (!$mensaje) {
            return response()->json(['message' => 'Mensaje no encontrado'], 404);
        }

        return response()->json($mensaje);
    }

    public function store(Request $request)
    {
        $mensaje = Mensaje::create($request->all());
        return response()->json($mensaje, 201);
    }

    public function update(Request $request, $id)
    {
        $mensaje = Mensaje::find($id);

        if (!$mensaje) {
            return response()->json(['message' => 'Mensaje no encontrado'], 404);
        }

        $mensaje->update($request->all());
        return response()->json($mensaje);
    }

    public function destroy($id)
    {
        $mensaje = Mensaje::find($id);

        if (!$mensaje) {
            return response()->json(['message' => 'Mensaje no encontrado'], 404);
        }

        $mensaje->delete();
        return response()->json(['message' => 'Mensaje eliminado con éxito']);
    }
    
    public function search(Request $request)
    {
        $conversation_id = $request->input('conversation_id');
        $paginate = $request->input('paginate') ?? 100;

        $mensajes = Mensaje::query();

        if ($conversation_id) {
            $mensajes->where('conversation_id', '=', $conversation_id);
        }
        $mensajes->orderBy('id', 'desc');

        $mensajes = $mensajes->paginate($paginate);

        return response()->json($mensajes);
    }
}
