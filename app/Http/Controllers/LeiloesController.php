<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Leiloes;
use App\Models\ItemsLeilao;
use Illuminate\Http\Request;
use Illuminate\Support\Number;
use Illuminate\Support\Facades\DB;

class LeiloesController extends Controller
{
  //

  // LIST VIEW
  public function index()
  {
    $query = $this->queryString(request()->query());
    $leiloes = Leiloes::filter(request(['search']))->orderBy('id', 'desc')->paginate(30);
    session(['query' => ($query)]);
    return view('leiloes.index', [
      'leiloes' => $leiloes, // RowsData
      'baseRoute' => '/leiloes', //BaseRoute
      'title' => 'Leilões',
      'query' => 'teste'
    ]);
  }

  // QUERY IN SEARCH STRING
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

  // SHOW / EDIT VIEW
  public function show(Leiloes $leilao)
  {
    $query = session()->get('query');

    // LOTES DE LEILÃO //
    $items_leilao = $leilao->itemsLeilao()
      ->join('items_contrato', 'items_leilao.items_contrato_id', '=', 'items_contrato.id')
      ->select('items_leilao.*', 'items_contrato.seller_id', 'items_contrato.main_lang_name', 'items_contrato.contrato_id', 'items_contrato.contrato_index')
      ->orderBy('leilao_lote', 'asc')
      ->get();
    $numero_lotes = $items_leilao->count();
    $total_bases = ($items_leilao->sum('start_price')) ?? 0;
    $total_estimativas = ($items_leilao->sum('max_estimate')) ?? 0;


    // Se o leilão não está processado, obtém e calcula os resultados financeiros e outras métricas
    if ($leilao->status !== 'processado') {
      return view('leiloes.show', [
        'baseRoute' => '/leiloes',
        'title' => 'Leilões',
        'query' => $query,
        'leilao' => $leilao,
        'itemsLeilao' => $items_leilao,
        'totais' => [
          'lotes' => $numero_lotes,
          'bases' => $total_bases,
          'estimativas' => $total_estimativas,
        ]
      ]);
    }

    // Caso o leilão já tenha sido processado, retorna apenas os dados necessários

    // CLIENTES
    // Fornecedores presentes no Leilão
    $fornecedores_list = $items_leilao->unique('seller_id')->pluck('seller_id');
    $fornecedores = Cliente::find($fornecedores_list);

    // Licitantes
    $licitantes = $leilao->licitacoes()
      ->join('clientes', 'licitacoes.bidder_id', '=', 'clientes.id')
      ->orderBy('clientes.id')
      ->orderBy('sold_bid')
      ->get()
      ->values()
      ->unique();

    // LICITAÇÕES
    $pre_bids = $leilao->licitacoes()->where('type', 'prebid')->orderBy('lot_index', 'asc')->orderBy('bid_time', 'desc')->get();
    $live_bids = $leilao->licitacoes()->where('type', 'livebid')->orderBy('lot_index', 'asc')->orderBy('bid_time', 'desc')->get();

    // ANÁLISE DE RESULTADOS //
    // Lotes
    $numero_lotes_vendidos = $leilao->licitacoes()->where('sold_bid', 1)->get()->count();
    $percentagem_lotes_vendidos = ($numero_lotes) ? $numero_lotes_vendidos / $numero_lotes * 100 : 0;

    // Financeiro
    $total_vendas = ($items_leilao->sum('price')) ?? 0;
    $total_vendas_ordens_compra = ($live_bids->where('sold_bid', 1)->where('bid_type', 'Pre sale internet bid')->sum('bid_price'));
    $vendas_ordens_compra_percentagem = ($total_vendas) ? $total_vendas_ordens_compra / $total_vendas * 100 : 0;
    $total_vendas_live = ($live_bids->where('sold_bid', 1)->where('bid_type', 'Internet user')->sum('bid_price'));
    $vendas_live_percentagem = ($total_vendas) ? $total_vendas_live / $total_vendas * 100 : 0;
    $total_bases = ($items_leilao->sum('start_price')) ?? 0;
    $total_bases_vendidos = ($items_leilao)->where('price', '>', 0)->sum('start_price');
    $total_estimativas = ($items_leilao->sum('max_estimate')) ?? 0;
    $total_estimativas_vendidos = ($items_leilao->where('price', '>', 0)->sum('max_estimate')) ?? 0;
    $total_comissao_cliente = $total_vendas * $leilao->commission_client;
    $total_comissao_fornecedores = ($items_leilao->sum('commission_seller')) ?? 0;
    $total_comissoes = $total_comissao_cliente + $total_comissao_fornecedores;

    // Licitações Ganhadoras Live vs Ordens de Compra
    $ordens_de_compra = $live_bids->where('bid_type', 'Pre sale internet bid')->count();
    $ordens_de_compra_win = $live_bids->where('bid_type', 'Pre sale internet bid')->where('sold_bid', 1)->count();
    $ordens_compra_percentagem_win = ($ordens_de_compra) ? $ordens_de_compra_win / $ordens_de_compra * 100 : 0;
    $licitacoes_live = $live_bids->where('bid_type', 'Internet user')->count();
    $licitacoes_live_win = $live_bids->where('bid_type', 'Internet user')->where('sold_bid', 1)->count();
    $licitacoes_live_win_percentagem = ($licitacoes_live) ? $licitacoes_live_win / $licitacoes_live * 100 : 0;
    $licitacoes = $ordens_de_compra + $licitacoes_live;

    // Licitantes
    $numero_licitantes_ordens_de_compra = $pre_bids->values()->unique('bidder_id')->count();
    $numero_licitantes_live = $live_bids->values()->unique('bidder_id')->count();
    $numero_compradores = $live_bids->where('sold_bid', 1)->values()->unique('bidder_id')->count();
    $numero_compradores_ordens_de_compra = $live_bids->where('sold_bid', 1)->where('bid_type', 'Pre sale internet bid')->values()->unique('bidder_id')->count();
    $numero_compradores_live = $live_bids->where('sold_bid', 1)->where('bid_type', 'Internet user')->values()->unique('bidder_id')->count();

    $totais = [
      // Lotes
      'lotes' => $numero_lotes,
      'lotes_vendidos' => $numero_lotes_vendidos,
      'percentagem_vendidos' => Number::percentage($percentagem_lotes_vendidos),

      // Financeiro
      'martelo' => Number::currency($total_vendas, in: 'EUR', locale: 'pt'),
      'martelo_ordens_compra' => Number::currency($total_vendas_ordens_compra, in: 'EUR', locale: 'pt'),
      'martelo_ordens_compra_percentagem' => Number::percentage($vendas_ordens_compra_percentagem),
      'martelo_live' => Number::currency($total_vendas_live, in: 'EUR', locale: 'pt'),
      'martelo_live_percentagem' => Number::percentage($vendas_live_percentagem),
      'bases' => Number::currency($total_bases, in: 'EUR', locale: 'pt'),
      'bases_vendidos' => Number::currency($total_bases_vendidos, in: 'EUR', locale: 'pt'),
      'estimativas' => Number::currency($total_estimativas, in: 'EUR', locale: 'pt'),
      'estimativas_vendidos' => Number::currency($total_estimativas_vendidos, in: 'EUR', locale: 'pt'),
      'total_comissao_cliente' => Number::currency($total_comissao_cliente, in: 'EUR', locale: 'pt'),
      'total_comissao_fornecedores' => Number::currency($total_comissao_fornecedores, in: 'EUR', locale: 'pt'),
      'total_comissoes' => Number::currency($total_comissoes, in: 'EUR', locale: 'pt'),

      // Licitações
      'numero_licitantes' => $licitantes->count(),
      'numero_licitantes_ordens_de_compra' => $numero_licitantes_ordens_de_compra,
      'numero_licitantes_live' => $numero_licitantes_live,
      'numero_compradores' => $numero_compradores,
      'numero_compradores_ordens_de_compra' => $numero_compradores_ordens_de_compra,
      'numero_compradores_live' => $numero_compradores_live,
      'licitacoes' => $licitacoes,
      'ordens_compra' => $ordens_de_compra,
      'ordens_compra_win' => $ordens_de_compra_win,
      'ordens_compra_win_percentagem' => Number::percentage($ordens_compra_percentagem_win),
      'licitacoes_live' => $licitacoes_live,
      'licitacoes_live_win' => $licitacoes_live_win,
      'licitacoes_live_win_percentagem' => Number::percentage($licitacoes_live_win_percentagem),
    ];
    return view('leiloes.show_processado', [
      'baseRoute' => '/leiloes',
      'title' => 'Leilões',
      'query' => $query,
      'leilao' => $leilao,
      'itemsLeilao' => $items_leilao,
      'preBids' => $pre_bids,
      'liveBids' => $live_bids,
      'licitantes' => $licitantes,
      'fornecedores' => $fornecedores,
      'totais' => $totais,
    ]);
  }


  // HTMX Items Leilao Filter in SHOW VIEW
  public function filter_items_leilao(Leiloes $leilao)
  {
    $search_string = request()->query('search');
    $items_leilao = DB::table('items_leilao')
      ->join('items_contrato', 'items_leilao.items_contrato_id', '=', 'items_contrato.id')
      ->select('items_leilao.*', 'items_contrato.seller_id', 'items_contrato.main_lang_name', 'items_contrato.contrato_id', 'items_contrato.contrato_index')
      ->where('leilao_id', $leilao->id)
      ->orderBy('leilao_lote', 'asc');
    if ($search_string) {
      $search_string = explode(' ', $search_string);
      $items_leilao->where(DB::raw('CONCAT(leilao_lote, " ", main_lang_name)'), 'like', '%' . $search_string[0] . '%');
      for ($i = 1; $i < count($search_string); $i++) {
        $items_leilao->where(DB::raw('CONCAT (leilao_lote, " ", main_lang_name)'), 'like', '%' . $search_string[$i] . '%');
      };
    }
    return view('leiloes.partials.lotes_de_leilao', [
      'itemsLeilao' => $items_leilao->get(),
      'totais' => [
        'lotes' => $items_leilao->count(),
      ],
      'leilao' => $leilao,
    ]);
  }


  // CREATE VIEW
  public function create()
  {
    $query = session()->get('query');
    $ultimoLeilao = DB::table('leiloes')->select('id')->orderBy('id', 'desc')->first();
    return view('leiloes.create', [
      'baseRoute' => '/leiloes',
      'title' => 'Leilões',
      'query' => $query,
      'ultimoLeilao' => $ultimoLeilao->id,
    ]);
  }

  // CRUD FUNCTIONS

  // STORE
  public function store(Request $request)
  {
    $formFields = $request->validate([
      'name' => 'required',
      'start_date' => 'required',
      'end_date' => 'required',
      'status' => 'nullable'
    ]);

    $lastLeilao = Leiloes::create($formFields);

    return redirect('/leiloes/' . $lastLeilao->id)->with('message', 'Leilão Criado com Sucesso');
  }

  // UPDATE
  public function update(Request $request, Leiloes $leilao)
  {
    $formFields = $request->validate([
      'name' => 'required',
      'start_date' => 'required',
      'end_date' => 'required',
      'status' => 'required',
      'commission_client' => 'required',
    ]);

    $leilao->update($formFields);

    return back()->with('message', 'Leilão Gravado com Sucesso');
  }

  // DELETE
  public function delete(Leiloes $leilao)
  {
    $query = session()->get('query');
    $leilao->delete();
    $this->refreshLeilaoID();
    return redirect('/leiloes' . $query)->with('message', 'Leilão apagado com sucesso');
  }

  // Reset Auto Increment de Número de Leilão depois de DELETE
  public function refreshLeilaoID()
  {
    $max = DB::table('leiloes')->max('id') + 1;
    DB::statement("ALTER TABLE leiloes AUTO_INCREMENT =  $max");
  }

  //Lista de Retirados
  public function retirados(Leiloes $leilao)
  {
    $lotes = ItemsLeilao::where('leilao_id', $leilao->id)->where('sold', '0')->with('itemsContrato')->get();
    return view('leiloes.print.retirados', [
      'leilao' => $leilao,
      'lotes' => $lotes
    ]);
  }
  //Lista de Catalogo
  public function catalogo(Leiloes $leilao)
  {
    $lotes = ItemsLeilao::where('leilao_id', $leilao->id)->orderBy('leilao_lote', 'asc')->with('itemsContrato')->get();
    return view('leiloes.print.catalogo', [
      'leilao' => $leilao,
      'lotes' => $lotes
    ]);
  }
}
