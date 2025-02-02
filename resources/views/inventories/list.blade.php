<table class="table table-striped dn-table dt-responsive">
            <thead>
                <tr>
                    <th>Material ID</th>
                    <th>Nombre</th>
                    <th>Kilogramos "KG"</th>
                    <th>Centimetros "CM"</th>
                    <th>Libras "LB"</th>
                    <th>Gramos "G"</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inventories as $inventory)
                    <tr>
                        <td>{{ $inventory->id_material }}</td>
                        <td>{{ $inventory->name }}</td>
                        <td>{{ $inventory->kg }}</td>
                        <td>{{ $inventory->cm }}</td>
                        <td>{{ $inventory->lb }}</td>
                        <td>{{ $inventory->g }}</td>
                        <td>{{ $inventory->stock }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
