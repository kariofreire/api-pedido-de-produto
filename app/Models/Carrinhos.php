<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Carrinhos extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "carrinhos";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "quantidade",
        "valor_total",
        "produto_id",
        "pedido_id"
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        "created_at",
        "updated_at"
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        "created_at" => "datetime:d/m/Y H:i"
    ];

    /**
     * Relaciona com modelo de <Produtos>
     *
     * @return HasOne
     */
    public function produto() : HasOne
    {
        return $this->hasOne(Produtos::class, "id", "produto_id");
    }

    /**
     * Relaciona com modelo de <Pedidos>
     *
     * @return HasOne
     */
    public function pedido() : HasOne
    {
        return $this->hasOne(Pedidos::class, "id", "pedido_id");
    }
}
