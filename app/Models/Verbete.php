<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Facades\DB;

class Verbete extends Model
{
    use HasFactory;

    // RELATIONSHIPS

    // ITEMS DE CONTRATO
    public function itemsContrato(): HasMany
    {
        return $this->hasMany(ItemsContrato::class);
    }

    // ITEMS DE LEILÃO
    public function itemsLeilao(): HasManyThrough
    {
        return $this->hasManyThrough(ItemsLeilao::class, ItemsContrato::class);
    }

    // COMPRADORES
    public function compradores(int $verbete_id)
    {
        $compradores = collect(DB::select(
            '
            SELECT *
            FROM clientes
            WHERE clientes.id in
            ( SELECT items_leilao.buyer_id
            FROM items_leilao
            JOIN items_contrato
            ON items_contrato.id = items_leilao.items_contrato_id
            WHERE items_contrato.verbete_id =' . $verbete_id . ')'
        ));

        return $compradores;
    }

    // LICITANTES
    public function licitantes(int $verbete_id)
    {
        $licitantes = collect(DB::select(
            '
            SELECT *
            FROM clientes
            WHERE clientes.id in (
                SELECT licitacoes.bidder_id
 	            FROM licitacoes
                JOIN items_contrato
                ON items_contrato.id = licitacoes.items_contrato_id
                WHERE items_contrato.verbete_id = ' . $verbete_id . ')'
        ));

        return $licitantes;
    }

    // QUICK SEARCH
    public function scopeFilter($query, array $filters)
    {
        if (isset($filters['search']) ?? false) {
            global $searchString;
            $searchString = explode(' ', $filters['search']);
            $concat = "CONCAT(name, ' ', id)";
            $query->where(DB::raw($concat), 'like', '%' . $searchString[0] . '%');
            for ($i = 1; $i < count($searchString); $i++) {
                $query->where(DB::raw($concat), 'like', '%' . $searchString[$i] . '%');
            }
        }
    }
}
