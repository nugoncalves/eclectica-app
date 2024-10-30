<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Pagamentos extends Model
{
    use HasFactory;
    public $timestamps = false;


    protected function getMarteloAttribute()
    {
        return $this->itemsLeilao()->sum('price');
    }

    protected function getComissaoAttribute()
    {
        return $this->itemsLeilao()->sum('commission_seller');
    }

    protected function getIvaAttribute()
    {
        $comissao = $this->comissao;
        return $comissao * .23;
    }

    protected function getPagoAttribute()
    {
        $martelo = $this->martelo;
        $comissao = $this->comissao;
        $iva = $comissao * .23;
        return $martelo - $comissao - $iva;
    }

    // QUICK SEARCH
    public function scopeFilter($query, array $filters)
    {
        if (isset($filters['search']) ?? false) {
            global $searchString;
            $searchString = explode(' ', $filters['search']);
            $concat = "CONCAT(id, ' ', leilao_id, ' ', seller_id)";
            $query->where(DB::raw($concat), 'like', '%' . $searchString[0] . '%');
            for ($i = 1; $i < count($searchString); $i++) {
                $query->where(DB::raw($concat), 'like', '%' . $searchString[$i] . '%');
            }
        }
    }


    public function fornecedor(): HasOne
    {
        return $this->hasOne(Cliente::class, 'id', 'seller_id');
    }

    public function leilao(): HasOne
    {
        return $this->hasOne(Leiloes::class, 'id', 'leilao_id');
    }

    public function itemsLeilao(): HasManyThrough
    {

        return $this->hasManyThrough(
            ItemsLeilao::class,
            ItemsContrato::class,
            'pagamento_id',
            'items_contrato_id',
            'id',
            'id'
        );
    }
}
