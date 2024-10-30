<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Licitacoes extends Model
{
    use HasFactory;
    use \Awobaz\Compoships\Compoships;

    public function licitante(): HasOne
    {
        return $this->hasOne(Cliente::class, 'id', 'bidder_id');
    }
}
