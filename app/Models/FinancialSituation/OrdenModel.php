<?php

namespace App\Models\FinancialSituation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenModel extends Model
{
    use HasFactory;


    static public function options(){

        $Rubro = OrdenModel::query();
        
        $Rubro->select(['id','name'])
        ->groupBy('id')
        ->groupBy('name')
        ->orderBy('name');

        return $Rubro->get();

    }
}
