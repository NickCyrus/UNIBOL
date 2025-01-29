<?php

namespace App\Models\ie;

use App\Models\ie\functions;

/**
 * @property integer $id
 * @property string $id_cost_center
 * @property string $id_classification
 * @property float $state
 * @property string $created_at
 * @property string $update_at
 * @property integer $id_user
 */
class IeCostCenterTypeClassification extends functions
{
    /**
     * @var array
     */
    // protected $fillable = ['id_cost_center', 'id_classification', 'state', 'created_at', 'update_at', 'id_user'];
    protected $guarded = [];
}
