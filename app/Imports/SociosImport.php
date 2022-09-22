<?php

namespace App\Imports;

use App\Http\Enums\TypeUbicacion;
use App\Models\Promotor;
use App\Models\Socio;
use App\Traits\QR_BarCode;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToArray;
class SociosImport implements ToArray
{
    private $rows = 0;
    public $response = ["result" => 1, "message" => ''];

    var $evento_id;
    public function __construct()
    {
        // $this->evento_id = $eventoId;

    }
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        //
    }
    public function array(array $array)
    {
        $products = $array[0];

        foreach ($products as $line => $product) {

            if ($line > 0) {

                $nombre = $product[0];
                $codigo = trim($product[1]);
                $dni_promotor = trim($product[2]);

                //dd($nombre,$codigo);
                if($codigo){
                    $obCliente = Socio::where('codigo', $codigo)->first();

                    if (!$obCliente) {
                        $promotor_id = null;
                        if($dni_promotor){
                            $promotor = Promotor::where('dni',$dni_promotor)->first();
                            if(!$promotor){
                                $dni_promotor = '00000001';
                            }else{
                                $promotor_id = $promotor->id;
                            }
                        }else{
                            $dni_promotor = '00000001';
                        }

                        $array_data_cliente = [
                            'nombres'=>$nombre,
                            'codigo' => $codigo,
                            'dni_promotor'=> $dni_promotor,
                            'promotor_id' =>$promotor_id,
                            'tipo_ubicacion_id' => TypeUbicacion::TERRAZA,
                            'usuario_registra_id' => auth()->user()->id,
                            // 'evento_id'            =>$this->evento_id
                        ];
                        $socio = Socio::create($array_data_cliente);
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
                    }


                    ++$this->rows;
                }

            }
        }


        /*DB::commit();

        $this->response = ["result" => 1, "message" => ""];

    } catch (\Exception $e) {
        DB::rollback();
        $this->response = ["result" => 0, "message" => "No se pudo realizar la importación: ".$e->getMessage()];
        return false;
    }*/



    }

    public function getRowCount(): int
    {
        return $this->rows;
    }
}
