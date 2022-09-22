<?php

namespace App\Exports;

use App\Models\CodigosCliente;
use App\Models\Evento;
use App\Models\Promotor;
use App\Models\Zona;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class CodigoClientesExport implements FromView, ShouldAutoSize, WithTitle, WithEvents
{
    var $numref;
    var $evento_promotor_ids;
    public function __construct($eventos_promotores_ids)
    {
        $this->evento_promotor_ids = $eventos_promotores_ids;

    }

    public function view(): View
    {
        $codigos=CodigosCliente::whereIn('evento_promotor_id',$this->evento_promotor_ids)->get();
        $group_by_promotor = $codigos->groupBy(function ($codigo_cliente){
            return $codigo_cliente->eventoProveedor->evento_id."-".$codigo_cliente->eventoProveedor->promotor_id;
        })->map(function($codigo_cliente_data,$key){
            $group_by_zona = $codigo_cliente_data->groupBy(function ($codigo_cliente){
                return $codigo_cliente->eventoProveedor->zona_id;
            })->map(function ($codigos,$key_zona){
                $codigo_data=$codigos->map(function ($code_data){
                    return $code_data->codigo;
                })->toArray();
                return [
                    'zona' => Zona::find($key_zona)->nombre,
                    'codigo' => $codigo_data
                ];
            })->toArray();
            $array_key = explode("-",$key);
            $evento_id = $array_key[0];
            $promotor_id = $array_key[1];
            return [
                'evento' => Evento::find($evento_id)->nombre,
                'promotor' =>Promotor::find($promotor_id)->nombre,
                'zonas'=>$group_by_zona
            ];
        })->toArray();
        $this->numref = count($codigos);

        return view('export.codigo-cliente', [
            'codigos' => $group_by_promotor,
        ]);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        // TODO: Implement title() method.
        return 'Socios' ;
    }
    /**
     * @inheritDoc
     */
    public function registerEvents(): array
    {
        return [
            /*AfterSheet::class => function (AfterSheet $event) {
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],

                    ]
                ];
                $styleArrayCabecera =
                    [
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        ],
                        'fill' => [
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'color' => ['argb' => '007bff']
                        ],
                        'font' => [
                            'bold' => true,
                            'color' => ['argb' => 'FFFFFF']
                        ]
                    ];
                $event->sheet->getDelegate()->getStyle('A1:D1')->applyFromArray($styleArrayCabecera);
                $event->sheet->getDelegate()->getStyle('A1:D' . ($this->numref+1))->applyFromArray($styleArray);


            },*/
        ];
    }
}
