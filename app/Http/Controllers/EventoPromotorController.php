<?php

namespace App\Http\Controllers;

use App\Exports\CodigoClientesExport;
use App\Http\Filters\EventoPromotor\EventoPromotorFilter;
use App\Mail\CodigoToPromotorNotification;
use App\Models\CodigosCliente;
use App\Models\Evento;
use App\Models\EventoPromotor;
use App\Models\Promotor;
use App\Models\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class EventoPromotorController extends Controller
{
    public function index(Evento $evento){
        if( Gate::denies('evento_management_access') ) {
            return abort(401);
        }

        return view('pages.eventos.detalle.index',compact('evento'));
    }
    public function load(EventoPromotorFilter $filters,Request $request,Evento $evento){

        if(!$request->ajax()) return redirect('/');

        $evento_promotores = $evento->eventoPromotores()->filterDynamic($filters)->orderBy('created_at', 'asc')->paginate(10);
        //dd($evento_promotores);
        return view('pages.eventos.detalle.partials.load',compact('evento_promotores'));
    }

    public function create(Evento $evento){
        $promotores = Promotor::all();
        $zonas = Zona::all();
        return view('pages.eventos.detalle.modals.create',compact('evento','promotores','zonas'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if(!$request->ajax()) return redirect('/');
        DB::beginTransaction();
        try {

            $evento_promoto = EventoPromotor::create($request->all());
            $count_codigos = $evento_promoto->cantidad_codigos;
            for ($i=0; $i<$count_codigos;$i++){
                CodigosCliente::create(
                    [
                        'evento_promotor_id'=> $evento_promoto->id,
                        'codigo' => uniqueKey(8,true,true,false)
                    ]
                );
            }
            $promotor = Promotor::find($request->promotor_id);
            $evento = Evento::find($request->evento_id);
            if($promotor->email){
                Mail::to($promotor->email)->send(new CodigoToPromotorNotification($promotor,$evento,$evento_promoto));
            }

            DB::commit();
        } catch (\Exception $exc) {
            DB::rollBack();
            dd($exc->getMessage());
            abort(500);
        }
        return response()->json($evento_promoto,201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(EventoPromotor $evento_promotor){

        return view('pages.eventos.detalle.modals.update',compact('evento_promotor'));
    }
    public function update(Request $request,EventoPromotor $evento_promotor)
    {
        if(!$request->ajax()) return redirect('/');
        DB::beginTransaction();
        try {
            //dd($request->all());
            $evento_promotor->update($request->all());


            DB::commit();
        } catch (Exception $exc) {
            DB::rollBack();
            abort(500);
        }
        /*$post_route = route('admin.noticia.relacionada.index',$producto_plan->product_id);
        session()->flash('message', 'Los registros se actualizaron satisfactoriamente.');*/

        return response()->json($evento_promotor,202);

    }

    public function desactive(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $evento_promotor = EventoPromotor::findOrFail($request->id);
        $evento_promotor->active = false;
        if($evento_promotor->save()){
            return response()->json(["rpt"=>1]);
        }
    }

    public function active(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $evento_promotor = EventoPromotor::findOrFail($request->id);
        $evento_promotor->active = true;
        if($evento_promotor->save()){
            return response()->json(["rpt"=>1]);
        }
    }

    public function destroy(Request $request, EventoPromotor $evento_promotor){
        if(!$request->ajax()) return redirect('/');

        DB::beginTransaction();
        try {

            $evento_promotor->delete();
            $evento_promotor->codigos()->delete();
            DB::commit();
        } catch (Exception $exc) {
            DB::rollBack();

            abort(500);
        }
        return response()->json(["rpt"=>1]);
    }


    public function exportCodigos(EventoPromotor $evento_promotor){
        //dd($request->all());
        return Excel::download(new CodigoClientesExport([$evento_promotor->id]),'Codigos_'.date('Ymd').'.xlsx');
        //return response()->json(true);
    }

    public function exportCodigoPromotor(EventoPromotorFilter $filters,Request $request){
        //dd($request->evento_id,$filters);

        $eventos_promotores_ids = EventoPromotor::filterDynamic($filters)->where("evento_id",$request->evento_id)->get()->pluck('id')->toArray();
        return Excel::download(new CodigoClientesExport($eventos_promotores_ids),'Codigos_'.time()."_".date('Ymd').'.xlsx');
        //return response()->json(true);
    }



    public function listPromotoresFiltro(){
        $promotores = Promotor::all();
        return response()->json($promotores);
    }
}
