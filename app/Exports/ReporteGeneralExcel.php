<?php

namespace App\Exports;

use App\Models\Cliente;
use App\Models\CodigosCliente;
use App\Models\Evento;
use App\Models\EventoPromotor;
use App\Models\Promotor;
use App\Models\Socio;
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

class ReporteGeneralExcel implements FromView, ShouldAutoSize, WithTitle, WithEvents
{
    var $numref;
    var $filtros;
    public function __construct($filters)
    {
        $this->filtros = $filters;

    }

    public function view(): View
    {
        $datos= EventoPromotor::whereHas('evento')->whereHas('zona')->filterDynamic($this->filtros);
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
                    return $evento->zona->cantidad_codigos ;
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
        $this->numref = count($datos);

        return view('export.reporte-general-excel', [
            'datos' => $datos,
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
            AfterSheet::class => function (AfterSheet $event) {
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
                $event->sheet->getDelegate()->getStyle('A1:E1')->applyFromArray($styleArrayCabecera);
                $event->sheet->getDelegate()->getStyle('A1:E' . ($this->numref+1))->applyFromArray($styleArray);


            },
        ];
    }
}
