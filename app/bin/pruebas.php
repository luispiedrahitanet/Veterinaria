<?php

$conexion = new PDO("mysql:host=localhost;dbname=messavet", "root", "");

$codCita = '6';
$registros = $conexion->prepare("SELECT turno.tur_fecha, turno.tur_turno FROM turno WHERE turno.id_turno = '6'");
$registros->execute();
$filas = $registros->fetch();
if( $filas[0] >= date('Y-m-d') ){
    $registros = $conexion->exec("UPDATE turno SET tur_cod_cita = 0 WHERE id_turno = '$codCita'");
    echo "funciona";
}


// $resultado = $conexion->query("SELECT turno.tur_fecha, turno.tur_turno FROM turno WHERE turno.id_turno = 137");
// if(!$resultado){
//     echo "No se puderon recuperar registros: " . $conexion->errorInfo();
// }
// while ( $fila = $resultado->fetch() ) {
//     echo "{$fila[0]} {$fila[1]}";
// }