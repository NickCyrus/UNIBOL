<?php

    $data['model'] = 'App\Models\ie\IeConcept';
    $data['title'] = 'Conceptos Financieros';
    $data['table']['head'] = ['ID',"MOVIMIENTO","CLASIFICACIÓN","CONCEPTO","ESTADO",''];
    $data['table']['body'] = ['id',"movement","classification","name","estado"=>['wrap'=>'<span class="badge bg-transparent">%s</span>']];

    
    $campos[] = ['name'=>'id', 'type'=>'hidden' ,  'classInput'=>'' ];
    

    $campos[] = ['name'=>'id_classification', 'type'=>'select' , 'label'=>'Clasificación',  'required'=>true , 'classInput'=>'' ,
    'options'=>optionSelect(['key'=>'id', 
                            'label'=>'name', 
                            'model'=>'ie\IeClassification']
                            )
   ];

   $campos[] = ['name'=>'id_movement_type', 'type'=>'select' , 'label'=>'Tipo de movimiento',  'required'=>true , 'classInput'=>'' ,
                 'options'=>optionSelect(['key'=>'id', 
                            'label'=>'name', 
                            'model'=>'ie\IeMovementType']
                            )
                ];



    $campos[] = ['name'=>'name', 'label'=>'Concepto' , 'required'=>true , 'classInput'=>'' , 'autofocus'=>true];
    $campos[] = ['type'=>'state','name'=>'state'];

    $data['campos'] = $campos;
    $data['form'] = $data['campos'];
    
    $data['validate'] = [
                            'name'=> ['required', 'unique:ie_concepts,name,{id},id'],
                        ];
    $data['validateMSG'] = [
                            'name.unique'=> ['Lo sentimos ya existe un registro con esté dato.'],
                            'abbreviation.unique'=> ['Lo sentimos ya existe un registro con esté dato.']
                           ];
 