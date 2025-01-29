<?php

namespace App\Models\ie;
use App\Models\ie\functions;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * @property integer $id
 * @property string $name
 * @property float $account
 * @property string $date_opening
 * @property integer $status
 * @property integer $id_account_type
 * @property integer $state
 * @property string $created_at
 * @property string $update_at
 * @property integer $id_user
 */
class IeAccount extends functions
{
    /**
     * @var array
     */
    // protected $fillable = ['name', 'account', 'date_opening', 'status', 'id_account_type', 'state', 'created_at', 'update_at', 'id_user'];
    protected $guarded = ['id'];


    public function getTipoAttribute(){
        return $this->hasOne(IeAccountType::class,'id','id_account_type')->first()->name ?? '';
    }

    public function getEstadoCuentaAttribute(){
        return $this->hasOne(IeAccountStatus::class,'id','status')->first()->name ?? '';
    }

    public function getBankAttribute(){
        return $this->hasOne(IeCompanyBankAccount::class,'id_account')->first()->codebank ?? '';
    }
 

    public function getIdBankAttribute(){
        return $this->hasOne(IeCompanyBankAccount::class,'id_account')->first()->id_bank ?? '';
    }

    public function getCompaniaAttribute(){
        return $this->hasOne(IeCompanyBankAccount::class,'id_account')->first()->compania ?? '';
    }

    public function getIdCompanyAttribute(){
        return $this->hasOne(IeCompanyBankAccount::class,'id_account')->first()->id_company ?? '';
    }


    public function callEndSave(Request $req , $record = '' ){
        $this->setCompanyAndBank($req , $record );
   } 
   
   function setCompanyAndBank($req, $record){

        IeCompanyBankAccount::where('id_account', $record->id)->delete();
        if ($req->id_bank){
            IeCompanyBankAccount::insert(['id_account'=>$record->id , 'id_bank'=>$req->id_bank , 'id_company'=>$req->id_company , 'id_user'=>cuid()]);  
        }
   }


   function scopeByCompany(Builder $query, $id_company)
   {

        return $query->whereIn('id' , IeCompanyBankAccount::where('id_company', $id_company)->pluck('id_account'))->StatusActive([1])->get();

   }



   

    
   

}
