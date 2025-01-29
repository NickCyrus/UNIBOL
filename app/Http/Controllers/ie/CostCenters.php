<?php

namespace App\Http\Controllers\ie;

use App\Http\Controllers\Controller;
use App\Models\ie\IeCostCenter;
use App\Models\ie\IeThirdparty;
use Illuminate\Http\Request;

class CostCenters extends Controller
{

    public function index(){
        return view('ie.categorias-centro-de-costo.index');
    }    
  
    public function getList(Request $request){

        ## Read value
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowperpage      = $request->get("length") ?? pagination(); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $search_arr      = $request->get('search');

        $columnIndex     = $columnIndex_arr[0]['column'] ?? 3; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data'] ?? 'code' ; // Column name
        $columnSortOrder = $order_arr[0]['dir'] ?? 'desc'; // asc or desc
        $searchValue     = $search_arr['value'] ?? ''; // Search value

        
        // Total records
        $totalRecords           = IeCostCenter::StatusActive()->select('count(*) as allcount')->count();
        $totalRecordswithFilter = IeCostCenter::StatusActive()->select('count(*) as allcount')
        ->where('name', 'like', '%' .$searchValue . '%')
        ->oRwhere('code', 'like', '%' .$searchValue . '%' )
        ->oRwhereRaw("id_company IN ( SELECT id FROM ie_companies WHERE name LIKE '%{$searchValue}%' ) ")
        ->count();

        // Fetch records
        $query   = IeCostCenter::query()->StatusActive();
        $query->orderBy($columnName,$columnSortOrder);
        if (isset($searchValue) && $searchValue){
            $query->where('name', 'like', "%{$searchValue}%")
                    ->oRwhere('code', 'like', "%{$searchValue}%")
                    ->oRwhereRaw("id_company IN ( SELECT id FROM ie_companies WHERE name LIKE '%{$searchValue}%') ");
        }

        $records = $query->select('*')->skip($start)->take($rowperpage)->get();

        $data_arr = [];

         

        foreach($records as $row){
                    $tabulador = tabulador($row->level);
                    $acction   =  view('ie.categorias-centro-de-costo.table.event',['slug'=>'categorias-centro-de-costo', 'view'=>'icon', 'row'=>$row])->render();
                    $acction   .= view('component.btn-table-event',['slug'=>'categorias-centro-de-costo', 'view'=>'icon', 'row'=>$row])->render();
                    $data_arr[] = array(
                                        "code" => $tabulador.$row->code,
                                        "name" => $row->name,
                                        "padre" => $row->padre,
                                        "tdcc" => $row->tdcc,
                                        "level" => $row->level,
                                        "company" => $row->company,
                                        "estado" => $row->estado_html,
                                        "acciones" => $acction
                                        );
        }

        $response = array(
           "draw" => intval($draw),
           "iTotalRecords" => $totalRecords,
           "iTotalDisplayRecords" => $totalRecordswithFilter,
           "aaData" => $data_arr
        );

        return response()->json($response); 

     }


     public function ajax(Request $request){

        $args = [];

        $args['tipomov'] = tipomovMoney( $request->price);

        $args =  array_merge($request->all() , $args);
        switch($request->opc){

            case 'InfoCC':
                $cc = IeCostCenter::find($request->cc);
                return json_encode(['success'=>true, 'id_company'=>$cc->id_company, 'prefixCC'=>$cc->code]);
            break;

        }
    }

    
}
