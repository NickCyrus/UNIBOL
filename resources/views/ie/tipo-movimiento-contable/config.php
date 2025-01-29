<?php

    $options = ['1'=>'SUMA (+)','-1'=>'RESTA (-)'];
    $data['model'] = 'App\Models\ie\IeMovementType';
    $data['title'] = 'Tipo de Movimiento';
    $data['table']['head'] = ['ID',"TIPO MOVIMIENTO","OPERACIÓN","ESTADO",''];
    $data['table']['body'] = ['id',"name","number"=>['option'=>$options],"estado"=>['wrap'=>'<span class="badge bg-transparent">%s</span>']];

    
    $campos[] = ['name'=>'id', 'type'=>'hidden' ,  'classInput'=>'' ];
    $campos[] = ['name'=>'name', 'label'=>'Tipo movimiento' , 'required'=>true , 'classInput'=>'' , 'autofocus'=>true];
    $campos[] = ['name'=>'number', 'type'=>'radio' , 'label'=>'Operacion' , 'required'=>true , 'classInput'=>'' , 'options'=>$options ];

    // $campos[] = ['name'=>'name', 'type'=>'select' , 'label'=>'Clasificaciones' , 'required'=>true , 'classInput'=>'' , 'autofocus'=>true];

    $campos[] = ['type'=>'state','name'=>'state'];

    

    $data['campos'] = $campos;
    $data['form'] = $data['campos'];
    
    $data['validate'] = [
                            'name'=> ['required', 'unique:ie_movement_types,name,{id},id'],
                            'number'=> ['required']
                        ];
    $data['validateMSG'] = [
                            'name.unique'=> ['Lo sentimos ya existe un registro con esté tipo de movieminto.'],
                            'number.required'=> ['Lo sentimos este campo es obligatorio']
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