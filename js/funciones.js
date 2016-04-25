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
        $("#amortizacion").append("<option value='" + (k*12) + "'>" + k + " Años</option>");
        break;
      case "3":
        for (var k=5;k<=10;k++)
        $("#amortizacion").append("<option value='" + (k*12) + "'>" + k + " Años</option>");
        break;
    }
  });
  //Cálculo del interés efectivo anual en función del interés periódico (ip) modalidad vencido:
  var ie = function(ip,dias){
    var inE = (Math.pow((1+ip),(360/dias)))-1;
    return inE;
  };
//  Cálculo del interés periódico 
  var ip = function(ia,periodos){
    var inP = ia/periodos;
    return inP;
  };
  //Cálculo del interés periódico vencido (ip) en función del interés efectivo anual:
  var ipEnFunEfAn = function(ie,dias){
    var ipFea = (Math.pow((1+ie),(dias/360)))-1;
    return ipFea;
  };
  
  $("#ea").keyup(function (){
    var ie = parseFloat($(this).val());
    var dias =  parseFloat($("#amortizacion").val())*30;
    var ip = ipEnFunEfAn(ie,dias);
 
    $("#pv").val(ip);
  });
  
});


