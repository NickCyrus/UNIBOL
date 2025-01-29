<?php

namespace App\Models\ie;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IeBankBalances extends functions
{
    use HasFactory;

    static public function ConsolidatedBalances($fecha = '' , $company = ''){
        
        if (!$fecha) $fecha = now();
        $totales = IeBankBalances::query();
        $totales->whereDate('created_at', $fecha);
        if ($company) $totales->where('id_company',$company);
        return $totales->get();

    }   


    static public function TotalToday($fecha = ''){

            if (!$fecha) $fecha = now();

            $totales = IeBankBalances::query();
            $totales->whereDate('created_at', $fecha);
            $totales->Active();

            // Es un resumen, correspondiente a la sumatoria de todas las columnas "Disponible" + "Dinero en Canje/ACH" de los registros de cada compañía
           $AvailableBalance = $totales->selectRaw('SUM(saldo_1 + saldo_2) as AvailableBalance')->first()->AvailableBalance ?? 0;

           // Es un resumen, correspondiente a la sumatoria de todas las columnas "Capital embargado" + "Valores Provisionados" + "Cheques Postfechados" + "Transf./Cheques Pend. por Cobro" de los registros de cada compañía
           $NewsAdjustments  = $totales->selectRaw('SUM(saldo_3 + saldo_4 + saldo_5 + saldo_6) as NewsAdjustments')->first()->NewsAdjustments ?? 0;

           // Es un resumen, correspondiente a la sumatoria de todas las columnas "Sobregiro Aprobado" de los registros de cada compañía
           $ApprovedOverdraft  = $totales->selectRaw('SUM(saldo_7) as ApprovedOverdraft')->first()->ApprovedOverdraft ?? 0;

           // Es un resumen, correspondiente a la sumatoria de todas las columnas "Sobregiro aprobado" + "Sobregiro utilizado" de los registros de cada compañía
           $OverdraftUsed  = $totales->selectRaw('SUM(saldo_7 + saldo_8) as OverdraftUsed')->first()->OverdraftUsed ?? 0;
           
           // Saldos disponibles en bancos" - "Novedades y/o ajustes" - "Cupo de sobregiro aprobado" + "Cupo de sobregiro disponible
           $NetBalanceInBanks = ((($AvailableBalance - $NewsAdjustments) - $ApprovedOverdraft) + $OverdraftUsed);
           return [
                    'AvailableBalance'=>$AvailableBalance,
                    'NewsAdjustments'=>$NewsAdjustments,
                    'ApprovedOverdraft'=>$ApprovedOverdraft,
                    'OverdraftUsed'=>$OverdraftUsed,
                    'NetBalanceInBanks'=>$NetBalanceInBanks
                  ];   

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
 

    public function getBalanceTodayAttribute(){
        
        return IeBankBalances::whereDate('created_at', now())
            ->where('id_bank', $this->bank->id)
            ->where('id_account' , $this->account->id)
            ->where('id_company' , $this->company->id)
            ->Active()
            ->first();

    } 
}
