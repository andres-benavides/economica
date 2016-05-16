<?php

$varPos = filter_input_array(INPUT_POST);

/**
 * (PHP 4, PHP 5)<br/>
 * Calcular el seguro de vida
 * @param int $monto <p>
 * El valor del seguro de vida dependiendo del monto ingresado
 * </p>
 * @return Int El valor del seguro de vida
 */
function seguro($monto) {
  $valorSeguro = ($monto * 6) / 1000;
  return $valorSeguro;
}

$linea = $varPos['linea'];
$monto = $varPos['monto'];
$interesIp = $varPos['pv'] / 100;
$totalMeses = $varPos['totalMeses'];
$seguro = $varPos['seguro'];
if ($linea == 1) {
  $tabla = array();
  $amortizacion = 0;
  $interes = 0;
  $saldoCapital = $monto;
  $hoy = date("m/d/Y");
  $fecha = $hoy;
  for ($i = 0; $i < ($totalMeses+1); $i++) {
    $flugoDeCaja = $amortizacion+$interes+$seguro;
    $cuota['fecha']=$fecha;
    $cuota['saldoCapital']=round($saldoCapital,2);
    $cuota['amortizacion']=round($amortizacion,2);
    $cuota['interes']=round($interes,2);
    $cuota['seguro']=round($seguro,2);
    $cuota['flujoDeCaja']=round($flugoDeCaja,2);
    array_push($tabla, $cuota);
    
    $fecha = date("m/d/Y", strtotime("$fecha +1 month"));
    $amortizacion = $monto / $totalMeses;
    $interes = $saldoCapital * $interesIp;
    $saldoCapital = $saldoCapital-$amortizacion;
    $seguro = seguro($saldoCapital);
    // echo "$saldoCapital <-> $i<br>";
  }
  echo json_encode($tabla);
}
