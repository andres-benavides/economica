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
    <script type="text/javascript" src="js/libs/prettify.js"></script>
    
    <link rel="stylesheet" href="css/style.css" />
    
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
          <form class="form-horizontal" id="frm">
            <div class="form-group">
              <label class="col-sm-2 control-label prb">Nombre</label>
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
              <label  class="col-sm-2 control-label">Plazo</label>
              <div class="col-sm-7">
                <select class="form-control" id="plazo" name="plazo" ></select>
              </div>
            </div>
            <div class="form-group" id="selectAmor" style="display: none">
              <label  class="col-sm-2 control-label">Amortizacion</label>
              <div class="col-sm-7">
                <select class="form-control" id="amortizacion" name="amortizacion" ></select>
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
              <label  class="col-sm-2 control-label">Periodico Vencido</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="pv" name="pv" >
              </div>
            </div>
          </form>
          <div>
            <button class="btn btn-success" id="calcular">Calcular</button>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <table class="table" id="tabla">
            <thead>
              <tr>
                <th>cuota</th>
                <th>fecha</th>
                <th>Saldo Capital</th>
                <th>Amortizacion</th>
                <th>Intereses</th>
                <th id="cuoFija" style="display: none">Cuota Fija</th>
                <th>Seguro de vida</th>
                <th>Flujo de caja</th>
              </tr>
            </thead>
            <tbody id="datosTabla">
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>
