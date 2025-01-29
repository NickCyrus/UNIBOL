@if (is_array($field))

    @if (isset($field['wrap']))
        {!!sprintf($field['wrap'], $row->$key )!!}
    @elseif (isset($field['option']))
        {!!$field['option'][$row->$key]!!}
    @endif

@else

    {!!$row->$field!!}

@endif