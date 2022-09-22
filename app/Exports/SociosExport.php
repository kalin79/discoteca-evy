<?php

namespace App\Exports;

use App\Models\CodigosCliente;
use App\Models\Evento;
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

class SociosExport implements FromView, ShouldAutoSize, WithTitle, WithEvents
{
    var $numref;
    var $filtros;
    public function __construct($filters)
    {
        $this->filtros = $filters;

    }

    public function view(): View
    {
        $socios = Socio::filterDynamic($this->filtros)->get();
        $this->numref = count($socios);

        return view('export.socio-excel', [
            'socios' => $socios,
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
                $event->sheet->getDelegate()->getStyle('A1:F1')->applyFromArray($styleArrayCabecera);
                $event->sheet->getDelegate()->getStyle('A1:F' . ($this->numref+1))->applyFromArray($styleArray);


            },
        ];
    }
}
