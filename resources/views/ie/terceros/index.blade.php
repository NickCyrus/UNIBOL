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
        <h4 class="fw-bold py-3 mb-0 "> Terceros </h4>
    </div>
    <div class="p-3">
      <table class="table table-sm table-striped  dt-responsive" id="terceroTable">
        <thead>
          <tr> 
            
             <th>TIPO DE DOCUMENTO</th>
             <th>NUMERO</th>
             <th>NOMBRE</th>
             <th>CLASIFICACIÓN</th> 
             <th>EMAIL</th>
             <th>TELÉFONO</th>
             <th>DIRECCIÓN</th>
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
                ajax: "{{route('terceros.list')}}",
                columns: [
                    
                    { data: 'code' },
                    { data: 'nit' },
                    { data: 'name' },
                    { data: 'classification' },
                    { data: 'email' },
                    { data: 'cellphone' },
                    { data: 'address' },
                    { data: 'estado' , orderable: false },
                    { data: 'acciones' , orderable: false },
                ]
            });

        });
 
</script>
@endpush
 