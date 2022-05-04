//FUNCIONES USADAS POR EL SISTEMA

//funcion para agregar mas referencias a los clientes
var campos_max          = 11;   //max de 10 campos
var x = 2;
$('#add_field').click (function(e) {
    e.preventDefault();     //prevenir novos clicks
    if (x < campos_max) 
    {
        //agregar modal de las referencias
        $('#modalref').append('<div id="notas_referencias'+x+'" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">\
            <div class="modal-dialog modal-lg" role="document">\
                <div class="modal-content">\
                    <div class="modal-header bg-secundary text-black">\
                        <h5 class="modal-title" id="my-modal-title">Notas de la referencia</h5>\
                        <button class="close" data-dismiss="modal" aria-label="Close">\
                            <span aria-hidden="true">&times;</span>\
                        </button>\
                    </div>\
                    <div class="modal-body">\
                            <div class="form-group">\
                                 <textarea class="form-control" name="notas_ref[]" title="Ingrese las notas requeridas" id="notas" placeholder="Ingrese las notas requeridas" maxlength="50000" style="height: 400px;"></textarea>\
                            </div>\
                    </div>\
                </div>\
            </div>\
        </div>');

        $('#listas').append("<div id='card_ref' class='card'>\
                <div class='card-body'>\
                        <div class='row'>\
                            <div class='form-group col-lg-6'>\
                                <label for='nombre_ref1'>Nombre Referencia</label>\
                                <input type='text' class='form-control' name='nombre_ref[]' required>\
                            </div>\
                            <div class='col-lg-2' align='center'>\
                            <label>Notas</label><br>\
                                <a data-toggle='modal' data-target='#notas_referencias"+x+"' href='#'><i class='far fa-clipboard fa-4x'></i></a>\
                            </div>\
                            <div class='form-group col-lg-3'>\
                                <label for='relacion_ref1'>Relación</label>\
                                <input type='text' class='form-control' name='relacion_ref[]' required>\
                            </div>\
                            <div class='form-group col-lg-6'>\
                                <label for='dom_ref1'>Domicilio Referencia</label>\
                                <input type='text' class='form-control' name='dom_ref[]' required>\
                            </div>\
                            <div class='col-lg-2'></div>\
                            <div class='form-group col-lg-3'>\
                                <label for='tel_ref1'>Teléfono</label>\
                                <input type='text' class='form-control' placeholder='exp. 9610000000' name='tel_ref[]' required >\
                            </div>\
                            <div class='col-lg-1' align='right'>\
                                <a href='#' class='remover_campo'><i style='color: red;' class='fas fa-trash-alt fa-2x'></i></a>\
                            </div>\
                        </div>\
            </div>\
        </div>");
        x++;
    }
});

function mostrar_refs(x)
{  
    var campos_max = 11;   //max de 10 campos
    if (x < campos_max) 
    {
        //agregar modal de las referencias
        $('#modalref').append('<div id="notas_referencias'+x+'" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">\
            <div class="modal-dialog modal-lg" role="document">\
                <div class="modal-content">\
                    <div class="modal-header bg-secundary text-black">\
                        <h5 class="modal-title" id="my-modal-title">Notas de la referencia</h5>\
                        <button class="close" data-dismiss="modal" aria-label="Close">\
                            <span aria-hidden="true">&times;</span>\
                        </button>\
                    </div>\
                    <div class="modal-body">\
                            <div class="form-group">\
                                 <textarea class="form-control" name="notas_ref[]" title="Ingrese las notas requeridas" id="notas" placeholder="Ingrese las notas requeridas" maxlength="50000" style="height: 400px;"></textarea>\
                            </div>\
                    </div>\
                </div>\
            </div>\
        </div>');

        $('#listas').append("<div id='card_ref' class='card'>\
                <div class='card-body'>\
                        <div class='row'>\
                            <div class='form-group col-lg-6'>\
                                <label for='nombre_ref1'>Nombre Referencia</label>\
                                <input type='text' class='form-control' name='nombre_ref[]' required>\
                            </div>\
                            <div class='col-lg-2' align='center'>\
                            <label>Notas</label><br>\
                                <a data-toggle='modal' data-target='#notas_referencias"+x+"' href='#'><i class='far fa-clipboard fa-4x'></i></a>\
                            </div>\
                            <div class='form-group col-lg-3'>\
                                <label for='relacion_ref1'>Relación</label>\
                                <input type='text' class='form-control' name='relacion_ref[]' required>\
                            </div>\
                            <div class='form-group col-lg-6'>\
                                <label for='dom_ref1'>Domicilio Referencia</label>\
                                <input type='text' class='form-control' name='dom_ref[]' required>\
                            </div>\
                            <div class='col-lg-2'></div>\
                            <div class='form-group col-lg-3'>\
                                <label for='tel_ref1'>Teléfono</label>\
                                <input type='text' class='form-control' placeholder='exp. 9610000000' name='tel_ref[]' required >\
                            </div>\
                            <div class='col-lg-1' align='right'>\
                                <a href='#' class='remover_campo'><i style='color: red;' class='fas fa-trash-alt fa-2x'></i></a>\
                            </div>\
                        </div>\
            </div>\
        </div>");
        x++;
    }
    $('#button_agre').remove();
    $('#button_agregar').append('<button id="button_agre" onclick="mostrar_refs('+x+');" class="btn btn-primary" type="button" ><i class="fas fa-plus"></i> Añadir Referencia</button>');
}

function borrar_card(idcard)
{
    $('#borrador'+idcard).remove();
}

// Remover o div anterior
$('#listas').on("click",".remover_campo",function(e) 
{
    e.preventDefault();
    $('#card_ref').remove();
    //$(this).parent('div').remove();
    x--;
});

function show_search_box()
{
    $('#tbl_productos').DataTable({
  "columnDefs": [{
   "targets": 0
  }],
  language: {
   "sProcessing": "Procesando...",
   "sLengthMenu": "Mostrar _MENU_ resultados",
   "sZeroRecords": "No se encontraron resultados",
   "sEmptyTable": "Ningún dato disponible en esta tabla",
   "sInfo": "Mostrando resultados _START_-_END_ de  _TOTAL_",
   "sInfoEmpty": "Mostrando resultados del 0 al 0 de un total de 0 registros",
   "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
   "sSearch": "Buscar:",
   "sLoadingRecords": "Cargando...",
   "oPaginate": {
    "sFirst": "Primero",
    "sLast": "Último",
    "sNext": "Siguiente",
    "sPrevious": "Anterior"
   },
  }
 });
}

$(document).ready(function() 
{
    $(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

 //para el select2 multiple
 $('.js-example-basic-multiple').select2();
    //funcion para poner tablas en español
show_search_box();
//fin tablas en español

//para habilitar la edicion en cliente
$('#btneditar_cliente').click (function(e) {
    e.preventDefault();     //prevenir novos clicks
    $('#all_inputs').removeAttr("disabled");
    $('#nivel_select').removeAttr("disabled");
    $('#masinfo').bootstrapToggle('enable');
    $('#apto_credito').bootstrapToggle('enable');
    $('#update_cliente').removeAttr("disabled");
    $('#btneliminar_refs').removeAttr("style");
    $('#btnregresar').attr('onClick','preguntar_regresar()');
    $('#btnregresar').removeAttr("href");
});

//mostrar conyugue
$('#idestado_civil').change(function() { 
    var opval = $(this).val();
    if(opval=="si")
    {
        $('#card_conyugue').collapse('show');
    }
    else
    {
        $('#card_conyugue').collapse('hide');
    }
    });

    //para el form de agregar nuevo tipo
    $("#formAdd_tipo").submit( function () {  
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();
        $.ajax({                        
           type: 'POST',                 
           url: 'ajax_forms.php',                     
           data: $(this).serialize(),
           success: function(response)             
           {
                if(response == 0)
                {
                    Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error, intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                window.location.href = "agregar_sucursal.php";
                            }
                        }) 
                }
                else
                {
                    $('#nuevo_tipo').modal('hide');
                    //limpiar el input
                    $('#nuevotipo').val('');
                    var data = $.parseJSON(response);
                    $('#tipo').append($('<option>',
                    {
                        value: data.idtipo,
                        text : data.nombre_tipo
                    }));
                    Swal.fire(
                          'Agregado!',
                          '!Se agrego el nuevo tipo!',
                          'success'
                        ).then((result) => {
                            if (result.isConfirmed)
                            {}
                        })
                }         
           }
       });   
        return false;   
    });

    //para el form de editar un tipo
    $("#formEdit_tipo").submit( function () {  
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();
        $.ajax({                        
           type: 'POST',                 
           url: 'ajax_forms.php',                     
           data: $(this).serialize(),
           success: function(response)             
           {
                if(response == 0)
                {
                    Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error, intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                window.location.href = "sucursales.php";
                            }
                        }) 
                }
                else
                {
                    $('#editar_tipo').modal('hide');
                    //limpiar el input
                    $('#newedit_tipo').val('');
                    var data = $.parseJSON(response);
                    $('#tipo option[value="'+data.idtipo+'"]').text(data.nombre_tipo);
                    Swal.fire(
                          '!Editado!',
                          '!Se actualizo el tipo selecionado!',
                          'success'
                        ).then((result) => {
                            if (result.isConfirmed)
                            {}
                        })
                }         
           }
       });   
        return false;   
    });

    //=================
    //para el form de agregar nuevo tipo
    $("#formAdd_puesto").submit( function () {  
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();
        $.ajax({                        
           type: 'POST',                 
           url: 'ajax_forms.php',                     
           data: $(this).serialize(),
           success: function(response)             
           {
                if(response == 0)
                {
                    Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error, intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                window.location.href = "agregar_usuario.php";
                            }
                        }) 
                }
                else
                {
                    $('#nuevo_puesto').modal('hide');
                    //limpiar el input
                    $('#newpuesto').val('');
                    $('#desc_puesto').val('');
                    var data = $.parseJSON(response);
                    $('#puesto').append($('<option>',
                    {
                        value: data.idpuesto,
                        text : data.nombre_puesto
                    }));
                    Swal.fire(
                          'Agregado!',
                          '!Se agrego el nuevo puesto!',
                          'success'
                        ).then((result) => {
                            if (result.isConfirmed)
                            {}
                        })
                }         
           }
       });   
        return false;   
    });

    //para el form de editar un tipo
    $("#formEdit_puesto").submit( function () {  
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();
        $.ajax({                        
           type: 'POST',                 
           url: 'ajax_forms.php',                     
           data: $(this).serialize(),
           success: function(response)             
           {
                if(response == 0)
                {
                    Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error, intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                window.location.href = "usuarios.php";
                            }
                        }) 
                }
                else
                {
                    $('#editar_puesto').modal('hide');
                    //limpiar el input
                    $('#newpuesto_edit').val('');
                    $('#desc_puesto_edit').val('');
                    var data = $.parseJSON(response);
                    $('#puesto option[value="'+data.idpuesto+'"]').text(data.nombre_puesto);
                    Swal.fire(
                          '!Editado!',
                          '!Se actualizo el puesto selecionado!',
                          'success'
                        ).then((result) => {
                            if (result.isConfirmed)
                            {}
                        })
                }         
           }
       });   
        return false;   
    });

    //para el form de insertar una zona
    $("#formAdd_zona").submit( function () {  
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();
        $.ajax({                        
           type: 'POST',                 
           url: 'ajax_forms.php',                     
           data: $(this).serialize(),
           success: function(response)             
           {
                if(response == 0)
                {
                    Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error, intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                window.location.href = "agregar_cliente.php";
                            }
                        }) 
                }
                else
                {
                    $('#nueva_zona').modal('hide');
                    //limpiar el input
                    $('#nuevazona').val('');
                    var data = $.parseJSON(response);
                    $('#zona').append($('<option>',
                    {
                        value: data.idzona,
                        text : data.zona
                    }));
                    $('#zona').val(data.idzona).change();
                    $('#zona_subzona').append($('<option>',
                    {
                        value: data.idzona,
                        text : data.zona
                    }));
                    $('#zona_subzona_edit').append($('<option>',
                    {
                        value: data.idzona,
                        text : data.zona
                    }));
                    Swal.fire(
                          '!Agregado!',
                          '!Se guardo la nueva zona!',
                          'success'
                        ).then((result) => {
                            if (result.isConfirmed)
                            {}
                        })
                }         
           }
       });   
        return false;   
    });

    //para el form de editar una zona
    $("#formEdit_zona").submit( function () {  
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();
        $.ajax({                        
           type: 'POST',                 
           url: 'ajax_forms.php',                     
           data: $(this).serialize(),
           success: function(response)             
           {
                if(response == 0)
                {
                    Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error, intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                window.location.href = "clientes.php";
                            }
                        }) 
                }
                else
                {
                    $('#editar_zona').modal('hide');
                    //limpiar el input
                    $('#newzona_edit').val('');
                    var data = $.parseJSON(response);
                    $('#zona option[value="'+data.idzona+'"]').text(data.zona);
                    $('#zona_subzona option[value="'+data.idzona+'"]').text(data.zona);
                    $('#zona_subzona_edit option[value="'+data.idzona+'"]').text(data.zona);
                    Swal.fire(
                          '!Editado!',
                          '!Se actualizo la zona selecionada!',
                          'success'
                        ).then((result) => {
                            if (result.isConfirmed)
                            {}
                        })
                }         
           }
       });   
        return false;   
    });

    //para el form de insertar una subzona
    $("#formAdd_subzona").submit( function () {  
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();
        $.ajax({                        
           type: 'POST',                 
           url: 'ajax_forms.php',                     
           data: $(this).serialize(),
           success: function(response)             
           {
                if(response == 0)
                {
                    Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error, intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                window.location.href = "agregar_cliente.php";
                            }
                        }) 
                }
                else
                {
                    $('#nueva_subzona').modal('hide');
                    //limpiar el input
                    $('#nuevasubzona').val('');
                    var data = $.parseJSON(response);
                    $('#subzona').append($('<option>',
                    {
                        value: data.idsubzona,
                        text : data.subzona
                    }));
                    $('#subzona').val(data.idsubzona).change();
                    Swal.fire(
                          '!Agregado!',
                          '!Se guardo la nueva subzona!',
                          'success'
                        ).then((result) => {
                            if (result.isConfirmed)
                            {}
                        })
                }         
           }
       });   
        return false;   
    });

    //para el form de editar una zona
    $("#formEdit_subzona").submit( function () {  
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();
        $.ajax({                        
           type: 'POST',                 
           url: 'ajax_forms.php',                     
           data: $(this).serialize(),
           success: function(response)             
           {
                if(response == 0)
                {
                    Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error, intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                window.location.href = "clientes.php";
                            }
                        }) 
                }
                else
                {
                    $('#editar_subzona').modal('hide');
                    //limpiar el input
                    $('#newsubzona_edit').val('');
                    var data = $.parseJSON(response);
                    //$('#prueba12').html(data.cambiozona);
                    if(data.cambiozona == '1')
                    {
                        //quitar la subzona del selec y seleccionar las nuevas zonas y subzona
                        $("#subzona option[value='"+data.idsubzona+"']").remove();
                        $('#zona').val(data.idzona_subzona).change();
                        $('#subzona option[value="'+data.idsubzona+'"]').text(data.subzona);
                        $('#subzona option[value="'+data.idsubzona+'"]').attr("selected", "selected");
                    }
                    else
                    {
                        $('#subzona option[value="'+data.idsubzona+'"]').text(data.subzona);
                    }
                    Swal.fire(
                          '!Editado!',
                          '!Se actualizo la subzona selecionada!',
                          'success'
                        ).then((result) => {
                            if (result.isConfirmed)
                            {}
                        })
                }         
           }
       });   
        return false;   
    });

    //AQUI van los forms para insertar, y editar de categoria, subcategoria y producto
    //form de insertar categoria
    $("#formAdd_cat").submit( function () {  
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();
        $.ajax({                        
           type: 'POST',                 
           url: 'ajax_forms.php',                     
           data: $(this).serialize(),
           success: function(response)             
           {
                if(response == 0)
                {
                    Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error, intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                window.location.href = "productos.php";
                            }
                        }) 
                }
                else
                {
                    $('#nueva_cat').modal('hide');
                    //limpiar el input
                    //$('#prueba').html(response);
                    $('#nombre_cat,#atr1,#atr2,#atr3,#atr4,#atr5,#contado,#especial,#credito1,#credito2,#mesespago,#garantia').val('');
                    var data = $.parseJSON(response);
                    if(data.flag_insert == 1)
                    {
                        //insertamos la nueva option en los selects
                        $('#categoria').append($('<option>',
                        {
                            value: data.idcategoria,
                            text : data.categoria
                        }));
                        $('#categoria').val(data.idcategoria).change();
                        $('#categoria_subcategoria').append($('<option>',
                        {
                            value: data.idcategoria,
                            text : data.categoria
                        }));
                        $('#categoria_producto').append($('<option>',
                        {
                            value: data.idcategoria,
                            text : data.categoria
                        }));
                    }
                    else
                    {
                        //actualizamos el texto de la opcion modificada
                        $('#categoria option[value="'+data.idcategoria+'"]').text(data.categoria);
                        $('#categoria_subcategoria option[value="'+data.idcategoria+'"]').text(data.categoria);
                        $('#categoria_producto option[value="'+data.idcategoria+'"]').text(data.categoria);
                        //$('#prueba').html(data.sentencia);
                    }
                    Swal.fire(
                          '!Agregado!',
                          '!Se guardo la nueva categoría!',
                          'success'
                        ).then((result) => {
                            if (result.isConfirmed)
                            {}
                        })
                }         
           }
       });   
        return false;   
    });

    //form para insertar e editar una subcategoria
    $("#formAdd_subcat").submit( function () {  
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();
        $.ajax({                        
           type: 'POST',                 
           url: 'ajax_forms.php',                     
           data: $(this).serialize(),
           success: function(response)             
           {
                if(response == 0)
                {
                    //$('#prueba').html(response);
                    Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error, intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                window.location.href = "productos.php";
                            }
                        }) 
                }
                else
                {
                    $('#nueva_subcat').modal('hide');
                    //limpiar el input
                    //$('#prueba').html(response);
                    $('#nombre_subcat,#atr1_sub,#atr2_sub,#atr3_sub,#atr4_sub,#atr5_sub,#contado_sub,#especial_sub,#credito1_sub,#credito2_sub,#mesespago_sub,#garantia_sub').val('');
                    var data = $.parseJSON(response);
                    if(data.flag_insert == 1)
                    {
                        //insertamos la nueva option en los selects
                        $('#subcategoria').append($('<option>',
                        {
                            value: data.idsubcategoria,
                            text : data.subcategoria
                        }));
                        $('#subcategoria').val(data.idsubcategoria).change();
                        $('#subcategoria_producto').append($('<option>',
                        {
                            value: data.idsubcategoria,
                            text : data.subcategoria
                        }));
                    }
                    else
                    {
                        //actualizamos el texto de la opcion modificada
                        $('#subcategoria option[value="'+data.idsubcategoria+'"]').text(data.subcategoria);
                        $('#subcategoria_producto option[value="'+data.idsubcategoria+'"]').text(data.subcategoria);
                        //$('#prueba').html(data.sentencia);
                    }
                    Swal.fire(
                          '!Agregado!',
                          '!Se guardo la nueva subcategoría!',
                          'success'
                        ).then((result) => {
                            if (result.isConfirmed)
                            {}
                        })
                }         
           }
       });   
        return false;   
    });

    //para las tablas que no son de productos
    $('#tbl').DataTable({
  "columnDefs": [{
   "targets": 0
  }],
  language: {
   "sProcessing": "Procesando...",
   "sLengthMenu": "Mostrar _MENU_ resultados",
   "sZeroRecords": "No se encontraron resultados",
   "sEmptyTable": "Ningún dato disponible en esta tabla",
   "sInfo": "Mostrando resultados _START_-_END_ de  _TOTAL_",
   "sInfoEmpty": "Mostrando resultados del 0 al 0 de un total de 0 registros",
   "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
   "sSearch": "Buscar:",
   "sLoadingRecords": "Cargando...",
   "oPaginate": {
    "sFirst": "Primero",
    "sLast": "Último",
    "sNext": "Siguiente",
    "sPrevious": "Anterior"
   },
  }
 });

    //oculta las columnas de costos de la tabla productos
    hide_costos();

//FIN DEL DOCUMENT READY
});

function hide_costos()
{
    $('#tbl_productos td:nth-child(2)').hide();
    $('#tbl_productos th:nth-child(2)').hide();
    $('#tbl_productos td:nth-child(3)').hide();
    $('#tbl_productos th:nth-child(3)').hide();
    $('#tbl_productos td:nth-child(4)').hide();
    $('#tbl_productos th:nth-child(4)').hide();
}

//para hacer mayusculas
function mayusculas(e) {
    e.value = e.value.toUpperCase();
}

//funciones y cosas para el modulo productos
$('#tiene_subcat').change(function()
{
  if (document.getElementById('tiene_subcat').checked)
  {
    $("#formAdd_cat :input:not(#nombre_cat,#tiene_subcat,#btn_guardarcat,#btn_cancerlarcat,#atr1,#action,#flagidcategoria)").attr("disabled","disabled");
    $('#atr1,#atr2,#atr3,#atr4,#atr5,#contado,#especial,#credito1,#credito2,#mesespago,#garantia').val('');
  }
  else
  {
    $("#formAdd_cat :input:not(#nombre_cat,#tiene_subcat,#btn_guardarcat,#btn_cancerlarcat,#atr1,#action,#flagidcategoria)").removeAttr("disabled");
    $('#atr1').val('MARCA');
  }
});

//agregar todas las sucursales existentes al select 
function cargar_todas_sucursales()
{
  $('#sucursal').select2('destroy').find('option').prop('selected', 'selected').end().select2();
}

//para desplegar las subzonas apartir de las zonas
$('#zona').change(function(e) 
{
    e.preventDefault();
    var idzona = $(this).val();
    var zona = $('option[value='+idzona+']',this).text();
    $('#btnedit_zona').attr('onClick', 'editar_zona("'+idzona+'","'+zona+'");');
    $('#btnedit_zona').removeAttr('disabled');
    //y reiniciar el select de subzona
    $('#btnedit_subzona').attr('onClick', 'editar_subzona();');
    $('#btnedit_subzona').attr('disabled','disabled');
    $('#btneliminar_subzona').attr('onClick', 'eliminar_subzona();');
    $('#btneliminar_subzona').attr('disabled','disabled');
    
    var action = 'searchSubzonas';
    $.ajax({
      url: 'ajax.php',
      type: "POST",
      async: true,
      data: {action:action,zona:idzona},
      success: function(response) {
        //$('#nombre').val(response);
        if (response != 0)
        {
          var data = $.parseJSON(response);
          $("#subzona").empty();
          $('#subzona').append(data.options);
          if(data.allow_delete == 0)
          {
            $('#btneliminar_zona').attr('onClick', 'eliminar_zona("'+idzona+'");');
            $('#btneliminar_zona').removeAttr('disabled');
          }
          else
          {
            $('#btneliminar_zona').attr('onClick', 'eliminar_zona();');
            $('#btneliminar_zona').attr('disabled','disabled');
          }
          //$('#prueba').html(data); 
        }
      },
      error: function(error) {
        //$('#sucursal').val('error');
      }
    });
});

$('#subzona').change(function(e) 
{
    e.preventDefault();
    var idsubzona = $(this).val();
    $('#btnedit_subzona').attr('onClick', 'editar_subzona("'+idsubzona+'");');
    $('#btnedit_subzona').removeAttr('disabled');

    var action = 'searchSubzonaUsed';
    $.ajax({
      url: 'ajax.php',
      type: "POST",
      async: true,
      data: {action:action,subzona:idsubzona},
      success: function(response) {
        //var data = $.parseJSON(response);
        //$('#prueba12').html(response);
        if(response == 0)
        {
            $('#btneliminar_subzona').attr('onClick', 'eliminar_subzona("'+idsubzona+'");');
            $('#btneliminar_subzona').removeAttr('disabled');
        }
        else
        {
            $('#btneliminar_subzona').attr('onClick', 'eliminar_subzona();');
            $('#btneliminar_subzona').attr('disabled','disabled');
        }
          //$('#prueba').html(data); 
      },
      error: function(error) {
        //$('#sucursal').val('error');
      }
    });
});

//funcion para crear el boton de elimnar y editar de los puestos
$('#puesto').change(function(e) 
{
    e.preventDefault();
    var idpuesto = $(this).val();
    $('#btn_editarpuesto').attr('onClick', 'editar_puesto("'+idpuesto+'");');
    $('#btn_editarpuesto').removeAttr('disabled');

    var action = 'searchPuestoUsed';
    $.ajax({
      url: 'ajax.php',
      type: "POST",
      async: true,
      data: {action:action,puesto:idpuesto},
      success: function(response) {
        if(response == 0)
        {
            $('#btn_eliminarpuesto').attr('onClick', 'eliminar_puesto("'+idpuesto+'");');
            $('#btn_eliminarpuesto').removeAttr('disabled');
        }
        else
        {
            $('#btn_eliminarpuesto').attr('onClick', 'eliminar_puesto();');
            $('#btn_eliminarpuesto').attr('disabled','disabled');
        }
        //$('#prueba').html(data); 
      },
      error: function(error) {
        //$('#sucursal').val('error');
      }
    });
});

//funcion para crear el boton de elimnar y editar de los tipos
$('#tipo').change(function(e) 
{
    e.preventDefault();
    var idtipo = $(this).val();
    $('#btn_editartipo').attr('onClick', 'editar_tipo("'+idtipo+'");');
    $('#btn_editartipo').removeAttr('disabled');

    var action = 'searchTipoUsed';
    $.ajax({
      url: 'ajax.php',
      type: "POST",
      async: true,
      data: {action:action,tipo:idtipo},
      success: function(response) {
        if(response == 0)
        {
            $('#btn_eliminartipo').attr('onClick', 'eliminar_tipo("'+idtipo+'");');
            $('#btn_eliminartipo').removeAttr('disabled');
        }
        else
        {
            $('#btn_eliminartipo').attr('onClick', 'eliminar_tipo();');
            $('#btn_eliminartipo').attr('disabled','disabled');
        }
        //$('#prueba').html(data); 
      },
      error: function(error) {
        //$('#sucursal').val('error');
      }
    });
});

//==== para los select de categoria
$('#categoria').change(function(e) 
{
    e.preventDefault();
    var idcategoria = $(this).val();
    $('#btnedit_categoria').attr('onClick', 'editar_categoria("'+idcategoria+'");');
    $('#btnedit_categoria').removeAttr('disabled');

    var action = 'searchCatUsed';
    $.ajax({
      url: 'ajax.php',
      type: "POST",
      async: true,
      data: {action:action,categoria:idcategoria},
      success: function(response) 
      {
        //$('#prueba').text(response);
        var data = $.parseJSON(response);
        if(data.catUsed == 0)
        {
            $('#btneliminar_categoria').attr('onClick', 'eliminar_categoria("'+idcategoria+'");');
            $('#btneliminar_categoria').removeAttr('disabled');
        }
        else
        {
            $('#btneliminar_categoria').attr('onClick', 'eliminar_categoria();');
            $('#btneliminar_categoria').attr('disabled','disabled');
        }
        //ponelos las opciones de las subcategorias que pertenecen a esta categoria seleccionada
        //$('#pruebai').val(data.options);
        if(data.options == 0)
        {
            //no tiene subcategorias
            $("#subcategoria").empty();
            $('#subcategoria').append('<option value="NoSubcat" selected hidden>No tiene subcategoría</option>');
            $('#subcategoria').attr('disabled','disabled');
            $('#btnedit_subcategoria').attr('onClick', 'editar_subcategoria();');
            $('#btnedit_subcategoria').attr('disabled','disabled');
            $('#btneliminar_subcategoria').attr('onClick', 'eliminar_subcategoria();');
            $('#btneliminar_subcategoria').attr('disabled','disabled');

            //ponemos los labels de los atributos
            $("#filtro_atr1").empty();
            if(data.atr_labels.atr1 != null)
            {
                $('#filtro_atr1').append('<option selected hidden value="LABEL">'+data.atr_labels.atr1+'</option>');    
            }
            else
            {
                $('#filtro_atr1').append('<option selected hidden value="LABEL">---</option>');
            }
            $("#filtro_atr2").empty();
            if(data.atr_labels.atr2 != null)
            {
                $('#filtro_atr2').append('<option selected hidden value="LABEL">'+data.atr_labels.atr2+'</option>');
            }
            else
            {
                $('#filtro_atr2').append('<option selected hidden value="LABEL">---</option>');
            }
            $("#filtro_atr3").empty();
            if(data.atr_labels.atr3 != null)
            {
                $('#filtro_atr3').append('<option selected hidden value="LABEL">'+data.atr_labels.atr3+'</option>');
            }
            else
            {
                $('#filtro_atr3').append('<option selected hidden value="LABEL">---</option>');
            }
            $("#filtro_atr4").empty();
            if(data.atr_labels.atr4 != null)
            {
                $('#filtro_atr4').append('<option selected hidden value="LABEL">'+data.atr_labels.atr4+'</option>');
            }
            else
            {
                $('#filtro_atr4').append('<option selected hidden value="LABEL">---</option>');
            }
            $("#filtro_atr5").empty();
            if(data.atr_labels.atr5 != null)
            {
                $('#filtro_atr5').append('<option selected hidden value="LABEL">'+data.atr_labels.atr5+'</option>');
            }
            else
            {
                $('#filtro_atr5').append('<option selected hidden value="LABEL">---</option>');
            }

            var size_atrs = data.atrs_productos.length;
            for (var i=0;i<size_atrs;i++) 
            {
                if(data.atrs_productos[i].atr1_producto != null)
                {
                    $('#filtro_atr1').append('<option>'+data.atrs_productos[i].atr1_producto+'</option>');
                }
                if(data.atrs_productos[i].atr2_producto != null)
                {
                    $('#filtro_atr2').append('<option>'+data.atrs_productos[i].atr2_producto+'</option>');
                }
                if(data.atrs_productos[i].atr3_producto != null)
                {
                    $('#filtro_atr3').append('<option>'+data.atrs_productos[i].atr3_producto+'</option>');
                }
                if(data.atrs_productos[i].atr4_producto != null)
                {
                    $('#filtro_atr4').append('<option>'+data.atrs_productos[i].atr4_producto+'</option>');
                }
                if(data.atrs_productos[i].atr5_producto != null)
                {
                    $('#filtro_atr5').append('<option>'+data.atrs_productos[i].atr5_producto+'</option>');
                }
            }
            //fin de poner los atributos
        }
        else
        {
            //si tiene, mostrarlas
            $('#subcategoria').removeAttr('disabled');
            $("#subcategoria").empty();
            $('#subcategoria').append(data.options);
            //limpiamos los selects de atributos
            //ponemos los labels de los atributos
            $("#filtro_atr1").empty();
            $('#filtro_atr1').append('<option selected hidden value="LABEL">---</option>');
            $("#filtro_atr2").empty();
            $('#filtro_atr2').append('<option selected hidden value="LABEL">---</option>');
            $("#filtro_atr3").empty();
            $('#filtro_atr3').append('<option selected hidden value="LABEL">---</option>');
            $("#filtro_atr4").empty();
            $('#filtro_atr4').append('<option selected hidden value="LABEL">---</option>');
            $("#filtro_atr5").empty();
            $('#filtro_atr5').append('<option selected hidden value="LABEL">---</option>');
        }
        //modifcar la tabla 
        $('#tablaproductos').html(data.cadenaTabla);
        show_search_box();
        //ocultamos los costos
        hide_costos();
        //$('#prueba').html(data.atr_labels.atr1);
      },
      error: function(error) {
        //$('#sucursal').val('error');
      }
    });
});

//==== para los select de subcategoria
$('#subcategoria').change(function(e) 
{
    e.preventDefault();
    var idsubcategoria = $(this).val();
    $('#btnedit_subcategoria').attr('onClick', 'editar_subcategoria("'+idsubcategoria+'");');
    $('#btnedit_subcategoria').removeAttr('disabled');

    var action = 'searchSubCatUsed';
    $.ajax({
      url: 'ajax.php',
      type: "POST",
      async: true,
      data: {action:action,subcategoria:idsubcategoria},
      success: function(response) {
        //$('#prueba').html(response); 
        var data = $.parseJSON(response);
        if(data.subcatused == 0)
        {
            $('#btneliminar_subcategoria').attr('onClick', 'eliminar_subcategoria("'+idsubcategoria+'");');
            $('#btneliminar_subcategoria').removeAttr('disabled');
        }
        else
        {
            $('#btneliminar_subcategoria').attr('onClick', 'eliminar_subcategoria();');
            $('#btneliminar_subcategoria').attr('disabled','disabled');
        }
        //modifcar la tabla 
        $('#tablaproductos').html(data.cadenaTabla);
        show_search_box();
        //ocultamos los costos
        hide_costos();
        //ponemos los labels de los atributos
            $("#filtro_atr1").empty();
            if(data.atr_labels.atr1 != null)
            {
                $('#filtro_atr1').append('<option selected hidden value="LABEL">'+data.atr_labels.atr1+'</option>');    
            }
            else
            {
                $('#filtro_atr1').append('<option selected hidden value="LABEL">---</option>');
            }
            $("#filtro_atr2").empty();
            if(data.atr_labels.atr2 != null)
            {
                $('#filtro_atr2').append('<option selected hidden value="LABEL">'+data.atr_labels.atr2+'</option>');
            }
            else
            {
                $('#filtro_atr2').append('<option selected hidden value="LABEL">---</option>');
            }
            $("#filtro_atr3").empty();
            if(data.atr_labels.atr3 != null)
            {
                $('#filtro_atr3').append('<option selected hidden value="LABEL">'+data.atr_labels.atr3+'</option>');
            }
            else
            {
                $('#filtro_atr3').append('<option selected hidden value="LABEL">---</option>');
            }
            $("#filtro_atr4").empty();
            if(data.atr_labels.atr4 != null)
            {
                $('#filtro_atr4').append('<option selected hidden value="LABEL">'+data.atr_labels.atr4+'</option>');
            }
            else
            {
                $('#filtro_atr4').append('<option selected hidden value="LABEL">---</option>');
            }
            $("#filtro_atr5").empty();
            if(data.atr_labels.atr5 != null)
            {
                $('#filtro_atr5').append('<option selected hidden value="LABEL">'+data.atr_labels.atr5+'</option>');
            }
            else
            {
                $('#filtro_atr5').append('<option selected hidden value="LABEL">---</option>');
            }

            var size_atrs = data.atrs_productos.length;
            for (var i=0;i<size_atrs;i++) 
            {
                if(data.atrs_productos[i].atr1_producto != null)
                {
                    $('#filtro_atr1').append('<option>'+data.atrs_productos[i].atr1_producto+'</option>');
                }
                if(data.atrs_productos[i].atr2_producto != null)
                {
                    $('#filtro_atr2').append('<option>'+data.atrs_productos[i].atr2_producto+'</option>');
                }
                if(data.atrs_productos[i].atr3_producto != null)
                {
                    $('#filtro_atr3').append('<option>'+data.atrs_productos[i].atr3_producto+'</option>');
                }
                if(data.atrs_productos[i].atr4_producto != null)
                {
                    $('#filtro_atr4').append('<option>'+data.atrs_productos[i].atr4_producto+'</option>');
                }
                if(data.atrs_productos[i].atr5_producto != null)
                {
                    $('#filtro_atr5').append('<option>'+data.atrs_productos[i].atr5_producto+'</option>');
                }
            }
        //fin de poner los atributos
      },
      error: function(error) {
        //$('#sucursal').val('error');
      }
    });
});

//=========================== los select para los filtros por atributos
//FILTRO 1
$('#filtro_atr1').change(function(e) 
{
    e.preventDefault();
    //variables para los filtros
    var atr1 = $(this).val();  
    var atr2 = $('#filtro_atr2').val();
    var atr3 = $('#filtro_atr3').val();
    var atr4 = $('#filtro_atr4').val();
    var atr5 = $('#filtro_atr5').val();
    //si es LABEL entonces no han seleccionado nada o seleccionaron TODAS
    
    //otras variables
    var idcat = $('#categoria').val();
    var idsubcat = $('#subcategoria').val();

    var action = 'searchForAtr1';
    $.ajax({
      url: 'ajax.php',
      type: "POST",
      async: true,
      data: {action:action,atr1:atr1,atr2:atr2,atr3:atr3,atr4:atr4,atr5:atr5,idcat:idcat,idsubcat,idsubcat},
      success: function(response) {
        //$('#prueba').html(response); 
        var data = $.parseJSON(response);
        $('#tablaproductos').html(data.cadenaTabla);
        show_search_box();
        //ocultamos los costos
        hide_costos();

      },
      error: function(error) {
        //$('#sucursal').val('error');
      }
    });
});
//FILTRO 2
$('#filtro_atr2').change(function(e) 
{
    e.preventDefault();
    var atr2 = $(this).val();
    var atr1 = $('#filtro_atr1').val();
    var atr3 = $('#filtro_atr3').val();
    var atr4 = $('#filtro_atr4').val();
    var atr5 = $('#filtro_atr5').val();
    var idcat = $('#categoria').val();
    var idsubcat = $('#subcategoria').val();

    var action = 'searchForAtr2';
    $.ajax({
      url: 'ajax.php',
      type: "POST",
      async: true,
      data: {action:action,atr1:atr1,atr2:atr2,atr3:atr3,atr4:atr4,atr5:atr5,idcat:idcat,idsubcat,idsubcat},
      success: function(response) {
        //$('#prueba').text(idsubcat); 
        var data = $.parseJSON(response);
        $('#tablaproductos').html(data.cadenaTabla);
        show_search_box();
        //ocultamos los costos
        hide_costos();

      },
      error: function(error) {
        //$('#sucursal').val('error');
      }
    });
});
//FILTRO 3
$('#filtro_atr3').change(function(e) 
{
    e.preventDefault();
    var atr3 = $(this).val();
    var atr2 = $('#filtro_atr2').val();
    var atr1 = $('#filtro_atr1').val();
    var atr4 = $('#filtro_atr4').val();
    var atr5 = $('#filtro_atr5').val();
    var idcat = $('#categoria').val();
    var idsubcat = $('#subcategoria').val();

    var action = 'searchForAtr3';
    $.ajax({
      url: 'ajax.php',
      type: "POST",
      async: true,
      data: {action:action,atr1:atr1,atr2:atr2,atr3:atr3,atr4:atr4,atr5:atr5,idcat:idcat,idsubcat,idsubcat},
      success: function(response) {
        //$('#prueba').text(idsubcat); 
        var data = $.parseJSON(response);
        $('#tablaproductos').html(data.cadenaTabla);
        show_search_box();
        //ocultamos los costos
        hide_costos();

      },
      error: function(error) {
        //$('#sucursal').val('error');
      }
    });
});
//FILTRO 4
$('#filtro_atr4').change(function(e) 
{
    e.preventDefault();
    var atr4 = $(this).val();
    var atr2 = $('#filtro_atr2').val();
    var atr3 = $('#filtro_atr3').val();
    var atr1 = $('#filtro_atr1').val();
    var atr5 = $('#filtro_atr5').val();
    var idcat = $('#categoria').val();
    var idsubcat = $('#subcategoria').val();

    var action = 'searchForAtr4';
    $.ajax({
      url: 'ajax.php',
      type: "POST",
      async: true,
      data: {action:action,atr1:atr1,atr2:atr2,atr3:atr3,atr4:atr4,atr5:atr5,idcat:idcat,idsubcat,idsubcat},
      success: function(response) {
        //$('#prueba').text(idsubcat); 
        var data = $.parseJSON(response);
        $('#tablaproductos').html(data.cadenaTabla);
        show_search_box();
        //ocultamos los costos
        hide_costos();

      },
      error: function(error) {
        //$('#sucursal').val('error');
      }
    });
});
//FILTRO 5
$('#filtro_atr5').change(function(e) 
{
    e.preventDefault();
    var atr5 = $(this).val();
    var atr2 = $('#filtro_atr2').val();
    var atr3 = $('#filtro_atr3').val();
    var atr4 = $('#filtro_atr4').val();
    var atr1 = $('#filtro_atr1').val();
    var idcat = $('#categoria').val();
    var idsubcat = $('#subcategoria').val();

    var action = 'searchForAtr5';
    $.ajax({
      url: 'ajax.php',
      type: "POST",
      async: true,
      data: {action:action,atr1:atr1,atr2:atr2,atr3:atr3,atr4:atr4,atr5:atr5,idcat:idcat,idsubcat,idsubcat},
      success: function(response) {
        //$('#prueba').text(idsubcat); 
        var data = $.parseJSON(response);
        $('#tablaproductos').html(data.cadenaTabla);
        show_search_box();
        //ocultamos los costos
        hide_costos();

      },
      error: function(error) {
        //$('#sucursal').val('error');
      }
    });
});
//============ FIN DE LOS FILTROS ===========

//empezamos con lo de producto
var contado = 0;
var especial = 0;
var cr1 = 0;
var cr2 = 0;
var meses_pago = 0;
//interfaz de producto, mostrar los atributos de categorias o subcategorias
$('#categoria_producto').change(function(e) 
{
    e.preventDefault();
    var idcategoria = $(this).val();
    var action = 'FindAtrsCat';
    $.ajax({
      url: 'ajax.php',
      type: "POST",
      async: true,
      data: {action:action,categoria:idcategoria},
      success: function(response) 
      {
        //$('#prueba').html(response);
        var data = $.parseJSON(response);
        if(data.tiene_subcat == 0)
        {
            //entonces bloqueamos el select de subcategoria y mostramos los datos de los atributos en los labels de los inputs
            $("#subcategoria_producto").empty();
            $('#subcategoria_producto').attr('readonly','readonly');
            if(data.atr1 != null)
            {
                $('#atr1_producto').removeAttr('readonly');
                $('#label_atr1').html(data.atr1);
            }
            else
            {
                $('#atr1_producto').attr('readonly','readonly');
                $('#label_atr1').html('---');
            }
            if(data.atr2 != null)
            {
                $('#atr2_producto').removeAttr('readonly');
                $('#label_atr2').html(data.atr2);
            }
            else
            {
                $('#atr2_producto').attr('readonly','readonly');
                $('#label_atr2').html('---');
            }
            if(data.atr3 != null)
            {
                $('#atr3_producto').removeAttr('readonly');
                $('#label_atr3').html(data.atr3);
            }
            else
            {
                $('#atr3_producto').attr('readonly','readonly');
                $('#label_atr3').html('---');
            }
            if(data.atr4 != null)
            {
                $('#atr4_producto').removeAttr('readonly');
                $('#label_atr4').html(data.atr4);
            }
            else
            {
                $('#atr4_producto').attr('readonly','readonly');
                $('#label_atr4').html('---');
            }
            if(data.atr5 != null)
            {
                $('#atr5_producto').removeAttr('readonly');
                $('#label_atr5').html(data.atr5);
            }
            else
            {
                $('#atr5_producto').attr('readonly','readonly');
                $('#label_atr5').html('---');
            }
            //aqui poner los porcentajes de contado, especial, cr1, cr2 en inputs ocultos para despues usarlos para calcular el valor cuando se ponga costos
            contado = data.contado;
            especial = data.especial;
            cr1 = data.credito1;
            cr2 = data.credito2;
            meses_pago = data.meses_pago;
        }
        else
        {
            //cargamos las subcategorias que tenga esa categoria seleccionada en el select subcategoria_producto
            $("#subcategoria_producto").empty();
            $('#subcategoria_producto').append(data.options);
            //vemos si viene de un humano o si se puso cuando se quiere editar producto
            var selectsubcat = $('#flag_selectsubcat').val();
            if(selectsubcat != "nosubcat")
            {
                $('#subcategoria_producto').val(selectsubcat).change();
            }
            //podemos los detalles vacios a la espera de que eligan una subcategoria
            $('#label_atr1,#label_atr2,#label_atr3,#label_atr4,#label_atr5').html("---");
            $('#atr1_producto,#atr2_producto,#atr3_producto,#atr4_producto,#atr5_producto').attr('readonly','readonly');
            $('#subcategoria_producto').removeAttr('readonly');
            contado = 0;
            especial = 0;
            cr1 = 0;
            cr2 = 0;
            meses_pago = 0;
        }
        //$('#prueba').html(data); 
      },
      error: function(error) {
        //$('#sucursal').val('error');
      }
    });    
});

$('#subcategoria_producto').change(function(e) 
{
    e.preventDefault();
    var idsubcategoria = $(this).val();
    var action = 'FindAtrsSubCat';
    $.ajax({
      url: 'ajax.php',
      type: "POST",
      async: true,
      data: {action:action,subcategoria:idsubcategoria},
      success: function(response) 
      {
        //$('#prueba').html(response);
        var data = $.parseJSON(response);
        
            if(data.atr1 != null)
            {
                $('#atr1_producto').removeAttr('readonly');
                $('#label_atr1').html(data.atr1);
            }
            else
            {
                $('#atr1_producto').attr('readonly','readonly');
                $('#label_atr1').html('---');
            }
            if(data.atr2 != null)
            {
                $('#atr2_producto').removeAttr('readonly');
                $('#label_atr2').html(data.atr2);
            }
            else
            {
                $('#atr2_producto').attr('readonly','readonly');
                $('#label_atr2').html('---');
            }
            if(data.atr3 != null)
            {
                $('#atr3_producto').removeAttr('readonly');
                $('#label_atr3').html(data.atr3);
            }
            else
            {
                $('#atr3_producto').attr('readonly','readonly');
                $('#label_atr3').html('---');
            }
            if(data.atr4 != null)
            {
                $('#atr4_producto').removeAttr('readonly');
                $('#label_atr4').html(data.atr4);
            }
            else
            {
                $('#atr4_producto').attr('readonly','readonly');
                $('#label_atr4').html('---');
            }
            if(data.atr5 != null)
            {
                $('#atr5_producto').removeAttr('readonly');
                $('#label_atr5').html(data.atr5);
            }
            else
            {
                $('#atr5_producto').attr('readonly','readonly');
                $('#label_atr5').html('---');
            }
            //aqui poner los porcentajes de contado, especial, cr1, cr2 en inputs ocultos para despues usarlos para calcular el valor cuando se ponga costos
            contado = data.contado;
            especial = data.especial;
            cr1 = data.credito1;
            cr2 = data.credito2;
            meses_pago = data.meses_pago;

        //$('#prueba').html(data); 
      },
      error: function(error) {
        //$('#sucursal').val('error');
      }
    });    
});

$('#costo').keyup(function(e) 
{
    var costo = parseFloat($(this).val());
    if(!isNaN(costo))
    {
        var costo_iva = costo + (costo*0.16);
        $('#costo_iva').val(costo_iva.toFixed(2));
        //contado
        if(contado == 0)
        {
            $('#costo_contado').val(0);
        }
        else
        {
            var costo_contado = costo + (costo*(contado/100));
            $('#costo_contado').val(costo_contado.toFixed(2));
        }
        //especial
        if(especial == 0)
        {
            $('#costo_especial').val(0);
        }
        else
        {
            var costo_especial = costo + (costo*(especial/100));
            $('#costo_especial').val(costo_especial.toFixed(2));
        }
        //credito1
        if(cr1 == 0)
        {
            $('#costo_cr1').val(0);
        }
        else
        {
            var costo_cr1 = costo + (costo*(cr1/100));
            $('#costo_cr1').val(costo_cr1.toFixed(2));
        }
        //credito2
        if(cr2 == 0)
        {
            $('#costo_cr2').val(0);
        }
        else
        {
            var costo_cr2 = costo + (costo*(cr2/100));
            $('#costo_cr2').val(costo_cr2.toFixed(2));
        }
        //E-Q
        if(meses_pago == 0)
        {
            $('#costo_eq').val(0);
        }
        else
        {
            var e_q = (costo/meses_pago)/2;
            if(e_q < 400)
            {
                $('#costo_eq').val(400);
            }
            else
            {
                $('#costo_eq').val(e_q.toFixed(2));
            }
        }
        //p1
        var p1 = (costo_cr1/e_q)/2;
        if(isNaN(p1))
        {
            $('#costo_p1').val(0);
        }
        else
        {
            $('#costo_p1').val(p1.toFixed(2));
        }
        //p2
        var p2 = (costo_cr2/e_q)/2;
        if(isNaN(p2))
        {
            $('#costo_p2').val(0);
        }
        else
        {
            $('#costo_p2').val(p2.toFixed(2));
        }
    }
    else
    {
        $('#costo_iva,#costo_contado,#costo_especial,#costo_cr1,#costo_cr2,#costo_eq,#costo_p1,#costo_p2').val(0);
    }
    
});

//funcion para ocultar las columnas de la tabla costos
function show_costoiva()
{
    //$('td:nth-child(2)').toggle();
    //$('th:nth-child(2)').toggle();
    $('#tbl_productos td:nth-child(3)').toggle();
    $('#tbl_productos th:nth-child(3)').toggle();
    $('#tbl_productos td:nth-child(4)').toggle();
    $('#tbl_productos th:nth-child(4)').toggle();
}

function show_new_costo()
{
    $('#tbl_productos td:nth-child(2)').toggle();
    $('#tbl_productos th:nth-child(2)').toggle();
    $('#btn_save_lista').removeAttr('disabled');
}

//eliminar usuario
function eliminar_user(idusuario)
{
    Swal.fire({
            title: 'Esta seguro de eliminar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, Eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                var action = 'eliminarUsuario';
                $.ajax({
                  url: 'ajax.php',
                  type: "POST",
                  async: true,
                  data: {action:action,usuario:idusuario},
                  success: function(response) {
                    //$('#prueba').val(response);
                    if (response == 0) 
                    {
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error, intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                window.location.href = "usuarios.php";
                            }
                        })   
                    }
                    else
                    {
                        Swal.fire(
                          'Eliminado!',
                          'Se elimino correctamente!',
                          'success'
                        ).then((result) => {
                            if (result.isConfirmed){
                                window.location.href = "usuarios.php";
                            }
                        })
                    }
                    
                  },
                  error: function(error) {
                    //$('#prueba').val('error');
                  }
                });      
              }
        })
}

//para eliminar documentos
function eliminar_doc(iddocumento)
{
    Swal.fire({
            title: 'Esta seguro de eliminar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI, Eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                var action = 'eliminarDocumento';
                $.ajax({
                  url: 'ajax.php',
                  type: "POST",
                  async: true,
                  data: {action:action,documento:iddocumento},
                  success: function(response) {
                    //$('#prueba').val(response);
                    if (response == 0) 
                    {
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error, intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                window.location.href = "documentos.php";
                            }
                        })   
                    }
                    else
                    {
                        Swal.fire(
                          'Eliminado!',
                          'Se elimino correctamente!',
                          'success'
                        ).then((result) => {
                            if (result.isConfirmed){
                                window.location.href = "documentos.php";
                            }
                        })
                    }
                    
                  },
                  error: function(error) {
                    //$('#prueba').val('error');
                  }
                });      
              }
        })
}

//para eliminar sucursales
function eliminar_sucursal(idsucursal)
{
    Swal.fire({
            title: 'Esta seguro de eliminar?',
            html: 'Todos los datos pertenecientes a esta sucursal serán transpasados a la <strong>sucursal MATRIZ</strong>',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI, Eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                var action = 'eliminarSucursal';
                $.ajax({
                  url: 'ajax.php',
                  type: "POST",
                  async: true,
                  data: {action:action,sucursal:idsucursal},
                  success: function(response) {
                    //$('#prueba').val(response);
                    if (response == 0) 
                    {
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error, intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                window.location.href = "sucursales.php";
                            }
                        })   
                    }
                    else
                    {
                      Swal.fire(
                          'Eliminado!',
                          'Se elimino correctamente!',
                          'success'
                        ).then((result) => {
                            if (result.isConfirmed){
                                window.location.href = "sucursales.php";
                            }
                        })
                        //var data = $.parseJSON(response);
                        //$('#prueba').html(response);
                    }
                    
                  },
                  error: function(error) {
                    //$('#prueba').val('error');
                  }
                });      
              }
        })
}

//para eliminar clientes
function eliminar_cliente(idcliente)
{
    Swal.fire({
            title: '¿Esta seguro de eliminar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI, Eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                var action = 'eliminarCliente';
                $.ajax({
                  url: 'ajax.php',
                  type: "POST",
                  async: true,
                  data: {action:action,cliente:idcliente},
                  success: function(response) {
                    //$('#prueba').val(response);
                    if (response == 0) 
                    {
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error, intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                window.location.href = "clientes.php";
                            }
                        })   
                    }
                    else
                    {
                        Swal.fire(
                          'Eliminado!',
                          'Se elimino correctamente!',
                          'success'
                        ).then((result) => {
                            if (result.isConfirmed){
                                window.location.href = "clientes.php";
                            }
                        })
                    }
                    
                  },
                  error: function(error) {
                    //$('#prueba').val('error');
                  }
                });      
              }
        })
}

function preguntar_regresar()
{
    Swal.fire({
            title: '¿Esta seguro de regresar?',
            html: 'Verifica que hayas guardado los cambios del cliente',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Regresar!'
        }).then((result) => {
            if (result.isConfirmed) 
            {
                window.location.href = "clientes.php";
            }
        })
}

//funcion para eliminar puestos
function eliminar_puesto(idpuesto)
{
    Swal.fire({
            title: 'Esta seguro de eliminar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI, Eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                var action = 'eliminarPuesto';
                $.ajax({
                  url: 'ajax.php',
                  type: "POST",
                  async: true,
                  data: {action:action,puesto:idpuesto},
                  success: function(response) {
                    //$('#prueba').val(response);
                    if (response == 0) 
                    {
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error, intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                //con esto recargamos la pagina sin el POST DATA
                                window.location.href=window.location.href;
                            }
                        })   
                    }
                    else
                    {
                        Swal.fire(
                          'Eliminado!',
                          'Se elimino correctamente!',
                          'success'
                        ).then((result) => {
                            if (result.isConfirmed){
                                //con esto recargamos la pagina sin el POST DATA
                                $("#puesto option[value='"+idpuesto+"']").remove();
                            }
                        })
                    }
                  },
                  error: function(error) {
                    //$('#prueba').val('error');
                  }
                });      
              }
        })
}

//para editar puesto
function editar_puesto(idpuesto)
{
    var action = 'SelectPuesto';
    $.ajax({
        url: 'ajax.php',
        type: "POST",
        async: true,
        data: {action:action,puesto:idpuesto},
        success: function(response) {
            //$('#prueba').val(response);
            if (response != 0) 
            {
              var data = $.parseJSON(response);
                $('#newpuesto_edit').val(data.puesto);
                $('#desc_puesto_edit').val(data.descripcion);
                $('#idpuesto_flag').val(idpuesto);
            }
        },
        error: function(error) {
            //$('#prueba').val('error');
        }
   });  
}

//funcion para eliminar zonas
function eliminar_zona(idzona)
{
    Swal.fire({
            title: '¿Esta seguro de eliminar?',
            text: 'Todas las subzonas (colonias) pertenecientes a esta zona serán eliminadas',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI, Eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                var action = 'eliminarZona';
                $.ajax({
                  url: 'ajax.php',
                  type: "POST",
                  async: true,
                  data: {action:action,zona:idzona},
                  success: function(response) {
                    //$('#prueba').val(response);
                    if (response == 0) 
                    {
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error, intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                //con esto recargamos la pagina sin el POST DATA
                                window.location.href=window.location.href;
                            }
                        })   
                    }
                    else
                    {
                        Swal.fire(
                          'Eliminado!',
                          'Se elimino correctamente!',
                          'success'
                        ).then((result) => {
                            if (result.isConfirmed){
                                //con esto recargamos la pagina sin el POST DATA
                                $("#zona option[value='"+idzona+"']").remove();
                                $("#zona_subzona option[value='"+idzona+"']").remove();
                                $("#zona_subzona_edit option[value='"+idzona+"']").remove();
                                $("#subzona").empty();
                                $('#btnedit_zona').attr('onClick', 'editar_subzona();');
                                $('#btnedit_zona').attr('disabled','disabled');
                                $('#btneliminar_zona').attr('onClick', 'eliminar_subzona();');
                                $('#btneliminar_zona').attr('disabled','disabled');
                            }
                        })
                    }
                  },
                  error: function(error) {
                    //$('#prueba').val('error');
                  }
                });      
              }
        })
}

//para editar puesto
function editar_zona(idzona,zona)
{
    $('#newzona_edit').val(zona);
    $('#idnewzona_edit').val(idzona);
}

//funcion para eliminar subzona
function eliminar_subzona(idsubzona)
{
    Swal.fire({
            title: '¿Esta seguro de eliminar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI, Eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                var action = 'eliminarSubzona';
                $.ajax({
                  url: 'ajax.php',
                  type: "POST",
                  async: true,
                  data: {action:action,subzona:idsubzona},
                  success: function(response) {
                    //$('#prueba').val(response);
                    if (response == 0) 
                    {
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error, intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                //con esto recargamos la pagina sin el POST DATA
                                window.location.href=window.location.href;
                            }
                        })   
                    }
                    else
                    {
                        Swal.fire(
                          'Eliminado!',
                          'Se elimino correctamente!',
                          'success'
                        ).then((result) => {
                            if (result.isConfirmed){
                                //con esto recargamos la pagina sin el POST DATA
                                $("#subzona option[value='"+idsubzona+"']").remove();
                                $('#btnedit_subzona').attr('onClick', 'editar_subzona();');
                                $('#btnedit_subzona').attr('disabled','disabled');
                                $('#btneliminar_subzona').attr('onClick', 'eliminar_subzona();');
                                $('#btneliminar_subzona').attr('disabled','disabled');
                            }
                        })
                    }
                  },
                  error: function(error) {
                    //$('#prueba').val('error');
                  }
                });      
              }
        })
}

//para editar subzona
function editar_subzona(idsubzona)
{
    var action = 'SelectSubzona';
    $.ajax({
        url: 'ajax.php',
        type: "POST",
        async: true,
        data: {action:action,subzona:idsubzona},
        success: function(response) {
            //$('#prueba').val(response);
            if (response != 0) 
            {
              var data = $.parseJSON(response);
                $('#newsubzona_edit').val(data.subzona);
                $('#zona_subzona_edit').val(data.idzona).change();
                //$('#zona_subzona_edit_flag').val(data.idzona).change();
                $('#idnewsubzona_edit').val(idsubzona);
                //$('#idpuesto_flag').val(idpuesto);
            }
        },
        error: function(error) {
            //$('#prueba').val('error');
        }
   });  
}

function update_tipos()
{
    $('#mensaje_error').modal('hidden');
    $('#mensaje_success').modal('hidden');
}

//funcion para eliminar subzona
function eliminar_tipo(idtipo)
{
    Swal.fire({
            title: '¿Esta seguro de eliminar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI, Eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                var action = 'eliminarTipo';
                $.ajax({
                  url: 'ajax.php',
                  type: "POST",
                  async: true,
                  data: {action:action,tipo:idtipo},
                  success: function(response) {
                    //$('#prueba').val(response);
                    if (response == 0) 
                    {
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error, intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                //con esto recargamos la pagina sin el POST DATA
                                window.location.href=window.location.href;
                                //$("#tipo option[value='"+idtipo+"']").remove();
                            }
                        })   
                    }
                    else
                    {
                        Swal.fire(
                          'Eliminado!',
                          'Se elimino correctamente!',
                          'success'
                        ).then((result) => {
                            if (result.isConfirmed){
                                //con esto recargamos la pagina sin el POST DATA
                                //window.location.href=window.location.href;
                                $("#tipo option[value='"+idtipo+"']").remove();
                            }
                        })
                    }
                  },
                  error: function(error) {
                    //$('#prueba').val('error');
                  }
                });      
              }
        })
}

//para editar puesto
function editar_tipo(idtipo)
{
    var action = 'SelectTipo';
    $.ajax({
        url: 'ajax.php',
        type: "POST",
        async: true,
        data: {action:action,tipo:idtipo},
        success: function(response) {
            //$('#prueba').val(response);
            if (response != 0) 
            {
              var data = $.parseJSON(response);
                $('#newedit_tipo').val(data.nombre_tipo);
                $('#idflag_tipo').val(data.idtipo);
                //$('#idpuesto_flag').val(idpuesto);
            }
        },
        error: function(error) {
            //$('#prueba').val('error');
        }
   });  
}

//para eliminar categoria y subcategoria
function eliminar_categoria(idcategoria)
{
    Swal.fire({
            title: '¿Esta seguro de eliminar?',
            text: 'Todas las subcategorias pertenecientes a esta categoria serán eliminadas',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI, Eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                var action = 'eliminarCategoria';
                $.ajax({
                  url: 'ajax.php',
                  type: "POST",
                  async: true,
                  data: {action:action,categoria:idcategoria},
                  success: function(response) {
                    //$('#prueba').val(response);
                    if (response == 0) 
                    {
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error, intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                //con esto recargamos la pagina sin el POST DATA
                                window.location.href=window.location.href;
                            }
                        })   
                    }
                    else
                    {
                        Swal.fire(
                          'Eliminado!',
                          'Se elimino correctamente!',
                          'success'
                        ).then((result) => {
                            if (result.isConfirmed){
                                //con esto actualizamos todos los select de la pagina
                                $("#categoria option[value='"+idcategoria+"']").remove();
                                $("#categoria_subcategoria option[value='"+idcategoria+"']").remove();
                                $("#categoria_producto option[value='"+idcategoria+"']").remove();
                                $('#btnedit_categoria').attr('onClick', 'editar_categoria();');
                                $('#btnedit_categoria').attr('disabled','disabled');
                                $('#btneliminar_categoria').attr('onClick', 'eliminar_categoria);');
                                $('#btneliminar_categoria').attr('disabled','disabled');
                            }
                        })
                    }
                  },
                  error: function(error) {
                    //$('#prueba').val('error');
                  }
                });      
              }
        })
}

//para editar puesto
function editar_categoria(idcategoria)
{
    var action = 'SelectCategoria';
    $.ajax({
        url: 'ajax.php',
        type: "POST",
        async: true,
        data: {action:action,categoria:idcategoria},
        success: function(response) {
            //$('#prueba').val(response);
            if (response != 0) 
            {
              var data = $.parseJSON(response);
              $('#flagidcategoria').val(idcategoria);
              $('#nombre_cat').val(data.nombre);
              if(data.tiene_subcat == '1')
              {
                $('#tiene_subcat').attr('checked','checked');
                $('#tiene_subcat').bootstrapToggle('on');
              }
              else
              {
                $('#atr1').val(data.atr1);
                $('#atr2').val(data.atr2);
                $('#atr3').val(data.atr3);
                $('#atr4').val(data.atr4);
                $('#atr5').val(data.atr5);
                $('#contado').val(data.contado);
                $('#especial').val(data.especial);
                $('#credito1').val(data.credito1);
                $('#credito2').val(data.credito2);
                $('#mesespago').val(data.meses_pago);
                $('#garantia').val(data.meses_garantia);
                $('#tiene_subcat').removeAttr('checked');
                $('#tiene_subcat').bootstrapToggle('off');
              }
            }
        },
        error: function(error) {
            //$('#prueba').val('error');
        }
   });  
}

//funciones de eliminar y editar de SUBCATEGORIA
function eliminar_subcategoria(idsubcategoria)
{
    Swal.fire({
            title: '¿Esta seguro de eliminar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI, Eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                var action = 'eliminarSubCat';
                $.ajax({
                  url: 'ajax.php',
                  type: "POST",
                  async: true,
                  data: {action:action,subcategoria:idsubcategoria},
                  success: function(response) {
                    //$('#prueba').val(response);
                    if (response == 0) 
                    {
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error, intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                //con esto recargamos la pagina sin el POST DATA
                                window.location.href=window.location.href;
                            }
                        })   
                    }
                    else
                    {
                        Swal.fire(
                          'Eliminado!',
                          'Se elimino correctamente!',
                          'success'
                        ).then((result) => {
                            if (result.isConfirmed){
                                //con esto actualizamos todos los select de la pagina
                                $("#subcategoria option[value='"+idsubcategoria+"']").remove();
                                $("#subcategoria_producto option[value='"+idsubcategoria+"']").remove();
                                $('#btnedit_subcategoria').attr('onClick', 'editar_subcategoria();');
                                $('#btnedit_subcategoria').attr('disabled','disabled');
                                $('#btneliminar_subcategoria').attr('onClick', 'eliminar_subcategoria);');
                                $('#btneliminar_subcategoria').attr('disabled','disabled');
                            }
                        })
                    }
                  },
                  error: function(error) {
                    //$('#prueba').val('error');
                  }
                });      
              }
        })
}

//para editar puesto
function editar_subcategoria(idsubcategoria)
{
    var action = 'SelectSubCat';
    $.ajax({
        url: 'ajax.php',
        type: "POST",
        async: true,
        data: {action:action,subcategoria:idsubcategoria},
        success: function(response) {
            //$('#prueba').val(response);
            if (response != 0) 
            {
              //$('#prueba').val(response);
              var data = $.parseJSON(response);
              $('#categoria_subcategoria').val(data.categoria).change();
              $('#flagidsubcategoria').val(idsubcategoria);
              $('#nombre_subcat').val(data.nombre);
                $('#atr1_sub').val(data.atr1);
                $('#atr2_sub').val(data.atr2);
                $('#atr3_sub').val(data.atr3);
                $('#atr4_sub').val(data.atr4);
                $('#atr5_sub').val(data.atr5);
                $('#contado_sub').val(data.contado);
                $('#especial_sub').val(data.especial);
                $('#credito1_sub').val(data.credito1);
                $('#credito2_sub').val(data.credito2);
                $('#mesespago_sub').val(data.meses_pago);
                $('#garantia_sub').val(data.meses_garantia);
            }
        },
        error: function(error) {
            //$('#prueba').val('error');
        }
   });  
}

//=== PRODUCTO
//funcion para mostrar los datos de producto y poner editarlo
function editar_producto(idproducto)
{
    var action = 'SelectProducto';
    $.ajax({
        url: 'ajax.php',
        type: "POST",
        async: true,
        data: {action:action,producto:idproducto},
        success: function(response) {
            //$('#prueba').val(response);
            if (response != 0) 
            {
              //$('#prueba').val(response);
              var data = $.parseJSON(response);
              $('#flagid_producto').val(idproducto);
              $('#identificador').val(data.identificador);
              $('#categoria_producto').val(data.categoria).change();
              if(data.subcategoria !== null)
              {
                //$('#subcategoria_producto').val(data.subcategoria).change();
                $('#flag_selectsubcat').val(data.subcategoria);
              }
              else
              {
                $('#flag_selectsubcat').val("nosubcat");
              }

              $('#descripcion').val(data.descripcion);
              if(data.serializado == 0)
              {
                $('#serializado').bootstrapToggle('off');
              }
              else
              {
                $('#serializado').bootstrapToggle('on');
              }
              $('#atr1_producto').val(data.atr1_producto);
              $('#atr2_producto').val(data.atr2_producto);
              $('#atr3_producto').val(data.atr3_producto);
              $('#atr4_producto').val(data.atr4_producto);
              $('#atr5_producto').val(data.atr5_producto);
              $('#stock_min').val(data.stock_min);
              $('#stock_max').val(data.stock_max);
              $('#ext_p').val(data.ext_p);
              $('#costo').val(data.costo);
              $('#costo_iva').val(data.costo_iva);
              $('#costo_contado').val(data.costo_contado);
              $('#costo_especial').val(data.costo_especial);
              $('#costo_cr1').val(data.costo_cr1);
              $('#costo_cr2').val(data.costo_cr2);
              $('#costo_p1').val(data.costo_p1);
              $('#costo_p2').val(data.costo_p2);
              $('#costo_eq').val(data.costo_eq);
              //quitamos bloqueo
              $('#atr1_producto,#atr2_producto,#atr3_producto,#atr4_producto,#atr5_producto').removeAttr('readonly');
            }
        },
        error: function(error) {
            //$('#prueba').val('error');
        }
   });  
}

//funcion para eliminar producto
//funciones de eliminar y editar de SUBCATEGORIA
function eliminar_producto(idproducto)
{
    Swal.fire({
            title: '¿Esta seguro de eliminar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI, Eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                var action = 'eliminarProducto';
                $.ajax({
                  url: 'ajax.php',
                  type: "POST",
                  async: true,
                  data: {action:action,producto:idproducto},
                  success: function(response) {
                    //$('#prueba').val(response);
                    if (response == 0) 
                    {
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error, intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                //con esto recargamos la pagina sin el POST DATA
                                window.location.href=window.location.href;
                            }
                        })   
                    }
                    else
                    {
                        Swal.fire(
                          'Eliminado!',
                          'Se elimino correctamente',
                          'success'
                        ).then((result) => {
                            if (result.isConfirmed){
                                //con esto actualizamos todos los select de la pagina
                                window.location.href=window.location.href;
                            }
                        })
                    }
                  },
                  error: function(error) {
                    //$('#prueba').val('error');
                  }
                });      
              }
        })
}

function nuevo_producto()
{
    $('#flagid_producto').val('nuevoproducto');
    $("#formAdd_producto :input:not(#btn_guardar_producto,#btn_cancerlar_producto,#flagid_producto)").val('');
    $('#flag_selectsubcat').val('nosubcat');
    $('#serializado').bootstrapToggle('off');
    $('#atr1_producto,#atr2_producto,#atr3_producto,#atr4_producto,#atr5_producto').attr('readonly','readonly');
}

function nueva_categoria()
{
    $('#flagidcategoria').val('nuevacat');
    $("#formAdd_cat :input:not(#btn_guardarcat,#btn_cancerlarcat,#atr1,#tiene_subcat,#action,#flagidcategoria)").val('');
    $('#tiene_subcat').bootstrapToggle('off');
    $('#tiene_subcat').removeAttr('checked');
}

//funciones para subcategoria
function nueva_subcategoria()
{
    $('#flagidsubcategoria').val('nuevasubcat');
    $("#formAdd_subcat :input:not(#btn_guardarsubcat,#btn_cancerlarsubcat,#categoria_subcategoria,#atr1_sub,#action,#flagidsubcategoria)").val('');
}

function mostrar_img(idproducto,url_img,si_img)
{
    $('#flagid_producto_img').val(idproducto);
    if(si_img == 1)
    {
        $('#productoImg').html('<a href="'+url_img+'" target="_blank" rel="noopener noreferrer" ><img height="700" width="700" id="productoImg" src="'+url_img+'"></a>');
        $('#btn_borrar_img').attr('onClick','borrar_img("'+url_img+'")');
        $('#btn_borrar_img').removeAttr('disabled');
    }
    else
    {
        $('#productoImg').html('<div class="alert alert-warning" role="alert"><h4>El producto seleccionado No tiene imágen</h4></div>');
        $('#btn_borrar_img').attr('onClick','borrar_img()');
        $('#btn_borrar_img').attr('disabled','disabled');
    }
}

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) 
    {
      // Asignamos el atributo src a la tag de imagen
      $('#productoImg').html('<img height="700" width="700" id="productoImg" src="'+e.target.result+'">');
    }
    reader.readAsDataURL(input.files[0]);
  }
}

// El listener va asignado al input
$("#imgProducto").change(function() 
{
  readURL(this);
});

function borrar_img(url_img)
{
    var action = 'BorrarImg';
    $.ajax({
        url: 'ajax.php',
        type: "POST",
        async: true,
        data: {action:action,imgproducto:url_img},
        success: function(response) {
            //$('#prueba').val(response);
            if (response == 0) 
                    {
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error, intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                //con esto recargamos la pagina sin el POST DATA
                                window.location.href=window.location.href;
                            }
                        })   
                    }
                    else
                    {
                        Swal.fire(
                          'Eliminado!',
                          'Se borro correctamente la imagén',
                          'success'
                        ).then((result) => {
                            if (result.isConfirmed){
                                //con esto actualizamos todos los select de la pagina
                                window.location.href=window.location.href;
                            }
                        })
                    }
        },
        error: function(error) {
            //$('#prueba').val('error');
        }
   }); 
}

//ESTAS SON FUNCIONES PARA OTRAS COSAS
//para suspender sucursales
function suspender_sucursal(idsucursal)
{
    var action = 'suspenderSucursal';
    $.ajax({
        url: 'ajax.php',
        type: "POST",
        async: true,
        data: {action:action,sucursal:idsucursal},
        success: function(response) {
             //$('#prueba').val(response);
            if (response == 0) 
            {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Ocurrio un error, intente de nuevo!',
                }).then((result) => {
                if (result.isConfirmed){
                    window.location.href = "sucursales.php";
                    }
                })   
            }
            else if(response == 1)
            {
                Swal.fire(
                    'Suspendido!',
                    'Se suspendio correctamente!',
                    'warning'
                    ).then((result) => {
                    if (result.isConfirmed){
                        window.location.href = "sucursales.php";
                        }
                    })
            }
            else if(response == 2)
            {
                    Swal.fire(
                    'Activado!',
                    'Se Activo correctamente!',
                    'success'
                    ).then((result) => {
                    if (result.isConfirmed){
                        window.location.href = "sucursales.php";
                        }
                    })
            }
        },
        error: function(error) {
            //$('#prueba').val('error');
        }
   });           
}

//para suspender clientes
function suspender_cliente(idcliente)
{
    var action = 'suspenderCliente';
    $.ajax({
        url: 'ajax.php',
        type: "POST",
        async: true,
        data: {action:action,cliente:idcliente},
        success: function(response) {
             //$('#prueba').val(response);
            if (response == 0) 
            {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Ocurrio un error, intente de nuevo!',
                }).then((result) => {
                if (result.isConfirmed){
                    window.location.href = "clientes.php";
                    }
                })   
            }
            else if(response == 1)
            {
                Swal.fire(
                    'Suspendido!',
                    'Se suspendio correctamente!',
                    'warning'
                    ).then((result) => {
                    if (result.isConfirmed){
                        window.location.href = "clientes.php";
                        }
                    })
            }
            else if(response == 2)
            {
                    Swal.fire(
                    'Activado!',
                    'Se Activo correctamente!',
                    'success'
                    ).then((result) => {
                    if (result.isConfirmed){
                        window.location.href = "clientes.php";
                        }
                    })
            }
        },
        error: function(error) {
            //$('#prueba').val('error');
        }
   });           
}

//para asignar la nueva matriz
function asignar_matriz(idsucursal)
{
    Swal.fire({
            title: 'Esta seguro de convertir esta sucursal como Matriz?',
            text: 'La matriz actual será revocada',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, asignar matriz!'
        }).then((result) => {
            if (result.isConfirmed) {
                var action = 'asignarSucursalMatriz';
                $.ajax({
                  url: 'ajax.php',
                  type: "POST",
                  async: true,
                  data: {action:action,sucursal:idsucursal},
                  success: function(response) {
                    //$('#prueba').val(response);
                    if (response == 0) 
                    {
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error, intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                window.location.href = "sucursales.php";
                            }
                        })   
                    }
                    else
                    {
                        Swal.fire(
                          'Asignado!',
                          'Se asignó la nueva matriz correctamente!',
                          'success'
                        ).then((result) => {
                            if (result.isConfirmed){
                                window.location.href = "sucursales.php";
                            }
                        })
                    }
                    
                  },
                  error: function(error) {
                    //$('#prueba').val('error');
                  }
                });      
              }
        })
}




//FIN DE FUNCIONES USADAS

//Para hacer un input currency
// Jquery Dependency
/*
$("input[data-type='currency']").on({
    keyup: function() {
      formatCurrency($(this));
    },
    blur: function() { 
      formatCurrency($(this), "blur");
    }
});

function formatNumber(n) {
  // format number 1000000 to 1,234,567
  return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}

function formatCurrency(input, blur) {
  // appends $ to value, validates decimal side
  // and puts cursor back in right position.
  
  // get input value
  var input_val = input.val();
  
  // don't validate empty input
  if (input_val === "") { return; }
  
  // original length
  var original_len = input_val.length;

  // initial caret position 
  var caret_pos = input.prop("selectionStart");
    
  // check for decimal
  if (input_val.indexOf(".") >= 0) {

    // get position of first decimal
    // this prevents multiple decimals from
    // being entered
    var decimal_pos = input_val.indexOf(".");

    // split number by decimal point
    var left_side = input_val.substring(0, decimal_pos);
    var right_side = input_val.substring(decimal_pos);

    // add commas to left side of number
    left_side = formatNumber(left_side);

    // validate right side
    right_side = formatNumber(right_side);
    
    // On blur make sure 2 numbers after decimal
    if (blur === "blur") {
      right_side += "00";
    }
    
    // Limit decimal to only 2 digits
    right_side = right_side.substring(0, 2);

    // join number by .
    input_val = "$" + left_side + "." + right_side;

  } else {
    // no decimal entered
    // add commas to number
    // remove all non-digits
    input_val = formatNumber(input_val);
    input_val = "$" + input_val;
    
    // final formatting
    if (blur === "blur") {
      input_val += ".00";
    }
  }
  
  // send updated string to input
  input.val(input_val);

  // put caret back in the right position
  var updated_len = input_val.length;
  caret_pos = updated_len - original_len + caret_pos;
  input[0].setSelectionRange(caret_pos, caret_pos);
}*/
//fin de codigo para el input currency

