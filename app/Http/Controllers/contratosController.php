<?php

namespace App\Http\Controllers;

use App\Mail\CotizacionMail;
use App\Models\contractsItemsModel;
use App\Models\contractsModel;
use App\Models\equiposModel;
use App\Models\itemsModel;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\LogAction;
use App\Models\LogSendMail;
use App\Models\materialsModel;
use App\Models\pptoEqheModel;
use App\Models\pptoMdoModel;
use App\Models\pptoVariosModel;
use App\Models\quotesItemsModel;
use App\Models\quotesModel;
use App\Models\equipossubModel;
use App\Models\diversosModel;
use App\Models\taxes;

use App\Models\salarys;
use Illuminate\Support\Facades\Mail;

class contratosController extends Controller
{
    private $idApp = 10;
    private $slug  = 'contratos';

    function index(){
            if (!Auth::User()->canApp($this->idApp)){
                return redirect()->route('errorAccess');
            }

            return view( $this->slug.'.index' , ['modulos'=> contractsModel::orderby('initialdate','DESC')->get() , 'permission'=>Auth::User()->permission($this->idApp)]);

    }

    function add(){

        if (!Auth::User()->acction($this->idApp,'anew')){
            return response()->json(['html'=> msgController::notPermission()]);
        }

        return response()->json(['html'=> view($this->slug.'.form' , ['module'=>new contractsModel])->render()]);

    }

    function edit($id){

        if (!Auth::User()->acction($this->idApp,'aedit')){
            return response()->json(['html'=> msgController::notPermission()]);
        }

        return response()->json(['html'=> view($this->slug.'.form' , ['module'=>contractsModel::find($id)])->render()]);

    }

    function delete($id){


        if (!Auth::User()->acction($this->idApp,'adelete')){
           return redirect()->route('errorAccess');
        }

        $modulo =  contractsModel::where('id',$id);
        logAction::log("Elimino el contrato <b>{$modulo->first()->contractor} - {$modulo->first()->name}</b>.",'delete');
        $modulo->delete();
        return redirect()->route($this->slug)->with('alert-success','Contrato eliminado correctamente');

    }


    function delete_item($idcontrato , $iditem){


        if (!Auth::User()->acction($this->idApp,'adelete')){
           return redirect()->route('errorAccess');
        }

        $modulo     =  contractsItemsModel::where('idcontracts', $idcontrato)->where('iditems',$iditem);
        // logAction::log("Elimino el contrato <b>{$modulo->first()->contractor} - {$modulo->first()->name}</b>.",'delete');
        $modulo->delete();
        return redirect()->route($this->slug.'.items',['id'=>$idcontrato])->with('alert-success','Item eliminado correctamente');

    }




    function save(Request $req){

        if (!Auth::User()->acction($this->idApp,'aedit')){
            return redirect()->route('errorAccess');
        }


        $args = [
                    'initialdate'=>$req->initialdate,
                    'contractor'=>$req->contractor,
                    'name'=>$req->name,
                    'number'=>$req->number,
                    'price'=>$req->price ,
                    'term'=>$req->term ,
                    'updated_at'=> Carbon::now()
                ];


        if (!$req->id){
            LogAction::log("Agrego el contrato <b>{$req->contractor} - {$req->name}</b>.",'insert');
            $args['created_at'] = Carbon::now();
            contractsModel::insert($args);
        }else{
            contractsModel::where('id',$req->id)->update($args);
            LogAction::log("Actualizo la información del contrato <b>{$req->contractor} - {$req->name}</b>.",'update');
        }

        return redirect()->route($this->slug)->with('alert-success','Infomación guardada correctamente');

    }


    public function items($id){

        if (!Auth::User()->acction($this->idApp,'aedit')){
            return redirect()->route('errorAccess');
        }

        return view('contratos.items',['contrato'=>contractsModel::where('id',$id)->first() , 'permission'=>Auth::User()->permission($this->idApp) ]);

    }





    public function add_item($id){
        return view('contratos.items_add',['contrato'=>contractsModel::where('id',$id)->first() ,
                                           'items'=>itemsModel::all(),

                                           'permission'=>Auth::User()->permission($this->idApp) ]);
    }


    public function ajax(Request $r , $opc){

            switch($opc){
                case 'addItemContrato':
                    if ($r->add == 'true'){
                        contractsItemsModel::insert(['idcontracts'=>$r->idcontrato , 'iditems'=>$r->iditem]);
                    }else{
                        contractsItemsModel::where('idcontracts', $r->idcontrato)->where('iditems',$r->iditem)->delete();
                    }
                break;
                case 'openSalarios':
                        $rows  = salarys::all();
                        return json_encode(['html'=> view('modals.salarios' , ['acttab'=>$r->acttab , 'tipo'=>$r->tipo, 'rows'=>$rows , 'id'=>$r->id , 'pptoId'=>$r->ppto])->render()]);
                break;
                case 'addSalarie':
                case 'updateSalarios':

                    $mdoPorPreSoc = 0.439;

                    $salary = salarys::find($r->salary);
                    $mdoPreSoc = ( $salary->value * $mdoPorPreSoc);
                    $mdoSalTot = $r->cantidad * ($salary->value+$mdoPreSoc)/30*$r->dias;
                    $add = [
                             'mdoTipo'=>$r->tipo,
                             'mdoPptoId'=>$r->pptoId,
                             'mdoCant'=>$r->cantidad,
                             'mdoDias'=>$r->dias,
                             'mdoCod'=>$salary->id,
                             'mdoDesc'=> $salary->name,
                             'mdoSalario'=> $salary->value,
                             'mdoPreSoc'=> $mdoPreSoc,
                             'mdoSalTot'=>$mdoSalTot,
                             'mdoSalPat'=>$mdoSalTot,
                             'mdoPorPreSoc'=> $mdoPorPreSoc
                    ];
                    

                    if (!isset($r->idupdate)){
                        pptoMdoModel::insert($add);
                    }else{
                        pptoMdoModel::where('mdoId',$r->idupdate)->update($add);
                    }   

                    return "success";
                break;

                case 'openEquipos':
                    $rows  = equiposModel::all();
                    return json_encode(['html'=> view('modals.equipos' , ['acttab'=>$r->acttab , 'tipo'=>$r->tipo, 'rows'=>$rows , 'id'=>$r->id , 'pptoId'=>$r->ppto])->render()]);
                break;
                case 'addEquipament':
                case 'updateEquipos':

                    $equipo     = equiposModel::find($r->equipo);
                    $eqheValor  = 0;

                    if ($r->tipoServ == 'h') $eqheValor  = $equipo->valuehours;
                    if ($r->tipoServ == 'd') $eqheValor  = $equipo->valueday;
                    if ($r->tipoServ == 'm') $eqheValor  = $equipo->valuemonth;
                    
                    $eqheValPat  = ($r->cantidad *  $r->dayhour) * $eqheValor;

                    $add = [
                             'eqheTipo'=>$r->tipo,
                             'eqhepptoId'=>$r->pptoId,
                             'eqheCodigo'=>$equipo->id,
                             'eqheDesc'=>$equipo->description,
                             'eqheUnid'=>$equipo->measure_id,
                             'eqheCantidad'=> $r->cantidad,
                             'eqheNum'=> $r->dayhour,
                             'eqheModo'=> $r->tipoServ,
                             'eqheValor'=>$eqheValor,
                             'eqheValPat'=> $eqheValPat
                    ];

                    if (!isset($r->idupdate)){
                        pptoEqheModel::insert($add);
                    }else{
                        pptoEqheModel::where('eqheId',$r->idupdate)->update($add);
                    }

                    return "success";

                break;
                case 'addVarios':
                case 'updateVarios':

                    switch($r->servicio){
                        case '1':
                            $vario    = materialsModel::where('id',$r->iditem)->first();
                            $valor    = $vario->value;
                            $valorPar = ( $valor * $r->cantidad );
                        break;
                        case '2':
                            $vario = equipossubModel::where('id',$r->iditem)->first();
                            $valor = $vario->valuemonth;
                            $valorPar = ( $valor * $r->cantidad );
                        break;
                        case '3':
                            $vario = diversosModel::where('id',$r->iditem)->first();
                            $vario->description = $vario->name;
                            $valor = $vario->value;
                            $valorPar = ( $valor * $r->cantidad );
                        break;
                        case '4':
                            $vario = taxes::where('id',$r->iditem)->first();
                            $vario->description = $vario->name;
                            $valor    = $r->valuni ?? $r->valor;
                            $valorPar = ( $valor * $r->cantidad );                            
                        break;

                    }

                    $add = [
                        'varTipo'=>$r->tipo,
                        'varTIpoSer'=>$r->servicio,
                        'varpptoId'=>$r->pptoId,
                        'varCodigo'=>$vario->id,
                        'varDesc'=>$vario->description,
                        'varUnid'=>$vario->measure_id,
                        'varCantidad'=> $r->cantidad,
                        'varValor'=>$valor,
                        'varValPar'=> $valorPar
                    ];
                    
                    if (!isset($r->idupdate)){
                        pptoVariosModel::insert($add);  
                    }else{
                        pptoVariosModel::where('varId',$r->idupdate)->update($add);  
                    }
                     
                     return "success";
                     
                break;    
                case 'openVarios':
                    switch($r->servicio){
                        case '1': // MATERIALES E INSUMOS
                            $rows  =  materialsModel::all();  
                            return json_encode(['html'=> view('modals.materiales' , 
                                                    ['acttab'=>$r->acttab , 
                                                     'tipo'=>$r->tipo, 
                                                     'rows'=>$rows , 
                                                     'id'=>$r->id , 
                                                     'pptoId'=>$r->ppto,
                                                     'servicio'=>$r->servicio
                                                     ])->render()]);        
                        break;
                        case '2':
                            $rows  =  equipossubModel::all();  
                            return json_encode(['html'=> view('modals.equiposSub' , 
                                                    ['acttab'=>$r->acttab , 
                                                     'tipo'=>$r->tipo, 
                                                     'rows'=>$rows , 
                                                     'id'=>$r->id , 
                                                     'pptoId'=>$r->ppto,
                                                     'servicio'=>$r->servicio
                                                     ])->render()]);     
                        break;

                        case '3':
                            $rows  =  diversosModel::all();  
                            return json_encode(['html'=> view('modals.diversos' , 
                                                    ['acttab'=>$r->acttab , 
                                                     'tipo'=>$r->tipo, 
                                                     'rows'=>$rows , 
                                                     'id'=>$r->id , 
                                                     'pptoId'=>$r->ppto,
                                                     'servicio'=>$r->servicio
                                                     ])->render()]);     
                        break;
                        case '4':
                            $rows  =  taxes::all();  
                            return json_encode(['html'=> view('modals.taxes' , 
                                                    ['acttab'=>$r->acttab , 
                                                     'tipo'=>$r->tipo, 
                                                     'rows'=>$rows , 
                                                     'id'=>$r->id , 
                                                     'pptoId'=>$r->ppto,
                                                     'servicio'=>$r->servicio
                                                     ])->render()]);     
                        break;
                    }
                    
                   
                break;

                case 'editSalarios':
                        $info = pptoMdoModel::where('mdopptoId',$r->ppto)->where('mdoId',$r->id)->first();
                        return json_encode(['html'=> view('modals.edit.salarios' , 
                                                    ['acttab'=>$r->acttab , 
                                                     'tipo'=>$r->tipo, 
                                                     'info'=>$info , 
                                                     'id'=>$r->id ,
                                                     'parentId'=>$r->parentId,
                                                     'pptoId'=>$r->ppto
                                                     ])->render()]);     
                break;

                case 'editEquipos':
                    $info = pptoEqheModel::where('eqhepptoId',$r->ppto)->where('eqheId',$r->id)->first();
                    return json_encode(['html'=> view('modals.edit.equipos' , 
                                                ['acttab'=>$r->acttab , 
                                                 'tipo'=>$r->tipo, 
                                                 'info'=>$info , 
                                                 'id'=>$r->id ,
                                                 'parentId'=>$r->parentId,
                                                 'pptoId'=>$r->ppto
                                                 ])->render()]);     
                break;

                case 'editVarios':

                    $info = pptoVariosModel::where('varpptoId',$r->ppto)->where('varId',$r->id)->first();
                    return json_encode(['html'=> view('modals.edit.varios' , 
                                                ['acttab'=>$r->acttab , 
                                                 'tipo'=>$r->tipo, 
                                                 'info'=>$info , 
                                                 'id'=>$r->id ,
                                                 'parentId'=>$r->parentId,
                                                 'pptoId'=>$r->ppto
                                                 ])->render()]);  

                break;

                


            }


    }

    public function cotizaciones($id){

        if (!Auth::User()->acction($this->idApp,'aedit')){
            return redirect()->route('errorAccess');
        }

        return view('contratos.cotizaciones',['contrato'=>contractsModel::where('id',$id)->first() , 'permission'=>Auth::User()->permission($this->idApp) ]);

    }

    public function add_cotizacion($idcontrato){

        if (!Auth::User()->acction($this->idApp,'anew')){
            return response()->json(['html'=> msgController::notPermission()]);
        }


        return response()->json(['html'=> view($this->slug.'.cotizacionform' ,
                                                ['module'=>new quotesModel,
                                                 'contrato'=> contractsModel::where('id',$idcontrato)->first()])->render()]);

    }

    public function edit_cotizacion($idcontrato , $item){

        if (!Auth::User()->acction($this->idApp,'aedit')){
            return response()->json(['html'=> msgController::notPermission()]);
        }

        return response()->json(['html'=> view($this->slug.'.cotizacionform' ,
                                                ['module'=>quotesModel::find($item),
                                                 'all'=>true,
                                                 'contrato'=> contractsModel::where('id',$idcontrato)->first()])->render()]);

    }

    public function save_cotizaciones(Request $r , $contracts_id){

            $args = [
                        'contracts_id'=>$contracts_id,
                        'description'=>$r->description,
                        'lider_fec'=>$r->lider_fec,

                    ];


            if (!$r->id){
                LogAction::log("Agrego la cotización <b>{$r->description} - {$r->lider_fec}</b>.",'insert');
                $args['created_at'] = Carbon::now();
                $args['state']      =  1;

                quotesModel::insert($args);
            }else{

                $cotizacion =  quotesModel::where('id',$r->id);

                if ($r->state){
                    $args['cc_solutec'] = $r->cc_solutec;
                    $args['n_pr']       = $r->n_pr;
                    $args['n_pedido']   = $r->n_pedido;
                    $args['state']      = $r->state;
                    $args['updated_at'] = Carbon::now();
                }

                $cotizacion->update($args);

                quotesModel::updateSum($r->id);

                LogAction::log("Actualizo la cotización <b>{$r->description} - {$r->lider_fec}</b>.",'update');
            }

            return redirect()->route($this->slug.'.cotizaciones',['id'=>$contracts_id])->with('alert-success','Infomación guardada correctamente');

    }


    public function delete_cotizacion($idcontrato , $item){
          quotesModel::where('contracts_id', $idcontrato)->where('id',$item)->delete();

          return $this->cotizaciones($idcontrato);
    }


    public function items_cotizacion($idcontrato, $idcontiza){

        if (!Auth::User()->acction($this->idApp,'aedit')){
            return redirect()->route('errorAccess');
        }

        return view('contratos.cotizacionesitems',[
                                                    'contrato'=>contractsModel::where('id',$idcontrato)->first() ,
                                                    'items_cotizacion'=>quotesItemsModel::where('contracts_id',$idcontrato)->where('quote_id',$idcontiza)->get(),
                                                    'cotizacionid'=>$idcontiza ,
                                                    'cotizacion'=>quotesModel::where('id',$idcontiza)->first(),
                                                    'permission'=>Auth::User()->permission($this->idApp)
                                                  ]);
    }


    function item_cotizacion($idcontrato, $idcontiza , $iditem){



        if (!Auth::User()->acction($this->idApp,'anew') && !Auth::User()->acction($this->idApp,'aedit') ){
            return redirect()->route('errorAccess');
        }


        return response()->json(['html'=> view('contratos.cotizacionitemform', [
                                                      'contrato'=>contractsModel::where('id',$idcontrato)->first(),
                                                      'cotizacion'=>quotesModel::where('id',$idcontiza)->first(),
                                                      'item'=>itemsModel::where('id',$iditem)->first()
                                                    ])->render()]);

    }


    function itemsave_cotizacion(Request $r , $idcontrato, $idcontiza , $iditem){

            $args = [
                        'contracts_id'=>$idcontrato,
                        'quote_id'=>$idcontiza,
                        'item_id'=>$iditem,
                        'item_valor'=> itemsModel::find($iditem)->value,
                        'item_quantity'=>$r->item_quantity
                    ];

            quotesItemsModel::insert($args);

            quotesModel::updateSum($idcontiza);

            return redirect()->route('contratos.cotizaciones.items',['id'=>$idcontrato , 'item'=>$idcontiza]);

    }

    function itemdelete_cotizacion($idcontrato, $idcontiza , $iditem){

        quotesItemsModel::where('contracts_id',$idcontrato)
                           ->where('quote_id',$idcontiza)
                           ->where('id',$iditem)
                           ->delete();

        quotesModel::updateSum($idcontiza);

        return $this->items_cotizacion($idcontrato, $idcontiza );
    }


    public function showpdf($id){

        return response()->json(['html'=>view('contratos.cotizaciones.showpdf',['cotizacionid'=>$id])->render()]);

    }

    public function sendmail_cotizacion(Request $r, $item){

        $to = explode(',',$r->to);

        $cotizacion = quotesModel::where('id',$item)->first();

        $pdf = app('dompdf.wrapper');

        $pdf->setPaper('letter', 'landscape')->loadView('pdf.cotpresentada', ['cotizacion'=>$cotizacion]);
        $name = public_path()."/pdf/Presupuesto N° {$cotizacion->id}.pdf";
        $pdf->save($name);

        if (Mail::to($to)->send( new CotizacionMail($cotizacion , $r , $name ) )){
                unlink($name);
                // Guardamos el registro del envio
                $args= [
                        'userId'=>Auth::User()->id,
                        'quoteid'=>$item,
                        'subjet'=>$r->subject ?? 'Sin asunto',
                        'sendTo'=>$r->to ?? 'Error de almacenamiento',
                        'adjunto'=>null,
                        'sendBody'=>$r->msg,
                        'created_at'=>Carbon::now(),
                        'updated_at'=>Carbon::now()
                ];

                LogSendMail::insert($args);

                if ($cotizacion->state == 1){
                    quotesModel::where('id',$item)->update(['state'=>2]);
                    quotesModel::updateSum($item);
                }

                return redirect()->route('contratos.cotizaciones',['id'=>$cotizacion->contracts_id])->with('alert-success','Presupuesto enviado correctamente.');
        }else{
                return redirect()->route('contratos.cotizaciones',['id'=>$cotizacion->contracts_id])->with('alert-error','Error duránte el envío.');
        }



    }

    public function logSend($idCotizacion){

            $listLog = LogSendMail::where('quoteid',$idCotizacion)->get();
            return response()->json(
                [
                    'html'=>view('contratos.logsend',['logs'=>$listLog])->render()
                ]);

    }

}
