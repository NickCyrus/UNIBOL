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
                    <th>Cantidad Pendiente</th>
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
                        <td>{{ $order->saldo }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
