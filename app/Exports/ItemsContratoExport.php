<?php

namespace App\Exports;

use App\Models\ItemsContrato;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ItemsContratoExport implements FromCollection, WithMapping, WithHeadings
{

    use Exportable;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function headings(): array
    {
        return [
            'id',
            'contrato',
            'index',
            'descrição',
            'estado',
            'colocações',
            'último leilão',
            'lote',
            'martelo',
            'situação'
        ];
    }

    public function collection()
    {
        $lotes = ItemsContrato::where('seller_id', '=', $this->data)
            ->with('itemsLeilaoLast')
            ->with('itemsLeilaoCount')->get();
        // dd($lotes[0]);
        return $lotes;
    }

    //Query
    public function map($lotes): array
    {
        return [
            $lotes->id,
            $lotes->contrato_id,
            $lotes->contrato_index,
            $lotes->main_lang_name,
            $lotes->status,
            ($lotes->itemsLeilaoCount->count) ?? 0,
            ($lotes->itemsLeilaoLast->leilao_id) ?? '',
            ($lotes->itemsLeilaoLast->leilao_lote) ?? '',
            ($lotes->itemsLeilaoLast->price) ?? '',
            ($lotes->itemsLeilaoLast->status) ?? '',
        ];
    }
}
