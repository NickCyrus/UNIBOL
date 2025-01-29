@php
 $uniqid = uniqId();    
@endphp
<div class="row mb-3">
    <label class="col-sm-2 col-form-label">{{$label ?? ''}}</label>
    <div class="col-sm-10">
        @if ($options)
          @foreach($options as $key => $value )
            @php 
                $radioUniq = uniqId();
            @endphp
           <div class="form-check form-check-inline mt-3">
              <input class="form-check-input" type="radio" @if($key==$info->$name) checked @endif name="{{$name ?? '' }}" id="{{$radioUniq}}" value="{{$key}}" @isset($required) required  @endisset>
              <label class="form-check-label" for="{{$radioUniq}}">{!!$value!!}</label>
           </div>
          @endforeach 
        @endif 

        @if ($errors->has($name))
        <x-alert class="alert-danger">
           {!! $errors->first($name) !!}
        </x-alert>
        @endif
    </div>

 </div>