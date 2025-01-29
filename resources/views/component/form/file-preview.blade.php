@php
 $uniqid = uniqId();    
@endphp
<div class="row mb-3">
    <label class="col-sm-2 col-form-label">{{$label ?? ''}}</label>
    <div class="col-sm-10">
        <div class="row">
            @if (isset($info->$name) && $info->$name)
                <div class="col-sm-2">
                        <div class="preview-img">
                            <img class="img-fluid" src="{{asset($info->$name)}}" />
                        </div>
                </div>
            @endif
            <div class="@if (isset($info->$name) && $info->$name ) col-sm-10 @else col-sm-12 @endif">
                    <div class="input-group input-group-merge">
                        @isset($classIcon)
                        <span class="input-group-text"><i class="{{$classIcon}}"></i></span>
                        @endisset
                        <input type="file" accept="{{$accept ?? '' }}" onclick="{{$onclick ?? ''}}" onblur="{{$onblur ?? ''}}" autocomplete="{{$autocomplete ?? ''}}" @isset($datalist) list="list-{{$uniqid}}" @endisset  @isset($autofocus) autofocus @endisset class="form-control {{$classInput ?? ''}}" name="{{$name ?? '' }}" id="{{$name ?? '' }}" placeholder="{{$placeholder ?? '' }}" @isset($required) required  @endisset> 
                    </div>

                        @if ($errors->has($name))
                        <x-alert class="alert-danger">
                        {!! $errors->first($name) !!}
                        </x-alert>
                        @endif

                        @isset($datalist) 
                        <datalist id="list-{{$uniqid}}">
                            @foreach($datalist as $option)
                            <option>{{$option->option}}</option>
                            @endforeach
                        </datalist>
                        @endisset
                    </div>
            </div>
        </div>
 </div>