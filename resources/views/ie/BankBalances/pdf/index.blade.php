<style>
    .col-50{
        display: 50%;
        float: left;
    }
</style>

<div class="col-50">
        <div class="">SALDOS</div>
        <div class="">SALDOS</div>
</div>
<div class="col-50">
    <img src="{{imageToPdf('assets/img/logo-solare-slogan.png')}}" />
 </div>

<div class="row mx-1 my-2">
    <div class="col-12 col-lg-6  overflow-hidden rounded-3">
        <div class="row">
                <div class="col-6 col-md-7 p-2 bg-first align-items-center d-flex justify-content-center fs-4">
                    Saldos Bancarios
                </div>
                <div class="col-6 col-md-5 px-3 py-2 align-items-center d-flex justify-content-center fs-6 bg-white">
                    Saldos diarios de las cuentas bancarias
                </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-lg-6  ">
        <div class="row">
            <div class="col-6">
                <div class="p-2 rounded-3 bg-white align-items-center d-flex justify-content-center fs-5">
                    <b>{{toDayName($fecha)}}</b>, {{date_complete($fecha)}}
                </div>
            </div>
            <div class="col-6">
                <div class="px-3 py-2  rounded-3 align-items-center d-flex justify-content-center fs-5 bg-first-light row">
                    <div class="col fs-6">
                    Saldo neto en bancos
                    </div>
                    <div class="col d-flex fw-bold ">
                         <div class="col">$</div>
                         <div>@number($totales['NetBalanceInBanks'])</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>