@php
    $slug = getCurrentRouteGroup();
@endphp
@extends('app')
 
@section('content')
 

<div class="card mb-3">
    <form  action="" method="POST">
        @csrf
        <div class="card-header row">
            <div class="col">
                <h4 class="fw-bold p-0 mb-0 "> Reporte de Saldos Consolidados  </h4>
                <h6 class="mt-3"><b>{{toDayName($fecha)}}</b>, {{date_complete($fecha)}}</h6>
            </div>
            <div class="col"> 
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                                <label>Filtrar por fecha</label>
                                <input class="form-control" name="fecha" value="{{$fecha}}" type="date" id="filter-by-date" />
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Filtrar por Compañia</label>
                            <select class="form-control" name="id_company"  id="filter-by-company">
                                    <option selected> </option>
                                @foreach($ConsolidatedBalancesCompanies as $cia)
                                    <option @if ($cia->id == $company) selected @endif value="{{$cia->id}}">{{$cia->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group" style="padding-top: 25px;">
                                <button class="btn btn-sm btn-primary">Filtrar</button>
                        </div>
                    </div>
            
                </div>
            </div> 
        </div>
    </form>  
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



<div class=" position-relative  my-3 ">
        <div class="position-absolute top-0 end-0 d-inline-block">
            <form action="{{route('reporte-de-saldos.pdf')}}" method="post" target="_blank">
                @csrf
                <input type="hidden" name="fecha" value="{{$fecha}}" />
                <input type="hidden" name="id_company" value="{{$company}}" />
                <button  class="btn bg-first-dark-light btn-icon-left rounded bg-white px-5 py-2 m-2">
                   <i class='bx bx-download'></i>  EXPORTAR PDF 
                </button> 
            </form>
        </div>
    

        <div class="col-10">
            <div class="row">
                 @include('ie.BankBalances.part.card-saldo',['label'=>'Saldo disponible en bancos', 'valor'=> $totales['AvailableBalance']])
                 @include('ie.BankBalances.part.card-saldo',['label'=>'Novedades y/o ajustes', 'valor'=>$totales['NewsAdjustments']])   
                 @include('ie.BankBalances.part.card-saldo',['label'=>'Cupo de sobregiro aprobado', 'valor'=>$totales['ApprovedOverdraft']])   
                 @include('ie.BankBalances.part.card-saldo',['label'=>'Cupo de sobregiro disponible', 'valor'=>$totales['OverdraftUsed']])    
        </div>
 
    </div>
</div>


@php $i = 1; @endphp

@foreach($companies as $company)
    <div class="card mb-3" style="border-left: 3px solid @if ($company->color) {{$company->color}} @else #FFF @endif; border-radius: 5px;">
        <div class="card-body">
            @include('ie.BankBalances.part.content-tab' , ['cabecera'=>true , 'preview'=>true , 'fecha'=>$fecha] )
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
 
@push('scripts')
    <script type="text/javascript">
    
    </script>
@endpush