<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Radiografia;
use Illuminate\Http\Request;

class RadiografiaController extends Controller
{
    public function store(Request $request)
    {
        $radiografia = new Radiografia($request->all());
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . "-" . $file->getClientOriginalName();
            $destinationPath = public_path('images/radiografia');
            $radiografia->image = 'images/radiografia/' . $filename;
        }
        $radiografia->save();
        $file->move($destinationPath, $filename);

        return response()->json($radiografia, 201);
    }

    public function search(Request $request){
        $user_id = $request->input('form_user_id');
        $paginate = $request->input('paginate')??10;

        $radiografias = Radiografia::query();
        if($user_id){
            $radiografias->where('user_id', '=', $user_id);
        }
        $radiografias->orderBy('id', 'desc');
        $radiografias = $radiografias->paginate($paginate);

        return response()->json($radiografias, 200);
    }
}
