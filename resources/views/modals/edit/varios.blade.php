@php
    $TPOSERV = ['1'=>'MATERIALES E INSUMOS','2'=>'SUBCONTRATOS','3'=>'DIVERSOS','4'=>'IMPUESTOS'];
@endphp
<div class="contauner">
    <div class="form-group">
            <table class="table">
                <tr>
                    <td>{{$TPOSERV[$info->varTIpoSer]}}</td>
                    <td>: <b>{{$info->varDesc}}</b></td>
                </tr>
                <tr>
                    <td>CANTIDAD</td>
                    <td><b><input class="on tc form-control" id="cantidad" value="{{$info->varCantidad}}" /></b></td>
                </tr>
                @if ($info->varTIpoSer == 4)
                    <tr>
                        <td>VALOR</td>
                        <td><b><input class="on tc form-control" id="valor" value="{{$info->varValor}}" /></b></td>
                    </tr>
                @else
                <tr>
                    <td>VALOR</td>
                    <td><b>@currency($info->varValor)</b></td>
                </tr>
                @endif
                <tr>
                    <td>VALOR PARCIAL</td>
                    <td><b>@currency($info->varValPar)</b></td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center" ><button onclick="update()" class="btn btn-primary">Guardar</button></td>
                </tr>
                

            </table>
             
    </div>
</div> 

<script>
    fn.applyPlugins();

    update = function(){

           if (!$('#cantidad').val()) {
             $('#cantidad').focus();
             return false;
           }
           @if ($info->varTIpoSer == 4)
            if (!$('#valor').val()) {
                $('#valor').focus();
                return false;
            }
           @endif
           var data = {
                            acttab  : {{$acttab}},
                            tipo  : {{$tipo}},
                            pptoId  : {{$pptoId}},
                            servicio : {{$info->varTIpoSer}},
                            iditem   : {{$info->varCodigo}},
                            idupdate  : {{$id}},
                            @if ($info->varTIpoSer == 4) valor     : $('#valor').val(), @endif
                            cantidad  : $('#cantidad').val(),                            
           }

            fn.ajax({
                        beforeSend : function(){
                            fn.wait('Por favor espere');
                        },
                        data : data,
                        method: 'POST', 
                        dataType : 'html',
                        url  : '{{route("contratos.ajax", ["opc"=>"updateVarios"])}}',
                        success : function(rs){
                              location.href =  "{{route('contratos.cotizaciones.prestec',['acttab'=>$acttab, 'id'=>$parentId])}}"  
                        },
                        complete : function(){
                            fn.closeWait();
                        }
            })

    }


</script>