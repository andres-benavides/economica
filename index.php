<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
  <head>
    <meta charset="UTF-8">
    <title>Amortizacion</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />

    <script type="text/javascript" src="js/libs/jquery.js"></script>
    <script type="text/javascript" src="js/libs/bootstrap.min.js"></script>
    
    <!--FUNCIONES-->
    <script type="text/javascript" src="js/funciones.js"></script>
  </head>
  <body>
    <div class="containter">
      <div class="row">
        <div class="col-xs-12">
          <button type="button" data-linea="1" class="btn btn-primary bt-frm">Linea Etandar</button>
          <button type="button" data-linea="2" class="btn btn-success bt-frm">Linea Fija</button>
          <button type="button" data-linea="3" class="btn btn-info    bt-frm">Linea con periodo de gracias</button>
        </div>
      </div>
      <br />
      <br />
      <div class="row" id="linea">
        <div class="col-xs-5">
          <form class="form-horizontal">
            <div class="form-group">
              <label class="col-sm-2 control-label">Nombre</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="nombre" id="nombre" >
              </div>
            </div>
            <div class="form-group">
              <label  class="col-sm-2 control-label">Identificacion</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="identificacion" name="identificacion" >
              </div>
            </div>
            <div class="form-group">
              <label  class="col-sm-2 control-label">Monto del prestamo</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="monto" name="monto" >
              </div>
            </div>
            <div class="form-group">
              <label  class="col-sm-2 control-label">Amortizacion</label>
              <div class="col-sm-7">
                <select class="form-control" id="amortizacion" name="moamortizacionnto" ></select>
              </div>
            </div>
            <h3>Tasa de interes</h3>
            <div class="form-group">
              <label  class="col-sm-2 control-label">Efectivo anual</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="ea" name="ea" >
              </div>
            </div>
            <div class="form-group">
              <label  class="col-sm-2 control-label">Nominal anual</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="na" name="na" >
              </div>
            </div>
            <div class="form-group">
              <label  class="col-sm-2 control-label">Periodico vencido</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="pv" name="pv" >
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
