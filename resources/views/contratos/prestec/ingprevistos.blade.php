<div class="table-responsive">
        <table class="table table-inner">
                <thead>
                    <tr>
                        <th># DE COTIZACIÓN</th>
                        <th>DESCRIPCION DEL SERVICIO</th>
                        <th class="text-center">UNIDADES</th>
                        <th class="text-center">DURACIÓN</th>
                        <th class="text-center">VALOR PARCIAL</th>
                        <th class="text-center">VALOR TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$pptotec->pptoCotId}}</td>
                        <td>{{$pptotec->pptoCotDesc}}</td>
                        <td class="text-center">{{$pptotec->pptoCotUni}}</td>
                        <td class="text-center">{{$pptotec->pptoCotDur}}</td>
                        <td class="text-center"><b>@currency($pptotec->pptoCotValPar)</b></td>
                        <td class="text-center"><b>@currency($pptotec->pptoCotValTot)</b></td>
                    </tr>
                </tbody>
        </table>
</div>