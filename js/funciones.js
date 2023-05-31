//FUNCIONES USADAS POR EL SISTEMA

//funcion para agregar mas referencias a los clientes
function show_search_box()
{
    $('#tbl_productos').DataTable({
  "columnDefs": [{
   "targets": 0
  }],
  "pageLength": 50,
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

function initializeSelect2(selectElementObj) 
{
    selectElementObj.select2({
        theme: "bootstrap-5",
    });
}

$(document).ready(function() 
{
    $(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

 //para el select2 multiple
 $('.js-example-basic-multiple').select2(
    {
        theme: "bootstrap-5",
        //dropdownParent: $('#body-inner'),
    });

  //para el select2 de salidas
  $('.js-example-data-array').select2(
    {
        theme: "bootstrap-5",
        //dropdownParent: $('#body-inner'),
    });

 $(document).on('select2:open', () => {
    document.querySelector('.select2-search__field').focus();
  });

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
    //poner los atributos al boton de borrar cards referidos
    $('#listas div a').attr('href','#');
    $('#listas div a:not(.notas)').attr('class','remover_campo');
    $('#listas div a:not(.notas) svg').attr('style','color: red;');
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
           beforeSend: function() 
           {
                Swal.fire({
                          title: 'Cargando...',
                          text: 'Espere un momento, lo estamos procesando',
                          imageUrl: "../img/cargando.gif",
                          imageHeight: 150, 
                          imageWidth: 150, 
                          showConfirmButton: false,
                          allowOutsideClick: false,
                          allowEscapeKey: false
                        }); 
           },
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
           beforeSend: function() 
           {
                Swal.fire({
                          title: 'Cargando...',
                          text: 'Espere un momento, lo estamos procesando',
                          imageUrl: "../img/cargando.gif",
                          imageHeight: 150, 
                          imageWidth: 150, 
                          showConfirmButton: false,
                          allowOutsideClick: false,
                          allowEscapeKey: false
                        }); 
           },
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
           beforeSend: function() 
           {
                Swal.fire({
                          title: 'Cargando...',
                          text: 'Espere un momento, lo estamos procesando',
                          imageUrl: "../img/cargando.gif",
                          imageHeight: 150, 
                          imageWidth: 150, 
                          showConfirmButton: false,
                          allowOutsideClick: false,
                          allowEscapeKey: false
                        }); 
           },
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
           beforeSend: function() 
           {
                Swal.fire({
                          title: 'Cargando...',
                          text: 'Espere un momento, lo estamos procesando',
                          imageUrl: "../img/cargando.gif",
                          imageHeight: 150, 
                          imageWidth: 150, 
                          showConfirmButton: false,
                          allowOutsideClick: false,
                          allowEscapeKey: false
                        }); 
           },
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
           beforeSend: function() 
           {
                Swal.fire({
                          title: 'Cargando...',
                          text: 'Espere un momento, lo estamos procesando',
                          imageUrl: "../img/cargando.gif",
                          imageHeight: 150, 
                          imageWidth: 150, 
                          showConfirmButton: false,
                          allowOutsideClick: false,
                          allowEscapeKey: false
                        }); 
           },
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
           beforeSend: function() 
           {
                Swal.fire({
                          title: 'Cargando...',
                          text: 'Espere un momento, lo estamos procesando',
                          imageUrl: "../img/cargando.gif",
                          imageHeight: 150, 
                          imageWidth: 150, 
                          showConfirmButton: false,
                          allowOutsideClick: false,
                          allowEscapeKey: false
                        }); 
           },
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
           beforeSend: function() 
           {
                Swal.fire({
                          title: 'Cargando...',
                          text: 'Espere un momento, lo estamos procesando',
                          imageUrl: "../img/cargando.gif",
                          imageHeight: 150, 
                          imageWidth: 150, 
                          showConfirmButton: false,
                          allowOutsideClick: false,
                          allowEscapeKey: false
                        }); 
           },
           success: function(response)             
           {
                $('#prueba').html(response);
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
           beforeSend: function() 
           {
                Swal.fire({
                          title: 'Cargando...',
                          text: 'Espere un momento, lo estamos procesando',
                          imageUrl: "../img/cargando.gif",
                          imageHeight: 150, 
                          imageWidth: 150, 
                          showConfirmButton: false,
                          allowOutsideClick: false,
                          allowEscapeKey: false
                        }); 
           },
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
    //insert_categoria
    $("#formAdd_cat").submit( function () {  
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();
        $.ajax({                        
           type: 'POST',                 
           url: 'ajax_forms.php',                     
           data: $(this).serialize(),
           beforeSend: function() 
           {
                Swal.fire({
                          title: 'Cargando...',
                          text: 'Espere un momento, lo estamos procesando',
                          imageUrl: "../img/cargando.gif",
                          imageHeight: 150, 
                          imageWidth: 150, 
                          showConfirmButton: false,
                          allowOutsideClick: false,
                          allowEscapeKey: false
                        }); 
           },
           success: function(response)             
           {
                //$('#prueba').html(response);
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
                else if(response == 1)
                {
                    Swal.fire({
                          icon: 'warning',
                          title: 'Ya existe la categoría',
                          text: 'Introduzca otro nombre de categoría o edite la existente',
                        })
                }
                else
                {
                    $('#nueva_cat').modal('hide');
                    //limpiar el input
                    //$('#prueba').html(response);
                    //$('#nombre_cat,#atr1,#atr2,#atr3,#atr4,#atr5,#contado,#especial,#credito1,#credito2,#mesespago,#garantia').val('');
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
                        //si se actualizo a que ahora tiene subcat, poner los selects en insertar subcat
                        if(data.flag_tiene_subcat == 0)
                        {
                            //no tiene subcat, quitar de los selects de subcat
                            $("#categoria_subcategoria option[value='"+data.idcategoria+"']").remove();
                        }
                        else
                        {
                            //si tiene subcat, poner en los selects de subcat
                            $('#categoria_subcategoria').append($('<option>',
                            {
                                value: data.idcategoria,
                                text : data.categoria
                            }));
                        }
                    }
                    Swal.fire(
                          '!Agregado!',
                          '!Se guardo la nueva categoría!',
                          'success'
                        ).then((result) => {
                            if (result.isConfirmed)
                            {
                                actualizar_tabla_productos();
                            }
                        })
                }         
           }
       });   
        return false;   
    });

    //form para insertar e editar una subcategoria
    //insert_subcategoria
    $("#formAdd_subcat").submit( function () {  
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();
        $.ajax({                        
           type: 'POST',                 
           url: 'ajax_forms.php',                     
           data: $(this).serialize(),
           beforeSend: function() 
           {
                Swal.fire({
                          title: 'Cargando...',
                          text: 'Espere un momento, lo estamos procesando',
                          imageUrl: "../img/cargando.gif",
                          imageHeight: 150, 
                          imageWidth: 150, 
                          showConfirmButton: false,
                          allowOutsideClick: false,
                          allowEscapeKey: false
                        }); 
           },
           success: function(response)             
           {
                //$('#prueba').html(response);
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
                else if(response == 1)
                {
                    //repetido
                    Swal.fire({
                          icon: 'warning',
                          title: '¡La subcategoria ya existe!',
                          text: 'Favor de poner otro nombre para la nueva subcategoria'
                        })
                }
                else
                {
                    $('#nueva_subcat').modal('hide');
                    //limpiar el input
                    //$('#prueba').html(response);
                    //$('#nombre_subcat,#atr1_sub,#atr2_sub,#atr3_sub,#atr4_sub,#atr5_sub,#contado_sub,#especial_sub,#credito1_sub,#credito2_sub,#mesespago_sub,#garantia_sub').val('');
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
                        $('#subcategoria').removeAttr('disabled');
                        /*$('#subcategoria_producto').append($('<option>',
                        {
                            value: data.idsubcategoria,
                            text : data.subcategoria
                        }));*/
                    }
                    else
                    {
                        //actualizamos el texto de la opcion modificada
                        $('#subcategoria option[value="'+data.idsubcategoria+'"]').text(data.subcategoria);
                        //$('#subcategoria_producto option[value="'+data.idsubcategoria+'"]').text(data.subcategoria);
                        //$('#prueba').html(data.sentencia);
                    }
                    Swal.fire(
                          '!Agregado!',
                          '!Se guardo la nueva subcategoría!',
                          'success'
                        ).then((result) => {
                            if (result.isConfirmed)
                            {
                                actualizar_tabla_productos();
                            }
                        })
                }         
           }
       });   
        return false;   
    });

    //para el guardar imagenes
    //form para insertar e editar una subcategoria
    $("#formAdd_img").submit( function () 
    {  
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();
        $.ajax({                        
           type: 'POST',                 
           url: 'ajax_forms.php',                     
           data:  new FormData(this),
           contentType: false,
                 cache: false,
           processData:false,
           beforeSend: function() 
           {
                Swal.fire({
                          title: 'Subiendo...',
                          text: 'Espere a que se termine de subir la imágen',
                          imageUrl: "../img/cargando.gif",
                          imageHeight: 150, 
                          imageWidth: 150, 
                          showConfirmButton: false,
                          allowOutsideClick: false,
                          allowEscapeKey: false
                        }); 
           },
           success: function(response)             
           {
                //$('#prueba').html(response);
                if(response == 0)
                {
                    //error
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
                else if(response == 1)
                {
                    //correcto
                    Swal.fire({
                          icon: 'success',
                          title: '!Subido!',
                          text: '!Se guardo la imágen correctamente!'
                        }).then((result) => {
                            if (result.isConfirmed){
                                window.location.href = "productos.php";
                            }
                        }) 
                }
                else if(response == 2)
                {
                    //imagen muy grande
                    Swal.fire({
                          icon: 'warning',
                          title: '!Imágen muy grande!',
                          text: '!La imágen supera los 5MB permitidos!'
                        })
                }
                else if(response == 3)
                {
                    //formato de archivo no permitido
                    Swal.fire({
                          icon: 'warning',
                          title: '!Archivo no valido!',
                          text: '!La imágen no es valida, formatos permitidos: png, jpg, jpge!'
                        })
                }         
           }
       });   
       return false;   
    });

    //form para agregar y editar producto
    $("#formAdd_producto").submit( function () 
    {  
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();
        $.ajax({                        
           type: 'POST',                 
           url: 'ajax_forms.php',                     
           data: $(this).serialize(),
           beforeSend: function() 
           {
                Swal.fire({
                          title: 'Cargando...',
                          text: 'Espere un momento, lo estamos procesando',
                          imageUrl: "../img/cargando.gif",
                          imageHeight: 150, 
                          imageWidth: 150, 
                          showConfirmButton: false,
                          allowOutsideClick: false,
                          allowEscapeKey: false
                        }); 
           },
           success: function(response)             
           {
                //$('#prueba').html(response);
                if(response == 0)
                {
                    //error
                    Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error al guardar el producto, !intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                window.location.href = "productos.php";
                            }
                        }) 
                }
                else if(response == 1)
                {
                    //correcto
                    Swal.fire({
                          icon: 'success',
                          title: '!Guardado!',
                          text: '!Producto guardado correctamete!'
                        }).then((result) => {
                            if (result.isConfirmed){
                                window.location.href = "productos.php";
                            }
                        }) 
                }
                else if(response == 2)
                {
                    //repetido
                    Swal.fire({
                          icon: 'warning',
                          title: '¡El producto ya existe!',
                          text: 'Favor de poner otro indentificar para este nuevo producto'
                        })
                }
                else if(response == 3)
                {
                    //correcto editado
                    Swal.fire({
                          icon: 'success',
                          title: '!Guardado!',
                          text: '!Se actualizó el producto!'
                        }).then((result) => {
                            if (result.isConfirmed){
                                window.location.href = "productos.php";
                            }
                        }) 
                }         
           }
       });   
       return false;   
    });

    //form para agregar un almacén
    $("#formAdd_almacen").submit( function () 
    {  
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();
        $.ajax({                        
           type: 'POST',                 
           url: 'ajax_forms.php',                     
           data: $(this).serialize(),
           beforeSend: function() 
           {
                Swal.fire({
                          title: 'Cargando...',
                          text: 'Espere un momento, lo estamos procesando',
                          imageUrl: "../img/cargando.gif",
                          imageHeight: 150, 
                          imageWidth: 150, 
                          showConfirmButton: false,
                          allowOutsideClick: false,
                          allowEscapeKey: false
                        }); 
           },
           success: function(response)             
           {
                //$('#prueba').html(response);
                if(response == 0)
                {
                    //error
                    Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error al guardar el almacén, !intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                window.location.href = "inv_almacenes.php";
                            }
                        }) 
                }
                else if(response == 1)
                {
                    //correcto
                    Swal.fire({
                          icon: 'success',
                          title: '!Guardado!',
                          text: '!Almacén guardado correctamete!'
                        }).then((result) => {
                            if (result.isConfirmed){
                                window.location.href = "inv_almacenes.php";
                            }
                        }) 
                }
                else if(response == 2)
                {
                    //repetido
                    Swal.fire({
                          icon: 'warning',
                          title: '¡El almacén ya existe!',
                          text: 'Favor de poner otro indentificar para este nuevo almacén'
                        })
                }
                else if(response == 3)
                {
                    //correcto editado
                    Swal.fire({
                          icon: 'success',
                          title: '!Guardado!',
                          text: '!Se actualizó el almacén!'
                        }).then((result) => {
                            if (result.isConfirmed){
                                window.location.href = "inv_almacenes.php";
                            }
                        }) 
                }         
           }
       });   
       return false;   
    });

    //form para transferir producto a un nuevo almacen
    $("#formTrans_almacen").submit( function () 
    {  
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();
        $.ajax({                        
           type: 'POST',                 
           url: 'ajax_forms.php',                     
           data: $(this).serialize(),
           beforeSend: function() 
           {
                Swal.fire({
                          title: 'Cargando...',
                          text: 'Espere un momento, lo estamos procesando',
                          imageUrl: "../img/cargando.gif",
                          imageHeight: 150, 
                          imageWidth: 150, 
                          showConfirmButton: false,
                          allowOutsideClick: false,
                          allowEscapeKey: false
                        }); 
           },
           success: function(response)             
           {
                //$('#prueba').html(response);
                if(response == 0)
                {
                    //error
                    Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error, !intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                window.location.href = "inv_almacenes.php";
                            }
                        }) 
                }
                else if(response == 1)
                {
                    //correcto
                    Swal.fire({
                          icon: 'success',
                          title: '!Guardado!',
                          text: '!El producto se movio de almacén correctamete!'
                        }).then((result) => {
                            if (result.isConfirmed){
                                window.location.href = "inv_almacenes.php";
                            }
                        }) 
                } 
           }
       });   
       return false;   
    });

    //form para agregar un tipo de venta
    $("#formAdd_tipo_venta").submit( function () 
    {  
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();
        $.ajax({                        
           type: 'POST',                 
           url: 'ajax_forms.php',                     
           data: $(this).serialize(),
           beforeSend: function() 
           {
                Swal.fire({
                          title: 'Cargando...',
                          text: 'Espere un momento, lo estamos procesando',
                          imageUrl: "../img/cargando.gif",
                          imageHeight: 150, 
                          imageWidth: 150, 
                          showConfirmButton: false,
                          allowOutsideClick: false,
                          allowEscapeKey: false
                        }); 
           },
           success: function(response)             
           {
                //$('#prueba').html(response);
                if(response == 0)
                {
                    //error brutal
                    Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error al guardar el nuevo tipo de venta, !intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                //recargamos la pagina actual sin el POST
                                document.location.reload(true);
                            }
                        }) 
                }
                else if(response == 2)
                {
                    //repetido
                    Swal.fire({
                          icon: 'warning',
                          title: '¡El tipo de venta ya existe!',
                          text: 'Favor de poner otro tipo de venta'
                        })
                }
                else
                {
                    //sacamos la bandera
                    $('#nuevo_tipo_venta').modal('hide');
                    var data = $.parseJSON(response);
                    if(data.flag_action == 1)
                    {
                        //INSERT
                        //se agrego nuevo tipo de venta
                        //limpiar el input
                        $('#nuevatipo_venta').val('');
                        $('#tipo_venta').append($('<option>',
                        {
                            value: data.idtipo_venta,
                            text : data.nombre_venta
                        }));
                        //correcto
                        Swal.fire({
                              icon: 'success',
                              title: '!Guardado!',
                              text: '!Tipo de venta guardado correctamete!'
                            }).then((result) => {
                                if (result.isConfirmed){}
                            }) 
                    }
                    else
                    {
                        //UPDATE
                        $('#tipo_venta option[value="'+data.idtipo_venta+'"]').text(data.nombre_venta);
                        //correcto editado
                        Swal.fire({
                              icon: 'success',
                              title: '!Guardado!',
                              text: '!Se actualizó el tipo de venta!'
                            }).then((result) => {
                                if (result.isConfirmed){}
                            }) 
                    }
                }       
           }
       });   
       return false;   
    });


    //form para agregar y/o editar las modalidades de pago
    $("#formAdd_modalidad_pago").submit( function () 
    {  
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();
        $.ajax({                        
           type: 'POST',                 
           url: 'ajax_forms.php',                     
           data: $(this).serialize(),
           beforeSend: function() 
           {
                Swal.fire({
                          title: 'Cargando...',
                          text: 'Espere un momento, lo estamos procesando',
                          imageUrl: "../img/cargando.gif",
                          imageHeight: 150, 
                          imageWidth: 150, 
                          showConfirmButton: false,
                          allowOutsideClick: false,
                          allowEscapeKey: false
                        }); 
           },
           success: function(response)             
           {
                //$('#prueba').html(response);
                if(response == 0)
                {
                    //error brutal
                    Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error al guardar la nueva modalidad de pago, !intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                //recargamos la pagina actual sin el POST
                                document.location.reload(true);
                            }
                        }) 
                }
                else if(response == 2)
                {
                    //repetido
                    Swal.fire({
                          icon: 'warning',
                          title: '¡Es modalidad de pago ya existe!',
                          text: 'Favor de poner otro modalidad de pago'
                        })
                }
                else
                {
                    //sacamos la bandera
                    $('#nueva_modalidad_pago').modal('hide');
                    var data = $.parseJSON(response);
                    if(data.flag_action == 1)
                    {
                        //INSERT
                        //se agrego nuevo tipo de venta
                        //limpiar el input
                        $('#nuevamodalidad_pago').val('');
                        $('#modalidad_pago').append($('<option>',
                        {
                            value: data.idmodalidad_pago,
                            text : data.nombre_modalidad
                        }));
                        //correcto
                        Swal.fire({
                              icon: 'success',
                              title: '!Guardado!',
                              text: '!Modalidad de pago guardado correctamete!'
                            }).then((result) => {
                                if (result.isConfirmed){}
                            }) 
                    }
                    else
                    {
                        //UPDATE
                        $('#modalidad_pago option[value="'+data.idmodalidad_pago+'"]').text(data.nombre_modalidad);
                        //correcto editado
                        Swal.fire({
                              icon: 'success',
                              title: '!Guardado!',
                              text: '!Se actualizó la modalidad de pago!'
                            }).then((result) => {
                                if (result.isConfirmed){}
                            }) 
                    }
                }       
           }
       });   
       return false;   
    });

    //form para agregar un tipo de compra
    $("#formAdd_tipo_compra").submit( function () 
    {  
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();
        $.ajax({                        
           type: 'POST',                 
           url: 'ajax_forms.php',                     
           data: $(this).serialize(),
           beforeSend: function() 
           {
                Swal.fire({
                          title: 'Cargando...',
                          text: 'Espere un momento, lo estamos procesando',
                          imageUrl: "../img/cargando.gif",
                          imageHeight: 150, 
                          imageWidth: 150, 
                          showConfirmButton: false,
                          allowOutsideClick: false,
                          allowEscapeKey: false
                        }); 
           },
           success: function(response)             
           {
                //$('#prueba').html(response);
                if(response == 0)
                {
                    //error brutal
                    Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error al guardar el nuevo tipo de compra, !intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                //recargamos la pagina actual sin el POST
                                document.location.reload(true);
                            }
                        }) 
                }
                else if(response == 2)
                {
                    //repetido
                    Swal.fire({
                          icon: 'warning',
                          title: '¡El tipo de compra ya existe!',
                          text: 'Favor de poner otro tipo de compra'
                        })
                }
                else
                {
                    //sacamos la bandera
                    $('#nuevo_tipo_compra').modal('hide');
                    var data = $.parseJSON(response);
                    if(data.flag_action == 1)
                    {
                        //INSERT
                        //se agrego nuevo tipo de venta
                        //limpiar el input
                        $('#nuevatipo_compra').val('');
                        $('#tipo_compra').append($('<option>',
                        {
                            value: data.idtipo_compra,
                            text : data.nombre_compra
                        }));
                        //correcto
                        Swal.fire({
                              icon: 'success',
                              title: '!Guardado!',
                              text: '!Tipo de compra guardado correctamete!'
                            }).then((result) => {
                                if (result.isConfirmed){}
                            }) 
                    }
                    else
                    {
                        //UPDATE
                        $('#tipo_compra option[value="'+data.idtipo_compra+'"]').text(data.nombre_compra);
                        //correcto editado
                        Swal.fire({
                              icon: 'success',
                              title: '!Guardado!',
                              text: '!Se actualizó el tipo de compra!'
                            }).then((result) => {
                                if (result.isConfirmed){}
                            }) 
                    }
                }       
           }
       });   
       return false;   
    });

    //form para agregar proveedor
    $("#formAdd_proveedor").submit( function () 
    {  
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();
        $.ajax({                        
           type: 'POST',                 
           url: 'ajax_forms.php',                     
           data: $(this).serialize(),
           beforeSend: function() 
           {
                Swal.fire({
                          title: 'Cargando...',
                          text: 'Espere un momento, lo estamos procesando',
                          imageUrl: "../img/cargando.gif",
                          imageHeight: 150, 
                          imageWidth: 150, 
                          showConfirmButton: false,
                          allowOutsideClick: false,
                          allowEscapeKey: false
                        }); 
           },
           success: function(response)             
           {
                //$('#prueba').html(response);
                if(response == 0)
                {
                    //error brutal
                    Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error al guardar el nuevo proveedor, !intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                //recargamos la pagina actual sin el POST
                                document.location.reload(true);
                            }
                        }) 
                }
                else if(response == 2)
                {
                    //repetido
                    Swal.fire({
                          icon: 'warning',
                          title: '¡El proveedor ya existe!',
                          text: 'Favor de poner otro proveedor'
                        })
                }
                else
                {
                    //sacamos la bandera
                    $('#nuevo_proveedor').modal('hide');
                    var data = $.parseJSON(response);
                    if(data.flag_action == 1)
                    {
                        //INSERT
                        //se agrego nuevo tipo de venta
                        //limpiar el input
                        $('#nuevoProveedor').val('');
                        $('#proveedor').append($('<option>',
                        {
                            value: data.idproveedor,
                            text : data.nombre_proveedor
                        }));
                        //correcto
                        Swal.fire({
                              icon: 'success',
                              title: '!Guardado!',
                              text: '!Proveedor guardado correctamete!'
                            }).then((result) => {
                                if (result.isConfirmed){}
                            }) 
                    }
                    else
                    {
                        //UPDATE
                        $('#proveedor option[value="'+data.idproveedor+'"]').text(data.nombre_proveedor);
                        //correcto editado
                        Swal.fire({
                              icon: 'success',
                              title: '!Guardado!',
                              text: '!Se actualizó el proveedor!'
                            }).then((result) => {
                                if (result.isConfirmed){}
                            }) 
                    }
                }       
           }
       });   
       return false;   
    });

    //form para agregar y editar movimiento
    $("#formAdd_movimiento").submit( function () 
    {  
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();
        $.ajax({                        
           type: 'POST',                 
           url: 'ajax_forms.php',                     
           data: $(this).serialize(),
           beforeSend: function() 
           {
                Swal.fire({
                          title: 'Cargando...',
                          text: 'Espere un momento, lo estamos procesando',
                          imageUrl: "../img/cargando.gif",
                          imageHeight: 150, 
                          imageWidth: 150, 
                          showConfirmButton: false,
                          allowOutsideClick: false,
                          allowEscapeKey: false
                        }); 
           },
           success: function(response)             
           {
                //$('#prueba').html(response);
                if(response == 0)
                {
                    //error brutal
                    Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error, !intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                //recargamos la pagina actual sin el POST
                                document.location.reload(true);
                            }
                        }) 
                }
                else
                {
                    //correcto
                        Swal.fire({
                              icon: 'success',
                              title: '!Guardado!',
                              text: '!Se guardo el movimiento!'
                            }).then((result) => {
                                if (result.isConfirmed){
                                    document.location.reload(true);
                                    //let pagina = "inv_editar_salidas.php?id="+data.idsalida;
                                    //window.location.href = pagina;
                                }
                            }) 
                }       
           }
       });   
       return false;   
    });

    //form para agregar las salidas de venta
    $("#formAdd_salida").submit( function () 
    {  
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();
        $.ajax({                        
           type: 'POST',                 
           url: 'ajax_forms.php',                     
           data: $(this).serialize(),
           beforeSend: function() 
           {
                Swal.fire({
                          title: 'Cargando...',
                          text: 'Espere un momento, lo estamos procesando',
                          imageUrl: "../img/cargando.gif",
                          imageHeight: 150, 
                          imageWidth: 150, 
                          showConfirmButton: false,
                          allowOutsideClick: false,
                          allowEscapeKey: false
                        }); 
           },
           success: function(response)             
           {
                //$('#prueba').html(response);
                if(response == 0)
                {
                    //error brutal
                    Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error, !intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                //recargamos la pagina actual sin el POST
                                document.location.reload(true);
                            }
                        }) 
                }
                else
                {
                    var data = $.parseJSON(response);
                    //correcto
                        Swal.fire({
                              icon: 'success',
                              title: '!Guardado!',
                              text: '!Se guardo la venta!'
                            }).then((result) => {
                                if (result.isConfirmed){
                                    //window.location.href = "inv_almacenes.php";
                                    let pagina = "inv_editar_salidas.php?id="+data.idsalida;
                                    window.location.href = pagina;
                                }
                            }) 
                }       
           }
       });   
       return false;   
    });

    //form para editar las salidas de venta
    $("#formEdit_salida").submit( function () 
    {  
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();
        $.ajax({                        
           type: 'POST',                 
           url: 'ajax_forms.php',                     
           data: $(this).serialize(),
           beforeSend: function() 
           {
                Swal.fire({
                          title: 'Cargando...',
                          text: 'Espere un momento, lo estamos procesando',
                          imageUrl: "../img/cargando.gif",
                          imageHeight: 150, 
                          imageWidth: 150, 
                          showConfirmButton: false,
                          allowOutsideClick: false,
                          allowEscapeKey: false
                        }); 
           },
           success: function(response)             
           {
                //$('#prueba').html(response);
                if(response == 0)
                {
                    //error brutal
                    Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error, !intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                //recargamos la pagina actual sin el POST
                                document.location.reload(true);
                            }
                        }) 
                }
                else
                {
                    //var data = $.parseJSON(response);
                    //correcto
                        Swal.fire({
                              icon: 'success',
                              title: '!Guardado!',
                              text: '!Se guardo la venta!'
                            }).then((result) => {
                                if (result.isConfirmed){
                                    document.location.reload(true);
                                }
                            }) 
                }       
           }
       });   
       return false;   
    });

    //form para agregar las entradas de compra
    $("#formAdd_entrada").submit( function () 
    {  
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();
        $.ajax({                        
           type: 'POST',                 
           url: 'ajax_forms.php',                     
           data: $(this).serialize(),
           beforeSend: function() 
           {
                Swal.fire({
                          title: 'Cargando...',
                          text: 'Espere un momento, lo estamos procesando',
                          imageUrl: "../img/cargando.gif",
                          imageHeight: 150, 
                          imageWidth: 150, 
                          showConfirmButton: false,
                          allowOutsideClick: false,
                          allowEscapeKey: false
                        }); 
           },
           success: function(response)             
           {
                //$('#prueba').html(response);
                if(response == 0)
                {
                    //error brutal
                    Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error, !intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                //recargamos la pagina actual sin el POST
                                document.location.reload(true);
                            }
                        }) 
                }
                else
                {
                    //var data = $.parseJSON(response);
                    //correcto
                        Swal.fire({
                              icon: 'success',
                              title: '!Guardado!',
                              text: '!Se guardo la compra!'
                            }).then((result) => {
                                if (result.isConfirmed){
                                    window.location.href = "inv_almacenes.php";
                                }
                            }) 
                }       
           }
       });   
       return false;   
    });

    //form para agregar y editar personas y vendores a cargo
    $("#formAdd_vendedores_a_cargo").submit( function () 
    {  
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();
        $.ajax({                        
           type: 'POST',                 
           url: 'ajax_forms.php',                     
           data: $(this).serialize(),
           beforeSend: function() 
           {
                Swal.fire({
                          title: 'Cargando...',
                          text: 'Espere un momento, lo estamos procesando',
                          imageUrl: "../img/cargando.gif",
                          imageHeight: 150, 
                          imageWidth: 150, 
                          showConfirmButton: false,
                          allowOutsideClick: false,
                          allowEscapeKey: false
                        }); 
           },
           success: function(response)             
           {
                //$('#prueba').html(response);
                if(response == 0)
                {
                    //error brutal
                    Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error, !intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                //recargamos la pagina actual sin el POST
                                document.location.reload(true);
                            }
                        }) 
                }
                else
                {
                    //var data = $.parseJSON(response);
                    //correcto
                        Swal.fire({
                              icon: 'success',
                              title: '!Guardado!',
                              text: '!Se guardo exitosamente!'
                            }).then((result) => {
                                if (result.isConfirmed){
                                    document.location.reload(true);
                                }
                            }) 
                }       
           }
       });   
       return false;   
    });

    //form para insertar y editar acuerdos
    $("#formAdd_acuerdo").submit( function () 
    {  
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();
        $.ajax({                        
           type: 'POST',                 
           url: 'ajax_forms.php',                     
           data: $(this).serialize(),
           beforeSend: function() 
           {
                Swal.fire({
                          title: 'Cargando...',
                          text: 'Espere un momento, lo estamos procesando',
                          imageUrl: "../img/cargando.gif",
                          imageHeight: 150, 
                          imageWidth: 150, 
                          showConfirmButton: false,
                          allowOutsideClick: false,
                          allowEscapeKey: false
                        }); 
           },
           success: function(response)             
           {
                //$('#prueba').html(response);
                if(response == 0)
                {
                    //error brutal
                    Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error, !intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                //recargamos la pagina actual sin el POST
                                document.location.reload(true);
                            }
                        }) 
                }
                else
                {
                    //var data = $.parseJSON(response);
                    //correcto
                        Swal.fire({
                              icon: 'success',
                              title: '!Guardado!',
                              text: '!Se guardo exitosamente!'
                            }).then((result) => {
                                if (result.isConfirmed){
                                    document.location.reload(true);
                                }
                            }) 
                }       
           }
       });   
       return false;   
    });

    //form para hacer el forecasting
    $("#formCompute_forecast").submit( function () 
    {  
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();
        let fecha_inicio = $('#fecha_inicio').val();
        let fecha_fin = $('#fecha_fin').val();
        let en_posesion = $('#posesion').val();
        let cobrador = $('#cobrador').val();
        
        var action = 'forecasting';
        $.ajax({
            url: 'ajax.php',
            type: "POST",
            async: true,
            data: {action:action,fecha_inicio:fecha_inicio,fecha_fin:fecha_fin,en_posesion:en_posesion,cobrador:cobrador},
            success: function(response) {
                $('#prueba').html(response);
                if (response == 0) 
                {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Ocurrio un error, intente de nuevo!',
                    }).then((result) => {
                    if (result.isConfirmed){
                        window.location.href = "pronostico.php";
                        }
                    })   
                }
                else if(response == 2)
                {
                    //decir que en ese intervalo o configuracion no hay datos

                }
                else if(response == 1)
                {
                    //correcto, mostrar la info

                }
            },
            error: function(error) {
                //$('#prueba').val('error');
            }
       });  

       return false;   
    });

    //para las tablas que no son de productos
    $('#tbl').DataTable({
      "columnDefs": [{
       "targets": 0
      }],
      "pageLength": 50,
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
        "sPrevious": "Anterior",
       },
      }
     });

        $('#tbl_ideal').DataTable({
      "columnDefs": [{
       "targets": 0
      }],
      "pageLength": 50,
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
        "sPrevious": "Anterior",
       },
      }
     });

    $('#tbl_real').DataTable({
      "columnDefs": [{
       "targets": 0
      }],
      "pageLength": 50,
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
        "sPrevious": "Anterior",
       },
      }
     });

    //oculta las columnas de costos de la tabla productos
    hide_costos();

    //buscar y quitar o poner las cosas de especial
    var action = 'act_des_especial';
    $.ajax({
      url: 'ajax.php',
      type: "POST",
      async: true,
      data: {action:action},
      success: function(response) 
      {
        //$('#prueba').html(response);
        if (response == 1)
        {
          $('#tbl_productos td:nth-child(8)').show();
          $('#tbl_productos th:nth-child(8)').show();
          $('#especial_cat').removeAttr('disabled');
          $('#especial_subcat').removeAttr('disabled');
          $('#especial_producto').removeAttr('disabled');
        }
        else
        {
          $('#tbl_productos td:nth-child(8)').hide();
          $('#tbl_productos th:nth-child(8)').hide();
          $('#especial_cat').attr('disabled','disabled');
          $('#especial_subcat').attr('disabled','disabled');
          $('#especial_producto').attr('disabled','disabled');
        }
      },
      error: function(error) {
        //$('#sucursal').val('error');
      }
    });

    //esto es para no permitir espacios en el identificador
    //pero el final ya no lo quizo, como siempre ¬¬
    /*
    $('#identificador').on('keypress', function(e) 
    {
        if (e.which == 32)
            return false;
    });
    */

    $('#identificador').keyup(function(e)
    {
        var identificador = $(this).val();
        var action = 'identificar_producto';
        $.ajax({
            url: 'ajax.php',
            type: "POST",
            async: true,
            data: {action:action,identificador:identificador},
            success: function(response) 
            {
                if((identificador.length == 1 && identificador.charCodeAt(0) == 35) || identificador.length == 0)
                {
                    $('#identificador').attr('class','form-control');
                    $('#msg_validador').attr('class','');
                    $("#msg_validador").empty();
                }
                else if(response == 0)
                {
                    //todo bien
                    $('#identificador').attr('class','form-control is-valid');
                    $('#msg_validador').attr('class','valid-feedback');
                    $('#msg_validador').html('¡Correcto!');
                }
                else
                {
                    //todo mal, ya existe
                    $('#identificador').attr('class','form-control is-invalid');
                    $('#msg_validador').attr('class','invalid-feedback');
                    $('#msg_validador').html('Este identificador ya está en uso');
                }
            },
            error: function(error) {
                //$('#prueba').val('error');
            }
       });  
    });



//FIN DEL DOCUMENT READY
});

//custom-select custom-select-sm
//paginate_button 
$(document).on('click', '.paginate_button', function () 
{
    // your function here
    hide_costos();
});
$(document).on('click', '.custom-select', function () 
{
    // your function here
    hide_costos();
});
$(document).on('click', '.sorting', function () 
{
    // your function here
    hide_costos();
});
$(document).on('click', '.sorting_asc', function () 
{
    // your function here
    hide_costos();
});
$(document).on('click', '.sorting_desc', function () 
{
    // your function here
    hide_costos();
});

var y = 0;
var aux_x = 0;
function mostrar_refs(x)
{  
    var campos_max = 11;   //max de 10 campos
    if (y < campos_max) 
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
        y++;
        aux_x = x;
    }
    $('#button_agre').remove();
    $('#button_agregar').append('<button id="button_agre" onclick="mostrar_refs('+x+');" class="btn btn-primary" type="button" ><i class="fas fa-plus"></i> Añadir Referencia</button>');
    //console.log("x:", x);
    //console.log("y:", y);
}

//CLIENTES
// Remover o div anterior
$('#listas').on("click",".remover_campo",function(e) 
{
    e.preventDefault();
    //cuando se borra una referencia en editar cliente tiene bug porque quedan los modelas y entonces se cruzan las notas
    //de mientras va a quedar así

    //luego todo el card
    $(this).parents("#card_ref").remove();

    $('#button_agre').remove();
    y--;
    var flag = parseInt($('#contador_cards').val()) + 1;
    if(flag == 0)
    {
        $('#button_agregar').append('<button id="button_agre" onclick="mostrar_refs('+aux_x+');" class="btn btn-primary" type="button" ><i class="fas fa-plus"></i> Añadir Referencia</button>');
    }
    else
    {
        $('#button_agregar').append('<button id="button_agre" onclick="mostrar_refs('+flag+');" class="btn btn-primary" type="button" ><i class="fas fa-plus"></i> Añadir Referencia</button>');
    }
    //disminuir contador de editar referencias en clientes
    $('#contador_cards').val(flag-2);
});

//inventarios SALIDAS
//remover las cards de salidas con la funcion dinamica que NO será asi 
/*
$('#lista_salida').on("click",".remover_salida",function(e) 
{
    e.preventDefault();
    $(this).parents("#card_salida").remove();
});
*/
var cards_showed = 0;
var disponibles = [1,2,3,4,5];
function borrar_card_salida(idcard)
{
    $("#card_salida"+idcard).attr("hidden","hidden");
    cards_showed = cards_showed - 1;
    disponibles.push(idcard);
    //quitar los datos de los inputs 
    $("#identificador_pro_"+idcard).val(0).trigger('change');
    $("#cantidad_"+idcard).val(1);
    $("#origen_"+idcard).val("");
    $("#precio_"+idcard).val(0);
    $("#tipo_precio_"+idcard).val(0);
    //console.log(disponibles);
    costo_enganche[idcard-1] = 0;
    enganche_calculado = 0;
    for (var i = 0; i < costo_enganche.length; i++) 
    {
        enganche_calculado = enganche_calculado + costo_enganche[i];
    }
    $('#enganche_dado').val(enganche_calculado);

}

//lo de ventas, añadir productos a salida o venta
function add_salida()
{
    $('#btn_vender').removeAttr("disabled");
    if(cards_showed < 5)
    {
        $('#card_salida'+disponibles[0]).removeAttr("hidden");
        disponibles.shift();
        cards_showed = cards_showed + 1;
    }
    //console.log(disponibles);
    //si es dinamico por aqui va insetar todo el codigo del formulario
    //el checkbox de si tiene iva o no
    /*
    <div class="col-lg-1">\
        <label for="serializado">Incluye IVA</label>\
        <input id="incluye_iva" name="incluye_iva[]" value="si_iva" type="checkbox" data-toggle="toggle" data-onstyle="primary" data-offstyle="secondary" data-size="m" data-on="SI" data-off="NO">\
    </div>\
    */
    //se que no es lo adecuado, pero no es suficiente el tiempo para hacerlo como se debe, y va a funcionar de todas formas, lo que se hara será
    //poner 5 posibles productos ya en html/php y solo ir mostrando o ocultando las cards cuando se necesite, enves de irlos generando dinamicamente
    /*
    //este codigo era para generando dinamicamente con jquery, pero tenia muchos bugs y complicaba las cosas
    $('#lista_salida').append(add_new_producto_lista);
    $('#btn_vender').removeAttr("disabled");
    //mostrar en formato boostrap el checkbox
    //$("input:last").bootstrapToggle();
    //cargar los datos al select
    var action = 'selectAll_productos';
    $.ajax({
        url: 'ajax.php',
        type: "POST",
        async: true,
        data: {action:action},
        success: function(response) {
            //$('#prueba').html(response;
            if (response == 0) 
            {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Ocurrio un error, intente de nuevo!',
                }).then((result) => {
                if (result.isConfirmed){
                    window.location.href = "inv_salidas.php";
                    }
                })   
            }
            else
            {
                //todo bien, cargar los datos
                var data = $.parseJSON(response);
                $(".identificadorpro").empty();
                $(".identificadorpro").append(data.data_producto);
                $(".identificadorpro").select2({theme: "bootstrap-5",});
            }
        },
        error: function(error) 
        {
            //$('#prueba').val('error');
        }
   });     
   */
}

//para mostrar el folio de venta
$('#tipo_documento').change(function(e) 
{
    e.preventDefault();
    let documento = $(this);
    let iddocumento = documento.val();
    let folio = documento.find(':selected').data("folio");
    let serie = documento.find(':selected').data("serie");
    $('#folio_venta').val(folio+'-'+serie);
    $('#folio_venta_serie').val(parseInt(serie));
});

//buscar por IDCliente
//funcion para autocompletar cuando buscamos un cliente por ID o nombre
//sentencia sql con nombre y ID: SELECT * FROM cliente WHERE nombre LIKE '%$nombre%'
$('#id_cliente').on('select2:select', function (e) 
{
        var datas = e.params.data;
        //console.log(data.id);
        var action = "buscar_x_id_cliente";
        $.ajax({
        url: "ajax.php",
        type: "POST",
        data: {action: action, idcliente: datas.id},
        success: function (response) 
        {
            //$('#prueba').html(response);
            var cliente = $.parseJSON(response); 
            //console.log(cliente);
            $('#nom_cliente').val(cliente.idcliente).trigger('change');
            $("#tel_cliente").val(cliente.tel1_cliente);
            $('option[value="'+cliente.zona+'"]').prop("selected", "selected");

            $("#subzona").empty();
            $('#subzona').append(cliente.data_subzona);
            $('option[value="'+cliente.data_subzona+'"]').prop("selected", "selected");
        },
        error: function(error) {
            //$('#prueba').val('error');
        }
    }); 
});

$('#nom_cliente').on('select2:select', function (e) 
{
    var datas = e.params.data;
    //console.log(data.id);
    var action = "buscar_x_nombre_cliente";
        $.ajax({
        url: "ajax.php",
        type: "POST",
        data: {action: action, idcliente: datas.id},
        success: function (response) 
        {
            //$('#prueba').html(response);
            var cliente = $.parseJSON(response); 
            //console.log(cliente);
            $("#id_cliente").val(cliente.idcliente).trigger('change');
            $("#tel_cliente").val(cliente.tel1_cliente);
            $('option[value="'+cliente.zona+'"]').prop("selected", "selected");

            $("#subzona").empty();
            $('#subzona').append(cliente.data_subzona);
            $('option[value="'+cliente.data_subzona+'"]').prop("selected", "selected");
        },
        error: function(error) {
            //$('#prueba').val('error');
        }
    }); 
});


//FUNCIONES DE SALIDAS
function suspender_salida(salida) 
{
    Swal.fire({
            title: '¿Esta seguro de susupender?',
            text: 'Si está suspendido se activará',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, suspender!'
        }).then((result) => {
            if (result.isConfirmed) {
                var action = 'suspender_salida';
                $.ajax({
                  url: 'ajax.php',
                  type: "POST",
                  async: true,
                  data: {action:action, idsalida:salida},
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
                                window.location.href = "lista_salidas.php";
                            }
                        })   
                    }
                    else
                    {
                        Swal.fire(
                          'Correcto!',
                          'Acción ejecutada correctamente!',
                          'success'
                        ).then((result) => {
                            if (result.isConfirmed){
                                window.location.href = "lista_salidas.php";
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

function editar_salida(num_cards) 
{
    $('#form_edit_salida').removeAttr('disabled');
    $('#vendedor').removeAttr('disabled');
    $('#id_cliente').removeAttr('disabled');
    $('#nom_cliente').removeAttr('disabled');
    for (var i = 0; i < num_cards; i++) 
    {
        $('#identificador_pro_'+(i+1)).removeAttr('disabled');
        $('#origen_'+(i+1)).removeAttr('disabled');
        $('#origen_multi_'+(i+1)).removeAttr('disabled');
    }

}

var salida_costo = 0;
var salida_costo_iva = 0;
var salida_costo_contado = 0;
var salida_costo_especial = 0;
var salida_costo_cr1 = 0;
var salida_costo_cr2 = 0;
var precio_base = [0,0,0,0,0];
var costo_enganche = [0,0,0,0,0];
var enganche_calculado = 0;
//poder precio cuando eleja que tipo de precio con base en el producto selecionado
function mostrar_precios(id)
{
    let id_tipo_precio = $("#tipo_precio_"+id).val();
    let id_producto = $("#identificador_pro_"+id).val();
    let cantidad = $("#cantidad_"+id).val();

    //console.log(id_tipo_precio);
    //console.log(id);
    //console.log(cantidad);

    var action = 'findPrecioProducto';
    $.ajax({
        url: 'ajax.php',
        type: "POST",
        async: true,
        data: {action:action,idproducto:id_producto,idtipo_precio:id_tipo_precio},
        success: function(response) 
        {
            //$('#prueba').html(response);
            if (response == 0) 
            {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Ocurrio un error, intente de nuevo!',
                }).then((result) => {
                if (result.isConfirmed){
                    window.location.href = "inv_salidas.php";
                    }
                })   
            }
            else
            {
                //todo bien, cargar los datos (precios)
                var data = $.parseJSON(response);
                //console.log(data.costo);
                salida_costo = parseFloat(data.costo)*cantidad;
                salida_costo_iva = parseFloat(data.costo_iva)*cantidad;
                salida_costo_contado = parseFloat(data.costo_contado)*cantidad;
                salida_costo_especial = parseFloat(data.costo_especial)*cantidad;
                salida_costo_cr1 = parseFloat(data.costo_cr1)*cantidad;
                salida_costo_cr2 = parseFloat(data.costo_cr2)*cantidad;
                //para el no de pagos
                let p1 = parseFloat(data.costo_p1);
                let p2 = parseFloat(data.costo_p2);
                let no_pago = 0;

                if(id_tipo_precio == "costo")
                {
                    //precio base
                    precio_base[id-1] = data.costo;
                    //este incluye las cantidadas
                    precio_actual = salida_costo;
                }
                else if(id_tipo_precio == "costo_iva")
                {
                    precio_base[id-1] = data.costo_iva;
                    precio_actual = salida_costo_iva;
                }
                else if(id_tipo_precio == "costo_contado")
                {
                    precio_base[id-1] = data.costo_contado;
                    precio_actual = salida_costo_contado;
                }
                else if(id_tipo_precio == "costo_especial")
                {
                    precio_base[id-1] = data.costo_especial;
                    precio_actual = salida_costo_especial;
                }
                else if(id_tipo_precio == "costo_cr1")
                {
                    precio_base[id-1] = data.costo_cr1;
                    precio_actual = salida_costo_cr1;
                    no_pago = p1;
                }
                else if(id_tipo_precio == "costo_cr2")
                {
                    precio_base[id-1] = data.costo_cr2;
                    precio_actual = salida_costo_cr2;
                    no_pago = p2;
                }
                $('#precio_'+id).val(precio_actual);
                //mostrar el enganche de ese producto
                costo_enganche[id-1] = parseFloat(data.costo_enganche);
                //console.log(costo_enganche);
                enganche_calculado = 0;
                for (var i = 0; i < costo_enganche.length; i++) 
                {
                    enganche_calculado = enganche_calculado + costo_enganche[i];
                }
                $('#enganche_dado').val(enganche_calculado);
                //console.log(enganche_calculado);

                //n de pagos y pago parcial
                let pago_parcial = parseFloat(data.costo_eq);
                let modalidad_pago = $('#modalidad_pago').val()
                if(modalidad_pago == "semanal")
                {
                    $('#n_pagos').val((no_pago*4).toFixed(2));
                    $('#pago_parcial').val((pago_parcial/2).toFixed(2));
                    //console.log(no_pago*4);
                }
                else if(modalidad_pago == "quincenal")
                {
                    $('#n_pagos').val((no_pago*2).toFixed(2));
                    $('#pago_parcial').val(pago_parcial.toFixed(2));
                }
                else if(modalidad_pago == "mensual")
                {
                    $('#n_pagos').val(no_pago.toFixed(2));
                    $('#pago_parcial').val((pago_parcial*2).toFixed(2));
                }
            }
        },
        error: function(error) 
        {
            //$('#prueba').val('error');
        }
   }); 
}

//multiplicar cuando cambie cantidad
function multiplicar_precio(id)
{
    let cantidad = $("#cantidad_"+id).val();
    //console.log(precio_base);
    $('#precio_'+id).val(parseInt(precio_base[id-1]*cantidad));
    //si es mas de uno hacer el select multiple y poner la cantidad minima y maxima
    if(cantidad > 1)
    {
        $('#divorigen_'+id).attr('hidden','hidden');
        $('#divorigen_multi_'+id).removeAttr('hidden');
        $('#origen_multi_'+id).select2({
            theme: "bootstrap-5",
            minimumSelectionLength: cantidad,
            maximumSelectionLength: cantidad,
        });
    }
    else
    {
        $('#divorigen_'+id).removeAttr('hidden');
        $('#divorigen_multi_'+id).attr('hidden','hidden');
    }
}

Number.prototype.format = function(n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};

var total_venta_salida = 0;
function calcular_cuenta(es_editar)
{
    let id_tipo_precio = [];
    let precios_siniva = [];
    let ivas = [];
    let precios_coniva = [];
    let subtotal1 = 0;
    let iva = 0;
    let subtotal2 = 0;
    for (let i = 1; i <= 5; i++) 
    {
        id_tipo_precio[i-1] = $("#tipo_precio_"+i).val();
        if(id_tipo_precio[i-1] == "costo") //esto quiere decir que no trae el iva calculado
        {
            //lo agregamos como es y ponemos en el array de ivas su iva calculado
            let result = parseFloat($("#precio_"+i).val());
            precios_siniva[i-1] = (isNaN(result) ? 0 : result);
            ivas[i-1] = precios_siniva[i-1]*0.16;
            precios_coniva[i-1] = precios_siniva[i-1] + ivas[i-1];
        }
        else
        {
            //ya trae el iva el precio, lo sacamos del precio y lo ponemos aparte en el array
            let result = parseFloat($("#precio_"+i).val());
            precios_siniva[i-1] = (isNaN(result) ? 0 : result/1.16);
            ivas[i-1] = precios_siniva[i-1]*0.16;
            precios_coniva[i-1] = precios_siniva[i-1] + ivas[i-1];
        }
        if(es_editar == 1)
        {
            let cantidad = $('#cantidad_'+i).val();
            //console.log(cantidad);
            subtotal1 = subtotal1 + (precios_siniva[i-1]*cantidad);
            iva = iva + (ivas[i-1]*cantidad);
            subtotal2 = subtotal2 + (precios_coniva[i-1]*cantidad);
        }
        else
        {
            subtotal1 = subtotal1 + precios_siniva[i-1];
            iva = iva + ivas[i-1];
            subtotal2 = subtotal2 + precios_coniva[i-1];
        }
        //el descuento se calculara cuando vaya ingresando datos
    }
    let descuento = $('#descuento_venta').val();
    total_venta_salida = subtotal2 - descuento;
    /*console.log(id_tipo_precio);
    console.log(ivas);
    console.log(precios_coniva);*/
    //console.log(precios_siniva);
    
    //console.log(subtotal1);
    //<?php echo "$".number_format($data['costo_contado'],2, '.', ','); ?>
    $('#costos_calculados').removeAttr("hidden");
    $('#subtotal1').html("$" + subtotal1.format(2,3));
    $('#ivas').html("$" + iva.format(2,3));
    $('#subtotal2').html("$" + subtotal2.format(2,3));
    $('#total_general').html("$" + total_venta_salida.format(2,3));

    //ponerlos en los inputs flags
    $('#subtotal1_flag').val(subtotal1.toFixed(2));
    $('#ivas_flag').val(iva.toFixed(2));
    $('#subtotal2_flag').val(subtotal2.toFixed(2));
    $('#total_flag').val(total_venta_salida.toFixed(2));

    $('#btn_haz_venta').removeAttr('disabled');
}

function cargar_series(id)
{
    let id_producto = $('#identificador_pro_'+id).val();
    var action = "buscar_series_del_producto";
        $.ajax({
        url: "ajax.php",
        type: "POST",
        data: {action: action, idproducto: id_producto},
        success: function (response) 
        {
            //$('#prueba').html(response);
            var data = $.parseJSON(response); 
            //primero el multi sin la opcion vacia
            $('#origen_multi_'+id).empty();
            $('#origen_multi_'+id).append(data.series);
            $('#origen_multi_'+id).trigger('change');
            $('#origen_'+id).empty();
            $('#origen_'+id).append(data.series);
            $('#origen_'+id).trigger('change');    
                
        },
        error: function(error) {
            //$('#prueba').val('error');
        }
    }); 
}

$('#descuento_venta').keyup(function(e) 
{
    let result = parseFloat($(this).val());
    var precio_descuento = (isNaN(result) ? 0 : result);
    let total_venta_salida_temp = total_venta_salida - precio_descuento;
    //console.log(total_venta_salida_temp);
    $('#total_general').html('$'+total_venta_salida_temp.format(2,3));
    $('#total_flag').val(total_venta_salida_temp.toFixed(2));
});

$('#descuento_venta').change(function(e) 
{
    let result = parseFloat($(this).val());
    var precio_descuento = (isNaN(result) ? 0 : result);
    let total_venta_salida_temp = total_venta_salida - precio_descuento;
    //console.log(total_venta_salida_temp);
    $('#total_general').html('$'+total_venta_salida_temp.format(2,3));
    $('#total_flag').val(total_venta_salida_temp.toFixed(2));
});

//para el numero de pagos, calcular siempre el proporcional
$('#n_pagos').keyup(function(e) 
{
    let result = parseFloat($(this).val());
    let no_pago_k = (isNaN(result) ? 0 : result);
    let new_pago_parcial = 0;
    if(no_pago_k != 0)
    {
        new_pago_parcial = total_venta_salida/no_pago_k;
    }
    $('#pago_parcial').val(new_pago_parcial.toFixed(2));
    //console.log(new_pago_parcial);
});

$('#n_pagos').change(function(e) 
{
    let result = parseFloat($(this).val());
    let no_pago_k = (isNaN(result) ? 0 : result);
    let new_pago_parcial = 0;
    if(no_pago_k != 0)
    {
        new_pago_parcial = total_venta_salida/no_pago_k;
    }
    $('#pago_parcial').val(new_pago_parcial.toFixed(2));
});

$('#pago_parcial').keyup(function(e) 
{
    let result = parseFloat($(this).val());
    let pago_parcial_k = (isNaN(result) ? 0 : result);
    let new_no_pago = 0;
    if(pago_parcial_k != 0)
    {
        new_no_pago = total_venta_salida/pago_parcial_k;
    }
    $('#n_pagos').val(new_no_pago.toFixed(2));
    //console.log(new_no_pago);
});

$('#pago_parcial').change(function(e) 
{
    let result = parseFloat($(this).val());
    let pago_parcial_k = (isNaN(result) ? 0 : result);
    let new_no_pago = 0;
    if(pago_parcial_k != 0)
    {
        new_no_pago = total_venta_salida/pago_parcial_k;
    }
    $('#n_pagos').val(new_no_pago.toFixed(2));
});


function transferir_almacen(idproducto)
{
    var action = 'SelectAlmacen';
    $.ajax({
        url: 'ajax.php',
        type: "POST",
        async: true,
        data: {action:action,producto:idproducto},
        success: function(response) {
            //$('#prueba').val(response);
            if (response != 0) 
            {
              $('#idproducto_trans').val(idproducto);
              var data = $.parseJSON(response);
              $('#name_producto_transferir').val(data.name_producto);
              $('#serie_trans').empty();
              $('#serie_trans').append(data.series);
            }
        },
        error: function(error) {
            //$('#prueba').val('error');
        }
   });  
}

//funciones de ENTRADA
var pago_parcial_entrada = 0;
var pagos_parciales = [0,0,0,0,0];
var precio_base_entrada = [0,0,0,0,0];
function mostrar_pagos(id)
{
    let precio_entrada = parseFloat($('#precio_'+id).val());
    precio_base_entrada[id-1] = precio_entrada;
    //console.log(precio_entrada);
    //calcular pago parcial de entrada
    let no_pago_entrada =  parseFloat($('#n_pagos_entrada').val());
    pagos_parciales[id-1] = precio_entrada/no_pago_entrada;
    pago_parcial_entrada = 0;
    for (var i = 0; i < pagos_parciales.length; i++) 
    {
        pago_parcial_entrada = pago_parcial_entrada + pagos_parciales[i];
    }
    //console.log(pagos_parciales);
    $('#pago_parcial_entrada').val(pago_parcial_entrada);
}

function multiplicar_precio_entrada(id)
{
    let cantidad = $("#cantidad_"+id).val();
    //$('#precio_'+id).val(parseInt(precio_base_entrada[id-1]*cantidad));
    if(cantidad <= 1)
    {
        $('#div_serie_'+id).html('<input type="text" class="form-control" name="serie_1" id="serie_1" onkeyup="mayusculas(this)">');
    }
    else
    {
        $('#div_serie_'+id).html('<button type="button" data-toggle="modal" data-target="#series'+id+'" class="form-group btn btn-primary">Cargar Series</button>');
        let serie_inputs = '<div id="series'+id+'" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">\
        <div class="modal-dialog" role="document">\
            <div class="modal-content">\
                <div class="modal-header bg text-black">\
                    <h5 class="modal-title" id="my-modal-title">Agregar series de los productos a comprar</h5>\
                    <button class="close" data-dismiss="modal" aria-label="Close">\
                        <span aria-hidden="true">&times;</span>\
                    </button>\
                </div>\
                <div class="modal-body">\
                    <div class="row">\
                    <div class="col-lg-12">';
        for (var i = 0; i < cantidad; i++) 
        {
            serie_inputs = serie_inputs + '<div class="form-group">\
                                <label for="correo">Serie '+(i+1)+'</label>\
                                <input type="text" class="form-control" name="series_modal_'+id+'[]" id="series_modal_'+id+'[]" maxlength="99">\
                            </div>';
        }
        serie_inputs = serie_inputs + '</div></div></div></div></div></div>';
        $('#series_modales').append(serie_inputs);
    }
}

var cards_showed_entrada = 0;
var disponibles_entrada = [1,2,3,4,5];
function add_entrada() 
{
    $('#btn_comprar').removeAttr("disabled");
    if(cards_showed_entrada < 5)
    {
        $('#card_entrada'+disponibles_entrada[0]).removeAttr("hidden");
        disponibles_entrada.shift();
        cards_showed_entrada = cards_showed_entrada + 1;
    }
}

function borrar_card_entrada(idcard)
{
    $("#card_entrada"+idcard).attr("hidden","hidden");
    cards_showed_entrada = cards_showed_entrada - 1;
    disponibles_entrada.push(idcard);
    //quitar los datos de los inputs 
    $("#identificador_pro_"+idcard).val(0).trigger('change');
    $("#cantidad_"+idcard).val(1);
    $("#serie_"+idcard).val("");
    $("#precio_"+idcard).val(0);
    //console.log(disponibles);
    precio_base_entrada[idcard-1] = 0;
    pago_parcial_entrada = 0;
    for (var i = 0; i < precio_base_entrada.length; i++) 
    {
        pago_parcial_entrada = pago_parcial_entrada + precio_base_entrada[i];
    }
    $('#pago_parcial_entrada').val(pago_parcial_entrada);
}

var total_compra_entrada = 0;
function calcular_cuenta_entrada()
{
    let con_iva = [];
    let precios_siniva = [];
    let ivas = [];
    let precios_coniva = [];
    let subtotal1 = 0;
    let iva = 0;
    let subtotal2 = 0;

    for (let i = 1; i <= 5; i++) 
    {
        let cantidad = $("#cantidad_"+i).val();
        con_iva[i-1] = document.getElementById('tiene_iva_'+i).checked;
        if(con_iva[i-1] == false) //esto quiere decir que NO trae el iva calculado
        {
            //lo agregamos como es y ponemos en el array de ivas su iva calculado
            let result = parseFloat($("#precio_"+i).val());
            precios_siniva[i-1] = (isNaN(result) ? 0 : result*cantidad);
            ivas[i-1] = precios_siniva[i-1]*0.16;
            precios_coniva[i-1] = precios_siniva[i-1] + ivas[i-1];
        }
        else
        {
            //ya trae el iva el precio, lo sacamos del precio y lo ponemos aparte en el array
            let result = parseFloat($("#precio_"+i).val());
            precios_siniva[i-1] = (isNaN(result) ? 0 : (result*cantidad)/1.16);
            ivas[i-1] = precios_siniva[i-1]*0.16;
            precios_coniva[i-1] = precios_siniva[i-1] + ivas[i-1];
        }
        subtotal1 = subtotal1 + precios_siniva[i-1];
        iva = iva + ivas[i-1];
        subtotal2 = subtotal2 + precios_coniva[i-1];
        //el descuento se calculara cuando vaya ingresando datos
    }
    total_compra_entrada = subtotal2;
    /*console.log(id_tipo_precio);
    console.log(ivas);
    console.log(precios_coniva);*/
    //console.log(precios_siniva);
    
    //console.log(subtotal1);
    $('#costos_calculados_entrada').removeAttr("hidden");
    $('#subtotal1').html("$" + subtotal1.format(2,3));
    $('#ivas').html("$" + iva.format(2,3));
    $('#subtotal2').html("$" + subtotal2.format(2,3));
    $('#total_general').html("$" + total_compra_entrada.format(2,3));

    //ponerlos en los inputs flags
    $('#subtotal1_flag').val(subtotal1.toFixed(2));
    $('#ivas_flag').val(iva.toFixed(2));
    $('#subtotal2_flag').val(subtotal2.toFixed(2));
    $('#total_flag').val(total_compra_entrada.toFixed(2));

    $('#btn_haz_compra').removeAttr('disabled');
}

$('#descuento_compra').keyup(function(e) 
{
    let result = parseFloat($(this).val());
    var precio_descuento = (isNaN(result) ? 0 : result);
    let total_compra_entrada_temp = total_compra_entrada - precio_descuento;
    //console.log(total_venta_salida_temp);
    $('#total_general').html('$'+total_compra_entrada_temp.format(2,3));
    $('#total_flag').val(total_compra_entrada_temp.toFixed(2));
});

function es_serializado(id)
{
    let producto = $('#identificador_pro_'+id).val();
    var action = "buscar_si_es_serializado";
        $.ajax({
        url: "ajax.php",
        type: "POST",
        data: {action: action, idproducto: producto},
        success: function (response) 
        {
            //$('#prueba').html(response);
            if(response == 1) //si es serializado
            {
                $('#div_serie_'+id).removeAttr('disabled');
                $('#flag_producto_serie_'+id).val(1);
            }
            else
            {
                //no es serializado
                $('#div_serie_'+id).attr('disabled','disabled');
                $('#flag_producto_serie_'+id).val(0);
            }
        },
        error: function(error) {
            //$('#prueba').val('error');
        }
    });
}

function eliminar_entrada(entrada)
{
    //por el momento no va afuncionar eliminar entradas, solo lo quita de la tabla pero hay que restar inventario y eso y esta cabron
    Swal.fire({
            title: '¿Esta seguro de eliminar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI, Eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                var action = 'eliminar_entrada';
                $.ajax({
                  url: 'ajax.php',
                  type: "POST",
                  async: true,
                  data: {action:action, identrada:entrada},
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
                                window.location.href = "lista_entradas.php";
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
                                window.location.href = "lista_entradas.php";
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

function suspender_entrada(entrada) 
{
    Swal.fire({
            title: '¿Esta seguro de susupender?',
            text: 'Si está suspendido se activará',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, suspender!'
        }).then((result) => {
            if (result.isConfirmed) {
                var action = 'suspender_entrada';
                $.ajax({
                  url: 'ajax.php',
                  type: "POST",
                  async: true,
                  data: {action:action, identrada:entrada},
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
                                window.location.href = "lista_entradas.php";
                            }
                        })   
                    }
                    else
                    {
                        Swal.fire(
                          'Suspendido!',
                          'Se suspendio correctamente!',
                          'success'
                        ).then((result) => {
                            if (result.isConfirmed){
                                window.location.href = "lista_entradas.php";
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
//FIN ENTRADA

//de proveedor
$('#proveedor_entrada').change(function(e) 
{
    e.preventDefault();
    var id_proveedor = $(this).val();
    var action = "buscar_tel_proveedor";
        $.ajax({
        url: "ajax.php",
        type: "POST",
        data: {action: action, idproveedor: id_proveedor},
        success: function (response) 
        {
            //$('#prueba').html(response);
            var data = $.parseJSON(response); 
            //console.log(cliente);
            $('#tel_proveedor_entrada').val(data.tel_proveedor);
        },
        error: function(error) {
            //$('#prueba').val('error');
        }
    });
});

function hide_costos()
{
    $('#tbl_productos td:nth-child(2)').hide();
    $('#tbl_productos th:nth-child(2)').hide();
    $('#tbl_productos td:nth-child(3)').hide();
    $('#tbl_productos th:nth-child(3)').hide();
    $('#tbl_productos td:nth-child(4)').hide();
    $('#tbl_productos th:nth-child(4)').hide();
    $('#tbl_productos td:nth-child(5)').hide();
    $('#tbl_productos th:nth-child(5)').hide();
}

//para hacer mayusculas
function mayusculas(e) {
    e.value = e.value.toUpperCase();
}

function actualizar_tabla_productos()
{
    var atr1 = $('#filtro_atr1').val();  
    var atr2 = $('#filtro_atr2').val();
    var atr3 = $('#filtro_atr3').val();
    var atr4 = $('#filtro_atr4').val();
    var atr5 = $('#filtro_atr5').val();
    //si es LABEL entonces no han seleccionado nada o seleccionaron TODAS
    
    //otras variables
    var idcat = $('#categoria').val();
    var idsubcat = $('#subcategoria').val();

    var action = 'searchForAtr';
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
}

//funciones y cosas para el modulo productos
$('#tiene_subcat').change(function()
{
  if (document.getElementById('tiene_subcat').checked)
  {
    $("#formAdd_cat :input:not(#nombre_cat,#tiene_subcat,#btn_guardarcat,#btn_cancerlarcat,#atr1,#action,#flagidcategoria)").attr("disabled","disabled");
    $('#formAdd_cat :input:not(#nombre_cat,#tiene_subcat,#btn_guardarcat,#btn_cancerlarcat,#atr1,#action,#flagidcategoria)').val('');
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

//funcion para crear el boton de elimnar y editar de los tipos de venta
$('#tipo_compra').change(function(e) 
{
    e.preventDefault();
    var idtipo_compra = $(this).val();
    $('#btnedit_tipo_compra').attr('onClick', 'editar_tipo_compra("'+idtipo_compra+'");');
    $('#btnedit_tipo_compra').removeAttr('disabled');

    var action = 'searchTipoCompraUsed';
    $.ajax({
      url: 'ajax.php',
      type: "POST",
      async: true,
      data: {action:action,tipo_compra:idtipo_compra},
      success: function(response) {
        if(response == 0)
        {
            $('#btneliminar_tipo_compra').attr('onClick', 'eliminar_tipo_compra("'+idtipo_compra+'");');
            $('#btneliminar_tipo_compra').removeAttr('disabled');
        }
        else
        {
            $('#btneliminar_tipo_compra').attr('onClick', 'eliminar_tipo_compra();');
            $('#btneliminar_tipo_compra').attr('disabled','disabled');
        }
        //$('#prueba').html(response); 
      },
      error: function(error) {
        //$('#sucursal').val('error');
      }
    });
});

//funcion para crear el boton de elimnar y editar de los tipos de venta
$('#proveedor_entrada').change(function(e) 
{
    e.preventDefault();
    var idproveedor = $(this).val();
    $('#btnedit_proveedor').attr('onClick', 'editar_proveedor("'+idproveedor+'");');
    $('#btnedit_proveedor').removeAttr('disabled');

    var action = 'searchProveedorUsed';
    $.ajax({
      url: 'ajax.php',
      type: "POST",
      async: true,
      data: {action:action,proveedor:idproveedor},
      success: function(response) {
        if(response == 0)
        {
            $('#btneliminar_proveedor').attr('onClick', 'eliminar_proveedor("'+idproveedor+'");');
            $('#btneliminar_proveedor').removeAttr('disabled');
        }
        else
        {
            $('#btneliminar_proveedor').attr('onClick', 'eliminar_proveedor();');
            $('#btneliminar_proveedor').attr('disabled','disabled');
        }
        //$('#prueba').html(response); 
      },
      error: function(error) {
        //$('#sucursal').val('error');
      }
    });
});

//funcion para crear el boton de elimnar y editar de los tipos de venta
$('#tipo_venta').change(function(e) 
{
    e.preventDefault();
    var idtipo_venta = $(this).val();
    $('#btnedit_tipo_venta').attr('onClick', 'editar_tipo_venta("'+idtipo_venta+'");');
    $('#btnedit_tipo_venta').removeAttr('disabled');

    var action = 'searchTipoVentaUsed';
    $.ajax({
      url: 'ajax.php',
      type: "POST",
      async: true,
      data: {action:action,tipo_venta:idtipo_venta},
      success: function(response) {
        if(response == 0)
        {
            $('#btneliminar_tipo_venta').attr('onClick', 'eliminar_tipo_venta("'+idtipo_venta+'");');
            $('#btneliminar_tipo_venta').removeAttr('disabled');
        }
        else
        {
            $('#btneliminar_tipo_venta').attr('onClick', 'eliminar_tipo_venta();');
            $('#btneliminar_tipo_venta').attr('disabled','disabled');
        }
        //$('#prueba').html(response); 
      },
      error: function(error) {
        //$('#sucursal').val('error');
      }
    });
});

//funcion para crear el boton de elimnar y editar de las modalidades de pago
$('#modalidad_pago').change(function(e) 
{
    e.preventDefault();
    var idmodalidad_pago = $(this).val();
    //console.log(idmodalidad_pago);
    if (idmodalidad_pago == "mensual")
    {
        $('#dias_pago_semanal').val("default").change();
        $('#dias_pago_semanal').attr("disabled","disabled");
        $('#dias_pago_quincenal').attr("disabled","disabled");
        $('#dias_pago_quincenal_2').attr("disabled","disabled");
        $('#dias_pago_mensual').removeAttr("disabled");
    }
    else if(idmodalidad_pago == "quincenal")
    {
        $('#dias_pago_semanal').val("default").change();
        $('#dias_pago_semanal').attr("disabled","disabled");
        $('#dias_pago_mensual').attr("disabled","disabled");
        $('#dias_pago_quincenal').removeAttr("disabled");
        $('#dias_pago_quincenal_2').removeAttr("disabled");
    }
    else if(idmodalidad_pago == "semanal")
    {
        $('#dias_pago_mensual').attr("disabled","disabled");
        $('#dias_pago_quincenal').attr("disabled","disabled");
        $('#dias_pago_quincenal_2').attr("disabled","disabled");
        $('#dias_pago_semanal').removeAttr("disabled");
    }
});

$('#modalidad_pago_actual').change(function(e) 
{
    e.preventDefault();
    var idmodalidad_pago = $(this).val();
    //console.log(idmodalidad_pago);
    if (idmodalidad_pago == "mensual")
    {
        $('#dias_pago_semanal_actual').val("default").change();
        $('#dias_pago_semanal_actual').attr("disabled","disabled");
        $('#dias_pago_quincenal_actual').attr("disabled","disabled");
        $('#dias_pago_quincenal_2_actual').attr("disabled","disabled");
        $('#dias_pago_mensual_actual').removeAttr("disabled");
    }
    else if(idmodalidad_pago == "quincenal")
    {
        $('#dias_pago_semanal_actual').val("default").change();
        $('#dias_pago_semanal_actual').attr("disabled","disabled");
        $('#dias_pago_mensual_actual').attr("disabled","disabled");
        $('#dias_pago_quincenal_actual').removeAttr("disabled");
        $('#dias_pago_quincenal_2_actual').removeAttr("disabled");
    }
    else if(idmodalidad_pago == "semanal")
    {
        $('#dias_pago_mensual_actual').attr("disabled","disabled");
        $('#dias_pago_quincenal_actual').attr("disabled","disabled");
        $('#dias_pago_quincenal_2_actual').attr("disabled","disabled");
        $('#dias_pago_semanal_actual').removeAttr("disabled");
    }
});

/*esto ya no, porque ahora ya no se agregan modalidades de pago, estan predefinidas
$('#modalidad_pago').change(function(e) 
{
    e.preventDefault();
    var idmodalidad_pago = $(this).val();
    $('#btnedit_modalidad_pago').attr('onClick', 'editar_modalidad_pago("'+idmodalidad_pago+'");');
    $('#btnedit_modalidad_pago').removeAttr('disabled');

    var action = 'searchModalidadPagoUsed';
    $.ajax({
      url: 'ajax.php',
      type: "POST",
      async: true,
      data: {action:action,modalidad_pago:idmodalidad_pago},
      success: function(response) {
        if(response == 0)
        {
            $('#btndelete_modalidad_pago').attr('onClick', 'eliminar_modalidad_pago("'+idmodalidad_pago+'");');
            $('#btndelete_modalidad_pago').removeAttr('disabled');
        }
        else
        {
            $('#btndelete_modalidad_pago').attr('onClick', 'eliminar_modalidad_pago();');
            $('#btndelete_modalidad_pago').attr('disabled','disabled');
        }
        //$('#prueba').html(response); 
      },
      error: function(error) {
        //$('#sucursal').val('error');
      }
    });
});
*/

//funcion para quitar options repetidos
function remove_repeated_option(idselect)
{
    var code = {};
    $("select[name='"+idselect+"'] > option").each(function () {
        if(code[this.text]) {
            $(this).remove();
        } else {
            code[this.text] = this.value;
        }
    });
}

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
        //$('#prueba').html(response);
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
                $('#filtro_atr1').append('<option selected value="LABEL">'+data.atr_labels.atr1+'</option>');    
            }
            else
            {
                $('#filtro_atr1').append('<option selected value="LABEL">---</option>');
            }
            $("#filtro_atr2").empty();
            if(data.atr_labels.atr2 != null)
            {
                $('#filtro_atr2').append('<option selected value="LABEL">'+data.atr_labels.atr2+'</option>');
            }
            else
            {
                $('#filtro_atr2').append('<option selected value="LABEL">---</option>');
            }
            $("#filtro_atr3").empty();
            if(data.atr_labels.atr3 != null)
            {
                $('#filtro_atr3').append('<option selected value="LABEL">'+data.atr_labels.atr3+'</option>');
            }
            else
            {
                $('#filtro_atr3').append('<option selected value="LABEL">---</option>');
            }
            $("#filtro_atr4").empty();
            if(data.atr_labels.atr4 != null)
            {
                $('#filtro_atr4').append('<option selected value="LABEL">'+data.atr_labels.atr4+'</option>');
            }
            else
            {
                $('#filtro_atr4').append('<option selected value="LABEL">---</option>');
            }
            $("#filtro_atr5").empty();
            if(data.atr_labels.atr5 != null)
            {
                $('#filtro_atr5').append('<option selected value="LABEL">'+data.atr_labels.atr5+'</option>');
            }
            else
            {
                $('#filtro_atr5').append('<option selected value="LABEL">---</option>');
            }

            var size_atrs = data.atrs_productos.length;
            for (var i=0;i<size_atrs;i++) 
            {
                if(data.atrs_productos[i].atr1_producto != null)
                {
                    $('#filtro_atr1').append('<option value="'+data.atrs_productos[i].atr1_producto+'">'+data.atrs_productos[i].atr1_producto+'</option>');
                }
                if(data.atrs_productos[i].atr2_producto != null)
                {
                    $('#filtro_atr2').append('<option value="'+data.atrs_productos[i].atr2_producto+'">'+data.atrs_productos[i].atr2_producto+'</option>');
                }
                if(data.atrs_productos[i].atr3_producto != null)
                {
                    $('#filtro_atr3').append('<option value="'+data.atrs_productos[i].atr3_producto+'">'+data.atrs_productos[i].atr3_producto+'</option>');
                }
                if(data.atrs_productos[i].atr4_producto != null)
                {
                    $('#filtro_atr4').append('<option value="'+data.atrs_productos[i].atr4_producto+'">'+data.atrs_productos[i].atr4_producto+'</option>');
                }
                if(data.atrs_productos[i].atr5_producto != null)
                {
                    $('#filtro_atr5').append('<option value="'+data.atrs_productos[i].atr5_producto+'">'+data.atrs_productos[i].atr5_producto+'</option>');
                }
            }
            //fin de poner los atributos
            remove_repeated_option("filtro_atr1");
            remove_repeated_option("filtro_atr2");
            remove_repeated_option("filtro_atr3");
            remove_repeated_option("filtro_atr4");
            remove_repeated_option("filtro_atr5");
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
                $('#filtro_atr1').append('<option selected value="LABEL">'+data.atr_labels.atr1+'</option>');    
            }
            else
            {
                $('#filtro_atr1').append('<option selected value="LABEL">---</option>');
            }
            $("#filtro_atr2").empty();
            if(data.atr_labels.atr2 != null)
            {
                $('#filtro_atr2').append('<option selected value="LABEL">'+data.atr_labels.atr2+'</option>');
            }
            else
            {
                $('#filtro_atr2').append('<option selected value="LABEL">---</option>');
            }
            $("#filtro_atr3").empty();
            if(data.atr_labels.atr3 != null)
            {
                $('#filtro_atr3').append('<option selected value="LABEL">'+data.atr_labels.atr3+'</option>');
            }
            else
            {
                $('#filtro_atr3').append('<option selected value="LABEL">---</option>');
            }
            $("#filtro_atr4").empty();
            if(data.atr_labels.atr4 != null)
            {
                $('#filtro_atr4').append('<option selected value="LABEL">'+data.atr_labels.atr4+'</option>');
            }
            else
            {
                $('#filtro_atr4').append('<option selected value="LABEL">---</option>');
            }
            $("#filtro_atr5").empty();
            if(data.atr_labels.atr5 != null)
            {
                $('#filtro_atr5').append('<option selected value="LABEL">'+data.atr_labels.atr5+'</option>');
            }
            else
            {
                $('#filtro_atr5').append('<option selected value="LABEL">---</option>');
            }

            var size_atrs = data.atrs_productos.length;
            for (var i=0;i<size_atrs;i++) 
            {
                if(data.atrs_productos[i].atr1_producto != null)
                {
                    $('#filtro_atr1').append('<option value="'+data.atrs_productos[i].atr1_producto+'">'+data.atrs_productos[i].atr1_producto+'</option>');
                }
                if(data.atrs_productos[i].atr2_producto != null)
                {
                    $('#filtro_atr2').append('<option value="'+data.atrs_productos[i].atr2_producto+'">'+data.atrs_productos[i].atr2_producto+'</option>');
                }
                if(data.atrs_productos[i].atr3_producto != null)
                {
                    $('#filtro_atr3').append('<option value="'+data.atrs_productos[i].atr3_producto+'">'+data.atrs_productos[i].atr3_producto+'</option>');
                }
                if(data.atrs_productos[i].atr4_producto != null)
                {
                    $('#filtro_atr4').append('<option value="'+data.atrs_productos[i].atr4_producto+'">'+data.atrs_productos[i].atr4_producto+'</option>');
                }
                if(data.atrs_productos[i].atr5_producto != null)
                {
                    $('#filtro_atr5').append('<option value="'+data.atrs_productos[i].atr5_producto+'">'+data.atrs_productos[i].atr5_producto+'</option>');
                }
            }
            remove_repeated_option("filtro_atr1");
            remove_repeated_option("filtro_atr2");
            remove_repeated_option("filtro_atr3");
            remove_repeated_option("filtro_atr4");
            remove_repeated_option("filtro_atr5");
        //fin de poner los atributos
      },
      error: function(error) {
        //$('#sucursal').val('error');
      }
    });
});

//=========================== los select para los filtros por atributos
//FILTRO 1 2 3 4 y 5
$('#filtro_atr1, #filtro_atr2, #filtro_atr3, #filtro_atr4, #filtro_atr5').change(function(e) 
{
    e.preventDefault();
    //variables para los filtros
    actualizar_tabla_productos();
});
//============ FIN DE LOS FILTROS ===========

//empezamos con lo de producto
var contado = 0;
var especial = 0;
//cr1
var base_inicial_c1 = 0;
var ganancia_inicial_c1 = 0;
var rango_c1 = 0;
var ganancia_subsecuente_c1 = 0;
var limite_costo_c1 = 0;
//cr2
var base_inicial_c2 = 0;
var ganancia_inicial_c2 = 0;
var rango_c2 = 0;
var ganancia_subsecuente_c2 = 0;
var limite_costo_c2 = 0;

var meses_pago = 0;
var enganche = 0;
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
            //cr1
            base_inicial_c1 = parseFloat(data.base_inicial_c1);
            ganancia_inicial_c1 = parseFloat(data.ganancia_inicial_c1);
            rango_c1 = parseFloat(data.rango_c1);
            ganancia_subsecuente_c1 = parseFloat(data.ganancia_subsecuente_c1);
            limite_costo_c1 = parseFloat(data.limite_costo_c1);
            //cr2
            base_inicial_c2 = parseFloat(data.base_inicial_c2);
            ganancia_inicial_c2 = parseFloat(data.ganancia_inicial_c2);
            rango_c2 = parseFloat(data.rango_c2);
            ganancia_subsecuente_c2 = parseFloat(data.ganancia_subsecuente_c2);
            limite_costo_c2 = parseFloat(data.limite_costo_c2);

            enganche = parseFloat(data.enganche);
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
            //cr1
            base_inicial_c1 = 0;
            ganancia_inicial_c1 = 0;
            rango_c1 = 0;
            ganancia_subsecuente_c1 = 0;
            limite_costo_c1 = 0;
            //cr2
            base_inicial_c2 = 0;
            ganancia_inicial_c2 = 0;
            rango_c2 = 0;
            ganancia_subsecuente_c2 = 0;
            limite_costo_c2 = 0;
            meses_pago = 0;
            enganche = 0;
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
            //cr1
            base_inicial_c1 = parseFloat(data.base_inicial_c1);
            ganancia_inicial_c1 = parseFloat(data.ganancia_inicial_c1);
            rango_c1 = parseFloat(data.rango_c1);
            ganancia_subsecuente_c1 = parseFloat(data.ganancia_subsecuente_c1);
            limite_costo_c1 = parseFloat(data.limite_costo_c1);
            //cr2
            base_inicial_c2 = parseFloat(data.base_inicial_c2);
            ganancia_inicial_c2 = parseFloat(data.ganancia_inicial_c2);
            rango_c2 = parseFloat(data.rango_c2);
            ganancia_subsecuente_c2 = parseFloat(data.ganancia_subsecuente_c2);
            limite_costo_c2 = parseFloat(data.limite_costo_c2);

            meses_pago = data.meses_pago;
            enganche = parseFloat(data.enganche);
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
        $('#costo_iva').val(Math.ceil(costo_iva));
        //contado
        if(contado == 0)
        {
            $('#costo_contado').val(0);
        }
        else
        {
            var costo_contado = costo_iva + (costo_iva*(contado/100));
            $('#costo_contado').val(Math.ceil(costo_contado));
        }
        //especial
        if(especial == 0 || especial == null)
        {
            $('#costo_especial').val(0);
        }
        else
        {
            var costo_especial = costo_contado + (costo_contado*(especial/100));
            $('#costo_especial').val(Math.ceil(costo_especial));
        }

        //==== credito1
        if(base_inicial_c1 == 0)
        {
            $('#costo_cr1').val(0);
        }
        else
        {
            //recorrer secuencia hasta encontrar el rango donde este el costo_iva
            var cr1 = 0;
            if(costo_iva < base_inicial_c1)
            {
                cr1 = ganancia_inicial_c1;
            }
            else if (costo_iva < (base_inicial_c1 + rango_c1))
            {
                cr1 = ganancia_subsecuente_c1;
            }
            else
            {
                var costo_temp = base_inicial_c1 + rango_c1;//2100
                var ganancia_temp = ganancia_subsecuente_c1;// 80
                while(true)
                {
                    costo_temp = costo_temp + rango_c1;//2200,2300
                    ganancia_temp = ganancia_temp - 1;//79,78
                    //2250<2200, 2250<2300,   //2100<=10000,2200<=10000
                    if((costo_iva < costo_temp) || (costo_temp >= limite_costo_c1))
                    {
                        cr1 = ganancia_temp;
                        break;
                    }
                }
            }
            var costo_cr1 = costo_iva + (costo_iva*(cr1/100));
            $('#costo_cr1').val(Math.ceil(costo_cr1));
        }
        //==== credito2
        if(base_inicial_c2 == 0)
        {
            $('#costo_cr2').val(0);
        }
        else
        {
            //recorrer secuencia hasta encontrar el rango donde este el costo_iva
            var cr2 = 0;
            if(costo_iva < base_inicial_c2)
            {
                cr2 = ganancia_inicial_c2;
            }
            else if(costo_iva < base_inicial_c2 + rango_c2)
            {
                cr2 = ganancia_subsecuente_c2;
            }
            else
            {
                var costo_temp2 = base_inicial_c2 + rango_c2;//2100
                var ganancia_temp2 = ganancia_subsecuente_c2;// 80
                while(true)
                {
                    costo_temp2 = costo_temp2 + rango_c2;//2200,2300
                    ganancia_temp2 = ganancia_temp2 - 1;//79,78
                    //2250<2200, 2250<2300,   //2100<=10000,2200<=10000
                    if((costo_iva < costo_temp2) || (costo_temp2 >= limite_costo_c2))
                    {
                        cr2 = ganancia_temp2;
                        break;
                    }
                }
            }
            var costo_cr2 = costo_iva + (costo_iva*(cr2/100));
            $('#costo_cr2').val(Math.ceil(costo_cr2));
            //$('#asd1').val(costo_temp2);
            //$('#asd2').val(cr2);
        }

        //E-Q
        if(meses_pago == 0)
        {
            $('#costo_eq').val(0);
        }
        else
        {
            //nueva formula
            //(costo_iva-enganche+(cr_2*0.03))/meses_pago <- redondear al siguiente multiplico de 5
            var e_q = (costo_iva/meses_pago);
            if(e_q < 400)
            {
                $('#costo_eq').val(400);
            }
            else
            {
                //redondear al 100 siguiente
                $('#costo_eq').val(Math.ceil(e_q));
            }
        }
        //p1
        //nueva formaula
        //redondear al siguiente 0.5
        var p1 = ((costo_cr1/e_q)/2).toFixed(2);
        if(isNaN(p1))
        {
            $('#costo_p1').val(0);
        }
        else
        {
            $('#costo_p1').val(p1);
        }
        //p2
        var p2 = ((costo_cr2/e_q)/2).toFixed(2);
        if(isNaN(p2))
        {
            $('#costo_p2').val(0);
        }
        else
        {
            $('#costo_p2').val(p2);
        }
        //enganche
        if(enganche == 0)
        {
            $('#costo_enganche').val(0);
        }
        else
        {
            var costo_enganche = costo_cr2*(enganche/100) + 100;
            $('#costo_enganche').val(Math.ceil(costo_enganche));
        }
    }
    else
    {
        $('#costo_iva,#costo_contado,#costo_especial,#costo_cr1,#costo_cr2,#costo_eq,#costo_p1,#costo_p2,#costo_enganche').val(0);
    }
    
});

//funcion para ocultar las columnas de la tabla costos
function show_costoiva()
{
    //$('td:nth-child(2)').toggle();
    //$('th:nth-child(2)').toggle();
    //$('#tbl_productos td:nth-child(3)').toggle();
    //$('#tbl_productos th:nth-child(3)').toggle();
    $('#tbl_productos td:nth-child(4)').toggle();
    $('#tbl_productos th:nth-child(4)').toggle();
}

function show_new_costo()
{
    //activar el boton de guardar datos
    $('#btn_save_lista').removeAttr('disabled');
    //mostrar los productos que estan ocultos por tener null en Ext_p o Ext_m
    var action = 'get_hidden_products';
    //otras variables
    var atr1 = $('#filtro_atr1').val();
    var atr2 = $('#filtro_atr2').val();
    var atr3 = $('#filtro_atr3').val();
    var atr4 = $('#filtro_atr4').val();
    var atr5 = $('#filtro_atr5').val();
    var idcat = $('#categoria').val();
    var idsubcat = $('#subcategoria').val();
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
        hide_costos();
        $('#tbl_productos td:nth-child(2)').toggle();
        $('#tbl_productos th:nth-child(2)').toggle();
        $('#tbl_productos td:nth-child(3)').toggle();
        $('#tbl_productos th:nth-child(3)').toggle();
        $('#tbl_productos td:nth-child(5)').toggle();
        $('#tbl_productos th:nth-child(5)').toggle();

      },
      error: function(error) {
        //$('#sucursal').val('error');
      }
    });
}

function drop_ext_p()
{

    Swal.fire({
            title: '¿Esta seguro de vaciar Ext.-P?',
            text: 'Se eliminarán los datos Ext.-P de TODOS los productos',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, Eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                var action = 'Drop_ext_p';
                $.ajax({
                url: 'ajax.php',
                type: "POST",
                async: true,
                data: {action:action},
                success: function(response) 
                {
                    //$('#prueba').html(response);
                    if (response == 0) 
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
                        Swal.fire(
                        '¡Eliminado!',
                        'Se elimnaron los datos Ext.-P de TODOS los productos!',
                        'success'
                        ).then((result) => {
                        if (result.isConfirmed){
                            window.location.href = "productos.php";
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

function guardar_lista()
{
    //mandar al metodo ajax post y ahi recorrer y guardar los nuevos costos segun las reglas establecidas
    var new_costo = document.getElementsByName('nuevo_costo[]');
    var idproducto_newcosto = document.getElementsByName('flag_new_costo_idproducto[]');
    var array_new_costo = [];
    var array_idproducto_newcosto = [];
    for (var i = 0; i < idproducto_newcosto.length; i++) 
    {
        array_new_costo.push(new_costo[i].value);
        array_idproducto_newcosto.push(idproducto_newcosto[i].value);
    }
    //para las variables de ext_p
    var new_ext_p = document.getElementsByName('nuevo_ext_p[]');
    var idproducto_newext_p = document.getElementsByName('flag_new_extp_idproducto[]');
    var array_new_ext_p = [];
    var array_idproducto_newext_p = [];
    for (var i = 0; i < idproducto_newext_p.length; i++) 
    {
        array_new_ext_p.push(new_ext_p[i].value);
        array_idproducto_newext_p.push(idproducto_newext_p[i].value);
    }

    var action = 'GuardarEditarLista';
                $.ajax({
                  url: 'ajax.php',
                  type: "POST",
                  async: true,
                  data: {action:action,array_new_costo:array_new_costo,array_idproducto_newcosto:array_idproducto_newcosto,array_new_ext_p:array_new_ext_p,array_idproducto_newext_p:array_idproducto_newext_p},
                  success: function(response) 
                  {
                    //$('#prueba').html(response);
                    if (response == 0) 
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
                        Swal.fire(
                          '¡Guardado!',
                          'Se guardo la lista correctamente!',
                          'success'
                        ).then((result) => {
                            if (result.isConfirmed){
                                window.location.href = "productos.php";
                            }
                        })
                    }
                    
                  },
                  error: function(error) {
                    //$('#prueba').val('error');
                  }
                });  
}

//eliminar usuario
function eliminar_user(idusuario)
{
    Swal.fire({
            title: '¿Esta seguro de eliminar?',
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
                    //$('#prueba').html(response);
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
            title: '¿Esta seguro de eliminar?',
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
            title: '¿Esta seguro de eliminar?',
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
                    //$('#prueba').html(response);
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
            title: '¿Esta seguro de eliminar?',
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
                                //document.location.reload(true);
                                document.location.reload(true);
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
                                //actualizamos el valor sin recargar la pagina
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
                                document.location.reload(true);
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
                                document.location.reload(true);
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
                                document.location.reload(true);
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
                                //document.location.reload(true);
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
                                document.location.reload(true);
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

                $('#base_inicial_c1').val(data.base_inicial_c1);
                $('#ganancia_inicial_c1').val(data.ganancia_inicial_c1);
                $('#rango_c1').val(data.rango_c1);
                $('#ganancia_subsecuente_c1').val(data.ganancia_subsecuente_c1);
                $('#limite_costo_c1').val(data.limite_costo_c1);

                $('#base_inicial_c2').val(data.base_inicial_c2);
                $('#ganancia_inicial_c2').val(data.ganancia_inicial_c2);
                $('#rango_c2').val(data.rango_c2);
                $('#ganancia_subsecuente_c2').val(data.ganancia_subsecuente_c2);
                $('#limite_costo_c2').val(data.limite_costo_c2);

                $('#mesespago').val(data.meses_pago);
                $('#garantia').val(data.meses_garantia);
                $('#tiene_subcat').removeAttr('checked');
                $('#tiene_subcat').bootstrapToggle('off');
                $('#enganche').val(data.enganche);
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
                                document.location.reload(true);
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

//para editar subcategoria
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
                
                $('#base_inicial_c1_sub').val(data.base_inicial_c1);
                $('#ganancia_inicial_c1_sub').val(data.ganancia_inicial_c1);
                $('#rango_c1_sub').val(data.rango_c1);
                $('#ganancia_subsecuente_c1_sub').val(data.ganancia_subsecuente_c1);
                $('#limite_costo_c1_sub').val(data.limite_costo_c1);

                $('#base_inicial_c2_sub').val(data.base_inicial_c2);
                $('#ganancia_inicial_c2_sub').val(data.ganancia_inicial_c2);
                $('#rango_c2_sub').val(data.rango_c2);
                $('#ganancia_subsecuente_c2_sub').val(data.ganancia_subsecuente_c2);
                $('#limite_costo_c2_sub').val(data.limite_costo_c2);

                $('#mesespago_sub').val(data.meses_pago);
                $('#garantia_sub').val(data.meses_garantia);
                $('#enganche_sub').val(data.enganche);
            }
        },
        error: function(error) {
            //$('#prueba').val('error');
        }
   });  
}

//para editar tipo de venta
function editar_tipo_venta(idtipo_venta)
{
    var action = 'SelectTipoVenta';
    $.ajax({
        url: 'ajax.php',
        type: "POST",
        async: true,
        data: {action:action,tipo_venta:idtipo_venta},
        success: function(response) {
            //$('#prueba').html(response);
            if (response != 0) 
            {
              var data = $.parseJSON(response);
              $('#nuevatipo_venta').val(data.nombre_venta);
              $('#flagid_tipoVenta').val(data.idtipo_venta);
            }
        },
        error: function(error) {
            //$('#prueba').val('error');
        }
   });  
}

//eliminar tipo de venta
//funcion para eliminar subzona
function eliminar_tipo_venta(idtipo_venta)
{
    Swal.fire({
            title: '¿Esta seguro de eliminar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, Eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                var action = 'eliminarTipoVenta';
                $.ajax({
                  url: 'ajax.php',
                  type: "POST",
                  async: true,
                  data: {action:action,tipo_venta:idtipo_venta},
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
                                document.location.reload(true);
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
                                //document.location.reload(true);
                                $("#tipo_venta option[value='"+idtipo_venta+"']").remove();
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

//funcion para editar y eliminar modalidad de pago
//para editar tipo de venta
function editar_modalidad_pago(idmodalidad_pago)
{
    var action = 'SelectModalidadPago';
    $.ajax({
        url: 'ajax.php',
        type: "POST",
        async: true,
        data: {action:action,modalidad_pago:idmodalidad_pago},
        success: function(response) {
            //$('#prueba').html(response);
            if (response != 0) 
            {
              var data = $.parseJSON(response);
              $('#nuevamodalidad_pago').val(data.nombre_modalidad);
              $('#flagid_modalidadPago').val(data.idmodalidad_pago);
            }
        },
        error: function(error) {
            //$('#prueba').val('error');
        }
   });  
}

//eliminar tipo de venta
//funcion para eliminar subzona
function eliminar_modalidad_pago(idmodalidad_pago)
{
    Swal.fire({
            title: '¿Esta seguro de eliminar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, Eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                var action = 'eliminarModalidadPago';
                $.ajax({
                  url: 'ajax.php',
                  type: "POST",
                  async: true,
                  data: {action:action,modalidad_pago:idmodalidad_pago},
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
                                document.location.reload(true);
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
                                //document.location.reload(true);
                                $("#modalidad_pago option[value='"+idmodalidad_pago+"']").remove();
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

//para editar tipo de venta
function editar_tipo_compra(idtipo_compra)
{
    var action = 'SelectTipoCompra';
    $.ajax({
        url: 'ajax.php',
        type: "POST",
        async: true,
        data: {action:action,tipo_compra:idtipo_compra},
        success: function(response) {
            //$('#prueba').html(response);
            if (response != 0) 
            {
              var data = $.parseJSON(response);
              $('#nuevatipo_compra').val(data.nombre_compra);
              $('#flagid_tipoCompra').val(data.idtipo_compra);
            }
        },
        error: function(error) {
            //$('#prueba').val('error');
        }
   });  
}

//eliminar tipo de venta
//funcion para eliminar subzona
function eliminar_tipo_compra(idtipo_compra)
{
    Swal.fire({
            title: '¿Esta seguro de eliminar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, Eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                var action = 'eliminarTipoCompra';
                $.ajax({
                  url: 'ajax.php',
                  type: "POST",
                  async: true,
                  data: {action:action,tipo_compra:idtipo_compra},
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
                                document.location.reload(true);
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
                                $("#tipo_compra option[value='"+idtipo_compra+"']").remove();
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

//para editar proveedor
function editar_proveedor(idproveedor)
{
    var action = 'SelectProveedor';
    $.ajax({
        url: 'ajax.php',
        type: "POST",
        async: true,
        data: {action:action,proveedor:idproveedor},
        success: function(response) {
            //$('#prueba').html(response);
            if (response != 0) 
            {
              var data = $.parseJSON(response);
              $('#nuevoProveedor').val(data.nombre_proveedor);
              $('#flagid_Proveedor').val(data.idproveedor);
              $('#telProveedor').val(data.tel_proveedor);
            }
        },
        error: function(error) {
            //$('#prueba').val('error');
        }
   });  
}

//eliminar tipo de venta
//funcion para eliminar subzona
function eliminar_proveedor(idproveedor)
{
    Swal.fire({
            title: '¿Esta seguro de eliminar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, Eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                var action = 'eliminarProveedor';
                $.ajax({
                  url: 'ajax.php',
                  type: "POST",
                  async: true,
                  data: {action:action,proveedor:idproveedor},
                  success: function(response) {
                    //$('#prueba').html(response);
                    if (response == 0) 
                    {
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Ocurrio un error, intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                //con esto recargamos la pagina sin el POST DATA
                                document.location.reload(true);
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
                                $("#proveedor option[value='"+idproveedor+"']").remove();
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

function editar_movimiento(idmovimiento)
{
    var action = 'SelectMovimiento';
    $.ajax({
        url: 'ajax.php',
        type: "POST",
        async: true,
        data: {action:action,movimiento:idmovimiento},
        success: function(response) {
            //$('#prueba').html(response);
            if (response != 0) 
            {
              var data = $.parseJSON(response);
              $('#flag_id_movimiento').val(idmovimiento);
              $('#fecha_abono').val(data.fecha);
              $('#abono_hecho').val(data.abono);
              $('#descuento_hecho').val(data.descuento);
              $('#recargo').val(data.recargo);
            }
        },
        error: function(error) {
            //$('#prueba').val('error');
        }
   });
}

//eliminar_movimiento
function eliminar_movimiento(idmovimiento)
{
    Swal.fire({
            title: '¿Esta seguro de eliminar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                var action = 'eliminarMovimiento';
                $.ajax({
                  url: 'ajax.php',
                  type: "POST",
                  async: true,
                  data: {action:action,movimiento:idmovimiento},
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
                                document.location.reload(true);
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
                                document.location.reload(true);
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
              $('#costo_p1').val((parseFloat(data.costo_p1)).toFixed(2));
              $('#costo_p2').val((parseFloat(data.costo_p2)).toFixed(2));
              $('#costo_eq').val(data.costo_eq);
              $('#costo_enganche').val(data.costo_enganche);
              //quitamos bloqueo
              $('#atr1_producto,#atr2_producto,#atr3_producto,#atr4_producto,#atr5_producto').removeAttr('readonly');
              //$('#identificador').attr('readonly','readonly');
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
                                document.location.reload(true);
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
                                document.location.reload(true);
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
    $("#formAdd_producto :input:not(#btn_guardar_producto,#btn_cancerlar_producto,#flagid_producto,#action)").val('');
    $('#flag_selectsubcat').val('nosubcat');
    $('#serializado').bootstrapToggle('off');
    $('#atr1_producto,#atr2_producto,#atr3_producto,#atr4_producto,#atr5_producto').attr('readonly','readonly');
    $('#identificador').removeAttr('readonly');
    $('#label_atr1,#label_atr2,#label_atr3,#label_atr4,#label_atr5').html('');
}

function nueva_categoria()
{
    $('#flagidcategoria').val('nuevacat');
    $("#formAdd_cat :input:not(#btn_guardarcat,#btn_cancerlarcat,#atr1,#tiene_subcat,#action,#flagidcategoria)").val('');
    $('#tiene_subcat').bootstrapToggle('off');
    $('#tiene_subcat').removeAttr('checked');
    $('#enganche').val(6.5);
}

//funciones para subcategoria
function nueva_subcategoria()
{
    $('#flagidsubcategoria').val('nuevasubcat');
    $("#formAdd_subcat :input:not(#btn_guardarsubcat,#btn_cancerlarsubcat,#categoria_subcategoria,#atr1_sub,#action,#flagidsubcategoria)").val('');
    $('#enganche_sub').val(6.5);
}

function nueva_modadlidad_pago() 
{
    $('#flagid_modalidadPago').val('nueva_modalidad_de_pago');
    $("#nuevamodalidad_pago").val('');   
}

function nuevo_tipo_venta()
{
    $('#flagid_tipoVenta').val('nuevo_tipo_de_venta');
    $("#nuevatipo_venta").val('');
}

function nuevo_tipo_compra()
{
    $('#flagid_tipoCompra').val('nuevo_tipo_de_compra');
    $("#nuevatipo_compra").val('');
}

function nuevo_proveedor()
{
    $('#flagid_Proveedor').val('nuevo_proveedor');
    $("#nuevoProveedor").val('');
}

function nuevo_movimiento()
{
    $('#flag_id_movimiento').val('nuevo_movimiento');
    $("#abono_hecho, #descuento_hecho, #recargo").val('');
    $("#fecha_abono").val(formatDate(new Date()));
}

function formatDate(date) {
  return [
    date.getFullYear(),
    padTo2Digits(date.getMonth() + 1),
    padTo2Digits(date.getDate()),
  ].join('-');
}

function padTo2Digits(num) {
  return num.toString().padStart(2, '0');
}


//====
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
        data: {action:action,img_producto:url_img},
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
                                document.location.reload(true);
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
                                document.location.reload(true);
                            }
                        })
                    }
        },
        error: function(error) {
            //$('#prueba').val('error');
        }
   }); 
}

//funcion para activar especial
function activar_especial(status_especial)
{
    var msg = '';
    var msg_text = '';
    var msg_success = '';
    var msg_btn = '';
    if(status_especial == "si")
    {
        msg = '¿Esta seguro de activar el campo especial?';
        msg_text = 'El campo especial será AGREGADO en TODO el sistema';
        msg_success = 'Se activo especial correctamente';
        msg_btn = 'Sí!, activar';
    }
    else
    {
        msg = '¿Esta seguro de desactivar el campo especial?';
        msg_text = 'El campo especial será REMOVIDO en TODO el sistema';
        msg_success = 'Se desactivo especial correctamente';
        msg_btn = 'Sí!, desactivar';
    }
    Swal.fire({
            title: msg,
            text: msg_text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: msg_btn
        }).then((result) => {
            if (result.isConfirmed) {
                var action = 'activarEspecial';
                $.ajax({
                  url: 'ajax.php',
                  type: "POST",
                  async: true,
                  data: {action:action,status_especial:status_especial},
                  success: function(response) 
                  {
                    //$('#prueba').html(response);
                    if (response == 0) 
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
                        Swal.fire(
                          '¡Guardado!',
                           msg_success,
                          'success'
                        ).then((result) => {
                            if (result.isConfirmed){
                                window.location.href = "productos.php";
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
            title: '¿Esta seguro de convertir esta sucursal como Matriz?',
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

