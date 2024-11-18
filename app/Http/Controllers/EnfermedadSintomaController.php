<?php

namespace App\Http\Controllers;

use App\Models\EnfermedadSintoma;
use Illuminate\Http\Request;

class EnfermedadSintomaController extends Controller
{
    public function index()
    {
        $enfermedadSintomas = EnfermedadSintoma::all();
        return response()->json($enfermedadSintomas);
    }

    public function show($id)
    {
        $enfermedadSintoma = EnfermedadSintoma::find($id);

        if (!$enfermedadSintoma) {
            return response()->json(['message' => 'Relación Enfermedad-Síntoma no encontrada'], 404);
        }

        return response()->json($enfermedadSintoma);
    }

    public function store(Request $request)
    {
        $enfermedadSintoma = EnfermedadSintoma::create($request->all());
        return response()->json($enfermedadSintoma, 201);
    }

    public function update(Request $request, $id)
    {
        $enfermedadSintoma = EnfermedadSintoma::find($id);

        if (!$enfermedadSintoma) {
            return response()->json(['message' => 'Relación Enfermedad-Síntoma no encontrada'], 404);
        }

        $enfermedadSintoma->update($request->all());
        return response()->json($enfermedadSintoma);
    }

    public function destroy($id)
    {
        $enfermedadSintoma = EnfermedadSintoma::find($id);

        if (!$enfermedadSintoma) {
            return response()->json(['message' => 'Relación Enfermedad-Síntoma no encontrada'], 404);
        }

        $enfermedadSintoma->delete();
        return response()->json(['message' => 'Relación Enfermedad-Síntoma eliminada con éxito']);
    }

    public function search(Request $request)
    {
        $enfermedadId = $request->input('enfermedad_id');
        $sintomaId = $request->input('sintoma_id');
        $paginate = $request->input('paginate') ?? 10;

        $enfermedadSintomas = EnfermedadSintoma::query();

        if ($enfermedadId) {
            $enfermedadSintomas->where('enfermedad_id', $enfermedadId);
        }

        if ($sintomaId) {
            $enfermedadSintomas->where('sintoma_id', $sintomaId);
        }

        $enfermedadSintomas->orderBy('id', 'desc');

        $enfermedadSintomas = $enfermedadSintomas->paginate($paginate);

        return response()->json($enfermedadSintomas);
    }
}
