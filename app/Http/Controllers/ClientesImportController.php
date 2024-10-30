<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientesImport;
use App\Imports\ClientesExcelImport;
use Maatwebsite\Excel\Facades\Excel;

class ClientesImportController extends Controller
{
    public function import()
    {

        //verifica se o ficheiro está presente
        $clientes_file = request()->file('clientes_import');
        if (empty($clientes_file)) {
            return view('components.htmx-warning')->with('warning', 'Por favor seleccione o ficheiro com os dados para importar novos clientes.');
        };

        //Começa a importação
        $import = Excel::toCollection(new ClientesExcelImport, request()->file('clientes_import'));
    }
}
