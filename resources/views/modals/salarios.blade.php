@php $tokenEvent = uniqid(); @endphp
<div class="container my-3">
    <table class="table table-striped dn-table dt-responsive">
        <thead>
        <tr>
            <th style="width:10px">CÓDIGO</th>
            <th>MANO DE OBRA</th>
            <th align="center">CANTIDAD</th>
            <th>SALARIO BASE</th>
            <th>PRESTACIONES</th>
            <th align="center">DIAS A LABORAR</th>
            <th>Acción</th>
        </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @forelse($rows  as $row)
                @php $token = uniqid(); @endphp
        <tr>
            <td>{{$row->id}}</td>
            <td><strong>{{$row->name}}</strong></td>
            <td align="center"><input class="form-control tc on" id="cantidad{{$token}}" style="width: 50%" /></td>
            <td>@currency($row->value)</td>
            <td>@currency( ($row->value*0.439) )</td>
            <td align="center"><input class="form-control tc on" id="dias{{$token}}" style="width: 50%" /></td>
            <td><button class="btn btn-success btn-xs" onclick="check{{$tokenEvent}}('{{$token}}', {{$row->id}})"> <i class="tf-icons bx bx-plus"></i> Agregar </button> </td>
        </tr>
        @empty
            <tr><td colspan="6"> Sin registros</td></tr>
        @endforelse
        </tbody>

    </table>
</div>

<script> 
       reloadDataTable();

       function check{{$tokenEvent}}(token , id){
            
            if (!$('#cantidad'+token).val()){
                 $('#cantidad'+token).focus();
                 return false;
            }

            if (!$('#dias'+token).val()){
                 $('#dias'+token).focus();
                 return false;
            }
            
            fn.ajax({
                        url : "{{route('contratos.ajax', ['opc'=>'addSalarie'])}}",
                        data : { tipo: {{$tipo}}  , pptoId :  {{$pptoId}} , salary : id , cantidad : $('#cantidad'+token).val() , dias : $('#dias'+token).val() , 'id' : {{$id}} },
                        method : 'POST',
                        dataType : 'html',
                        success : function(){
                             fn.closeModal(); 
                             location.href = "{{route('contratos.cotizaciones.prestec' , ['id'=>$id,'acttab'=>$acttab ])}}";
                        }
                    })

            

       }
</script>