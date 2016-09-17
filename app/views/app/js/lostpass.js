/* #lostpass es el ID del botón que acciona este código. */
/* #ajax_lostpass es el ID del DIV que muestra resultados y proceso de carga. */
/* #lostpass_form es el ID del formulario del cual se recogen todos los datos. */

$('#lostpass').click(function(){

	var error_icon = '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ',
		success_icon = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ',
		process_icon = '<span class="fa fa-spinner fa-spin" aria-hidden="true"></span> ',
		data = $('#lostpass_form').serialize();

	$('#ajax_lostpass').removeClass('alert-danger');
	$('#ajax_lostpass').removeClass('alert-warning');
	$('#ajax_lostpass').addClass('alert-warning');
	$('#ajax_lostpass').html(process_icon  + 'Procesando, el proceso puede tardar si estás en localhost y puede tardar en llegar el email...');
	$('#ajax_lostpass').removeClass('hide');

	$.ajax({
		type : "POST",
		url : "api/lostpass",
		data : data,
		success : function(json) {
			var obj = jQuery.parseJSON(json);
			if(obj.success == 1) {
				$('#ajax_lostpass').html(success_icon + obj.message);
				$('#ajax_lostpass').removeClass('alert-warning');
				$('#ajax_lostpass').addClass('alert-success');
			} else {
				$('#ajax_lostpass').html(error_icon  + obj.message);
				$('#ajax_lostpass').removeClass('alert-warning');
				$('#ajax_lostpass').addClass('alert-danger');
			}
		},
		error : function() {
			window.alert('#lostpass ERORR');
		}
	});
});

$('#lostpass_g').click(function(){

	var error_icon = '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ',
		success_icon = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ',
		process_icon = '<span class="fa fa-spinner fa-spin" aria-hidden="true"></span> ';

	$('#ajax_lostpass').removeClass('alert-danger');
	$('#ajax_lostpass').removeClass('alert-warning');
	$('#ajax_lostpass').addClass('alert-warning');
	$('#ajax_lostpass').html(process_icon  + 'Procesando, el proceso puede tardar si estás en localhost y puede tardar en llegar el email...');
	$('#ajax_lostpass').removeClass('hide');

if ($("#pass").val() != '' && ($("#pass_c").val() == $("#pass").val())) {
	$.ajax({
		type : "POST",
		url : "api/lostpass",
		data : $('#lostpass_form').serialize(),
		success : function(json) {
			var obj = jQuery.parseJSON(json);
			if(obj.success == 1) {
				$('#ajax_lostpass').html(success_icon + obj.message);
				$('#ajax_lostpass').removeClass('alert-warning');
				$('#ajax_lostpass').addClass('alert-success');
				$(":input").prop('disabled', true);
				$("#lostpass_g").prop('disabled', true);
			} else {
				$('#ajax_lostpass').html(error_icon  + obj.message);
				$('#ajax_lostpass').removeClass('alert-warning');
				$('#ajax_lostpass').addClass('alert-danger');
			}
		},
		error : function() {
			window.alert('#lostpass ERORR');
		}
	});
} else if($("#pass").val() != $("#pass_c").val()) {
	$('#ajax_lostpass').removeClass('alert-danger');
	$('#ajax_lostpass').removeClass('alert-warning');
	$('#ajax_lostpass').addClass('alert-danger');
	$('#ajax_lostpass').html(error_icon  + 'Las contraseñas no coinciden');
	$('#ajax_lostpass').removeClass('hide');
} else {
	$('#ajax_lostpass').removeClass('alert-danger');
	$('#ajax_lostpass').removeClass('alert-warning');
	$('#ajax_lostpass').addClass('alert-danger');
	$('#ajax_lostpass').html(error_icon  + 'Debe escribir algo en el campo de contraseña');
	$('#ajax_lostpass').removeClass('hide');
}

});
