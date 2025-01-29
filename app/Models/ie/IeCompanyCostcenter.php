<?php

namespace App\Models\ie;

use App\Models\ie\functions;

/**
 * @property integer $id
 * @property integer $id_company
 * @property integer $id_cost_center
 * @property integer $state
 * @property string $created_at
 * @property string $update_at
 * @property integer $id_user
 */
class IeCompanyCostcenter extends functions
{
    /**
     * @var array
     */
    protected $fillable = ['id_company', 'id_cost_center', 'state', 'created_at', 'update_at', 'id_user'];
}
