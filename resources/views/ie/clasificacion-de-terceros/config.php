<?php

    $data['model'] = 'App\Models\ie\IeThirdClasification';
    $data['title'] = 'Clasificación de Terceros';
    $data['table']['head'] = ['ID',"NOMBRE","ABREVIATURA","ESTADO",''];
    $data['table']['body'] = ['id',"name","abbreviation","estado"=>['wrap'=>'<span class="badge bg-transparent">%s</span>']];

     
    $campos[] = ['name'=>'id', 'type'=>'hidden' ,  'classInput'=>'' ];
    $campos[] = ['name'=>'name', 'label'=>'Nombre',  'required'=>true , 'classInput'=>'' , 'autofocus'=>true ];
    $campos[] = ['name'=>'abbreviation', 'label'=>'Abreviatura',  'required'=>true , 'classInput'=>''  ];
    
    $campos[] = ['type'=>'state','name'=>'state'];

    $data['campos'] = $campos;
    $data['form']   = $data['campos'];
    
    $data['validate'] = [
                            'name'=> ['required', 'unique:ie_third_clasifications,name,{id}']
                        ];
    $data['validateMSG'] = [
                            'name.unique'=> ['Lo sentimos ya existe un registro con este dato.']
                           ];
 