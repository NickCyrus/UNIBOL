<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogSendMail extends Model
{
    use HasFactory;

    protected $table = "logs_send_mail";


    public function getUser(){
        return User::where('id', $this->userId)->select('name')->first()->name;
    }

    public function getCotizacion(){
        return quotesModel::where('id', $this->quoteid)->first()->description;
    }


}
