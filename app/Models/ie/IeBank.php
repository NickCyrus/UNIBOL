<?php

namespace App\Models\ie;

use App\Models\ie\functions;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property integer $state
 * @property string $created_at
 * @property string $update_at
 * @property integer $id_user
 */
class IeBank extends functions
{
    /**
     * @var array
     */
    // protected $fillable = ['code', 'name', 'state', 'created_at', 'update_at', 'id_user' , 'id_company'];
    protected $guarded = ['id'];

    
    public function getCompanyAttribute(){
        return $this->hasOne(IeCompany::class,'id','id_company')->first()->name ?? '';
    }

    public function scopeByCompany(Builder $query ,  $id){

        return $query->whereIn('id', IeCompanyBankAccount::where('id_company',$id)->pluck('id_bank'));
    }


    public function callEndSave(Request $req){
         $this->setMovimentBank($req);
    }

    public function getIdBankMovementTypesAttribute(){
          $LISTA = null;
          $items = $this->hasMany(IeBankMovementType::class,'id_bank','id')->get()->pluck('id_movement_type') ?? [];
          if ($items){
            foreach($items as $item){
                $LISTA[] = $item;
            }

          }
          return  $LISTA;
    }

   

    

    public function setMovimentBank($req){  
         
         IeBankMovementType::where('id_bank', $this->id)->delete();
         if ($req->id_bank_movement_types){
            foreach($req->id_bank_movement_types as $type){
                IeBankMovementType::insert(['id_movement_type'=>$type , 'id_bank'=>$this->id , 'id_user'=>cuid(), 'state'=>1]);  
            }
         }
         
    }

   

    
}
