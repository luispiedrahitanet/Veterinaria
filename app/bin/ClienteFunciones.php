<?php

include('Conexion.php');
$conexion = (new Conexion())->conectar();


// ------------------- CONSULTAR CIUDADES ------------------------\\
if ( $_POST['funcion'] == "ciudades" ) {


    $registros = $conexion->prepare("SELECT * FROM ciudad ORDER BY ciu_ciudad_depto");
    $registros->execute();
    $ciudades = $registros->fetchAll();

    $listaCiudades = json_encode($ciudades);
    echo $listaCiudades;
}



// ------------------- INSERTAR NUEVOS ------------------------\\
if ( $_POST['funcion'] == "nuevoUsuario" ) {
    $cedula = $_POST['cedula'];
    $nombres = strtoupper($_POST['nombres']);
    $apellidos = strtoupper($_POST['apellidos']);
    $celular = $_POST['celular'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    $ciudad = $_POST['ciudad'];
    $contrasena = $_POST['contrasena'];

    $sql = "INSERT INTO cliente (ced_cliente,cli_nombres,cli_apellidos,cli_celular,cli_email,cli_direccion,cli_cod_ciudad_depto,cli_contrasena) VALUES ('$cedula','$nombres','$apellidos','$celular','$email','$direccion','$ciudad','$contrasena')";
    $registros = $conexion->prepare($sql);
    $registros->execute();
    

}



// ------------------- EDITAR USUARIOS ------------------------\\
if ( $_POST['funcion'] == "editarUsuario" ) {

    $cedula = $_POST['cedula'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $celular = $_POST['celular'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    $ciudad = $_POST['ciudad'];
    $contrasena = $_POST['contrasena'];

    if ( empty($contrasena) ){
        $sql = "UPDATE cliente SET cli_nombres='$nombres', cli_apellidos='$apellidos', cli_celular='$celular', cli_email='$email', cli_direccion='$direccion', cli_cod_ciudad_depto='$ciudad' WHERE ced_cliente='$cedula'";
    } else {
        $sql = "UPDATE cliente SET cli_nombres='$nombres', cli_apellidos='$apellidos', cli_celular='$celular', cli_email='$email', cli_direccion='$direccion', cli_cod_ciudad_depto='$ciudad', cli_constrasena='$contrasena' WHERE ced_cliente='$cedula'";
    }

    $registros = $conexion->prepare($sql);
    $registros->execute();
    
    //echo $sql;
}


// ------------------- ELIMINAR USUARIO ------------------------\\
if ( $_POST['funcion'] == "eliminar" ) {
    $cedula = $_POST['cedula'];

    $registros = $conexion->prepare("DELETE FROM cliente WHERE ced_cliente='$cedula'");
    $registros->execute();
   
    echo "Usuario eliminado correctamente";
}

// ------------------- CONSULTAR USUARIO ------------------------\\
if ( $_POST['funcion'] == "consultarUsuario" ) {
    $miUsuario = trim($_POST['miUsuario']);

    $registros = $conexion->prepare("SELECT ced_cliente,cli_nombres,cli_apellidos,cli_celular,cli_email,cli_direccion,cli_cod_ciudad_depto,cli_fecha FROM cliente WHERE ced_cliente = '$miUsuario' limit 1");
    $registros->execute();
    $cedUsuario = $registros->fetch(PDO::FETCH_ASSOC);

    $respuesta = json_encode($cedUsuario);
    echo $respuesta;
}


// ------------------- CONSULTAR VARIOS USUARIOS ------------------------\\
if ( $_POST['funcion'] == "consVariosUsuarios" ) {
    $registros = $conexion->prepare("SELECT cliente.ced_cliente,cliente.cli_nombres, cliente.cli_apellidos,cliente.cli_celular, cliente.cli_email, cliente.cli_direccion, ciudad.ciu_ciudad_depto, cliente.cli_fecha FROM cliente
         INNER JOIN ciudad on ciudad.cod_ciudad_depto = cliente.cli_cod_ciudad_depto 
    ");

    $registros->execute();
    $cedUsuario = $registros->fetchAll();

    $respuesta = json_encode($cedUsuario);
    echo $respuesta;
}