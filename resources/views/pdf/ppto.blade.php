<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            /** Define the margins of your page **/
            @page {
                margin: 250px 20px 20px 20px ;
                font-family: Arial, Helvetica, sans-serif;
            }

            header {
                position: fixed;
                display: block;
                width: 100%;
                top:-230px;
            }

            footer {
                position: fixed; 
                bottom: -60px; 
                left: 0px; 
                right: 0px;
                height: 50px; 

                /** Extra personal styles **/
                background-color: #03a9f4;
                color: white;
                text-align: center;
                line-height: 35px;
            }

            main{
                
            }

            .page-break {
                  page-break-after: always;
            }

            .box-logo{
                display: inline-block;
                width: 20%;
                border:1px solid #000;
                width: 200px;
            }
            .box-info-header{
                width: 60%;
            }

            .box-logo img{
                width: 100%;
                max-height: 100px;
            }

            .fl{float:left;}
            .fr{float:right;}
            .tdpadding{
                padding: 5px;
            }
            .tdbackgound{  background: #D8D8D8 !important;  }
            .tdbackgoundyellow { background : yellow; }
            
            .tc{ text-align: center; }
            .tr{ text-align: right; }
            .logo{
                height: 50px;
                padding: 5px;
            }
            .vt{
                vertical-align: middle;
            }

            .tabla{
                width: 100%; 
                
                background:#FFF; 
                border-collapse: collapse
            }

            .tabla td{
                border:1px solid #000;              
            }

            .tabla th{
             
                border:1px solid #000; 
                background: #EDEDED;
                padding: 5px; 
            }
            .subtable{
                border-collapse: collapse; 
                width:100%; 
                border:0px solid #000;
                border-top:none;
                border-bottom:none;
            }
            .subtable td{ border:0.5px solid #000; }
            .subtable th{ border:0.5px solid #000; }

            .nbl { border-left:none !important; }
            .nbr { border-right:none !important; }
            .nbtop { border-top:none !important; }
            .nbbottom { border-bottom:none !important; }

            .bl { border-left:0.5px solid #000 !important; }
            .br { border-right:0.5px solid #000 !important; }
            .btop { border-top:0.5px solid #000 !important; }
            .bbottom { border-bottom:0.5px solid #000 !important; }
            .border {border: 0.5px solid #000 !important }

            .nborder {border: none !important }

            .tabla_relacion {  font-size: 11px; }
            

            .t-nborder td{ border: none; }
            .tabla_td_padding td{ padding: 5px; }
            
            .nobreak {
                page-break-inside: avoid;
            }

        </style>
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>

            @php $SUMTOTAL = 0; @endphp

            <table class="tabla tabla_relacion" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="10%" class="vt"><img src="{{public_path().'/assets/img/pdf/solutec.png'}}" class="logo"/></td>
                    <td class="vt" align="center">
                        <h3>PRESUPUESTO TECNICO</h3>
                    </td>
                    <td width="10%" class="vt" style="background: yellow;">
                        <table cellpadding="0" cellspacing="0" class="subtable nborder tdbackgoundyellow">
                            <tr>
                                <td align="center" class="bbottom nbl bnr tdpadding tc ">CODIGO:</td>
                            </tr>
                            <tr>
                                <td align="center" class=" bbottom nbl bnr tc tdpadding">VERSION :</td>
                            </tr>
                            <tr>                            
                                <td align="center" class=" nbbottom nbl bnr tc tdpadding">APROBADO:</td>
                            </tr>
                            
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class=" tdpadding vt nbr nbbottom"></td>
                    <td class="tc nbl nbr tc tdpadding nbbottom" align="center">
                           <table align="center">
                                <tr>
                                    <td class="nborder tdpadding">COMERCIAL</td>
                                    <td style="width:80px"></td>
                                    <td class="nborder tdpadding">PROYECTOS</td>
                                    <td style="width:80px" class="tc"> X </td>
                                <tr>

                           </table>         
                    </td>
                    <td class="vt nbl nbbottom"></td>
                </tr>
                <tr>
                    <td colspan="3" class="tdpadding nbtop">
                            <table class="subtable t-nborder">
                                 <tr>
                                    <td style="width: 120px" class="tdpadding tr">CLIENTE:</td>
                                    <td class="bbottom tdpadding" style="width: 80%;">{{$pptotec->pptoCliente}}</td>
                                    <td style="width: 88px" class="tr tdpadding">FECHA:</td>
                                    <td class="bbottom tdpadding">{{\carbon\carbon::parse($pptotec->pptoFecha)->format('d/m/Y')}}</td>
                                 </tr>       
                            </table>

                            <table class="subtable t-nborder">
                                <tr>
                                   <td style="width: 120px" class="tdpadding tr">PROYECTO:</td>
                                   <td class="bbottom tdpadding" style="width: 60%;">{{$pptotec->pptoProyecto}} </td>
                                   <td class="tdpadding tc">PR:</td>
                                   <td class="tdpadding bbottom tc">{{$pptotec->pptoPr}}</td>
                                   <td class="tdpadding tc">OT:</td>
                                   <td class="tdpadding bbottom tc">{{$pptotec->pptoOt}}</td>
                                </tr>       
                           </table>

                           <table class="subtable t-nborder">
                            <tr>
                               <td style="width: 120px" class="tdpadding tr">RESPONSABLE:</td>
                               <td class="bbottom tdpadding" style="width: 60%;">{{$pptotec->pptoResponsable}}</td>
                               <td style="width: 160px" class="tr tdpadding">CENTRO DE COSTOS:</td>
                               <td class="bbottom tdpadding tc">{{$pptotec->pptoCc}}</td>
                            </tr>       
                           </table>

                           <table class="subtable t-nborder" style="width: 50%">
                            <tr>
                               <td style="width: 120px" class="tdpadding tr">FECHA DE INICIO:</td>
                               <td style="width: 120px" class="bbottom tdpadding" style="width: 60%;">{{\Carbon\Carbon::parse($pptotec->pptoFecIni)->format("d/m/Y")}}</td>
                               <td style="width: 120px" class="tr tdpadding">FECHA DE FIN:</td>
                               <td style="width: 120px" class="bbottom tdpadding tc">{{\Carbon\Carbon::parse($pptotec->pptoFecFin)->format("d/m/Y")}}</td>
                            </tr>       
                           </table>


                    </td>
                </tr>
            </table>
            
        </header>
   
        <!-- Wrap the content of your PDF inside a main tag -->
        
        <main>
            
            <table class="tabla tabla_relacion tabla_td_padding">
                    <thead>
                        <tr>
                            <th colspan="6" style="text-align:left;">INGRESOS PREVISTOS</th>
                        </tr>
                        <tr>
                            <th style="width: 100px" class="tc"># DE COTIZACIÓN</th>
                            <th style="width: 400px">DESCRIPCION DEL SERVICIO</th>
                            <th style="width: 80px">UNIDADES</th>
                            <th style="width: 80px">DURACION</th>
                            <th style="width: 120px">VALOR PARCIAL</th>
                            <th style="width: 120px">VALOR TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="tc">{{$pptotec->pptoCotId}}</td>
                            <td>{{$pptotec->pptoCotDesc}}</td>
                            <td class="tc">{{$pptotec->pptoCotUni}}</td>
                            <td class="tc">{{$pptotec->pptoCotDur}}</td>
                            <td class="tr">@currency($pptotec->pptoCotValPar)</td>
                            <td class="tr">@currency($pptotec->pptoCotValTot)</td>
                        </tr>
                    </tbody>
            </table>

            <table class="tabla tabla_relacion tabla_td_padding" style="margin-top:10px">
                <thead>
                    <tr>
                        <th style="text-align:left; width:866px" class="tdbackgound">COSTOS TOTALES</th>
                        <th style="text-align:right;" class="tr tdbackgound">@currency($pptotec->getCostoTotales())</th>
                    </tr>
                </thead>
            </table>

            <table class="tabla tabla_relacion tabla_td_padding" style="margin-top:10px">
                <thead>
                    <tr>
                        <th style="text-align:left; width:866px" class="nbbottom tdbackgound">COSTOS ADMINISTRATIVOS</th>
                        <th style="text-align:right;" class="tr nbbottom tdbackgound">@currency($pptotec->getCostosPorTipo())</th>
                    </tr>
                </thead>
            </table>
            @php 
         
                $VARIOS = ['1'=>'MATERIALES E INSUMOS','2'=>'SUBCONTRATOS','3'=>'DIVERSOS', '4'=>'IMPUESTOS'];
                $tipo = 1; 
            @endphp
            <div class="nobreak">
                @include('pdf.part.tblmanoobra')
            </div>
            <br />
            <div class="nobreak">
                @include('pdf.part.tblequipos')
            </div>
            <br >
            
            @for($i=1;$i<=4;$i++)
                <div class="nobreak">
                    @include('pdf.part.tblsimple')
                </div>
                <br >
            @endfor

            <div class="nobreak">
            <table class="tabla tabla_relacion tabla_td_padding" style="margin-top:10px">
                <thead>
                    <tr>
                        <th style="text-align:left; width:866px" class="tdbackgound">COSTOS DIRECTOS ESTIMADOS</th>
                        <th style="text-align:right;" class="tr tdbackgound">@currency($pptotec->getCostosPorTipo(2))</th>
                    </tr>
                </thead>
            </table>
            @php  $tipo = 2;  @endphp
            
                @include('pdf.part.tblmanoobra')
            </div>
            <br />
            <div class="nobreak">
                @include('pdf.part.tblequipos')
            </div>
            <br >
            
            @for($i=1;$i<=4;$i++)
                <div class="nobreak">
                    @include('pdf.part.tblsimple')
                </div>
                <br >
            @endfor
            
            <div class="nobreak">
                <table class="table tabla_relacion tabla_td_padding"   style="width: 100%">
                    <tr>
                        <td valign="top" style="width: 50%">
                                <b>Observaciones:</b> <br /><br />
                                {!!$pptotec->pptoObsr!!}
                        </td>
                        <td style="width: 50%">
                            
                            @php

                                $ingresos = $pptotec->pptoCotValTot;
                                $costot   = $pptotec->getCostoTotales();
                                $utilidad = ($ingresos - $costot - $pptotec->pptoFinan -  $pptotec->pptoAdmCen - $pptotec->pptoOtros);
                                $UO       = round((($utilidad * 100) / $ingresos),2);
                            @endphp

                                <table class="table subtable" style="width: 70%" align="right" >
                                    <thead>
                                        <tr>
                                            <th colspan="2" class="tdbackgound">RESUMEN</th>
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
                                            <td class="tr">@currency($pptotec->pptoFinan)</td>
                                        </tr>
                                        <tr>
                                            <td>Admon. Central</td>
                                            <td class="tr">@currency($pptotec->pptoAdmCen)</td>
                                        </tr>
                                        <tr>
                                            <td>Otros</td>
                                            <td class="tr">@currency($pptotec->pptoOtros)</td>
                                        </tr>
                                        <tr>
                                            <td class="tdbackgound">Utilidad Oper.</td>
                                            <td class="tr tdbackgound">@currency($utilidad)</td>
                                        </tr>
                                        <tr>
                                            <td class="tdbackgound">% UO</td>
                                            <td class="tr tdbackgound"><b id="UO">{{$UO}}%</b></td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
             
                        </td>
                    </tr>
                </table>
            </div>
            <div class="nobreak">
                    <table align="center" style="width:80%; margin-top:30px;" class="tabla_td_padding tabla_relacion">
                            <tr>
                                <td valign="middle">Elaboró:</td>
                                <td>
                                    <div class="btop" style="width: 300px; margin-top:30px; text-align:center;padding-top:5px;">
                                        Francisco Alzate / Jhon Merchan / Michael Pombo
                                    </div>
                                </td>
                                <td valign="middle">Revisó:</td>
                                <td>
                                    <div class="btop" style="width: 300px; margin-top:30px; text-align:center;padding-top:5px;">
                                        PMO
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle">Revisó:</td>
                                <td>
                                    <div class="btop" style="width: 300px; margin-top:30px; text-align:center;padding-top:5px;">
                                        Gte y/o Dir. Operaciones
                                    </div>
                                </td>
                                <td valign="middle">Revisó:</td>
                                <td>
                                    <div class="btop" style="width: 300px; margin-top:30px; text-align:center;padding-top:5px;">
                                        Gte y/o Dir. Financiero
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td valign="middle">Aprobo:</td>
                                <td>
                                    <div class="btop" style="width: 300px; margin-top:30px; text-align:center;padding-top:5px;">
                                        Gte. General
                                    </div>
                                </td>
                            </tr>

                    </table>
            </div>
        </main>
    </body>
</html>

 