@php
    $slug = getCurrentRouteGroup();
@endphp
@extends('app-pdf')
 
@section('content')

<style>
 
 
.tabs-balances .tab.active{
    background: #FFF;
}


.table-balances{
    width: 100%;
}

.cell-logo{
    min-width:75px;
}

.cell-account{
    min-width:180px;
}
.cell-number{
    
}

.cell-number-small{
    

}

.table-balances thead {
    position: sticky;
    top: 0px;
}

.text-success{
    color: #44e48c;
    text-align: center;
}

.table-balances thead tr td {
    padding: 10px;
    background-color: #EAEAEA;
    color: #324C68;
    font-size: 10px;
    text-align: center;
}

.table-balances thead tr td:first-child{
    border-top-left-radius: 8px;
    border-bottom-left-radius: 8px;
}

.table-balances thead tr td:last-child{
    border-top-right-radius: 8px;
    border-bottom-right-radius: 8px;
}

 

.table-balances tbody tr:first-child td:first-child div{
    border-top-left-radius: 8px;
}

 
.table-balances tbody tr:last-child td:first-child div{
    border-bottom-left-radius: 8px;
}

.table-balances tbody,
.table-balances tfoot
{ 
    border-top: 8px solid #FFF;
}

.table-balances tbody tr td div,
.table-balances tfoot tr td div
{
    height: 25px;
    border: 1px solid #e7eef1;
    width: 100%;
    padding: 5px 0px 5px 0px;
    vertical-align: middle; 
}   

.table-balances tfoot tr td div
{
    height: auto !important;
}
.table-balances tbody tr td div div,
.table-balances tfoot tr td div div
{
    border: none;
}

.border-right{
    border-right: 1px solid #e7eef1 !important;
}

.border-right-last{
    border-bottom-right-radius: 8px !important;
    border-top-right-radius: 8px !important;
}

.bg-table-thead{
    background: #EAEAEA;
}

.border-left-first{
    border-bottom-left-radius: 8px !important;
    border-top-left-radius: 8px !important;
}


.table-balances tbody tr td:last-child div{
    border-top-right-radius: 8px;
    border-right: 1px solid #e7eef1;
}

.table-balances tbody tr td:last-child div div{
    border-top-right-radius: 8px;
    border-right: none;
}

.table-balances tbody tr td:last-child div{
    border-bottom-right-radius: 8px;
}

 

.table-balances tbody tr td.cell-logo div{
   width: 100%;
}

.content-tab{
    display: none; 
}

.content-tab.active{
        display: block;
}

.currency{
    text-align: right;
}

.box-currency{
    text-align: right;
    padding-right: 10px !important;
}

.box-center{
    text-align: center;
}

.t-center{ text-align: center; }
.t-left{ text-align: left; }
.t-right{ text-align: right; }

.text-sm thead tr th{
    font-size: 10px;
}

.row{
    display: flex
}
 
.page-break {  page-break-after: always; }
.nobreak { page-break-inside: avoid; }
        
body{
    font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    font-size: 10px;
}

.header .t1{
    color : #324C68;
    font-size: 20px;
}

.header .t2{
    color : #1F6CA8;
    font-weight: bold;
    font-size: 32px;
    margin-top: -5px;
}

.clear{
    clear: both;
}

.f{float: left;}

.bg-light{
    background:#F0F8FE;
    color:#1F6CA8;
}

.color-dark,
.color-first{ color : #324C68; }


.box-saldo-neto{
    padding: 5px 15px; 
    border-radius:5px; 
    min-width: 150px;
    font-size: 20px;
}

.box-saldo-neto span{
    font-size: 14px;
    position: relative;
}

.box-fecha-header{
    font-size: 15px;
}

.border * {
    border: 1px solid #000;
}
</style>

 
    <table style="width: 100%">
        <tr>
            <td>
                <div class="header">
                    <div class="t1">SALDOS</div>
                    <div class="t2">BANCARIOS</div>
                </div>
            </td>
            <td class="t-right">
                <div style="padding: 5px 0px;">
                    <img src="{{imageToPdf('assets/img/logo-solare-slogan.png')}}"  />
                </div>
            </td>
        </tr>
    </table>
    
    <table>
        <tr>
            <td class="box-fecha-header color-dark" style="padding-right: 20px;">
                <b>{{toDayName($fecha)}}</b>, {{date_complete($fecha)}}
            </td>
            <td>
                <div class="box-saldo-neto bg-light">
                    <span>Saldo neto en bancos </span>
                    @currency($totales['NetBalanceInBanks'])
                </div>
            </td>
        </tr>
    </table>
    <table style="margin: 10px 0px 20px 0px;" class="color-dark">
        <tr>
            <td style="padding-right: 30px;">@include('ie.BankBalances.part.card-saldo-pdf',['label'=>'Saldo disponible en bancos', 'valor'=> $totales['AvailableBalance']])</td>
            <td style="padding-right: 30px;">@include('ie.BankBalances.part.card-saldo-pdf',['label'=>'Novedades y/o ajustes', 'valor'=>$totales['NewsAdjustments']])</td>   
            <td style="padding-right: 30px;">@include('ie.BankBalances.part.card-saldo-pdf',['label'=>'Cupo de sobregiro aprobado', 'valor'=>$totales['ApprovedOverdraft']])</td>   
            <td style="padding-right: 30px;">@include('ie.BankBalances.part.card-saldo-pdf',['label'=>'Cupo de sobregiro disponible', 'valor'=>$totales['OverdraftUsed']])</td>
        </tr> 
    </table> 
   
@php $i = 1; @endphp
 
    @foreach($companies as $company)
        <div class="card mb-3 nobreak" style="margin-bottom: 30px;">
            <div class="card-body">
                @include('ie.BankBalances.part.content-tab-pdf' , ['cabecera'=>true , 'preview'=>true , 'fecha'=>$fecha] )
            </div>
        </div>
    @endforeach
    @if (!$companies->count())
        <div class="card">
            <div class="card-body">
                    Lo sentimos no se reportaron saldos para esta fecha  <b>{{toDayName()}}, {{date_complete()}}</b>
            </div>
        </div>
    @endif
@endsection 