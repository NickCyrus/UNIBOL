@php

    $ingresos = $pptotec->pptoCotValTot;
    $costot   = $pptotec->getCostoTotales();
    $utilidad = ($ingresos - $costot - $pptotec->pptoFinan -  $pptotec->pptoAdmCen - $pptotec->pptoOtros);
    $UO       = round((($utilidad * 100) / $ingresos),2);
@endphp

<form method="post" action="">

    @csrf
    <div class="row">
        <div class="col-md-6">
              <div class="form-group">
                    <label>Observaciones</label> <br /><br />
                    <textarea id="pptoObsr" rows="10" name="pptoObsr" maxlength="255" placeholder="" class="form-control">{{$pptotec->pptoObsr}}</textarea>
              </div>  
        </div>
        <div class="col-md-6">
                        <div class="table-responsive" align="center">
                                <table class="table table-inner" style=" " >
                                        <thead>
                                            <tr>
                                                <th colspan="2">RESUMEN</th>
                                            </tr>
                                        </thead>               
                                        <tbody>
                                            <tr>
                                                <td>Ingresos</td>
                                                <td class="text-right tr"><b>@currency($ingresos)<b></td>
                                            </tr>
                                            <tr>
                                                <td>Costos Totales</td>
                                                <td class="text-right tr"><b>@currency($costot)<b></td>
                                            </tr>
                                            <tr>
                                                <td>Financiacion</td>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-text">$</span>
                                                        <input type="" data-mask="000.000.000.000.000" data-mask-reverse="true" class="on form-control tr recal" onblur="recal()" name="pptoFinan" id="pptoFinan" value="{{$pptotec->pptoFinan}}" />
                                                    </div>                            
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Admon. Central</td>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-text">$</span>
                                                        <input type="" data-mask="000.000.000.000.000" data-mask-reverse="true" class="on form-control tr recal" onblur="recal()" name="pptoAdmCen" id="pptoAdmCen" value="{{$pptotec->pptoAdmCen}}" />
                                                    </div>     
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Otros</td>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-text">$</span>
                                                        <input type="" data-mask="000.000.000.000.000" data-mask-reverse="true" class="on form-control tr recal" onblur="recal()" name="pptoOtros" id="pptoOtros" value="{{$pptotec->pptoOtros}}" />
                                                    </div>     
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Utilidad Oper.</td>
                                                <td class="tr"><b id="utilidad">@currency($utilidad)<b></td>
                                            </tr>
                                            <tr>
                                                <td>% UO</td>
                                                <td class="tr"><b id="UO">{{$UO}}%</b></td>
                                            </tr>
                                             

                                        </tbody>
                                </table>
                        </div>
                </div>
                <div class="col-md-12 text-center mt-3">
                    <button class="btn btn-primary">Guardar</button> 
                    <a target="_blank" href="{{route('contratos.cotizaciones.prestec.pdf',['id'=>$pptotec->pptoId])}}" class="btn btn-warning">Visualizar PDF presupuesto</a>
                    <a target="_blank" href="{{route('contratos.cotizaciones.prestec.pdf.download',['id'=>$pptotec->pptoId, 'action'=>'download'])}}" class="btn btn-info">Descargar PDF presupuesto</a>             
                </div>    
         </div>
</form>
<script>
       
       recal = function(){

            var $ingresos = {{$ingresos}}
            var $costot   = {{$costot}}
            var $utilidad = {{$utilidad}}
            var $UO       = {{$UO}}
            var resta     = 0;

              
                        
            $('.recal').each(function(index, item){
                resta += parseFloat( ( ($(item).val()) ? $(item).val().replaceAll('.','') : 0) );
            })

            console.log("INGRESOS =>"+$ingresos);
            console.log("RESTA =>"+resta);
            console.log("COSTOT =>"+$costot);
            var utilidadCal  = $ingresos - ($costot + resta);
            $('#utilidad').html('$ '+Number(utilidadCal).toLocaleString('de-DE')) ;
            var UO = ((utilidadCal*100) / $ingresos);
            $('#UO').html( +(Math.round(UO + "e+2")  + "e-2")+'%' );
             
            
        }
</script>

