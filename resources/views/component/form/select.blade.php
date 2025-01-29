@php
 $uniqid = uniqId();   
 $selected = ''; 
@endphp
<div class="row mb-3">
    <label class="col-sm-2 col-form-label">{{$label ?? ''}}</label>
    <div class="col-sm-10">
      <div class="input-group input-group-merge">
        
        @isset($classIcon)
          <span class="input-group-text"><i class="{{$classIcon}}"></i></span>
        @endisset
        
        

        <select autocomplete="{{$autocomplete ?? ''}}" onchange="{{$onchange ?? ''}}" @isset($multiple) multiple @endisset class="form-select select2 {{$classInput ?? ''}}"  name="{{$name ?? '' }}@isset($multiple)[]@endisset" id="{{$name ?? '' }}" data-placeholder="{{$placeholder ?? '' }}" 
            
        @isset($autofocus) autofocus @endisset 
        @isset($required) required  @endisset >
            <option seleted value="">{{$placeholder ?? '' }}</option>

            @if (isset($options))
                @foreach($options as $option)
                    @php
                    
                        if (isset($info->$name)){
                            if (is_array($info->$name)){
                                $selected  = (in_array($option->keyID, $info->$name)  ) ? 'selected' : '';
                            }elseif ($info->$name == $option->keyID || $option->keyID  == request()->$name){ 
                                $selected  = 'selected';
                            }else{
                                $selected  = ''; 
                            }
                        }

                        if (!$selected){
                                if (isset($request)){
                                    $selected  = ($option->keyID  == request()->$name) ? 'selected' : '';
                                }
                        }

                    @endphp
                    <option value="{{$option->keyID}}" {{$selected}}>{{$option->label}}</option>
                    @php $selected = '' @endphp
                @endforeach
            @endif

        </select>

        

      </div>

        @if ($errors->has($name))
        <x-alert class="alert-danger">
           {!! $errors->first($name) !!}
        </x-alert>
        @endif

        

     
    </div>
 </div>