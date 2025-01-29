@php
    $slug = getCurrentRouteGroup();
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

      <table class="table table-sm table-striped dn-table dt-responsive">
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
            @if ($rows->count())
                @forelse($rows  as $row)
                <tr>
                    @if ($table['body'])
                    @foreach($table['body'] as $key => $field)
                        <td>@include('dinamico.data', ['field'=>$field, 'key'=>$key])</td>
                    @endforeach
                    @endif

                    <td>
                        @includeIf("$viewPath.table.event",['slug'=>$slug])
                        @include('component.btn-table-event',['slug'=>$slug, 'view'=>'icon'])
                    </td>
                </tr>
                @empty
                    <tr><td colspan="@if($table['head']) {{count($table['head'])}} @endif">Sin registros</td></tr>
                @endforelse
              @endif
        </tbody>
      </table>
    </div>
  </div>
@endsection

 