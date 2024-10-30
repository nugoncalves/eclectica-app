<?php

namespace App\Http\Controllers;

use App\Models\ItemsLeilao;
use App\Exports\LotesExport;
use Illuminate\Http\Request;
use App\Models\ItemsContrato;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class ItemsLeilaoController extends Controller
{

    // Obtém os resultados e dados do Item Leilão para mostrar histórico de lotes e verbetes
    public function historico($id)
    {
        $itemLeilao = ItemsLeilao::find($id);
        $itemContrato = $itemLeilao->itemsContrato;
        $comprador = ($itemLeilao->comprador) ?? '';
        $leilao = $itemLeilao->leilao;
        $leiloes = DB::table('leiloes')->select('id')->orderBy('id', 'desc')->get();
        $licitacoes = $itemLeilao->licitacoes->sortBy([['bid_time', 'desc'], ['bid_price', 'desc']]);
        $resultado = $itemLeilao->resultado($itemLeilao);
        $images = $itemLeilao->images;
        return view('lotes.itemLeilao', [
            'leilao' => $leilao,
            'leiloes' => $leiloes,
            'iC' => $itemContrato,
            'iL' => $itemLeilao,
            'comprador' => $comprador,
            'licitacoes' => $licitacoes,
            'request' => $id,
            'resultado' => $resultado,
            'images' => $images,
        ]);
    }

    private function queryString($query)
    {
        if (!empty($query)) {
            $getElements = '';
            foreach ($query as $key => $value) {
                $getElements .= $key . '=' . $value . '&';
            }
            $getElements = substr($getElements, 0, -1);

            return '?' . $getElements;
        }
    }

    // PRINT A ETIQUETA DE LEILÃO
    public function printLabel(ItemsLeilao $lote)
    {
        $mainLangName = DB::table('items_contrato')->select('main_lang_name')->where('id', '=', $lote->items_contrato_id)->get();
        // dd($mainLangName);
        return view('lotes.print.itemLeilao', [
            'lote' => $lote,
            'descricao' => $mainLangName,
        ]);
    }

    // STORE
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'leilao_id' => 'required',
            'leilao_lote' => 'required',
            'start_price' => 'required',
            'min_estimate' => 'required',
            'max_estimate' => 'required',
            'items_contrato_id' => 'required',
        ]);

        $lastItemLeilao = ItemsLeilao::create($formFields);
        $item_contrato = ItemsContrato::find($lastItemLeilao->items_contrato_id);
        $item_contrato->update([
            'status' => 'colocado',
            'last_item_leilao' => $lastItemLeilao->id
        ]);

        return redirect('/lotes/' . $lastItemLeilao->items_contrato_id)->with('message', 'Colocação em Leilão Criada com Sucesso');
    }

    // Último Lote de Leilao
    // Obtém o input com o último lote do leilão escolhido +1
    public function maxLoteLeilao(Request $request)
    {
        $lotesLeilao = ItemsLeilao::select('leilao_lote')->where('leilao_id', '=', $request['leilao_id'])->orderBy('leilao_lote', 'desc')->first();
        $lotesLeilaoMax = collect($lotesLeilao)->max();
        $lotesLeilaoMax += 1;
        $inputLoteLeilao = "<input type='number' class='form-control' id='leilao_lote' name='leilao_lote' value='$lotesLeilaoMax'>";

        return $inputLoteLeilao;
    }

    // UPDATE
    public function update(Request $request, ItemsLeilao $itemLeilao)
    {
        $formFields = $request->validate([
            'leilao_id' => 'required',
            'leilao_lote' => 'required',
            'start_price' => 'required',
            'min_estimate' => 'required',
            'max_estimate' => 'required',
            'items_contrato_id' => 'required',
        ]);

        $itemLeilao->update($formFields);

        return back()->with('message', 'Lote de Leilão Gravado com Sucesso');
    }

    //UPDATE STATUS
    public function updateStatus(Request $request, ItemsLeilao $itemLeilao)
    {
        // $iL = ItemsLeilao::find($itemLeilao)->first();
        $status = $request->validate([
            'status' => 'required',
            'notes' => 'nullable'
        ]);
        $itemLeilao->update($status);
        $item_contrato = ItemsContrato::find($itemLeilao->items_contrato_id);
        if ($itemLeilao->status == 'anulado') {
            $item_contrato->update(['status' => 'disponível']);
        };

        return view('lotes.htmx_views.status', [
            'iL' => $itemLeilao
        ]);
    }

    // DELETE
    public function delete(ItemsLeilao $itemLeilao)
    {
        $itemContrato = $itemLeilao->items_contrato_id;
        $itemLeilao->delete();
        return redirect('/lotes/' . $itemContrato)->with('message', 'Item de Leilão apagado com sucesso');
    }


    // OTHER FUNCTIONS
    // Exportar Ficheiro para Carregar Leilão no WebSite
    public function export($leilao)
    {
      return Excel::store(new LotesExport($leilao), $leilao . '.xlsx', 'excel_files');
    }


    public function downloadZip($leilao)
    {

        // Call the export function to generate the Excel file
        $excelFile = $this->export($leilao);

        // Get the items leilao data
        $itemsLeilao = ItemsLeilao::where('leilao_id', $leilao)->get();

        // Create a new zip file
        $zip = new \ZipArchive();
        $zipFile = 'leilao_' . $leilao . '.zip';
        $zip->open($zipFile, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);


        $file = 'assets/exports/'. $leilao . '.xlsx';


        // Add the Excel file to the zip file
        $zip->addFile($file, $leilao . '.xlsx');
        // Loop through the items leilao data
        foreach ($itemsLeilao as $itemLeilao) {
            $counter = 1;
            // Get the images associated with the item leilao
            $images = $itemLeilao->images;

            // Loop through the images
            foreach ($images as $image) {
                
                // Add the image to the zip file
                $zip->addFile($image->path, $itemLeilao->leilao_lote . '_' . $counter . '.jpg');
                $counter++;
                
            }
        }

        // Close the zip file
        $zip->close();

        // Return the zip file as a download
        return response()->download($zipFile)->deleteFileAfterSend(true);
    }
}
