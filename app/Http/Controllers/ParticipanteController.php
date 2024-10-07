<?php

namespace App\Http\Controllers;

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
        $id = $request->input('form_id');
        $paginate = $request->input('paginate') ?? 10;

        $participantes = Participante::query();

        if ($id) {
            $participantes->where('id', 'like', "%$id%");
        }
        $participantes->orderBy('id', 'desc');

        $participantes = $participantes->paginate($paginate);

        return response()->json($participantes);
    }
}
