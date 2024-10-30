<?php

namespace App\Http\Controllers;

use App\Models\ImgLotes;
use App\Models\ItemsLeilao;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\ItemsContrato;

use Illuminate\Support\Facades\DB;
use App\Exports\ItemsContratoExport;
use function Laravel\Prompts\select;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;


class ItemsContratoController extends Controller
{
    //VISUALIZAÇÃO DE item_contrato EM OFFCANVAS
    public function offcanvas($id)
    {
        $itemContrato = ItemsContrato::find($id);
        $itemLeilao = ItemsLeilao::where('items_contrato_id', $id)->first();
        if ($itemLeilao) {
            $comprador = $itemLeilao->comprador ?? '';
            $leilao = $itemLeilao->leilao;
            $leiloes = DB::table('leiloes')->select('id')->orderBy('id', 'desc')->get();
            $licitacoes = $itemLeilao->licitacoes->sortBy([['bid_time', 'desc'], ['bid_price', 'desc']]);
            $resultado = $itemLeilao->resultado($itemLeilao);
            $images = $itemContrato->images;
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
        } else {
            return 'Nenhum Item de Contrato Encontrado';
        }
    }

    //INDEX VIEW
    public function index()
    {
        $query = $this->queryString(request()->query());
        $lotes = ItemsContrato::filter(request()->query())->with('itemsLeilaoLast')->paginate(30);
        session(['query' => $query]);
        $contratos = new ItemsContrato();
        $contratos = $contratos->contratos();
        $filtered = request()->query();
        unset($filtered['page']);
        return view('lotes.index', [
            'lotes' => $lotes, // RowsData
            'baseRoute' => '/lotes', //BaseRoute
            'title' => 'Lotes',
            'query' => $query,
            'contratos' => $contratos,
            'filtered' => !empty($filtered) ? '1' : '0',
        ]);
    }

    // SHOW / EDIT VIEW
    public function show(ItemsContrato $lote)
    {
        $query = session()->get('query');
        $itemsLeilao = ItemsContrato::find($lote->id)->itemsLeilao->sortByDesc('leilao_id');
        $lastColocacao = $itemsLeilao->first();
        $outrosExemplares = [];
        if ($lote->verbete_id) {
            $outrosExemplares = collect(
                DB::select(
                    'SELECT * FROM items_leilao
        WHERE items_leilao.items_contrato_id IN
        (SELECT id FROM items_contrato
        WHERE items_contrato.verbete_id =' .
                        $lote->verbete_id .
                        ') ORDER BY items_leilao.leilao_id DESC',
                ),
            )->whereNotIn('items_contrato_id', $lote->id);
        }
        $images = $lote->images;
        $compradores = $lote->compradores($lote->id);
        $licitantes = $lote->licitantes($lote->id);
        $lote->loadCount('itemsLeilao');
        $leiloes = DB::table('leiloes')->select('id')->orderBy('id', 'desc')->get();
        $fornecedor = DB::table('clientes')
            ->where('id', '=', $lote->seller_id)
            ->first();
        $contratos = $lote->contratos();
        $contrato = DB::table('contratos')
            ->where('id', '=', $lote->contrato_id)
            ->first();
        $filtered = request()->query();
        $urlAtual = url()->current() . '/imagens';
        $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(100)->generate($urlAtual);
        return view('lotes.show', [
            'lote' => $lote,
            'baseRoute' => '/lotes',
            'title' => 'Lotes',
            'query' => $query,
            'filtered' => $filtered,
            'itemsLeilao' => $itemsLeilao,
            'ultimaColocacao' => $lastColocacao,
            'outros' => $outrosExemplares,
            'compradores' => $compradores,
            'licitantes' => $licitantes,
            'fornecedor' => $fornecedor,
            'leiloes' => $leiloes,
            'contratos' => $contratos,
            'contrato' => $contrato,
            'imagens' => $images,
            'qrcode' => $qrCode,
        ]);
    }

    // EDIT CONTRATO ITEM VIEW
    public function edit(ItemsContrato $lote)
    {
        $query = session()->get('query');
        $fornecedor = DB::table('clientes')
            ->where('id', '=', $lote->seller_id)
            ->first();
        $contratos = $lote->contratos();
        return view('lotes.edit', [
            'lote' => $lote,
            'baseRoute' => '/lotes',
            'title' => 'Lotes',
            'query' => $query,
            'fornecedor' => $fornecedor,
            'contratos' => $contratos,
        ]);
    }

    // PRINT LOTE VIEW
    public function print(ItemsContrato $lote)
    {
        return view('lotes.print.print', [
            'lote' => $lote,
            'title' => 'Lotes',
        ]);
    }

    // CREATE VIEW
    public function create()
    {
        $query = session()->get('query');
        $contratos = new ItemsContrato();
        $contratos = $contratos->contratos();
        return view('lotes.create', [
            'baseRoute' => '/lotes',
            'title' => 'Lotes',
            'contratos' => $contratos,
            'query' => $query,
        ]);
    }

    // LAST ITEM CONTRATO [para usar ao criar um novo item_contrato de um mesmo Contrato]
    public function ultimoContratoItem(Request $request)
    {
        $itemsContrato = ItemsContrato::select('contrato_index')
            ->where('contrato_id', '=', $request['contrato_id'])
            ->orderBy('contrato_index', 'desc')
            ->first();
        $itemsContratoMax = collect($itemsContrato)->max();
        $itemsContratoMax += 1;
        $inputContratoIndex = "<input type='number' class='form-control' id='contrato_index' name='contrato_index' value='$itemsContratoMax'>";

        return $inputContratoIndex;
    }

    // UPDATE ITEM LEILÃO
    public function updateItemLeilao(Request $request)
    {
        $itemLeilao = $request;
        $itemContrato = new ItemsContrato();
        $itemContrato->itemsLeilao()->upsert(
            [
                'id' => $itemLeilao['id'],
                'items_contrato_id' => $itemLeilao['items_contrato_id'],
                'leilao_id' => $itemLeilao['leilao'],
                'leilao_lote' => $itemLeilao['lote'],
                'start_price' => $itemLeilao['base'],
                'min_estimate' => $itemLeilao['est-min'],
                'max_estimate' => $itemLeilao['est-max'],
            ],
            ['id'],
        );

        return redirect('/lotes/' . $itemLeilao->items_contrato_id)->with('message', 'Colocação em Leilão Gravada com Sucesso');
    }

    // STORE
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'contrato_id' => 'required',
            'contrato_index' => 'required',
            'seller_reference' => 'nullable',
            'seller_id' => 'nullable',
            'status' => 'nullable',
            'verbete_id' => 'nullable',
            'main_lang_name' => 'required',
            'second_lang_name' => 'nullable',
            'main_lang_desc' => 'nullable',
            'second_lang_desc' => 'nullable',
            'tags' => 'nullable',
            'notes' => 'nullable',
        ]);

        $lastLote = ItemsContrato::create($formFields);

        return redirect('/lotes/' . $lastLote->id)->with('message', 'Lote Criado com Sucesso');
    }

    // UPDATE
    public function update(Request $request, ItemsContrato $lote)
    {
        $fields = $request;
        $lote->update([
            'contrato_id' => $fields['contrato_id'],
            'contrato_index' => $fields['contrato_index'],
            'seller_reference' => $fields['seller_reference'],
            'seller_id' => $fields['seller_id'],
            'status' => $fields['status'],
            'verbete_id' => $fields['verbete_id'],
            'main_lang_name' => $fields['main_lang_name'],
            'second_lang_name' => $fields['second_lang_name'],
            'main_lang_desc' => $fields['main_lang_desc'],
            'second_lang_desc' => $fields['second_lang_desc'],
            'tags' => $fields['tags'],
            'notes' => $fields['notes'],
        ]);

        if (request()->cameraInput != null || $fields->update) {

            $image = request()->file('cameraInput');
            $numero1 = $lote->id; // Número fixo para o primeiro dígito (ID do Lote)
            $numero2 = 0;

            $directory = 'assets/ic_img/';
            $filename = $numero1 . '.jpg';

            while (file_exists($directory . '/' . $filename)) {
                $numero2++;
                $numeroFormatado2 = sprintf('%02d', $numero2);
                $filename = $numero1 . '_' . $numeroFormatado2 . '.jpg';
            }

            $image->move('assets/ic_img/', $filename);
            $this->ResizedImages($directory, $filename);
            $attributes['items_contrato_id'] = $lote->id;
            $attributes['path'] = 'assets/ic_img/' . $filename;
            ImgLotes::create($attributes);
            return redirect('/lotes/' . $lote->id)->with('message', 'Lote Gravado com Sucesso');
        }

        // if ($fields->update) {
        //     return redirect('/lotes/' . $lote->id)->with('message', 'Lote Gravado com Sucesso');
        // }
        return back()->with('message', 'Lote Gravado com Sucesso');
    }

    // OBTER DADOS DE CONTRATO HTMX REQUEST
    // Para alterar os dados do Contrato
    public function dadosContrato(Request $request)
    {
        $contrato_id = $request['contrato_id'];
        $contrato = DB::table('contratos')->where('id', '=', $contrato_id)->first();
        $itemsContrato = ItemsContrato::select('contrato_index')->where('contrato_id', '=', $contrato_id)->orderBy('contrato_index', 'desc')->first();
        $itemsContratoUltimo = collect($itemsContrato)->max();
        $itemsContratoIndex = $itemsContratoUltimo + 1;
        $fornecedor = DB::table('clientes')
            ->where('id', '=', $contrato->seller_id)
            ->first();
        $contratos = new ItemsContrato();
        $contratos = $contratos->contratos();
        return view('lotes.htmx_views.dadosContrato', [
            'contrato' => $contrato,
            'fornecedor' => $fornecedor,
            'itemContratoUltimo' => $itemsContratoUltimo,
            'itemContratoIndex' => $itemsContratoIndex,
            'contratos' => $contratos,
        ]);
    }

    // DELETE
    // CRIAR VALIDAÇÃO E NÃO DEIXAR APAGAR SE EXISTIREM LOTES EM LEILÃO
    public function delete(ItemsContrato $lote)
    {
        $lote->loadCount('itemsLeilao');
        if ($lote->items_leilao_count > 0) {
            return redirect('lotes/' . $lote->id)->with('warning', 'Não é possível apagar lotes com colocações em Leilão');
        }
        $query = session()->get('query');
        $images = ImgLotes::where('items_contrato_id', $lote->id)->get();
        if ($images->count() > 0) {
            foreach ($images as $image) {
                $image->delete();
            }
        }
        $lote->delete();
        return redirect('/lotes' . $query)->with('message', 'Lote apagado com sucesso');
    }

    // DUPLICATE ITEM CONTRATO
    public function duplicate(ItemsContrato $lote)
    {
        $dupLote = $lote->replicate();
        $dupLote->mainLangName = $lote->mainLangName . ' (Duplicado)';
        $dupLote->idContrato = '0';
        $dupLote->contratoIndex = '0';
        $dupLote->save();
        return redirect('/lotes/' . $dupLote->id)->with('message', 'Lote Duplicado com Sucesso');
    }

    // Query Builder -> para guardar últimos requests quando regressa à lista
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

    //EXPORT ITEMS CONTRATO (POSIÇÃO DE STOCK) FORNECEDOR
    public function exportLotesFornecedor($fornecedor)
    {
        return Excel::download(new ItemsContratoExport($fornecedor), $fornecedor . '_' . date('Ymd') . '.xlsx');
    }

    //IMAGENS ITEMS CONTRATO
    public function showImages($id)
    {
        $images = ImgLotes::where('items_contrato_id', $id)->get();
        $lote = ItemsContrato::where('id', $id)->first();
        return view('lotes.partials.showImages', [
            'title' => 'Imagens',
            'imagens' => $images,
            'lote' => $lote,
        ]);
    }

    //STORE IMAGE
    public function storeImage(Request $request, $id)
    {
        $image = request()->file('cameraInput');
        $numero1 = $id; // Número fixo para o primeiro dígito (ID do Lote)
        $numero2 = 0;

        $directory = 'assets/ic_img/';
        $filename = $numero1 . '.jpg';

        while (file_exists($directory . '/' . $filename)) {
            $numero2++;
            $numeroFormatado2 = sprintf('%02d', $numero2);
            $filename = $numero1 . '_' . $numeroFormatado2 . '.jpg';
        }

        $image->move('assets/ic_img/', $filename);
        $this->ResizedImages($directory, $filename);
        $attributes['items_contrato_id'] = $id;
        $attributes['path'] = 'assets/ic_img/' . $filename;
        ImgLotes::create($attributes);

        return back()->with('message', 'Imagem adicionada com Sucesso');
    }

    //Delete Images
    public function destroyImage($id)
    {
        $image = ImgLotes::where('id', $id)->first();
        if ($image) {
            $filePath = $image->path;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $image->delete();
        }
        return back()->with('message', 'Imagem apagada com Sucesso');
    }

    private function ResizedImages($directory, $filename)
    {
        $manager = new ImageManager(new Driver());
        $image = $manager->read('assets/ic_img/' . $filename);
        $originalWidth = $image->width();
        $originalHeight = $image->height();
        $newWidth = $originalWidth * 0.4;
        $newHeight = $originalHeight * 0.4;
        if ($image->height() > $newHeight || $image->width() > $newWidth) {
            $image->scale($newWidth, $newHeight)->save($directory . $filename);
        } else {
            $image->save($directory . $filename);
        }
    }
}
