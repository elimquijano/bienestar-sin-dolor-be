<?php

namespace App\Http\Controllers;

use App\Models\Sintoma;
use Illuminate\Http\Request;

class SintomaController extends Controller
{
    public function index()
    {
        $sintomas = Sintoma::all();
        return response()->json($sintomas);
    }

    public function show($id)
    {
        $sintoma = Sintoma::find($id);

        if (!$sintoma) {
            return response()->json(['message' => 'Síntoma no encontrado'], 404);
        }

        return response()->json($sintoma);
    }

    public function store(Request $request)
    {
        $sintoma = Sintoma::create($request->all());
        return response()->json($sintoma, 201);
    }

    public function update(Request $request, $id)
    {
        $sintoma = Sintoma::find($id);

        if (!$sintoma) {
            return response()->json(['message' => 'Síntoma no encontrado'], 404);
        }

        $sintoma->update($request->all());
        return response()->json($sintoma);
    }

    public function destroy($id)
    {
        $sintoma = Sintoma::find($id);

        if (!$sintoma) {
            return response()->json(['message' => 'Síntoma no encontrado'], 404);
        }

        $sintoma->delete();
        return response()->json(['message' => 'Síntoma eliminado con éxito']);
    }

    public function search(Request $request)
    {
        $nombre = $request->input('nombre');
        $descripcion = $request->input('descripcion');
        $paginate = $request->input('paginate') ?? 10;

        $sintomas = Sintoma::query();

        if ($nombre) {
            $sintomas->where('nombre', 'like', '%' . $nombre . '%');
        }

        if ($descripcion) {
            $sintomas->where('descripcion', 'like', '%' . $descripcion . '%');
        }

        $sintomas->orderBy('id', 'desc');

        $sintomas = $sintomas->paginate($paginate);

        return response()->json($sintomas);
    }
}
