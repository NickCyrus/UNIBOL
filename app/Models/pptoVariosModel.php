<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pptoVariosModel extends Model
{
    use HasFactory;

    protected $table = "pptoVarios";
    public $timestamps = false;

    public function getMeasure(){
        if ($this->varUnid) return measures::where('id',$this->varUnid)->first()->description;
    }
    
}
