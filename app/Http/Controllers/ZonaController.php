<?php

namespace App\Http\Controllers;

use App\Models\EventoPromotor;
use App\Models\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ZonaController extends Controller
{
    public function index()
    {
        if( Gate::denies('zona_management_access') ) {
            return abort(401);
        }
        return view('pages.zona.index');
        //return new ProductResource(Product::finterAndPaginate(request('q'), request('cat'),$paginate,$from,$promotion_rule_id));
    }

    public function load(){
        $zonas=Zona::paginate(20);
        return view('pages.zona.partials.load',compact('zonas'));
    }

    public function create(){

        return view('pages.zona.modals.create');
    }




    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        $data = $request->all();
        $zona = Zona::create($data);

        return response()->json(true);
    }

    public function edit(Zona $zona){

        return view('pages.zona.modals.update',compact('zona'));
    }

    public function update(Request $request,Zona $zona)
    {
        if(!$request->ajax()) return redirect('/');
        $data = $request->all();
        $zona->update($data);

        return response()->json(true);

    }

    public function destroy(Request $request, Zona $zona){
        if(!$request->ajax()) return redirect('/');

        DB::beginTransaction();
        try {
            $evento_promotor_count = EventoPromotor::where('zona_id',$zona->id)->count();
            //dd($evento_promotor_count);
            if($evento_promotor_count>0){
                return  response()->json(['errors'=>'La zona ya se encuentra asignado a un evento.'],422);
            }
            $zona->delete();

            DB::commit();
        } catch (\Exception $exc) {
            DB::rollBack();

            abort(500);
        }
        return response()->json(["rpt"=>1]);
    }
    public function active(Request $request){
        $zona = Zona::findOrFail($request->id);
        $zona->active = 1;
        if($zona->save()){

            return response()->json(["rpt"=>1]);
        }
    }
    public function desactive(Request $request){
        $zona = Zona::findOrFail($request->id);
        $zona->active = 0;
        if($zona->save()){

            return response()->json(["rpt"=>1]);
        }
    }
}
