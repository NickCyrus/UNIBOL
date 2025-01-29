<?php

namespace App\Models\ie;

use App\Models\ie\functions;
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
class IeCostCenter extends functions
{
    /**
     * @var array
     */
    // protected $fillable = ['code', 'name', 'state', 'created_at', 'update_at', 'id_user','id_company'];
    protected $guarded = [];

    static public function getNodeTree($info , $cat = false){
       
        $childs = IeCostCenter::getChild($info->id , $cat);
         
        if ($childs){
            return ['text'=>"T - {$info->code}", 'code'=> $info->code , 'color' => '#3996FE' , 'icon'=>'bx bx-subdirectory-right','nodes'=>IeCostCenter::getChild($info->id  , $cat)];
        }else
            return ['text'=>"D - {$info->code}", 'code'=> $info->code , 'color' => '#4A9E62' , 'icon'=>''];

    } 

    public function getChildsAttribute(){
        return $this->hasMany(IeCostCenter::class , 'id_parent')->StatusActive([1,2]);
    }

    static public function getChild($padre = '' , $cat =  false){
        
        $listChild=[];

        $subcc  =   IeSubCostCenter::query();   

        if ($cat)
            $subcc->where('id_cost_center',$padre);
        else{
            $subcc->IsParent($padre);
        }

        $childs = $subcc->StatusActive()->get();

        if ($childs->count()){
            foreach($childs as $child){
               $listChild[] = IeCostCenter::getNodeTree($child , false);
            }
        }
         
        return $listChild;
       

        
    }

    static public function getTree($padre = ''){

        $cc     = IeCostCenter::query();
        $listTree = [];

        if (!$padre){
            $categorias = $cc->StatusActive()->get();
            if ($categorias){
                foreach($categorias as $categoria){
                    $listTree[] = IeCostCenter::getNodeTree($categoria , true);
                }
            }
        }

        return $listTree;

    }

    public function getTdccAttribute(){
      if (!$this->id_parent)  return "";
      return IeCostCenter::where('id_parent',$this->id)->count() ? 'T' : 'D';
    }

    public function getLevelAttribute(){
         return $this->getNivel($this->id);
    }

    public function getSlugcompAttribute(){
        $slugs = $this->getSlug($this->id);
        // arsort ($slugs);
        return implode(' / ',$slugs);
   }

   function getSlug($id , &$slug = []){
        
        $preLevel = IeCostCenter::where('id',$id)->first();
        if (!$preLevel->id_parent) {
            $slug[] = $preLevel->name;
            return $slug;
        }else{
            
            $this->getSlug($preLevel->id_parent , $slug);
            $slug[] = $preLevel->name;
    
        }

        
        return $slug;
    }

    function getNivel($id , &$nivel = 1){
        $preLevel = IeCostCenter::where('id',$id)->whereNotNull('id_parent')->first();
        if (!$preLevel) {
            return $nivel;
        }else{
            $nivel++;
            $this->getNivel($preLevel->id_parent , $nivel);
            return $nivel;
        }
    }
    
    public function getPadreAttribute(){
        if (!$this->id_parent)  return "";
        return IeCostCenter::where('id',$this->id_parent)->first()->code ?? '';
    }
    

    public function getPptpAttribute(){
        return '$ '.money($this->ppto);
    }
    

    public function callEndSave(Request $req){
        $this->setClassification($req);
    } 
   
    function setClassification($req){
 
        IeCostCenterTypeClassification::where('id_cost_center', $this->id)->delete();
        if ($req->classification_rel){
        foreach($req->classification_rel as $type){
            IeCostCenterTypeClassification::insert(['id_cost_center'=>$this->id , 'id_classification'=>$type, 'state'=>1 , 'id_user'=>cuid() , 'created_at'=>now()]);  
        }
      }
    }

    public function getClassificationRelAttribute(){
        $LISTA = null;
        $items = $this->hasMany(IeCostCenterTypeClassification::class,'id_cost_center','id')->get()->pluck('id_classification') ?? [];
        if ($items){
        foreach($items as $item){
            $LISTA[] = $item;
        }

        }
        return  $LISTA;
    }




}
