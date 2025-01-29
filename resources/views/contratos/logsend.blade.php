@php
$slug = 'items';
use Carbon\Carbon;
@endphp



    <table class="table table-striped dt-responsive dt-tabla dt-responsive" id="tbl1">
        <thead>
          <tr>
            <th style="width:10px">#</th>
            <th>Fecha</th>
            <th>Enviado por</th>
            <th>Asunto</th>
            <th>Enviado a</th>
            <th>Presupuesto</th>
            <th></th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach($logs  as $log)
              <tr>
                <td>{{$log->id}}</td>
                <td><b>{{Carbon::parse( $log->created_at )->format('d/m/Y  H:i:s')}}</b></td>
                <td><b>{{$log->getUser()}}</b></td>
                <td>{{$log->subjet}}</td>
                <td><b>{{$log->sendTo}}</b></td>
                <td>{{$log->getCotizacion()}}</td>
                <td><button onclick="opendMSG({{json_encode(['msg'=>$log->sendBody])}})" class="btn btn-success hand">Ver mensaje</button></td>
              </tr>
          @endforeach
        </tbody>
    </table>

    <script>

        opendMSG = function(obj){

                fn.openInfo({'content': '<h2>Mensaje enviado :</h2>'+obj.msg , class : 'col-md-8' })

        }
