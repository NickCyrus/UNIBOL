@extends('app')

@php
  use App\Http\Controllers\OrderController;
  $nClientes    = DB::select("SELECT DISTINCT(solicitante) FROM orders , inventories WHERE saldo < 0 AND inventories.id_material = orders.id_material ORDER BY g ");  
  $nProductos   = DB::select("SELECT DISTINCT(orders.id_material)  FROM orders , inventories WHERE saldo < 0 AND inventories.id_material = orders.id_material ORDER BY g ");  
  $nMarcas      = DB::select("SELECT DISTINCT(orders.marca)  FROM orders , inventories WHERE saldo < 0 AND inventories.id_material = orders.id_material ORDER BY g ");  
  $nMarcas      = DB::select("SELECT `marca` ,  COUNT(*) as cantidad FROM orders , inventories WHERE saldo < 0 AND inventories.id_material = orders.id_material GROUP BY `marca` ");  
  $kgPendientes =  $query->where('saldo','<',0)->selectRaw("SUM(saldo) as pendente")->first()->pendente;
 // $nClientes    =  $query->where('saldo','<',0)->selectRaw("DISTINCT(solicitante) cliente")->get();
 
@endphp

@section('content')
        <div class="card">
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
                                             $clientes  =  DB::select("SELECT `name` , g , SUM(saldo) as cantidad  FROM orders , inventories WHERE saldo < 0 AND inventories.id_material = orders.id_material GROUP BY `name` , g ORDER BY g ");  
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

                 <div class="row mt-3">
                        <h4>ESCENARIOS</h4>
                        @php
                            $clientes  =  DB::select("SELECT DISTINCT(g) as gramaje FROM orders , inventories WHERE saldo < 0 AND inventories.id_material = orders.id_material  ORDER BY g DESC  LIMIT 1");  
                        @endphp
                        @foreach($clientes as $cliente)
                            <h5>Gramaje {{$cliente->gramaje}}
                             @includeIf("orders.g-{$cliente->gramaje}")
                        @endforeach
                 </div>
                    
                 
                 
                  
            </div>
        </div>
@endsection