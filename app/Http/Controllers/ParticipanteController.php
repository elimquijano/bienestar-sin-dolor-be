<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Participante;
use Illuminate\Http\Request;

class ParticipanteController extends Controller
{
    public function index()
    {
        $participantes = Participante::all();
        return response()->json($participantes);
    }

    public function show($id)
    {
        $participante = Participante::find($id);

        if (!$participante) {
            return response()->json(['message' => 'Participante no encontrado'], 404);
        }

        return response()->json($participante);
    }

    public function store(Request $request)
    {
        $participante = Participante::create($request->all());
        return response()->json($participante, 201);
    }

    public function update(Request $request, $id)
    {
        $participante = Participante::find($id);

        if (!$participante) {
            return response()->json(['message' => 'Participante no encontrado'], 404);
        }

        $participante->update($request->all());
        return response()->json($participante);
    }

    public function destroy($id)
    {
        $participante = Participante::find($id);

        if (!$participante) {
            return response()->json(['message' => 'Participante no encontrado'], 404);
        }

        $participante->delete();
        return response()->json(['message' => 'Participante eliminado con éxito']);
    }

    public function search(Request $request)
    {
        $id = $request->input('id');
        $user_id = $request->input('user_id');
        $conversation_id = $request->input('conversation_id');
        $paginate = $request->input('paginate') ?? 10;

        $participantes = Participante::query();

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

    public function searchConversations(Request $request)
    {
        // Obtener los parámetros de entrada
        $userId = $request->input('user_id');
        $tipoId = $request->input('tipo_id');

        if (!$userId || !$tipoId) {
            return response()->json(["message" => "El usuario y tipo es requerido"], 404);
        }

        $conversaciones = Conversation::where('tipo_id', $tipoId)
            ->whereHas('participante', function ($query) use ($userId) {
                // Asegurarse de que el usuario es un participante
                $query->where('user_id', $userId);
            })
            ->with(['participante' => function ($query) use ($userId) {
                // Excluir al participante que es el mismo que el user_id
                $query->where('user_id', '!=', $userId);
            }, 'mensaje' => function ($query) use ($userId) {
                // Obtener solo los mensajes que no han sido leídos por el usuario
                $query->where('user_id', '!=', $userId)
                    ->where('is_read', false);
            }])
            ->get();$conversaciones = Conversation::where('tipo_id', $tipoId)
            ->whereHas('participante', function($query) use ($userId) {
                // Asegurarse de que el usuario es un participante
                $query->where('user_id', $userId);
            })
            ->with(['participante' => function($query) use ($userId) {
                // Excluir al participante que es el mismo que el user_id
                $query->where('user_id', '!=', $userId);
            }, 'mensaje' => function($query) use ($userId) {
                // Obtener solo los mensajes que no han sido leídos por el usuario
                $query->where('user_id', '!=', $userId)
                      ->where('is_read', false);
            }])
            ->get();

        // Retornar la respuesta en formato JSON
        return response()->json($conversaciones, 200);
    }
}
