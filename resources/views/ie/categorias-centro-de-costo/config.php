<?php

    $data['model']    = 'App\Models\ie\IeCostCenter';
    $data['title']    = 'Centro de costo';
    $data['vIndex']   = 'ie.categorias-centro-de-costo.index';
    $data['viewPath'] = 'ie.categorias-centro-de-costo';

    $data['table']['head'] = ["EMPRESA",
                              "T/D",
                              "C.COSTO",
                              "NOMBRE",
                              "NIVEL",
                              "PADRE",
                              "NOM. COMPUESTO",
                              "ESTADO",''];
    $data['table']['body'] = ["company",
                              "tdcc",
                              "code",
                              "name",
                              "nivel",
                              "padre",
                              "slugcomp",
                              "estado"=>['wrap'=>'<span class="badge bg-transparent">%s</span>']];

    $campos[] = ['name'=>'id', 'type'=>'hidden' ,  'classInput'=>'' ];
    $campos[] = ['name'=>'id_company', 'type'=>'select' , 'label'=>'Compañia',  'required'=>true , 'classInput'=>'' ,
                 'options'=>optionSelect(['key'=>'id', 
                                          'label'=>'name', 
                                          'model'=>'ie\IeCompany'])];
    
    

    $campos[] = ['name'=>'id_parent', 
                 'type'=>'select',
                 'label'=>'Padre',
                 'classInput'=>'',
                 'request'=>true,
                 'onchange'=>'setInfoCCForm(this.value)', 
                 'options'=>optionSelect(['key'=>'id', 
                             'label'=>'code', 
                             'model'=>'ie\IeCostCenter',
                             ]
                            )
   ];
    
   /*
   
   */

    $campos[] = ['name'=>'code', 'type'=>'inputcc' , 'label'=>'Código' , 'autocomplete'=>'off' , 'required'=>true , 'classInput'=>'' , 'autofocus'=>true];
    $campos[] = ['name'=>'name',  'label'=>'Nombre',  'classInput'=>'' ];
    $campos[] = ['name'=>'ppto', 'type'=>'money' , 'label'=>'Presupuesto',  'classInput'=>'currency' , 'afterSave'=>'clearMoney' ];
     
    $campos[] = ['name'=>'classification_rel', 
                 'type'=>'select' , 
                 'label'=>'Clasificación',  
                 // 'required'=>true , 
                 'classInput'=>'' ,
                 'multiple'=>true , 
                 'options'=>optionSelect(['key'=>'id', 
                                          'label'=>'name', 
                                          'model'=>'ie\IeClassification'])];

    $campos[] = ['type'=>'state','name'=>'state',  'active'=>true];
    
    $data['except']      = ['classification_rel'];
    $data['callEndSave'] = true;

    $data['campos'] = $campos;
    $data['form']   = $data['campos'];
    
    $data['validate'] = [
                            'code'=> ['required', 'unique:ie_cost_centers,code,{id}']
                        ];
    $data['validateMSG'] = [
                            'code.unique'=> ['Lo sentimos ya existe un código con este dato.']
                           ];
 