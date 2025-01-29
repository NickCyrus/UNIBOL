
<div class="table-responsive">
    <table class="table" id="detalles_ingegre">
        <thead>
            <tr>
                <th>EMPRESA</th>
                <th>VALOR</th>
                <th>TERCERO</th>
                <th>CLASIFICACIÓN</th>
                <th>C.C</th>
                <th>CONCEPTOS</th>
                <th>CUENTA CONTABLE</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <input type="hidden" class="row-detalle" name="id_income_expenses" value="{{$cabecera->id}}" />
            <input type="hidden" class="row-detalle id_income_expenses_details" name="nuevo" id="nuevo" value="" />
            <input type="hidden" class="row-detalle id_income_expenses_details" name="copia" id="copia" value="" />
            @if ($cabecera->details_moviment->count())
                @foreach( $cabecera->details_moviment->get() as $info)
                    @include('ie.movi.form.row', ['info'=>$info])            
                @endforeach
            @endif
        </tbody>
        <tfoot>
            <tr>
                <td colspan="8" class="px-0"  style="border:none;">
                    <button type="button" onclick="saveMovimentIngEgre(true)" class="btn btn-info btn-sm pull-right"> <i class='bx bx-save' ></i> Guardar + Nuevo </button>
                    <button type="button" onclick="saveMovimentIngEgre(false , true)" class="btn btn-success btn-sm pull-right margin-button"> <i class='bx bx-save' ></i> Guardar + Copiar </button>
                    <button style="display: none" type="button" onclick="saveMovimentIngEgre()" class="btn btn-warning btn-sm pull-right margin-button"> <i class='bx bx-save' ></i> Guardar</button> 
                    
                </td>
            </tr>
        </tfoot>
    </table>
</div>

<script>

    function selectTercero(ID){

        $(ID).select2({
            ajax: {
                url: '{{route('terceros.ajax',['opc'=>'load-thirdparties'])}}',
                dataType: 'json', 
                type: "get",
                delay: 250,
                data: function (params) {
                    return { search: params.termtype }
                }  
            }})
  
       
    }
    
    function removeDetails(boxId ,  id){
        if ($('.tr-row-detalle').length == 1){
            fn.alert('Debe tener almenos un detalle de movimiento !!');
            return false;
        }else{
             
            fn.confirm({ content : '¿Desea eliminar este movimiento?'}, function(){

                if (!id){
                    $('#'+boxId).remove(); 
                }else{
                    fn.ajax({
                       beforeSend : function(){ fn.wait("Por favor espere..."); },
                       data : { detailId : id},
                       url  : '{{route('movi.ajax', ['opc'=>'removeDetails'])}}',
                       method : 'post',
                       success : function(rs){
                         if (rs.success){
                            $('#'+boxId).remove(); 
                         }
                       }
                       ,complete : () => fn.closeWait()
                       ,error :  ()=> fn.alert("Se ha producido un error")
                    })
                }
            })
        }
    }

    function totalMovimientoDetalles(){
        var total  = 0;
        $('.price.row-detalle').each(function(index, item){
                var price = parseFloat( $(item).val().replaceAll('.','').replaceAll(',','.') );
                 total += price
        })

        return total;

    }
    function isMovimentInterEmpresas(){
        var existe = false;
            $('.id_classification.row-detalle').each(function(index, item){
                if ($(item).val() == 6){
                    existe = true;
                }
            })
        return existe;
    }

    
    function checkMovimentInterEmpresas(){

            var msg = '';
            var MovInterEmpresas  =  new Array;

            $('.id_classification.row-detalle').each(function(index, item){
                if ($(item).val() == 6){
                    MovInterEmpresas.push($(item));
                }
            })

            if (MovInterEmpresas.length){

                var Company           = $('#id_company').val();
                var CompanyNit        = $('#id_company').find(":selected").attr('data-nit');
                var valor             = parseFloat( $('#valor').val().replaceAll('.','').replaceAll(',','.') );
                var thirdparti        = $('#id_thirdparti').val();
                
                var countThirdparti   = 0;
                // Primero que todo validamos que el tercero exista en el detalle
                var existThirdparti = false;
                var rowParent       = '';

                $('.id_thirdparti.row-detalle').each(function(index, item){
                        if ($(item).val() == thirdparti){
                            existThirdparti = true;
                            countThirdparti++;
                            rowParent = $(item).parents('tr');
                        }
                })

                // No existe el tercero en el detalle
                if (!existThirdparti){
                    return [false, 'No existe el <b>tercero</b> en el detalle de movimiento.'];
                }

                // Se evalua que la primera empresa del detalle sea la de la cabecera
                if ($('.id_company.row-detalle').eq(0).val() != Company){
                    return [false, 'No coincide la empresa en el primer detalle de movimiento con la empresa de la cabecera.'];
                }

                // Se evalua que el tercero final sea el de la cabecera
                // if ($('.id_thirdparti:last.row-detalle').val() != thirdparti){
                //    return [false, 'En el movimiento final el tercero debe coincidir con el tercero de la cabecera'];
                // }

                var nitArray         = new Array;
                var companyValues    = new Array;
                var thirdpartiValues = new Array;
                var totalesFinales   = new Array;
                var totalesFinalesTercero = 0;
                
                $('.id_company.row-detalle , .id_thirdparti.row-detalle').each(function(index , item){
                    var uniqId = $(item).attr('data-uniqid'); 
                    var nit    = $(item).attr('data-nit'); 
                    if ($('#id_classification'+uniqId).val()==6){
                        if (!nitArray.includes(nit) && CompanyNit != nit) nitArray.push(nit);
                    }
                })

                // Array Compania
                $('.id_company.row-detalle').each(function(index , item){
                     var uniqId = $(item).attr('data-uniqid'); 
                     var nit    = $(item).attr('data-nit'); 
                     var value  = money_js($('#price'+uniqId).val());
                     
                     value = ( $('#id_classification'+uniqId).val() == 6 ) ? (value/2) : value;

                     
                     
                     if (CompanyNit != nit){
                        companyValues[nit]  = (companyValues[nit]) ? companyValues[nit] + value : value; 
                     }else{
                        totalesFinales[nit] = money_js($('#price'+uniqId).val());
                     }

                })

                // Array Terceros
                $('.id_thirdparti.row-detalle').each(function(index , item){
                     var uniqId = $(item).attr('data-uniqid'); 
                     var nit    = $(item).attr('data-nit'); 
                     var id_thirdparti = $(this).val();
                     var value  = invertirMoney(money_js($('#price'+uniqId).val()));

                     value = ( $('#id_classification'+uniqId).val() == 6 ) ? (value/2) : value;
                     
                     if (thirdparti != id_thirdparti && CompanyNit != nit){
                        thirdpartiValues[nit] = (thirdpartiValues[nit]) ? thirdpartiValues[nit] + value : value; 
                     }

                     if (thirdparti == id_thirdparti){
                        // console.log(thirdparti +"-"+id_thirdparti+' =>'+value);
                        totalesFinalesTercero += value; 
                        // console.log(totalesFinalesTercero);
                     }

                })

              

                if ( (totalesFinalesTercero + valor) != 0 ){
                    return [sinError, 'Los movimientos interempresas no coinciden <b>Valor cabecera vs Detalle tercero cabecera</b>'];
                }

                // console.log( (totalesFinales[CompanyNit] +" --- "+valor) ); 

                if ( totalesFinales[CompanyNit] != valor){
                    return [sinError, 'Los movimientos interempresas no coinciden <b>Valor cabecera vs Empresa Detalle</b>'];
                }

                if (nitArray.length){
                    // console.log(nitArray);

                    var sinError  = true;

                    for(i=0;i<nitArray.length;i++){

                        var nit = nitArray[i];
                        // console.log(nit + " companyValues ="+ companyValues[nit] +" thirdpartiValues="+thirdpartiValues[nit]);
                        
                        if ((companyValues[nit] || companyValues[nit]==0) && (thirdpartiValues[nit] || thirdpartiValues[nit]==0)){
                                if (( companyValues[nit] + thirdpartiValues[nit]) != 0){
                                    sinError = false;
                                }
                        }else{
                            sinError = false;
                        }

                    }
                    
                    // console.log(companyValues); 
                    // console.log(thirdpartiValues); 
                    // console.log(errorFinal); 
                    
                    console.log(totalesFinales); 
                    console.log(totalesFinalesTercero);



                    return [sinError, 'Los movimientos interempresas no coinciden'];

                }

                /*
                    if (totalMovimientoDetalles() != valor){
                        return [false, 'El total de movimientos no se corresponde con el valor de la cabecera'];
                    }
                */
                

                
                return [true,msg];

            }else{
                return [true,msg];
            }

            
        

    }
     

    function saveMovimentIngEgre(nuevo = false , copia = false){

        var valor = parseFloat( $('#valor').val().replaceAll('.','').replaceAll(',','.') )

        if (!$('.price').length){
            fn.alert("Debe tener almenos un detalle !!")
            return false;
        }else{


            var resp = checkMovimentInterEmpresas();

            if (!resp[0]){
                fn.alert('<center>'+resp[1]+'</center>');
                error = true;
                return false; 
            }
 


            var totalMov = 0; 
            $('.price').each(function(index, item){
                if ($(item).val()){
                   var price = parseFloat( $(item).val().replaceAll('.','').replaceAll(',','.') );
                   totalMov += price
                }
            })


            if (totalMov != valor && !isMovimentInterEmpresas()){
                fn.alert("Los movimientos no coinciden en el monto total, por favor verifiquelos.")
                return false;
            }


            
            var error = false
            $('.row-detalle').each(function(index , item){
                    if (!$(item).val() && !$(item).is('.id_income_expenses_details')){
                        fn.alert("Todos los campos son requeridos, por favor completelos");
                        error = true;
                        return false;
                    }
            })

            if (error) return false;

            if (nuevo) { 
                $('#nuevo').val(1);
            }else{
                $('#nuevo, #copia').val('');
            }

            if (copia) { 
                $('#copia').val(1);
            }else{
                $('#copia').val('');
            }
            

            var data = $('.row-detalle').serializeJSON();
            
            /*
            if (!checkThirdparties(null)){
                return false; 
            }
            */

            if (!checkCompany(null)){
                return false; 
            }
            
            

            fn.ajax({
                       beforeSend : function(){
                            $('#btnSaveCabecera').click();
                            fn.wait("Por favor espere...");
                       },
                       data : data,
                       url  : '{{route('movi.ajax', ['opc'=>'saveDetalle'])}}',
                       method : 'post',
                       success : function(rs){
                         if (rs.html){
                              $('#detalle-movimiento .details').html(rs.html);
                         }
                         if (rs.reload){
                              window.location.href = '{{route('registro-ingresos-egresos.new')}}';
                         }

                         if (rs.jump){
                              window.location.href = rs.jump;
                         }
                         
                         fn.closeWait();

                       },
                       complete: function(){
                            selectThirdparti();
                            fn.closeWait();
                       },
                       error : function(){
                         fn.alert("Se ha producido un error");
                       }

            })

           


        }
    }

</script>
 