<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;

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
}
