<?php

namespace App\Models\ie;

use App\Models\ie\functions;
use Attribute;
use Illuminate\Http\Request;

/**
 * @property integer $id
 * @property string $nit
 * @property float $name
 * @property string $email
 * @property integer $cellphone
 * @property string $address
 * @property integer $id_cat_third
 * @property integer $state
 * @property string $created_at
 * @property string $update_at
 * @property integer $id_user
 */
class IeThirdparty extends functions
{
    /**
     * @var array
     */
    
     // protected $fillable = ['nit', 'name', 'email', 'cellphone', 'address', 'id_cat_third', 'state', 'created_at', 'update_at', 'id_user', 'code'];

    protected $guarded = [];  

    public function getTypedocAttribute(){  
      return  $this->hasOne(IeThirdTypeDocument::class , 'id', 'id_type_document')->first()->name ?? '';
    }

    public function getIdCatThirdAttribute(){
        $LISTA = null;
        $items = $this->hasMany(IeThirdpartiesClasification::class,'id_third','id')->get()->pluck('id_cat_third') ?? [];
        if ($items){
        foreach($items as $item){
            $LISTA[] = $item;
        }

        }
        return  $LISTA;
    }

   public function callEndSave(Request $req){
        $this->setClassification($req);
   } 
   
   function setClassification($req){

    IeThirdpartiesClasification::where('id_third', $this->id)->delete();
    if ($req->id_cat_third){
       foreach($req->id_cat_third as $type){
        IeThirdpartiesClasification::insert(['id_cat_third'=>$type , 'id_third'=>$this->id , 'id_user'=>cuid()]);  
       }
    }

   }

   function getClassificationAttribute(){

       $clasificacions = IeThirdClasification::whereIn( 'id' ,  IeThirdpartiesClasification::where('id_third', $this->id)->pluck('id_cat_third') )->get();
       $list           = [];
       if ($clasificacions){
            foreach($clasificacions as $clasificacion){
                $list[] = $clasificacion->name;
            }
       }

       return $list;

   }

   

}
