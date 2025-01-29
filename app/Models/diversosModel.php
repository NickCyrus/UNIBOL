<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class diversosModel extends Model
{
    use HasFactory;

    protected $table = "diversos";

    public function getMeasure(){
        return ($this->measure_id) ? measures::where('id', $this->measure_id)->first()->description : '';
    }
    
}
