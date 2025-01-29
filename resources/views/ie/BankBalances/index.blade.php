@php
    $slug = getCurrentRouteGroup();
@endphp
@extends('app')
 
@section('content')

<div class="row mx-1 my-2">
    <div class="col-12 col-lg-6  overflow-hidden rounded-3">
        <div class="row">
                <div class="col-6 col-md-7 p-2 bg-first align-items-center d-flex justify-content-center fs-4">
                    Saldos Bancarios
                </div>
                <div class="col-6 col-md-5 px-3 py-2 align-items-center d-flex justify-content-center fs-6 bg-white">
                    Saldos diarios de las cuentas bancarias
                </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-lg-6  ">
        <div class="row">
            <div class="col-6">
                <div class="p-2 rounded-3 bg-white align-items-center d-flex justify-content-center fs-5">
                    <b>{{toDayName()}}</b>, {{date_complete()}}
                </div>
            </div>
            <div class="col-6">
                <div class="px-3 py-2  rounded-3 align-items-center d-flex justify-content-center fs-5 bg-first-light row">
                    <div class="col fs-6">
                    Saldo neto en bancos
                    </div>
                    <div class="col d-flex fw-bold ">
                         <div class="col">$</div>
                         <div>@number($totales['NetBalanceInBanks'])</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class=" position-relative  my-3 ">

        <div class="position-absolute top-0 end-0 d-inline-block">
            <button onclick="preSaveEvent()" type="button" class="btn bg-first-dark-light btn-icon-right rounded bg-white px-5 py-2 m-2">
                GUARDAR SALDOS DE HOY <i class='bx bx-upload'></i>
            </button> 
        </div>
    

        <div class="col-10">
            <div class="row">
                 @include('ie.BankBalances.part.card-saldo',['label'=>'Saldo disponible en bancos', 'valor'=> $totales['AvailableBalance']])
                 @include('ie.BankBalances.part.card-saldo',['label'=>'Novedades y/o ajustes', 'valor'=>$totales['NewsAdjustments']])   
                 @include('ie.BankBalances.part.card-saldo',['label'=>'Cupo de sobregiro aprobado', 'valor'=>$totales['ApprovedOverdraft']])   
                 @include('ie.BankBalances.part.card-saldo',['label'=>'Cupo de sobregiro disponible', 'valor'=>$totales['OverdraftUsed']])    
        </div>


       

    </div>
</div>


<div class="tabs-balances" id="tabs-balances">
    @php
        $i = 1;
    @endphp
    @foreach($companies as $company)

        @include('ie.BankBalances.part.tabs')
        @php
        $i++;
    @endphp
    @endforeach
</div>

@php $i = 1; @endphp
@foreach($companies as $company)
        
            <div id="content-tab-{{$company->id}}" class="content-tab @if($i==1) active @endif">
                <div class="bg-white px-4 pt-5 pb-5">
                    @include('ie.BankBalances.part.content-tab')
                </div>
            </div>
   @php  $i++; @endphp
@endforeach

 


@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            
            $('.currency').last().each(function() {
                currencyFormatter($(this).attr('id'));
            });

            $(".table-balances:visible input").off('keyup').on('keyup', function(e) {
                if (e.which === 13) {
                    $(this).next('input').focus();
                }
            });

            $( "#tabs-balances" ).sortable({
                update: function( event, ui ) {
                    var data = $("#tabs-balances").sortable('toArray', {attribute: "data-item"});  
                    
                    fn.ajax({
                        method: "POST",
                        async: true,
                        url: "{{route('saldo-diario.ajax',['opc'=>'update-order-companies-show'])}}",
                        data: {orden : data},
                        dataType: 'json',
                        contentType: 'application/json',
                        error: function(data) { return false; },
                        success: function(data) { return false; }
                    });

                }
                });
                $( "#tabs-balances" ).disableSelection();
            

                $('#tabs-balances .tab').click(function(){
                    $('.tabs-balances .tab').removeClass('active')
                    $(this).addClass('active')
                    $('.content-tab').removeClass('active');
                    $('#content-tab-'+$(this).data('tabopen')).addClass('active');
                })

                console.log('se inicia');
                inputMoviment('.currency');

        })

        var horizontalExample = document.getElementById('tabs-balances');
        if (horizontalExample) {
            new PerfectScrollbar(horizontalExample, {
                suppressScrollY: true
            });
        }

        function checkRowComplete(clase){
            var row = Array();
            var error = false;
            $(clase).each(function(index , item ){
                if (!$(this).val() && $(this).val()!='0' ){
                    console.log('vacio');
                    error = true;
                }else{
                    row.push($(this).val().replaceAll('.','').replaceAll(',','.'))
                }
            }) 
            
            return [error, row ];

        }

        function preSaveEvent(){
            
            var guardar = Array();

            $('.row_table').each(function(index, item){

                var dataRow = $(this).data('row');
                var bank    = $(this).data('bank');
                var account = $(this).data('account');
                var company = $(this).data('company');
                var fila    = $('.'+dataRow).data('row');
                var evaluateRow = checkRowComplete('.'+fila);
                if (!evaluateRow[0]){
                    guardar.push([ { company :  company , bank : bank  , account : account , saldos : evaluateRow[1]} ])
                }
                
            })
            
            if (!guardar.length){

                fn.alert("Lo sentimos no hay nada para guardar por favor ingrese los salos diarios <br/><br/><b>Ruerde que solo se podrá almacenar la fila si la completa en su totalidad.</b>");
                return false;

            }else{

                fn.ajax({
                          beforeSend : function(){
                                fn.wait("Estamos guardado los saldos, esto puede tardar unos minutos por favor espere...");
                          },
                          method: "POST",
                          async: true,
                          url: "{{route('saldo-diario.ajax',['opc'=>'save-balance'])}}",
                          data: { info : guardar },
                          dataType: 'json',
                          contentType: 'application/json',
                          error: function(data) { return false; },
                          success: function(data) {
                                if (data.success){
                                    fn.closeWait();
                                    fn.wait("<b class='text-success'>Estamos actualizado los totales, por favor espere.</b>");
                                    location.reload();                                    
                                }
                           }
                       })
            }

            console.log(guardar);

        }


    </script>
@endpush