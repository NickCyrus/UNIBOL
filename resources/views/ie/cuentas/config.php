<?php

    $data['model'] = 'App\Models\ie\IeAccount';
    $data['title'] = 'Listado de Cuentas';
    $data['viewPath'] = 'ie.cuentas';
    $data['table']['head'] = ["NOMBRE","BANCO","COMPAÑIA","TIPO","ESTADO CUENTA","OFICINA","NÚMERO","ESTADO",''];
    $data['table']['body'] = ["name","bank","compania","tipo","estado_cuenta","office","account","estado"=>['wrap'=>'<span class="badge bg-transparent">%s</span>']];

    $datalist = getDatalist(1);
   
    $campos[] = ['name'=>'id', 'type'=>'hidden' ,  'classInput'=>'' ];
    
    $campos[] = ['name'=>'id_bank', 'type'=>'select' , 'label'=>'Banco',  'required'=>true , 'classInput'=>'' ,
                 'options'=>optionSelect(['key'=>'id', 
                                          'label'=>'name', 
                                          'model'=>'ie\IeBank']
                 )];

    $campos[] = ['name'=>'id_company', 'type'=>'select' , 'label'=>'Compañia',  'required'=>true , 'classInput'=>'' ,
                 'options'=>optionSelect(['key'=>'id', 
                                          'label'=>'name', 
                                          'model'=>'ie\IeCompany']
                 )];


    $campos[] = ['name'=>'id_account_type', 'type'=>'select' , 'label'=>'Tipo de cuenta',  'required'=>true , 'classInput'=>'' ,
                 'options'=>optionSelect(['key'=>'id', 
                                         'label'=>'name', 
                                         'model'=>'ie\IeAccountType']
                                         )
                ];
    $campos[] = ['name'=>'status', 'type'=>'select' , 'label'=>'Estado de cuenta',  'required'=>true , 'classInput'=>'' ,
                 'options'=>optionSelect(['key'=>'id', 
                                          'label'=>'name', 
                                          'model'=>'ie\IeAccountStatus'] 
                                        )
               ];
    
    $campos[] = ['name'=>'name', 'label'=>'Nombre',  'required'=>true , 'classInput'=>'' , 'autofocus'=>true ];
    $campos[] = ['name'=>'account', 'label'=>'Número de cuenta' , 'required'=>true , 'classInput'=>''  ];
    $campos[] = ['name'=>'office', 'label'=>'Oficina',  'required'=>true , 'classInput'=>'' , 'autofocus'=>true , 'placeholder'=>'Indique la oficina' ];
    $campos[] = ['name'=>'date_opening', 'type'=>'date', 'label'=>'Fecha apertura' , 'classInput'=>'' ] ;
    $campos[] = ['type'=>'state','name'=>'state'];

    $data['campos'] = $campos;
    $data['form']   = $data['campos'];
    
    $data['validate'] = [
                            'account'=> ['required', 'unique:ie_accounts,account,{id}']
                        ];
    $data['validateMSG'] = [
                            'account.unique'=> ['Lo sentimos ya existe un código de cuenta con este dato.']
                           ];

    $data['except']      = ['id_company','id_bank'];
    $data['callEndSave'] = true;