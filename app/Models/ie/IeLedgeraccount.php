<?php

namespace App\Models\ie;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class IeLedgeraccount extends functions
{
    use HasFactory;
    protected $guarded = [];
    protected $table = "ie_ledgeraccount";


    public function getConceptAttribute(){
        return $this->hasOne(IeConcept::class , 'id',  'id_concept')->first() ?? new IeConcept;
    }

    public function getConceptNameAttribute(){
        return $this->concept->name;
    }

    public function getClassificationAttribute(){
        return $this->concept->classification;
    }

    public function getMovementAttribute(){
        return $this->concept->movement;
    }

    
    public function scopeByAccount(Builder $query ,  $id){
        return $query->whereIn('id',  IeCompanyBankAccount::where('id_company', $id)->StatusActive()->pluck('id_account'))->StatusActive()->get();
    }



}
