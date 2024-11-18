<?php

namespace App\Http\Controllers;

use App\Models\Enfermedad;
use Illuminate\Http\Request;

class EnfermedadController extends Controller
{
    public function index()
    {
        $enfermedades = Enfermedad::all();
        return response()->json($enfermedades);
    }

    public function show($id)
    {
        $enfermedad = Enfermedad::find($id);

        if (!$enfermedad) {
            return response()->json(['message' => 'Enfermedad no encontrada'], 404);
        }

        return response()->json($enfermedad);
    }

    public function store(Request $request)
    {
        $enfermedad = Enfermedad::create($request->all());
        return response()->json($enfermedad, 201);
    }

    public function update(Request $request, $id)
    {
        $enfermedad = Enfermedad::find($id);

        if (!$enfermedad) {
            return response()->json(['message' => 'Enfermedad no encontrada'], 404);
        }

        $enfermedad->update($request->all());
        return response()->json($enfermedad);
    }

    public function destroy($id)
    {
        $enfermedad = Enfermedad::find($id);

        if (!$enfermedad) {
            return response()->json(['message' => 'Enfermedad no encontrada'], 404);
        }

        $enfermedad->delete();
        return response()->json(['message' => 'Enfermedad eliminada con éxito']);
    }

    public function search(Request $request)
    {
        $nombre = $request->input('nombre');
        $sintomas = $request->input('sintomas');
        $paginate = $request->input('paginate') ?? 10;

        $enfermedades = Enfermedad::query();

        if ($nombre) {
            $enfermedades->where('nombre', 'like', '%' . $nombre . '%');
        }

        if ($sintomas) {
            $enfermedades->where('sintomas', 'like', '%' . $sintomas . '%');
        }

        $enfermedades->orderBy('id', 'desc');

        $enfermedades = $enfermedades->paginate($paginate);

        return response()->json($enfermedades);
    }
    public function withSintoma()
    {
        $enfermedades = Enfermedad::with(['sintomas' => function ($query) {
            $query->select('descripcion', 'peso')->orderBy('peso', 'desc');
        }])->orderBy('nombre', 'asc')->get(['id', 'image', 'nombre', 'etiquetas']);

        return response()->json($enfermedades, 201);
    }
}
