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

$(document).ready(function() {
    $('.js-example-basic-multiple').select2();

    //funcion para poner tablas en español
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
//fin tablas en español

//para habilitar la edicion en cliente
$('#btneditar_cliente').click (function(e) {
    e.preventDefault();     //prevenir novos clicks
    $('#all_inputs').removeAttr("disabled");
    $('#update_cliente').removeAttr("disabled");
    $('#btneliminar_refs').removeAttr("style");
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
    $('#btnedit_zona').attr('onClick', 'editar_zona('+idzona+');');
    $('#btnedit_zona').removeAttr('disabled');
    
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
            $('#btneliminar_zona').attr('onClick', 'eliminar_zona('+idzona+');');
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
    $('#btnedit_subzona').attr('onClick', 'editar_subzona('+idsubzona+');');
    $('#btnedit_subzona').removeAttr('disabled');

    var action = 'searchSubzonaUsed';
    $.ajax({
      url: 'ajax.php',
      type: "POST",
      async: true,
      data: {action:action,subzona:idsubzona},
      success: function(response) {
        //var data = $.parseJSON(response);
        if(response == 0)
        {
            $('#btneliminar_subzona').attr('onClick', 'eliminar_subzona('+idsubzona+');');
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
    $('#btn_editarpuesto').attr('onClick', 'editar_puesto('+idpuesto+');');
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
            $('#btn_eliminarpuesto').attr('onClick', 'eliminar_puesto('+idpuesto+');');
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
    $('#btn_editartipo').attr('onClick', 'editar_tipo('+idtipo+');');
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
            $('#btn_eliminartipo').attr('onClick', 'eliminar_tipo('+idtipo+');');
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

//interfaz de producto, mostrar los atributos de categorias
//funcion para crear el boton de elimnar y editar de los puestos
$('#categoria_producto').change(function(e) 
{
    e.preventDefault();
    var idcat = $(this).val();
    if(idcat == "Lavadora")
    {
      $('#atr1_producto').removeAttr('disabled');
      $('#atr2_producto').removeAttr('disabled');
      $('#atr3_producto').removeAttr('disabled');
      $('#atr4_producto').removeAttr('disabled');

      $('#stockmin').removeAttr('disabled');
      $('#stockmax').removeAttr('disabled');

      $('#label_atr1').html("MARCA");
      $('#label_atr2').html("KG"); 
      $('#label_atr3').html("Tipo"); 
      $('#label_atr4').html("Secadora"); 
      $('#label_atr5').html("Sin atributo"); 
    }
    else
    {
      $('#label_atr1').html("---");
      $('#label_atr2').html("---"); 
      $('#label_atr3').html("---");
      $('#label_atr4').html("---"); 
      $('#label_atr5').html("---");
    }
});

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
                          icon: 'Error',
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
                          icon: 'Error',
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
                          icon: 'Error',
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
            title: 'Esta seguro de eliminar?',
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
                          icon: 'Error',
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
                          icon: 'Error',
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
                          icon: 'Error',
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

//para editar puesto
function editar_zona(idzona)
{
    var action = 'SelectZona';
    $.ajax({
        url: 'ajax.php',
        type: "POST",
        async: true,
        data: {action:action,zona:idzona},
        success: function(response) {
            //$('#prueba').val(response);
            if (response != 0) 
            {
              var data = $.parseJSON(response);
                $('#newzona_edit').val(data.zona);
                $('#idnewzona_edit').val(idzona);
            }
        },
        error: function(error) {
            //$('#prueba').val('error');
        }
   });  
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
                          icon: 'Error',
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

//para editar puesto
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
                $('#idnewsubzona_edit').val(idsubzona);
                //$('#idpuesto_flag').val(idpuesto);
            }
        },
        error: function(error) {
            //$('#prueba').val('error');
        }
   });  
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
                          icon: 'Error',
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
                    icon: 'Error',
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
                    icon: 'Error',
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
                          icon: 'Error',
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


//para hacer el input phone
/*function phoneMask() { 
    var num = $(this).val().replace(/\D/g,''); 
    $(this).val('(' + num.substring(0,3) + ')' + num.substring(3,6) + '-' + num.substring(6,10)); 
}
$('[type="tel"]').keyup(phoneMask);*/

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

