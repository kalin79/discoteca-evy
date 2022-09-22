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

class ReporteClientePromotorExcel implements FromView, ShouldAutoSize, WithTitle, WithEvents
{
    var $numref;
    var $promotor_id;
    public function __construct($filters)
    {
        $this->promotor_id = $filters->promotor_id;
    }

    public function view(): View
    {
        $clientes = Cliente::where('active',1);
        if(!empty($this->promotor_id)){
            $clientes = $clientes->where('promotor_id',$this->promotor_id);
        }

        if(auth()->user()->getRoleId()!=1){
            $clientes = $clientes->where('usuario_registra_id',auth()->user()->promotor_id);
        }

        $clientes = $clientes->get();
        $this->numref = count($clientes);

        return view('export.cliente-promotor-excel', [
            'clientes' => $clientes,
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
                $event->sheet->getDelegate()->getStyle('A1:D1')->applyFromArray($styleArrayCabecera);
                $event->sheet->getDelegate()->getStyle('A1:D' . ($this->numref+1))->applyFromArray($styleArray);


            },
        ];
    }
}
