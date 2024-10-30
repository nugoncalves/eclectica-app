<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Leiloes extends Model
{
  use HasFactory;

  public $timestamps = false;

  protected $attributes = [
    'status' => 'espera',
  ];

  // RELATIONSHIPS

  //Items Leilão
  public function itemsLeilao(): HasMany
  {
    return $this->hasMany(ItemsLeilao::class, 'leilao_id', 'id');
  }

  /**
   * Get all of the clientes for the Leiloes
   */
  public function clientes(): HasManyThrough
  {
    return $this->hasManyThrough(ItemsContrato::class, ItemsLeilao::class);
  }

  /**
   * Get all of the licitacoes for the Leiloes
   */
  public function licitacoes(): HasMany
  {
    return $this->hasMany(Licitacoes::class, 'leilao_id', 'id');
  }

  // QUICK SEARCH
  public function scopeFilter($query, array $filters)
  {
    if ($filters['search'] ?? false) {
      $searchString = explode(' ', $filters['search']);
      $query->where(DB::raw('CONCAT(id, " ", name)'), 'like', '%' . $searchString[0] . '%');
      for ($i = 1; $i < count($searchString); $i++) {
        $query->where(DB::raw('CONCAT(id, " ", name)'), 'like', '%' . $searchString[$i] . '%');
      }
    }
  }
}
