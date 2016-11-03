$('a.carrito').click(function (event){

  event.preventDefault();

  var error_icon = '<span class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></span> ',
      success_icon = '<span class="fa fa-check fa-lg" aria-hidden="true"></span> ',
      process_icon = '<span class="fa fa-spinner fa-spin fa-lg" aria-hidden="true"></span> ',
      carr_o = $(this),
      link = carr_o.attr("data-product"),
      carr_i = $("[data-product='"+link+"']"),
      can = (carr_o.attr("data-cantidad") === undefined) ? carr_o.attr("data-cantidad") : 1,
      carro_inner = $("#carro_i");

  if (carr_o.attr("data-checked") == "add") {
    ca = "add";
  } else if(carr_o.attr("data-checked") == "del") {
    ca = "delete";
  } else {
    ca = "update"
  }

  carr_o.html('<i class="fa fa-spinner fa-spin"></i>');
  //bootbox.alert(link + " " + ca + " " + carr_o.attr("data-checked"));
  $.ajax({
    type : "POST",
    url : "api/carro"+ca,
    data : {'producto': carr_o.attr('data-product'), 'cantidad': can},
    success : function(json) {
      var obj = jQuery.parseJSON(json);
      if(obj.success == 1) {
        if (ca == "add") {
            carr_i.addClass("checked");
            carr_i.attr("data-checked", 'del');
            carr_i.attr("data-original-title", 'Eliminar del carro');
        } else {
          if (carr_o.attr("data-ca") == "undefined") {
            carr_i.removeClass("checked");
            carr_i.attr("data-checked", 'add');
            carr_i.attr("data-original-title", 'Añadir a carro');
          } else {
            location.reload();
          }
        }
        carr_o.html('<i class="fa fa-shopping-cart"></i>');
        carro_inner
        bootbox.alert(obj.message);
      } else {
        bootbox.dialog({
        message: obj.message + obj.new_carro,
        title: error_icon + "Error",
        buttons: {
          main: {
            label: "Ok",
            className: "btn-primary",
            callback: function() {
              carr_o.html('<i class="fa fa-shopping-cart"></i>');
            }
          }
        }
      });
      }
    },
    error : function() {
      carr_o.html('<i class="fa fa-shopping-cart"></i>');
      window.alert('#carro ERORR');
    }
  });

});
