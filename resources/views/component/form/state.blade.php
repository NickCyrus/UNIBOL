<div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="basic-default-name">{{$label ?? 'Estado' }}</label>
    <div class="col-sm-9">
        <div class="form-check form-switch mb-2">  
            <input class="form-check-input {{$classInput ?? ''}}"  
            @isset($required) required  @endisset 
            type="checkbox" 
            name="state" id="state" value="1" 
            @if (isset($eventAction) && $eventAction == 'new')
                  checked
            @else
                @checkedState($info->state) checked @endcheckedState 
            @endif
            >
            <label class="form-check-label" for="state">Activo</label>
        </div>
        @if ($errors->has($name))
        <x-alert class="alert-danger">
           {!! $errors->first($name) !!}
        </x-alert>
        @endif

    </div>
</div>