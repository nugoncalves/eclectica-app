<?php

namespace App\Exports;

use App\Models\ItemsLeilao;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LotesExport implements FromQuery, WithHeadings
{
    use Exportable;

    protected $leilao;

    public function __construct(int $leilao)
    {
        $this->leilao = $leilao;
    }

    // DEFINE OS HEADERS DO FICHEIRO EXCEL A EXPORTAR
    public function headings(): array
    {
        return [
            'itemIndex',
            'sellerNumber',
            'startPrice',
            'mainLangName',
            'mainLangDesc',
            'secondLangName',
            'secondLangDesc',
            'minEstimate',
            'maxEstimate',
        ];
    }

    // FAZ O QUERY PARA OBTER OS items_leilao A ADICIONAR AO FICHEIRO EXCEL
    public function query()
    {
        $itemsLeilao = DB::table('items_leilao')
            ->join('items_contrato', 'items_leilao.items_contrato_id', '=', 'items_contrato.id')
            ->where('leilao_id', '=', $this->leilao)
            ->select(
                'items_leilao.leilao_lote',
                'items_contrato.seller_id',
                'items_leilao.start_price',
                'items_contrato.main_lang_name',
                'items_contrato.main_lang_desc',
                'items_contrato.second_lang_name',
                'items_contrato.second_lang_desc',
                'items_leilao.min_estimate',
                'items_leilao.max_estimate',
            )
            ->orderBy('leilao_lote', 'asc');

        return $itemsLeilao;
    }
}
