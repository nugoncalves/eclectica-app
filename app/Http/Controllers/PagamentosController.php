<?php

namespace App\Http\Controllers;

use  Carbon\Carbon;
use App\Models\Cliente;
use App\Models\Leiloes;
use App\Models\Pagamentos;
use App\Models\ItemsLeilao;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\Comprovativos;
use App\Models\ItemsContrato;
use Illuminate\Support\Number;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PagamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $query = $this->queryString(request()->query());
        $pagamentos = Pagamentos::filter(request(['search']))->with('fornecedor')->with('leilao')->with('itemsLeilao')->orderBy('id', 'desc')->paginate(30);
        session(['query' => ($query)]);
        session(['previous' => '']);
        // dd($pagamentos);
        return view('pagamentos.main.index', [
            'pagamentos' => $pagamentos, // RowsData
            'baseRoute' => '/pagamentos', //BaseRoute
            'title' => 'Pagamentos',
            'query' => $query,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $previous = '/pagamentos/proximos/' . $request->session()->get('query');
        session(['previous' => $previous]);

        // Obtém a lista de lotes enviado no request
        $lotes = collect($request->lotes);

        // Obtém os dados comuns a todos os lotes
        $dados_comuns = $lotes->first();
        // dd($dados_comuns);
        $seller_id = $dados_comuns['seller_id'];
        $leilao_id = $dados_comuns['leilao_id'];
        $date = $dados_comuns['date'];
        $formFields = [
            'seller_id' => $seller_id,
            'leilao_id' => $leilao_id,
            // 'date' => $date
            'date' => date('Y-m-d')
        ];

        // Cria o pagamento
        $lastPagamento = Pagamentos::create($formFields);

        // Actualiza os dados de cada ItemContrato e atribui-lhe o número de pagamento respectivo
        try {
            foreach ($lotes as $lote) {
                collect($lote);
                if (isset($lote["check"])) {
                    ItemsContrato::where('last_item_leilao', $lote["id"])
                        ->update([
                            'status' => 'fechado',
                            'pagamento_id' => $lastPagamento->id
                        ]);
                }
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        return redirect('/pagamentos/' . $lastPagamento->id)->with('message', 'Pagamento Criado com Sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pagamentos $pagamento)
    {
        $previous = session()->get('previous');

        session(['previous' => $previous]);
        $query = session()->get('query');
        //Obtém os dados
        $fornecedor = Cliente::where('id', $pagamento->seller_id)->first();
        $leilao = Leiloes::where('id', $pagamento->leilao_id)->first();
        $lotes = ItemsContrato::where('pagamento_id', $pagamento->id)->with('itemsLeilaoLast')
            ->orderBy(
                ItemsLeilao::select('leilao_lote')
                    ->whereColumn('items_leilao.id', 'items_contrato.last_item_leilao')
                    ->take(1),
                'asc'
            )
            ->get();
        // dd($lotes);
        $martelo = $lotes->sum('itemsLeilaoLast.price');
        $comissao = $lotes->sum('itemsLeilaoLast.commission_seller');
        $iva = $comissao * .23;
        $pagar = $martelo - $comissao - $iva;
        $comprovativos = Comprovativos::where('pagamento_id', $pagamento->id)->get();
        return view('pagamentos.main.show', [
            'baseRoute' => '/pagamentos',
            'title' => 'Pagamento',
            'query' => $query,
            'previous' => $previous,
            'fornecedor' => $fornecedor,
            'leilao' => $leilao,
            'lotes' => $lotes,
            'pagamento' => $pagamento,
            'comprovativos' => $comprovativos,
            'totais' => [
                'martelo' => Number::currency($martelo, in: 'EUR', locale: 'pt'),
                'comissao' => Number::currency($comissao, in: 'EUR', locale: 'pt'),
                'iva' => Number::currency($iva, in: 'EUR', locale: 'pt'),
                'pagar' => Number::currency($pagar, in: 'EUR', locale: 'pt')
            ]
        ]);
    }

    /**
     * Impressão de Pagamento
     */
    public function imprimir(Pagamentos $pagamento)
    {
        $fornecedor = Cliente::where('id', $pagamento->seller_id)->first();
        $leilao = Leiloes::where('id', $pagamento->leilao_id)->first();
        $lotes = ItemsContrato::where('pagamento_id', $pagamento->id)->with('itemsLeilaoLast')
            ->orderBy(
                ItemsLeilao::select('leilao_lote')
                    ->whereColumn('items_leilao.id', 'items_contrato.last_item_leilao')
                    ->take(1),
                'asc'
            )
            ->get();
        $martelo = $lotes->sum('itemsLeilaoLast.price');
        $comissao = $lotes->sum('itemsLeilaoLast.commission_seller');
        $iva = $comissao * .23;
        $deducao = $comissao + $iva;
        $pagar = $martelo - $comissao - $iva;
        $comprovativos = Comprovativos::where('pagamento_id', $pagamento->id)->get();
        return view('pagamentos.main.print', [
            'baseRoute' => '/pagamentos',
            'title' => 'Pagamento',
            'fornecedor' => $fornecedor,
            'leilao' => $leilao,
            'lotes' => $lotes,
            'pagamento' => $pagamento,
            'comprovativos' => $comprovativos,
            'totais' => [
                'martelo' => Number::currency($martelo, in: 'EUR', locale: 'pt'),
                'comissao' => Number::currency($comissao, in: 'EUR', locale: 'pt'),
                'iva' => Number::currency($iva, in: 'EUR', locale: 'pt'),
                'deducao' => Number::currency($deducao, in: 'EUR', locale: 'pt'),
                'pagar' => Number::currency($pagar, in: 'EUR', locale: 'pt')
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pagamentos $pagamentos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pagamentos $pagamento)
    {
        //
        $formFields = $request->validate([
            'seller_id' => 'required',
            'leilao_id' => 'required',
            'date' => 'required',
            'modo' => 'required',
            'notes' => 'nullable'
        ]);

        $pagamento->update($formFields);

        return back()->with('message', 'Pagamento Gravado com Sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pagamentos $pagamentos)
    {
        //
    }

    /**
     * Mostra a lista de pagamentos ainda não feitos
     */
    public function proFormaIndex(Request $request)
    {
        $query = $this->queryString(request()->query());
        session(['query' => ($query)]);
        $filters =  $request->all();
        // dd($filters);
        $resumo = DB::table('items_contrato as iC')
            ->select(
                'iC.id',
                'iC.seller_id',
                'iC.status',
                'iL.leilao_id',
                'l.id as leilao_num',
                'l.end_date',
                'l.name',
                DB::raw('LAST_DAY(DATE_ADD(l.end_date, INTERVAL 1 MONTH)) AS due_date'),
                'f.seller_reference',
                'f.full_name',
                DB::raw('SUM(iL.price) as martelo'),
                DB::raw('SUM(iL.commission_seller) as comissao')
            )
            ->leftJoin('items_leilao as iL', 'iL.items_contrato_id', '=', 'iC.id')
            ->leftJoin('leiloes as l', 'iL.leilao_id', '=', 'l.id')
            ->leftJoin('clientes as f', 'iC.seller_id', '=', 'f.id')
            ->whereIn('iC.status', ['vendido', 'não pago'])
            ->whereRaw('iL.id = (SELECT MAX(id) FROM items_leilao WHERE items_leilao.items_contrato_id = iC.id)')
            ->where(function ($query) use ($filters) {
                // Add your filter logic here
                if (isset($filters['search'])) {
                    $query->where('iC.id', 'like', '%' . $filters['search'] . '%')
                        ->orWhere('iL.leilao_id', 'like', '%' . $filters['search'] . '%')
                        ->orWhere('f.seller_reference', 'like', '%' . $filters['search'] . '%');
                }
            })
            ->groupBy('leilao_id', 'seller_id')
            ->orderByDesc('due_date')
            ->orderBy('seller_id')
            ->orderByDesc('leilao_id')
            // ->get();
            ->paginate(30);


        return view('pagamentos.proforma.index', [
            'baseRoute' => '/pagamentos/proximos',
            'title' => 'Pagamentos ProForma',
            'query' => $query,
            'pagamentos' => $resumo
        ]);
    }

    public function proFormaShow($seller_id, $leilao_id)
    {
        $query = session()->get('query');
        $lotes = collect(DB::select(
            '
            SELECT iL.id, iL.leilao_id, iL.leilao_lote, iL.price, iL.commission_seller, iL.status, iL.items_contrato_id,
                iC.seller_id, iC.main_lang_name, iC.status
            FROM items_leilao AS iL
            LEFT JOIN items_contrato AS iC ON iC.last_item_leilao = iL.id
            WHERE iL.leilao_id = ' . $leilao_id . ' AND iC.seller_id = ' . $seller_id . ' AND (iC.status="vendido" OR iC.status="não pago")
            ORDER BY iL.leilao_lote ASC'
        ));
        $fornecedor = Cliente::where('id', $seller_id)->first();
        $leilao = Leiloes::where('id', $leilao_id)->first();
        $soma_martelo = $lotes->sum('price');
        $soma_comissao = $lotes->sum('commission_seller');
        $iva = $soma_comissao * 0.23;
        $pagar = $soma_martelo - $soma_comissao - $iva;
        $totais = [
            'martelo' => Number::currency($soma_martelo, in: 'EUR', locale: 'pt'),
            'comissao' => Number::currency($soma_comissao, in: 'EUR', locale: 'pt'),
            'iva' => Number::currency($iva, in: 'EUR', locale: 'pt'),
            'pagar' => Number::currency($pagar, in: 'EUR', locale: 'pt'),
            'lotes' => count($lotes)
        ];
        return view('pagamentos.proforma.show', [
            'baseRoute' => '/pagamentos/proximos',
            'title' => 'Pagamento ProForma',
            'query' => $query,
            'lotes' => $lotes,
            'fornecedor' => $fornecedor,
            'leilao' => $leilao,
            'totais' => $totais
        ]);
    }

    public function totais(Request $request)
    {
        $lotes = $request->lotes;
        $martelo = 0;
        $comissao = 0;
        foreach ($lotes as $lote) {
            $checked = (isset($lote['check'])) ? 1 : 0;
            if ($checked) {
                $martelo += $lote['price'];
                $comissao += $lote['commission_seller'];
            };
        };
        $iva = $comissao * .23;
        $pagar = $martelo - $comissao - $iva;
        return view('pagamentos.proforma.partials.totais', [
            'totais' => [
                'martelo' => Number::currency($martelo, in: 'EUR', locale: 'pt'),
                'comissao' => Number::currency($comissao, in: 'EUR', locale: 'pt'),
                'iva' => Number::currency($iva, in: 'EUR', locale: 'pt'),
                'pagar' => Number::currency($pagar, in: 'EUR', locale: 'pt')
            ]
        ]);
    }

    // QUERY IN SEARCH STRING
    public function queryString($query)
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

    public function uploadAnexo(Request $request, Pagamentos $pagamento)
    {
        $comprovativo = $request->file('fileInput');
        $seller_id = $pagamento->seller_id;
        $leilao_id = $pagamento->leilao_id;
        $dateString = Carbon::parse($pagamento->date);
        $date = $dateString->format('dmY');

        $fileCount = Comprovativos::where('pagamento_id', $pagamento->id)->count();
        $filename = $seller_id . '_' .  $date . '_' . $leilao_id . ($fileCount > 0 ? '_' . $fileCount : '') . '.pdf';
        $comprovativo->move('assets/images/pagamentos/comprovativos/', $filename);
        $attributes = [
            'pagamento_id' => $pagamento->id
        ];
        $attributes['path'] = 'assets/images/pagamentos/comprovativos/' . $filename;
        $attributes['name'] = $filename;
        Comprovativos::create($attributes);
        return back()->with('message', 'Upload Realizado com Sucesso');
    }

    public function deleteAnexo(Comprovativos $comprovativo, Request $request)
    {
        $pagamento = Pagamentos::find($comprovativo->pagamento_id)->first();
        File::delete(asset($comprovativo->path));
        $comprovativo->delete();
        return back()->with('message', 'Comprovativo Eliminado com Sucesso');
    }
}
