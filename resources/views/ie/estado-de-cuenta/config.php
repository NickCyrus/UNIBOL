<?php

    $data['model'] = 'App\Models\ie\IeAccountStatus';
    $data['title'] = 'Estados de cuenta';
    $data['table']['head'] = ['ID',"ESTADO","ESTADO",''];
    $data['table']['body'] = ['id',"name","estado"=>['wrap'=>'<span class="badge bg-transparent">%s</span>']];

    $data['viewPath'] = 'ie.estado-de-cuenta'; 
    
    $campos[] = ['name'=>'id', 'type'=>'hidden' ,  'classInput'=>'' ];
    $campos[] = ['name'=>'name', 'label'=>'Estado de cuenta' , 'required'=>true , 'classInput'=>'' , 'autofocus'=>true];
    $campos[] = ['type'=>'state','name'=>'state'];

    $data['campos'] = $campos;
    $data['form'] = $data['campos'];
    
    $data['validate'] = [
                            'name'=> ['required', 'unique:ie_account_statuses,name,{id},id'],
                        ];
    $data['validateMSG'] = [
                            'name.unique'=> ['Lo sentimos ya existe un registro con esté dato.'],
                            'abbreviation.unique'=> ['Lo sentimos ya existe un registro con esté dato.']
                           ];
 