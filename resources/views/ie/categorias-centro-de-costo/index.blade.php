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
      <h4 class="fw-bold py-3 mb-0 "> Centros de Costo </h4>
        @includeIf("$viewPath.nav")
    </div>
    <div class="p-3">
      <table class="table table-striped table-sm  dt-responsive" id="terceroTable">
        <thead>
          <tr> 
             
             <th>C.COSTO</th>
             <th>DESCRIPCION</th>
             <th>PADRE</th>
             <th>T/D</th>
             <th>NIVEL</th>
             <th>EMPRESA</th>
             <th>ESTADO</th>
             <th></th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
             
        </tbody>
      </table>
    </div>
  </div>
@endsection
@push('scripts')
<script type="text/javascript"> 

        $(document).ready(function(){
             
            $('#terceroTable').DataTable({
                processing: true,
                serverSide: true,
                language: {
                        url: '{{asset('assets/js/lang/es-ES.json')}}',
                },
                "pageLength": {{pagination()}},
                ajax: "{{route('categorias-centro-de-costo.list')}}",
                columnDefs: [
                    { className: 'dt-center', targets: [ 2,3,4 ] },
                ],
                columns: [
                   
                    { data: 'code' },
                    { data: 'name' },
                    { data: 'padre' , orderable: false  },
                    { data: 'tdcc'  , orderable: false },
                    { data: 'level'  , orderable: false },
                    { data: 'company' , orderable: false  },
                    { data: 'estado' , orderable: false },
                    { data: 'acciones' , orderable: false },
                ]
            });

        });
 
</script>
@endpush
 