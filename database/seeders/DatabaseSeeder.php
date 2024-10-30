<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $tables = [
            'bids_imports',
            'clientes',
            'contratos',
            'items_contrato',
            'items_leilao',
            'leiloes',
            'licitacoes',
            'verbetes',
            'user',
            // Adicione mais tabelas conforme necessário
        ];

        foreach ($tables as $table) {
            $this->seedTable($table);
        }
    }

    private function seedTable($tableName)
    {
        // Ler o conteúdo do arquivo JSON
        $jsonContent = file_get_contents(__DIR__ . "/databaseJson/$tableName.json");

        // Descodificar o JSON em um array associativo
        $data = json_decode($jsonContent, true);
        if ($data != null) {
            // Inserir os dados em lotes menores
            $chunkedData = array_chunk($data, 1000); // Dividir em lotes de 1000 registos

            foreach ($chunkedData as $chunk) {
                if (!empty($chunk)) {
                    // Inserir os dados na tabela correspondente
                    DB::table($tableName)->insert($chunk);
                }
            }
        }
    }
}
