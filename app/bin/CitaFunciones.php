<?php

include('Conexion.php');
// $conexion = (new Conexion())->conectar();
$conexion = Conexion::conectar();


// ------------------- CONSULTAR TIPO CITAS ------------------------\\
if ( $_POST['funcion'] == "tipoCita" ) {

    $registros = $conexion->prepare("SELECT * FROM  tipo_cita ORDER BY tcita_tipo");
    $registros->execute();
    $tcitas = $registros->fetchAll();

    $respuesta = json_encode($tcitas);
    echo $respuesta;
}

// ------------------- CONSULTAR TURNOS DISPONIBLES ------------------------\\
if ( $_POST['funcion'] == "turnoDisponible" ) {

    $registros = $conexion->prepare("SELECT id_turno, tur_cedveterinario, tur_fecha, TIME_FORMAT(tur_turno, '%h:%i%p') as tur_turno, tur_cod_cita FROM turno WHERE tur_fecha >= CURRENT_DATE() AND tur_cod_cita = 0");
    $registros->execute();
    $turnosDispo = $registros->fetchAll();

    $respuesta = json_encode($turnosDispo);
    echo $respuesta;
}

// ------------------- AGREGAR CITA ------------------------\\
if ( $_POST['funcion'] == "asignarCita" ) {

    $animal = $_POST['animal'];
    $tipocita = $_POST['tipocita'];
    $turno = $_POST['turno'];
    $observaciones = $_POST['observaciones'];

    $registros = $conexion->prepare("SELECT tur_cod_cita FROM turno WHERE id_turno = '$turno'");
    $registros->execute();
    $reservada = $registros->fetch(PDO::FETCH_ASSOC);

    $estado = 'OK';
    if( $reservada['tur_cod_cita'] == 1 ){
        $estado = 'Err';
    }else{
        // inserta cita
        $registros = $conexion->prepare("INSERT INTO cita (cita_cod_animal, cita_tipo_cita, cita_turno, cita_estado, cita_observaciones) VALUES ('$animal','$tipocita','$turno','RESERVADA','$observaciones')");
        $registros->execute();
        // actualiza
        $registros = $conexion->prepare("UPDATE turno SET tur_cod_cita = 1 where id_turno = '$turno'");
        $registros->execute();

        // $turnosDispo = $registros->fetchAll();
    }
    echo $estado;
}



// ------------------- CONSULTAR CITA ------------------------\\

if ( $_POST['funcion'] == "consultaCita" ) {
    $condicion = "";
    $filtro = "";

    if(isset($_POST['codCita'])){
        $condicion = $_POST['codCita'];
        $filtro = " WHERE cita.cod_cita = $condicion";
    }

    if(isset($_POST['turno'])){
        $condicion =  $_POST['turno'];
        $filtro = " WHERE turno.id_turno = " . $condicion;
    }

        $registros = $conexion->prepare("SELECT cita.cod_cita, cita.cita_cod_animal, animal.anim_nombre, turno.tur_fecha, TIME_FORMAT(turno.tur_turno, '%h:%i%p') as cita_turno, turno.tur_fecha as cita_fecha, turno.id_turno, tipo_cita.tcita_tipo, veterinario.ced_veterinario, veterinario.usu_nombre, veterinario.usu_apellido, cita.cita_estado, cita.cita_observaciones,animal.anim_ced_cli, raza.raza_raza, genero.gene_genero, cliente.cli_nombres, cliente.cli_apellidos
        FROM cita
        INNER JOIN animal ON cita.cita_cod_animal=animal.cod_animal
        INNER JOIN tipo_cita ON cita.cita_tipo_cita=tipo_cita.cod_tipo
        INNER JOIN cliente ON animal.anim_ced_cli=cliente.ced_cliente
        INNER JOIN raza ON animal.anim_cod_raza=raza.cod_raza
        INNER JOIN genero ON animal.anim_cod_genero=genero.cod_genero
        INNER JOIN turno ON cita.cita_turno=turno.id_turno
        INNER JOIN veterinario ON turno.tur_cedveterinario=veterinario.ced_veterinario " . $filtro);
        $registros->execute();
        $filas = $registros->fetchAll();

        $respuesta = json_encode($filas);
        echo $respuesta;

}



// ------------------- CONSULTAR ESTADOS ------------------------\\
if ( $_POST['funcion'] == "estadoCita" ) {

    $arrayEstado["RESERVADA"] = "RESERVADA";
    $arrayEstado["CANCELADA"] = "CANCELADA";
    $arrayEstado["NO_ASISTE"] = "NO_ASISTE";
    $arrayEstado["ATENDIDA"] = "ATENDIDA";

    $respuesta = json_encode($arrayEstado);
    echo $respuesta;

}



// ------------------- ACTUALIZAR CITA ------------------------\\
if ( $_POST['funcion'] == "editarCita" ) {
    $codCita = $_POST['codCita'];
    $estadoCita = $_POST['estadoCita'];

    // actualizando la cita
    $registros = $conexion->exec("UPDATE cita SET cita_estado = '$estadoCita' WHERE cod_cita = '$codCita'");

    // cancelar cita
    if($estadoCita == 'CANCELADA'){

        // liberando el turno
        $registros = $conexion->prepare("SELECT turno.id_turno, turno.tur_fecha, turno.tur_turno, cita.cod_cita, cita.cita_turno
        FROM turno
        INNER JOIN cita ON cita.cita_turno = turno.id_turno
        WHERE cita.cod_cita = '$codCita'");
        $registros->execute();
        $filas = $registros->fetch();
        if( $filas[1] >= date('Y-m-d') ){
            $registros = $conexion->exec("UPDATE turno SET tur_cod_cita = 0 WHERE id_turno = '$filas[0]'");
        }
    }

    //echo $registros;

}

// ------------------- ELIMINAR CITA ------------------------\\
if ( $_POST['funcion'] == "eliminarCita" ) {
    $codCita = $_POST['codCita'];

    // consoult
    $registros = $conexion->prepare("SELECT turno.id_turno
        FROM turno
        INNER JOIN cita ON cita.cita_turno = turno.id_turno
        WHERE cita.cod_cita = '$codCita'");
    $filas = $registros->fetch();
    $registros = $conexion->exec("UPDATE turno SET tur_cod_cita = 0 WHERE id_turno = '$filas[0]'");

    // eliminando la cita
    $registros = $conexion->exec("DELETE FROM cita WHERE cod_cita = '$codCita'");

    // echo $filas;

}
