   
<form action="" method="POST" onsubmit="return false;" id="form-movimiento">
    @csrf

<div class="row mt-3">

    <div class="col-lg-4 col-xl-2 col-12 mb-0">
      <label class="form-label" for="form-repeater-1-1">Empresa</label>
      <input type="hidden" id="id" name="id" value="{{$info->id ?? ''}}" />
      <select id="id_company" onchange="setNit(this, this.value, 'id_company') ; loadBankAccount(this)" class="select2 form-select color-dropdown cabecera" name="id_company" required>
        <option selected></option>
        @php
            $opc = ['model'=>'ie\IeCompany','key'=>'id', 'data'=>['nit'=>'nit'] , 'label'=>'name' , 'output'=>'option', 'id'=> $info->id_company ?? ''];
        @endphp
        {!!optionSelect($opc)!!}
    </select>
    </div>
    
    <div class=" col-lg-1 col-xl-1 col-12 mb-0">
        <label class="form-label">Fecha</label>
        <input class="form-control cabecera date_income_expenses" 
        name="date_income_expenses" 
        id="date_income_expenses" 
        type="date" 
        min="{{CarbonClass()::now()->subMonth(1)->format("Y-m-d")}}"
        max="{{date("Y-m-d")}}" 
        value="{{$info->date_income_expenses ?? date("Y-m-d")}}" 
        required
        />
    </div>
    
    <div class="col-lg-4 col-xl-2 col-12 mb-0">
      <label class="form-label" for="form-repeater-1-2">Valor</label>
      <div class="input-group input-group-merge">
        <span class="input-group-text movimiento-{{$info->id_movement_type ?? ''}} " >
          <i class="bx bx-dollar"></i>
        </span>
          <input type="text" name="price" autocomplete="off" value="{{$info->price ?? ''}}" class="form-control text-right money cabecera movimiento-{{$info->id_movement_type ?? ''}}" id="valor" required>
      </div>
    </div>
 
    <div class=" col-lg-6 col-xl-3 col-12 mb-0">
      @php
        $option = '';
        if (isset($info->id_thirdparti)){
            $infter =  tercero($info->id_thirdparti);
            $option = "<option selected value='{$infter->id}'>{$infter->name}</option>";
        }
      @endphp
      <label class="form-label">Tercero</label>
      <select class="form-select id_thirdparti" onchange="loadBankAccount_third(this)" id="id_thirdparti" name="id_thirdparti" data-before-id="{{$info->id_thirdparti ?? '' }}" required>
        <option selected></option>
        {!!$option!!}
      </select>
      
    </div>

    <div class="col-lg-2 col-12 mb-0">
      <label class="form-label" for="form-repeater-1-1">Tip. Doc. Aprob.</label>
        <div class="row">
           <div class="col pr-0">
            <select id="tipdoc" class="select2 form-control color-dropdown cabecera tipdoc" name="tipdoc" onchange="checkRequired(this.value , 5 , 'doc')">
              <option selected></option>
              @php
                  $opc = ['model'=>'ie\IeAprobationDocument','key'=>'id','label'=>'abbreviation' , 'output'=>'option', 'id'=> $info->tipdoc ?? ''];
              @endphp
              {!!optionSelect($opc)!!}
            </select>
           </div>
           <div class="col pl-0">
            <input type="text" class="form-control text-center" name="doc" id="doc" value="{{$info->doc ?? ''}}" />
           </div>
        </div>
    </div>


    <div class="col-lg-2 col-12 mb-0">
      <label class="form-label" for="form-repeater-1-1">Tip. Doc. Cont.</label>
        <div class="row">
           <div class="col pr-0">
            <select id="tipcon" class="select2 form-control color-dropdown cabecera tipcon" name="tipcon" onchange="checkRequired(this.value , 4 , 'con')">
              <option selected></option>
              @php
                  $opc = ['model'=>'ie\IeTypeDocumentCont','key'=>'id','label'=>'abbreviation' , 'output'=>'option', 'id'=> $info->tipcon ?? ''];
              @endphp
              {!!optionSelect($opc)!!}
          </select>
           </div>
           <div class="col pl-0">
            <input type="text" class="form-control text-center" name="con"  id="con" @if(isset($info->con) && $info->con != 4) required @endif value="{{$info->con ?? ''}}" />
           </div>
        </div>
    </div>
 
    
    <div class="col-12 mb-2"></div>
    <div class="col-lg-2 col-xl-2 col-12 mb-0">
      <label class="form-label" for="form-repeater-1-4">Cuenta Bancaria.</label>
      <select id="id_account" class="select2 form-select color-dropdown cabecera id_account" name="id_account" required>
        @isset($info->id_account)
        <option selected></option>
        @php
            $opc = ['model'=>'ie\IeAccount',
                    'key'=>'id',
                    'label'=>'name' , 
                    'output'=>'option', 
                    'where'=>" id IN (SELECT id_account FROM ie_company_bank_accounts WHERE id_company = {$info->id_company}) ",
                    'id'=> $info->id_account ?? ''];
        @endphp
        {!!optionSelect($opc)!!}
        @endisset
    </select>
    </div>

    <div class="col-lg-3 col-xl-3 col-12 mb-0 ">
        <label class="form-label" for="form-repeater-1-4">Observación</label>
        <input type="text" class="form-control" style="text-transform: uppercase;" name="observation" value="{{$info->observation ?? ''}}" />
    </div>
    @if (isset($new))

    

    @endif
    <div class="modal fade removeAfterSave" id="tp_movimiento_interempresa" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel2">Prestamo Interempresa</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <h6 class="modal-title" id="exampleModalLabel2">Seleccione cuenta de destino</h6>
            <select id="id_account_3" style="width: 100%" class="select2 form-select color-dropdown cabecera id_account" name="id_account_3">
            </select>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
              Cerrar
            </button>
            <button type="button" class="btn btn-primary" onclick="return setInterEmpresaConsorcio();">Guardar y continuar</button>
          </div>

        </div>
      </div>
    </div>
    <div class="modal fade removeAfterSave" id="tp_movimiento" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel2">Traslado Propio</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <h6 class="modal-title" id="exampleModalLabel2">Seleccione cuenta de destino</h6>
            <select id="id_account_2" style="width: 100%" class="select2 form-select color-dropdown cabecera id_account" name="id_account_2">
            </select>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
              Cerrar
            </button>
            <button type="button" class="btn btn-primary" onclick="return setAutoPrestamos();">Guardar y continuar</button>
          </div>

        </div>
      </div>
    </div>
    <div class="modal fade removeAfterSave" id="smallModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel2">Prestamo Interempresa Tercero</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                  <input name="cla_classification" id="cla_classification" value="" type="hidden" />
                  <div class="col-lg-3 col-xl-3 col-12 mb-0 removeAfterSave" id="box_cla_thirdparti" style="width: 300px;">
                      <label class="form-label" for="form-repeater-1-4">Empresa</label>
                      <select class="form-select id_thirdparti_compnay" id="cla_thirdparti" name="cla_thirdparti" style="width: 100%">
                        <option selected></option>
                      </select>
                  </div>
                  <div class="col-lg-3 col-xl-3 col-12 mb-0 " id="box_cla_number" style="width: 300px;">
                    <label class="form-label" for="form-repeater-1-4"># Movimientos</label>
                    <select class="form-select" id="cla_number" name="cla_number" style="width: 100%">
                      <option selected value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                    </select>
                </div>
                </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                Cerrar
              </button>
              <button type="button" class="btn btn-primary" onclick="return setInterEmpresas();">Guardar y continuar</button>
            </div>

          </div>
        </div>
    </div>

    <div class="col-lg-2 col-xl-2 col-12 mb-0 ">


      <div class="btn-group" style="margin-top:30px" aria-label="Button group with nested dropdown" >
        <button class="btn btn-sm btn-success" id="btnSaveCabecera"> <i class='bx bx-save' ></i> Guardar y continuar</button>
        <button type="button" class="btn btn-sm btn-success dropdown-toggle removeAfterSave" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 0px 10px;">
          <span class="sr-only"></span>
        </button>
        <div class="dropdown-menu removeAfterSave" style="transform: translate(0px, 31px) !important;">
          <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"  onclick="setAutoPrestamos_modal()">Traslado Propio</a>
          <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" onclick="setInterEmpresaConsorcio_modal()">Préstamo interempresa</a>
          <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#smallModal">Préstamo Interempresa Pago Tercero</a>
        </div>
      </div>
        <!-- 
        <button class="btn btn-sm btn-success" id="btnSaveCabecera" style="margin-top:30px" ><i class='bx bx-save' ></i> Guardar y continuar</button>  
        !-->
    </div>
    
  </div>
  
  
</form>

  <div id="detalle-movimiento">
        <div class="@if (! $info->id) d-none @endif mt-3" id="eventMore">
          <div class="divider m-0">
            <div class="divider-text"><h4>Detalles de movimientos</h4></div>
          </div>
          <button type="button" onclick="addMoviment()" class="btn btn-sm btn-primary" on> <i class='bx bx-plus' ></i> Añadir detalle </button>
        </div>
        <div class="details">
            @if ($info->id)
                @include('ie.movi.form.detalle' , ['cabecera'=>$info])
            @endif
        </div>
  </div>

 </div>

</div>

 <div class="card mt-2">
  <div class="card-body"> 

  <div id="cabecera-movimiento">
    <div class="">
      <div class="divider m-0">
        <div class="divider-text"><h4>Últimos movimientos</h4></div>
      </div>

      @include('ie.IncomeExpenses.list-cabecera')

  </div>

@section('addFooter')
 <script src="{{asset('assets/js/validaciones-thirdparties.js')}}"></script>
 <script>

      function setAutoPrestamos(){

          var nit1 =  $('#id_company').attr('data-nit');
          var nit2 =  $('#id_thirdparti').attr('data-nit');

          if (nit1 != nit2){
                $('#id_account_2').val('');
                fn.alert("No se puede realizar el traslado propio, la empresa debe ser la misma.");
                return false;
          }else{

              var account1 =  $('#id_account').val();
              var account2 =  $('#id_account_2').val();

              if (account1 == account2){
                  $('#id_account_2').val('');
                  fn.alert("La cuenta de destino no puede ser igual a la de origen.");
                  return false;
              } 

              // Obtener el valor del campo
              var valor = $("#valor").val();
              // Validar si el valor  es positivo
              if (valor >= 0) {
                $('#valor').val('');
                  fn.alert("El valor no puede ser positivo");
                  return false;
              } 



              if ($('#id_account_2').val()){
                $('#cla_thirdparti').val('')
                $('#cla_classification').val('');
                $('[data-bs-dismiss="modal"]').click();
                $('#btnSaveCabecera').click()
              }else{
                fn.alert("Seleccione la cuenta de destino");
                return false;
              }
          }

      }

      function setInterEmpresaConsorcio(){
            if ($('#id_account_3').val()){
              $('#id_account_2').val('');
              $('#cla_thirdparti').val('');
              $('#cla_classification').val('');
              $('[data-bs-dismiss="modal"]').click();
              $('#btnSaveCabecera').click()
            }else{
              fn.alert("Seleccione la cuenta de destino");
              return false;
            }
   

        }

      function setAutoPrestamos_modal(){

      var nit1 =  $('#id_company').attr('data-nit');
      var nit2 =  $('#id_thirdparti').attr('data-nit');

      if (nit1 != nit2){
            $('#id_account_2').val('');
            fn.alert("No se puede realizar el traslado propio, la empresa debe ser la misma.");
            return false;
      }else{

        // Obtener el valor del campo
        var valor = $("#valor").val();
        // Validar si el valor  es positivo
        if (valor >= 0) {
          $('#valor').val('');
            fn.alert("El valor no puede ser positivo");
            return false;
        } 

        $('#tp_movimiento').modal('show');

      }

      }

      function setInterEmpresaConsorcio_modal(){
        //Valida que el movimiento sea a una empresa y no aun tercero
      var selectedNit = $('#id_thirdparti').attr('data-nit');
      
      if ($('#id_company option[data-nit="' + selectedNit + '"]').length > 0) {
        console.log('Aplica');
      } else {
        fn.alert("El tercero debe ser una empresa del consorcio ");
        return false;
      }

      //Valida que el movimiento no sea a la miema empresa
      var selectedNit = $('#id_thirdparti').attr('data-nit');

      var nit1 =  $('#id_company').attr('data-nit');
      var nit2 =  $('#id_thirdparti').attr('data-nit');

      if (nit1 == nit2){
            $('#id_account_3').val('');
            fn.alert("La empresa no puede ser igual al tercero");
            return false;
      }else{

        // Obtener el valor del campo
        var valor = $("#valor").val();
        // Validar si el valor  es positivo
        if (valor >= 0) {
          $('#valor').val('');
            fn.alert("El valor no puede ser positivo");
            return false;
        } 

        $('#tp_movimiento_interempresa').modal('show');

      }


      

      }
      
      function setInterEmpresas(){
        if ($('#cla_thirdparti').val()){
            $('#id_account_2').val('');
            $('#cla_classification').val(6);
            $('[data-bs-dismiss="modal"]').click();
            $('#btnSaveCabecera').click()
        }else{
          $('#cla_thirdparti').focus();
        }

      }

      function checkRequired(value, comp , obj){
          if (value==comp){
              $('#'+obj).removeAttr('required');
          }else{
              $('#'+obj).prop('required',true);
          }
      }

      function enableCompany(value ){
          if (value==6){
              $('#box_cla_thirdparti').removeClass('hide');
          }else{
              $('#box_cla_thirdparti').addClass('hide');
          }
      }

      

      function loadBankAccount(obj){
      
        if (!obj.value) return false;
        console.log(obj.value);
                fn.ajax({
                          beforeSend : function(){
                            fn.wait();
                          },
                          data : {id_company : obj.value },
                          url  : '{{route('movi.ajax', ['opc'=>'loadBankAccount'])}}',
                          method : 'post',
                          success : function(rs){
                            if (rs.html){
                              $('#id_account , #id_account_2').html(rs.html);
                            }
                          },
                          complete: function(){
                            selectThirdparti();
                            fn.closeWait()
                          },
                          error : function(){
                            fn.alert("Se ha producido un error");
                          }
                        })
      }


      function loadBankAccount_third(obj){
        setTimeout(function() {
        var selectedNit = $('#id_thirdparti').attr('data-nit');
        console.log(selectedNit);
        var selectedidCompany = $('#id_company option[data-nit="' + selectedNit + '"]').val();
        console.log(selectedidCompany);
        $('#id_account_3').val('');
        fn.ajax({
                  beforeSend : function(){
                   
                  },
                  data : {'id_company' : selectedidCompany},
                  url  : '{{route('movi.ajax', ['opc'=>'loadBankAccount'])}}',
                  method : 'post',
                  success : function(rs){
                    if (rs.html){
                      $('#id_account_3').html(rs.html);
                    }
                  },
                  complete: function(){
                  
                  },
                  error : function(){
                    fn.alert("Se ha producido un error");
                  }
                })
              }, 2000);
        }


        function selectThirdpartiNewDetail(){

        $('.price').last().each(function() {
            currencyFormatter($(this).attr('id'));
        });


        $('.id_company').select2({
                  formatNoMatches: function () {
                      return "Sin resultados.";
                  }
        });

        $('.id_classification').select2({
                  formatNoMatches: function () {
                      return "Sin resultados.";
                  }
        });

        $('.id_cost_centers').select2({
                  formatNoMatches: function () {
                      return "Sin resultados.";
                  }
        });

        $('.id_concept').select2({
                  formatNoMatches: function () {
                      return "Sin resultados.";
                  }
        });

        $('.id_accounts').select2({
                  formatNoMatches: function () {
                      return "Sin resultados.";
                  }
        });



        $('.id_thirdparti').select2({
                ajax: {
                    url: '{{route('terceros.ajax',['opc'=>'load-thirdparties'])}}',
                    dataType: 'json', 
                    type: "get",
                    delay: 250,
                    data: function (params) {
                        return { search: params.term }
                    }  
                }})
        }
        
        $('.id_thirdparti').on('select2:select', function (e) {
          var data = e.params.data;
          $('#id_thirdparti').attr('data-nit', data.nit );
            // console.log(data);
        });

      function selectThirdparti(){
        

          $('.price').each(function() {
              currencyFormatter($(this).attr('id'));
          });


          $('.id_company').select2({
                    formatNoMatches: function () {
                        return "Sin resultados.";
                    }
          });

          $('.id_classification').select2({
                    formatNoMatches: function () {
                        return "Sin resultados.";
                    }
          });

          $('.id_cost_centers').select2({
                    formatNoMatches: function () {
                        return "Sin resultados.";
                    }
          });

          $('.id_concept').select2({
                    formatNoMatches: function () {
                        return "Sin resultados.";
                    }
          });

          $('.id_accounts').select2({
                    formatNoMatches: function () {
                        return "Sin resultados.";
                    }
          });

          

          $('.id_thirdparti').select2({
                  ajax: {
                      url: '{{route('terceros.ajax',['opc'=>'load-thirdparties'])}}',
                      dataType: 'json', 
                      type: "get",
                      delay: 250,
                      data: function (params) {
                          return { search: params.term }
                      }  
                  }})
          
          $('.id_thirdparti_compnay').select2({
                  ajax: {
                      url: '{{route('terceros.ajax',['opc'=>'load-thirdparties-company'])}}',
                      dataType: 'json', 
                      type: "get",
                      delay: 250,
                      data: function (params) {
                          return { search: params.term }
                      }  
                  }})
      }

      $(function(){

                selectThirdparti();

                
                $(document).on('focus', '.select2-selection.select2-selection--single', function (e) {
                   $(this).closest(".select2-container").siblings('select:enabled').select2('open');
                });
                
                $('#form-movimiento').submit(function(e){

                        if (!checkCompany()){
                          return false;
                        }

                        fn.ajax({
                                   beforeSend : function(){
                                     fn.wait();
                                   },
                                   data : $('#form-movimiento').serializeJSON(),
                                   url  : '{{route('movi.ajax', ['opc'=>'saveCabecera'])}}',
                                   method : 'post',
                                   success : function(rs){

                                        if (rs?.redirec){
                                           window.location = rs.url;
                                        }
                                    
                                        if (rs.html){
                                            $('#detalle-movimiento .details').html(rs.html);
                                        }

                                        if (rs.id){
                                          $('#id').val(rs.id);
                                        }
                                        fn.closeWait();
                                   },
                                   complete: function(){
                                     $('#eventMore').removeClass('d-none')
                                     selectThirdparti();
                                     $('.removeAfterSave').remove();
                                     fn.closeWait()
                                   },
                                   error : function(){
                                     fn.alert("Se ha producido un error");
                                   }
                        })

                        $('#addDetMovimiento').click(function(){
                          
                          
                                if (!$('#tipomovimientoDet').val()){
                                    $('#tipomovimientoDet').focus()
                                }else{

                                    fn.ajax({
                                              beforeSend : function(){
                                                disabled('#tipomovimientoDet, #addDetMovimiento');
                                                fn.wait();
                                              },
                                              data : { type : $('#tipomovimientoDet').val()},
                                              url  : '{{route('movi.ajax', ['opc'=>'detalle'])}}',
                                              method : 'post',
                                              success : function(rs){
                                                    if (rs.html){
                                                      $('#detalle-movimiento .details').append(rs.html);
                                                    }
                                              },
                                              complete: function(){
                                                fn.applyPlugins()
                                                enabled('#tipomovimientoDet, #addDetMovimiento');
                                                fn.closeWait()
                                              },
                                              error : function(){
                                                fn.alert("Se ha producido un error");
                                              }

                                            })

                                    
                                } 
                        })
               })
        })

        function addMoviment(){
         
                fn.ajax({
                          beforeSend : function(){
                              fn.wait('Por favor espere');
                          },
                          url  : '{{route('movi.ajax', ['opc'=>'addMoviment'])}}',
                          method : 'post',
                          success : function(rs){
                            if (rs.html)  $('#detalles_ingegre').append(rs.html);
                          },
                          complete: function(){
                            selectThirdpartiNewDetail();
                            fn.closeWait()
                          },
                          error : function(){
                              fn.alert("Se ha producido un error");
                          }

              })

        }

        function price(boxID){
          console.log( $('#price'+boxID).val().replaceAll('.','').replaceAll(',','.') );
            return $('#price'+boxID).val().replaceAll('.','').replaceAll(',','.');
        }

        function movimiento(boxID){
            return ( price(boxID) > 0) ? 1 : 4 ;
        }

        function checkMoviment(obj, boxID){

            var typeMoviment = movimiento(boxID);

            // Si el tipo movimiento es diferente al inicial se resetea
            if ( typeMoviment != $('#movement_type'+boxID).val() && $('#movement_type'+boxID).val() ){
                // Listamos nuevamente la clasificación 
                // reloadClasificacion( typeMoviment , boxID);
                
                

                $('#id_cost_centers'+boxID).html('');
                $('#id_concept'+boxID).html('');
                $('#id_concept'+boxID).html('');
                 
                // Se establece el nuevo tipo de movimiento
                $('#movement_type'+boxID).val(typeMoviment)
                
                loadCCCONCPTO(boxID , typeMoviment , null );

                fn.alert("Se modifico el tipo de movimiento deberá seleccionar los datos nuevamente!!");

            }else{
                $('#movement_type'+boxID).val(typeMoviment)
                // reloadClasificacion( typeMoviment , boxID);
            }

        }

        function reloadClasificacion(typeMoviment , boxID){

                 fn.ajax({
                          data : { tipomov : typeMoviment },
                          url  : '{{route('movi.ajax', ['opc'=>'loadClasificaion'])}}',
                          method : 'post',
                          success : function(rs){
                            if (rs.html){
                                $('#id_classification'+boxID).html(rs.html);
                            }
                          },
                          complete: function(){
                            // fn.applyPlugins()
                          },
                          error : function(){
                              fn.alert("Se ha producido un error");
                          }

                         })
        }

        function loadCCCONCPTO (token , tipomov , clasificaion){

                      var id_classification = $('#id_classification'+token).val();

                      if (!id_classification) return ;
                      if (!$('#id_company'+token).val()) return ;

                      if (id_classification){
                         var exludeCC = ["2","9","8"];
                         if (exludeCC.includes(id_classification)){
                              $('#id_cost_centers'+token).removeClass('row-detalle').removeAttr('required')
                         }else{
                              $('#id_cost_centers'+token).addClass('row-detalle').prop('required',true)
                         }
                      }

                      var data = { tipomov : $('#movement_type'+token).val() , 
                                   clasificaion : $('#id_classification'+token).val(),
                                   id_company : $('#id_company'+token).val()
                                 }
                      fn.ajax({
                          data : data,
                          url  : '{{route('movi.ajax', ['opc'=>'loadcc'])}}',
                          method : 'post',
                          success : function(rs){
                                  if (rs.cc.html){
                                      $('#id_cost_centers'+token).html(rs.cc.html);
                                  }else{
                                      $('#id_cost_centers'+token).html('');
                                      if (data.clasificaion && data.id_company){
                                          //fn.warning('No existen centos de costos para esta combinación');
                                      }
                                      
                                  }

                                  if (rs.concepto.html){
                                      $('#id_concept'+token).html(rs.concepto.html);
                                  }else{
                                      $('#id_concept'+token).html('');
                                  }

                                  if (rs.accounts.html){
                                      $('#id_accounts'+token).html(rs.accounts.html);
                                  }else{
                                      $('#id_accounts'+token).html('');
                                  }

                          },
                          complete: function(){
                            selectThirdparti();
                          },
                          error : function(){
                              fn.alert("Se ha producido un error");
                          }
                         })
        }

        function loadAccountCount(token){

            var concepto     = $('#id_concept'+token).val(); 

            fn.ajax({
                  data : {  concepto : concepto },
                  url  : '{{route('movi.ajax', ['opc'=>'accountcount'])}}',
                  method : 'post',
                  success : function(rs){
                        if (rs.html){
                            $('#id_ledgeraccount'+token).html(rs.html);
                        }
                  },
                  complete: function(){
                    selectThirdparti();
                  },
                  error : function(){
                    fn.alert("Se ha producido un error");
                  }
                })

       }

       function setNit(obj, value , token){
           $(obj).attr('data-nit', $('#'+token+' option[value="'+value+'"]').attr('data-nit'));
       }


   </script>

@endsection