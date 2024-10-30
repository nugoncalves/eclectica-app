<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class ItemsContrato extends Model
{
    use HasFactory;

    protected $table = 'items_contrato';
    public $timestamps = false;

    // RELATIONSHIPS

    // IMAGENS
    public function images(): HasMany
    {
        return $this->hasMany(ImgLotes::class);
    }

    // ITEMS DE LEILÃO
    public function itemsLeilao(): HasMany
    {
        return $this->hasMany(ItemsLeilao::class);
    }

    // ITEMS DE LEILÃO ÚLTIMO
    public function itemsLeilaoLast(): HasOne
    {
        return $this->hasOne(ItemsLeilao::class, 'id', 'last_item_leilao')
            ->latest();
    }

    // COUNT ITEMS LEILÃO
    public function itemsLeilaoCount()
    {
        return $this->hasOne(ItemsLeilao::class)
            ->selectRaw('items_contrato_id, count(*) as count')
            ->groupBy('items_contrato_id');
    }



    // LICITAÇÕES
    public function bids(): HasMany
    {
        return $this->hasMany('licitacoes');
    }

    // COMPRADORES
    public function compradores(int $id)
    {
        $compradores = DB::select(
            '
            SELECT *
            FROM clientes
            WHERE clientes.id in
            ( SELECT items_leilao.buyer_id
            FROM items_leilao
            WHERE items_leilao.items_contrato_id =' .
                $id .
                ')',
        );

        return $compradores;
    }

    // LISTA DE CONTRATOS
    public function contratos()
    {
        return DB::table('contratos')->select('id')->orderBy('id', 'desc')->get();
    }

    // LICITANTES
    public function licitantes(int $id)
    {
        $licitantes = DB::select(
            '
            SELECT *
            FROM clientes
            WHERE clientes.id in (
                SELECT licitacoes.bidder_id
                FROM licitacoes
                WHERE licitacoes.items_contrato_id = ' .
                $id .
                ')',
        );

        return $licitantes;
    }

    // FORNECEDOR
    public function fornecedor(): HasOne
    {
        return $this->hasOne(Cliente::class, 'id', 'seller_id');
    }

    // DATA DE SAÍDA
    public function dataSaida(int $id)
    {
        $dataSaida = DB::select(
            '
            SELECT leiloes.end_date FROM leiloes
            WHERE leiloes.id in (
                SELECT items_leilao.leilao_id
                FROM items_leilao
                JOIN items_contrato
                ON items_contrato.id = items_leilao.items_contrato_id
                WHERE items_leilao.sold = 1 AND items_leilao.items_contrato_id =' .
                $id .
                '
                ORDER BY items_leilao.leilao_id DESC)',
        );
        return $dataSaida;
    }

    // Função de Pesquisa
    public function scopeFilter($query, array $filters)
    {
        if (isset($filters['search'])) {
            $searchString = explode(' ', $filters['search']);
            $concat = "CONCAT(contrato_id, '-', contrato_index, ' ', main_lang_name, ' ', 'status')";
            $query->where(DB::raw($concat), 'like', '%' . $searchString[0] . '%')->orderBy('main_lang_name', 'asc');
            for ($i = 1; $i < count($searchString); $i++) {
                $query->where(DB::raw($concat), 'like', '%' . $searchString[$i] . '%');
            }
        } elseif (isset($filters['idContrato'])) {
            $idContrato = $filters['idContrato'];
            $contratoIndex = $filters['contratoIndex'] ?? '';
            $query->where('contrato_id', '=', $idContrato)->orderBy('contrato_index');
            if (!empty($contratoIndex)) {
                $query->where('contrato_index', '=', $contratoIndex);
            }
        } elseif (isset($filters['leilao_id'])) {
            global $leilao_id;
            global $leilao_lote;
            $leilao_id = $filters['leilao_id'];
            $leilao_lote = $filters['leilao_lote'] ?? '';
            $query
                ->whereHas('itemsLeilao', function ($query) {
                    global $leilao_id;
                    global $leilao_lote;
                    $query->where('leilao_id', '=', $leilao_id)->orderBy('leilao_lote');
                    if (!empty($leilao_lote)) {
                        $query->where('leilao_lote', '=', $leilao_lote);
                    }
                })
                ->get();
        } else {
            false;
        }
    }
}
