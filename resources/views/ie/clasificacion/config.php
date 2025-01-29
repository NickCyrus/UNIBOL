<?php

    $data['model'] = 'App\Models\ie\IeClassification';
    $data['title'] = 'Clasificación';
    $data['table']['head'] = ['ID',"Clasificación","ESTADO",''];
    $data['table']['body'] = ['id',"name","estado"=>['wrap'=>'<span class="badge bg-transparent">%s</span>']];

    
    $campos[] = ['name'=>'id', 'type'=>'hidden' ,  'classInput'=>'' ];
    $campos[] = ['name'=>'name', 'label'=>'Clasificación' , 'required'=>true , 'classInput'=>'' , 'autofocus'=>true];
    
    /*
    $campos[] = ['name'=>'id_movement_type', 'type'=>'select' , 'label'=>'Tipo de movimiento',  'required'=>true , 'classInput'=>'' ,
                 'options'=>optionSelect(['key'=>'id', 
                            'label'=>'name', 
                            'model'=>'ie\IeMovementType']
                            )
                ];
    
    
    $campos[] = ['name'=>'id_cost_center_type_classifications', 
                'type'=>'select', 
                'multiple'=>true , 
                'label'=>'Centros de costo',
                'required'=>true ,
                'classInput'=>'' ,
                'options'=>optionSelect(['key'=>'id', 
                                         'label'=>'code', 
                                         'model'=>'ie\IeCostCenter'])
               ];
               */
   $data['except']      = ['id_cost_center_type_classifications'];
   $data['callEndSave'] = true;


    $campos[] = ['type'=>'state','name'=>'state'];
    $data['campos'] = $campos;
    $data['form'] = $data['campos'];
     

    $data['validate'] = [
                            'name'=> ['required', 'unique:ie_classifications,name,{id},id,id_movement_type,{id_movement_type}'],
                        ];
    $data['validateMSG'] = [
                            'name.unique'=> ['Lo sentimos ya existe un registro con esté dato.'],
                             
                           ];
 