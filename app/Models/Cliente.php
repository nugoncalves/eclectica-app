<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    public $timestamps = false;

    public function compras(): HasMany
    {
        return $this->hasMany(ItemsLeilao::class, 'buyer_id', 'id');
    }

    public function contratos(): HasMany
    {
        return $this->hasMany(Contratos::class, 'seller_id', 'id');
    }

    public function lotesFornecedor(): HasMany
    {
        return $this->hasMany(ItemsContrato::class, 'seller_id', 'id')->with('itemsLeilaoLast');
    }

    public function colocacoesFornecedor(): HasManyThrough
    {
        return $this->hasManyThrough(
            ItemsLeilao::class,
            ItemsContrato::class,
            'seller_id',
            'items_contrato_id',
            'id',
            'id'
        );
    }

    public function listaLeiloesFornecedor()
    {
        $leiloes = $this->colocacoesFornecedor()
            ->join('leiloes', 'items_leilao.leilao_id', '=', 'leiloes.id')
            ->select('leiloes.*')
            ->get();
        return $leiloes->unique('id');
    }

    public function scopeFornecedores(Builder $query): void
    {
        $query->where('seller', '=', 'true');
    }

    // Função de Pesquisa
    public function scopeFilter($query, array $filters)
    {
        if (isset($filters['search']) ?? false) {
            global $searchString;
            $searchString = explode(' ', $filters['search']);
            $concat = "CONCAT(full_name, ' ', id, ' ', email, ' ', phone, ' ', seller_reference)";
            $query->where(DB::raw($concat), 'like', '%' . $searchString[0] . '%');
            for ($i = 1; $i < count($searchString); $i++) {
                $query->where(DB::raw($concat), 'like', '%' . $searchString[$i] . '%');
            }
        }
    }
}
