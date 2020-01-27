<?php

namespace App\Http\Controllers;

use App\Models\Projeto;
use Illuminate\Http\Request;

class ProjetoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->has('limit') ? $request->input('limit') : 20;
        //dd($request->all());
        return Projeto::orderBy('titulo')
            ->when($request->has('include'), function ($query) use ($request) {
                if(in_array('gerente', $request->input('include')))
                {
                    $query->with('gerente');
                }

            })
            ->paginate($limit);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'titulo' => 'required',
            'gerente_id' => 'required | integer | exists:users,id',
        ]);

        return Projeto::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $projeto = Projeto::findOrFail($id);
        if(in_array('gerente', $request->input('include') ?? []))
        {
            $projeto->load('gerente');
        }
        return $projeto;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Projeto  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $data = $this->validate($request, [
            'titulo' => 'sometimes | required',
            'gerente_id' => 'sometimes | required | integer | exists:users,id',
        ]);

        $projeto = Projeto::findOrFail($id);
        $projeto->update($data);
        return $projeto;
    }

    //Outra forma de fazer, se utilizar o model passando como paramentro e dipensado o uso do find.
    /*
    public function update(Request $request, Projeto $id)
    {
        $data = $this->validate($request, [
            'titulo' => 'sometimes | required',
            'gerente_id' => 'sometimes | required | integer | exists:users,id',
        ]);

        $projeto->update($data);
        return $projeto;
    }
    */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $projeto = Projeto::findOrFail($id);
            $projeto->delete();

            return response()->json([
                'success' => true,
            ]);
        }catch(\Exception $ext){
            return response()->json([
                'success' => false,
                'exception' => $ext->getMessage(),
            ]);
        }
    }
}
