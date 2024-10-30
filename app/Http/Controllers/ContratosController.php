<?php

namespace App\Http\Controllers;

use QrCode;
use Carbon\Carbon;
use App\Models\Image;
use App\Models\Cliente;
use App\Models\Verbete;
use App\Models\ImgLotes;
use App\Models\Contratos;
use App\Models\ItemsLeilao;
use Illuminate\Http\Request;
use App\Models\ItemsContrato;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class ContratosController extends Controller
{
    // Lista de Contratos
    public function index(Request $query)
    {
        $query = $this->queryString(request()->query());
        $contratos = Contratos::with('cliente')
            ->filter(request(['search']))
            ->orderByDesc('id')
            ->paginate(30);
        session(['query' => $query]);
        return view('contratos.index', [
            'baseRoute' => '/contratos',
            'query' => $query,
            'title' => 'Contratos',
            'contratos' => $contratos,
        ]);
    }

    // Função de divisão dos valores de pesquisa em Array para usar em %LIKE% AND %LIKE%...
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

    //SHOW
    public function show(Contratos $contrato)
    {
        $items_contrato = ItemsContrato::where('contrato_id', $contrato->id)
            ->orderBy('contrato_index')
            ->get();
        $numero_items_contrato = $items_contrato->count();
        return view('contratos.show', [
            'baseRoute' => '/contratos',
            'contrato' => $contrato,
            'title' => 'Contratos',
            'cliente' => Cliente::where('id', $contrato->seller_id)->first(),
            'query' => session()->get('query'),
            'itemsContrato' => $items_contrato,
            'baseRoute2' => '/contratos/' . $contrato->id,
            'totais' => [
                'items_contrato' => $numero_items_contrato,
            ],
        ]);
    }

    //Retorna ITEMS CONTRATO de acordo com a pesquisa realizada no show dos contratos
    public function filter_items_contrato(Contratos $contrato)
    {
        $search_string = request()->query('search');
        $items_contrato = DB::table('items_contrato')
            ->join('contratos', 'items_contrato.contrato_id', '=', 'contratos.id')
            ->select('items_contrato.*')
            ->where('contrato_id', $contrato->id)
            ->orderby('contrato_index', 'asc');
        if ($search_string) {
            $search_string = explode(' ', $search_string);
            $items_contrato->where('main_lang_name', 'like', '%' . $search_string[0] . '%');
            for ($i = 1; $i < count($search_string); $i++) {
                $items_contrato->where('main_lang_name', 'like', '%' . $search_string[$i] . '%');
            }
        }
        return view('contratos.items_contrato_em_contrato', [
            'totais' => [
                'items_contrato' => $items_contrato->count(),
            ],
            'itemsContrato' => $items_contrato->get(),
            'contrato' => $contrato,
        ]);
    }

    // Formulário de criação de um novo contrato
    public function create()
    {
        $query = session()->get('query');
        return view('contratos.create', [
            'baseRoute' => '/contratos',
            'title' => 'Contratos',
            'query' => $query,
            'dateNow' => Carbon::now()->format('d-m-Y'),
        ]);
    }

    // Cria novo Registo
    public function store(Request $request)
    {
        if ($request->commission_type == 'Progressiva') {
            $formFields = request()->validate([
                'date' => ['required'],
                'seller_id' => ['required'],
                'seller_reference' => ['required'],
                'commission_type' => ['required'],
                'commission_300' => ['required'],
                'commission_1000' => ['required'],
                'commission_3000' => ['required'],
                'commission_more_3000' => ['required'],
            ]);
        } else {
            $formFields = request()->validate([
                'date' => ['required'],
                'seller_id' => ['required'],
                'seller_reference' => ['required'],
                'commission_type' => ['required'],
                'commission_300' => ['required'],
            ]);
        }

        Contratos::create($formFields);
        return redirect('/contratos')->with('message', 'Contrato Criado com Sucesso');
    }

    //UPDATE
    public function update(Contratos $contrato, Request $request)
    {
        if ($request->commission_type == 'Progressiva') {
            $formFields = request()->validate([
                'date' => ['required'],
                'seller_id' => ['required'],
                'seller_reference' => ['required'],
                'commission_type' => ['required'],
                'commission_300' => ['required'],
                'commission_1000' => ['required'],
                'commission_3000' => ['required'],
                'commission_more_3000' => ['required'],
            ]);
        } else {
            $formFields = request()->validate([
                'date' => ['required'],
                'seller_id' => ['required'],
                'seller_reference' => ['required'],
                'commission_type' => ['required'],
                'commission_300' => ['required'],
                'commission_1000' => ['nullable'],
                'commission_3000' => ['nullable'],
                'commission_more_3000' => ['nullable'],
            ]);
        }

        $contrato->update($formFields);
        return back()->with('message', 'Contrato Atualizado com Sucesso');
    }

    // Formulário para adicionar lotes a Contratos
    public function addLotes(Contratos $contrato, Request $query)
    {
        $items_contrato = ItemsContrato::where('contrato_id', $contrato->id)
            ->orderByDesc('contrato_index')
            ->get();
        $numero_items_contrato = $items_contrato->count();
        $urlAtual = url()->current();
        $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(150)->generate($urlAtual);
        return view('contratos.addLotes', [
            'baseRoute' => '/contratos',
            'contrato' => $contrato,
            'title' => 'Adicionar Lotes',
            'cliente' => Cliente::where('id', $contrato->seller_id)->first(),
            'query' => session()->get('query'),
            'itemsContrato' => $items_contrato,
            'baseRoute2' => '/contratos/' . $contrato->id,
            'totais' => [
                'items_contrato' => $numero_items_contrato,
            ],
            'qrcode' => $qrCode,
        ]);
    }

    // Função de criação de novo item_contrato [Lote]
    public function createItemContrato(Contratos $contrato)
    {
        $formFields = request()->validate([
            'date_entry' => now()->addHours(1)->format('d/m/Y'),
            'contrato_index' => 'required|integer',
            'verbete_id' => 'nullable|integer',
            'main_lang_name' => 'nullable|string',
            'second_lang_name' => 'nullable|string',
            'main_lang_desc' => 'nullable|string',
            'tags' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);
        $formFields['contrato_id'] = $contrato->id;
        $contrato = Contratos::find($formFields['contrato_id']);
        $cliente = Cliente::find($contrato->seller_id);
        $formFields['seller_id'] = $cliente->id;
        $formFields['seller_reference'] = $cliente->seller_reference;

        $lastLote = ItemsContrato::create($formFields);

        $attributes = [
            'items_contrato_id' => $lastLote->id,
            'path' => '',
            'created_at' => now()->addHours(1),
            'updated_at' => now()->addHours(1),
        ];

        if (request()->hasFile('cameraInput')) {
            $image = request()->file('cameraInput');
            $numero1 = $lastLote->id;
            $numero2 = 0;

            $directory = public_path('assets/ic_img/');
            $filename = $numero1 . '.jpg';

            while (file_exists($directory . '/' . $filename)) {
                $numero2++;
                $numeroFormatado2 = sprintf('%02d', $numero2);
                $filename = $numero1 . '_' . $numeroFormatado2 . '.jpg';
            }

            $image->move($directory, $filename);
            $this->ResizedImages($directory, $filename);
            ImgLotes::create([
                'items_contrato_id' => $lastLote->id,
                'path' => 'assets/ic_img/' . $filename,
                'created_at' => now()->addHours(1),
                'updated_at' => now()->addHours(1),
            ]);
        }

        return back()->with('message', 'Lote Criado e Associado com Sucesso');
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

    // APAGAR
    public function destroy(Contratos $contrato)
    {
        $items_contrato = ItemsContrato::where('contrato_id', $contrato->id)->get();
        if ($items_contrato->count() > 0) {
            return back()->with('error', 'Impossível eliminar Contratos com Items Contrato Associados');
        } else {
            $contrato->delete();
            return redirect('/contratos')->with('message', 'Contrato Eliminado com Sucesso');
        }
    }
}
