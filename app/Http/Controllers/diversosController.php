<?php
 
namespace App\Http\Controllers;

use App\Models\diversosModel;
use App\Models\itemsModel;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\LogAction;

class diversosController extends Controller
{
    private $idApp = 14;
    private $slug  = 'diversos';

    function index(){
            if (!Auth::User()->canApp($this->idApp)){
                return redirect()->route('errorAccess');
            }

            return view( $this->slug.'.index' , ['modulos'=> diversosModel::orderby('name')->get() , 'permission'=>Auth::User()->permission($this->idApp)]);

    }

    function add(){
       
        if (!Auth::User()->acction($this->idApp,'anew')){
            return response()->json(['html'=> msgController::notPermission()]);
        } 

        return response()->json(['html'=> view($this->slug.'.form' , ['module'=>new diversosModel])->render()]);

    }

    function edit($id){
       
        if (!Auth::User()->acction($this->idApp,'aedit')){
            return response()->json(['html'=> msgController::notPermission()]);
        } 

        return response()->json(['html'=> view($this->slug.'.form' , ['module'=>diversosModel::find($id)])->render()]);

    }

    function delete($id){
        

        if (!Auth::User()->acction($this->idApp,'adelete')){
           return redirect()->route('errorAccess');
        } 

        $modulo =  diversosModel::where('id',$id);
        logAction::log("Elimino el diverso <b>{$modulo->first()->name}</b>.",'delete');
        $modulo->delete();
        return redirect()->route($this->slug)->with('alert-success','Diverso eliminado correctamente');

    }

    function save(Request $req){
       
        if (!Auth::User()->acction($this->idApp,'aedit')){
            return redirect()->route('errorAccess');
        } 

       
        $args = [   
                    'name'=>$req->name,
                    'measure_id'=>$req->measure_id,
                    'value'=>$req->value ,
                    'updated_at'=> Carbon::now()
                ];    
                
        if (!$req->id){
            LogAction::log("Agrego el diverso <b>{$req->name}</b>.",'insert');
            $args['created_at'] = Carbon::now();
            diversosModel::insert($args);
        }else{
            diversosModel::where('id',$req->id)->update($args);
            LogAction::log("Actualizo la información del diverso <b>{$req->name}</b>.",'update');
        }

        return redirect()->route($this->slug)->with('alert-success','Infomación guardada correctamente');

    }

}
