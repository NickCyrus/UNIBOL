<form  action="{{route('registro-ingresos-egresos')}}" method="get" enctype="multipart/form-data">
    @csrf
        <div class="row mb-3">
                <div class="col-md-3">
                    <select class="form-control" name="filter_Rubro">
                        <option value="" selected>Filtrar Rubro</option>
                        <?php
                            $options  = callmod('FinancialSituation\RubroModel')::options();
                            if ( $options){
                                foreach ($options as $option) {
                                    $selected = (isset($_GET["filter_Rubro"]) && $_GET["filter_Rubro"] == $option->id) ? 'selected' : '';
                                    echo "<option {$selected} value={$option->id}>{$option->name}</option>";
                                }
                            }
                        ?>
                    </select>                        
                </div>
                <div class="col-md-3">
                    <select class="form-control" name="filter_tipo_rubro">
                        <option value="" selected>Filtrar Tipo Rubro</option>
                        <?php
                            $options  = callmod('FinancialSituation\HomologationModel')::options();
                            if ( $options){
                                foreach ($options as $option) {
                                    $selected = (isset($_GET["filter_tipo_rubro"]) && $_GET["filter_tipo_rubro"] == $option->id) ? 'selected' : '';
                                    echo "<option {$selected} value={$option->id}>{$option->name}</option>";
                                }
                            }
                        ?>
                    </select>                        
                </div>
                <div class="col-md-3">
                    <select class="form-control" name="filter_periodo">
                        <option value="" selected>Filtrar Periodo</option> 
                        <?php
                            $options  = callmod('FinancialSituation\FinancialSituationeModel')::options();
                            if ( $options){
                                foreach ($options as $option) {
                                    $selected = (isset($_GET["filter_periodo"]) &&  $_GET["filter_periodo"] == "{$option->Month_id}|{$option->ano}") ? 'selected' : '';
                                    echo "<option {$selected} value='{$option->Month_id}|{$option->ano}'>{$option->name}</option>";
                                }
                            }
                        ?>
                    </select>                        
                </div>
                <div class="col-md-3">
                        <button class="btn btn-sm btn-info">Filtrar</button>
                </div>
        </div>
</form>
<table class="table table-sm">
    <thead>
        <tr>
            <th>RUBRO</th>
           <!-- <th>ORDEN</th>  !-->
            <th>Tipo de rubro</th>
            <th>ORDEN EEFF[RUBRO]</th>
            <!-- <th>ORDEN EEFF[N°]</th> !-->
            <th>Notas - Auxiliar</th>
            <th class="text-right">Saldo</th>
            <th>Periodo</th>
        </tr>
    </thead>
    <tbody>
        @if($list)
            @foreach($list as $item)
                <tr>
                    <td>{{$item->rubro}}</td>
                  <!--   <td>{{$item->orden}}</td> -->
                    <td>{{$item->homologacion}}</td>
                    <td>{{$item->eeff_rubro}}</td>
                    <!-- <td>{{$item->eeff_orden}}</td> !-->
                    <td>{{$item->nota_blance}}</td>
                    <td class="text-right">{!!money($item->saldo, '$', true)!!}</td>
                    <td>{{$item->periodo}}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
    
</table>
    <div class="d-blog my-3 justify-content-center">
        @if ($list->count()) {!! $list->withQueryString()->links() !!} @endif
    </div>
<script>
     
</script>