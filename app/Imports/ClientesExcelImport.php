<?php

namespace App\Imports;

use App\Models\Cliente;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class ClientesExcelImport implements ToModel, WithUpserts, WithHeadingRow
{

    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Cliente([
            'id' => $row['number'],
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'id_card_number' => $row['id'],
            'nif' => $row['tax_number'],
            'status' => $row['status'],
            'country' => $row['country'],
            'state' => $row['state'],
            'city' => $row['city'],
            'address' => $row['address'],
            'zip' => $row['zip'],
            'shipping_country' => $row['shipping_country'],
            'shipping_state' => $row['shipping_state'],
            'shipping_city' => $row['shipping_city'],
            'shipping_address' => $row['shipping_address'],
            'added' => $row['added'],
            'origin' => $row['origin']

        ]);
    }

    public function uniqueBy()
    {
        return 'id';
    }
}
