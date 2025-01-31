<?php

namespace App\Http\Controllers\ie;

use App\Http\Controllers\Controller;
use App\Models\ie\IeCostCenterTypeClassification;
use App\Models\ie\IeIncomeExpense;
use App\Models\ie\IeIncomeExpensesDetails;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Imports\ExcelImport;
use Storage;
use App\Models\FinancialSituation\ImportExcelModel;
use App\Http\Controllers\FinancialSituationeController;
use App\Models\FinancialSituation\FinancialSituationeModel;

use Maatwebsite\Excel\Facades\Excel;
use PgSql\Result;

class IncomeExpenses extends Controller
{
    //
    function getFinancialSituationeModel(Request $r){

            $FinancialSituationeModel = FinancialSituationeModel::query();

            $FinancialSituationeModel->whereNotNull('id');
            if ($r->filter_Rubro) $FinancialSituationeModel->where('rubro_id',$r->filter_Rubro);
            if ($r->filter_tipo_rubro) $FinancialSituationeModel->where('homologation_id',$r->filter_tipo_rubro);
            if ($r->filter_periodo) {
                $datos = explode('|',$r->filter_periodo);
                $FinancialSituationeModel->where('Month_id',$datos[0]);
                $FinancialSituationeModel->where('ano',$datos[1]);
            }

            return $FinancialSituationeModel->paginate(50);


    }


    function getCabeceras(){
        return IeIncomeExpense::StatusActive([1])->orderby('created_at','DESC')->limit(10)->get();
    }
    public function index(Request $r){
        // return view('ie.IncomeExpenses.index', ['cabeceras'=>IeIncomeExpense::StatusActive([1])->orderby('id','DESC')->orderby('created_at','DESC')->paginate(50)]);
        return view('ie.IncomeExpenses.index', ['list'=>$this->getFinancialSituationeModel($r)]);

    }

    public function new(){
        return view('ie.IncomeExpenses.new' , ['info'=> new IeIncomeExpense, 'cabeceras'=>$this->getCabeceras() , 'new'=>true]  );
    }

    public function edit(Request $request){
        return view('ie.IncomeExpenses.new' , ['info'=> IeIncomeExpense::find($request->id), 'cabeceras'=>$this->getCabeceras()]);
    }

    
    function MovimentInterCompany($datos , $lastId ){


        if (isset($datos['cla_classification']) && $datos['cla_classification']==6 && $datos['cla_thirdparti']){

            // Se registra el ingreso a la compañia que presta
            $args = [
                'id_income_expenses'=>$lastId,
                'id_company'=>$datos['id_company'],
                'id_movement_type'=>4,
                'price'=>$datos['price'],
                'id_thirdparti'=> getThirdpartyByNit($datos['cla_thirdparti'])->id,
                'id_classification'=>6,
                'id_cost_centers'=>3766, // N/A
                'id_concept'=>22,
                'state'=>1,
                'id_accounts'=>63, // Cuentas por cobrar
                'id_user'=>$datos['id_user'],
               ];

            IeIncomeExpensesDetails::insert($args);

            // Registramos el ingreso
            $companyRow2  =    getCompanyByNit($datos['cla_thirdparti'])->id;
            $args['id_company'] = $companyRow2;
            $args['id_movement_type'] = 1;
            $args['id_concept'] = 36;
            $args['price'] = (-1 * $datos['price']);
            $args['id_thirdparti'] =  getThirdpartyByNit( getCompany($datos['id_company'])->nit )->id;
            $args['id_accounts'] = 117; // Cuentas por cobrar

            IeIncomeExpensesDetails::insert($args);

            // Registramos el ultimo movimiento


           for ($i = 1; $i <= $datos['cla_number']; $i++) {
                $args['id_movement_type'] = 4;
                $args['price'] = $datos['price'];
                $args['id_thirdparti'] = $datos['id_thirdparti'];
                if($datos['cla_number'] > 1 )
                unset($args['price']);
                unset($args['id_cost_centers']);
                unset($args['id_classification']);
                unset($args['id_cost_centers']);
                unset($args['id_accounts']);
                unset($args['id_concept']);

                IeIncomeExpensesDetails::insert($args);
            }


        }else{
            $args = [
                'id_income_expenses'=>$lastId,
                'id_company'=>$datos['id_company'],
                'id_movement_type'=>$datos['id_movement_type'],
                'price'=>$datos['price'],
                'id_thirdparti'=>$datos['id_thirdparti'],
                'state'=>1,
                'id_user'=>$datos['id_user'],
               ];
            IeIncomeExpensesDetails::insert($args);
        }

    }

    public function save(Request $request){

            $datos  = $request->except(['id','_token' , 'cla_classification', 'cla_thirdparti', 'cla_number','id_account_2','id_account_3']);
            $datos2 = $request->except(['id','_token']);
            $datos['price']  =  clearMoney($datos['price']);
            $datos2['price'] = $datos['price'];
            $datos['id_movement_type'] = tipomovMoneyId($datos['price']);
            $datos2['id_movement_type'] = $datos['id_movement_type'];
            $datos['id_user'] = cuid();
            $datos2['id_user'] = $datos['id_user'];
            // $datos['id_thirdparti'] = $datos['id_thirdparti'];
            // $datos['id_account'] = $datos['id_account'];
            // $datos['date_income_expenses'] = $datos['date_income_expenses'];
            // $datos['tipdoc'] = $datos['tipdoc'];
            // $datos['tipcon'] = $datos['tipcon'];
            $datos['observation'] = strtoupper( $datos['observation'] );



            if (!$request->id){
                  $datos['created_at'] = now();
                  $datos['state'] = 2;
                  $lastId = IeIncomeExpense::insertGetId($datos);



                  if ($datos2['id_account_2']){

                        $datos['state'] = 1;

                        IeIncomeExpense::find($lastId)->update(['state'=>1,'created_at'=> now() ]);


                        $args = [
                            'id_income_expenses'=>$lastId,
                            'id_company'=>$datos['id_company'],
                            'id_movement_type'=>$datos['id_movement_type'],
                            'price'=>$datos['price'],
                            'id_thirdparti'=>$datos['id_thirdparti'],
                            'state'=>1,
                            'id_user'=>$datos['id_user'],
                            'id_classification'=>9,
                            'id_cost_centers'=>null, // N/A
                            'id_concept'=>28,
                            'id_ledgeraccount'=>107,
                           ];

                           IeIncomeExpensesDetails::insert($args);

                        $datos['price']            = invertirValor($datos['price']);
                        $datos['id_movement_type'] = tipomovMoneyId($datos['price']);
                        $datos['id_account']       = $datos2['id_account_2'];
                        $datos['created_at'] = now();
                        $lastId_auto = IeIncomeExpense::insertGetId($datos);

                        $args = [
                            'id_income_expenses'=>$lastId_auto,
                            'id_company'=>$datos['id_company'],
                            'id_movement_type'=>$datos['id_movement_type'],
                            'price'=>$datos['price'],
                            'id_thirdparti'=>$datos['id_thirdparti'],
                            'state'=>1,
                            'id_user'=>$datos['id_user'],
                            'id_classification'=>9,
                            'id_cost_centers'=>null, // N/A
                            'id_concept'=>42,
                            'id_ledgeraccount'=>125,
                           ];

                        IeIncomeExpensesDetails::insert($args);
                        return ['redirec'=> true , 'url'=>route('registro-ingresos-egresos')];

                  }else if ($datos2['id_account_3']){

                    $datos['state'] = 1;

                    IeIncomeExpense::find($lastId)->update(['state'=>1,'created_at'=> now() ]);


                    $args = [
                        'id_income_expenses'=>$lastId,
                        'id_company'=>$datos['id_company'],
                        'id_movement_type'=>$datos['id_movement_type'],
                        'price'=>$datos['price'],
                        'id_thirdparti'=>$datos['id_thirdparti'],
                        'state'=>1,
                        'id_user'=>$datos['id_user'],
                        'id_classification'=>6,
                        'id_cost_centers'=>3766, // N/A
                        'id_concept'=>22,
                        'id_ledgeraccount'=>63,
                       ];

                       IeIncomeExpensesDetails::insert($args);
                    $companyIdAfter = $datos['id_company'];
                    $datos['price']            = invertirValor($datos['price']);
                    $datos['id_movement_type'] = tipomovMoneyId($datos['price']);
                    $datos['id_account']       = $datos2['id_account_3'];
                    $datos['id_company']       = getCompanyIdByThirdpartyId($datos['id_thirdparti']);
                    $datos['id_thirdparti']    = getThirdpartyIdByCompanyId($companyIdAfter);
                    $datos['created_at'] = now();
                    $lastId_auto = IeIncomeExpense::insertGetId($datos);

                    $args = [
                        'id_income_expenses'=>$lastId_auto,
                        'id_company'=>$datos['id_company'],
                        'id_movement_type'=>$datos['id_movement_type'],
                        'price'=>$datos['price'],
                        'id_thirdparti'=>$datos['id_thirdparti'],
                        'state'=>1,
                        'id_user'=>$datos['id_user'],
                        'id_classification'=>6,
                        'id_cost_centers'=>3766, // N/A
                        'id_concept'=>36,
                        'id_ledgeraccount'=>117,
                       ];

                    IeIncomeExpensesDetails::insert($args);
                    return ['redirec'=> true , 'url'=>route('registro-ingresos-egresos')];

              }else{

                        $this->MovimentInterCompany($datos2 , $lastId);

                  }

            }else{
                  $datos['state'] = 1;
                  IeIncomeExpense::find($request->id)->update($datos);
                  $lastId = $request->id;
            }

            return ['id'=> $lastId , 'html'=>view('ie.movi.form.detalle' , ['cabecera'=> IeIncomeExpense::find($lastId), 'id'=> $lastId ])->render()];

    }

    public function excel(Request $r){

        $excel = $r->file('excel');
        if (!$excel){
            return view('ie.IncomeExpenses.index' , ['list'=>$this->getFinancialSituationeModel($r)]);
        }

        $originalName = $excel->getClientOriginalName();
        $path = "public/excel/".rand()."-".$originalName;
        Storage::disk('local')->put($path, file_get_contents($excel));
        $ImportId = ImportExcelModel::insertGetId(['file'=>$originalName, 'path'=>$path , 'created_at'=>now()]);
        $excel = Storage::path($path);
        $data = Excel::toArray(new ExcelImport, $excel);
        $FinancialSituatione = new FinancialSituationeController();
        if ($data[0]){
            $response =  $FinancialSituatione->LoadExcel($data[0], $ImportId);

            if ($response['status'] == 'error'){
                return view('ie.IncomeExpenses.index' , ['error'=>true , 'msg'=>$response['msg']]);
            }else{

                return view('ie.IncomeExpenses.index' , ['totalImport'=>$response['totalImport'] , 'lastImport'=>$ImportId, 'list'=>$this->getFinancialSituationeModel($r)]);
            }
        }
    }


}
