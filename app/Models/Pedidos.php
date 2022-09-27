<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pedidos extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "pedidos";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "data_pedido",
        "observacao",
        "forma_pagamento",
        "cliente_id"
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        "data_pedido",
        "created_at",
        "updated_at"
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        "data_pedido" => "date:d/m/Y",
        "created_at"  => "datetime:d/m/Y H:i"
    ];

    /**
     * Relaciona com modelo de <Clientes>
     *
     * @return HasOne
     */
    public function cliente() : HasOne
    {
        return $this->hasOne(Clientes::class, "id", "cliente_id");
    }
}
