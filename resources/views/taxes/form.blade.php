<div class="container py-3">
    <form action="{{route('taxes.save')}}" method="POST">
        @csrf
        <input name="id" value="{{$module->id}}" type="hidden" />
        <div class="row mb-3">
          <label class="col-sm-3 col-form-label" for="basic-default-name">Nombre del impuesto</label>
          <div class="col-sm-9">
            <input type="text" name="name" value="{{$module->name}}" class="form-control" placeholder="" required>
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-3 col-form-label" for="basic-default-name">Orden</label>
          <div class="col-sm-9">
            <input type="text" name="orden" value="{{$module->orden}}" class="form-control on" placeholder="" >
          </div>
        </div>
        <div class="row text-center">
            <div class="col-sm-12">
                <button type="button" onclick="fn.closeModal()" class="btn btn-danger"> <i class='bx bx-window-close' ></i> Cancelar</button>
                <button type="submit" class="btn btn-secondary"> <i class='bx bxs-save' ></i> Guardar</button>
            </div>
        </div>
      </form> 
</div>
<script>
  fn.applyPlugins()
</script>