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
class IeAccountStatus extends functions
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'state', 'created_at', 'update_at', 'id_user'];
}
