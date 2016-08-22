$('#search').click(function(){

  var error_icon = '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ',
      success_icon = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ',
      process_icon = '<span class="fa fa-spinner fa-spin" aria-hidden="true"></span> ';

  $('#ajax_search').removeClass('alert-danger');
  $('#ajax_search').removeClass('alert-warning');
  $('#ajax_search').addClass('alert-warning');
  $("#ajax_search").html(process_icon  + 'Procesando por favor espere...');
  $('#ajax_search').removeClass('hide');

  $.ajax({
    type : "POST",
    url : "api/search",
    data : $('#search_form').serialize(),
    success : function(json) {
      var obj = jQuery.parseJSON(json);
      if(obj.success == 1) {
        $('#ajax_search').html(success_icon + obj.message);
        $("#ajax_search").removeClass('alert-warning');
        $("#ajax_search").addClass('alert-success');
        setTimeout(function(){
          location.reload();
        },1000);
      } else {
        $('#ajax_search').html(error_icon  + obj.message);
        $("#ajax_search").removeClass('alert-warning');
        $("#ajax_search").addClass('alert-danger');
      }
    },
    error : function() {
      window.alert('#search ERORR');
    }
  });
});
