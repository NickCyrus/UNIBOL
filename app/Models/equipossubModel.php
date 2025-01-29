<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class equipossubModel extends Model
{
    use HasFactory;

    protected $table = "equipmentssub";
    protected $fillable = ['id'];

    public function getMeasure(){
            return measures::where('id', $this->measure_id)->first()->description;
    }

}
