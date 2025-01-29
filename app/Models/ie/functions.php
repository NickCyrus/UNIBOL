<?php

namespace App\Models\ie;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
 

class functions extends Model
{
    use HasFactory;

    public function scopeStatusActive(Builder $query , $status=[1,2]){
        return $query->whereIn('state', $status);
    }

 
    public function scopewhereBetweenDate(Builder $query , $field , $rang = []){
        return $query->whereDate($field,'>=', $rang[0])->whereDate($field,'<=', $rang[1]);
    } 

    public function scopeActive(Builder $query){
        return $query->where('state', 1);
    }

    public function scopeCode(Builder $query , $code){
        return $query->where('code', $code);
    }

    public function scopenotDelActive(Builder $query){
        return $query->where('state', 3);
    }



    public function scopeNotParent(Builder $query){
        return $query->whereNull('id_parent');
    }

    public function scopeIsParent(Builder $query, int $id_parent ){
        return $query->where('id_parent', $id_parent);
    }

    public function getEstadoAttribute(){
        if ($this->state) return state($this->state);
    }

    public function getEstadoHtmlAttribute(){
        if ($this->state) return '<span class="badge bg-transparent">'.$this->estado .'</span>';
    }

    public function getCompanyAttribute(){
       return $this->hasOne(IeCompany::class,'id','id_company')->first()->name ?? '';
    }

    public function getTerceroAttribute(){
        return $this->hasOne(IeThirdparty::class,'id','id_thirdparti')->first() ?? '';
    }

    public function getMovementTypeAttribute(){
        return $this->hasOne(IeMovementType::class,'id','id_movement_type')->first()->name ?? '';
    }

    public function getClasificacionAttribute(){
        return $this->hasOne(IeClassification::class,'id','id_classification')->first() ?? new IeClassification;
    }

    public function getCenCosAttribute(){
        return $this->hasOne(IeCostCenter::class,'id','id_cost_centers')->first() ?? new IeCostCenter;
    }

    public function getConceptoAttribute(){
        return $this->hasOne(IeConcept::class,'id','id_concept')->first() ?? new IeConcept;
    }

    public function getCuentaContAttribute(){
        return $this->hasOne(IeLedgeraccount::class,'id','id_ledgeraccount')->first() ?? new IeLedgeraccount;
    }

    public function getLogoPreviewAttribute(){
        if ($this->logo){
            return '<img class="img-fluid" src="'.asset($this->logo).'" />';
        }
    }

    
    
    
}
