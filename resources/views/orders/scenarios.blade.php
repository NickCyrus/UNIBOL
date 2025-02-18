@extends('app')

@section('content')
@php
  use App\Http\Controllers\OrderController;
  $nClientes    = DB::select("SELECT DISTINCT(solicitante) FROM orders , inventories WHERE saldo < 0 AND inventories.id_material = orders.id_material ORDER BY g ");  
  $nProductos   = DB::select("SELECT DISTINCT(orders.id_material)  FROM orders , inventories WHERE saldo < 0 AND inventories.id_material = orders.id_material ORDER BY g ");  
  $nMarcas      = DB::select("SELECT DISTINCT(orders.marca)  FROM orders , inventories WHERE saldo < 0 AND inventories.id_material = orders.id_material ORDER BY g ");  
  $nMarcas      = DB::select("SELECT marca ,  COUNT(*) as cantidad FROM orders , inventories WHERE saldo < 0 AND inventories.id_material = orders.id_material GROUP BY marca ");  
  $kgPendientes =  $query->where('saldo','<',0)->selectRaw("SUM(saldo) as pendente")->first()->pendente;
@endphp
        <div class="card mb-3">
            <div class="card-body">
                <h4>Resumen</h4>
                <div class="row">
                       <div class="col-2">
                           <div class="card bg-unibol text-white">
                               <div class="card-body info">
                                       <div class="leyend">ANCHO EN MAQUINA</div>
                                       <div class="valor">319 Cm</div>
                               </div>  
                           </div>
                       </div>
                       <div class="col-2">
                           <div class="card  bg-unibol text-white">
                               <div class="card-body info">
                                       <div class="leyend">ANCHO DEL CORTE</div>
                                       <div class="valor">315 Cm</div>
                               </div>  
                           </div>
                       </div>
                       <div class="col-2">
                           <div class="card bg-unibol text-white">
                               <div class="card-body info">
                                       <div class="leyend">Kilogramos pendiente</div>
                                       <div class="valor">{{$kgPendientes}} Kg</div>
                               </div>  
                           </div>
                       </div>
                       <div class="col-2">
                           <div class="card bg-unibol text-white">
                               <div class="card-body info">
                                       <div class="leyend"># Clientes</div>
                                       <div class="valor">{{count($nClientes)}}</div>
                               </div>  
                           </div>
                       </div>
                       <div class="col-2">
                           <div class="card bg-unibol text-white">
                               <div class="card-body info">
                                       <div class="leyend">Tipos de Materiales</div>
                                       <div class="valor">{{count($nProductos)}}</div>
                               </div>  
                           </div>
                       </div>
                       <div class="col-2">
                           <div class="card bg-unibol text-white">
                               <div class="card-body info">
                                       <div class="leyend">Marcas</div>
                                       <div class="valor">{{count($nMarcas)}}</div>
                               </div>  
                           </div>
                       </div>
                </div>

                <div class="row mt-3">
                      <div class="col-4">
                           <div class="card">
                               <div class="card-body">
                                   <table class="table">
                                      <thead>
                                           <tr>
                                               <th class="p-1">Cliente</th>
                                               <th class="text-right p-1">Faltante</th>    
                                           </tr>
                                      </thead>
                                      <tbody>
                                       @php
                                           $clientes  =  DB::select("SELECT solicitante , SUM(saldo) cantidad FROM orders  WHERE saldo < 0 GROUP BY solicitante ORDER BY saldo ASC");  
                                       @endphp
                                           @foreach($clientes as $cliente)
                                           <tr>
                                               <td class="p-1">{{ $cliente->solicitante}}</td>
                                               <td class="p-1 text-red" align="right">{{ $cliente->cantidad}} Kg</td>
                                           </tr>
                                           @endforeach
                                      </tbody>
                                   </table>
                               </div>
                           </div>
                      </div> 
                      <div class="col-4">
                           <div class="card">
                               <div class="card-body" style=" max-height: 392px;overflow-y: auto;">
                                   <table class="table">
                                       <thead>
                                            <tr>
                                                <th class="p-1">Productos según Gramaje/medida</th>
                                                <th class="text-right p-1">Faltante</th>    
                                            </tr>
                                       </thead>
                                       <tbody>
                                        @php
                                            $clientes  =  DB::select("SELECT name , g , SUM(saldo) as cantidad  FROM orders , inventories WHERE saldo < -500 AND inventories.id_material = orders.id_material GROUP BY name , g ORDER BY g ");  
                                        @endphp
                                            @foreach($clientes as $cliente)
                                            <tr>
                                                <td class="p-1">{{ $cliente->name}}</td>
                                                <td  class="text-red p-1" align="right">{{ $cliente->cantidad}} Kg</td>
                                            </tr>
                                            @endforeach
                                       </tbody>
                                    </table>
                               </div>
                           </div>
                       </div> 
                       <div class="col-4">
                           <div class="card">
                               <div class="card-body" style=" max-height: 392px;overflow-y: auto;">
                                   <table class="table">
                                       <thead>
                                            <tr>
                                                <th class="p-1">Productos menores de -500Kg</th>
                                                <th class="text-right p-1">Faltante</th>    
                                            </tr>
                                       </thead>
                                       <tbody>
                                        @php
                                            $clientes  =  DB::select("SELECT name , g , SUM(saldo) as cantidad  FROM orders , inventories WHERE saldo between -500 and 0 AND inventories.id_material = orders.id_material GROUP BY name , g ORDER BY g ");  
                                        @endphp
                                            @foreach($clientes as $cliente)
                                            <tr>
                                                <td class="p-1">{{ $cliente->name}}</td>
                                                <td  class="text-red p-1" align="right">{{ $cliente->cantidad}} Kg</td>
                                            </tr>
                                            @endforeach
                                       </tbody>
                                    </table>
                               </div>
                           </div>
                           <div class="card">
                               <div class="card-body">
                                   <table class="table">
                                       <thead>
                                            <tr>
                                                <th class="p-1">Marcas</th>
                                                <th class="text-right p-1">Cantidad de productos</th>    
                                            </tr>
                                       </thead>
                                       <tbody>
                                        
                                            @foreach($nMarcas as $cliente)
                                            <tr>
                                                <td class="p-1">{{ $cliente->marca}}</td>
                                                <td class="p-1" align="right">{{ $cliente->cantidad}}</td>
                                            </tr>
                                            @endforeach
                                       </tbody>
                                    </table>
                                   
                               </div>
                           </div>
                       </div> 
                </div>
        </div>
        <div class="card">
            <div class="card-body">
                <center>
                    <h4><img src="{{asset('assets/img/artificial-intelligence.png')}}"  width="50" /> GENERACIÓN DE ESCENARIOS</h4>
                </center>
            </div>
        </div>

        <div class="row">
            @foreach($escenarios as $gramaje => $grupos)
            <div class="col-md mb-4 mb-md-0">
                <div class="accordion mt-3" id="accordionExample{{ $gramaje }}">
                    <div class="card accordion-item">
                      <h2 class="accordion-header" id="headingOne{{ $gramaje }}">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionOne{{ $gramaje }}" aria-expanded="false" aria-controls="accordionOne{{ $gramaje }}">
                            <h3>Gramaje: {{ $gramaje }} GSM</h3>
                        </button>
                      </h2>

                    @foreach($grupos as $grupo)
                    <div id="accordionOne{{ $gramaje }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample{{ $gramaje }}">
                        <div class="accordion-body">
                            <h5 class="mb-0">
                                Eficiencia: {{ number_format($grupo['eficiencia'], 2) }}%
                                <small class="text-muted">
                                    (Ancho utilizado: {{ $grupo['total_cm'] }} cm / {{ $maxRebobinadora }} cm)
                                </small>
                            </h5>
                        <table class="table table-bordered escenario-table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>PRODUCTO</th>
                                        <th>COD. ART.</th>
                                        <th>DESCRIPCION</th>
                                        <th>GRAMAGE</th>
                                        <th># BOBINA</th>
                                        <th>ANCHO (CM)</th>
                                        <th class="bg-unibol text-white">LARGO (M)</th>
                                        <th class="bg-unibol text-white">M2</th>
                                        <th class="bg-unibol text-white" >PESO TOTAL (KG)</th>
                                        <th>TOTAL (CM)</th>
                                        <th>COSTO %</th>
                                        <th>CANT. POR</th>
                                        <th>CANT. PED (KG)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($grupo['productos'] as $index => $producto)
                                    <tr class="{{ $index === 0 ? 'principal' : 'coproducto' }}">
                                        <td>{{ $index === 0 ? 'PRINCIPAL' : 'COPRODUCTO '.$index }}</td>
                                        <td>{{ $producto['codigo'] }}</td>
                                        <td>{{ $producto['descripcion'] }}</td>
                                        <td>{{ $producto['gramaje'] }}</td>
                                        <td>{{ $producto['bobinas'] }}</td>
                                        <td>{{ $producto['ancho'] }} CM</td>
                                        <td>{{ number_format((($producto['largo'] / 100)),0) }} M</td>
                                        <td>{{ number_format($producto['m2'], 0) }}</td>
                                        <td>{{ number_format($producto['peso_total'], 0) }}</td>
                                        <td>{{ $producto['total_cm'] }} CM</td>
                                        <td>{{ number_format($producto['costo'], 2) }}%</td>
                                        <td>{{ number_format($producto['cantidad'] / $grupo['peso_total'], 4) }}</td>
                                        <td>{{ number_format($producto['cantidad'], 0) }}</td>   
                                    </tr>
                                    @endforeach
                                    @for($i = count($grupo['productos']); $i < 4; $i++)
                                    <tr class="coproducto">
                                        <td>COPRODUCTO {{ $i + 1 }}</td>
                                        <td colspan="12" class="text-center">-</td>
                                    </tr>
                                    @endfor
                                </tbody>
                            </table>

                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <table class="table table-sm table-bordered">
                                        <tr>
                                            <th>ANCHO CALCULADO</th>
                                            <td>{{ $grupo['total_cm'] }} CM</td>
                                            <td>{{ number_format($grupo['eficiencia'], 2) }}%</td>
                                        </tr>
                                        <tr>
                                            <th>ANCHO DISPONIBLE (REBOBINADORA)</th>
                                            <td colspan="2">{{ $maxRebobinadora }} CM</td>
                                        </tr>
                                        <tr>
                                            <th>ANCHO DISPONIBLE (PAPELERA)</th>
                                            <td colspan="2">{{ $maxPapelera }} CM</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-4">
                                    <table class="table table-sm table-bordered">
                                        <tr>
                                            <th>CANTIDAD POR (MAQUINA PAPELERA)</th>
                                            <td>{{ number_format($grupo['peso_total'] / 1000, 5) }}</td>
                                        </tr>
                                        <tr>
                                            <th>NUMERO DE BOBINAS</th>
                                            <td>{{ count($grupo['productos']) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div> 
                            <hr>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
@endsection