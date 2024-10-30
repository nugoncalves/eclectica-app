<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Leiloes;
use App\Models\ItemsLeilao;
use Illuminate\Http\Request;
use App\Models\ItemsContrato;
use Illuminate\Support\Number;
use Illuminate\Support\Facades\DB;
use App\Imports\ClientesExcelImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Contracts\Database\Query\Builder;

class ClienteController extends Controller
{
    //
    //Lista Cliente
    public function index(Request $query)
    {
        $query = $this->queryString(request()->query());
        session(['query' => $query]);
        $clientes = Cliente::filter(request()->query())->orderBy('ID', 'desc')->paginate(30);
        return view('clientes.index', [
            'baseRoute' => '/clientes',
            'query' => $query,
            'title' => 'Clientes',
            'clientes' => $clientes,
        ]);
    }

    //Formulário
    public function show(Cliente $cliente)
    {
        $query = session()->get('query');
        $compras = $cliente->compras()->orderBy('leilao_id', 'desc')->get();
        // Obtém o valor das compras do ano corrente do cliente (A IMPLEMENTAR)
        // $compras_ano_actual = $cliente
        //     ->compras()
        //     ->whereHas('leilao', function ($query) {
        //         $query->whereYear('end_date', date('Y'));
        //     })
        //     ->get();
        $total_compras = Number::currency($compras->sum('price'), in: 'EUR', locale: 'PT');
        $lotes_comprados = $compras->count();
        return view('clientes.show', [
            'cliente' => $cliente,
            'total_compras' => $total_compras,
            'numero_lotes_comprados' => $lotes_comprados,
            'compras' => $compras,
            'baseRoute' => '/clientes',
            'title' => 'Clientes',
            'query' => $query,
        ]);
    }
    // Função para obter dados estatísticos dos clientes (POR IMPLEMENTAR NA TOTALIDADE)
    public function estatisticas(Cliente $cliente)
    {
        $compras = $cliente->compras()->orderBy('leilao_id', 'desc')->get();
        $valor_compras = Number::currency($compras->sum('preco'), in: 'EUR', locale: 'PT');
        $numero_lotes_comprados = $compras->count();
        $numero_lotes_licitados = '';
        $valor_compras_ano_actual = '';
        $numero_lotes_comprados_ano_actual = '';
        $numero_lotes_licitados_ano_actual = '';
        $compras_ano_anterior = '';
        $valor_compras_ano_anterior = '';
        $numero_lotes_comprados_ano_anterior = '';
        $numero_lotes_licitados_ano_anterior = '';
    }

    //Update
    public function update(Request $request, Cliente $cliente)
    {
        $fields = $request;
        if ($fields['seller'] == 'false') {
            $fields['seller_reference'] = '';
        }
        $cliente->update([
            'first_name' => $fields['first_name'],
            'last_name' => $fields['last_name'],
            'email' => $fields['email'],
            'phone' => $fields['phone'],
            'address' => $fields['address'],
            'zip' => $fields['zip'],
            'city' => $fields['city'],
            'state' => $fields['state'],
            'country' => $fields['country'],
            'seller' => $fields['seller'],
            'seller_reference' => $fields['seller_reference'],
            'shipping_saudacao' => $fields['shipping_saudacao'],
            'shipping_name' => $fields['shipping_name'],
            'shipping_address' => $fields['shipping_address'],
            'shipping_zip' => $fields['shipping_zip'],
            'shipping_city' => $fields['shipping_city'],
            'shipping_state' => $fields['shipping_state'],
            'shipping_country' => $fields['shipping_country'],
        ]);

        return back()->with('message', 'Cliente Gravado com Sucesso');
    }

    //Formulário de Criação
    public function create()
    {
        $query = session()->get('query');
        return view('clientes.create', [
            'title' => 'Clientes',
            'baseRoute' => '/clientes',
            'query' => $query,
        ]);
    }

    //Store
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'nullable',
            'email' => 'nullable',
            'phone' => 'nullable',
            'address' => 'nullable',
            'zip' => 'nullable',
            'city' => 'nullable',
            'state' => 'nullable',
            'country' => 'nullable',
            'seller' => 'required',
            'seller_reference' => 'nullable',
            'shipping_saudacao' => 'nullable',
            'shipping_name' => 'nullable',
            'shipping_address' => 'nullable',
            'shipping_zip' => 'nullable',
            'shipping_city' => 'nullable',
            'shipping_state' => 'nullable',
            'shipping_country' => 'nullable',
        ]);

        $formFields['origin'] = 'CREATED';
        $formFields['added'] = now()->addHours(1)->format('d/m/Y');
        $lastClient = Cliente::create($formFields);
        return redirect('/clientes/' . $lastClient->id)->with('message', 'Cliente Criado com Sucesso');
    }

    // Abre o Formulário de Importação de Clientes da BidSpirit
    public function import()
    {
        return view('clientes.import', [
            'title' => 'Clientes Import',
            'baseRoute' => '/clientes',
            'query' => '',
        ]);
    }

    //Confirma a importação dos dados
    public function confirm(Request $request)
    {
        $file = $request->clientes_import;
        $importData = Excel::import(new ClientesExcelImport(), request()->file('clientes_import'));
        return redirect('/clientes')->with('message', 'Clientes Importados com sucesso');
    }

    //Mostra alguns dados de Cliente em OffCanvas
    public function clienteOffcanvas($id)
    {
        $cliente = Cliente::find($id);
        return view('partials.clienteOffCanvas', [
            'cliente' => $cliente,
        ]);
    }

    //Imprime a Etiqueta Envio
    public function shippingLabel($id)
    {
        $cliente = Cliente::find($id);
        // dd($cliente);
        return view('clientes.print.etiquetaEnvio', [
            'cliente' => $cliente,
        ]);
    }

    // Imprime a Etiqueta Genérica [não guardada]
    public function shippingLabelEmpty(Request $request)
    {
        $cliente = $request;
        return view('clientes.print.etiquetaEnvioNotStored', [
            'cliente' => $cliente,
        ]);
    }

    // CLIENTE EM MODAL FUNÇÕES
    // Lista de Clientes
    public function indexModal(Request $request)
    {
        if ($request->filled('search')) {
            $clientes = Cliente::filter(request(['search']))->get();
            return view('clientes.modal.index', [
                'clientes' => $clientes, // RowsData
            ]);
        }
    }

    // Formulário de Cliente
    public function showModal(Cliente $cliente)
    {
        $query = session()->get('query');
        $compras = $cliente->compras;
        $total_compras = Number::currency($compras->sum('price'), in: 'EUR', locale: 'PT');
        $lotes_comprados = $compras->count();
        return view('clientes.modal.show', [
            'cliente' => $cliente,
            'total_compras' => $total_compras,
            'numero_lotes_comprados' => $lotes_comprados,
            'compras' => $compras,
            'baseRoute' => '/clientes',
            'title' => 'Clientes',
            'query' => $query,
        ]);
    }

    // Formulário de Edição de cliente
    public function editModal(Cliente $cliente)
    {
        return view('clientes.modal.edit', [
            'cliente' => $cliente,
        ]);
    }

    // Update
    public function updateModal(Request $request, Cliente $cliente)
    {
        $formFields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'nullable',
            'email' => 'nullable',
            'phone' => 'nullable',
            'address' => 'nullable',
            'zip' => 'nullable',
            'city' => 'nullable',
            'state' => 'nullable',
            'country' => 'nullable',
            'seller' => 'required',
            'seller_reference' => 'nullable',
            'shipping_saudacao' => 'nullable',
            'shipping_name' => 'nullable',
            'shipping_address' => 'nullable',
            'shipping_zip' => 'nullable',
            'shipping_city' => 'nullable',
            'shipping_state' => 'nullable',
            'shipping_country' => 'nullable',
        ]);

        if ($formFields['seller'] == 'false') {
            $formFields['seller_reference'] = '';
        }

        $cliente->update($formFields);
        $query = session()->get('query');
        $compras = $cliente->compras;
        $total_compras = Number::currency($compras->sum('price'), in: 'EUR', locale: 'PT');
        $lotes_comprados = $compras->count();
        return view('clientes.modal.show', [
            'cliente' => $cliente,
            'total_compras' => $total_compras,
            'numero_lotes_comprados' => $lotes_comprados,
            'compras' => $compras,
            'baseRoute' => '/clientes',
            'title' => 'Clientes',
            'query' => $query,
        ]);
    }

    // Formulário de Criação de novo Cliente
    public function createModal()
    {
        $query = session()->get('query');
        return view('clientes.modal.create', [
            'query' => $query,
            'lastClient' => Cliente::orderByDesc('id')->first()->id + 1,
        ]);
    }

    // Duplicar Registo de Cliente
    public function duplicateModal(Cliente $cliente)
    {
        //Conseguimos passar um campo no método replicate para ele eliminar o valor desse campo no array.
        $dupCliente = $cliente->replicate(['all_name']);
        $dupCliente->last_name = $cliente->last_name . ' (Duplicado)';
        $dupCliente->save();
        $query = session()->get('query');
        $compras = $dupCliente->compras;
        $total_compras = Number::currency($compras->sum('price'), in: 'EUR', locale: 'PT');
        $lotes_comprados = $compras->count();
        return view('clientes.modal.show', [
            'cliente' => $dupCliente,
            'total_compras' => $total_compras,
            'numero_lotes_comprados' => $lotes_comprados,
            'compras' => $compras,
            'baseRoute' => '/clientes',
            'title' => 'Clientes',
            'query' => $query,
        ]);
    }


    /*
    |---------------------------------------------------------------
    | FORNECEDORES 
    |---------------------------------------------------------------
    */

    //Lista Fornecedores
    public function fornecedores(Request $query)
    {
        $query = $this->queryString(request()->query());
        session(['query' => $query]);
        $fornecedores = Cliente::filter(request()->query())->orderBy('ID', 'desc')->fornecedores()->paginate(30);
        return view('fornecedores.index', [
            'baseRoute' => '/fornecedores',
            'query' => $query,
            'title' => 'Fornecedores',
            'fornecedores' => $fornecedores,
        ]);
    }

    //Formulário Fornecedor
    public function showFornecedor(Cliente $fornecedor)
    {
        // $contratos = $fornecedor->contratos()->get()->sortByDesc('id');
        // $colocacoes = $fornecedor->colocacoesFornecedor()->get();
        // $leiloes = Leiloes::find($colocacoes->unique('leilao_id')->pluck('leilao_id'))->sortByDesc('id');
        // $itemsContrato = $fornecedor->lotesFornecedor()->get();
        // dd($itemsContrato[0]);
        // $total_martelo = Number::currency($colocacoes->sum('price'), in: 'EUR', locale: 'pt');
        // $total_comissao = Number::currency($colocacoes->sum('commission_seller'), in: 'EUR', locale: 'pt');
        $query = session()->get('query');
        return view('fornecedores.show', [
            'fornecedor' => $fornecedor,
            // 'contratos' => $contratos,
            // 'leiloes' => $leiloes,
            // 'items_contrato' => $itemsContrato,
            // 'colocacoes' => $colocacoes,
            // 'total_martelo' => $total_martelo,
            // 'total_comissao' => $total_comissao,
            // 'disponiveis' => $itemsContrato->where('status', '=', 'disponivel')->count(),
            'baseRoute' => '/fornecedores',
            'title' => 'Ficha de Fornecedor',
            'query' => $query,
        ]);
    }

    //Lotes de Fornecedor
    public function lotesFornecedor(Cliente $fornecedor)
    {

        $search_string = request()->query('search');
        $itemsContrato = $fornecedor->lotesFornecedor();
        if ($search_string) {
            $search_string = explode(' ', $search_string);
            $itemsContrato->where(DB::raw('CONCAT(contrato_id, "-", contrato_index, " ", main_lang_name)'), 'like', '%' . $search_string[0] . '%');
            for ($i = 1; $i < count($search_string); $i++) {
                $itemsContrato->where(DB::raw('CONCAT (contrato_id, "-", contrato_index, " ", main_lang_name)'), 'like', '%' . $search_string[$i] . '%');
            };
        }
        return view('fornecedores.partials.lotes', [
            'items_contrato' => $itemsContrato->paginate(30),
            'fornecedor' => $fornecedor,
        ]);
    }


    // Função que parte os elementos da pesquisa para um array e para uso de %LIKE% AND %LIKE%...
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
}
