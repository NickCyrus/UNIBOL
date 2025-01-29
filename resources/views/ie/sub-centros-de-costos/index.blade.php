@php
    $slug = getCurrentRouteGroup();
@endphp
@extends('app')
 
@section('content')
 
 <div class="row mx-1">

  <div class="col-sm-12 col-md-3">
    <div class="card ">
                <div class="card-body">
                    <h4>Creación rápida</h4>
                    <form method="POST" action="{{route("$slug.save")}}" autocomplete="off">
                        @csrf
                        @isset($edit)
                            <input name="id" type="hidden" required value="{{$edit->id}}" />
                        @endisset
                        <div class="form-group">
                            <input value="{{old('cc', $edit->codecc ?? '' )}}" placeholder="Digite el centro de costo" list="listCC" class="form-control" name="cc" required autofocus />
                        </div>
                        <div class="form-group mt-2">
                            <input value="{{old('subcc', $edit->code ?? '')}}" placeholder="Digite el subcentro de costo" autocomplete="off" class="form-control" name="subcc" required />
                        </div>
                        <div class="form-group mt-2">
                            <input value="{{old('name', $edit->name ?? '')}}" placeholder="Obsercación" autocomplete="off" class="form-control" name="name" />
                        </div>
                        
                    @include('component.btn-event')
                    </form>
                    <datalist id="listCC">
                        @php
                            $items  = cclist();
                            if ($items->count()){
                                foreach ($items as $item) {
                                    echo "<option>{$item->code}</option>";
                                }
                            }
                        @endphp
                    </datalist>
                </div>
    </div>
  </div>

  <div class="col-sm-12 col-md-9 ml-3">
    <div class="card">
        <div class="card-body">
            <h4>Arbol centro de costos</h4>
            <div id="tree"></div>
        </div>
    </div>

    <div class="col-sm-12 mt-3 ml-3">
        <div class="card">

            <div class="card-body">
                <H4>LISTADO DE CENTROS DE COSTOS</h4>
                <table class="table table-striped dn-table dt-responsive">
                    <thead>
                    <tr>
                        <th>CENTRO DE COSTO</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                            @php
                                $rows = callmod('ie\IeCostCenter')::StatusActive()->get();
                            @endphp
                                @if ($rows)
                                    @foreach($rows as $row)
                                        @include('ie.sub-centros-de-costos.tr-row',['slug'=>'categorias-centro-de-costo', 'view'=>'icon'])
                                    @endforeach
                            @endif

                    </tbody>
                </table>
            </div>
        </div>
  </div>


 </div> 
@endsection

@section('addFooter')
<script>

    $(function () {

        var json = {!!json_encode(callmod('ie\IeCostCenter')::getTree())!!};

        $('#tree').bstreeview({
            data: json,
            expandIcon: 'fa fa-angle-down fa-fw',
            collapseIcon: 'fa fa-angle-right fa-fw',
            indent: 1.25,
            parentsMarginLeft: '1.25rem',
            openNodeLinkOnNewTab: true
        });
    });
</script>

@endsection

 