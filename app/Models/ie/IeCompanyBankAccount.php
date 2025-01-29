<?php

namespace App\Models\ie;

use App\Models\ie\functions;

/**
 * @property integer $id
 * @property integer $id_company
 * @property integer $id_bank
 * @property integer $id_account
 * @property integer $state
 * @property string $created_at
 * @property string $update_at
 * @property integer $id_user
 */
class IeCompanyBankAccount extends functions
{
    /**
     * @var array
     */
    protected $guarded = []; 

    public function getCodebankAttribute(){
        return $this->hasOne(IeBank::class ,'id', 'id_bank')->first()->name;
    }

    public function getBankAttribute(){
        return $this->hasOne(IeBank::class ,'id', 'id_bank')->first();
    }

    public function getAccountAttribute(){
        return $this->hasOne(IeAccount::class ,'id', 'id_account')->first();
    }

    public function getCompanyAttribute(){
        return $this->hasOne(IeCompany::class ,'id', 'id_company')->first();
    }

    public function getCompaniaAttribute(){
        return $this->hasOne(IeCompany::class ,'id', 'id_company')->first()->name;
    }

    public function getBalanceToday($fecha){
        
        if (!$fecha) $fecha = now();

        return IeBankBalances::whereDate('created_at', $fecha )
            ->where('id_bank', $this->bank->id)
            ->where('id_account' , $this->account->id)
            ->where('id_company' , $this->company->id)
            ->Active()
            ->first();

    } 

    public function getBalanceTodayAttribute(){
        
        return IeBankBalances::whereDate('created_at', now())
            ->where('id_bank', $this->bank->id)
            ->where('id_account' , $this->account->id)
            ->where('id_company' , $this->company->id)
            ->Active()
            ->first();

    } 

    
    // Es un resumen, correspondiente a la sumatoria de todas las columnas "Disponible" + "Dinero en Canje/ACH" de los registros de cada compañía
    public function getAvailableBalanceAttribute(){

        return IeBankBalances::whereDate('created_at', now())
            ->selectRaw('SUM(saldo_1 + saldo_2) as AvailableBalance')
            ->Active()
            ->first()->AvailableBalance ?? 0;

    }


    
}
