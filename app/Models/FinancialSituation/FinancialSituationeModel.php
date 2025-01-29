<?php

namespace App\Models\FinancialSituation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialSituationeModel extends Model
{
    use HasFactory;
    public $meses = [1=>'Enero', 2=>'Febrero', 3=>'Marzo',  4=>'Abril', 5=>'Mayo', 6=>'Junio', 7=>'Julio', 8=>'Agosto', 9=>'Septiembre', 10=>'Octubre',   11=>'Noviembre',  12=>'Diciembre' ];
    public $mesesCorto = [1=>'Ene', 2=>'Feb', 3=>'Mar',  4=>'Abr', 5=>'May', 6=>'Jun', 7=>'Jul', 8=>'Ago', 9=>'Sep', 10=>'Oct',   11=>'Nov',  12=>'Dic' ];

    public function getRubroAttribute(){
        return RubroModel::where('id',$this->rubro_id)->first()->name ?? '';
    }

    public function getOrdenAttribute(){
        return OrdenModel::where('id',$this->orden_id)->first()->name ?? '';
    }

    public function getHomologacionAttribute(){
        return HomologationModel::where('id',$this->homologation_id)->first()->name ?? '';
    }

    public function getEeffRubroAttribute(){
        return EEFFRRubroModel::where('id',$this->EEFFR_rubro_id)->first()->name ?? '';
    }

    public function getEeffOrdenAttribute(){
        return EEFFROrdenModel::where('id',$this->EEFFR_orden_id)->first()->name ?? '';
    }

    public function getNotaBlanceAttribute(){
        return NotaBalanceModel::where('id',$this->nota_balance_id)->first()->name ?? '';
    }

    public function getPeriodoAttribute(){
        return  $this->mesesCorto[$this->Month_id]." {$this->ano}";
    }
    
    
    static public function options(){

        $Rubro = FinancialSituationeModel::query();
        
        $Rubro->select(['Month_id','ano'])
        ->groupBy('Month_id')
        ->groupBy('ano')
        ->orderBy('Month_id')
        ->orderBy('ano');

        return $Rubro->get()->map(function ($row)  {

            $row['id']   = $row->Month_id."|".$row->ano;
            $row['name'] = getMesesCorto($row->Month_id)." ". $row->ano;
        
            return $row;
        
        });;

    }
    

    
}
