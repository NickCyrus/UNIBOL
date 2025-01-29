<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TmpIngresos;

class TmpIngresosController extends Controller
{
    //

    static public function getGraficas($indice = 1){
        switch($indice){
            case 1:
                $datos  = TmpIngresos::selectRaw("corte , ano , sum(millones) valor")
                ->where('ano',2024)
                ->groupBy(['corte','ano'])
                ->orderBy( 'ano','DESC')
                ->get();
                
                $categories = [];
                $series     = [];
                foreach($datos as $data){
                    if (!in_array($data->corte, $categories)) $categories[] =  $data->corte;
                    $series[] = (int)str_replace('.','',$data->valor);
                }
                 

                return ['categories'=>$categories, 'serie'=>['data'=>$series]];
                
                
            break;
            case 2:
                $datos  = TmpIngresos::selectRaw("corte , ano , sum(millones) valor")
                ->where('ano',2023)
                ->groupBy(['corte','ano'])
                ->orderBy( 'ano','DESC')
                ->get();
                
                $categories = [];
                $series     = [];
                foreach($datos as $data){
                    if (!in_array($data->corte, $categories)) $categories[] =  $data->corte;
                    $series[] = (int)str_replace('.','',$data->valor);
                }
                 

                return ['categories'=>$categories, 'serie'=>['data'=>$series]];
                
                
            break;

            case 3:
                $datos  = TmpIngresos::selectRaw("ano , sum(millones) valor")
                ->groupBy(['ano'])
                ->orderBy( 'ano','DESC')
                ->get();
                
                $categories = [];
                $series     = [];
                foreach($datos as $data){
                    if (!in_array($data->corte, $categories)) $categories[] =  $data->ano;
                    $series[] = (int)str_replace('.','',$data->valor);
                }
                 

                return ['categories'=>$categories, 'serie'=>$series];
                
                
            break;
        }
    }
    
}
