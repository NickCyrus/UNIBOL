<?php

namespace App\Models\ie;

use App\Models\ie\functions;

/**
 * @property integer $id
 * @property integer $id_movement_type
 * @property string $id_bank
 * @property float $state
 * @property string $created_at
 * @property string $update_at
 * @property integer $id_user
 */
class IeBankMovementType extends functions
{
    /**
     * @var array
     */
    protected $fillable = ['id_movement_type', 'id_bank', 'state', 'created_at', 'update_at', 'id_user'];
}
