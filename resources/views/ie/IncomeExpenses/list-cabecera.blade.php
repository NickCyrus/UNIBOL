<table class="table table-sm">
    <thead>
        <tr>
            <th>CODE</th>
            <th>EMPRESA</th>
            <th>FECHA</th>
            <!-- <th>TIPO MOV</th> !-->
            <th class="text-center">VALOR</th>
            <th>TERCERO</th>
            <th class="text-center">DOC APROB.</th>
            <th class="text-center">DOC CONTABLE.</th>
            <th>CUENTA BANCARIA</th>
            <th>OBSERVACIONES</th>
            <th class="text-center">REGISTROS</th>
        </tr>
    </thead>
    <tbody>
       @if ($cabeceras->count())
            @foreach($cabeceras as $row)
                @include('ie.IncomeExpenses.row')
            @endforeach
       @endif
    </tbody>
    
</table>
<script>
    function openHijo(hijo){
        
        $('.padre').show('hidden')
        $("#padre-"+hijo).hide('hidden')
        $('.hijo').hide('hidden')
        $("#hijo-"+hijo).toggle('hidden')
    }

    function closeHijo(hijo){
        $("#hijo-"+hijo).toggle('hidden')
        $("#padre-"+hijo).show()
    }
    
</script>