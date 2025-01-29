<?php

namespace App\Models\ie;

use App\Models\ie\functions;

/**
 * @property integer $id
 * @property string $name
 * @property integer $number
 * @property integer $state
 * @property string $created_at
 * @property string $update_at
 * @property integer $id_user
 */
class IeMovementType extends functions
{
    /**
     * @var array
     */
    protected $guarded = [];

    public function getNameHtmlAttribute(){
        if ($this->number == 1){
            return "<span class='badge bg-transparent ingreso'>{$this->name}</span>";
        }else if ($this->number == -1){
            return "<span class='badge bg-transparent egreso'>{$this->name}</span>";
        }
    }

}
