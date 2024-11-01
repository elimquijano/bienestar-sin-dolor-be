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

        if (!$userId) {
            return response()->json(["message" => "El usuario es requerido"], 404);
        }

        // Construir la consulta
        $conversaciones = Conversation::query();

        if ($tipoId) {
            $conversaciones->where('tipo_id', $tipoId);
        }

        $conversaciones->whereHas('participante', function ($query) use ($userId) {
            // Asegurarse de que el usuario es un participante
            $query->where('user_id', $userId);
        })
            ->with(['participantes', 'mensaje' => function ($query) {
                // Obtener el último mensaje de la conversación
                $query->orderBy('created_at', 'desc')->limit(3);
            }])
            ->withCount(['mensajes as unread_count' => function ($query) use ($userId) {
                // Contar solo los mensajes que no han sido leídos por el usuario
                $query->where('user_id', '!=', $userId)
                    ->where('is_read', false);
            }]);

        // Obtener los resultados
        $conversaciones = $conversaciones->get();

        // Retornar la respuesta en formato JSON
        return response()->json($conversaciones, 200);
    }
}
