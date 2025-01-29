<div class="contauner">
    <div class="form-group">
            <table class="table">
                <tr>
                    <td>EQUIPOS Y HERRAMIENTAS</td>
                    <td>: <b>{{$info->eqheDesc}}</b></td>
                </tr>
                <tr>
                    <td>CANTIDAD</td>
                    <td><b><input class="on tc form-control" id="cantidad" value="{{$info->eqheCantidad}}" /></b></td>
                </tr>
                <tr>
                    <td>DIAS/HORAS A UTILIZAR</td>
                    <td><b><input class="on tc form-control" id="dias" value="{{$info->eqheNum}}" /></b></td>
                </tr>

                <tr>
                    <td>TARIFA/DÍA/HORA</td>
                    <td><b>@currency($info->eqheValor)</b></td>
                </tr>
                <tr>
                    <td>VALOR PARCIAL</td>
                    <td><b>@currency($info->eqheValPat)</b></td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center" ><button  onclick="update()" class="btn btn-primary">Guardar</button></td>
                </tr>
                

            </table>
             
    </div>
</div> 

<script>
    fn.applyPlugins();

    update = function(){

           var data = {
                            acttab  : {{$acttab}},
                            tipo  : {{$tipo}},
                            pptoId  : {{$pptoId}},
                            idupdate  : {{$id}},
                            tipoServ  : '{{$info->eqheModo}}',
                            equipo : {{$info->eqheCodigo}},
                            cantidad  : $('#cantidad').val(),
                            dayhour  : $('#dias').val(),
                      }

            fn.ajax({
                        beforeSend : function(){
                            fn.wait('Por favor espere');
                        },
                        data : data,
                        method: 'POST',
                        dataType : 'html',
                        url  : '{{route("contratos.ajax", ["opc"=>"updateEquipos"])}}',
                        success : function(rs){
                             location.href =  "{{route('contratos.cotizaciones.prestec',['acttab'=>$acttab, 'id'=>$parentId])}}"  
                        },
                        complete : function(){
                            fn.closeWait();
                        }
            })

    }


</script>