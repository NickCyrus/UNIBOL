@php
 $uniqid = uniqId();    
@endphp
<div class="row mb-3">
    <label class="col-sm-2 col-form-label">{{$label ?? ''}}</label>
    <div class="col-sm-10">
        <div class="row">
            
            <div class="col-sm-1 ">
                    <div class="input-group input-group-merge">
                        @isset($classIcon)
                        <span class="input-group-text"><i class="{{$classIcon}}"></i></span>
                        @endisset
                        <input type="color"  value="{{ old( $name, $info->$name ?? '' ) }}" onclick="{{$onclick ?? ''}}" onblur="{{$onblur ?? ''}}" name="{{$name ?? '' }}" id="{{$name ?? '' }}" value="{{$placeholder ?? '' }}" @isset($required) required  @endisset> 
                    </div>
            </div>
        </div>
 </div>