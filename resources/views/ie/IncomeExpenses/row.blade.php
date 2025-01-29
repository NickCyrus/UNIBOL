@php
    $uniqId = uniqId();
    setlocale(LC_ALL, 'es_ES');
@endphp


<tr id="padre-{{$uniqId}}" onclick="openHijo('{{$uniqId}}')" class="hand padre">
    <td>{{$row->code}}</td>
    <td>{{$row->company}}</td>
    <td>{{format_date($row->date_income_expenses)}}</td>
    <!-- <td>{{$row->movement_type}}</td> !-->
    <td class="text-right"><span class="movimiento-{{$row->id_movement_type}} p-movimiento">$ {{money($row->price)}}</span></td>
    <td>{{$row->tercero->name}}</td>
    <td align="center">{{$row->doc_complete}}</td>
    <td align="center">{{$row->con_complete}}</td>
    <td>{{$row->account}}</td>
    <td>{{$row->observation}}</td>
    <td align="center">{{($row->details_moviment->count() < 10 ) ? '0'.$row->details_moviment->count() : $row->details_moviment->count()}}</td>
</tr>
<tr id="hijo-{{$uniqId}}" class="hidden hijo">
        <td colspan="11">
            <div class="card my-2 bg-light-grey"> 
                <div class="card-body p-2"> 
                    
                    <div class="wrap-table shadow ">
                         <i onclick="closeHijo('{{$uniqId}}')" class='pull-right bx bx-window-close hand mr-3' ></i> 
                         @canEdit
                            <form class="pull-right" action="{{route('registro-ingresos-egresos.edit', ['id'=>$row->id])}}" method="POST">
                                @csrf
                                <input type="hidden" id="" name="id" value="{{$row->id}}" />
                            
                                    <button style="background: transparent;border: none;padding: 0px;margin: 0px 5px;"><i class='bx bx-pencil' ></i></button>
                            </form>
                        @endcanEdit
                        <table class="table table-sm">
                                <tr>
                                    <td>{{$row->code}}</b></td>
                                    <td>{!!$row->movement_type!!}</b></td>
                                    <td>{{$row->company}}</b></td>
                                    <td><span class="movimiento-{{$row->id_movement_type}} p-movimiento">$ {{money($row->price)}}</span></td>
                                    <td>{{$row->thirdpartie->name}} <spam class="nit">NIT {{$row->thirdpartie->nit}}</spam></td>
                                    <td align="right">{{date_complete($row->date_income_expenses)}}</td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        @if ($row->doc)
                                            <div class="tag">{{$row->doc_complete}}</div>
                                        @endif
                                        @if ($row->con)
                                            <div class="tag">{{$row->con_complete}}</div>
                                        @endif
                                        @if ($row->observation)
                                            <div class="tag">{{strtoupper($row->observation)}}</div>
                                        @endif
                                    </td>
                                    <td align="right">{{$row->ie_account->name}} ({{$row->ie_account->account}})</td>
                                </tr>
                        </table>
                    </div>
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>EMPRESA</th>
                                <th class="text-right">VALOR</th>
                                <th>TERCERO</th>
                                <th>CLASIFICACIÓN</th>
                                <th>C.C</th>
                                <th>CONCEPTO</th>
                                <th>CUENTA CONTABLE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($row->details_moviment->count())
                                @foreach($row->details_moviment->orderby('id')->get() as $movi)
                            <tr>
                                <td>{{$movi->company}}</td>
                                <td class="text-right"><span class="movimiento-{{$movi->id_movement_type}}">$ {{money($movi->price)}}</span></td>
                                <td>{{$movi->tercero->name}} <span style="margin-left:5px ; font-size: 9px">NIT. {{$movi->tercero->nit}}</span></td>
                                <td>{{$movi->clasificacion->name}}</td>
                                <td>{{$movi->cen_cos->code}}</td>
                                <td>{{$movi->concepto->name}}</td>
                                <td>{{$movi->cuenta_cont->name}}</td>
                            </tr>
                                @endforeach
                            @endif
                        </tbody> 
                    </table> 
                </div>
            </div>
        </td>
</tr>
