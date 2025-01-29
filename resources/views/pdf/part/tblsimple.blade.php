<table class="tabla tabla_relacion tabla_td_padding">
    <thead>
        <tr>
            <th style="width: 40px" class="tc nbbottom">CÓDIGO</th>
            <th style="width: 470px">{{$VARIOS[$i]}}</th>
            <th style="width: 80px">UNIDAD</th>
            <th style="width: 70px">CANTIDAD</th>
            <th style="width: 120px">ALOR UNITARIO</th>
            <th style="width: 120px">VALOR PARCIAL</th>
        </tr>
    </thead>
    <tbody> 
        @php $total = 0; @endphp
    @foreach ($pptotec->getVarios($tipo , $i) as $item)
        @php $total += ($item->varValor * $item->varCantidad) @endphp 
        <tr>
            <td class="tc">{{$item->varCodigo}}</td>
            <td>{{$item->varDesc}}</td>
            <td class="tc">{{$item->getMeasure()}}</td>
            <td class="tc">{{$item->varCantidad}}</td>                      
            <td class="tr">@currency($item->varValor)</td>
            <td class="tr">@currency($item->varValor * $item->varCantidad)</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4" class=" nbl nbr nbbottom"></td>
            <td class="tr nbl nbr nbbottom"><b>SUBTOTAL<b></td>
            <td class="tr tdbackgound"><b>@currency($total)<b></td>
            
        </tr>
    </tfoot>
</table>