@php
    $slug = 'modules';
@endphp
@extends('app')
@section('content')
<div class="card">
    <h5 class="card-header">
        @if ($permission->anew)
            <button type="button" class="btn btn-success pull-right  event-plus" onclick="add()">
                <span class="tf-icons bx bx-plus"></span>&nbsp; Agregar
            </button>
        @endif
        Módulos
    </h5>
    <div class="p-3">

      <table class="table table-striped dn-table dt-responsive">
        <thead>
          <tr>
            <th>Orden</th>
            <th>Padre</th>
            <th>Modulo</th>
            <th>Icono</th>
            <th>Slug</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @forelse($modulos  as $modulo)
          <tr>
            <td>{{$modulo->orderapp}}</td>
            <td>{!!$modulo->parent_name!!}</td>
            <td><strong>{{$modulo->nameapp}}</strong></td>
            <td>
                <i class="tf-icons bx {{$modulo->iconapp ?? 'bx-menu' }}"></i>
            </td>
            <td><span class="badge bg-label-primary me-1">{{$modulo->urlapp}}</span></td>
            <td><span class="badge bg-transparent">{{state($modulo->state)}}</span></td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  @canEdit
                    <a class="dropdown-item hand" onclick="edit({{$modulo->id}})"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                  @endcanEdit
                  @canDel
                    <a class="dropdown-item hand confirm" data-q='¿Desea eliminar este modulo?' href="{{route("{$slug}.delete",['id'=>$modulo->id])}}"><i class="bx bx-trash me-1"></i> Delete</a>
                  @endcanDel
                </div>
              </div>
            </td>
          </tr>
          @empty
            <tr><td colspan="5">Sin registros</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
@endsection

@section('addFooter')

        <script>
                  @if ($permission->aedit)
                 add = function(){
                    fn.dialog({
                                url : baseApp+'/{{$slug}}/add',
                                type : 'post'
                              });
                 }
                 @endif
                 @if ($permission->aedit)
                 edit = function(id){
                    fn.dialog({
                                url : baseApp+'/{{$slug}}/'+id+'/edit',
                                type : 'post'
                              });
                 }
                 @endif
                 @if ($permission->adelete)
                 borrar = function(id){
                      fn.dialog({
                                  url : baseApp+'/{{$slug}}/'+id+'/delete',
                                  type : 'post'
                                });
                  }
                 @endif





        </script>

@endsection
