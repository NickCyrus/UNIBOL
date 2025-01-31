<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\InventoryImport;
use App\Models\Inventory;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::all();
        return view('inventories.index', compact('inventories'));
    }

    public function excelClear(Request $r)
    {
        $excel = $r->file('excel');

        if (!$excel) {
            return redirect()->route('inventories')->with('error', 'No se ha seleccionado un archivo');
        }

        Inventory::truncate();

        $import = new InventoryImport();
        Excel::import($import, $excel);

        $totalImport = $import->getCount();

        return redirect()->route('inventories')->with('success', "Datos importados correctamente desde cero. Se han importado {$totalImport} registros.");
    }

    public function excelUpdate(Request $r)
    {
        $excel = $r->file('excel');

        if (!$excel) {
            return redirect()->route('inventories')->with('error', 'No se ha seleccionado un archivo');
        }

        $rows = Excel::toArray(new InventoryImport, $excel)[0];

        $newRecordsCount = 0;

        foreach ($rows as $row) {
            if (isset($row['material']) && isset($row['texto_breve_de_material']) &&
                !empty(trim($row['material'])) && !empty(trim($row['texto_breve_de_material']))) {

                $existingInventory = Inventory::where('id_material', $row['material'])->first();

                if (!$existingInventory) {
                    Inventory::create([
                        'id_material' => $row['material'],
                        'name' => $row['texto_breve_de_material'],
                    ]);

                    $newRecordsCount++;
                }
            }
        }

        return redirect()->route('inventories')->with('success', "Datos importados correctamente. Se han importado {$newRecordsCount} registros nuevos.");
    }
}
