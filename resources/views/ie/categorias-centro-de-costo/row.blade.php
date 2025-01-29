@if ($rows->count())
    @forelse($rows  as $row)
    @php
        $tabulador = tabulador($row->nivel);
    @endphp
    <tr>
        <td>{!!$row->company!!}</td>
        <td>{!!$row->tdcc!!}</td>
        <td>{!!$tabulador!!} {!!$row->code!!}</td>
        <td>{!!$row->name!!}</td>
        <td class="text-center">{!!$row->nivel!!}</td>
        <td>{!!$row->padre!!}</td>
        <td>{!!$row->pptp!!}</td>
        <td>{!!$row->slugcomp!!}</td>
        
        <td>{{$row->estado}}</td>
        <td>
            @includeIf("ie.categorias-centro-de-costo.table.event",['slug'=>$slug])
            @include('component.btn-table-event',['slug'=>$slug, 'view'=>'icon'])
        </td>
    </tr>
        @if ($row->childs->count())
                @include('ie.categorias-centro-de-costo.row' , ['rows'=>$row->childs->get()])
        @endif
    @empty
    @endforelse
@endif