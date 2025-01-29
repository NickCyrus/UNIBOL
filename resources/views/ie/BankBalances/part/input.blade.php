<div class="align-items-center d-flex justify-content-end" style="{{$style ?? ''}}">

    @if (!$row && !$preview)
        <input autocomplete="off" data-row="row-{{$company->id}}-{{$account->account->id}}" 
        class="form-control calcular-row row-item-{{$company->id}}  {{$class ?? ''}} {{$name ?? ' '}}" 
        id="row-input-{{uniqId()}}{{uniqId()}}" 
        placeholder="{{ $placeholder ?? ' $ -' }}"
        name="{{$name ?? ' '}}"  />    
    @else

        @if (can('edit') && !$preview)

            <input autocomplete="off" data-row="row-{{$company->id}}-{{$account->account->id}}" 
            class="form-control calcular-row row-item-{{$company->id}}  {{$class ?? ''}} {{$name ?? ' '}}" 
            id="row-input-{{uniqId()}}{{uniqId()}}" 
            value="{{str_replace('.',',',$row->$name)}}"
            placeholder="{{ $placeholder ?? ' $ -' }}"
            name="{{$name ?? ' '}}"  />   

        @else
         
            @if ($name == 'saldo_9')
                    <div class="box-center align-items-center d-flex justify-content-center">  {{$row->$name ?? 0}}</div>
            @else
                    <div class="box-currency align-items-center d-flex justify-content-end">  @currency($row->$name ?? 0)</div>
            @endif

        @endif
        
    @endif
 </div> 