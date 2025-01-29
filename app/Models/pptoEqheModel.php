<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pptoEqheModel extends Model
{
    use HasFactory;

    protected $table = "pptoEqhe";
    public $timestamps = false;


    public function getMeasure(){
        if ($this->eqheUnid) return measures::where('id',$this->eqheUnid)->first()->description;
    }


}
