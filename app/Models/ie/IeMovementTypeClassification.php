<?php

namespace App\Models\ie;

use App\Models\ie\functions;

/**
 * @property integer $id
 * @property integer $id_movement_type
 * @property integer $id_classification
 * @property integer $state
 * @property string $created_at
 * @property string $update_at
 * @property integer $id_user
 */
class IeMovementTypeClassification extends functions
{
    /**
     * @var array
     */
    protected $fillable = ['id_movement_type', 'id_classification', 'state', 'created_at', 'update_at', 'id_user'];
}
