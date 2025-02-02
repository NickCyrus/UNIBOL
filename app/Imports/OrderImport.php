<?php

namespace App\Imports;

use App\Models\Order;
use App\Models\Inventory;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;

class OrderImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $inventory = Inventory::where('id_material', $row['material'])->first();

        if (!$inventory) {
            return null;
        }


        $inventory->stock = $row['inventario'];
        $inventory->save();

        $saldo = ($row['inventario'] ?? 0) - ($row['cantpend'] ?? 0);


        return new Order([
            'solicitante'       => $row['solicitante'],
            'doc_venta'         => $row['docventa'],
            'unidad_negocio'    => $row['unidad_de_negocio'],
            'linea_producto'    => $row['linea_producto'],
            'marca'             => $row['marca'],
            'id_material'       => $row['material'],
            'material_name'     => $row['numero_de_material'],
            'cantidad_pendiente'=> $row['cantpend'],
            'saldo'             => $saldo,
        ]);
    }
}
