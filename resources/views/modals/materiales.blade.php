@php $tokenEvent = uniqid(); @endphp
<div class="container my-3">
    <table class="table table-striped dn-table dt-responsive">
        <thead>
        <tr>
            <th style="width:10px">CÓDIGO</th>
            <th>DESCRIPCIÓN</th>
            <th>UNIDAD</th>
            <th align="center">CANTIDAD</th>
            <th>VALOR</th>
            <th>ACCION</th>
        </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @forelse($rows  as $row)
                @php $token = uniqid(); @endphp
        <tr>
            <td>{{$row->code}}</td>
            <td><strong>{{$row->description}}</strong></td>
            <td align="center">{{$row->getMeasure()}}</td>
            <td align="center"><input class="form-control tc on" id="cantidad{{$token}}" style="width: 50%" /></td>
            <td> @currency($row->value)</td>
            <td class="tr">
                <button class="btn btn-success btn-xs" onclick="check{{$tokenEvent}}('{{$token}}', {{$row->id}})"> <i class="tf-icons bx bx-plus"></i> Agregar </button> 
            </td>
            
        </tr>
        @empty
            <tr><td colspan="6"> Sin registros</td></tr>
        @endforelse
        </tbody>

    </table>
</div>

<script> 
       
       reloadDataTable();

       function check{{$tokenEvent}}(token , id ){
            
            if (!$('#cantidad'+token).val()){
                 $('#cantidad'+token).focus();
                 return false;
            } 

          
            
            fn.ajax({
                        url : "{{route('contratos.ajax', ['opc'=>'addVarios'])}}",
                        data : { tipo: {{$tipo}}  , 
                                 pptoId :  {{$pptoId}} , 
                                 iditem : id , 
                                 servicio : {{$servicio}},
                                 cantidad : $('#cantidad'+token).val() , 
                                 'id' : {{$id}} 
                               },
                        method : 'POST',
                        dataType : 'html',
                        success : function(){
                             fn.closeModal(); 
                             location.href = "{{route('contratos.cotizaciones.prestec' , ['id'=>$id,'acttab'=>$acttab ])}}";
                        }
                    })

            

       }
</script>