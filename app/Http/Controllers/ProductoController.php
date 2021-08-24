<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\CategoriaModel;
use Illuminate\Support\Facades\Input;
use File;
use Image;
use DB;
use Auth;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $productos = Producto::all();

        return view('productos.index',compact('productos'));
    }

    public function create()
    {
        $Categoria = CategoriaModel::all();
        return view('productos.agregar', compact( 'Categoria'));

    }

    public function store(Request $request)
    {

        // $request->validate([
        //     'codigo' => 'required',
        //     'nombre' => 'required',
        //     'valor' => 'required',
        //     'id_categoria' => 'required'
        // ]);

        // dd($request);
        // DB::beginTransaction();
        // try {

            $NuevoProducto = new Producto;


            $NuevoProducto->codigo = $request->codigo;
            $NuevoProducto->nombre = $request->nombre;
            $NuevoProducto->valor = $request->valor;
            $NuevoProducto->id_categoria = $request->categoriaProducto;
            // dd($NuevoProducto);
            $NuevoProducto->save();
            $foto = Input::file('imagen_producto');

            if (Input::hasFile('imagen_producto')) {
                $nombre_imagen=str_random(4).$NuevoProducto->id.str_random(4);
                $NuevoProducto->imagen ='/images/imagenes_Productos/'.$nombre_imagen.'.'.$foto->getClientOriginalExtension();
                $foto->move(public_path() .'/images/imagenes_Productos/',$nombre_imagen.'.'.$foto->getClientOriginalExtension());
            }

            $NuevoProducto->save();
            // DB::commit();
        // } catch (Exception $e) {
            // DB::rollBack();
        // }
        

        return back()->with('mensaje', 'Producto Agregado!');
    }


    public function edit($id)
    {
        $EditarProducto = Producto::findorfail($id);
        $Categoria = CategoriaModel::all();
        return view('productos.editar', compact('EditarProducto' , 'Categoria'));
    }

    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'codigo' => 'required',
        //     'nombre' => 'required',
        //     'valor' => 'required',
        //     'id_categoria' => 'required',
        // ]);
        // dd($request);

        $productoUpdate = Producto::find($id);
        // dd($productoUpdate);

        $productoUpdate->codigo = $request->codigo;
        $productoUpdate->nombre = $request->nombre;
        $productoUpdate->valor = $request->valor;
        $productoUpdate->id_categoria = $request->categoriaProducto;

        // dd($productoUpdate);

        $productoUpdate->save();

        return back()->with('mensaje', 'Producto Actualizado!'); 
    } 

    public function destroy($id)
    {
        $EliminarProducto = Producto::findorfail($id);

        $EliminarProducto->delete();

        return back()->with('mensaje', 'Producto Eliminado!');
    }

    
    public function cambiarEstado(Request $request)
    {
        $CambioEstado = Producto::findorfail($request->estadoID);
        
        if ($CambioEstado->estado == 0 ) {
            $CambioEstado->estado = 1;
        } else {
            $CambioEstado->estado = 0;
        }

        
        $CambioEstado->update();

        return back();

    }
}
