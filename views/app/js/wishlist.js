$('a.wishlist').click(function (event){

  event.preventDefault();

  var error_icon = '<span class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></span> ',
      success_icon = '<span class="fa fa-check fa-lg" aria-hidden="true"></span> ',
      process_icon = '<span class="fa fa-spinner fa-spin fa-lg" aria-hidden="true"></span> ',
      whis_o = $(this),
      link = whis_o.attr("data-product"),
      whis_i = $("[data-product='"+link+"']");

  if (whis_o.attr("data-checked") == "favorite") {
    wh = "delete";
  } else {
    wh = "add";
  }

  whis_o.html('<i class="fa fa-spinner fa-spin"></i>');
  //bootbox.alert(link + " " + wh + " " + whis_o.attr("data-checked"));
  $.ajax({
    type : "POST",
    url : "api/wishlist"+wh,
    data : {'idp': whis_o.attr('data-product')},
    success : function(json) {
      var obj = jQuery.parseJSON(json);
      if(obj.success == 1) {
        if (wh == "add") {
            whis_i.addClass("checked");
            whis_i.attr("data-checked", 'favorite');
            whis_i.attr("data-original-title", 'Eliminar de fvoritos');
        } else {
          if (whis_o.attr("data-wh") == "undefined") {
            whis_i.removeClass("checked");
            whis_i.attr("data-checked", 'no');
            whis_i.attr("data-original-title", 'Añadir a fvoritos');
        } else {
          location.reload();
        }
        }
        whis_o.html('<i class="fa fa-heart"></i>');
        bootbox.alert(obj.message);
      } else {
        bootbox.dialog({
        message: obj.message,
        title: error_icon + "Error",
        buttons: {
          main: {
            label: "Ok",
            className: "btn-primary",
            callback: function() {
              whis_o.html('<i class="fa fa-heart"></i>');
            }
          }
        }
      });
      }
    },
    error : function() {
      whis_o.html('<i class="fa fa-heart"></i>');
      window.alert('#wishlist ERORR');
    }
  });

});
