@php
    $slug = getCurrentRouteGroup();
    $IeCostCenter = callmod('ie\IeCostCenter');
    $rows = $IeCostCenter->whereNull('id_parent')->orderby('name')->get();
@endphp
@extends('app')
@section('content')
<div class="card">
    <div class="card-header">
        
        @canNew
            <a class="btn btn-success pull-right  event-plus mx-1" href="{{route("{$slug}.new")}}">
                <span class="tf-icons bx bx-plus"></span>&nbsp; Agregar
            </a>
        @endcanNew
        
        @includeIf("$viewPath.nav")

        <h4 class="fw-bold py-3 mb-0 "> {{$title}} </h4>
    </div>
    <div class="p-3">

      <table class="table table-striped dn-table dt-responsive">
        <thead>
          <tr>
            @if ($table['head'])
                @foreach($table['head'] as $name)
                    <th>{!!$name!!}</th>
                @endforeach
            @endif
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
           @include('ie.categorias-centro-de-costo.row')
        </tbody>
      </table>
    </div>
  </div>
@endsection

 