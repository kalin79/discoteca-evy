<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class EventosController extends Controller
{
    public function index()
    {
        if( Gate::denies('evento_management_access') ) {
            return abort(401);
        }
        return view('pages.eventos.index');
        //return new ProductResource(Product::finterAndPaginate(request('q'), request('cat'),$paginate,$from,$promotion_rule_id));
    }

    public function load(){
        $eventos=Evento::whereHas('eventoPromotores')->withCount('eventoPromotores')->paginate(20);
        return view('pages.eventos.partials.load',compact('eventos'));
    }

    public function create(){

        return view('pages.eventos.modals.create');
    }




    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        $data = $request->all();
        Evento::create($data);

        return response()->json(true);
    }

    public function edit(Evento $evento){

        return view('pages.eventos.modals.update',compact('evento'));
    }

    public function update(Request $request,Evento $evento)
    {
        if(!$request->ajax()) return redirect('/');
        $data = $request->all();
        $evento->update($data);

        return response()->json(true);

    }

    public function destroy(Request $request, Evento $evento){
        if(!$request->ajax()) return redirect('/');

        DB::beginTransaction();
        try {

            $evento->delete();

            DB::commit();
        } catch (\Exception $exc) {
            DB::rollBack();

            abort(500);
        }
        return response()->json(["rpt"=>1]);
    }
    public function active(Request $request){
        $evento = Evento::findOrFail($request->id);
        $evento->active = 1;
        if($evento->save()){

            return response()->json(["rpt"=>1]);
        }
    }
    public function desactive(Request $request){
        $evento = Evento::findOrFail($request->id);
        $evento->active = 0;
        if($evento->save()){

            return response()->json(["rpt"=>1]);
        }
    }
}
