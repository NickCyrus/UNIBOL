@php $tokenEvent = uniqid(); @endphp
<div class="container my-3">
    <table class="table table-striped dn-table dt-responsive">
        <thead>
        <tr>
            <th style="width:10px">CÓDIGO</th>
            <th>IMPUESTO</th>
            <th align="center">CANTIDAD</th>
            <th align="center">VALOR UNITARIO</th>  
            <th>ACCION</th>
        </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @forelse($rows  as $row)
                @php $token = uniqid(); @endphp
        <tr>
            <td>{{$row->id}}</td>
            <td><strong>{{$row->name}}</strong></td>
            <td align="center"><input class="form-control tc on" id="cantidad{{$token}}" style="width: 50%" /></td>
            <td align="center"><input class="form-control tc on" id="valuni{{$token}}" style="width: 50%" /></td>
            <td class="tr">
                <button class="btn btn-success btn-xs" onclick="check{{$tokenEvent}}('{{$token}}', {{$row->id}} , 'd')">  
                    <i class="tf-icons bx bx-plus"></i> Agregar
                </button>    
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

       function check{{$tokenEvent}}(token , id , tipoServ){
            
            if (!$('#cantidad'+token).val()){
                 $('#cantidad'+token).focus();
                 return false;
            } 

            if (!$('#valuni'+token).val()){
                 $('#valuni'+token).focus();
                 return false;
            } 
 
            fn.ajax({
                        url : "{{route('contratos.ajax', ['opc'=>'addVarios'])}}",
                        data : { tipo: {{$tipo}}  , 
                                 pptoId :  {{$pptoId}} , 
                                 iditem : id , 
                                 servicio : {{$servicio}},
                                 cantidad : $('#cantidad'+token).val() , 
                                 valuni : $('#valuni'+token).val() , 
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