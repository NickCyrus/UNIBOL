<div class="contauner">
    <div class="form-group">
            <table class="table">
                <tr>
                    <td>MANO DE OBRA</td>
                    <td>: <b>{{$info->mdoDesc}}</b></td>
                </tr>
                <tr>
                    <td>CANTIDAD</td>
                    <td><b><input class="on tc form-control" id="cantidad" value="{{$info->mdoCant}}" /></b></td>
                </tr>
                <tr>
                    <td>DIAS A LABORAR</td>
                    <td><b><input class="on tc form-control" id="dias" value="{{$info->mdoDias}}" /></b></td>
                </tr>

                <tr>
                    <td>SALARIOS</td>
                    <td><b>@currency($info->mdoSalario)</b></td>
                </tr>
                <tr>
                    <td>PRESTACIONES SOCIALES</td>
                    <td><b>@currency($info->mdoPreSoc)</b></td>
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

           var data = {
                            acttab  : {{$acttab}},
                            tipo  : {{$tipo}},
                            pptoId  : {{$pptoId}},
                            idupdate  : {{$id}},
                            salary : {{$info->mdoCod}},
                            cantidad  : $('#cantidad').val(),
                            dias  : $('#dias').val(),
           }

            fn.ajax({
                        beforeSend : function(){
                            fn.wait('Por favor espere');
                        },
                        data : data,
                        method: 'POST', 
                        dataType : 'html',
                        url  : '{{route("contratos.ajax", ["opc"=>"updateSalarios"])}}',
                        success : function(rs){
                                location.href =  "{{route('contratos.cotizaciones.prestec',['acttab'=>$acttab, 'id'=>$parentId])}}"  
                        },
                        complete : function(){
                            fn.closeWait();
                        }
            })

    }


</script>