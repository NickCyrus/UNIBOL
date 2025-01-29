<?php

namespace App\Models\ie;

use App\Models\ie\functions;

/**
 * @property integer $id
 * @property string $name
 * @property integer $state
 * @property string $created_at
 * @property string $update_at
 * @property integer $id_user
 */
class IeConcept extends functions
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'state', 'created_at', 'update_at', 'id_user','id_classification'];

    public function getClassificationAttribute(){
        return $this->hasOne(IeClassification::class,'id','id_classification')->first()->name ?? '';
    }

    public function getMovementAttribute(){ 
        return $this->hasOne(IeMovementType::class,'id','id_movement_type')->first()->name_html ?? '';
    }





}
