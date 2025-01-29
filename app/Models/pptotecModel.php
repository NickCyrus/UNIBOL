<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\pptoVariosModel;
use DB;

class pptotecModel extends Model
{
    use HasFactory;

    protected $table = "pptotec";
    public $timestamps = false;


    function getManoObra($tipo){
        return pptoMdoModel::where('mdoTipo',$tipo)->where("mdoPptoId",$this->pptoId)->get();
    }

    function getEquiposHerramientas($tipo){
        return pptoEqheModel::where('eqheTipo',$tipo)->where("eqhepptoId",$this->pptoId)->get();
    }

    function getVarios($tipo , $servicio = 1 ){

        return pptoVariosModel::where('varTipo',$tipo)
                        ->where("varpptoId",$this->pptoId)
                        ->where("varTIpoSer",$servicio)
                        ->get();

        
        
    }

    function getCostosPorTipo($tipo = 1){
        $mdo  = pptoMdoModel::where('mdoPptoId', $this->pptoId)->where('mdoTipo',$tipo)->sum('mdoSalPat');
        $eqhe = pptoEqheModel::where('eqhepptoId', $this->pptoId)->where('eqheTipo',$tipo)->sum('eqheValPat');
        $var = pptoVariosModel::where('varpptoId', $this->pptoId)->where('varTipo',$tipo)->sum('varValPar');
        return ($mdo+$eqhe+$var);
    }

    function getCostoTotales(){

            $mdo  = pptoMdoModel::where('mdoPptoId', $this->pptoId)->sum('mdoSalPat');            
            $eqhe = pptoEqheModel::where('eqhepptoId', $this->pptoId)->sum('eqheValPat');        
            $var  = pptoVariosModel::where('varpptoId', $this->pptoId)->sum('varValPar');
  
            return ($mdo+$eqhe+$var);
 
    }
    

}
