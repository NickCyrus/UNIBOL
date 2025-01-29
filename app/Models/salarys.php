<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salarys extends Model
{
    use HasFactory;

    protected $table = "salarys";
  

    public function getCategory(){
        return ($this->category) ? categories::where('id', $this->category)->first()->name : '';
    }

}
