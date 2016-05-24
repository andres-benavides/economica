<?php

$varPos = filter_input_array(INPUT_POST);

/**
 * (PHP 5)<br/>
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

/**
 * (PHP 5)<br/>
 * Calcular el valor de la cuota
 * @param int $monto <p>La cantidad sobre la cual se va a calcular la cuota</p>
 * @param float $ip  <p>el interes periodico para calcular la cuota</p>
 * @param int $n     <p>La cantidad de periodos del prestamo para calcular la cuota</p>
 * 
 * @return Int El valor de la cuota
 */
function cuota($monto, $ip, $n) {
  $valorCuota = ($monto * ((pow(1 + $ip, $n)) * $ip)) / (pow(1 + $ip, $n)-(1));
  return $valorCuota;
}

$linea = $varPos['linea'];
$monto = $varPos['monto'];
$interesIp = $varPos['pv'] / 100;
$totalMeses = $varPos['totalMeses'];
$seguro = $varPos['seguro'];
$amortizacion = (isset($varPos['amortizacion']))?$varPos['amortizacion']:"";
if ($linea == 1) {
  $tabla = array();
  $amortizacion = 0;
  $interes = 0;
  $saldoCapital = $monto;
  $hoy = date("m/d/Y");
  $fecha = $hoy;
  for ($i = 0; $i < ($totalMeses + 1); $i++) {
    $flugoDeCaja = $amortizacion + $interes + $seguro;
    $cuota['fecha'] = $fecha;
    $cuota['saldoCapital'] = round($saldoCapital, 2);
    $cuota['amortizacion'] = round($amortizacion, 2);
    $cuota['interes'] = round($interes, 2);
    $cuota['seguro'] = round($seguro, 2);
    $cuota['flujoDeCaja'] = round($flugoDeCaja, 2);
    array_push($tabla, $cuota);

    $fecha = date("m/d/Y", strtotime("$fecha +1 month"));
    $amortizacion = $monto / $totalMeses;
    $interes = $saldoCapital * $interesIp;
    $saldoCapital = $saldoCapital - $amortizacion;
    $seguro = seguro($saldoCapital);
  }
  echo json_encode($tabla);
}
if ($linea == 2) {
  $tabla = array();
  $n = $totalMeses / $amortizacion;
  $mesesSum = $amortizacion;
  $valorAmort = 0;
  $interes = 0;
  $saldoCapital = $monto;
  $hoy = date("m/d/Y");
  $fecha = $hoy;
  $cuota = 0;
  for ($i = 0; $i < (($totalMeses/$amortizacion) + 1); $i++) {
    $flugoDeCaja = $valorAmort + $interes + $seguro;
    $cuotaArr['fecha'] = $fecha;
    $cuotaArr['saldoCapital'] = round($saldoCapital, 2);
    $cuotaArr['amortizacion'] = round($valorAmort, 2);
    $cuotaArr['interes'] = round($interes, 2);
    $cuotaArr['cuota'] = round($cuota, 2);
    $cuotaArr['seguro'] = round($seguro, 2);
    $cuotaArr['flujoDeCaja'] = round($flugoDeCaja, 2);
    array_push($tabla, $cuotaArr);

    $fecha = date("m/d/Y", strtotime("$fecha +$mesesSum month"));
    
    $cuota = cuota($monto, $interesIp, $n);
    $interes = $saldoCapital * $interesIp;
    
    $valorAmort = $cuota - $interes;
    
    $saldoCapital = $saldoCapital - $valorAmort;
    $seguro = seguro($saldoCapital);
  }
  echo json_encode($tabla);
}
if ($linea == 3) {
  $tabla = array();
  $n = $totalMeses / $amortizacion;
  $mesesSum = $amortizacion;
  $valorAmort = 0;
  $interes = 0;
  $saldoCapital = $monto;
  $hoy = date("m/d/Y");
  $fecha = $hoy;
  $cuota = 0;
  for ($i = 0; $i < (($totalMeses/$amortizacion) + 1); $i++) {
    $flugoDeCaja = $valorAmort + $interes + $seguro;
    $cuotaArr['fecha'] = $fecha;
    $cuotaArr['saldoCapital'] = round($saldoCapital, 2);
    $cuotaArr['amortizacion'] = round($valorAmort, 2);
    $cuotaArr['interes'] = round($interes, 2);
    $cuotaArr['cuota'] = round($cuota, 2);
    $cuotaArr['seguro'] = round($seguro, 2);
    $cuotaArr['flujoDeCaja'] = round($flugoDeCaja, 2);
    array_push($tabla, $cuotaArr);

    $fecha = date("m/d/Y", strtotime("$fecha +$mesesSum month"));
    
    $cuota = cuota($monto, $interesIp, $n);
    $interes = $saldoCapital * $interesIp;
    
    $valorAmort = $cuota - $interes;
    
    $saldoCapital = $saldoCapital - $valorAmort;
    $seguro = seguro($saldoCapital);
  }
  echo json_encode($tabla);
}