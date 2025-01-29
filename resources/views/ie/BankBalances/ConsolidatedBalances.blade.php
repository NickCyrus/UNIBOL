@php
    $slug = getCurrentRouteGroup();
@endphp
@extends('app')
 
@section('content')
 
<div class="card">
    <div class="card-header row">
        <div class="col">
            <h4 class="fw-bold p-0 mb-0 "> Saldos Consolidados  </h4>
            <h6 class="mt-3">
                @if ($fecha_start && $fecha_end)
                    Consulta entre fechas <b>{{date_complete($fecha_start)}}</b> / <b>{{date_complete($fecha_end)}}</b>
                @elseif($fecha_start && !$fecha_end)
                    <b>{{toDayName($fecha_start)}}</b>, {{date_complete($fecha_start)}}</h6>
                @elseif(!$fecha_start && $fecha_end)
                    <b>{{toDayName($fecha_end)}}</b>, {{date_complete($fecha_end)}}</h6>
                @else
                    <b>{{toDayName($fecha)}}</b>, {{date_complete($fecha)}}</h6>
                @endif
        </div>
        <div class="col"> 
            <div class="row">
                 
                    <form  action="" method="POST">
                        @csrf
                                <div class="row">
                                    <div class="col-md-6 row">
                                        <div class="form-group col-md-6">
                                                <label>Fecha Inicial</label>
                                                <input class="form-control" name="fecha_start" value="{{old('fecha_start', $fecha_start ?? '')}}" type="date" id="filter-by-date" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Fecha Final</label>
                                            <input class="form-control" name="fecha_end" value="{{old('fecha_end', $fecha_end ?? '')}}" type="date" id="filter-by-date" />
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
                                    <div class="col-md-1">
                                        <div class="form-group" style="padding-top: 25px;">
                                                <button class="btn btn-sm btn-primary" onclick="$('#btn_excel').val('')">Filtrar</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group" style="padding-top: 25px;">
                                                <button name="btn_excel" id="btn_excel" onclick="this.value = 1" class="btn btn-sm btn-success">Descargar Excel</button>
                                        </div>
                                    </div>
                                </div>
                    </form>  
            </div>
        </div> 
        
        
    </div>
</div>

<div class="card mt-3">
    <div class="card-body">
        <div class="table-responsive">
            @include('ie.BankBalances.ConsolidatedBalancesTable')
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script type="text/javascript">
        function setFilter(){
                var  link = '';
                if ($('#filter-by-date').val()){
                    link = '/'+$('#filter-by-date').val();
                }

                if ($('#filter-by-company').val()){
                    link = '/companie/'+$('#filter-by-company').val();
                    if ($('#filter-by-date').val()){
                        link += '/'+$('#filter-by-date').val();
                    }
                }

                location.href = '{{route('saldo-consolidados')}}'+link;

        }
    </script>
@endpush