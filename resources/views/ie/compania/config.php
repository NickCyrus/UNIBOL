<?php

    $data['model'] = 'App\Models\ie\IeCompany';
    $data['title'] = 'Compañia';

    $data['viewPath'] = 'ie.compania';

    $data['table']['head'] = ['ID',"NIT","LOGO","NOMBRE","EMAIL","TELÉFONO","DIRECCIÓN","ESTADO",''];
    $data['table']['body'] = ['id',"nit","logo_preview", "name","email","cellphone","address","estado"=>['wrap'=>'<span class="badge bg-transparent">%s</span>']];

    $campos[] = ['name'=>'id', 'type'=>'hidden' ,  'classInput'=>'' ];
    $campos[] = ['name'=>'nit', 'label'=>'NIT' , 'required'=>true , 'classInput'=>'' , 'autofocus'=>true];
    $campos[] = ['name'=>'name', 'label'=>'Nombre', 'required'=>true , 'classInput'=>'' ];
    $campos[] = ['name'=>'email', 'type'=>'email' ,  'label'=>'Email',  'classInput'=>'' ];
    $campos[] = ['name'=>'logo', 'label'=>'Logo' , 'classInput'=>'' ,  'type'=>'file-preview', 'accept'=>'image/*' ];
    $campos[] = ['name'=>'color', 'label'=>'Color' , 'classInput'=>'' ,  'type'=>'color' ];
    $campos[] = ['name'=>'cellphone', 'label'=>'Teléfono',  'classInput'=>'' ];
    $campos[] = ['name'=>'address', 'label'=>'Dirección',  'classInput'=>'' ];
    $campos[] = ['type'=>'state','name'=>'state']; 

    $data['campos'] = $campos;
    $data['form']   = $data['campos'];
    
    $data['validate'] = [
                            'nit'=> ['required', 'unique:ie_companies,nit,{id}']
                        ];
    $data['validateMSG'] = [
                            'nit.unique'=> ['Lo sentimos ya existe un NIT registrado con este dato.']
                           ];
 