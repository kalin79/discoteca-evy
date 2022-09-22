<?php

namespace App\Http\Controllers;

use App\Http\Filters\Cliente\ClienteFilter;
use App\Mail\RegisterClientNotification;
use App\Models\Cliente;
use App\Models\CodigosCliente;
use App\Models\EventoPromotor;
use App\Traits\ApiResponser;
use App\Traits\QR_BarCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ClienteController extends Controller
{
    use ApiResponser;
    //use QR_BarCode;

    public function index(){
        if( Gate::denies('clientes_management_access') ) {
            return abort(401);
        }
        return view('pages.cliente.index');
    }
    public function load(ClienteFilter $filters){
        $clientes=Cliente::where('active',1)->filterDynamic($filters);
        if(auth()->user()->getRoleId()!=1){
            $clientes = $clientes->where('usuario_registra_id',auth()->user()->promotor_id);
        }
        $clientes = $clientes->orderBy('ingreso', 'DESC')->paginate(20);
        return view('pages.cliente.partials.load',compact('clientes'));
    }

    public function sendNotifactionRegister(Request $request){

        DB::beginTransaction();
        $cliente = null;
        try{
            $cliente_exite = Cliente::where('codigo',$request->codigo)->first();
            if($cliente_exite){
                $row                = new \stdClass();
                $row->msg           = 'El código ya fue registrado';
                $status = 0;
                $code   = 404;
                $data   = $row;

                return $this->apiResponse($status,$code,$data);
            }
            $request['ciudad'] = 'Lima';
            $data = $request->all();
            $cliente=Cliente::create($data);
            $codigo_cliente = CodigosCliente::where('codigo',$cliente->codigo)->first();
            $evento_promotor = EventoPromotor::find($codigo_cliente->evento_promotor_id);
            $cliente->update([
                'evento_id' => $evento_promotor->evento_id,
                'promotor_id' => $evento_promotor->promotor_id,
                'zona_id' => $evento_promotor->zona_id,
                'usuario_registra_id'=>$evento_promotor->promotor_id
            ]);
            $imagen_code = storage_path('app/public/cliente/' . $cliente->id . '/qrcodes/' . $cliente->codigo . '.png');
            $file = null;
            if (!is_file($imagen_code)) {

                Storage::makeDirectory('public/cliente/' . $cliente->id . '/qrcodes/');
                $url = url('admin/cliente/verificar-datos/'.$cliente->id);
                $qr = new QR_BarCode();
                $qr->url($url);
                $qr->qrCode(400,$imagen_code);
                $file = $imagen_code;
                $cliente->update([
                    'imagen_qr' => $cliente->codigo . '.png'
                ]);
            }
            Mail::to($cliente->email)->send(new RegisterClientNotification($cliente,$file));
            DB::commit();
        } catch(\Exception $exc){
            DB::rollBack();
            $status = 0;
            $code   = 500;
            $data   = $exc->getMessage();
            return $this->apiResponse($status,$code,$data);
        }

        $row                = new \stdClass();
        $row->msg           = 'Registro realizado correctamente';
        $row->data          = $cliente;
        $row->promotor      = $cliente->promotor;
        $row->evento        = $cliente->evento;
        $row->zona          = $cliente->zona;
        $status = 1;
        $code   = 201;
        $data   = $row;

        return $this->apiResponse($status,$code,$data);
    }


    public function verificarqr(Request $request,Cliente $cliente){
        return view('pages.cliente.qr',compact('cliente'));
    }

    public function verificarQrStore(Request $request,Cliente $cliente){
        $cliente->update([
            'ingreso' =>1,
            'fecha_ingreso' => date("Y-m-d H:i:s")
        ]);

        return redirect()->route('cliente.gracias.qr');
    }

    public function graciasqr(Request $request){

        return view('pages.cliente.qrgracias');
    }

    public function validarCodigo(Request $request){
        // dd($request->codigo);
        $codigo = CodigosCliente::where('codigo',$request->codigo)->first();

        if($codigo){
            $cliente_exite = Cliente::where('codigo',$request->codigo)->first();
            if($cliente_exite){
                $row                = new \stdClass();
                $row->msg           = 'El código ya fue registrado';
                $status = 0;
                $code   = 404;
                $data   = $row;

                return $this->apiResponse($status,$code,$data);
            }else{
                $row                = new \stdClass();
                $row->msg           = 'Código validado correctamente';

                $status = 1;
                $code   = 200;
                $data   = $row;

                return $this->apiResponse($status,$code,$data);
            }
        }else{
            $row                = new \stdClass();
            $row->msg           = 'El código no existe';
            $status = 0;
            $code   = 404;
            $data   = $row;

            return $this->apiResponse($status,$code,$data);
        }
    }

    public function exportExcel(Request $request){
        //dd($request->evento_id,$filters);

        //$eventos_promotores_ids = EventoPromotor::filterDynamic($filters)->where("evento_id",$request->evento_id)->get()->pluck('id')->toArray();
        //return Excel::download(new CodigoClientesExport($eventos_promotores_ids),'Codigos_'.date('Ymd').'.xlsx');
        //return response()->json(true);
    }
}
