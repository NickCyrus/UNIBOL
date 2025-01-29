<tr>
    <td>
        {{$row->code}} @if ($row->name) - {{ $row->name}} @endif
    </td>
    <td>
        @include('component.btn-table-event',['view'=>'icon'])
    </td>
</tr>
@if($row->childs->count())
    @foreach($row->childs->get() as $info)
        @include('ie.sub-centros-de-costos.tr-row',['slug'=>'sub-centros-de-costos', 'view'=>'icon', 'row'=>$info])     
    @endforeach
@endif
    
    