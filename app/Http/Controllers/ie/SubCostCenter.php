<?php

namespace App\Http\Controllers\ie;

use App\Http\Controllers\Controller;
use App\Models\ie\IeSubCostcenter;
use Illuminate\Http\Request;
use Alert;

class SubCostCenter extends Controller
{
    //

    public function index(){
        return view('ie.sub-centros-de-costos.index');
    }

    public function edit(Request $request){
        return view('ie.sub-centros-de-costos.index' , ['edit'=>IeSubCostcenter::find($request->id)]);
    }


    public function save(Request $request){

        $parent = findCC($request->cc);
        
        if ($parent[0]){
           
            $field = ($parent[1]==1) ? 'id_cost_center' : 'id_parent';
            $args  =  [$field => $parent[0]->id,
                     'code'=>$request->subcc,
                     'state'=>1,
                     'name'=>$request->name,
                     'id_user'=>cuid()];    

                if (!findCC($request->subcc)[0] && !isset($request->id)){
                    $args['created_at'] = now();
                    IeSubCostcenter::insert($args);
                    return redirect()->route(getCurrentRouteGroup())->with('alert-success','Información guardada correctamente');
                }elseif ($request->id) {
                    IeSubCostcenter::find($request->id)->update($args);
                    return redirect()->route(getCurrentRouteGroup())->with('alert-success','Información guardada correctamente');
                }else{
                    return redirect()->route(getCurrentRouteGroup())->with('alert-danger',"Ya existe el código indicado {$request->subcc}");    
                }
        }else{
                return redirect()->route(getCurrentRouteGroup())->with('alert-danger',"No existe el código indicado {$request->cc}");
        }
     

    }

}
