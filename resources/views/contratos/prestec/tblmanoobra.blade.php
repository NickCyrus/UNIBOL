<div>
    <button class="btn btn-success event-plus mb-3" onclick="openSalarios({{$tipo}} , {{$acttab}})"> <span class="tf-icons bx bx-plus"></span> MANO DE OBRA</button>
</div>
<div class="table-responsive">
    <table class="table table-inner">
            <thead>
                <tr>
                    <th>CÓDIGO</th>
                    <th>MANO DE OBRA</th>
                    <th class="text-center">CANTIDAD</th>
                    <th class="text-center">SALARIOS</th>
                    <th class="text-center">PRESTACIONES SOCIALES</th>
                    <th class="text-center">DIAS A LABORAR</th>
                    <th class="tr">SALARIO TOTAL</th>
                    <th class="tr">SALARIO TOTAL</th>
                    <th style="width: 5%;">ACCIÓN</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach ($pptotec->getManoObra($tipo) as $item)
                    @php $total += $item->mdoSalPat @endphp 
               
                <tr> 
                    <td>{{$item->mdoCod}}</td>
                    <td>{{$item->mdoDesc}}</td>
                    <td class="text-center">{{$item->mdoCant}}</td>
                    <td class="text-center">@currency($item->mdoSalario)</td>
                    <td class="text-center">@currency($item->mdoPreSoc)</td>
                    <td class="text-center">{{$item->mdoDias}}</td>
                    <td class="tr">@currency($item->mdoSalTot)</td>
                    <td class="tr">@currency($item->mdoSalPat)</td>
                    <td>
                        <div class="btn-group">
                            <button title="Editar" onclick="editmdo{{$tipo}}({{$item->mdoId}})" class="btn btn-sm btn-success"><i class="bx bx-pencil"></i></button>
                            <a class="btn hand confirm btn-sm btn-danger" data-q="¿Desea eliminar este item?" href="{{route('contratos.cotizaciones.prestec.delmdo',
                            ['id'=>$parentId, 'acttab'=> $acttab , 'iditem'=>$item->mdoId])}}"><i class="bx bx-trash me-1"></i></a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6"></td>
                    <td class="tr"><b>SUBTOTAL<b></td>
                    <td class="tr"><b>@currency($total)<b></td>
                    <td class="tr"></td>
                </tr>
            </tfoot>
    </table>
</div>

<script>
    
    editmdo{{$tipo}} = function(id){

             fn.dialog({
                                url : '{{route("contratos.ajax", ["opc"=>"editSalarios"])}}',
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
