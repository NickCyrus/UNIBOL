
    <table style="width: 100%; margin-bottom:5px;">
        <tr>
            <td style="width: 50%">
                <div class="align-items-center d-flex justify-content-start">
                        @if ($company->logo)
                            <img src="{{imageToPdf($company->logo , $company->name)}}" style="max-height: 70px;" />
                        @else
                            <h3>{{$company->name}}</h3>
                        @endif
                </div>
            </td>
            <td style="width: 50%">
            <div class="t-right color-first">
                <div>SALDOS BANCARIOS</div>
                <div>{{$company->name}}</div>
                <div><b>{{toDayName($fecha)}}</b>, {{date_complete()}}</div>
            </div>
            </td>
        </tr>      
    </table>

    <table class="table-balances">
        <thead>
            <tr>
                <td class="cell-logo" colspan="2">
                    <div class="align-items-center d-flex justify-content-end border-left-first bg-table-thead w-100">
                        <div class="box-currency align-items-center d-flex justify-content-start">Cuenta Bancaria</div>
                    </div>
                    </td>
                <td class="cell-number">Disponible</td>
                <td class="cell-number">Dinero en canje/ACH</td>
                <td class="cell-number">Capital Embargado</td>
                <td class="cell-number text-center">Valores Provisionados</td>
                <td class="cell-number text-center">Cheques Postfechados</td>
                <td class="cell-number text-center">Transf./Cheques Pend. por Cobro</td>
                <td class="cell-number ">Sobregiro Aprobado</td>
                <td class="cell-number">Sobregiro Utilizado</td>
                <td class="cell-number-small text-center">Días de Sobregiro</td>
            </tr>
        </thead>

        <tbody>
            @php 
                if (isset($preview)){
                    $loop = $company->getAccountsListRel($fecha ?? '');
                }else{
                    $loop = $company->accounts_list_rel;
                }
            @endphp

            @foreach($loop as $account)

                @php
                    $row = $account->getBalanceToday($fecha ?? '');
                @endphp
                <tr>
                    <td class="cell-logo">
                        <div class="t-center d-flex justify-content-center">
                            @if ($account->bank->logo)
                                <img src="{{imageToPdf($account->bank->logo , $company->name)}}" style="max-height: 50px;padding-top:5px" />
                            @else
                                <small>{{$account->bank->name}}</small>
                            @endif
                            <input type="hidden" 
                            @if (!$row || can('edit'))
                                class="row_table" 
                            @endif
                            data-company="{{$company->id}}" 
                            data-bank="{{$account->bank->id}}" 
                            data-account="{{$account->account->id}}" 
                            data-row="row-{{$company->id}}-{{$account->account->id}}" 
                            name="id_company" value="{{$company->id}}" />
                        </div>
                    </td>
                    @php 
                        $class =  "currency row-{$company->id} row-{$company->id}-{$account->account->id}";
                        $class2 =  " currency row-{$company->id}-{$account->account->id}";
                    @endphp
                    <td class="cell-account"><div class="align-items-center d-flex justify-content-start" style="padding:12px 0px 0px 5px" >{{$account->account->name}}</div></td>
                    <td class="cell-number">
                        @include('ie.BankBalances.part.input' , ['name'=>'saldo_1' , 'row'=>$row ?? '' ,   'class'=>$class , 'preview'=>$preview ?? '' ])
                    </td>
                    <td class="cell-number">
                        @include('ie.BankBalances.part.input' , ['name'=>'saldo_2' , 'row'=>$row ?? '' , 'class'=>$class2 , 'preview'=>$preview ?? ''])
                    </td>
                    <td class="cell-number">
                        @include('ie.BankBalances.part.input', ['name'=>'saldo_3' , 'row'=>$row ?? '' , 'class'=>$class2 , 'preview'=>$preview ?? ''])
                    </td>
                    <td class="cell-number text-center">
                        @include('ie.BankBalances.part.input', ['name'=>'saldo_4' , 'row'=>$row ?? '' , 'class'=>$class2 , 'preview'=>$preview ?? ''])
                    </td>
                    <td class="cell-number text-center">
                        @include('ie.BankBalances.part.input', ['name'=>'saldo_5' , 'row'=>$row ?? '' , 'class'=>$class2 , 'preview'=>$preview ?? ''])
                    </td>
                    <td class="cell-number text-center">
                        @include('ie.BankBalances.part.input', ['name'=>'saldo_6' , 'row'=>$row ?? '' , 'class'=>$class2 , 'preview'=>$preview ?? ''])
                    </td>
                    <td class="cell-number ">
                        @include('ie.BankBalances.part.input', ['name'=>'saldo_7' , 'row'=>$row ?? '' , 'class'=>$class2 , 'preview'=>$preview ?? ''])
                    </td>
                    <td class="cell-number">
                        @include('ie.BankBalances.part.input', ['name'=>'saldo_8' , 'row'=>$row ?? '' , 'class'=>$class2 , 'preview'=>$preview ?? ''])
                    </td>
                    <td class="cell-number-small ">
                        @include('ie.BankBalances.part.input', ['name'=>'saldo_9' , 'row'=>$row ?? '' , 'placeholder'=> '' , 'preview'=>$preview ?? '' , 'class'=>" text-center sn row-{$company->id}-{$account->account->id}"])
                    </td>
                </tr>
            @endforeach
             
        </tbody>
        @if (isset($cabecera) && $cabecera)

            @php
                $totales = $company->getTotales($fecha);
            @endphp

        <tfoot>
            <tr>
                <td colspan="2">
                    <div class="align-items-center d-flex justify-content-end border-left-first bg-table-thead" style="padding-right: 10px; width:98%;">
                        <div class="box-currency align-items-center d-flex justify-content-start">Saldos {{$company->name}} </div>
                    </div>
                         
                </td>
                <td class="cell-number">
                    <div class="align-items-center d-flex justify-content-end ">
                        <div class="box-currency align-items-center d-flex justify-content-end"> @currency($totales->tsaldo_1 ?? 0)</div>
                    </div>
                </td>
                <td class="cell-number">
                    <div class="align-items-center d-flex justify-content-end">
                        <div class="box-currency align-items-center d-flex justify-content-end"> @currency($totales->tsaldo_2 ?? 0)</div>
                    </div>
                </td>
                <td class="cell-number">
                    <div class="align-items-center d-flex justify-content-end">
                        <div class="box-currency align-items-center d-flex justify-content-end"> @currency($totales->tsaldo_3 ?? 0)</div>
                    </div>
                </td>
                <td class="cell-number text-center">
                    <div class="align-items-center d-flex justify-content-end">
                        <div class="box-currency align-items-center d-flex justify-content-end"> @currency($totales->tsaldo_4 ?? 0)</div>
                    </div>
                </td>
                <td class="cell-number text-center">
                    <div class="align-items-center d-flex justify-content-end">
                        <div class="box-currency align-items-center d-flex justify-content-end"> @currency($totales->tsaldo_5 ?? 0)</div>
                    </div>
                </td>
                <td class="cell-number text-center">
                    <div class="align-items-center d-flex justify-content-end">
                        <div class="box-currency align-items-center d-flex justify-content-end"> @currency($totales->tsaldo_6 ?? 0)</div>
                    </div>
                </td>
                <td class="cell-number ">
                    <div class="align-items-center d-flex justify-content-end">
                        <div class="box-currency align-items-center d-flex justify-content-end"> @currency($totales->tsaldo_7 ?? 0)</div>
                    </div>
                </td>
                <td class="cell-number" >
                    <div class="align-items-center d-flex justify-content-end border-right border-right-last" style="padding-right: 5px;">
                        <div class="box-currency align-items-center d-flex justify-content-end"> @currency($totales->tsaldo_8 ?? 0)</div>
                    </div>
                </td>
                <td class="cell-number-small ">
                   
                </td>
        </tfoot>
        @endif
    </table>