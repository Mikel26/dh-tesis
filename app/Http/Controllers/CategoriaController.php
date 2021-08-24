<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoriaModel;

class CategoriaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categorias = CategoriaModel::all();

        return view('categorias.index',compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorias.agregar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required'
        ]);

        $NuevaCategoria = new CategoriaModel;

        $NuevaCategoria->nombre = $request->nombre;

        $NuevaCategoria->save();

        return back()->with('mensaje', 'Categoria Agregada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $EditarCategoria = CategoriaModel::findorfail($id);
        return view('categorias.editar', compact('EditarCategoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required'
        ]);

        $categoriaUpdate = CategoriaModel::findorfail($id);

        $categoriaUpdate->nombre = $request->nombre;

        $categoriaUpdate->save();

        return back()->with('mensaje', 'Categoria Actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $EliminarCategoria = CategoriaModel::findorfail($id);

        $EliminarCategoria->delete();

        return back()->with('mensaje', 'Categoria Eliminada!');
    }
}
