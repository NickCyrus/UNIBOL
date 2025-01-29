function checkThirdparties(obj){

    let thirdparti = $('.id_thirdparti');

    if ($('#detalle-movimiento .details .id_thirdparti').length){
        
        var existe = false;
        $('#detalle-movimiento .details .id_thirdparti').each(function(index , item){
                    if ($(item).val() == thirdparti.val()) {
                        existe = true;
                        return;
                    }
        })
        
        if (!existe){
                fn.error("El tercero debe existir almenos una vez en el detalle.");
        }

        return existe;

    }

    return true;
    // detalle-movimiento

}

function checkCompany(obj){

    let id_company = $('#id_company');

    if ($('#detalle-movimiento .details .id_company').length){
        
        var existe = false;
        $('#detalle-movimiento .details .id_company').each(function(index , item){
                    if ($(item).val() == id_company.val()) {
                        existe = true;
                        return;
                    }
        })
        
        if (!existe){
                fn.error("La empresa debe existir almenos una vez en el detalle.");
        }

        return existe;

    }

    return true;
    // detalle-movimiento

}