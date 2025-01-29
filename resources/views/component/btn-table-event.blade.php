@php if (!isset($view)) $view = 'dropdown'; @endphp

@switch($view)
    @case('dropdown')
        <div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                @canEdit
                    <a class="dropdown-item hand" href="{{route("{$slug}.edit",['id'=>$row->id])}}"><i class="bx bx-edit-alt me-1"></i> Editar</a>
                @endcanEdit
                @canDel
                    <a class="dropdown-item hand confirm" data-q='¿Desea eliminar este modulo?' href="{{route("{$slug}.delete",['id'=>$row->id])}}"><i class="bx bx-trash me-1"></i> Borrar </a>
                @endcanDel
                </div>
        </div>    
    @break
    @case('icon')
       
        @canDel
            <a class="hand confirm color-danger f-left" data-q='¿Desea eliminar este registro?' href="{{route("{$slug}.delete",['id'=>$row->id])}}"><i class="bx bx-trash me-1"></i> </a>
        @endcanDel

        @canEdit
        <a class="hand f-left" href="{{route("{$slug}.edit",['id'=>$row->id])}}"><i class="bx bx-edit-alt "></i></a>
        @endcanEdit

    @break
    @default
        
@endswitch

