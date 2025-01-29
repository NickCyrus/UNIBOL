@php
    $slug        = getCurrentRouteGroup();
     
@endphp
@extends('app')
 
@section('content')
 
<div class="card">
    <div class="card-header row">
        <div class="col">
            <h4 class="fw-bold p-0 mb-0 "> Movimientos Ingresos/Egresos </h4>
        </div>
        @canNew
            <div class="col">
                <!--
                <a class="btn btn-sm btn-success pull-right  event-plus mx-1" href="{{route("{$slug}.new")}}">
                    <span class="tf-icons bx bx-plus"></span>&nbsp; Agregar movimiento
                </a>
                !--> 
                <form class="pull-right" action="{{route('registro-ingresos-egresos.excel')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="load-excel">
                            <input class="d-none" type="file" name="excel" onchange="this.form.submit()" required accept="application/vnd.ms-excel" id="load-excel" />
                            <span type="submit" class="btn btn-sm btn-success">Importar datos</span>
                        </label>
                </form>

            </div>
        @endcanNew
        
    </div>
</div>

<div class="card mt-3">
    <div class="card-body">
        @if(isset($error))
            <div class="alert alert-danger">{{$msg}}</div>
        @else
            @if(isset($totalImport))
                <div class="alert alert-success">Se ha importando <b>{{$totalImport}}</b> registros correctamente </div>
            @endif
        @endif

        @include('ie.IncomeExpenses.list2' , ['list'=>$list])
    </div>
</div>

@endsection