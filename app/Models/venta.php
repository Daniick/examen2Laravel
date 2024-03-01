<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'producto_id',
        'cantidad'

    ];


    public function cliente()
    {
        return $this->belongsTo(cliente::class);
    }
    public function producto()
    {
        return $this->belongsTo(producto::class);
    }
}
