<?php

namespace App\Http\Controllers;

use App\Exports\SociosExport;
use App\Http\Enums\TypeUbicacion;
use App\Http\Filters\Socio\SocioFilter;
use App\Imports\SociosImport;
use App\Models\Evento;
use App\Models\Promotor;
use App\Models\Socio;
use App\Models\Tipos;
use App\Traits\QR_BarCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use function Sodium\compare;

class SociosController extends Controller
{
    public function index()
    {
        if( Gate::denies('socios_management_access') ) {
            return abort(401);
        }
        return view('pages.socios.index');
        //return new ProductResource(Product::finterAndPaginate(request('q'), request('cat'),$paginate,$from,$promotion_rule_id));
    }

    public function load(SocioFilter $filters){

        $clientes=Socio::where('active',1)->filterDynamic($filters);
        if(auth()->user()->getRoleId()!=1){
            $clientes = $clientes->where('promotor_id',auth()->user()->promotor_id);
        }
        $clientes = $clientes->orderBy('created_at','desc')->paginate(20);
        return view('pages.socios.partials.load',compact('clientes'));
    }

    public function create(){
        $ubicaciones = Tipos::byMasterId(TypeUbicacion::master())->get();
        $promotores = Promotor::all();
        $eventos = Evento::where('active',1)->get();
        // return view('pages.socios.modals.create',compact('ubicaciones','promotores','eventos'));
        return view('pages.socios.modals.create',compact('ubicaciones','promotores'));
    }


    public function verificarqr(Request $request,Socio $socio){
        return view('pages.socios.qr',compact('socio'));
    }

    public function verificarQrStore(Request $request,Socio $socio){
        $socio->update([
            'ingreso' =>1,
            'fecha_ingreso' => date("Y-m-d H:i:s")
        ]);

        return redirect()->route('socio.gracias.qr');
    }

    public function graciasqr(Request $request){
        return view('pages.socios.qrgracias');
    }


    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $request['tipo_ubicacion_id'] = TypeUbicacion::DISCOTECA;
        $data = $request->all();

        $socio = Socio::create($data);
        $codigo = strtoupper(substr($socio->nombres,0,3)) ."-".strtoupper(substr($socio->apellidos,0,3));
        $codigo.= "-".uniqueKey(8,true,false,true);
        $codigo.= "-".uniqueKey(4,true,false,true);
        $codigo.= "-".uniqueKey(4,true,false,true);
        $codigo.= "-".uniqueKey(12,true,false,true);
        $socio->update([
            'codigo'=>$codigo
        ]);
        $imagen_code = storage_path('app/public/socios/' . $socio->id . '/qrcodes/' . $socio->codigo . '.png');
        $file = null;
        if (!is_file($imagen_code)) {

            Storage::makeDirectory('public/socios/' . $socio->id . '/qrcodes/');
            $url = url('admin/socio/verificar-datos/'.$socio->id);
            $qr = new QR_BarCode();
            $qr->url($url);
            $qr->qrCode(400,$imagen_code);
            $socio->update([
                'imagen_qr' => $socio->codigo . '.png'
            ]);
        }
        return response()->json(true);
    }

    public function edit(Socio $socio){
        $ubicaciones = Tipos::byMasterId(TypeUbicacion::master())->get();
        $promotores = Promotor::all();
        $eventos = Evento::where('active',1)->get();
        return view('pages.socios.modals.update',compact('socio','ubicaciones','promotores','eventos'));
    }

    public function update(Request $request,Socio $socio)
    {
        if(!$request->ajax()) return redirect('/');
        $data = $request->all();
        $socio->update($data);

        return response()->json(true);

    }

    public function destroy(Request $request, Socio $socio){
        if(!$request->ajax()) return redirect('/');

        DB::beginTransaction();
        try {

            $socio->delete();

            DB::commit();
        } catch (\Exception $exc) {
            DB::rollBack();

            abort(500);
        }
        return response()->json(["rpt"=>1]);
    }
    public function active(Request $request){
        $socio = Socio::findOrFail($request->id);
        $socio->active = 1;
        if($socio->save()){

            return response()->json(["rpt"=>1]);
        }
    }
    public function desactive(Request $request){
        $socio = Socio::findOrFail($request->id);
        $socio->active = 0;
        if($socio->save()){

            return response()->json(["rpt"=>1]);
        }
    }

    public function formImport(){
        $eventos = Evento::where('active',1)->get();
        return view('pages.socios.modals.import-excel',compact('eventos'));
    }

    public function  importSave(Request $request){
        ini_set("memory_limit", -1);
        // $import = new SociosImport($request->evento_id);
        $import = new SociosImport();
        // dd($request->file('file-excel'));
        $a = Excel::toArray($import, $request->file('file_excel'));
        $import->array($a);
        return response()->json(true);
    }

    public function exportExcel(SocioFilter $filters){
        //dd($filters);
        ini_set("memory_limit", -1);
        //$eventos_promotores_ids = EventoPromotor::filterDynamic($filters)->where("evento_id",$request->evento_id)->get()->pluck('id')->toArray();
        return Excel::download(new SociosExport($filters),'Socios_'.time()."_".date('Ymd').'.xlsx');
        //return response()->json(true);
    }
}
