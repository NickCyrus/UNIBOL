<?php

namespace App\Models\ie;

use App\Models\ie\functions;

/**
 * @property integer $id
 * @property integer $id_cost_center
 * @property string $code
 * @property string $name
 * @property integer $state
 * @property string $created_at
 * @property string $update_at
 * @property integer $id_user
 */
class IeSubCostcenter extends functions
{
    /**
     * @var array
     */
    protected $fillable = ['id_cost_center', 'code', 'name', 'state', 'created_at', 'update_at', 'id_user'];


    public function getChildsAttribute(){
        return $this->hasMany(IeSubCostcenter::class , 'id_parent');
    }


    public function getCodeccAttribute(){
        if ($this->id_cost_center){
            return IeCostCenter::find($this->id_cost_center)->code;
        }else{
            return IeSubCostcenter::find($this->id_parent)->code;
        }
        
    }

    

}
