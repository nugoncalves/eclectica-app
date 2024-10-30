<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\LeiloesController;
use App\Http\Controllers\VerbeteController;
use App\Http\Controllers\ContratosController;
use App\Http\Controllers\BidsImportController;
use App\Http\Controllers\PagamentosController;
use App\Http\Controllers\ItemsLeilaoController;
use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\ItemsContratoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/*
|---------------------------------------------------------------
| LOGIN ROUTES
|---------------------------------------------------------------
*/

// LOGIN PAGE
Route::get('/', function () {
    if (auth()->user()) {
        return redirect()->intended('clientes');
    } else {

        return view('login');
    }
})->name('login');

// LOGIN AUTHENTICATOR
Route::post('login', [AuthenticateController::class, 'login']);

//LOGOUT
Route::DELETE('/logout', [AuthenticateController::class, 'logout']);

/*
|---------------------------------------------------------------
| ROUTES AFTER LOGIN SUCCESS
|---------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /*
    |---------------------------------------------------------------
    | VERBETES ROUTES
    |---------------------------------------------------------------
    */

    // List View
    Route::get('/verbetes', [VerbeteController::class, 'index']);

    // Create View
    Route::get('/verbetes/create', [VerbeteController::class, 'create']);

    //Store Route
    Route::post('/verbetes', [VerbeteController::class, 'store']);

    /*
    |---------------------------------------------------------------
    | MODAL VERBETES ROUTES
    |---------------------------------------------------------------
    */

    // Modal List View
    Route::get('/verbetes/modal', [VerbeteController::class, 'indexModal']);

    // Modal Create
    Route::get('/verbetes/modal/create', [VerbeteController::class, 'createModal']);

    // Modal Form View
    Route::get('/verbetes/modal/{verbete}', [VerbeteController::class, 'showModal']);

    // Update Verbete
    Route::put('/verbetes/modal/{verbete}', [VerbeteController::class, 'updateModal']);

    //Store Route
    Route::post('/verbetes/modal', [VerbeteController::class, 'storeModal']);

    // Duplicate Verbete
    Route::get('/verbetes/modal/{verbete}/duplicate', [VerbeteController::class, 'duplicateModal']);

    // Edit Verbete
    Route::get('/verbetes/modal/{verbete}/edit', [VerbeteController::class, 'editModal']);

    // FIM MODAL VERBETES ROUTES

    // Form View
    Route::get('/verbetes/{verbete}', [VerbeteController::class, 'show']);

    // Update Verbete
    Route::put('/verbetes/{verbete}', [VerbeteController::class, 'update']);

    // Delete Verbete
    Route::delete('/verbetes/{verbete}', [VerbeteController::class, 'delete']);

    // Duplicate Verbete
    Route::get('/verbetes/{verbete}/duplicate', [VerbeteController::class, 'duplicate']);

    // Print View
    Route::get('/verbetes/print/{verbete}', [VerbeteController::class, 'print']);

    /*
    |---------------------------------------------------------------
    | LOTES [ITEMS CONTRATO] ROUTES
    |---------------------------------------------------------------
    */

    // List View
    Route::get('/lotes', [ItemsContratoController::class, 'index']);

    // HTMX Get Dados de Contrato
    Route::get('/lotes/dadosContrato', [ItemsContratoController::class, 'dadosContrato']);

    // Create View
    Route::get('/lotes/create', [ItemsContratoController::class, 'create']);

    // Form View
    Route::get('/lotes/{lote}', [ItemsContratoController::class, 'show']);

    // Edit View
    Route::get('lotes/{lote}/edit', [ItemsContratoController::class, 'edit']);

    // Print View
    Route::get('lotes/{lote}/print', [ItemsContratoController::class, 'print']);

    //Store Route
    Route::post('/lotes', [ItemsContratoController::class, 'store']);

    // Update Lote
    Route::put('/lotes/{lote}', [ItemsContratoController::class, 'update']);

    // Update Dados Contrato
    Route::put('/lotes/{lote}/update', [ItemsContratoController::class, 'updateDadosContrato']);

    // Delete Lote
    Route::delete('/lotes/{lote}', [ItemsContratoController::class, 'delete']);

    // Duplicate Lote
    Route::get('/lotes/{lote}/duplicate', [ItemsContratoController::class, 'duplicate']);

    // Print View [DESACTIVADO]
    // Route::get('/lotes/print/{lote}', [VerbeteController::class, 'print']);

    /*
    |---------------------------------------------------------------
    | IMAGENS ROUTES
    |---------------------------------------------------------------
    */

    //Imagens Show
    Route::get('/lotes/{id}/imagens', [ItemsContratoController::class, 'showImages'])->name('imagens.show');

    //Imagens Create
    Route::post('/lotes/imagens/{id}', [ItemsContratoController::class, 'storeImage']);

    //Apagar Imagens
    Route::delete('/imagens/{id}', [ItemsContratoController::class, 'destroyImage'])->name('imagens.destroy');

    /*
    |---------------------------------------------------------------
    | COLOCAÇÕES [ITEMS LEILÃO] ROUTES
    |---------------------------------------------------------------
    */

    //Histórico de Presenças em Leilão
    Route::get('/historico/{id}', [ItemsLeilaoController::class, 'historico']);

    //Update Status Lote
    Route::put('/historico/{item_leilao}', [ItemsLeilaoController::class, 'updateStatus']);

    //Offcanvas Items Contrato
    Route::get('/offcanvas/{id}', [ItemsContratoController::class, 'offcanvas']);

    // Maior Item Contrato
    Route::get('/itemsContrato/maxItemContrato', [ItemsContratoController::class, 'ultimoContratoItem']);

    // Maior Lote de Leilão
    Route::get('/itemsContrato/maxLoteLeilao', [ItemsLeilaoController::class, 'maxLoteLeilao']);

    //Store Items Leilão [Colocações]
    Route::post('/itemsLeilao', [ItemsLeilaoController::class, 'store']);

    // Update Items Leilão [Colocações]
    Route::put('/itemsLeilao/{itemLeilao}', [ItemsLeilaoController::class, 'update']);

    // Delete Lote
    Route::delete('/itemsLeilao/{itemLeilao}', [ItemsLeilaoController::class, 'delete']);


    // Print Leilão Label
    Route::get('/itemsLeilao/print/label/{lote}', [ItemsLeilaoController::class, 'printLabel']);

    // Exportar Lotes de Leilão
    Route::get('lotes/export/{leilao}', [ItemsLeilaoController::class, 'downloadZip']);

    /*
    |---------------------------------------------------------------
    | LEILÕES ROUTES
    |---------------------------------------------------------------
    */

    // List View
    Route::get('/leiloes', [LeiloesController::class, 'index']);

    // Create View
    Route::get('/leiloes/create', [LeiloesController::class, 'create']);

    // Show View
    Route::get('/leiloes/{leilao}', [LeiloesController::class, 'show']);

    //Lista de Retirados
    Route::get('/leiloes/retirados/{leilao}', [LeiloesController::class, 'retirados']);

    //Lista de Catálogo
    Route::get('/leiloes/catalogo/{leilao}', [LeiloesController::class, 'catalogo']);

    // Filter Lotes
    Route::get('/leiloes/filter_lotes/{leilao}', [LeiloesController::class, 'filter_items_leilao']);

    //Store
    Route::post('/leiloes', [LeiloesController::class, 'store']);

    //Update
    Route::put('leiloes/{leilao}', [LeiloesController::class, 'update']);

    //Delete
    Route::delete('leiloes/{leilao}', [LeiloesController::class, 'delete']);

    /*
    |------------------------------------------------------------
    | LEILÕES IMPORT ROUTES
    |------------------------------------------------------------
    */

    //Import View
    Route::post('leiloes/import/{leilao}', [BidsImportController::class, 'import']);

    //Confirm Import
    Route::post('leiloes/import/confirm/{leilao}', [BidsImportController::class, 'confirm']);

    /*
    |---------------------------------------------------------------
    | CLIENTES ROUTES
    |---------------------------------------------------------------
    */

    // Modal List View
    Route::get('/clientes/modal', [ClienteController::class, 'indexModal']);

    // Modal Create
    Route::get('/clientes/modal/create', [ClienteController::class, 'createModal']);

    // Modal Form View
    Route::get('/clientes/modal/{cliente}', [ClienteController::class, 'showModal']);

    // Modal Update
    Route::put('/clientes/modal/{cliente}', [ClienteController::class, 'updateModal']);

    // Modal Store Route
    Route::post('/clientes/modal', [ClienteController::class, 'storeModal']);

    // Modal Duplicate Cliente
    Route::get('/clientes/modal/{cliente}/duplicate', [ClienteController::class, 'duplicateModal']);

    // Modal Edit Cliente
    Route::get('/clientes/modal/{cliente}/edit', [ClienteController::class, 'editModal']);

    //Show List Clientes
    Route::get('/clientes', [ClienteController::class, 'index']);

    //Create Cliente
    Route::get('/clientes/create', [ClienteController::class, 'create']);

    //Import Clientes
    Route::get('/clientes/import', [ClienteController::class, 'import']);

    //Show Single Client
    Route::get('/clientes/{cliente}', [ClienteController::class, 'show']);

    //Create Cliente
    Route::post('/clientes', [ClienteController::class, 'store']);

    //Confirm Import Clientes
    Route::post('/clientes/import/confirm', [ClienteController::class, 'confirm']);

    //Update Cliente
    Route::put('/clientes/{cliente}', [ClienteController::class, 'update']);

    //Print Shipping Label From Cliente
    Route::get('/clientes/{id}/shippingLabel', [ClienteController::class, 'shippingLabel']);

    //Print Not Stored Shipping Label
    Route::get('/printLabel', [ClienteController::class, 'shippingLabelEmpty']);

    /*
    |---------------------------------------------------------------
    | FORNECEDORES ROUTES
    |---------------------------------------------------------------
    */

    //List Fornecedores
    Route::get('/fornecedores', [ClienteController::class, 'fornecedores']);

    //Show Fornecedor
    Route::get('/fornecedores/{fornecedor}', [ClienteController::class, 'showFornecedor']);

    //Fornecedor Lotes
    Route::get('/fornecedores/lotes/{fornecedor}', [ClienteController::class, 'lotesFornecedor']);


    // Fornecedores Export
    Route::get('/fornecedores/exportLotes/{fornecedor}', [ItemsContratoController::class, 'exportLotesFornecedor']);

    /*
    |---------------------------------------------------------------
    | Contratos ROUTES
    |---------------------------------------------------------------
    */

    //Show List Contratos
    Route::get('/contratos', [ContratosController::class, 'index']);

    Route::get('/contratos/create', [ContratosController::class, 'create']);

    //Show Single Contrato
    Route::get('/contratos/{contrato}', [ContratosController::class, 'show']);

    //Add Lotes aos Contratos
    Route::get('/contratos/addLotes/{contrato}', [ContratosController::class, 'addLotes']);

    //HTMX ItemContrato
    Route::get('/contratos/filter_items/{contrato}', [ContratosController::class, 'filter_items_contrato']);

    //Create Contrato
    Route::post('/contratos', [ContratosController::class, 'store']);

    //Create Item Contrato
    Route::post('/contratos/createItemContrato/{contrato}', [ContratosController::class, 'createItemContrato']);

    //Update Contratos
    Route::put('/contratos/{contrato}', [ContratosController::class, 'update']);

    //Delete Contrato
    Route::delete('/contratos/{contrato}', [ContratosController::class, 'destroy']);



    /*
    |---------------------------------------------------------------
    | PAGAMENTOS ROUTES
    |---------------------------------------------------------------
    */

    // Lista de Pagamentos
    Route::get('/pagamentos', [PagamentosController::class, 'index']);

    //Lista de Próximos Pagamentos Previstos
    Route::get('/pagamentos/proximos', [PagamentosController::class, 'proFormaIndex']);

    //Lista de Lotes para Processar
    Route::get('/pagamentos/proximos/{seller_id}/{leilao_id}', [PagamentosController::class, 'proFormaShow']);

    //Route para Update de Totais
    Route::post('/pagamentos/totais', [PagamentosController::class, 'totais']);

    //Route para Show de Pagamento Único
    Route::get('/pagamentos/{pagamento}', [PagamentosController::class, 'show'])->name('pagamentos.show');

    //Route para Show de Pagamento Impressão
    Route::get('/pagamentos/imprimir/{pagamento}', [PagamentosController::class, 'imprimir']);

    //Route para upload de Anexos
    Route::post('/uploadAnexo/{pagamento}', [PagamentosController::class, 'uploadAnexo'])->name('upload.file');

    Route::get('/uploadAnexo/{pagamento}', [PagamentosController::class, 'uploadAnexo']);

    //Route para criar Pagamento
    Route::post('/pagamentos', [PagamentosController::class, 'store']);

    //Route para Update Pagamentos
    Route::put('/pagamentos/{pagamento}', [PagamentosController::class, 'update']);

    //Route para dar delete ao Anexo
    Route::delete('/deleteAnexo/{comprovativo}', [PagamentosController::class, 'deleteAnexo']);


    /*
|---------------------------------------------------------------
| GENERAL ROUTES
|---------------------------------------------------------------
*/



    //Ficha de Cliente em OffCanvas
    Route::get('clientes/offCanvasView/{id}', [ClienteController::class, 'clienteOffcanvas']);


    /*
|---------------------------------------------------------------
| USER MANUAL ROUTES
|---------------------------------------------------------------
*/

    Route::get('/manual', function () {
        return view('manual.index', [
            'baseRoute' => '/manual'
        ]);
    });

    Route::get('/manual/clientes', function () {
        return view('manual.clientes', [
            'baseRoute' => '/manual/clientes',
        ]);
    });
    Route::get('/manual/leiloes', function () {
        return view('manual.leiloes', [
            'baseRoute' => '/manual/leiloes',
        ]);
    });

    Route::get('/manual/lotes', function () {
        return view('manual.lotes', [
            'baseRoute' => '/manual/lotes',
        ]);
    });

    Route::get('/manual/contratos', function () {
        return view('manual.contratos', [
            'baseRoute' => '/manual/contratos',
        ]);
    });

    Route::get('/manual/verbetes', function () {
        return view('manual.verbetes', [
            'baseRoute' => '/manual/verbetes',
        ]);
    });
});
