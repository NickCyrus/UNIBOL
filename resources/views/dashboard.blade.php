@php
    use App\Http\Controllers\TmpIngresosController;
@endphp
@extends('app')

@section('content')
    <div class="row">

          <div class="col-12 my-2">
                Filtros:
                <div class="row">
                    <div class="col-4">
                      <select class="form-control">
                          <option>Seleccionar Mes</option>
                          <option>Enero</option>
                          <option>Febrero</option>
                          <option>Marzo</option>
                      </select>
                    </div>

                    <div class="col-4">
                        <div class="row">
                          <input style="width: 30%" class="form-control col-3" type="date" /> <div style="
    width: auto;
    padding-top: 8px;
">hasta </div><input style="width: 30%" class="form-control col-3" type="date" />
                        </div>
                    </div>
                </div>
          </div>


            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h4>Ingresos 2024</h4>
                        <div id="chart"></div>
                    </div>
                </div>
            </div>

            <div class="col-4">
              <div class="card">
                  <div class="card-body">
                      <h4>Ingresos 2023</h4>
                      <div id="chart-2"></div>
                  </div>
              </div>
            </div>
            <div class="col-4">
              <div class="card">
                  <div class="card-body">
                      <h4>Ingresos 2023</h4>
                      <div id="chart-3"></div>
                  </div>
              </div>
            </div>

            <div class="col-12 mt-3">
              <div class="card">
                  <div class="card-body">
                      <h4>Comparativa mensual 2024-2023</h4>
                      <div id="chart-4"></div>
                  </div>
              </div>
            </div>
    </div>
@endsection
