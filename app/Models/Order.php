<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'solicitante',
        'doc_venta',
        'unidad_negocio',
        'linea_producto',
        'marca',
        'id_material',
        'material_name',
        'cantidad_pendiente',
        'saldo'
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'id_material', 'id_material');
    }}
