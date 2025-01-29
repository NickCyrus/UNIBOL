<?php
 
namespace App\Http\Controllers;

use App\Models\diversosModel;
use App\Models\itemsModel;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\LogAction;
use App\Models\salarys;

class salariesownerController extends Controller
{
    private $idApp = 17;
    private $slug  = 'salarys';
    private $slugRoute  = 'salariospropios';
    private $type  = 3;
    private $title = 'Salarios propios';
    private $firstLabel = 'Cargo';

    function index(){
            if (!Auth::User()->canApp($this->idApp)){
                return redirect()->route('errorAccess');
            }

            $rs = salarys::orderby('name')->where('type',$this->type)->get();
            return view( $this->slug.'.index' , ['slug'=>$this->slugRoute, 'firstLabel'=>$this->firstLabel , 'type'=>$this->type , 'title'=>$this->title ,'modulos'=> $rs , 'permission'=>Auth::User()->permission($this->idApp)]);

    }

    function add(){
       
        if (!Auth::User()->acction($this->idApp,'anew')){
            return response()->json(['html'=> msgController::notPermission()]);
        } 

        return response()->json(['html'=> view($this->slug.'.form' , ['module'=>new salarys , 'firstLabel'=>$this->firstLabel , 'type'=>$this->type , 'slug'=>$this->slugRoute , 'title'=>$this->title])->render()]);

    }

    function edit($id){
       
        if (!Auth::User()->acction($this->idApp,'aedit')){
            return response()->json(['html'=> msgController::notPermission()]);
        } 

        return response()->json(['html'=> view($this->slug.'.form' , ['module'=>salarys::find($id) , 'firstLabel'=>$this->firstLabel , 'type'=>$this->type , 'slug'=>$this->slugRoute , 'title'=>$this->title])->render()]);

    }

    function delete($id){
        

        if (!Auth::User()->acction($this->idApp,'adelete')){
           return redirect()->route('errorAccess');
        } 

        $modulo =  salarys::where('id',$id);
        logAction::log("Elimino el {$this->title} <b>{$modulo->first()->name}</b>.",'delete');
        $modulo->delete();
        return redirect()->route($this->slugRoute)->with('alert-success',"{$this->title} eliminado correctamente");

    }

    function save(Request $req){
       
        if (!Auth::User()->acction($this->idApp,'aedit')){
            return redirect()->route('errorAccess');
        } 

       
        $args = [   
                    'name'=>$req->name,
                    'value'=>$req->value,
                    'value_day'=>$req->value_day,
                    'type'=>$this->type,
                    'category'=>$req->category ,
                    'updated_at'=> Carbon::now()
                ];    
                
        if (!$req->id){
            LogAction::log("Agrego el {$this->title} <b>{$req->name}</b>.",'insert');
            $args['created_at'] = Carbon::now();
            salarys::insert($args);
        }else{
            salarys::where('id',$req->id)->update($args);
            LogAction::log("Actualizo la información del {$this->title} <b>{$req->name}</b>.",'update');
        }

        return redirect()->route($this->slugRoute)->with('alert-success','Infomación guardada correctamente');

    }

}
