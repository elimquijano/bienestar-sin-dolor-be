<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Mensaje;
use App\Models\Participante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConversationController extends Controller
{
    public function index()
    {
        $conversations = Conversation::all();
        return response()->json($conversations);
    }

    public function show($id)
    {
        $conversation = Conversation::find($id);

        if (!$conversation) {
            return response()->json(['message' => 'Conversación no encontrado'], 404);
        }

        $conversation = Conversation::with(['participantes', 'mensajes'])
            ->where('id', $id)
            ->first();

        return response()->json($conversation, 201);
    }

    public function store(Request $request)
    {
        $conversation = Conversation::create($request->all());
        return response()->json($conversation, 201);
    }

    public function update(Request $request, $id)
    {
        $conversation = Conversation::find($id);

        if (!$conversation) {
            return response()->json(['message' => 'Conversación no encontrado'], 404);
        }

        $conversation->update($request->all());
        return response()->json($conversation);
    }

    public function destroy($id)
    {
        $conversation = Conversation::find($id);

        if (!$conversation) {
            return response()->json(['message' => 'Conversación no encontrado'], 404);
        }

        $conversation->delete();
        return response()->json(['message' => 'Conversación eliminado con éxito']);
    }

    public function search(Request $request)
    {
        $id = $request->input('form_id');
        $paginate = $request->input('paginate') ?? 10;

        $conversations = Conversation::query();

        if ($id) {
            $conversations->where('id', 'like', "%$id%");
        }
        $conversations->orderBy('id', 'desc');

        $conversations = $conversations->paginate($paginate);

        return response()->json($conversations);
    }

    public function create(Request $request)
    {
        $tipo_id = $request->input('tipo_id');
        $emisor_id = $request->input('emisor_id');
        $receptor_id = $request->input('receptor_id');

        if (!$tipo_id || !$emisor_id || !$receptor_id) {
            return response()->json(['message' => "El tipo y participantes son necesarios"], 404);
        }
        $participants = [["user_id" => $emisor_id], ["user_id" => $receptor_id]];

        // Iniciar una transacción
        DB::beginTransaction();

        try {
            // Crear conversación
            $conversation = Conversation::create(['tipo_id' => $tipo_id]);
            if (!$conversation) {
                return response()->json(['message' => "No se pudo crear una nueva conversación"], 504);
            }

            // Crear participantes en bloque
            $participantData = [];
            foreach ($participants as $participant) {
                $participantData[] = [
                    'conversation_id' => $conversation->id,
                    'user_id' => $participant['user_id'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Insertar participantes en bloque
            $inserted = Participante::insert($participantData);
            if (!$inserted) {
                // Si no se insertan los participantes, lanzar una excepción
                throw new \Exception("No se pudieron agregar los participantes");
            }

            // Si todo va bien, confirmar la transacción
            DB::commit();

            return response()->json($conversation, 201);
        } catch (\Exception $e) {
            // Si hay un error, hacer rollback
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function readAllMessages(Request $request)
    {
        $id = $request->input('id');
        $user_id = $request->input('user_id');

        if (!$id || !$user_id) {
            return response()->json(["message" => "Los la conversacion y usuario son necesarios"], 404);
        }

        Mensaje::where('conversation_id', $id)
            ->where('user_id', $user_id)
            ->where('is_read', 0)
            ->update([
                'is_read' => 1,
            ]);

        return response()->json(['message' => "Se actualizaron las vistas correctamente"], 201);
    }

    function getConversationIfExists(Request $request)
    {
        $emisor_id = $request->input('emisor_id');
        $receptor_id = $request->input('receptor_id');

        if (!$emisor_id || !$receptor_id) {
            return response()->json(['message' => "El emisor y receptor son necesarios"], 404);
        }

        // Obtener la conversación donde ambos participantes existen
        $conversation = Participante::whereIn('user_id', [$emisor_id, $receptor_id])
            ->select('conversation_id')
            ->groupBy('conversation_id')
            ->havingRaw('COUNT(*) = 2') // Asegurarse de que ambos usuarios están en la misma conversación
            ->first();

        if ($conversation) {
            $conversation = Conversation::find($conversation->conversation_id);
        }

        return response()->json($conversation, 201);
    }
}
