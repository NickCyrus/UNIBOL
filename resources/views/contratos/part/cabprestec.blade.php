
<div class="col-md-12 mb-3">
    <a href="{{ $route ?? route('contratos') }}" class="btn btn-back"><i class='bx bx-left-arrow-alt' ></i>Regresar a {{ $backText ?? 'contratos' }} </a>
</div>



<div class="card mb-3 bg-success" style="background: #0b8eb5 !important;">
    <div class="row card-body color-white">
            <h2 class="color-white">Presupuesto Técnico</h2>
            <div class="col-md-3">
                    <label >Cliente</label>
                    <p class="color-white"><b>{{$pptotec->pptoCliente}}</b></p>
            </div>
            
            <div class="col-md-3">
                    <label >Proyecto</label>
                    <p class="color-white"><b>{{$pptotec->pptoProyecto}}</b></p>
            </div>
            <div class="col-md-2">
                <label >Fecha</label>
                <p class="color-white"><b>{{$pptotec->pptoFecha}}</b></p>
            </div>
            <div class="col-md-2">
                <label >PR</label>
                <p class="color-white"><b>{{$pptotec->pptoPr}}</b></p>
            </div>
            <div class="col-md-2">
                <label >OT</label>
                <p class="color-white"><b>{{$pptotec->pptoOt}}</b></p>
            </div>
            <div class="col-md-3">
                <label >Centro de costos</label>
                <p class="color-white"><b>{{$pptotec->pptoCc}}</b></p>
            </div>
            <div class="col-md-3">
                <label>Responsable</label>
                <p class="color-white"><b>{{$pptotec->pptoResponsable}}</b></p>
            </div>
            <div class="col-md-2">
                <label>Fecha Incio</label>
                <p class="color-white"><b>{{\Carbon\Carbon::parse($pptotec->pptoFecIni)->format("d/m/Y")}}</b></p>
            </div>
            <div class="col-md-2">
                <label>Fecha Fin</label>
                <p class="color-white"><b>{{\Carbon\Carbon::parse($pptotec->pptoFecFin)->format("d/m/Y")}}</b></p>
            </div>
    </div>
</div>
