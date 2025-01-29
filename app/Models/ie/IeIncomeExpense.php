<?php

namespace App\Models\ie;

use App\Models\ie\functions;

/**
 * @property integer $id
 * @property integer $id_company
 * @property integer $id_movement_type
 * @property float $price
 * @property integer $state
 * @property string $created_at
 * @property string $update_at
 * @property integer $id_user
 * @property string $date
 * @property integer $tipdoc
 * @property string $doc
 * @property integer $tipcon
 * @property string $con
 */
class IeIncomeExpense extends functions
{
    /**
     * @var array
     */
    protected $guarded = [];
    protected $table = "ie_income_expenses";

    public function getDetailsMovimentAttribute(){
        return $this->hasMany(IeIncomeExpensesDetails::class , 'id_income_expenses')->StatusActive([1]);
    } 
     

    public function getCodeAttribute(){
        return  substr($this->company,0,2).$this->created_at->format("dmy").$this->id;
    } 

    public function getMovementTypeAttribute(){
        return  $this->hasOne(IeMovementType::class , 'id', 'id_movement_type')->first()->name_html ?? '';
    }
    
    public function getAccountAttribute(){
        return  $this->hasOne(IeAccount::class , 'id', 'id_account')->first()->name ?? '';
    }

    public function getIeAccountAttribute(){
        return  $this->hasOne(IeAccount::class , 'id', 'id_account')->first() ?? new IeAccount;
    }

    public function getThirdpartieAttribute(){
        return  $this->hasOne(IeThirdparty::class , 'id', 'id_thirdparti')->first() ?? new IeThirdparty;
    }

    public function getDocCompleteAttribute(){
            if ($this->doc && $this->tipdoc){
                    $tipdoc  = IeAprobationDocument::find($this->tipdoc)->abbreviation;
                    if ($tipdoc == 'N/A' || $tipdoc == 'NA') return '';
                    return "{$tipdoc} : {$this->doc}";
            }else if ($this->doc){
                    return "{$this->doc}";
            }
    }
    
    public function getConCompleteAttribute(){
            if ($this->con && $this->tipdoc){
                    $tipdoc  = IeTypeDocumentCont::find($this->tipcon)->abbreviation;
                    if ($tipdoc == 'NA' || $tipdoc == 'N/A') return '';
                    return "{$tipdoc} : {$this->con}";
            }else if ($this->con){
                    return "{$this->con}";
            }
    }

    

    
    

}
