$('#wishlist').click(function(){

  var error_icon = '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ',
      success_icon = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ',
      process_icon = '<span class="fa fa-spinner fa-spin" aria-hidden="true"></span> ';

  $('#ajax_wishlist').removeClass('alert-danger');
  $('#ajax_wishlist').removeClass('alert-warning');
  $('#ajax_wishlist').addClass('alert-warning');
  $("#ajax_wishlist").html(process_icon  + 'Procesando por favor espere...');
  $('#ajax_wishlist').removeClass('hide');

  $.ajax({
    type : "POST",
    url : "api/wishlist",
    data : $('#wishlist_form').serialize(),
    success : function(json) {
      var obj = jQuery.parseJSON(json);
      if(obj.success == 1) {
        $('#ajax_wishlist').html(success_icon + obj.message);
        $("#ajax_wishlist").removeClass('alert-warning');
        $("#ajax_wishlist").addClass('alert-success');
        setTimeout(function(){
          location.reload();
        },1000);
      } else {
        $('#ajax_wishlist').html(error_icon  + obj.message);
        $("#ajax_wishlist").removeClass('alert-warning');
        $("#ajax_wishlist").addClass('alert-danger');
      }
    },
    error : function() {
      window.alert('#wishlist ERORR');
    }
  });
});
