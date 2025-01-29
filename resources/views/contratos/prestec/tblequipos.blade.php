<div class="mt-3">
    <button class="btn btn-success event-plus mb-3" onclick="openEquipos({{$tipo}} , {{$acttab}})"> <span class="tf-icons bx bx-plus"></span> EQUIPOS Y HERRAMIENTAS</button>
</div>
<div class="table-responsive">
    <table class="table table-inner">
            <thead>
                <tr>
                    <th>CÓDIGO</th>
                    <th>EQUIPOS Y HERRAMIENTAS</th>
                    <th class="text-center">CANTIDAD</th>
                    <th class="text-center">DIAS/HORAS A UTILIZAR</th>
                    <th class="text-center">UNIDAD</th>
                    <th class="tr">TARIFA/DÍA/HORA</th>
                    <th class="tr">VALOR PARCIAL</th>
                    <th style="width: 5%;">ACCIÓN</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach ($pptotec->getEquiposHerramientas($tipo) as $item)
                    @php $total += $item->eqheValPat @endphp 
                    <tr>
                        <td>{{$item->eqheCodigo}}</td>
                        <td>{{$item->eqheDesc}}</td>
                        <td class="text-center">{{$item->eqheCantidad}}</td>
                        <td class="text-center">{{$item->eqheNum}}</td>
                        <td class="text-center">{{$item->getMeasure()}}</td>
                        <td class="tr">@currency($item->eqheValor)</td>
                        <td class="tr">@currency($item->eqheValPat)</td>
                        <td>
                            <div class="btn-group">
                                <button title="Editar" onclick="editEqHe{{$tipo}}({{$item->eqheId}})" class="btn btn-sm btn-success"><i class="bx bx-pencil"></i></button>
                                <a class="btn hand confirm btn-sm btn-danger" data-q="¿Desea eliminar este item?" href="{{route('contratos.cotizaciones.prestec.deleqhe',
                                ['id'=>$parentId, 'acttab'=> $acttab , 'iditem'=>$item->eqheId])}}"><i class="bx bx-trash me-1"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5"></td>
                    <td class="tr"><b>SUBTOTAL<b></td>
                    <td class="tr"><b>@currency($total)<b></td>
                    <td class="tr"></td>
                </tr>
            </tfoot>
    </table>
</div>

<script>
    
    editEqHe{{$tipo}} = function(id){

             fn.dialog({
                                url : '{{route("contratos.ajax", ["opc"=>"editEquipos"])}}',
                                type : 'post',
                                tipo : {{$tipo}},
                                id   : id,
                                parentId : {{$parentId}},
                                acttab : {{$acttab}},
                                ppto : {{$pptotec->pptoId}},
                                class: 'col-md-5',
             });
 
    }

</script>