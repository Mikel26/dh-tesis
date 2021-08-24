<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReporteModel;
use Barryvdh\DomPDF\Facade as PDF;
use Jenssegers\Date\Date;
use DomPDF\DomPDF;
use DB;

class ReporteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $fechaInicio = $request->get('rptDiaInicio');
        $fechaFin = $request->get('rptDiaFin');
        $valFF = date('Y-m-d', time());
        $now = date('Y/m/d', time());

        if (empty($fechaFin) && empty($fechaInicio))  {
            $now = date('Y/m/d', time());
            $rptAll = ReporteModel::where('fecha', '=', $now)->get();
            $total = ReporteModel::where('fecha', '=', $now)->select(DB::raw('sum(total) as total'))->get();
        } else{
            $rptAll = ReporteModel::whereBetween('fecha', [$fechaInicio, $fechaFin])->orderBy('fecha', 'ASC')->get();
            $total = ReporteModel::select(DB::raw('sum(total) as total'))->whereBetween('fecha', [$fechaInicio, $fechaFin])->get();
        }
        $total = $total[0];

        return view('reportes.lista', compact('rptAll','total','fechaInicio','fechaFin', 'valFF'));

    }

    public function exportPDF($fechaInicio, $fechaFin)
    {
        Date::setLocale('es');
        if (empty($fechaFin) && empty($fechaInicio))  {
            $now = date('Y/m/d', time());
            $fecha = date('d/m/Y', time());
            $reportePDF = ReporteModel::where('fecha', '=', $now)->get();
            $total = ReporteModel::where('fecha', '=', $now)->select(DB::raw('sum(total) as total'))->get();
        } else{
            $reportePDF = ReporteModel::whereBetween('fecha', [$fechaInicio, $fechaFin])->orderBy('fecha', 'ASC')->get();
            $total = ReporteModel::select(DB::raw('sum(total) as total'))->whereBetween('fecha', [$fechaInicio, $fechaFin])->get();
        }

        $total = $total[0];
        $fechaInicioL = Date::parse($fechaInicio)->format('l, d F Y');
        $fechaFinL = Date::parse($fechaFin)->format('l, d F Y');
        $pdf = PDF::loadView('pdf.reportes', compact('reportePDF','fechaInicioL', 'fechaFinL','total'));

        return $pdf->download('Reporte_Ventas_DH.pdf');
    }

}
