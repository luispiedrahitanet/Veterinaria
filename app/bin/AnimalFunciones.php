<?php

include('Conexion.php');
$conexion = (new Conexion())->conectar();


// ------------------- CONSULTAR RAZAS ------------------------\\
if ( $_POST['funcion'] == "raza" ) {

    $registros = $conexion->prepare("SELECT * FROM raza ORDER BY raza_raza");
    $registros->execute();
    $razas = $registros->fetchAll();

    $listaRazas = json_encode($razas);
    echo $listaRazas;
}


// ------------------- CONSULTAR GENEROS ------------------------\\
if ( $_POST['funcion'] == "genero" ) {

    $registros = $conexion->prepare("SELECT * FROM genero ORDER BY gene_genero");
    $registros->execute();
    $generos = $registros->fetchAll();

    $listaGeneros = json_encode($generos);
    echo $listaGeneros;
}


// ------------------- CONSULTAR DUEÑO ------------------------\\
if ( $_POST['funcion'] == "consultarDueno" ) {
    $miDueno = trim($_POST['miDueno']);

    $registros = $conexion->prepare("SELECT cli_nombres, cli_apellidos FROM cliente WHERE ced_cliente = '$miDueno' limit 1");
    $registros->execute();
    $dueno = $registros->fetch(PDO::FETCH_ASSOC);

    $respuesta = json_encode($dueno);
    echo $respuesta;
}


// ------------------- CONSULTAR ANIMAL ------------------------\\
if ( $_POST['funcion'] == "consultarAnimal" ) {
    $miAnimal = trim($_POST['miAnimal']);

    $registros = $conexion->prepare("SELECT * FROM animal WHERE cod_animal = '$miAnimal' limit 1");
    $registros->execute();
    $codAnimal = $registros->fetch(PDO::FETCH_ASSOC);

    $respuesta = json_encode($codAnimal);
    echo $respuesta;
}


// ------------------- CONSULTAR VARIOS ANIMALES ------------------------\\
if ( $_POST['funcion'] == "consAnimalDueno" ) {
    $miUsuario = trim($_POST['miUsuario']);
    
    $registros = $conexion->prepare("SELECT 
    animal.anim_ced_cli, animal.cod_animal, animal.anim_nombre, animal.anim_fech_nacido, raza.raza_raza, genero.gene_genero, animal.anim_fech_ingreso
    FROM animal 
        INNER JOIN raza ON (animal.anim_cod_raza=raza.cod_raza)
        INNER JOIN genero ON (animal.anim_cod_genero=genero.cod_genero)
    WHERE anim_ced_cli = '$miUsuario'");

    $registros->execute();
    $codAnimal = $registros->fetchAll();

    $respuesta = json_encode($codAnimal);
    echo $respuesta;
}



// ------------------- INSERTAR NUEVOS ------------------------\\
if ( $_POST['funcion'] == "nuevoAnimal" ) {
    $cedDueno   = $_POST['cedDueno'];
    $codAnimal   = strtoupper($_POST['codAnimal']);
    $nomAnimal  = strtoupper($_POST['nomAnimal']);
    $fNacimiento= $_POST['fNacimiento'];
    $raza       = $_POST['raza'];
    $genero     = $_POST['genero'];

    $sql = "INSERT INTO animal (anim_ced_cli,cod_animal,anim_nombre,anim_fech_nacido,anim_cod_raza,anim_cod_genero) VALUES ('$cedDueno', '$codAnimal', '$nomAnimal', '$fNacimiento', '$raza', '$genero')";
    $registros = $conexion->prepare($sql);
    $registros->execute();
    
    // echo $sql;
}


// ------------------- EDITAR ANIMALES ------------------------\\
if ( $_POST['funcion'] == "editarAnimal" ) {
    
    $cedDueno   = $_POST['cedDueno'];
    $codAnimal   = strtoupper($_POST['codAnimal']);
    $nomAnimal  = strtoupper($_POST['nomAnimal']);
    $fNacimiento= $_POST['fNacimiento'];
    $raza       = $_POST['raza'];
    $genero     = $_POST['genero'];

    $sql = "UPDATE animal SET anim_nombre='$nomAnimal', anim_fech_nacido='$fNacimiento', anim_cod_raza='$raza', anim_cod_genero='$genero' WHERE anim_ced_cli='$cedDueno' AND cod_animal='$codAnimal'";

    $registros = $conexion->prepare($sql);
    $registros->execute();
    
    // echo $sql;
}


// ------------------- ELIMINAR ANIMAL ------------------------\\
if ( $_POST['funcion'] == "eliminar" ) {
    $codAnimal = $_POST['codAnimal'];

    $registros = $conexion->prepare("DELETE FROM animal WHERE cod_animal='$codAnimal'");
    $registros->execute();
   
    echo "Animal eliminado correctamente";
}