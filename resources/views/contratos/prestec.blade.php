@php
    $slug = 'contratos.cotizaciones';
    $slugURL = "contratos/{$contrato->id}/cotizaciones";
    use Carbon\Carbon;
@endphp
@extends('app')
@section('content')
    @include('contratos.part.cabprestec', [ 'backText'=>'Cotizaciones' , 'route'=>route('contratos.cotizaciones', ['id'=>$contrato->id])])


    <div class="row mb-3 ">
      
             
              <div class="col-md-3">
                <div class="card">
                  <div class="card-body">
                    <span>Ingresos previsto</span>
                    <h3 class="card-title text-nowrap mb-1">@currency($pptotec->pptoCotValTot)</h3>
                  </div>
                </div>
              </div>

              <div class="col-md-3">
                <div class="card">
                  <div class="card-body">
                    <span>Costos totales</span>
                    <h3 class="card-title text-nowrap mb-1">@currency($pptotec->getCostoTotales())</h3>
                  </div>
                </div>
              </div>


              <div class="col-md-3">
                <div class="card">
                  <div class="card-body">
                    <span>Costos administrativos</span>
                    <h3 class="card-title text-nowrap mb-1">@currency($pptotec->getCostosPorTipo())</h3>
                  </div>
                </div>
              </div>

              <div class="col-md-3">
                <div class="card">
                  <div class="card-body">
                    <span>Costos directos</span>
                    <h3 class="card-title text-nowrap mb-1">@currency($pptotec->getCostosPorTipo(2))</h3>
                  </div>
                </div>
              </div>


     
  </div>


        <div class="nav-align-top mb-4">
            @include('contratos.part.listtabprestec')
            <div class="tab-content">
              <div class="tab-pane fade @if(!$acttab) active show @endif" id="navs-tap1" role="tabpanel">
                @include('contratos.prestec.ingprevistos')
              </div>
              <div class="tab-pane fade @if($acttab==2 ) active show @endif" id="navs-tap2" role="tabpanel">
                @include('contratos.prestec.costostot')
              </div>
              <div class="tab-pane fade  @if($acttab==3 ) active show @endif" id="navs-tap3" role="tabpanel">
                @include('contratos.prestec.costosadm' , ['tipo'=>1 , 'acttab'=>3])
              </div>
              <div class="tab-pane fade  @if($acttab==4 ) active show @endif" id="navs-tap4" role="tabpanel">
                @include('contratos.prestec.costosdirest',  ['tipo'=>2 , 'acttab'=>4])
              </div>

              <div class="tab-pane fade  @if($acttab==5 ) active show @endif" id="navs-tap5" role="tabpanel">
                @include('contratos.prestec.resumen', ['acttab'=>4])
              </div>
              
            </div>
          </div>
        
        
 
@endsection

@section('addFooter')

        <script>
                 
                 openSalarios = function(tipo , acttab){

                     fn.dialog({
                                url : '{{route("contratos.ajax", ["opc"=>"openSalarios"])}}',
                                type : 'post',
                                tipo : tipo,
                                id :  {{$parentId}},
                                acttab : acttab,
                                ppto : {{$pptotec->pptoId}},
                                class: 'col-md-12',
                               
                              });

                 }

                 openEquipos = function(tipo , acttab){

                    fn.dialog({
                              url : '{{route("contratos.ajax", ["opc"=>"openEquipos"])}}',
                              type : 'post',
                              tipo : tipo,
                              id :  {{$parentId}},
                              acttab : acttab,
                              ppto : {{$pptotec->pptoId}},
                              class: 'col-md-12',
                              
                            });

                    }
                  
                    openVarios = function(tipo , acttab , servicio ){
                          fn.dialog({
                                    url : '{{route("contratos.ajax", ["opc"=>"openVarios"])}}',
                                    type : 'post',
                                    tipo : tipo,
                                    servicio : servicio,
                                    id :  {{$parentId}},
                                    acttab : acttab,
                                    ppto : {{$pptotec->pptoId}},
                                    class: 'col-md-12',                                    
                                  });
                    }


                 @if ($permission->aedit)

                 pdf = function(url){
                    fn.dialog({
                                url : url,
                                type : 'post',
                                class: 'col-md-8'
                              });
                 }

                 addItem = function(){
                    fn.dialog({
                                url : '{{route("{$slug}.add",["id"=>$contrato->id])}}',
                                type : 'post',
                                class: 'col-md-10'
                              });
                 }

                 @endif

                 @if ($permission->aedit)
                 edit = function(id){
                    fn.dialog({
                                url : baseApp+'/{{$slugURL}}/'+id+'/edit',
                                type : 'post'
                              });
                 }
                 @endif
                 @if ($permission->adelete)
                 borrar = function(id){
                      fn.dialog({
                                  url : baseApp+'/{{$slugURL}}/'+id+'/delete',
                                  type : 'post'
                                });
                  }
                 @endif


                 
        </script>

@endsection
