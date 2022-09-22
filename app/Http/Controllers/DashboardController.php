<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Evento;
use App\Models\EventoPromotor;
use App\Models\Zona;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        //dd("fd");
        return view('pages.dashboard.index');
    }

    public function load(Request $request){
        $datos= EventoPromotor::where('evento_id',1)->get()
            ->groupBy(function ($evento_promotor){
                return $evento_promotor->evento->id."-".$evento_promotor->zona->id;
            })->map(function ($evento,$key) {
                //dd($evento,$key);
                $cantidad_codigos= $evento->sum(function ($evento) {
                    return $evento->zona->cantidad_codigos ;
                });

                $array_key = explode('-',$key);
                $evento_id = $array_key[0];
                $zona_id = $array_key[1];
                $cantidad_codigos_registrados = Cliente::where('evento_id',$evento_id)->where('zona_id',$zona_id)->count();
                $cantidad_codigos_ingreso = Cliente::where('evento_id',$evento_id)->where('zona_id',$zona_id)->where('ingreso',1)->count();
                return [
                    'evento' => Evento::find($evento_id)->nombre." - ". Zona::find($zona_id)->nombre,
                    'cantidad_codigos' => $cantidad_codigos,
                    'cantidad_codigos_registrados' => $cantidad_codigos_registrados,
                    'cantidad_codigos_ingreso' => $cantidad_codigos_ingreso,
                ];
            })->toArray();

        //dd($datos);
        $view = view('pages.dashboard.partials.reporte-general',compact('datos'));
    }

    private function reporteCantCodigosPorPromotorLoad($fechan_inicio, $fecha_fin)
    {
        //dd($fechan_inicio);
        $datos= EventoPromotor::where('evento_id',1)->get()
            ->groupBy(function ($evento_promotor){
                return $evento_promotor->evento->id."-".$evento_promotor->zona->id;
        })->map(function ($evento,$key) {
            //dd($evento,$key);
                $cantidad_codigos= $evento->sum(function ($evento) {
                    return $evento->zona->cantidad_codigos ;
                });

                $array_key = explode('-',$key);
                $evento_id = $array_key[0];
                $zona_id = $array_key[1];
                $cantidad_codigos_registrados = Cliente::where('evento_id',$evento_id)->where('zona_id',$zona_id)->count();
                $cantidad_codigos_ingreso = Cliente::where('evento_id',$evento_id)->where('zona_id',$zona_id)->where('ingreso',1)->count();
                return [
                    'evento' => Evento::find($evento_id)->nombre." - ". Zona::find($zona_id)->nombre,
                    'cantidad_codigos' => $cantidad_codigos,
                    'cantidad_codigos_registrados' => $cantidad_codigos_registrados,
                    'cantidad_codigos_ingreso' => $cantidad_codigos_ingreso,
                ];
            })->toArray();

        //dd($datos);
        $view = view('pages.dashboard.partials.reporte-general',compact('datos'));

        return [
            'view' => $view->render(),
            /*'config_graph' => [
                'labels' => $array_proyectos,
                'backgroundColor' => $array_colors,
                'count' => $array_medidas
            ]*/
        ];
    }

    private function reportePorTiposMedidaLoad($proyecto_ids, $anio)
    {
        $query = MedidasDisciplinarias::leftJoin('rh_categorias_sanciones', 'rh_categorias_sanciones.id', '=', 'rh_medidas_disciplinarias.sancion_id')
            ->select('rh_categorias_sanciones.descripcion', 'rh_categorias_sanciones.id as sancion_id',
                DB::raw('MONTH(fecha) as mes'), DB::raw('count(*) as total'))
            ->byAnio($anio);

        if($proyecto_ids[0] != 0){
            $query = $query->byOperaciones($proyecto_ids);
        }
        $queryResult = $query->groupBy(DB::raw('MONTH(fecha)'))
            ->groupBy('sancion_id')
            ->orderBy(DB::raw('MONTH(fecha)'))->get();

        $total = $queryResult->sum('total');
        $mes_ids = $queryResult->pluck('mes')->unique()->toArray();
        $sancion_ids = $queryResult->pluck('sancion_id')->unique()->toArray();

        foreach($sancion_ids as $id)
        {
            $descripcion = Sanciones::find($id)->descripcion;
            $array_sanciones[$id]['id'] = $id;
            $array_sanciones[$id]['nombre'] = $descripcion;
            $array_sanciones[$id]['total'] = 0;
        }

        $labelMeses = [];
        foreach($mes_ids as $id)
        {
            $array_meses[$id]['id'] = $id;
            $array_meses[$id]['total'] = 0;
            $labelMeses[] = mes_castellano($id);
        }

        $data = [];
        foreach($queryResult as $row)
        {
            $data[$row->mes]['mes_id'] = $row->mes;
            $data[$row->mes]['mes_nombre'] = mes_castellano($row->mes);
            $data[$row->mes]['sanciones'][$row->sancion_id]['sancion_id'] = $row->sancion_id;
            $data[$row->mes]['sanciones'][$row->sancion_id]['total'] = $row->total;
            $array_sanciones[$row->sancion_id]['total']+= $row->total;
            $array_meses[$row->mes]['total']+= $row->total;
        }

        $graphic_info = [];
        $i=0;
        foreach($sancion_ids as $sid)
        {
            foreach($mes_ids as $mid)
            {
                $graphic_info[$i]['data'][] = isset($data[$mid]['sanciones'][$sid]) ? $data[$mid]['sanciones'][$sid]['total'] : 0;
            }
            $graphic_info[$i]['label'] = $array_sanciones[$sid]['nombre'];
            $graphic_info[$i]['backgroundColor'] = 'rgba(' . rand(0, 255) . ', ' . rand(0, 255) . ', ' . rand(0, 255) . ', 0.70)';
            $i++;
        }

        $view = view('Rrhh::medidas-disciplinarias.reports.partials.tipos-medidas-load',
            compact('data', 'array_meses', 'array_sanciones', 'total'));

        return [
            'view' => $view->render(),
            'config_graph' => [
                'labels' => $labelMeses,
                'info' => $graphic_info
            ]
        ];
    }

    private function reportePorMateriasLoad($proyecto_ids, $anio)
    {
        $query = MedidasDisciplinarias::leftJoin('tipos', 'tipos.id', '=', 'rh_medidas_disciplinarias.materia_id')
            ->select('tipos.nombre', DB::raw('count(*) as total'))
            ->byAnio($anio);
        if($proyecto_ids[0] != 0){
            $query = $query->byOperaciones($proyecto_ids);
        }
        $data = $query->groupBy('materia_id')->get();

        $total = $data->sum('total');
        $view = view('Rrhh::medidas-disciplinarias.reports.partials.tipos-materias-load',compact('data','total'));

        foreach($data as $materia)
        {
            $array_materias[] = $materia->nombre;
            $array_colors[] = 'rgba(' . rand(0, 255) . ', ' . rand(0, 255) . ', ' . rand(0, 255) . ', 0.70)';
            $array_medidas[] = $materia->total;
        }

        return [
            'view' => $view->render(),
            'config_graph' => [
                'labels' => $array_materias,
                'backgroundColor' => $array_colors,
                'count' => $array_medidas
            ]
        ];
    }
}
