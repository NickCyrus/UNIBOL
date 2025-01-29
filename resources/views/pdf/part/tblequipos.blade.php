<table class="tabla tabla_relacion tabla_td_padding">
    <thead>
       
        <tr>
            <th style="width: 50px" class="nbbottom tc ">CÓDIGO</th>
            <th style="width: 300px" class="">EQUIPOS Y HERRAMIENTAS</th>
            <th style="width: 80px" class="">CANTIDAD</th>
            <th style="width: 80px" class="">DIAS/HORAS A UTILIZAR</th>
            <th style="width: 85px" class="">UNIDAD</th>
            <th style="width: 216px" class="">TARIFA/DÍA/HORA</th>
            <th class="tr" class="">SALARIO TOTAL</th>
            
        </tr>
    </thead>
    <tbody>

        <tbody>
            @php $total = 0; @endphp
            @foreach ($pptotec->getEquiposHerramientas($tipo) as $item)
                @php $total += $item->eqheValPat @endphp 
                <tr>
                    <td class="tc">{{$item->eqheCodigo}}</td>
                    <td>{{$item->eqheDesc}}</td>
                    <td class="tc">{{$item->eqheCantidad}}</td>
                    <td class="tc">{{$item->eqheNum}}</td>
                    <td class="tc">{{$item->getMeasure()}}</td>
                    <td class="tr">@currency($item->eqheValor)</td>
                    <td class="tr">@currency($item->eqheValPat)</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="nbl nbr nbbottom"></td>
                <td class="tr nbl nbr nbbottom"><b>SUBTOTAL<b></td>
                <td class="tr tdbackgound"><b>@currency($total)<b></td>
                 
            </tr>
        </tfoot>

    </tbody>
</table>