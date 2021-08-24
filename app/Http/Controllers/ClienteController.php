<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.lista',compact('clientes'));
    }

 
    public function create()
    {
        return view('clientes.agregar');
    }


    public function store(Request $request)
    {
  

        $request->validate([
            'cedula' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'correo' => 'required',
            'direccion' => 'required',
            'telefono' => 'required'
        ]);

        $NuevoCliente = new Cliente;

        $NuevoCliente->cedula = $request->cedula;
        $NuevoCliente->nombre = $request->nombre;
        $NuevoCliente->apellido = $request->apellido;
        $NuevoCliente->correo = $request->correo;
        $NuevoCliente->direccion = $request->direccion;
        $NuevoCliente->telefono = $request->telefono;



        $NuevoCliente->save();

        return back()->with('mensaje', 'Cliente Agregado!');
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $EditarCliente = Cliente::findorfail($id);
        return view('clientes.editar', compact('EditarCliente'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cedula' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'correo' => 'required',
            'direccion' => 'required',
            'telefono' => 'required'
        ]);

        $clienteUpdate = Cliente::findorfail($id);

        $clienteUpdate->cedula = $request->cedula;
        $clienteUpdate->nombre = $request->nombre;
        $clienteUpdate->apellido = $request->apellido;
        $clienteUpdate->correo = $request->correo;
        $clienteUpdate->direccion = $request->direccion;
        $clienteUpdate->telefono = $request->telefono;

        $clienteUpdate->save();

        return back()->with('mensaje', 'Cliente Actualizado!');
    }


    public function destroy($id)
    {
        $EliminarCliente = Cliente::findorfail($id);

        $EliminarCliente->delete();

        return back()->with('mensaje', 'Cliente Eliminado!');
    }
}
