@php
    $slug = getCurrentRouteGroup();
@endphp
@extends('app')
 
@section('content')
 
<div class="card">
    <div class="card-header row">
        <div class="col">
            <h4 class="fw-bold p-0 mb-0 "> Movimientos Ingresos/Egresos </h4>
        </div>
        <div class="col">
            <a class="btn btn-sm btn-danger pull-right  event-plus" href="{{route("{$slug}")}}">
                <i class='bx bx-left-arrow-alt' ></i> &nbsp; Cancelar
            </a>
        </div>
    </div>

    
    <div class="card-body">
        @include('ie.movi.form.cabecera' , ['info'=> (isset($info)) ? $info : callmod('ie\IeIncomeExpense') , 'cabeceras'=>$cabeceras ])       
    </div>
</div>

@endsection

@section('addFooter')

    <script>

        $(function(){

                $('#generaMovimiento').click(function(){
                    if (!$('#tipomovimiento').val()){
                        $('#tipomovimiento').focus()
                    }else{

                        fn.ajax({
                                   beforeSend : function(){
                                     disabled('#tipomovimiento, #generaMovimiento');
                                     fn.wait();
                                   },
                                   data : { type : $('#tipomovimiento').val()},
                                   url  : '{{route('movi.ajax', ['opc'=>'cabecere'])}}',
                                   method : 'post',
                                   success : function(rs){
                                       
                                        if (rs.html){
                                            $('#cabecera').html(rs.html);
                                        }
                                   },
                                   complete: function(){
                                     fn.applyPlugins()
                                     fn.closeWait()
                                   },
                                   error : function(){
                                     fn.alert("Se ha producido un error");
                                   }

                                })

                        
                    } 
                })


        })

    </script>

@endsection