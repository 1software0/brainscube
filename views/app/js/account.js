var on = true;
var po = true;
var error_icon = '<span class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></span> ',
    success_icon = '<span class="a fa-check fa-lg" aria-hidden="true"></span> ',
    process_icon = '<span class="fa fa-spinner fa-spin fa-lg" aria-hidden="true"></span> ';
var nombre = $('#Nombre'), correo = $("#Correo"), apell = $("#Apellido"), new_p = $("#np"), addr = $("#address"), zc = $("#zc");

var vNombre = nombre.val(), vApe = apell.val(), vCoreo = correo.val(), vAddr = addr.val(), vZc = zc.val();

$('#account_a').prop('disabled', true);
$('#passwords').prop('disabled', true);
$('#direcc').prop('disabled', true);

$('#edit_add').click(function () {
  if (on) {
    $('#edit_t_add').show();
    $('#add').hide();
    $('#edit_add').text('Cancelar');
    $("#delete_addr").hide();
    on = false;
  } else {
    $('#edit_t_add').hide();
    $('#add').show();
    $('#edit_add').text('Editar');
    $('#direcc').prop('disabled', true);
    $("#delete_addr").show();
    on = true;
  }

});

$('#new_add').click(function () {
  if (po) {
    $('#edit_t_add').show();
    $('#new_add').text('Cancelar');
    po = false;
  } else {
    $('#edit_t_add').hide();
    $('#new_add').text('Nueva dirección');
    po = true;
  }

});

n = setInterval(function () {
  if (nombre.val() != vNombre || correo.val() != vCoreo || apell.val() != vApe) {
    $('#account_a').prop('disabled', false);
  } else {
    $('#account_a').prop('disabled', true);
  }
  if (new_p.val() != '') {
    $('#passwords').prop('disabled', false);
  } else {
    $('#passwords').prop('disabled', true);
  }
  if (addr.val() != vAddr || zc.val() != vZc) {
    $('#direcc').prop('disabled', false);
  } else {
    $('#direcc').prop('disabled', true);
  }
},200);



$('#account_a').click(function () {

  data = $('#account_form_a').serialize();
  $('#ajax_account_a').removeClass('alert-danger');
  $('#ajax_account_a').removeClass('alert-warning');
  $('#ajax_account_a').addClass('alert-warning');
  $("#ajax_account_a").html('<h4>Procesando información</h4>'+ process_icon +' Estamos procesando tus datos por favor espere...');
  $('#ajax_account_a').removeClass('hide');
  $(':input').prop( "disabled", true );

  if ($("#pass_pd").val() != '') {
    $.ajax({
      type : "POST",
      url : "api/account",
      data : data,
      success : function(json) {
        var obj = jQuery.parseJSON(json);
        if(obj.success == 1) {
          $('#ajax_account_a').html('<h4>Exito</h4>' + success_icon + obj.message);
          $("#ajax_account_a").removeClass('alert-warning');
          $("#ajax_account_a").addClass('alert-success');
          nombre.val(obj.new[0]);
          apell.val(obj.new[1]);
          correo.val(obj.new[2]);
          vNombre = nombre.val();
          vApe = apell.val();
          vCoreo = correo.val();
          $(':input').prop( "disabled", false );
          setTimeout(function(){ $("#ajax_account_a").addClass('hide'); }, 3000);
          $("#pass_pd").val('');
        } else {
          $('#ajax_account_a').html(error_icon  + obj.message);
          $("#ajax_account_a").removeClass('alert-warning');
          $("#ajax_account_a").addClass('alert-danger');
          $(':input').prop( "disabled", false );
        }
      },
      error : function() {
        window.alert("#error")
        $('#ajax_account_a').removeClass('alert-danger');
        $('#ajax_account_a').removeClass('alert-warning');
        $('#ajax_account_a').addClass('alert-danger');
        $("#ajax_account_a").html(error_icon  + '<h4>Error interno:</h4> No se pudo completar su petición.');
        $('#ajax_account_a').removeClass('hide');
        $(':input').prop( "disabled", false );
      }
    });

  } else {
    $('#ajax_account_a').removeClass('alert-danger');
    $('#ajax_account_a').removeClass('alert-warning');
    $('#ajax_account_a').addClass('alert-danger');
    $("#ajax_account_a").html(error_icon  + 'Debe ingresar su contraseña');
    $('#ajax_account_a').removeClass('hide');
    $(':input').prop( "disabled", false );
  }
});


$('#passwords').click(function (){
  datab = $('#account_form_b').serialize();
$('#ajax_account_b').removeClass('alert-danger');
$('#ajax_account_b').removeClass('alert-warning');
$('#ajax_account_b').addClass('alert-warning');
$("#ajax_account_b").html('<h4>Procesando información</h4>'+ process_icon +' Estamos procesando tus datos por favor espere...');
$('#ajax_account_b').removeClass('hide');
$(':input').prop( "disabled", true );

if ($("#pass_p").val() != '') {
  $.ajax({
    type : "POST",
    url : "api/account",
    data : datab,
    success : function(json) {
      var obj = jQuery.parseJSON(json);
      if(obj.success == 1) {
        $('#ajax_account_b').html('<h4>Exito</h4>' + success_icon + obj.message);
        $("#ajax_account_b").removeClass('alert-warning');
        $("#ajax_account_b").addClass('alert-success');
        $(':input').prop( "disabled", false );
        setTimeout(function(){ $("#ajax_account_b").addClass('hide'); }, 3000);
        $("#pass_p").val('');
        $("#np").val('');
        $("#np_c").val('');
      } else {
        $('#ajax_account_b').html(error_icon  + obj.message);
        $("#ajax_account_b").removeClass('alert-warning');
        $("#ajax_account_b").addClass('alert-danger');
        $(':input').prop( "disabled", false );
      }
    },
    error : function() {
      $('#ajax_account_b').removeClass('alert-danger');
      $('#ajax_account_b').removeClass('alert-warning');
      $('#ajax_account_b').addClass('alert-danger');
      $("#ajax_account_b").html(error_icon  + '<h4>Error interno:</h4> No se pudo completar su petición.');
      $('#ajax_account_b').removeClass('hide');
      $(':input').prop( "disabled", false );
    }
  });
} else {
  $('#ajax_account_b').removeClass('alert-danger');
  $('#ajax_account_b').removeClass('alert-warning');
  $('#ajax_account_b').addClass('alert-danger');
  $("#ajax_account_b").html(error_icon  + 'Debe ingresar su contraseña');
  $('#ajax_account_b').removeClass('hide');
  $(':input').prop( "disabled", false );
}
});


$('#direcc').click( function () {
datac = $('#account_form_c').serialize();
$('#ajax_account_c').removeClass('alert-danger');
$('#ajax_account_c').removeClass('alert-warning');
$('#ajax_account_c').addClass('alert-warning');
$("#ajax_account_c").html('<h4>Procesando información</h4>'+ process_icon +' Estamos procesando tus datos por favor espere...');
$('#ajax_account_c').removeClass('hide');
$(':input').prop( "disabled", true );

if ($("#pass_").val() != '') {
  $.ajax({
    type : "POST",
    url : "api/account",
    data : datac,
    success : function(json) {
      var obj = jQuery.parseJSON(json);
      if(obj.success == 1) {
        $('#ajax_account_c').html('<h4>Exito</h4>' + success_icon + obj.message);
        $("#ajax_account_c").removeClass('alert-warning');
        $("#ajax_account_c").addClass('alert-success');
        $(':input').prop( "disabled", false );
        setTimeout(function(){
          location.reload();
        },500);
      } else {
        $('#ajax_account_c').html(error_icon  + obj.message);
        $("#ajax_account_c").removeClass('alert-warning');
        $("#ajax_account_c").addClass('alert-danger');
        $(':input').prop( "disabled", false );
      }
    },
    error : function() {
      $('#ajax_account_c').removeClass('alert-danger');
      $('#ajax_account_c').removeClass('alert-warning');
      $('#ajax_account_c').addClass('alert-danger');
      $("#ajax_account_c").html(error_icon  + '<h4>Error interno:</h4> No se pudo completar su petición.');
      $('#ajax_account_c').removeClass('hide');
      $(':input').prop( "disabled", false );
    }
  });

} else {
  $('#ajax_account_c').removeClass('alert-danger');
  $('#ajax_account_c').removeClass('alert-warning');
  $('#ajax_account_c').addClass('alert-danger');
  $("#ajax_account_c").html(error_icon  + 'Debe ingresar su contraseña');
  $('#ajax_account_c').removeClass('hide');
  $(':input').prop( "disabled", false );
}
});
