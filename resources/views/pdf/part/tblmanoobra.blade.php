<table class="tabla tabla_relacion tabla_td_padding">
    <thead>
       
        <tr>
            <th style="width: 50px" class="nbbottom tc">CÓDIGO</th>
            <th style="width: 300px" class="">MANO DE OBRA</th>
            <th style="width: 80px" class="">CANTIDAD</th>
            <th style="width: 80px" class="">SALARIOS</th>
            <th style="width: 76px" class="">PRESTACIONES SOCIALES</th>
            <th style="width: 76px" class="">DIAS A LABORAR</th>
            <th class="tr" class="">SALARIO TOTAL</th>
            <th class="tr" class="">SALARIO TOTAL</th>
        </tr>
    </thead>
    <tbody>

        <tbody>
            @php $total = 0;  @endphp
            @foreach ($pptotec->getManoObra($tipo) as $item)
                @php $total += $item->mdoSalPat @endphp 
           
            <tr> 
                <td class="tc">{{$item->mdoCod}}</td>
                <td>{{$item->mdoDesc}}</td>
                <td class="tc">{{$item->mdoCant}}</td>
                <td class="tr">@currency($item->mdoSalario)</td>
                <td class="tr">@currency($item->mdoPreSoc)</td>
                <td class="tc">{{$item->mdoDias}}</td>
                <td class="tr">@currency($item->mdoSalTot)</td>
                <td class="tr">@currency($item->mdoSalPat)</td>
                
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" class="nbl nbr nbbottom"></td>
                <td class="tr nbl nbr nbbottom"><b>SUBTOTAL<b></td>
                <td class="tr tdbackgound"><b>@currency($total)<b></td>
                 
            </tr>
        </tfoot>

    </tbody>
</table>