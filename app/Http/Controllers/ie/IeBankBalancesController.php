<?php

namespace App\Http\Controllers\ie;

use App\Http\Controllers\Controller;
use App\Models\ie\IeAccount;
use App\Models\ie\IeBalancesOrderCompanies;
use App\Models\ie\IeBankBalances;
use App\Models\ie\IeCompany;
use App\Models\ie\IeCompanyBankAccount;
use Illuminate\Http\Request;
use App\Exports\ExcelExportsView;
use Excel;

class IeBankBalancesController extends Controller
{
    //

    function index(){
            return view('ie.BankBalances.index' , ['companies'=>$this->getCompanies() , 'totales'=> IeBankBalances::TotalToday() ]);
    }

    function ReportBalance(Request $request){
        return view('ie.BankBalances.Report' , ['companies'=>$this->getCompaniesReport($request->id_company ,  $request->fecha) ,
                                                'ConsolidatedBalancesCompanies'=> IeCompany::Active()->orderby('name')->get() , 
                                                'totales'=> IeBankBalances::TotalToday($request->fecha) , 
                                                'fecha'=>$request->fecha , 
                                                'company'=>$request->id_company ]);
    }

    function ReportBalancePdf(Request $request){
        
       
        $pdf = app('dompdf.wrapper');
        $pdf->setOptions(['isRemoteEnabled' => true]);
        $pdf->setPaper('A4', 'landscape')->loadView('Reportpdf' , ['companies'=>$this->getCompaniesReport($request->id_company ,  $request->fecha) ,
        'ConsolidatedBalancesCompanies'=> IeCompany::Active()->orderby('name')->get() , 
        'totales'=> IeBankBalances::TotalToday($request->fecha) , 
        'fecha'=>$request->fecha , 
        'company'=>$request->id_company,
        'pdf'=>true ]);
       
        return $pdf->stream("SALDOS BANCARIOS ".$request->fecha.".pdf");
    }
    

    function filterByDate( $fecha = '' ){
        return $this->ConsolidatedBalances('' ,  $fecha );
    }

    function filterExcel(Request $req){

    }

    function filter(Request $req){
        return $this->ConsolidatedBalancesBetWeen($req);
    }

    function ConsolidatedBalancesBetWeen(Request $req){ 


        $Balances = IeBankBalances::query();
        
        

        if (isset($req->fecha_start) && isset($req->fecha_end)){
            if ($req->fecha_end < $req->fecha_start){
                $Balances->whereBetweenDate('created_at' , [$req->fecha_end , $req->fecha_start]);
            }else{
                $Balances->whereBetweenDate('created_at' , [$req->fecha_start , $req->fecha_end]);
            }
        }

        if (isset($req->fecha_start) && !isset($req->fecha_end)){
            $Balances->whereDate('created_at', $req->fecha_start);
        }

        if (!isset($req->fecha_start) && isset($req->fecha_end)){
            $Balances->whereDate('created_at', $req->fecha_end);
        }

        if (!isset($req->fecha_start) && !isset($req->fecha_end)){
            $Balances->whereDate('created_at', NOW());
        }

        if (isset($req->id_company)){
           $Balances->where('id_company',$req->id_company);
        }


        $data = ['ConsolidatedBalances'=> $Balances->get() , 
                 'ConsolidatedBalancesCompanies'=> IeCompany::Active()->orderby('name')->get() ,
                 'fecha_start'=>$req->fecha_start ?? '', 
                 'fecha_end'=>$req->fecha_end ?? '', 
                 'fecha'=>now(),
                 'company'=>$req->id_company ?? '' ];

        if ($req->btn_excel==1){
            $data['excel'] = true;
            $excel =  new ExcelExportsView('ie.BankBalances.ConsolidatedBalancesTable' , $data);                 
            return Excel::download( $excel , "Saldo consolidados.xlsx");
        }

        return view('ie.BankBalances.ConsolidatedBalances' , $data );

   }

    function ConsolidatedBalances($company = '' ,  $fecha = ''){

         return view('ie.BankBalances.ConsolidatedBalances' , ['ConsolidatedBalances'=> IeBankBalances::ConsolidatedBalances($fecha , $company ) , 
                                                               'ConsolidatedBalancesCompanies'=> IeCompany::Active()->orderby('name')->get() ,
                                                               'fecha'=>$fecha, 
                                                               'company'=>$company ]);

    }

    // Fix Bug Order By Users
    function getCompaniesReport($id_company='' , $fecha = ''){

        $IeBankBalances =  IeBankBalances::query();
        if ($id_company) $IeBankBalances->where('id_company',$id_company);
        if (!$fecha) $fecha =  now();   
        $IeBankBalances->Active();
        $IeBankBalances->whereDate('created_at',$fecha);       

        $companies = IeCompany::query();
         
        $companies->leftjoin('ie_balances_order_companies', function ($join) {
            $join->on('ie_companies.id', '=', 'ie_balances_order_companies.id_company')->where('ie_balances_order_companies.id_user', '=', cuid());
        });
        
        $companies->whereIn('ie_companies.id', $IeBankBalances->pluck('id_company')) ;
        $companies->select('ie_companies.*');
        $companies->orderby('name');

        return $companies->get();

    }

    function getCompanies($id_company = ''){

        $company = IeCompany::query();
        $company->active();

        if ($id_company){
           $company->where('id' , $id_company);
        } 

        $IeCompanyBankAccount = IeCompanyBankAccount::query();
        $IeCompanyBankAccount->whereIn('id_company' , $company->pluck('id'));
        $IeCompanyBankAccount->whereIn('id_account' , IeAccount::active()->pluck('id'));
        $IeCompanyBankAccount->Active();
         
        
        return IeCompany::Active()
               ->whereIn('ie_companies.id',  $IeCompanyBankAccount->pluck('id_company') )
               ->select('ie_companies.*')
               ->leftjoin('ie_balances_order_companies', function ($join) {
                              $join->on('ie_companies.id', '=', 'ie_balances_order_companies.id_company')->where('ie_balances_order_companies.id_user', '=', cuid());
                         })
               ->orderby('order')
               ->get();
     }

  

     function ajax(Request $request){

            switch($request->opc){
                case 'update-order-companies-show':
                    $i = 1;
                    IeBalancesOrderCompanies::where('id_user',cuid())->delete();
                    foreach($request->orden  as $item){
                        if ($item ) IeBalancesOrderCompanies::insert(['id_user'=>cuid() , 'id_company'=>$item , 'order'=>$i ]);
                        $i++;
                    }
                    
                    return success();
                break;
                case 'save-balance':
                    
                    if ($request->info){
                        foreach($request->info as $info){
                            $args = [
                                     'id_user'=>cuid(),
                                     'id_company'=>$info[0]['company'],
                                     'id_bank'=>$info[0]['bank'],
                                     'id_account'=>$info[0]['account'],
                                     'created_at'=>NOW(),
                                     'state'=>1
                                    ];
                            $i = 1;
                            foreach($info[0]['saldos'] as $saldo){
                                $args["saldo_{$i}"] = $saldo;
                                $i++;
                            }
                            
                            $check =  IeBankBalances::query();
                            $check->whereDate('created_at',NOW())
                            ->where('id_company', $info[0]['company'])
                            ->where('id_bank', $info[0]['bank'])
                            ->where('id_account', $info[0]['account']);

                            if ($check->first()){
                                $check->update($args);  
                            }else{
                                IeBankBalances::insert($args);
                            }
                            
                            
                            
                        }

                        return success();
                    }
                       

                break;
            }

     }
    
}
