<?php

namespace App\Models\ie;

use App\Models\ie\functions;

/**
 * @property integer $id
 * @property integer $id_sub_cost_center
 * @property string $code
 * @property string $name
 * @property integer $state
 * @property string $created_at
 * @property string $update_at
 * @property integer $id_user
 */
class IeSubC2CostCenter extends functions
{
    /**
     * @var array
     */
    protected $fillable = ['id_sub_cost_center', 'code', 'name', 'state', 'created_at', 'update_at', 'id_user'];
}
