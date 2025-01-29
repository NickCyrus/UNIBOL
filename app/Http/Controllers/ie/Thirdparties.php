<?php

namespace App\Http\Controllers\ie;

use App\Http\Controllers\Controller;
use App\Models\ie\IeCompany;
use App\Models\ie\IeThirdparty;
use Illuminate\Http\Request;

class Thirdparties extends Controller
{

    public function index(){
        return view('ie.terceros.index');
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
        $columnName      = $columnName_arr[$columnIndex]['data'] ?? 'name' ; // Column name
        $columnSortOrder = $order_arr[0]['dir'] ?? 'desc'; // asc or desc
        $searchValue     = $search_arr['value'] ?? ''; // Search value

        // Total records
        $totalRecords           = IeThirdparty::StatusActive()->select('count(*) as allcount')->count();
        $totalRecordswithFilter = IeThirdparty::StatusActive()->select('count(*) as allcount')->where('name', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $query   = IeThirdparty::query()->StatusActive();
        $query->orderBy($columnName,$columnSortOrder);
        if (isset($searchValue) && $searchValue){
            $query->where('name', 'like', '%' .$searchValue . '%');
        }

        $records = $query->select('*')->skip($start)->take($rowperpage)->get();

        $data_arr = [];

        

        foreach($records as $row){

                    $data_arr[] = array(
                                        "id" => $row->id,
                                        "classification"=>implode(' , ' , $row->classification ),
                                        "code" => $row->typedoc,
                                        "nit" => $row->nit,
                                        "name" => $row->name,
                                        "email" => $row->email,
                                        "cellphone" => $row->cellphone,
                                        "address" => $row->address,
                                        "estado" => $row->estado_html,
                                        "acciones" => view('component.btn-table-event',['slug'=>'terceros', 'view'=>'icon', 'row'=>$row])->render()
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


     public function ajax(Request $req , $opc){

            $results['results'] = [['id'=>1, "text"=>'NICK'],['id'=>2, "text"=>'NICK']];

            switch($opc){
                case 'load-thirdparties':
                        $terceros = IeThirdparty::query();
                        $terceros->selectRaw("id , name as text , nit");
                        $terceros->StatusActive([1]);
                        $terceros->limit(10);
                        
                        if ($req->search){
                            $terceros->where('name',"LIKE","%{$req->search}%");   
                        }
                        $result = $terceros->get();
                        return response()->json(['results'=>$result]);
                break;
                case 'load-thirdparties-company':
                    $terceros = IeThirdparty::query();
                    $terceros->selectRaw("nit as id , name as text");
                    $terceros->whereIn('nit' , IeCompany::Active()->select('nit')->pluck('nit'));
                    $terceros->StatusActive([1]);
                    $terceros->limit(10);
                    
                    if ($req->search){
                        $terceros->where('name',"LIKE","%{$req->search}%");   
                    }
                    $result = $terceros->get();
                    return response()->json(['results'=>$result]);
            break;
            }

            // return response()->json($results); 

     }

    
}
