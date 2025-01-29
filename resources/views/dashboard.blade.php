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

@push('scripts')
 <script>     
        @php
            $grafica1  = TmpIngresosController::getGraficas();
            $grafica2  = TmpIngresosController::getGraficas(2);
            $grafica3  = TmpIngresosController::getGraficas(3);
          
        @endphp

       var series     = @json($grafica1['serie']);
       var categories = @json($grafica1['categories']);

       var series_2023= @json($grafica2['serie']);
       var categories_2023 = @json($grafica2['categories']);
       

        var options = {
          series: [series],
          chart: {
             type: 'bar',
             height: 350
        },
        plotOptions: {
          bar: {
            borderRadius: 4,
            borderRadiusApplication: 'end',
            horizontal: true,
          }
        },
        dataLabels: {
          enabled: false
        },
        xaxis: {
          categories: categories,
          labels: {
            formatter: function (val) {
              return (val / 1000 ) + "K"
            }
          }
        },
        tooltip: {
          enabled: false,
           
        },
        };

        var options2 = {
          series: [series_2023],
          chart: {
             type: 'bar',
             height: 350
        },
        plotOptions: {
          bar: {
            borderRadius: 4,
            borderRadiusApplication: 'end',
            horizontal: true,
          }
        },
        dataLabels: {
          enabled: false
        },
        xaxis: {
          categories: categories_2023,
          labels: {
            formatter: function (val) {
              return (val / 1000 ) + "K"
            }
          }
        },
        tooltip: {
          enabled: false,
           
        },
        };

        var options3 = {
          series: @json($grafica3['serie']),
          chart: {
          width: 380,
          type: 'pie',
        },
        labels: @json($grafica3['categories']),
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var options4 = {
          series: [{
          name: 'Ingresos 2024',
          data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
        }, {
          name: 'Ingresos 2023',
          data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
        }],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: ['Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct'],
        },
        yaxis: {
          title: {
            text: '$'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "$ " + val + " Millones"
            }
          }
        }
        };

     


        var chart   = new ApexCharts(document.querySelector("#chart"), options);
        var chart_2 = new ApexCharts(document.querySelector("#chart-2"), options2);
        var chart_3 = new ApexCharts(document.querySelector("#chart-3"), options3);
        var chart_4 = new ApexCharts(document.querySelector("#chart-4"), options4);
        chart.render();
        chart_2.render();
        chart_3.render();
        chart_4.render();  
  </script>
  @endpush