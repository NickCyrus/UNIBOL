<div class="my-4">
    <a class="btn btn-danger" href="{{route("{$slug}")}}">Cancelar</a>
        @canEdit
            <button class="btn btn-success"><i class='bx bx-save' ></i> Guardar</button>  
        @endcanEdit
</div>