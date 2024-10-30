<?php

namespace App\Models;

use App\Models\Licitacoes;
use Awobaz\Compoships\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Support\Facades\DB;

class ItemsLeilao extends Model
{
    use HasFactory;
    use \Awobaz\Compoships\Compoships;

    protected $table = 'items_leilao';

    public function itemsContrato(): HasOne
    {
        return $this->hasOne(ItemsContrato::class, 'id', 'items_contrato_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ImgLotes::class, 'items_contrato_id', 'items_contrato_id');
    }

    public function contrato()
    {
        $item_contrato_id = $this->items_contrato_id;
        $contrato = DB::select(
            '
            SELECT *
            FROM contratos
            WHERE contratos.id in
            ( SELECT items_contrato.contrato_id
            FROM items_contrato
            WHERE items_contrato.id =' . $item_contrato_id . ')'
        );
        return $contrato;
    }

    public function leilao(): HasOne
    {
        return $this->hasOne(Leiloes::class, 'id', 'leilao_id');
    }

    public function cliente(): HasOne
    {
        $cliente = $this->hasOne(Cliente::class, 'id', 'buyer_id');
        return $cliente;
    }


    public function comprador(): HasOne
    {
        return $this->hasOne(Cliente::class, 'id', 'buyer_id');
    }

    public function licitacoes(): HasMany
    {
        $licitacoes = $this->hasMany(Licitacoes::class, 'items_leilao_id', 'id')
            ->join('clientes', 'clientes.id', '=', 'licitacoes.bidder_id');
        return $licitacoes;
    }

    public function resultado(ItemsLeilao $itemLeilao)
    {
        $resultado = Licitacoes::where('leilao_id', '=', $itemLeilao->leilao_id)
            ->where('lot_index', '=', $itemLeilao->leilao_lote)
            ->where('sold_bid', '=', 1)
            ->first();
        return $resultado;
    }


    public function comissoes()
    {
        // $item = ItemsLeilao::find($itemLeilao);
        $price = $this->price;
        $leilao = $this->leilao()->first();
        $commission_buyer = $leilao->commission_client * $price;
        $contrato = collect($this->contrato())->first();
        $commission_seller = 0;
        if (ucwords($contrato->commission_type) == 'Fixa') {
            $commission_seller = $price * $contrato->commission_300;
        }
        if (ucwords($contrato->commission_type) == 'Progressiva') {
            $price_more_3000 = max($price - 3000, 0);
            $commission_seller = ($price_more_3000 * $contrato->commission_more_3000);
            $price_3000 = max($price - $price_more_3000 - 1000, 0);
            $commission_seller = $commission_seller + ($price_3000 * $contrato->commission_3000);
            $price_1000 = max($price - $price_more_3000 - $price_3000 - 300, 0);
            $commission_seller = $commission_seller + ($price_1000 * $contrato->commission_1000);
            $price_300 = max($price - $price_more_3000 - $price_3000 - $price_1000, 0);
            $price_overview = $price_more_3000 . ' | ' . $price_3000 . ' | ' . $price_1000 . ' | ' . $price_300;
            $commission_seller = $commission_seller + ($price_300 * $contrato->commission_300);
        }
        $commissions = [
            'seller' => $commission_seller,
            'buyer' => $commission_buyer,
        ];
        return $commissions;
    }

    public function scopeFilter($query, array $filters)
    {
        if (isset($filters['search'])) {
            global $searchString;
            $searchString = explode(' ', $filters['search']);
            $query->whereHas('itemsContrato', function ($query) {
                global $searchString;
                $query->where('mainLangName', 'like', '%' . $searchString[0] . '%');
                for ($i = 1; $i < count($searchString); $i++) {
                    $query->where('mainLangName', 'like', '%' . $searchString[$i] . '%');
                }
            });
        } elseif (isset($filters['idContrato'])) {
            global $idContrato;
            global $contratoIndex;
            $idContrato = $filters['idContrato'];
            $contratoIndex = ($filters['contratoIndex'] ?? '');
            $query->whereHas('itemsContrato', function ($query) {
                global $idContrato;
                global $contratoIndex;
                $query->where('idContrato', '=', $idContrato)->orderBy('contratoIndex');
                if (!empty($contratoIndex)) {
                    $query->where('contratoIndex', '=', $contratoIndex);
                }
            });
        } elseif (isset($filters['leilao_id'])) {
            $leilao_id = $filters['leilao_id'];
            $leilao_lote = ($filters['leilao_lote'] ?? '');
            $query->where('leilao_id', '=', $leilao_id)->orderby('leilao_lote');
            if (!empty($leilao_lote)) {
                $query->where('leilao_lote', '=', $leilao_lote);
            };
        } else {
            false;
        }
    }
}
