<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Contratos extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function cliente()
    {
        return $this->hasOne(Cliente::class, 'id', 'seller_id');
    }

    public function itemsContrato()
    {
        return $this->hasMany(ItemsContrato::class, 'contrato_id', 'id');
    }
    // Função de Pesquisa
    public function scopeFilter($query, array $filters)
    {
        if (isset($filters['search']) ?? false) {
            global $searchString;
            $searchString = explode(' ', $filters['search']);
            $concat = "CONCAT(id, ' ', date, ' ', seller_reference, ' ', seller_id, ' ', commission_type)";
            $query->where(DB::raw($concat), 'like', '%' . $searchString[0] . '%')->orWhereHas('cliente', function ($q) use ($searchString) {
                $q->where('full_name', 'like', '%' . $searchString[0] . '%');
            });
            for ($i = 1; $i < count($searchString); $i++) {
                $query->where(DB::raw($concat), 'like', '%' . $searchString[$i] . '%')->orWhereHas('cliente', function ($q) use ($searchString, $i) {
                    $q->where('full_name', 'like', '%' . $searchString[$i] . '%');
                });;
            }
        }
    }
}
