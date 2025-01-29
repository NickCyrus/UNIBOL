<?php

    $data['model'] = 'App\Models\ie\IeTypeDocumentCont';
    $data['title'] = 'Tipo de documentos de contable';
    $data['table']['head'] = ['ID',"NOMBRE","ABREVIATURA","ESTADO",''];
    $data['table']['body'] = ['id',"name","abbreviation","estado"=>['wrap'=>'<span class="badge bg-transparent">%s</span>']];

    
    $campos[] = ['name'=>'id', 'type'=>'hidden' ,  'classInput'=>'' ];
    $campos[] = ['name'=>'name', 'label'=>'Nombre' , 'required'=>true , 'classInput'=>'' , 'autofocus'=>true];
    $campos[] = ['name'=>'abbreviation', 'label'=>'Abreviatura' , 'required'=>true , 'classInput'=>''];
    $campos[] = ['type'=>'state','name'=>'state'];

    $data['campos'] = $campos;
    $data['form'] = $data['campos'];
    
    $data['validate'] = [
                            'name'=> ['required', 'unique:ie_type_document_conts,name,{id},id'],
                            'abbreviation'=> ['required', 'unique:ie_type_document_conts,abbreviation,{id},id']
                        ];
    $data['validateMSG'] = [
                            'name.unique'=> ['Lo sentimos ya existe un registro con esté dato.'],
                            'abbreviation.unique'=> ['Lo sentimos ya existe un registro con esté dato.']
                           ];

    /*
     $est->validate([
                    'email' => ['required',"unique:users,email,$est->userid,id"],
                    'numberdoc'=>['required',"unique:students,numberdoc,$est->id,id"]
                ],[  
                    'email.unique' =>["Lo sentimos este email <b>{$est->email}</b> ya está en uso."],
                    'numberdoc.unique' =>["Lo sentimos este número de documento <b>{$est->numberdoc}</b> ya está en uso."]
                ]);
    */