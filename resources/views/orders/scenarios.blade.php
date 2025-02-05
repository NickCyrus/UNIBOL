@extends('app')

@section('content')
        <div class="card">
            <div class="card-body">
                 <h4>Escenarios de Producción</h4>
<div class="card-body">
            @foreach($escenarios as $gramaje => $grupos)
            <div class="escenario-gramaje mb-5">
                <h3 class="text-secondary mb-4">
                    Gramaje: {{ $gramaje }} GSM
                </h3>

                @foreach($grupos as $grupo)
                <div class="escenario-group card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">
                            Eficiencia: {{ number_format($grupo['eficiencia'], 2) }}%
                            <small class="text-muted">
                                (Ancho utilizado: {{ $grupo['total_cm'] }} cm / {{ $maxRebobinadora }} cm)
                            </small>
                        </h5>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered escenario-table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>PRODUCTO</th>
                                    <th>COD. ART.</th>
                                    <th>DESCRIPCION</th>
                                    <th>GRAMAGE</th>
                                    <th># BOBINA</th>
                                    <th>ANCHO (CM)</th>
                                    <th>TOTAL (CM)</th>
                                    <th>COSTO %</th>
                                    <th>CANT. POR</th>
                                    <th>CANT. PED (KG)</th>
                                    <th>LARGO (CM)</th>
                                    <th>M2</th>
                                    <th>PESO TOTAL (KG)</th>
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
                                    <td>{{ $producto['total_cm'] }} CM</td>
                                    <td>{{ number_format($producto['costo'], 2) }}%</td>
                                    <td>{{ number_format($producto['cantidad'] / $grupo['peso_total'], 4) }}</td>
                                    <td>{{ number_format($producto['cantidad'], 2) }}</td>
                                    <td>{{ number_format($producto['largo'] * 100, 2) }} CM</td>
                                    <td>{{ number_format($producto['m2'], 2) }}</td>
                                    <td>{{ number_format($producto['peso_total'], 2) }}</td>
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
                                        <th>GRAMAJE SOLICITADO</th>
                                        <td>{{ $gramajeCliente }} GSM</td>
                                    </tr>
                                    <tr>
                                        <th>DIAMETRO SOLICITADO</th>
                                        <td>{{ $diametroCliente }} CM</td>
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
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection