<table class="table table-sm text-sm">
    <thead>
        <tr>
            @isset($excel)
            <th>CODIGO</th>        
            @endisset
            <th>USUARIO</th>    
            <th>FECHA</th>    
            <th>EMPRESA</th>
            <th>CUENTA BANCARIA</th>
            <th>DISPONIBLE</th>
            <th>DINERO EN CANJE/ ACH / RESERVA</th>
            <th>DISPONIBLE + CANJE / ACH</th>
            <th>CAPITAL EMBARGADO</th>
            <th>VALORES PROVISIONADOS</th>
            <th>CHEQUES POSTFECHADOS</th>
            <th>TRANSF. Y CHEQUES PENDIENTES</th>
            <th>DISPONIBLE + CANJE / ACH + NOVEDADES</th>
            <th>CUPO DE SOBREGIRO APROBADO</th>
            <th>CUPO DE SOBREGIRO UTILIZADO</th>
            <th>CUPO DE SOBREGIRO DISPONIBLE</th>
            <th>SALDO NETO EN BANCOS</th>
            <th>DISPONIBLE (LIQUIDO+CANJE)</th>
            <th>DÍAS DE SOBREGIRO</th>
        </tr>
    </thead>
    <tbody>

       
        @if ($ConsolidatedBalances)
            @foreach($ConsolidatedBalances as $row)
                @php
                    $total[1] = ($row->saldo_1+$row->saldo_2);
                    $total[2] = ($total[1] + $row->saldo_3+$row->saldo_4+$row->saldo_5+$row->saldo_6);
                    $total[3] = ($row->saldo_7-$row->saldo_8);
                    $total[4] = ( $total[1] - $total[2] - $total[3]);
                    $total[5] = ( $total[2] + $total[3]);
                @endphp
            <tr>
                @isset($excel)
                <td></td>        
                @endisset
                <td class="text-right">@currency($row->id_user)</td> 
                <td>{{$row->created_at->format("d/m/Y")}}</td>
                <td>{{$row->company->name}}</td>
                <td>{{$row->account->name}}</td> 
                <td class="text-right">@currency($row->saldo_1)</td> 
                <td class="text-right">@currency($row->saldo_2)</td>
                <td class="text-right">@currency($total[1])</td>
                <td class="text-right">@currency($row->saldo_3)</td>
                <td class="text-right">@currency($row->saldo_4)</td>
                <td class="text-right">@currency($row->saldo_5)</td>
                <td class="text-right">@currency($row->saldo_6)</td>
                <td class="text-right">@currency($total[2])</td>
                <td class="text-right">@currency($row->saldo_7)</td>
                <td class="text-right">@currency($row->saldo_8)</td>
                <td class="text-right">@currency($total[3])</td>
                <td class="text-right">@currency($total[4])</td>
                <td class="text-right">@currency($total[5])</td>
                <td class="text-center">{{$row->saldo_9 }}</td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>