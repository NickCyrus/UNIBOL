<div class="container py-3">
    <form action="{{route("{$slug}.save")}}" method="POST"  autocomplete="off">
        @csrf
        <input name="id" value="{{$module->id}}" type="hidden" />

        <div class="row mb-3">
          <label class="col-sm-3 col-form-label" for="basic-default-name">{{$firstLabel ?? 'Mano de obra'}}</label>
          <div class="col-sm-9">
            <input type="text" name="name" value="{{$module->name}}" class="form-control" placeholder="" required>
          </div>
        </div>
       
        @if ($type != 1 )
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="basic-default-name">Categría</label>
            <div class="col-sm-9">
              
              @include('component.select', 
              ['name'=>'category', 
              'value'=>$module->category , 
              'tbl'=>'categories' , 
              'label'=>'name',
              'required'=>'required'])
  
            </div>
        </div>
        @endif

        <div class="row mb-3">
          <label class="col-sm-3 col-form-label" for="basic-default-name">Salario més</label>
          <div class="col-sm-9">
            <input type="text" name="value" value="{{$module->value}}" class="form-control on" placeholder="" required  >
          </div>
        </div>

        <div class="row mb-3">
          <label class="col-sm-3 col-form-label" for="basic-default-name">Salario día</label>
          <div class="col-sm-9">
            <input type="text" name="value_day" value="{{$module->value_day}}" class="form-control on" placeholder="" required  >
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