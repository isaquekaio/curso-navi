<?php

namespace App\Http\Controllers;

use App\Models\Papel;
use Illuminate\Http\Request;

class PapelController extends Controller
{
    public function index()
    {
        return response()->json(Papel::all());
    }

    public function show($id)
    {
        $papel = Papel::findOrFail($id);
        return response()->json($papel);
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'papel' => 'request'
        ]);

        $papel = Papel::create($data);
        return response()->json($papel);
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'papel' => 'request'
        ]);
        $papel = Papel::findOrFail($id);
        $papel->update($data);
        return response()->json($papel);
    }

    public function destroy(Papel $papel)
    {
        //
    }
}
