<?php

    $data['model'] = 'App\Models\ie\IeAccountType';
    $data['title'] = 'Tipo de cuentas';
    $data['viewPath'] = 'ie.tipo-de-cuentas'; 
    $data['table']['head'] = ['ID',"TIPO","ESTADO",''];
    $data['table']['body'] = ['id',"name","estado"=>['wrap'=>'<span class="badge bg-transparent">%s</span>']];

    
    $campos[] = ['name'=>'id', 'type'=>'hidden' ,  'classInput'=>'' ];
    $campos[] = ['name'=>'name', 'label'=>'Tipo' , 'required'=>true , 'classInput'=>'' , 'autofocus'=>true];
    $campos[] = ['type'=>'state','name'=>'state'];

    $data['campos'] = $campos;
    $data['form'] = $data['campos'];
    
    $data['validate'] = [
                            'name'=> ['required', 'unique:ie_account_types,name,{id},id'],
                        ];
    $data['validateMSG'] = [
                            'name.unique'=> ['Lo sentimos ya existe un registro con esté dato.'],
                            'abbreviation.unique'=> ['Lo sentimos ya existe un registro con esté dato.']
                           ];
 