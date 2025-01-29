@php
    $uniqId = uniqId()
@endphp
<tr id="tr{{$uniqId}}" class="tr-row-detalle">
    <td>
        <select data-nit="{{getCompany($info->id_company)->nit ?? ''}}" onchange="setNit(this, this.value, 'id_company{{$uniqId}}')" data-uniqid="{{$uniqId}}" onchange="loadCCCONCPTO('{{$uniqId}}', '' , this.value)" style="width: 100%;" class="select2 form-select color-dropdown cabecera id_company row-detalle" name="id_company[]" id="id_company{{$uniqId}}" required>
            <option selected></option>
            @php
                $opc = ['model'=>'ie\IeCompany','key'=>'id', 'data'=>['nit'=>'nit']  , 'label'=>'name' , 'output'=>'option' , 'id'=>$info->id_company ?? ''];
            @endphp
            {!!optionSelect($opc)!!}
        </select>
    </td>
    <td>
        <input data-uniqid="{{$uniqId}}" type="hidden" id="id_income_expenses_details{{$uniqId}}" class="id_income_expenses_details row-detalle" name="id_income_expenses_details[]" value="{{$info->id}}" />
        <input data-uniqid="{{$uniqId}}" type="hidden" id="movement_type{{$uniqId}}" class="id_movement_type row-detalle" name="id_movement_type[]" value="{{$info->id_movement_type}}" />       
        <div style="width: 100%;" class="input-group input-group-merge" id="containerPrice{{$uniqId}}">
            <span  data-uniqid="{{$uniqId}}" id="valor" class="input-group-text movimiento-{{$info->id_movement_type}}" ><i class="bx bx-dollar"></i></span>
            <input data-uniqid="{{$uniqId}}" type="text" id="price{{$uniqId}}" name="price[]" onblur="checkMoviment(this, '{{$uniqId}}')"
             class="row-detalle form-control text-right money cabecera price movimiento-{{$info->id_movement_type}} " id="valor" data-star="{{$info->price ?? ''}}" value="{{$info->price ?? ''}}" required>
        </div>
    </td>
    <td>
        <select  data-uniqid="{{$uniqId}}" data-nit="{{getThirdparty($info->id_thirdparti)->nit ?? ''}}" onchange="setNit(this, this.value, 'id_thirdparti{{$uniqId}}')" style="width: 100%;" class="form-select id_thirdparti row-detalle" name="id_thirdparti[]" id="id_thirdparti{{$uniqId}}"  required >
            <option selected></option>
            @php
                $opc = ['model'=>'ie\IeThirdparty','key'=>'id','label'=>'name' , 'data'=>['nit'=>'nit'] , 'output'=>'option' , 'id'=>$info->id_thirdparti ?? ''];
            @endphp
            {!!optionSelect($opc)!!} 
        </select>
    </td>
    <td>
        <select data-uniqid="{{$uniqId}}" data-uniqid="{{$uniqId}}" style="width: 100%;" class="form-select select2 id_classification row-detalle" name="id_classification[]" id="id_classification{{$uniqId}}" required onchange="loadCCCONCPTO('{{$uniqId}}', '' , this.value)">
            <option selected></option>
                @php
                    $opc = ['model'=>'ie\IeClassification','key'=>'id','label'=>'name' , 'output'=>'option'];
                    if ($info->id_classification) $opc['id'] = $info->id_classification;
                @endphp
            {!!optionSelect($opc)!!}
        </select>
    </td>
    <td>  
        <select data-uniqid="{{$uniqId}}" style="width: 100%;" class="form-select select2 id_cost_centers @if (!in_array( $info->id_classification , ["2","9","8"])) row-detalle @endif " name="id_cost_centers[]" id="id_cost_centers{{$uniqId}}" 
            @if (!in_array( $info->id_classification , ["2","9","8"]))
        required 
            @endif >
           @if ($info->id_cost_centers) 
                @php
                $opc = ['model'=>'ie\IeCostCenter','key'=>'id','label'=>'code' , 'output'=>'option'];

                if ($info->id_cost_centers) $opc['id'] = $info->id_cost_centers;

                if (isset($info->id_classification)){
                    $subWhere = "( SELECT id_cost_center FROM ie_cost_center_type_classifications WHERE id_classification = $info->id_classification ) ";
                    $opc['where'] = "id IN ($subWhere) AND id_company = $info->id_company";
                }
                @endphp
               
             {!!optionSelect($opc)!!}
            @endif
        </select>
    </td>
    <td>
        <select data-uniqid="{{$uniqId}}" style="width: 100%;" class="form-select select2 id_concept row-detalle" name="id_concept[]" required  id="id_concept{{$uniqId}}" onchange="loadAccountCount('{{$uniqId}}')" >
            @if ($info->id_concept) 
                    @php
                        $opc = ['model'=>'ie\IeConcept','key'=>'id','label'=>'name' , 'output'=>'option'];
                        if ($info->id_concept) $opc['id'] = $info->id_concept;
                        if (isset($info->id_classification)){
                            $opc['where'] = "id_classification = {$info->id_classification} ";
                        }
                    @endphp
                    {!!optionSelect($opc)!!}
            @endif

        </select>
    </td>
    <td>
            
            <select data-uniqid="{{$uniqId}}" style="width: 100%; font-size: 0.8175rem;" class="form-select select2 id_ledgeraccount row-detalle" name="id_ledgeraccount[]" required  id="id_ledgeraccount{{$uniqId}}" >
                @if ($info->id_concept) 
                    @php
                        $opc = ['model'=>'ie\IeLedgeraccount','key'=>'id','label'=>'name' , 'output'=>'option', 'where'=> " id_concept = $info->id_concept "];
                        if ($info->id_ledgeraccount) $opc['id'] = $info->id_ledgeraccount;
                    @endphp
                    {!!optionSelect($opc)!!}
                @endif
                    
            </select>
    </td>
    <td>
        @php
            if($info->id_classification == 6) 
            $DisplayRemo = 'display:none';
            else       
            $DisplayRemo = ''; 
        @endphp
        <a href="#" style="{{$DisplayRemo}}" class="color-red"  onclick="removeDetails('tr{{$uniqId}}', '{{$info->id}}')"><i class='bx bx-trash'></i></a>
    </td>
</tr>