<?php

namespace App\Http\Controllers;

use App\Models\taxes;
use App\Models\LogAction;
use App\Models\modulesapp;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class taxesController extends Controller
{

        private $idApp = 18;

        function __construct()
        {
           
                
        }

        function index(){
                if (!Auth::User()->canApp($this->idApp)){
                    return redirect()->route('errorAccess');
                }

                return view('taxes.index' , ['modulos'=> taxes::orderBy('orden','ASC')->get() , 'permission'=>Auth::User()->permission($this->idApp)]);

        }

        function add(){
           
            if (!Auth::User()->acction($this->idApp,'anew')){
                return response()->json(['html'=> msgController::notPermission()]);
            } 

            return response()->json(['html'=> view('taxes.form' , ['module'=>new taxes])->render()]);

        }

        function edit($id){
           
            if (!Auth::User()->acction($this->idApp,'aedit')){
                return response()->json(['html'=> msgController::notPermission()]);
            } 

            return response()->json(['html'=> view('taxes.form' , ['module'=>taxes::find($id)])->render()]);

        }

        function delete($id){
           
            

            if (!Auth::User()->acction($this->idApp,'adelete')){
               return redirect()->route('errorAccess');
            } 

            $modulo =  taxes::where('id',$id);
            logAction::log("Elimino el impuesto <b>{$modulo->first()->name}</b>.",'delete');
            $modulo->delete();
            return redirect()->route('taxes')->with('alert-success','Impuesto eliminada correctamente');

        }

        function save(Request $req){
           
            if (!Auth::User()->acction($this->idApp,'aedit')){
                return redirect()->route('errorAccess');
            } 

           
            $args = [ 'name'=>$req->name , 'orden'=>$req->orden ];    
            
            if (!$req->id){
                LogAction::log("Agrego el Impuesto <b>{$req->name}</b>.",'insert');
                $args['created_at'] = Carbon::now();
                taxes::insert($args);
            }else{
                taxes::where('id',$req->id)->update($args);
                logAction::log("Actualizo el Impuesto <b>{$req->name}</b>.",'update');
            }

            return redirect()->route('taxes')->with('alert-success','Infomación guardada correctamente');

        }



}
