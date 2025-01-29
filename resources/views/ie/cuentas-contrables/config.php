<?php

    $data['model'] = 'App\Models\ie\IeLedgeraccount';
    $data['title'] = 'Cuentas Contable';
    $data['table']['head'] = ["TIPO DE MOVIMIENTO", "CLASIFICACIÓN","CONCEPTO", "CUENTA CONTABLE","ESTADO",''];
    $data['table']['body'] = ["movement","classification","concept_name","name","estado"=>['wrap'=>'<span class="badge bg-transparent">%s</span>']];

    
    $campos[] = ['name'=>'id', 'type'=>'hidden' ,  'classInput'=>'' ];
    $campos[] = ['name'=>'name', 'label'=>'Nombre' , 'required'=>true , 'classInput'=>'' , 'autofocus'=>true];
    $campos[] = ['name'=>'id_concept', 'type'=>'select' , 'label'=>'Concepto',  'required'=>true , 'classInput'=>'' ,
                            'options'=>optionSelect(['key'=>'id', 
                            'label'=>'name', 
                            'model'=>'ie\IeConcept']
                            )];

    $campos[] = ['type'=>'state','name'=>'state'];

    $data['campos'] = $campos;
    $data['form']   = $data['campos'];
    
    $data['validate'] = [
                            'name'=> ['required', 'unique:ie_ledgeraccount,name,{id},id']
                        ];
    $data['validateMSG'] = [
                            'name.unique'=> ['Lo sentimos ya existe un registro con esté dato.']
                           ];

    