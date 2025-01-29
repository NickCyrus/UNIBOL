<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FinancialSituation\RubroModel;
use App\Models\FinancialSituation\OrdenModel;
use App\Models\FinancialSituation\HomologationModel;
use App\Models\FinancialSituation\EEFFROrdenModel;
use App\Models\FinancialSituation\EEFFRRubroModel;
use App\Models\FinancialSituation\NotaBalanceModel;
use App\Models\FinancialSituation\FinancialSituationeModel;



class FinancialSituationeController extends Controller
{
    //

    private $modelos = [];
    public $columnSaldo = 6;
    public $saldoMonth;
    public $saldoYear;
    public $fieldInsert;
    public $meses;

    public function modelos(){
        $this->modelos = ['0'=>new RubroModel(),
                          '1'=>new OrdenModel(),
                          '2'=>new HomologationModel(),
                          '3'=> new EEFFRRubroModel(),
                          '4'=>new EEFFROrdenModel(),
                          '5'=>new NotaBalanceModel(),
                         ];

        $this->fieldInsert = ['0'=>'rubro_id',
                           '1'=>'orden_id',
                           '2'=>'homologation_id',
                           '3'=>'EEFFR_rubro_id',
                           '4'=>'EEFFR_orden_id',
                           '5'=>'nota_balance_id'];

        $this->meses = ['Enero'=>'1',
                        'Febrero'=>'2',
                        'Marzo'=>'3',
                        'Abril'=>'4',
                        'Mayo'=>'5',
                        'Junio'=>'6',
                        'Julio'=>'7',
                        'Agosto'=>'8',
                        'Septiembre'=>'9',
                        'Octubre'=>'10',       
                        'Noviembre'=>'11',       
                        'Diciembre'=>'12', 
                        'En'=>'1',
                        'Feb'=>'2',
                        'Mar'=>'3',
                        'Abr'=>'4',
                        'May'=>'5',
                        'Jun'=>'6',
                        'Jul'=>'7',
                        'Ago'=>'8',
                        'Sep'=>'9',
                        'Oct'=>'10',       
                        'Nov'=>'11',       
                        'Dic'=>'12',      
                    ];
    }

    public function CheckColumnSaldo($collection){
        
        $this->modelos();
        $fields  = explode(" ",$collection[$this->columnSaldo]);
        
        if (strtolower($fields[0]) =='[saldo]'){
                if (!$fields[1] || !$fields[2]){
                    return false;
                }else{
                     
                    $this->saldoMonth = $this->meses[$fields[1]];
                    $this->saldoYear  = $fields[2];
                }
        }else{
                    return false;
        }

        return true;
    }

    public function LoadExcel($rows, $ImportId)
    {

        if (!$this->CheckColumnSaldo($rows[0])){
            return ['status'=>'error','msg'=>'La cabecera no contine la columna [Saldo] o está mal informada, el formato debe ser [Saldo] Mes Año'];
        }

        if (!count($rows[0])>6){
            return ['status'=>'error','msg'=>'La cabecera no contine en numero de columnas establecidas para la importación, por favor verifique el archivo.'];
        }
        
        //
        $i = 1;
       
        unset($rows[0]);
        $inserCount = 0;
        foreach ($rows as $row){
            $item = [];
            
            for($i=0; $i < $this->columnSaldo; $i++){
                    
                    if($row[$i]){
                        $rowItem = $this->modelos[$i]::where('name',$row[$i])->first();
                        $item[$this->fieldInsert[$i]] = ( $rowItem ) ?  $rowItem->id : $this->modelos[$i]::insertGetId(['name'=>$row[$i]]);
                    }else{
                        $item[$this->fieldInsert[$i]] = null;
                    }
                     
            }

            $item['saldo']     = round($row[$this->columnSaldo],2);
            $item['ano']       = (int)$this->saldoYear;
            $item['Month_id']       = (int)$this->saldoMonth;
            $item['import_id'] = $ImportId;
            FinancialSituationeModel::insert($item);
            $inserCount++;
        }

        return ['status'=>'success','totalImport'=> $inserCount];
       

    }

}
