<script>

    $(function(){

            @if (Route::is("{$slug}.new.parent") )
                // $('#id_parent').prop("disabled", true) 
                $('#id_parent').next('.select2').hide()
                $('<input type="text" readonly class="form-control-plaintext" value="'+$("#id_parent option:selected").text()+'">').prependTo($('#id_parent').parent('div'));
                setInfoCCForm('{{Request()->id_parent}}');
            @endif

            @if (Route::is("{$slug}.edit") )
                $('#id_parent').next('.select2').hide();
                $('<input type="text" readonly class="form-control-plaintext" value="'+$("#id_parent option:selected").text()+'">').prependTo($('#id_parent').parent('div'));
                $('#id_company').next('.select2').hide();
                $('<input type="text" readonly class="form-control-plaintext" value="'+$("#id_company option:selected").text()+'">').prependTo($('#id_company').parent('div'));
                $('#code').hide();
                $('<input type="text" readonly class="form-control-plaintext" value="'+$("#code").val()+'">').prependTo($('#code').parent('div'));
            // $('#id_parent , #id_company , #code').prop("disabled", true);
            @endif

            var form  = $('.btn-success').parents('form');
            $(form).submit(function(){
                $('#prefixCC').html('');
                if ($('[name="prefixCC"]').length){
                    $('#code').val( $('[name="prefixCC"]').val()+ $('#code').val())    
                }else{
                    $('#code').val( $('#code').val() )    
                }
                
            })

    })
  // btn-success

function setInfoCCForm(valor){

    fn.ajax({
               beforeSend : function(){
                    fn.wait("Por favor espere...");
               },
               data: { cc : valor },
               url : "{{route($slug.'.ajax',['opc'=>'InfoCC'])}}",
               method : 'post',
               success : function(rs){
                    if (rs.success){
                        if (rs.id_company) {
                            $('#id_company').next('.select2').hide()
                            $("#id_company").val(rs.id_company).change();
                            $('<input type="text" readonly class="form-control-plaintext" value="'+$("#id_company option:selected").text()+'">').prependTo($('#id_company').parent('div'));
                        }
                        if (rs.prefixCC) {
                            $("[name='prefixCC']").val(rs.prefixCC)
                            $("#prefixCC").html(rs.prefixCC)
                            $('#code').focus();
                        }
                    }
               },
               complete : function(rs){

                  

                 fn.closeWait()
               }
            })
  
  }
</script>