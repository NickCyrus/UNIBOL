<div class="mt-3">
    <button class="btn btn-success event-plus mb-3" onclick="openVarios({{$tipo}} , {{$acttab}} , {{$servicio}})"> <span class="tf-icons bx bx-plus"></span> {{$label}}</button>
</div>
 
<div class="table-responsive">
    <table class="table table-inner">
            <thead>
                <tr>
                    <th>CÓDIGO</th>
                    <th>{{$label}}</th>
                    <th class="text-center">UNIDAD</th>
                    <th class="text-center">CANTIDAD</th>
                    <th class="text-center">VALOR UNITARIO</th>
                    <th class="text-center">VALOR PARCIAL</th>
                    <th style="width: 5%;">ACCIÓN</th>
                </tr>
            </thead>
            <tbody>
                
                <tbody> 
                    @php $total = 0; @endphp
                    @foreach ($pptotec->getVarios($tipo , $servicio) as $item)
                        @php $total += ($item->varValor * $item->varCantidad) @endphp 
                        <tr>
                            <td>{{$item->varCodigo}}</td>
                            <td>{{$item->varDesc}}</td>
                            <td class="text-center">{{$item->getMeasure()}}</td>
                            <td class="text-center">{{$item->varCantidad}}</td>                      
                            <td class="tr">@currency($item->varValor)</td>
                            <td class="tr">@currency($item->varValor * $item->varCantidad)</td>
                            <td>
                                <div class="btn-group">
                                    <button title="Editar" onclick="editVariable{{$tipo}}{{$servicio}}({{$item->varId}})" class="btn btn-sm btn-success"><i class="bx bx-pencil"></i></button>
                                    <a class="btn hand confirm btn-sm btn-danger" data-q="¿Desea eliminar este item?" href="{{route('contratos.cotizaciones.prestec.delvar',
                                    ['id'=>$parentId, 'acttab'=> $acttab , 'iditem'=>$item->varId])}}"><i class="bx bx-trash me-1"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4"></td>
                        <td class="tr"><b>SUBTOTAL<b></td>
                        <td class="tr"><b>@currency($total)<b></td>
                        <td class="tr"></td>
                    </tr>
                </tfoot>
                
            </tbody>
    </table>
</div>


<script>
    
    editVariable{{$tipo}}{{$servicio}} = function(id){

             fn.dialog({
                                url : '{{route("contratos.ajax", ["opc"=>"editVarios"])}}',
                                type : 'post',
                                tipo : {{$tipo}},
                                servicio : {{$servicio}},
                                id   : id,
                                parentId : {{$parentId}},
                                acttab : {{$acttab}},
                                ppto : {{$pptotec->pptoId}},
                                class: 'col-md-5',
             });
 
    }

</script>