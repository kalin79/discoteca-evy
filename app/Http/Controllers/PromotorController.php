<?php

namespace App\Http\Controllers;

use App\Models\EventoPromotor;
use App\Models\Promotor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class PromotorController extends Controller
{
    public function index()
    {
        if( Gate::denies('promotor_management_access') ) {
            return abort(401);
        }
        return view('pages.promotor.index');
        //return new ProductResource(Product::finterAndPaginate(request('q'), request('cat'),$paginate,$from,$promotion_rule_id));
    }

    public function load(){
        $promotores=Promotor::paginate(20);
        return view('pages.promotor.partials.load',compact('promotores'));
    }

    public function create(){

        return view('pages.promotor.modals.create');
    }




    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        $data = $request->all();
        $promotor=Promotor::create($data);
        $user =User::create([
            'name'=>$promotor->nombre,
            'email' => $promotor->email,
            'password' => bcrypt('123Armoni@'),
            'active' => 1,
            'promotor_id' =>$promotor->id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),

        ]);
        $user->role()->sync([2]);

        return response()->json(true);
    }

    public function edit(Promotor $promotor){

        return view('pages.promotor.modals.update',compact('promotor'));
    }

    public function update(Request $request,Promotor $promotor)
    {
        if(!$request->ajax()) return redirect('/');
        $data = $request->all();
        $promotor->update($data);

        return response()->json(true);

    }

    public function destroy(Request $request, Promotor $promotor){
        if(!$request->ajax()) return redirect('/');

        DB::beginTransaction();
        try {
            $evento_promotor_count = EventoPromotor::where('promotor_id',$promotor->id)->count();
            //dd($evento_promotor_count);
            if($evento_promotor_count>0){
                return  response()->json(['errors'=>'El promotor ya se encuentra asignado a un evento.'],422);
            }


            $promotor->delete();

            DB::commit();
        } catch (\Exception $exc) {
            DB::rollBack();

            abort(500);
        }
        return response()->json(["rpt"=>1]);
    }
    public function active(Request $request){
        $promotor = Promotor::findOrFail($request->id);
        $promotor->active = 1;
        if($promotor->save()){

            return response()->json(["rpt"=>1]);
        }
    }
    public function desactive(Request $request){
        $promotor = Promotor::findOrFail($request->id);
        $promotor->active = 0;
        if($promotor->save()){

            return response()->json(["rpt"=>1]);
        }
    }
}
