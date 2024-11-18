<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Especialista;
use Illuminate\Http\Request;

class EspecialistaController extends Controller
{
    public function index()
    {
        $participantes = Especialista::all();
        return response()->json($participantes);
    }

    public function show($id)
    {
        $participante = Especialista::find($id);

        if (!$participante) {
            return response()->json(['message' => 'Especialista no encontrado'], 404);
        }

        return response()->json($participante);
    }

    public function store(Request $request)
    {
        $participante = Especialista::create($request->all());
        return response()->json($participante, 201);
    }

    public function update(Request $request, $id)
    {
        $participante = Especialista::find($id);

        if (!$participante) {
            return response()->json(['message' => 'Especialista no encontrado'], 404);
        }

        $participante->update($request->all());
        return response()->json($participante);
    }

    public function destroy($id)
    {
        $participante = Especialista::find($id);

        if (!$participante) {
            return response()->json(['message' => 'Especialista no encontrado'], 404);
        }

        $participante->delete();
        return response()->json(['message' => 'Especialista eliminado con éxito']);
    }

    public function search(Request $request)
    {
        $id = $request->input('id');
        $user_id = $request->input('user_id');
        $conversation_id = $request->input('conversation_id');
        $paginate = $request->input('paginate') ?? 10;

        $participantes = Especialista::query();

        if ($id) {
            $participantes->where('id', 'like', "%$id%");
        }
        if ($conversation_id) {
            $participantes->where('conversation_id', 'like', "%$conversation_id%");
        }
        if ($user_id) {
            $participantes->where('user_id', 'like', "%$user_id%");
        }
        $participantes->orderBy('id', 'desc');

        $participantes = $participantes->paginate($paginate);

        return response()->json($participantes);
    }
}
