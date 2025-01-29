<?php

namespace App\Models\ie;

use App\Models\ie\functions;
use Illuminate\Http\Request;

/**
 * @property integer $id
 * @property string $name
 * @property integer $state
 * @property string $created_at
 * @property string $update_at
 * @property integer $id_user
 */
class IeClassification extends functions
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'state', 'created_at', 'update_at', 'id_user' , 'id_movement_type'];

    public function getMovimentAttribute(){
        return $this->hasOne(IeMovementType::class,'id','id_movement_type')->first()->name_html ?? '';
    }

    public function getNameAllAttribute(){
        return "{$this->moviment} - {$this->name}" ?? '';
    }

                       
    public function getIdCostCenterTypeClassificationsAttribute(){
        $LISTA = null;
        /*
        $items = $this->hasMany(IeCostCenterTypeClassification::class,'id_classification','id')->get()->pluck('id_cost_center') ?? [];
       
        if ($items){
          foreach($items as $item){
              $LISTA[] = $item;
          }

        }
        */
        return  $LISTA;
  }


  public function callEndSave(Request $req){
    $this->saveRelCC($req);
  }


  public function saveRelCC($req){  
       
       IeCostCenterTypeClassification::where('id_classification', $this->id)->delete();
       if ($req->id_cost_center_type_classifications){
          foreach($req->id_cost_center_type_classifications as $type){
             IeCostCenterTypeClassification::insert(['id_cost_center'=>$type , 'id_classification'=>$this->id , 'id_user'=>cuid(), 'state'=>1]);  
          }
       }
       
  }



}
