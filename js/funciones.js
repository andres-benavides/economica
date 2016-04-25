$(document).ready(function () {

  //CLICK AL BOTON DE LA LINEA
  $(".bt-frm").click(function () {
    var linea = $(this).attr("data-linea");
    $("#amortizacion").empty();
    switch (linea) {
      case "1":
        for (var k=6;k<=36;k++)
        $("#amortizacion").append("<option value='" + k + "'>" + k + " Meses</option>");
        break;
      case "2":
        for (var k=1;k<=5;k++)
        $("#amortizacion").append("<option value='" + k + "'>" + k + " Años</option>");
        break;
      case "3":
        for (var k=5;k<=10;k++)
        $("#amortizacion").append("<option value='" + k + "'>" + k + " Años</option>");
        break;
    }
  });
});


