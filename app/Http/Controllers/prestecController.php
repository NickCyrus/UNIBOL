<?php

namespace App\Http\Controllers;

use App\Models\contractsModel;
use App\Models\pptoEqheModel;
use App\Models\pptoMdoModel;
use App\Models\pptotecModel;
use App\Models\pptoVariosModel;
use App\Models\quotesModel;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Carbon;

class prestecController extends Controller
{
    
    private $idApp = 10;
    private $slug  = 'prestec';

    function index($id , $acttab = null){

            if (!Auth::User()->canApp($this->idApp)){
                return redirect()->route('errorAccess');
            }

            $cotizacion = quotesModel::find($id);
            $contrato   = contractsModel::where('id',$cotizacion->contracts_id)->first();
            $pptotec    = pptotecModel::where('pptoCotId',$id)->first();

            if (!$pptotec){
                    $add = [
                                'pptoCotId'=> $cotizacion->id,
                                'pptoCotDesc'=> $cotizacion->description,
                                'pptoCotUni'=> 'GLB',
                                'pptoCotValPar'=> $cotizacion->vr_aprobado,
                                'pptoCotValTot'=> $cotizacion->vr_aprobado,
                                'pptoFecIni'=> $contrato->initialdate,
                                'pptoFecFin'=> $contrato->fechaEnd(false),
                                'pptoResponsable'=> $cotizacion->lider_fec,

                                'pptoResponsable'=> $cotizacion->lider_fec,
                                'pptoFecha'=> date("Y-m-d"),
                                'pptoOt'=> 1,
                                'pptoPr'=> $cotizacion->n_pr,
                                'pptoCc'=> $cotizacion->cc_solutec,
                                'pptoCliente'=> 'FRONTERA ENERGY',
                                'pptoProyecto'=> $contrato->name,
                                'pptoComercial'=> '',
                                
                            ];

                pptotecModel::insert($add);
                $pptotec    = pptotecModel::where('pptoCotId',$id)->first();         
            }

            return view('contratos.prestec',
                        [
                         'contrato'=>contractsModel::where('id',$cotizacion->contracts_id)->first() , 
                        'permission'=>Auth::User()->permission($this->idApp),
                        // 'cotizacion'=>$cotizacion,
                        'parentId'=>$id,
                        'acttab'=>$acttab,
                        'pptotec'=>$pptotec
                        ]);

    }


    public function delete_mdo($id , $tab , $iddelete ){
            pptoMdoModel::where('mdoId', $iddelete)->delete();
        return  redirect()->route('contratos.cotizaciones.prestec',['id'=>$id,'acttab'=>$tab]);
    }

    public function delete_eqhe($id , $tab , $iddelete ){
        pptoEqheModel::where('eqheId', $iddelete)->delete();
        return  redirect()->route('contratos.cotizaciones.prestec',['id'=>$id,'acttab'=>$tab]);
    }

    public function delete_var($id , $tab , $iddelete ){
        pptoVariosModel::where('varId', $iddelete)->delete();
        return  redirect()->route('contratos.cotizaciones.prestec',['id'=>$id,'acttab'=>$tab]);
    }


    public function saveFieldExtras(Request $r , $id, $tab = null){

        $args = [
                    'pptoFinan'=>str_replace('.','',$r->pptoFinan),
                    'pptoAdmCen'=>str_replace('.','',$r->pptoAdmCen),
                    'pptoOtros'=>str_replace('.','',$r->pptoOtros),
                    'pptoObsr'=>$r->pptoObsr,
                    
                ];     
        pptotecModel::where('pptoCotId',$id)->update($args);

        return  redirect()->route('contratos.cotizaciones.prestec',['id'=>$id,'acttab'=>5])->with('alert-success','Guardado correctamente');;

    }
    

    public function makePdf($id , $action = null){
         
        $pdf = app('dompdf.wrapper');
        $pptotec = pptotecModel::where('pptoId',$id)->first();
        $pdf->setPaper('letter', 'landscape')
        ->loadView('pdf.ppto', ['pptotec'=>$pptotec]);
        if (!$action){
            return $pdf->stream('archivo.pdf');
        }else{
            return $pdf->download("Presupuesto Técnico N° {$id}.pdf");
        }
        
        
    }
    

    

}
