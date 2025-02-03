<table class="table table-striped dn-table dt-responsive">
            <thead>
                <tr>
                    <th>Solicitante</th>
                    <th>Doc. Venta</th>
                    <th>Unidad de Negocio</th>
                    <th>Linea Producto</th>
                    <th>Marca</th>
                    <th>ID Material</th>
                    <th>Nombre Material</th>
                    <th>Cantidad</th>
                    <th>Stock</th>
                    <th>Saldo</th>

                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->solicitante }}</td>
                        <td>{{ $order->doc_venta }}</td>
                        <td>{{ $order->unidad_negocio }}</td>
                        <td>{{ $order->linea_producto }}</td>
                        <td>{{ $order->marca }}</td>
                        <td>{{ $order->id_material }}</td>
                        <td>{{ $order->material_name }}</td>
                        <td>{{ $order->cantidad_pendiente }}</td>
                        <td>{{ $order->inventory->stock ?? 'N/A' }}</td>
                        <td>
                            @if ((int)$order->saldo < 0)
                                <span class="text-red">{{$order->saldo}}</span>
                            @else
                                <span class="text-green">{{$order->saldo}}</span>    
                            @endif
                            </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
