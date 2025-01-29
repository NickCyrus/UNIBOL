<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\LogAction;
use App\Models\modulesapp;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class categoriesController extends Controller
{

        private $idApp = 13;

        function __construct()
        {
           
                
        }

        function index(){
                if (!Auth::User()->canApp($this->idApp)){
                    return redirect()->route('errorAccess');
                }

                return view('categories.index' , ['modulos'=> categories::orderBy('orden','ASC')->get() , 'permission'=>Auth::User()->permission($this->idApp)]);

        }

        function add(){
           
            if (!Auth::User()->acction($this->idApp,'anew')){
                return response()->json(['html'=> msgController::notPermission()]);
            } 

            return response()->json(['html'=> view('categories.form' , ['module'=>new categories])->render()]);

        }

        function edit($id){
           
            if (!Auth::User()->acction($this->idApp,'aedit')){
                return response()->json(['html'=> msgController::notPermission()]);
            } 

            return response()->json(['html'=> view('categories.form' , ['module'=>categories::find($id)])->render()]);

        }

        function delete($id){
           
            

            if (!Auth::User()->acction($this->idApp,'adelete')){
               return redirect()->route('errorAccess');
            } 

            $modulo =  categories::where('id',$id);
            logAction::log("Elimino el módulo <b>{$modulo->first()->name}</b>.",'delete');
            $modulo->delete();
            return redirect()->route('categorias')->with('alert-success','Categoría eliminada correctamente');

        }

        function save(Request $req){
           
            if (!Auth::User()->acction($this->idApp,'aedit')){
                return redirect()->route('errorAccess');
            } 

           
            $args = [ 'name'=>$req->name , 'orden'=>$req->orden ];    
            
            if (!$req->id){
                LogAction::log("Agrego el categoría <b>{$req->name}</b>.",'insert');
                $args['created_at'] = Carbon::now();
                categories::insert($args);
            }else{
                categories::where('id',$req->id)->update($args);
                logAction::log("Actualizo el categoría <b>{$req->name}</b>.",'update');
            }

            return redirect()->route('categorias')->with('alert-success','Infomación guardada correctamente');

        }



}
