var modalCurrent;
var modalwait = [];

fn = {

        modal : '',
        modalwait  : [],

        setHeight : function(obj = ''){

                var hW = $(window).height();
                if (!obj.menos) obj.menos = 0;
                if (obj.element){

                        $(obj.element).css({ height : (hW - obj.menos)});
                }
        },
        alert : function(msg){

                 $.alert({title : '', content : msg});
        },

        error : function(msg){
            $.alert({title : '', content : msg ,  type : 'red' });
        },

        warning : function(msg){
            $.alert({title : '', content : msg ,  type : 'warning' });
        },

        wait : function(msg = '' , options = {} ){

              var defaul = {
                        title : '',
                        class : 'col-md-4',
                        animation : 'rotateYR',
                        closeAnimation : 'scale',
                        msg : 'Por favor espere'
              }

              var opc = $.extend( defaul , options );


                var Newmodalwait = $.dialog({
                                    animation: opc.animation,
                                    closeAnimation: opc.closeAnimation,
                                    title: opc.title,
                                    closeIcon: false,
                                    columnClass : opc.class,
                                    content : (msg) ? msg : opc.msg
                                })

                modalwait.push([Newmodalwait]);


        },

        dialog : function(options){

                var defaul = {
                                title : '',
                                btnClose : true,
                                class : 'col-md-6',
                                msgWait: 'Por favor espere...',
                                url : 'ajax',
                                type: 'get',
                                dataType : 'json'
                        }

                var opc = $.extend( defaul , options );

                this.modal = $.dialog({
                                        animation: 'rotateYR',
                                        closeAnimation: 'scale',
                                        title: opc.title,
                                        closeIcon: opc.btnClose,
                                        columnClass : opc.class,
                                        content: function () {
                                                var self = this;

                                                $.ajaxSetup({
                                                    headers: {
                                                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                                                    }
                                                });


                                                return $.ajax({
                                                           beforeSend: function(){
                                                                        self.setContent(opc.msgWait);
                                                           },
                                                            data: opc,
                                                            url: opc.url,
                                                            dataType: opc.dataType,
                                                            type : opc.type,
                                                            success : function(response){

                                                                    if (opc.dataType == 'json' || opc.dataType == 'JSON'){

                                                                        if (response.title) self.setTitle(response.title);
                                                                        if (response.html) self.setContent(response.html);
                                                                        if (response.autoClose) self.close();
                                                                        if (response.callback) eval(response.callback);

                                                                    }else{
                                                                        self.setContent(response);

                                                                    }


                                                            }

                                                        })
                                            }

                                    });


                modalCurrent = this.modal;
        },

        setContentModal : function(msg){
                this.modal.setContent(msg)
        },

        setTitleModal: function(msg){
                this.modal.setTitle(msg);
        },

        closeModal : function(){
                if (this.modalwait) this.closeWait();
                if (modalCurrent) modalCurrent.close();
                if (this.modal) this.modal.close();
        },

        closeWait : function(){
            if (modalwait.length){
                for(i=0;i<modalwait.length;i++){
                    modalwait[i][0].close();
                }
            }
            modalwait = [];
        },

        hide : function(ele){
               $(ele).hide().addClass('hidden').removeClass('visible')
        },

        show : function(ele){
                $(ele).show().removeClass('hidden').addClass('visible')
        },

        ajax : function(opc){

                opc.url = (!opc.url) ? 'ajax.php' :  opc.url;
                opc.method = (!opc.method) ? 'get' :  opc.method;
                opc.dataType = (!opc.dataType) ? 'json' :  opc.dataType;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                        beforeSend: opc.beforeSend,
                        data: opc.data,
                        url: opc.url,
                        dataType: opc.dataType,
                        method: opc.method,
                        success : opc.success,
                        complete : opc.complete,
                        fail :  opc.fail,
                        error : opc.error
                })

        },

        reloadContent : function(opc){

                        opc.data.option = (opc.data.option) ? opc.data.option : 'getContent';

                        this.ajax({
                                beforeSend : function(){
                                        $(opc.container).html('<div class="waitLoagin"></div>')
                                },
                                data : opc.data,
                                success : function(resp){
                                           if (resp.html) $(opc.container).html(resp.html);

                                }
                         })
        },

        reloadPart (box , datos = {}){

            $.ajax({
                    beforeSend : function(){
                            $(box).html(fn.boxLoading())
                    },
                    data : datos,
                    type : 'post',
                    url  : 'ajax.php',
                    success: function(rs){
                            if (rs){
                                $(box).html(rs);
                            }else{
                                $(box).html('Sin información');
                            }
                    }
                })

        },

        confirm (opc = {} , success = '' ){

                defaul = {
                        title : 'Confirmación',
                        content : 'Desea realizar esta acción?',
                        btnTxtConfirm : 'Aceptar',
                        btnTxtCancel  : 'Cancelar',
                        actionCancel  : function(){}
                     }

                var options = $.extend( defaul , opc );


                $.confirm({
                        title: options.title,
                        content: options.content,
                        buttons: {
                            'Aceptar' : {
                                text : options.btnTxtConfirm,
                                action : success
                            },
                            cancelar: {
                                text : options.btnTxtCancel,
                                btnClass: 'btn-danger',
                                action: options.actionCancel
                            }

                        }
                    });


        },

        applyPlugins : function(){

                $('.select2').select2({
                    formatNoMatches: function () {
                        return "Sin resultados.";
                    }
                });

                

                $('.on').ForceNumericOnly();

                /*
                $('.money').mask('S#.##0,##', {
                   /// reverse: true,
                    translation: {
                        'S': {
                            pattern: /[-]/,
                            optional: true
                        }
                    }
                });
                */

                $(".dt-tabla").DataTable({
                    fixedHeader: true,
                    orderCellsTop: true,
                    "language": {
                             
                        "sProcessing":     "Procesando...",
                        "sLengthMenu":     "Mostrar _MENU_ registros",
                        "sZeroRecords":    "No se encontraron resultados",
                        "sEmptyTable":     "NingÃºn dato disponible en esta tabla",
                        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
                        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
                        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix":    "",
                        "sSearch":         "Buscar:",
                        "sUrl":            "",
                        "sInfoThousands":  ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Ãšltimo",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }

                    }

                 });

        },

        setRequired : function(inputs){
            $(inputs).prop('required',true).addClass('class-required');
        },

        removeRequired : function(inputs){
            $(inputs).removeAttr('required').removeClass('class-required');
        },

        openInfo : function(options){

            var defaul = {
                title : '',
                btnClose : true,
                class : 'col-md-6',
                content: '',
            }

            var opc = $.extend( defaul , options );

            this.modal = $.dialog({
                            animation: 'rotateYR',
                            closeAnimation: 'scale',
                            title: opc.title,
                            closeIcon: opc.btnClose,
                            columnClass : opc.class,
                            content: opc.content
                        })
        },

        openModal : function(options){

                var defaul = {
                    title : '',
                    btnClose : true,
                    class : 'col-md-4',
                    msgWait: 'Por favor espere...',
                    url : baseApp+options.action,
                    type: 'post',
                    dataType : 'json'
                }

                var opc = $.extend( defaul , options );

                this.modal = $.dialog({
                                animation: 'rotateYR',
                                closeAnimation: 'scale',
                                title: opc.title,
                                closeIcon: opc.btnClose,
                                columnClass : opc.class,
                                content: function () {
                                        var self = this;

                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                                            }
                                        });


                                        return $.ajax({
                                                beforeSend: function(){
                                                    self.setContent(opc.msgWait);
                                                },
                                                    data: opc,
                                                    url: opc.url,
                                                    dataType: opc.dataType,
                                                    type : opc.type,
                                                    success : function(response){

                                                            if (opc.dataType == 'json' || opc.dataType == 'JSON'){
                                                                if (response.title) self.setTitle(response.title);
                                                                if (response.html) self.setContent(response.html);
                                                                if (response.autoClose) self.close();
                                                                if (response.callback) eval(response.callback);
                                                            }else{
                                                                self.setContent(response);
                                                            }
                                                    },
                                                    complete : function(){

                                                    }

                                                })
                                }

                            });

                        modalCurrent = this.modal;

        },

        addNewCC : function(opc={}){
            $("[name='cc']").val(opc.code);
            $("[name='subcc']").focus;
        }


}


function openSelectIcons(element = ''){
    opc = {
            class : 'col-md-8',
            url   : urlHome+'/ajax/select-icons/'+element,
            type : 'post',
            element  : element
          }
    fn.dialog(opc)
}

jQuery.fn.ForceNumericOnly = function(){

    return this.each(function(){
        $(this).keydown(function(e){
            var key = e.charCode || e.keyCode || 0;
            // allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
            // home, end, period, and numpad decimal
            return (
                key == 8 ||
                key == 9 ||
                key == 13 ||
                key == 46 ||
                key == 110 ||
                key == 190 ||
                (key >= 35 && key <= 40) ||
                (key >= 48 && key <= 57) ||
                (key >= 96 && key <= 105));
        });
    });
};


function empty(element){ $(element).val('');}
function norequired(element){ $(element).attr('required',false);}
function required(element){ $(element).attr('required',true); }
function disabled(element){ $(element).attr('disabled',true); }
function enabled(element){ $(element).attr('disabled',false); }
function jump(element){ $('#'+element).focus(); }

function money_js(value=0){ return parseFloat( value.replaceAll('.','').replaceAll(',','.'))}
function invertirMoney(value=0) { return (-1 * value); }


function enter(obj , evento = '' ){

    $(obj).keyup(function(event){
        var keycode = (event. keyCode ? event. keyCode : event. which);
        if(keycode == '13'){
            if (evento){
                eval(evento)
            }
        }
    });


}


$(function(){

            $(document).on('click','.confirm', function(e){
                    e.preventDefault();
                    var hrefLink = $(this).attr('href');
                    var q = ($(this).data('q')) ? $(this).data('q') : '¿Desea eliminar este registro?';
                    fn.confirm({ content : q } , function() { location.href = hrefLink })
            })

            $('.on , .sn ').ForceNumericOnly();
            
            $('.select2').select2({
                placeholder: function(){
                    $(this).data('placeholder');
                }
            });
            
            currencyFormatter('valor');


            $('.money').keyup(function(){

                money = $(this).val().replaceAll('.','');
                var span = $(this).parents('.input-group').find('.input-group-text');
                if (parseFloat(money) > 0){
                    span.addClass('movimiento-1').removeClass('movimiento-4')
                    $(this).addClass('movimiento-1').removeClass('movimiento-4')
                }else{
                    span.addClass('movimiento-4').removeClass('movimiento-1')
                    $(this).addClass('movimiento-4').removeClass('movimiento-1')
                }

            

            })

            if ( $('.currency').length){

                    $('.currency:not(.currencyFormatter)').each(function(index , item){
                        currencyFormatter($(this).attr('id'));
                    })

            }
 
            
            $(".dn-table").DataTable({
                fixedHeader: true,
                orderCellsTop: true,
                "pageLength": 50,
                "order": [],
                "language": {
                    "processing": "Procesando...",
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "No se encontraron resultados",
                    "emptyTable": "Ningún dato disponible en esta tabla",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "search": "Buscar:",
                    "infoThousands": ",",
                    "loadingRecords": "Cargando...",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "aria": {
                        "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                    "buttons": {
                        "copy": "Copiar",
                        "colvis": "Visibilidad",
                        "collection": "Colección",
                        "colvisRestore": "Restaurar visibilidad",
                        "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
                        "copySuccess": {
                            "1": "Copiada 1 fila al portapapeles",
                            "_": "Copiadas %ds fila al portapapeles"
                        },
                        "copyTitle": "Copiar al portapapeles",
                        "csv": "CSV",
                        "excel": "Excel",
                        "pageLength": {
                            "-1": "Mostrar todas las filas",
                            "_": "Mostrar %d filas"
                        },
                        "pdf": "PDF",
                        "print": "Imprimir",
                        "renameState": "Cambiar nombre",
                        "updateState": "Actualizar",
                        "createState": "Crear Estado",
                        "removeAllStates": "Remover Estados",
                        "removeState": "Remover",
                        "savedStates": "Estados Guardados",
                        "stateRestore": "Estado %d"
                    },
                    "autoFill": {
                        "cancel": "Cancelar",
                        "fill": "Rellene todas las celdas con <i>%d<\/i>",
                        "fillHorizontal": "Rellenar celdas horizontalmente",
                        "fillVertical": "Rellenar celdas verticalmentemente"
                    },
                    "decimal": ",",
                    "searchBuilder": {
                        "add": "Añadir condición",
                        "button": {
                            "0": "Constructor de búsqueda",
                            "_": "Constructor de búsqueda (%d)"
                        },
                        "clearAll": "Borrar todo",
                        "condition": "Condición",
                        "conditions": {
                            "date": {
                                "after": "Despues",
                                "before": "Antes",
                                "between": "Entre",
                                "empty": "Vacío",
                                "equals": "Igual a",
                                "notBetween": "No entre",
                                "notEmpty": "No Vacio",
                                "not": "Diferente de"
                            },
                            "number": {
                                "between": "Entre",
                                "empty": "Vacio",
                                "equals": "Igual a",
                                "gt": "Mayor a",
                                "gte": "Mayor o igual a",
                                "lt": "Menor que",
                                "lte": "Menor o igual que",
                                "notBetween": "No entre",
                                "notEmpty": "No vacío",
                                "not": "Diferente de"
                            },
                            "string": {
                                "contains": "Contiene",
                                "empty": "Vacío",
                                "endsWith": "Termina en",
                                "equals": "Igual a",
                                "notEmpty": "No Vacio",
                                "startsWith": "Empieza con",
                                "not": "Diferente de",
                                "notContains": "No Contiene",
                                "notStartsWith": "No empieza con",
                                "notEndsWith": "No termina con"
                            },
                            "array": {
                                "not": "Diferente de",
                                "equals": "Igual",
                                "empty": "Vacío",
                                "contains": "Contiene",
                                "notEmpty": "No Vacío",
                                "without": "Sin"
                            }
                        },
                        "data": "Data",
                        "deleteTitle": "Eliminar regla de filtrado",
                        "leftTitle": "Criterios anulados",
                        "logicAnd": "Y",
                        "logicOr": "O",
                        "rightTitle": "Criterios de sangría",
                        "title": {
                            "0": "Constructor de búsqueda",
                            "_": "Constructor de búsqueda (%d)"
                        },
                        "value": "Valor"
                    },
                    "searchPanes": {
                        "clearMessage": "Borrar todo",
                        "collapse": {
                            "0": "Paneles de búsqueda",
                            "_": "Paneles de búsqueda (%d)"
                        },
                        "count": "{total}",
                        "countFiltered": "{shown} ({total})",
                        "emptyPanes": "Sin paneles de búsqueda",
                        "loadMessage": "Cargando paneles de búsqueda",
                        "title": "Filtros Activos - %d",
                        "showMessage": "Mostrar Todo",
                        "collapseMessage": "Colapsar Todo"
                    },
                    "select": {
                        "cells": {
                            "1": "1 celda seleccionada",
                            "_": "%d celdas seleccionadas"
                        },
                        "columns": {
                            "1": "1 columna seleccionada",
                            "_": "%d columnas seleccionadas"
                        },
                        "rows": {
                            "1": "1 fila seleccionada",
                            "_": "%d filas seleccionadas"
                        }
                    },
                    "thousands": ".",
                    "datetime": {
                        "previous": "Anterior",
                        "next": "Proximo",
                        "hours": "Horas",
                        "minutes": "Minutos",
                        "seconds": "Segundos",
                        "unknown": "-",
                        "amPm": [
                            "AM",
                            "PM"
                        ],
                        "months": {
                            "0": "Enero",
                            "1": "Febrero",
                            "10": "Noviembre",
                            "11": "Diciembre",
                            "2": "Marzo",
                            "3": "Abril",
                            "4": "Mayo",
                            "5": "Junio",
                            "6": "Julio",
                            "7": "Agosto",
                            "8": "Septiembre",
                            "9": "Octubre"
                        },
                        "weekdays": [
                            "Dom",
                            "Lun",
                            "Mar",
                            "Mie",
                            "Jue",
                            "Vie",
                            "Sab"
                        ]
                    },
                    "editor": {
                        "close": "Cerrar",
                        "create": {
                            "button": "Nuevo",
                            "title": "Crear Nuevo Registro",
                            "submit": "Crear"
                        },
                        "edit": {
                            "button": "Editar",
                            "title": "Editar Registro",
                            "submit": "Actualizar"
                        },
                        "remove": {
                            "button": "Eliminar",
                            "title": "Eliminar Registro",
                            "submit": "Eliminar",
                            "confirm": {
                                "_": "¿Está seguro que desea eliminar %d filas?",
                                "1": "¿Está seguro que desea eliminar 1 fila?"
                            }
                        },
                        "error": {
                            "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
                        },
                        "multi": {
                            "title": "Múltiples Valores",
                            "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
                            "restore": "Deshacer Cambios",
                            "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
                        }
                    },
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    "stateRestore": {
                        "creationModal": {
                            "button": "Crear",
                            "name": "Nombre:",
                            "order": "Clasificación",
                            "paging": "Paginación",
                            "search": "Busqueda",
                            "select": "Seleccionar",
                            "columns": {
                                "search": "Búsqueda de Columna",
                                "visible": "Visibilidad de Columna"
                            },
                            "title": "Crear Nuevo Estado",
                            "toggleLabel": "Incluir:"
                        },
                        "emptyError": "El nombre no puede estar vacio",
                        "removeConfirm": "¿Seguro que quiere eliminar este %s?",
                        "removeError": "Error al eliminar el registro",
                        "removeJoiner": "y",
                        "removeSubmit": "Eliminar",
                        "renameButton": "Cambiar Nombre",
                        "renameLabel": "Nuevo nombre para %s",
                        "duplicateError": "Ya existe un Estado con este nombre.",
                        "emptyStates": "No hay Estados guardados",
                        "removeTitle": "Remover Estado",
                        "renameTitle": "Cambiar Nombre Estado"
                    }
                }

            });




}) 

function inputMoviment(clase){

    $(clase).keyup(function(){

        money = $(this).val().replaceAll('.','');
        var span = $(this).parents('.input-group').find('.input-group-text');
        if (parseFloat(money) > 0){
            span.addClass('movimiento-1').removeClass('movimiento-4')
            $(this).addClass('movimiento-1').removeClass('movimiento-4')
        }else{
            span.addClass('movimiento-4').removeClass('movimiento-1')
            $(this).addClass('movimiento-4').removeClass('movimiento-1')
        }

    

    })

}

function currencyFormatter(IDELEMENT) {
    

    if (!$('#'+IDELEMENT).length) return;

    if ($('#'+IDELEMENT).is('.currencyFormatter')){
        return;
    }
    
    $('#'+IDELEMENT).addClass('currencyFormatter');

    currencyMask = IMask(
        document.getElementById(IDELEMENT),
        {
          mask: 'num',
          blocks: {
            num: {
              mask: Number,
              scale: 2,
              thousandsSeparator: '.',
              padFractionalZeros: true
            }
          }
        }
      )

 
      inputMoviment('#'+IDELEMENT);
      
      /* 
        $('#'+IDELEMENT).keyup(function(){

            money    = $(this).val().replaceAll('.','');
            var span = $(this).parents('.input-group').find('.input-group-text');

            if (parseFloat(money) > 0){
                span.addClass('movimiento-1').removeClass('movimiento-4')
                $(this).addClass('movimiento-1').removeClass('movimiento-4')
            }else{
                span.addClass('movimiento-4').removeClass('movimiento-1')
                $(this).addClass('movimiento-4').removeClass('movimiento-1')
            }

        })
      */  
   
    
   
    return currencyMask;

  }