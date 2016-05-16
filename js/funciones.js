function currency(value, decimals, separators) {
  decimals = decimals >= 0 ? parseInt(decimals, 0) : 2;
  separators = separators || ['.', "'", ','];
  var number = (parseFloat(value) || 0).toFixed(decimals);
  if (number.length <= (4 + decimals))
    return number.replace('.', separators[separators.length - 1]);
  var parts = number.split(/[-.]/);
  value = parts[parts.length > 1 ? parts.length - 2 : 0];
  var result = value.substr(value.length - 3, 3) + (parts.length > 1 ?
          separators[separators.length - 1] + parts[parts.length - 1] : '');
  var start = value.length - 6;
  var idx = 0;
  while (start > -3) {
    result = (start > 0 ? value.substr(start, 3) : value.substr(0, 3 + start))
            + separators[idx] + result;
    idx = (++idx) % 2;
    start -= 3;
  }
  return (parts.length == 3 ? '-' : '') + result;
}
$(document).ready(function () {
  //VARIABLE PARA SABER EL NUMERO DE PERIODOS EN UN AÑO DEPENDIENDO DEL PLAZO QUE ELIJA EL USUARIO
  var numPeriodos = 0;
  var periodosParaIp = 0;
  var dias = 0;
  var myLinea = null;
  var totalMeses = 0;

  //CLICK AL BOTON DE LA LINEA
  $(".bt-frm").click(function () {
    var divtAmor = $("#selectAmor");
    var linea = $(this).attr("data-linea");
    $("#plazo").empty();
    divtAmor.hide();
    var selectAmor = $("#amortizacion");
    selectAmor.empty();
    switch (linea) {
      case "1":
        myLinea = 1;
        $("#plazo").append("<option value=''>SELECCIONE</option>");
        for (var k = 6; k <= 36; k++) {
          $("#plazo").append("<option value='" + k + "'>" + k + " Meses</option>");
        }
        break;
      case "2":
        myLinea = 2;
        for (var k = 1; k <= 5; k++) {
          $("#plazo").append("<option value='" + (k * 12) + "'>" + k + " Años</option>");
        }
        selectAmor.append("<option value=''>SELECCIONE</option>");
        selectAmor.append("<option value='1'>Mensual</option>");
        selectAmor.append("<option value='2'>Bimestral</option>");
        selectAmor.append("<option value='3'>Trimestral</option>");
        divtAmor.show();
        break;
      case "3":
        myLinea = 3;
        for (var k = 5; k <= 10; k++) {
          $("#plazo").append("<option value='" + (k * 12) + "'>" + k + " Años</option>");
        }
        selectAmor.append("<option value=''>SELECCIONE</option>");
        selectAmor.append("<option value='3'>Trimestral</option>");
        selectAmor.append("<option value='6'>Semestral</option>");
        divtAmor.show();
        break;
    }
  });
  //ASIGNAR EL VALOR DE LOS NUMEROS DE PERIODOS SI NO SELECCIONA LINEA ESTANDAR
  $("#amortizacion").change(function () {
    var plazo = $("#plazo").val();
    var amortizacion = $(this).val();
    numPeriodos = plazo / amortizacion;
    periodosParaIp = 12 / amortizacion;
    dias = amortizacion * 30;
    console.log(numPeriodos);
  });
  //ASIGNAR EL VALOR DE LOS NUMEROS DE PERIODOS SI  SELECCIONA LINEA ESTANDAR
  var lineStd = function () {
    var esLineaEstand = $('#amortizacion option').length;
    totalMeses = $("#plazo").val();
    if (esLineaEstand <= 0) {
      var numPeriodos = $("#plazo").val();
      periodosParaIp = (numPeriodos <= 12) ? numPeriodos : 12;
      dias = 30;
      console.log(periodosParaIp);
    }
  };
  $("#plazo").on('change', lineStd);
  //Cálculo del interés efectivo anual en función del interés periódico (ip) modalidad vencido:
  var ie = function (ip, dias) {
    var inE = (Math.pow((1 + ip), (360 / dias))) - 1;
    return inE * 100;
  };
//Cálculo del interés periódico 
  var ip = function (ia, periodos) {
    var inP = ia / periodos;
    return inP;
  };
  //Cálculo del interés periódico vencido (ip) en función del interés efectivo anual:
  var ipEnFunEfAn = function (ie, dias) {
    var ipFea = (Math.pow((1 + ie), (dias / 360))) - 1;
    return ipFea;
  };
  //SI INGRESA EL EFECTIVO ANUAL
  $("#ea").keyup(function () {
    var ie = (parseFloat($(this).val())) / 100;
    var ip = ipEnFunEfAn(ie, dias) * 100;
    $("#pv").val(ip);
    $("#na").val(ip * periodosParaIp);
  });
  //SI INGRESA EL NOMINAL ANUAL
  $("#na").keyup(function () {
    var ip = ($(this).val()) / periodosParaIp;
    var iex = ie((ip / 100), dias);
    $("#pv").val(ip);
    $("#ea").val(iex);
  });
  //SI INGRESA EL PERIODICO
  $("#pv").keyup(function () {
    var ip = $(this).val();
    console.log(dias);
    var iex = ie((ip / 100), dias);
    $("#ea").val(iex);
    $("#na").val(ip * periodosParaIp);
  });

  $("#calcular").click(function () {
    //MONTO DEL PRESTAMO
    var monto = $("#monto").val();
    //CALCULAR EL SEGURO
    var seguro = (parseFloat(monto) * 6) / 1000;
    var info = $("#frm").serialize() + "&seguro=" + seguro + "&linea=" + myLinea + "&totalMeses=" + totalMeses;
    $.ajax({
      url: 'calculos.php',
      method: 'post',
      dataType: 'json',
      data: info
    }).success(function (respuesta) {
      $("#datosTabla").empty();
      var datos = "";
      console.log(respuesta);
      $.each(respuesta, function (key, value) {
        var fh = value.fecha;
        var sc = currency(value.saldoCapital);
        var amo = currency(value.amortizacion);
        var int = currency(value.interes);
        var seg = currency(value.seguro);
        var fc = currency(value.flujoDeCaja);
        datos += "<tr><td>" + key + "</td><td>" + fh + "</td><td>" + sc + "</td><td>" + amo + "</td><td>" + int + "</td><td>" + seg + "</td><td>" + fc + "</td><tr>";
      });
      $("#datosTabla").append(datos);
    });
  });

});


