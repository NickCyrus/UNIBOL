<?php

    
$data['model'] = 'App\Models\ie\IeThirdparty';
$data['title'] = 'Lista de Terceros';
$data['table']['head'] = ['ID',"CÓDIGO", "NIT","NOMBRE","EMAIL","TELÉFONO","DIRECCIÓN","ESTADO",''];
$data['table']['body'] = ['id',
                          "code"=>['wrap'=>'<span class="badge bg-transparent">%s</span>'],
                          "nit","name","email","cellphone","address",
                          "estado"=>['wrap'=>'<span class="badge bg-transparent">%s</span>']];

$campos[] = ['name'=>'id', 'type'=>'hidden' ,  'classInput'=>'' ];

$campos[] = ['name'=>'id_cat_third', 
                    'type'=>'select', 
                    'multiple'=>true , 
                    'label'=>'Clasificación',
                    'required'=>true ,
                    'classInput'=>'' ,
                    'options'=>optionSelect(['key'=>'id', 
                                            'label'=>'name', 
                                            'model'=>'ie\IeThirdClasification'])
            ];                                              

            
/*
$campos[] = ['name'=>'id_cat_third', 'type'=>'select' , 'label'=>'Tipo de tercero',  'required'=>true , 'classInput'=>'' ,
                     'options'=>optionSelect(['key'=>'id', 
                                              'label'=>'name', 
                                              'model'=>'ie\IeThirdClasification'])];
*/
$campos[] = ['name'=>'id_type_document', 'type'=>'select' , 'label'=>'Tipo de documento',  'required'=>true , 'classInput'=>'' ,
                     'options'=>optionSelect(['key'=>'id', 
                                              'label'=>'name', 
                                              'model'=>'ie\IeThirdTypeDocument'])];


//  


$data['except']      = ['id_cat_third'];
$data['callEndSave'] = true;

$campos[] = ['name'=>'code', 'label'=>'Código único' , 'required'=>true , 'classInput'=>'' , 'autofocus'=>true];
$campos[] = ['name'=>'nit', 'label'=>'NIT' , 'required'=>true , 'classInput'=>'' ];
$campos[] = ['name'=>'name', 'label'=>'Nombre', 'required'=>true , 'classInput'=>'' ];
$campos[] = ['name'=>'email', 'type'=>'email' ,  'label'=>'Email',  'classInput'=>'' ];
$campos[] = ['name'=>'cellphone', 'label'=>'Teléfono',  'classInput'=>'' ];
$campos[] = ['name'=>'address', 'label'=>'Dirección',  'classInput'=>'' ];
$campos[] = ['type'=>'state','name'=>'state']; 

$data['campos'] = $campos;
$data['form']   = $data['campos'];

$data['validate'] = [
                        'nit'=> ['required', 'unique:ie_thirdparties,nit,{id}'],
                        'code'=> ['required', 'unique:ie_thirdparties,code,{id}']
                    ];
$data['validateMSG'] = [
                        'nit.unique'=> ['Lo sentimos ya existe un NIT registrado con este dato.'],
                        'code.unique'=> ['Lo sentimos ya existe un Código registrado con este dato.']
                       ];
