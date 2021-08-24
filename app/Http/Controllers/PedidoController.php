<?php

namespace App\Http\Controllers;

use App\PedidoModel;
use DB;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use Barryvdh\DomPDF\Facade as PDF;
use DomPDF\DomPDF;
use App\Cliente;


class PedidoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $now         = Date::now()->format('l, d F Y'); //fecha para mostrar
        $hist        = date('Y/m/d', time());
        $pedido_dia  = PedidoModel::join('clientes as c', 'cabecera.id_cliente', '=', 'c.id')->where('fecha', '=', $hist)->orderBy('fecha', 'DESC')->paginate();
        $pedido_hist = PedidoModel::join('clientes as c', 'cabecera.id_cliente', '=', 'c.id')->where('fecha', '<=', $hist)->orderBy('fecha', 'DESC')->paginate();

        return view('pedidos.index', compact('pedido_dia', 'pedido_hist', 'now', 'hist'));
    }

    public function show($id)
    {

        $pedidos = DB::table('cabecera as c')->join('detalle as d', 'd.id_cabecera', '=', 'c.id')->join('productos as p', 'd.id_producto', '=', 'p.id')->where('c.id', '=', $id)
        ->select(DB::raw('count(d.id_producto) as cantidad'),'p.nombre','p.valor',DB::raw('count(d.id_producto) * p.valor as total'))
        ->groupBy('d.id_producto')
        ->get();
        $total_final = $pedidos->sum('total');
        // $total_final = $this->zero_fill($total_final,4);
        // dd($total_final);

        return view('pedidos.show', compact('pedidos', 'id','total_final'));
    }

    // public function zero_fill ($valor, $long){
    //     return str_pad($valor, $long, '0', STR_PAD_RIGHT);
    // }

    public function destroy($id)
    {

        $EliminarPedido = PedidoModel::findorfail($id);
        $EliminarPedido->delete();

        return back()->with('mensaje', 'Pedido Eliminado!');
    }

    public function exportPDF($id)
    {
        $pedidos = DB::table('cabecera as c')->join('detalle as d', 'd.id_cabecera', '=', 'c.id')->join('productos as p', 'd.id_producto', '=', 'p.id')->where('c.id', '=', $id)
        ->select(DB::raw('count(d.id_producto) as cantidad'),'p.nombre','p.valor',DB::raw('count(d.id_producto) * p.valor as total'))
        ->groupBy('d.id_producto')
        ->get();
        $total_final = $pedidos->sum('total', 'as decimal(14,2)');
        $pdf = PDF::loadView('pdf.pedidos', compact('pedidos', 'id','total_final'))
        ->setPaper([0,0,340.157,850.394],'portrait'); //12cm x 30cm

        return $pdf->stream("pedido.pdf");
    }

}
