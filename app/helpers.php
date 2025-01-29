<?php

use App\Models\ie\IeBank;
use App\Models\ie\IeBankMovementType;
use App\Models\ie\IeCompany;
use App\Models\ie\IeMovementType;
use App\Models\ie\IeThirdparty;
use App\Models\ie\states;
use App\Models\modulesapp;
use App\Models\profpermission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

    function active_user(){
        return Auth::user();
    }

    function cuid(){
        return active_user()->id;
    }
    

    function state($state='0'){
        return states::find($state)->state ?? 'N/A';
    }

    function getCurrentRouteGroup() {
        $routeName = Illuminate\Support\Facades\Route::current()->getName();
        return explode('.',$routeName)[0];
    }

    function callcon($controller) {
        $controller = 'App\Http\Controllers\\'.$controller; 
        return new $controller;
    }

    function callmod($model) {
        $model = 'App\Models\\'.$model; 
        return new $model;
    }

    function money($money , $prefix = '', $html = false) {
        $currency = number_format($money, 0 , ',', '.');
        if (!$html)
            return  "{$prefix} {$currency}";
        else
            return ( $currency < 0) ? '<span class="currency-negative">'."{$prefix} {$currency}".'</span>' : '<span class="currency-positive">'."{$prefix} {$currency}".'</span>';
    }

    function CarbonClass(){
        return new Carbon;
    }

    function carbon($fecha){
        Carbon::setLocale('es');
        return Carbon::parse($fecha)->locale('es_ES');
    }

    function invertirValor($valor){
       return (-1 * $valor);
    }
 
    function format_date($fecha , $format ="d/m/y"){
        Carbon::setLocale('es');
        
        return ($fecha) ? Carbon::parse($fecha)->format($format) : '';
    }

    function toDayName($date=''){
         $dias  = ["","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"];
         if (!$date) $date = date("Y-m-d");
         $fecha = carbon($date);
         return $dias[date('w', strtotime($fecha))];
    }

    function date_complete($date = ''){
        if (!$date) $date = date("Y-m-d");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $dias  = ["","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"];
        $fecha = carbon($date);
        $nombre_dia = date('w', strtotime($fecha));
        $mes = $meses[($fecha->format('n')) - 1];
        return $fecha->format('d') . ' de ' . $mes . ' del ' . $fecha->format('Y');
    }

    function tabulador($n){
       $tablulador = '';
       for($i=0;$i<=$n;$i++){
            $tablulador .= '&nbsp;';
       }

       return $tablulador;
       
    }

    

    function clearMoney($money) {
        $money = str_replace('.','',$money);
        $money = str_replace(',','.',$money);
        return $money;
    }

    function cclist() {
        $cc    = callmod('ie\IeCostCenter')->StatusActive()->select('code');
        $subcc = callmod('ie\IeSubCostcenter')->StatusActive()->select('code')->union($cc)->get();
        return  $subcc;
    }

    function findCC($code , $field ='') {
        if (!$code) return false;
        $cc    = [callmod('ie\IeCostCenter')->StatusActive()->code($code)->first(), 1];
        if (!$cc[0]) $cc = [callmod('ie\IeSubCostcenter')->code($code)->StatusActive()->first(),2];
        return ($field) ? $cc[0]->$field : $cc;
    }

     

    function getCatCC($code) {
        $cc    = callmod('ie\IeCostCenter')->StatusActive()->code($code)->first();
        return  $cc;
    }
    
    function getSubCC($code, $parent) {
        $cc    = callmod('ie\IeSubCostcenter')->StatusActive()->code($code)->IsParent($parent)->first();
        return  $cc;
    }

    function setArrayPermisos(){
        $permisos = profpermission::where('profid', active_user()->profid)->get();
        $lista = [];
        if ($permisos){
            foreach ($permisos as  $permisos) {
                $lista[$permisos->modappid] = $permisos;
            }
        }

        return $lista;

    }
    
    function cmodule(){
        $module = getCurrentRouteGroup();
        return modulesapp::where('urlapp', $module)->first() ?? new modulesapp;        
    }

    function can($event){
            $permisos = session('permission');
            $moduleId = session('moduleId'); 
            switch($event){
                case 'edit':
                    return  ($permisos[$moduleId]->aedit == 1) ? true : false;
                break;
                case 'detele':
                    return  ($permisos[$moduleId]->adelete == 1) ? true : false;
                break;
                case 'new':
                    return  ($permisos[$moduleId]->anew == 1) ? true : false;
                break;
                case 'view':
                    return  ($permisos[$moduleId]->aview == 1) ? true : false;
                break;
            }

       
    }

    function tipomov($id){
        return IeMovementType::where('id', $id)->first()->name ?? new IeMovementType;        
    }

    function tipomovMoney($money){
        return  (clearMoney($money) > 0) ? 'INGRESO' : 'EGRESO';        
    }

    function tipomovMoneyId($money){
        return  (clearMoney($money) > 0) ? 1 : 4;        
    }

    function getCompany($id){
        return IeCompany::find($id);
    }

    function getCompanyByNit($nit){
        return IeCompany::where('nit',$nit)->first();
    }

    function getThirdpartyByNit($nit){
        return IeThirdparty::where('nit',$nit)->first();
    }

    function getCompanyIdByThirdpartyId($id){
        $thirdparty = IeThirdparty::where('id', $id)->first();
        if ($thirdparty) {
            $company = IeCompany::where('nit', $thirdparty->nit)->first();
            if ($company) {
                return $company->id;
            }
        }
        return null;
    }

    function getThirdpartyIdByCompanyId($id){
        $company = IeCompany::where('id', $id)->first();
        if ($company) {
            $thirdparty = IeThirdparty::where('nit', $company->nit)->first();
            if ($thirdparty) {
                return $thirdparty->id;
            }
        }
        return null;
    }

    function getThirdparty($id=''){
        if ($id){
            return IeThirdparty::where('id',$id)->first();
        }
    }

    function getBackByTypeMovimentAndCompany($id_company , $id_moviment_type){
        return IeBank::whereIn('id',    
                        IeBankMovementType::where('id_movement_type', $id_moviment_type)->pluck('id_bank')->toArray()
                    )->where('id_company',$id_company)->get();
    }

    function getBackByTypeMovimentAndCompanyOption($id_company , $id_moviment_type){
        return IeBank::whereIn('id',    
                        IeBankMovementType::where('id_movement_type', $id_moviment_type)->pluck('id_bank')->toArray()
                    )->where('id_company',$id_company)->get();
    }
    
    

    function access_module($field = 'aview'){
        $slug   = getCurrentRouteGroup();
        $module = modulesapp::where('urlapp',$slug)->select('id')->first();
        if (!$module) return false;
        session(['moduleId' => $module->id]);
        $permission = profpermission::where('profid', active_user()->profid)->where('modappid',$module->id)->where($field,1)->first() ?? false;
        session(['permission' => setArrayPermisos()]);
        return ($permission) ? true : false;
    }

    function getDatalist($id_parent='' , $select = 'valor', $order = 'valor' ){
            return  callmod('Lista')
                    ->IsParent($id_parent)
                    ->orderBy($order)
                    ->selectRaw("$select as `option`")
                    ->StatusActive([1])
                    ->get();
    }

    function pagination(){
        return 25;
    }

    function makeForm($form, $info = []  , $event = ''){
        $html = '';
        if (is_array($form)){
            
           

            foreach($form as $field){
                extract($field);
               
                $field = array_merge($field , ['info'=>$info, 'eventAction'=>$event]);
                
                switch( $field["type"] ?? ''){
                    default:
                    case 'text':
                       $html .= view('component.form.input',$field)->render();
                    break;
                    case 'inputcc':
                        $html .= view('component.form.inputcc',$field)->render();
                    break;
                    case 'money':
                        $html .= view('component.form.money',$field)->render();
                     break;
                    case 'email':
                        $html .= view('component.form.input-email',$field)->render();
                     break;
                    case 'hidden':
                       $html .= view('component.form.hidden',$field)->render();
                    break;
                    case 'radio':
                        $html .= view('component.form.radio',$field)->render();
                    break;
                    case 'date':
                        $html .= view('component.form.date',$field)->render();
                    break;
                    case 'state':
                       $html .= view('component.form.state',$field)->render();
                    break;
                    case 'select':
                        $html .= view('component.form.select',$field)->render();
                     break;
                    case 'file-preview':
                        $html .= view('component.form.file-preview',$field)->render();
                    break;
                    case 'color':
                        $html .= view('component.form.color',$field)->render();
                    break;      
                    
                }
                
                    
                
            }

            
        }else{
            $html = 'Sin formato';
        }
      

        return $html;     
    }


    function rjhtml($string){
        return json_encode(['html'=>$string]);
    }

    function success(){
        return json_encode(['success'=>true]);
    } 
    
    function imageToPdf($image , $name='Sin imagen'){
        
        if (!file_exists(public_path($image))){
            return 'data:image/png;base64,'.base64_encode(file_get_contents(public_path('no_logo.png')));
        }else{
            return "data:image/png;base64,".base64_encode(file_get_contents(public_path($image)));
        }

    }

    function optionSelect($args){

        $optionHTML = '';
        extract($args);
        $select = '';
        $model = callmod($model)::query();

        if (isset($where)){
            $model->whereRaw($where);
        }

        $model->StatusActive([1]);

        $selectField = '';
        if (isset($data)){
            if (is_array($data)){
                foreach($data as $keyData=>$value){
                    $selectField .= ", `{$value}`";
                }
            }
        }

        $model->selectRaw("`$key` as keyID , `$label` as label  {$selectField}");

        
        $model->orderBy($label);
        if (isset($limit)){ $model->limit($limit); }
        
        $rows = $model->get();
        
        if (isset($output)){

            foreach($rows as $row){
                
                
                $strData = '';

                if (isset($id)) $select  = ($id == $row->keyID) ? 'selected' : '';

                if (isset($data)){
                    
                    if (is_array($data)){
                        foreach($data as $key=>$value){
                            $strData .= " data-{$key}='{$row->$value}'";
                        }
                    }
                }

                $optionHTML.="<option value='{$row->keyID}' {$select} {$strData} >$row->label</option>";
            }   

           
          
            switch($output){
                case 'option':
                     echo $optionHTML;
                break;
                case 'html':
                    return '<option selected value="" '.$strData.'></option>'.$optionHTML;
                break;
                case 'result':
                    return ($optionHTML) ? '<option selected value="" '.$strData.'></option>'.$optionHTML : '';
                break;
            }
            return ;
        }

        return $rows;
    }

    function prepareHtml($args){
        return  $args;
    }

    function tercero($id){
        return IeThirdparty::find($id);
    }

    function getMesesCorto($mes){
        $mesesCorto = [1=>'Ene', 2=>'Feb', 3=>'Mar',  4=>'Abr', 5=>'May', 6=>'Jun', 7=>'Jul', 8=>'Ago', 9=>'Sep', 10=>'Oct',   11=>'Nov',  12=>'Dic' ];
        return $mesesCorto[$mes];
    }

?>