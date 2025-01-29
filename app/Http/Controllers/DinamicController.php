<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use function Composer\Autoload\includeFile;
use Validator;

class DinamicController extends Controller
{
    //
    private $config;
    private $model;
    private $view;
    private $table;
    private $form;
    private $data;

    public function __construct()
    {
        // Closure as callback
   
        if (file_exists(base_path().'/resources/views/ie/'.getCurrentRouteGroup().'/config.php')){
            include(base_path().'/resources/views/ie/'.getCurrentRouteGroup().'/config.php');
            $this->data  = $data;
        }
        
    }

    

    public function filter(Request $request , $id , $filter){
        
        
        $registros  = $this->data['model']::query();

        if (!$this->view) $this->view = 'dinamico.dinamico';
        
        $registros->StatusActive();

        if ($filter){
            $registros->$filter($id);
        }
        
        $default = ['rows'=>$registros->orderBy('state')->get(), 'viewPath'=>''];
        
        $dataView = array_merge($default, $this->data);

        return view($this->view,$dataView);

    }

    public function index(Request $request){
        
            $registros  = $this->data['model']::query();

            if (!isset($this->data['vIndex'])) 
                $this->view = 'dinamico.dinamico';
            else
                $this->view = $this->data['vIndex'];

            $default = ['rows'=>$registros->StatusActive()->orderBy('state')->get(), 'viewPath'=>''];
            
            $dataView = array_merge($default, $this->data);

            return view($this->view,$dataView);

    }

    public function new(Request $request){
        
        $info  = new $this->data['model'];
        if (!$this->view) 
            $this->view = 'dinamico.form';
        else
            $this->view .= '.form';

        $default = ['info'=>$info , 'event'=>'new' , 'prefixTitle'=>'Nuevo', 'viewPath'=>'', $request->all() ];

        $dataView = array_merge($default, $this->data);

        return view($this->view,$dataView);

    }

    public function edit(Request $request , $id){
        
        $info  = new $this->data['model'];

        if (!$this->view) 
            $this->view = 'dinamico.form';
        else
            $this->view .= '.form';

        $default = ['info'=>$info::find($id) , 'event'=>'edit' , 'prefixTitle'=>'Editar', 'viewPath'=>''];

        $dataView = array_merge($default, $this->data);

        return view($this->view,$dataView);

    }

    public function prepareValidation($valid=[], $request){

        

        if ($this->data['campos']){

            foreach($this->data['campos'] as $campo){
                 if (is_array($valid)){
                    foreach($valid as $key=>$rule){
                        $i=0;
                        foreach($rule as $itemVal){
                            $field = $campo['name'];
                            if (!is_array($request->$field)) $valid[$key][$i] = str_replace("{{$campo['name']}}", $request->$field , $valid[$key][$i]);    
                            $i++;
                        }
                    }
 
                 }
            }
        }
   
        return $valid;

    }

    public function save(Request $request){
        
        $modelo  = new $this->data['model'];

        if (isset($this->data['validate'])){
            $validate = $request->validate($this->prepareValidation($this->data['validate'], $request) , $this->data['validateMSG']);
        }
        
        $datos = $request->except( array_merge(['id','_token'] , $this->data['except'] ?? []  ));
        
        $datos['id_user'] =  cuid();

        
        foreach($this->data['campos'] as $campo){

            if (isset($campo['afterSave'])){
                if ($datos[$campo['name']]) $datos[$campo['name']] = $campo['afterSave']($datos[$campo['name']]);
            }

            $typeFile = ['file-preview','file']; 
            
            if (isset($campo['type']) && in_array($campo['type'] ,  $typeFile) && $request->file($campo['name'])){
               
                $fileName = auth()->id(). '_'.rand(). '_' . time() . '.'. $request->file($campo['name'])->extension();  
                
                $request->file(($campo['name']))->move(public_path('upload'), $fileName);
                if ( file_exists( public_path('upload')."/".$fileName)){
                    $datos[$campo['name']] = "upload/{$fileName}";
                }
                

            }

        }

        if (!isset($request->state)) $datos['state'] = 2;
 
       
        try {

                if (!$request->id){
                    $id         = $this->data['model']::insertGetId($datos);
                    $lastModel  = $this->data['model']::find($id);
                
                }else{
                    $lastModel = $this->data['model']::find($request->id);
                    $lastModel->update($datos);
                }

                if (isset($this->data['callEndSave'])){
                    $lastModel->callEndSave($request , $lastModel );
                }

                    
        } catch(\Illuminate\Database\QueryException $ex){ 
            return redirect()->route(getCurrentRouteGroup())->with('alert-error','Se produjo un error inesperado');
        }
       
        return redirect()->route(getCurrentRouteGroup())->with('alert-success','Información guardada correctamente');

    }


    function del(Request $request){
        $this->data['model']::find($request->id)->update(['state'=>3]);
        return redirect()->route(getCurrentRouteGroup())->with('alert-danger','Registro Eliminado');
    }
 
}
