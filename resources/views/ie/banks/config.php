<?php

    $data['model'] = 'App\Models\ie\IeBank';
    $data['title'] = 'Entidades Financieras';
    $data['table']['head'] = ['ID',"CODIGO","LOGO","NOMBRE","ESTADO",''];
    $data['table']['body'] = ['id',"code","logo_preview" //=>['wrap'=>'<div class="text-center">%s</div>']
    ,
                              "name","estado"=>['wrap'=>'<span class="badge bg-transparent">%s</span>']];

    $datalist = getDatalist(1);
    
     

    $campos[] = ['name'=>'id', 'type'=>'hidden' ,  'classInput'=>'' ];

    /*$campos[] = ['name'=>'id_company', 'type'=>'select' , 'label'=>'Compañia',  'required'=>true , 'classInput'=>'' ,
                 'options'=>optionSelect(['key'=>'id', 
                                          'label'=>'name', 
                                          'model'=>'ie\IeCompany'])
                ];*/


    $campos[] = ['name'=>'code', 'label'=>'Código' , 'required'=>true , 'classInput'=>'' , 'autofocus'=>true];
    $campos[] = ['name'=>'name', 'label'=>'Nombre', 'datalist'=> $datalist  , 'classInput'=>'' ];

    $campos[] = ['name'=>'logo', 'label'=>'Logo' , 'classInput'=>'' ,  'type'=>'file-preview', 'accept'=>'image/*' ];

    $campos[] = ['name'=>'id_bank_movement_types', 
                 'type'=>'select', 
                 'multiple'=>true , 
                 'label'=>'Tipos de movimiento',
                 'required'=>true ,
                 'classInput'=>'' ,
                 'options'=>optionSelect(['key'=>'id', 
                                          'label'=>'name', 
                                          'model'=>'ie\IeMovementType'])
                ];
    $data['except']      = ['id_bank_movement_types'];
    $data['callEndSave'] = true;
    $campos[] = ['type'=>'state','name'=>'state'];

   

    

    $data['campos'] = $campos;
    $data['form']   = $data['campos'];
    
    $data['validate'] = [
                            'code'=> ['required', 'unique:ie_banks,code,{id}']
                        ];
    $data['validateMSG'] = [
                            'code.unique'=> ['Lo sentimos ya existe un código con este dato.']
                           ];
 