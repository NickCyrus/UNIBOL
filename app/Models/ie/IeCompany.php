<?php

namespace App\Models\ie;

use App\Models\ie\functions;

/**
 * @property integer $id
 * @property string $nit
 * @property string $name
 * @property integer $state
 * @property string $created_at
 * @property string $update_at
 * @property integer $id_user
 */
class IeCompany extends functions
{
    /**
     * @var array
     */
    
    public $filter_date = '';

    // protected $fillable = ['nit', 'name', 'state', 'created_at', 'update_at', 'id_user' , 'cellphone' , 'email' , 'address'];
    protected $guarded = [];

    function setFilterDate($fecha){
        $this->filter_date = $fecha;
    }

    public function getBanksAttribute(){
       
        $bank = IeBank::query();
        $bank->where('id_company', $this->id);

        

        if ($bank->count() > 1){
                return "({$bank->count()}) Bancos";
        }elseif ($bank->count() == 1){
                return $bank->first()->name;
        }

    }

    public function getAccountsListRel($fecha=''){
        
        if (!$fecha) $fecha = now();
       
        return IeCompanyBankAccount::where('id_company' , $this->id)
                ->whereIn('id_company' , IeBankBalances::whereDate('created_at',$fecha)->pluck('id_company'))
                ->whereIn('id_account' , IeBankBalances::whereDate('created_at',$fecha)->pluck('id_account'))
                ->Active()
                ->get();

    }

    public function getAccountsListRelAttribute(){

     

        return IeCompanyBankAccount::where('id_company' , $this->id)
                ->whereIn('id_company' , IeCompany::active()->pluck('id'))
                ->whereIn('id_account' , IeAccount::active()->pluck('id'))
                ->Active()
                ->get();
    }
    
    public function getTotales($fecha){
        return  IeBankBalances::Active()->whereDate('created_at', $fecha ?? now())
        ->where('id_company', $this->id)
        ->selectRaw("SUM(saldo_1) as tsaldo_1 , 
                     SUM(saldo_2) as tsaldo_2 ,
                     SUM(saldo_3) as tsaldo_3,
                     SUM(saldo_4) as tsaldo_4,
                     SUM(saldo_5) as tsaldo_5,
                     SUM(saldo_6) as tsaldo_6,
                     SUM(saldo_7) as tsaldo_7,
                     SUM(saldo_8) as tsaldo_8,
                     SUM(saldo_9) as tsaldo_9")
        ->first();
    }

    public function getBalanceTodayTotalAttribute(){

        return  IeBankBalances::Active()->whereDate('created_at', now())
             ->where('id_company', $this->id)
             ->selectRaw("SUM(saldo_1) as tsaldo_1 , 
                          SUM(saldo_2) as tsaldo_2 ,
                          SUM(saldo_3) as tsaldo_3,
                          SUM(saldo_4) as tsaldo_4,
                          SUM(saldo_5) as tsaldo_5,
                          SUM(saldo_6) as tsaldo_6,
                          SUM(saldo_7) as tsaldo_7,
                          SUM(saldo_8) as tsaldo_8,
                          SUM(saldo_9) as tsaldo_9")
             ->first();
 
     }


    public function getAccountsListAttribute(){
        return IeAccount::whereIn('id' , IeCompanyBankAccount::where('id_company' , $this->id)->Active()->pluck('id_account'))
        ->Active()
        ->get();
    }

    public function getAccountsAttribute(){
        $list = [];
        $rows = $this->accounts_list;

        if ($rows){
            foreach($rows as $row){
                $list[] = ($row->name) ? $row->name : $row->account;
            }
        }
        
        return implode(', ',$list);
        
    }

    


    

}
