<?php

namespace App\Http\Controllers;

use App\Imports\BidsExcelImport;
use App\Models\BidsImport;
use App\Models\ItemsContrato;
use App\Models\ItemsLeilao;
use App\Models\Leiloes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Number;
use Maatwebsite\Excel\Facades\Excel;

class BidsImportController extends Controller
{
    //

    public function import($leilao)
    {
        //Assegura que não existem dados na tabela provisória
        BidsImport::truncate();

        // Verifica se os ficheiros estão prontos para upload
        $preBidsFile = request()->file('pre_bids_import');
        $liveBidsFile = request()->file('live_bids_import');
        if ((empty($preBidsFile)) || (empty($liveBidsFile)))
            return view('components.htmx-warning')->with('warning', 'Por favor seleccione os ficheiros com os dados para actualizar resultados do leilão.');

        // VERIFICAÇÕES
        // 1. Certifica-se que não existem dados nas tabelas definitivas
        $licitacoes = DB::table('licitacoes')->where('leilao_id', '=', $leilao)->count();
        if ($licitacoes)
            return view("components.htmx-warning")->with('warning', 'Já existem dados importados. Não é possível importar novamente. Contacte o administrador do Sistema.');

        // 2. Verifica o nome do ficheiro de Pré Bids
        $fileName = $preBidsFile->getClientOriginalName();
        $leilaoConfirm = str_contains($fileName, $leilao);
        $fileConfirm = str_contains($fileName, 'pre_bids');
        if ((!$leilaoConfirm) || (!$fileConfirm))
            return view('components.htmx-warning')
                ->with('warning', 'O ficheiro de Pré Bids não é correcto. Certifique-se que o nome do ficheiro começa por "pre_bids" e que o leilão é o número ' . $leilao);

        // 3. Verifica o nome do ficheiro de Live Bids
        $fileName = $liveBidsFile->getClientOriginalName();
        $leilaoConfirm = str_contains($fileName, $leilao);
        $fileConfirm = str_contains($fileName, 'live_bids');
        if ((!$leilaoConfirm) || (!$fileConfirm))
            return view('components.htmx-warning')
                ->with('warning', 'O ficheiro de Live Bids não é correcto. Certifique-se que o nome do ficheiro começa por "live_bids" e que o leilão é o número ' . $leilao);

        // Começa a importação para a tabela provisória
        // 1. Pré Bids
        $import = Excel::toCollection(new BidsExcelImport, request()->file('pre_bids_import'));
        $importBids = $import[0];
        foreach ($importBids as $bids) {
            $bid = new BidsImport();
            $bid->type = 'prebid';
            $bid->leilao_id = $leilao;
            $bid->lot_index = $bids['lot_index'];
            $bid->bid_price = $bids['bid_price'];
            $bid->bid_type = 'Pre sale internet bid';
            $bid->bid_time = str_replace("'", '', str_replace("'", "", $bids['bid_time']));
            $bid->sold_bid = 0;
            $bid->bidder_id = intval($bids['bidder_number']) + 0;
            $ids_lotes = DB::table('items_leilao')->select('id', 'items_contrato_id')->where('leilao_id', '=', $leilao)->where('leilao_lote', '=', $bids['lot_index'])->first();
            $bid->items_leilao_id = $ids_lotes->id;
            $bid->items_contrato_id = $ids_lotes->items_contrato_id;
            $bid->save();
        }

        // 2. Live Bids
        $import = Excel::toArray(new BidsExcelImport, request()->file('live_bids_import'));
        $importBids = $import[0];
        foreach ($importBids as $bids) {
            $bid = new BidsImport();
            $bid->type = 'livebid';
            $bid->leilao_id = $leilao;
            $bid->lot_index = $bids['lot_index'];
            $bid->bid_price = $bids['bid_price'];
            $bid->bid_type = $bids['bidder_type'];
            $bid->bid_time = str_replace("'", '', str_replace("'", "", $bids['bid_time']));
            $bid->sold_bid = ($bids['sold_bid'] == 'false') ? 0 : 1;
            $bid->bidder_id = intval($bids['bidder_number']) + 0;
            $ids_lotes = DB::table('items_leilao')->select('id', 'items_contrato_id')->where('leilao_id', '=', $leilao)->where('leilao_lote', '=', $bids['lot_index'])->first();
            $bid->items_leilao_id = $ids_lotes->id;
            $bid->items_contrato_id = $ids_lotes->items_contrato_id;
            $bid->save();
        }

        $bidsImport = BidsImport::all();
        $maxLoteIndex = $bidsImport->max('lot_index');
        $totalMartelo = BidsImport::where('sold_bid', '=', 1)->sum('bid_price');
        $compradores = BidsImport::join('clientes', 'bids_imports.bidder_id', '=', 'clientes.id')
            ->select('clientes.*')
            ->where('bids_imports.leilao_id', '=', $leilao)
            ->where('bids_imports.sold_bid', '=', 1)
            ->orderBy('clientes.id')
            ->get()
            ->values()
            ->unique();
        $lotesVendidos = BidsImport::where('sold_bid', '=', 1)->count();

        return view('leiloes.modal.bidsimport', [
            'leilao' => Leiloes::where('id', '=', $leilao)->first(),
            'bidsImport' => $bidsImport,
            'bidsImportStatus' => ($bidsImport->count() > 0) ? 1 : 0,
            'totalMartelo' => Number::currency($totalMartelo, 'EUR', 'pt'),
            'compradores' => $compradores,
            'numeroCompradores' => $compradores->count(),
            'maxLoteIndex' => $maxLoteIndex,
            'lotesVendidos' => $lotesVendidos,
        ]);
    }

    // Cancela a importação e apaga os registos da tabela provisória, se existirem
    public function cancel($leilao)
    {
        BidsImport::truncate();
        return view('leiloes.importData.prebids_import', [
            'leilao' => Leiloes::where('id', '=', $leilao)->first(),
            'preBids' => BidsImport::all(),
            'preBidsStatus' => 0,
            'bidsImportStatus' => 0,
        ]);
    }

    // Após confirmação, importa os dados para as tabelas respetivas
    public function confirm($leilao)
    {
        // Verificações do Utilizador
        $verificacoes = (is_array(request()->verificacoes)) ? array_sum(request()->verificacoes) : 0;
        if ($verificacoes < 4) {
            dd("TESTE IF");
            return view('components.htmx-warning')->with('warning', 'Confirme os dados de verificação antes de confirmar a importação');
        }
        // Começa a Importação de Licitações

        // Guarda em Arrays os dados para importação para as tabelas principais
        $bidsToImport = BidsImport::all(); // Guarda a totalidade das licitações
        $soldBids = BidsImport::where('sold_bid', '=', 1)->orderBy('lot_index')->get(); // Guarda as licitações vencedoras para guardar resultado

        // Faz update dos itemsLeilao Vendidos
        $soldBids->each(function ($bid) {
            $itemLeilao = ItemsLeilao::find($bid->items_leilao_id);
            $itemContrato = ItemsContrato::find($itemLeilao->items_contrato_id);
            $comissoes = $itemLeilao->comissoes();
            $itemLeilao->update([
                'price' => $bid->bid_price,
                'buyer_id' => $bid->bidder_id,
                'sold' => $bid->sold_bid,
                'status' => 'vendido',
                'commission_buyer' => $comissoes['buyer'],
                'commission_seller' => $comissoes['seller'],
            ]);
            // dd($itemLeilao);
            $itemContrato->update([
                'status' => 'vendido'
            ]);
        });

        // Faz update dos itemsLeilao Retirados
        ItemsLeilao::where('leilao_id', $leilao)->where('sold', 0)->orWhereNull('sold')->update([
            'status' => 'retirado',
            'price' => 0,
        ]);

        // Faz update do estado do Leilão
        DB::table('leiloes')
            ->where('id', $leilao)
            ->update([
                'status' => 'processado',
            ]);

        // Importa a totalidade das licitações
        $bidsToImport->each(function ($bid) {
            $licitacao = $bid->replicate();
            $licitacao->setTable('licitacoes');
            $licitacao->save();
            $bid->delete();
        });
        return redirect('leiloes/' . $leilao)->with('message', 'Dados Importados com Sucesso.');
    }
}
