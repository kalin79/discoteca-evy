<?php

namespace App\Http\Controllers;

use App\Exports\ReporteClientePromotorExcel;
use App\Exports\ReporteEventoZonaExcel;
use App\Exports\ReporteGeneralExcel;
use App\Http\Filters\EventoPromotor\EventoPromotorFilter;
use App\Models\Cliente;
use App\Models\Evento;
use App\Models\EventoPromotor;
use App\Models\Promotor;
use App\Models\Zona;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportesController extends Controller
{
    public function index()
    {

        //dd("fd");
        return view('pages.reportes.index');
    }

    public function load(EventoPromotorFilter $filters){


        $datos= EventoPromotor::whereHas('evento')->whereHas('zona')->filterDynamic($filters);
        if(auth()->user()->getRoleId()!=1){
            $datos = $datos->whereHas('promotor',function ($query){
                $query->where('id',auth()->user()->promotor_id);
            });
        }
        $datos=$datos->get()
            ->groupBy(function ($evento_promotor){
                return $evento_promotor->evento->id."-".$evento_promotor->zona->id;
            })->map(function ($evento,$key) {
                //dd($evento,$key);
                $cantidad_codigos= $evento->sum(function ($evento) {
                    return $evento->cantidad_codigos ;
                });

                $array_key = explode('-',$key);
                $evento_id = $array_key[0];
                $zona_id = $array_key[1];
                $cantidad_codigos_registrados = Cliente::where('evento_id',$evento_id)->where('zona_id',$zona_id)->count();
                $cantidad_codigos_ingreso = Cliente::where('evento_id',$evento_id)->where('zona_id',$zona_id)->where('ingreso',1)->count();
                return [
                    'evento' => Evento::find($evento_id)->nombre,
                    'zona'  =>Zona::find($zona_id)->nombre,
                    'cantidad_codigos' => $cantidad_codigos,
                    'cantidad_codigos_registrados' => $cantidad_codigos_registrados,
                    'cantidad_codigos_ingreso' => $cantidad_codigos_ingreso,
                ];
            })->toArray();
        return view('pages.reportes.partials.reporte-general',compact('datos'));
    }

    public function exportExcel(EventoPromotorFilter $filters){
        //dd($filters);
        ini_set("memory_limit", -1);
        //$eventos_promotores_ids = EventoPromotor::filterDynamic($filters)->where("evento_id",$request->evento_id)->get()->pluck('id')->toArray();
        return Excel::download(new ReporteGeneralExcel($filters),'ReporteGeneral_'.time()."_".date('Ymd').'.xlsx');
        //return response()->json(true);
    }


    public function indexEventoZona(){
        $eventos = Evento::all();
        $zonas = Zona::all();
        return view('pages.reportes.index-evento-zona',compact('eventos','zonas'));
    }

    public function loadEventoZona(Request $request){

        //dd($request->all());
        $evento_zonas = EventoPromotor::whereHas('evento')->whereHas('zona')->where('active',1);
        if(isset($request->evento_id)){
            $evento_zonas = $evento_zonas->where('evento_id',$request->evento_id);
        }
        if(isset($request->zona_id)){
            $evento_zonas = $evento_zonas->where('zona_id',$request->zona_id);
        }
        if(auth()->user()->getRoleId()!=1){
            $evento_zonas = $evento_zonas->whereHas('promotor',function ($query){
                $query->where('id',auth()->user()->promotor_id);
            });
        }
        $evento_zonas = $evento_zonas->get();

        return view('pages.reportes.partials.evento-zona',compact('evento_zonas'));
    }
    public function exportEventoZonaExcel(Request $request){
        ini_set("memory_limit", -1);
        return Excel::download(new ReporteEventoZonaExcel($request),'ReporteEventoZona_'.time()."_".date('Ymd').'.xlsx');

    }


    public function indexPromotores(){
        $promotores = Promotor::all();

        return view('pages.reportes.index-cliente-promotor',compact('promotores'));
    }

    public function loadPromotres(Request $request){
        $clientes = Cliente::where('active',1);
        if(isset($request->promotor_id)){
            $clientes = $clientes->where('promotor_id',$request->promotor_id);
        }
        if(auth()->user()->getRoleId()!=1){
            $clientes = $clientes->where('usuario_registra_id',auth()->user()->promotor_id);
        }

        $clientes = $clientes->get();

        return view('pages.reportes.partials.cliente-promotor',compact('clientes'));
    }

    public function exportClientePromotorExcel(Request $request){
        ini_set("memory_limit", -1);
         return Excel::download(new ReporteClientePromotorExcel($request),'ReporteClientes_'.time()."_".date('Ymd').'.xlsx');

    }


    public function getListZonas(Request $request){
        $zonas = EventoPromotor::where('evento_id', $request->evento_id)->get()->map(function ($evento_promotor){
            return [
                'id' =>$evento_promotor->zona_id,
                'nombre' => $evento_promotor->zona->nombre
            ];
        });
        //dd($zonas);
        return view('pages.reportes.partials.list-zonas',compact('zonas'));
    }
}
