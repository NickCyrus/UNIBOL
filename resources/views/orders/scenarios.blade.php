@extends('app')

@php
  $nClientes    = DB::select("SELECT DISTINCT(solicitante) FROM orders , inventories WHERE saldo < 0 AND inventories.id_material = orders.id_material ORDER BY g ");  
  $nProductos   = DB::select("SELECT DISTINCT(orders.id_material)  FROM orders , inventories WHERE saldo < 0 AND inventories.id_material = orders.id_material ORDER BY g ");  
  $nMarcas      = DB::select("SELECT DISTINCT(orders.marca)  FROM orders , inventories WHERE saldo < 0 AND inventories.id_material = orders.id_material ORDER BY g ");  
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
                            <div class="card bg-warning text-white">
                                <div class="card-body info">
                                        <div class="leyend">Kilogramos pendiente</div>
                                        <div class="valor">{{$kgPendientes}} Kg</div>
                                </div>  
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card bg-info text-white">
                                <div class="card-body info">
                                        <div class="leyend"># Clientes</div>
                                        <div class="valor">{{count($nClientes)}}</div>
                                </div>  
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card bg-success text-white">
                                <div class="card-body info">
                                        <div class="leyend">Tipos de Materiales</div>
                                        <div class="valor">{{count($nProductos)}}</div>
                                </div>  
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card bg-primary text-white">
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
                                                <th>Cliente</th>
                                                <th align="right">Faltante</th>    
                                            </tr>
                                       </thead>
                                       <tbody>
                                        @php
                                            $clientes  =  DB::select("SELECT solicitante , SUM(saldo) cantidad FROM orders  WHERE saldo < 0 GROUP BY solicitante ORDER BY saldo ASC");  
                                        @endphp
                                            @foreach($clientes as $cliente)
                                            <tr>
                                                <td>{{ $cliente->solicitante}}</td>
                                                <td class="text-red" align="right">{{ $cliente->cantidad}} Kg</td>
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
                                                 <th>Productos según Gramaje/medida</th>
                                                 <th align="right">Faltante</th>    
                                             </tr>
                                        </thead>
                                        <tbody>
                                         @php
                                             $clientes  =  DB::select("SELECT `name` , g , SUM(saldo) as cantidad  FROM orders , inventories WHERE saldo < 0 AND inventories.id_material = orders.id_material GROUP BY `name` , g ORDER BY g ");  
                                         @endphp
                                             @foreach($clientes as $cliente)
                                             <tr>
                                                 <td>{{ $cliente->name}}</td>
                                                 <td class="text-red" align="right">{{ $cliente->cantidad}} Kg</td>
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
                                </div>
                            </div>
                        </div> 
                 </div>
            </div>
        </div>
@endsection