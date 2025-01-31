<?php
namespace App\Imports;

use App\Models\Inventory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Facades\Log;

class InventoryImport implements ToModel, WithHeadingRow
{
    use Importable;

    public $count = 0;


    public function model(array $row)
        {
            if (!isset($row['material']) || !isset($row['texto_breve_de_material']) ||
                empty(trim($row['material'])) || empty(trim($row['texto_breve_de_material']))) {
                return null;
            }

            $materialText = strtoupper($row['texto_breve_de_material']);
            $kg = null;
            $cm = null;
            $lb = null;
            $g = null;

            if (preg_match('/(\d+)G/', $materialText, $matches)) {
                $g = (int) $matches[1];
            }

            if (preg_match('/(\d+)X(\d+\.?\d*)CM/', $materialText, $matches)) {
            } elseif (preg_match('/(\d+\.?\d*)CM/', $materialText, $matches)) {
                $cm = (float) $matches[1];
            }

            if (preg_match('/(\d+\/\d+|\d+)LB/', $materialText, $matches)) {
                $lb = $matches[1];
            }

            if (preg_match('/(\d+)KG/', $materialText, $matches)) {
                $kg = (float) $matches[1];
            }


            $inventory = new Inventory([
                'id_material' => $row['material'],
                'name' => $materialText,
                'kg' => $kg,
                'cm' => $cm,
                'lb' => $lb,
                'g' => $g,
            ]);

            $this->count++;

            return $inventory;
        }



    public function getCount()
    {
        return $this->count;
    }
}
