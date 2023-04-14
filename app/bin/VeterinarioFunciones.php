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



// ------------------- CONSULTAR PERFILES ------------------------\\
if ( $_POST['funcion'] == "perfiles" ) {
    $miPerfil = $_POST['valPerfil'];

    $arrayPerfiles[] = "ADMINISTRADOR";
    $arrayPerfiles[] = "VETERINARIO";
    $arrayPerfiles[] = "AUXILIAR";

    $listaPerfiles = "";
    foreach ($arrayPerfiles as $perfil) {
        if( $perfil == $miPerfil ){
            $listaPerfiles .= "<option value='" . $perfil . "' selected>" . $perfil . "</option>";
        } else {
            $listaPerfiles .= "<option value='" . $perfil . "'>" . $perfil . "</option>";
        }
    }
    
    echo $listaPerfiles;

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
    $perfil = $_POST['perfil'];
    $contrasena = $_POST['contrasena'];

    $sql = "INSERT INTO veterinario (ced_veterinario,usu_nombre,usu_apellido,usu_celular,usu_email,usu_direccion,usu_cod_ciudad_depto,usu_tipo,usu_constrasena) VALUES ('$cedula','$nombres','$apellidos','$celular','$email','$direccion','$ciudad','$perfil','$contrasena')";
    $registros = $conexion->prepare($sql);
    $registros->execute();
    
    // echo $sql;
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
    $perfil = $_POST['perfil'];
    $contrasena = $_POST['contrasena'];

    if ( empty($contrasena) ){
        $sql = "UPDATE veterinario SET usu_nombre='$nombres', usu_apellido='$apellidos', usu_celular='$celular', usu_email='$email', usu_direccion='$direccion', usu_cod_ciudad_depto='$ciudad', usu_tipo='$perfil' WHERE ced_veterinario='$cedula'";
    } else {
        $sql = "UPDATE veterinario SET usu_nombre='$nombres', usu_apellido='$apellidos', usu_celular='$celular', usu_email='$email', usu_direccion='$direccion', usu_cod_ciudad_depto='$ciudad', usu_tipo='$perfil', usu_constrasena='$contrasena' WHERE ced_veterinario='$cedula'";
    }

    $registros = $conexion->prepare($sql);
    $registros->execute();
    
    // echo $sql;
}


// ------------------- ELIMINAR USUARIO ------------------------\\
if ( $_POST['funcion'] == "eliminar" ) {
    $cedula = $_POST['cedula'];

    $registros = $conexion->prepare("DELETE FROM veterinario WHERE ced_veterinario='$cedula'");
    $registros->execute();
   
    echo "Usuario eliminado correctamente";
}

// ------------------- CONSULTAR USUARIOS ------------------------\\
if ( $_POST['funcion'] == "consultarUsuario" ) {
    $miUsuario = trim($_POST['miUsuario']);

    $registros = $conexion->prepare("SELECT ced_veterinario,usu_nombre,usu_apellido,usu_celular,usu_email,usu_direccion,usu_cod_ciudad_depto,usu_activo,usu_tipo,usu_fecha FROM veterinario WHERE ced_veterinario = '$miUsuario' limit 1");
    $registros->execute();
    $cedUsuario = $registros->fetch(PDO::FETCH_ASSOC);

    $respuesta = json_encode($cedUsuario);
    echo $respuesta;
}


// ------------------- CONSULTAR VARIOS USUARIOS ------------------------\\
if ( $_POST['funcion'] == "consVariosUsuarios" ) {
    $perfil = ( isset($_POST['perfil']) ? $_POST['perfil'] : '*' );

    $registros = $conexion->prepare("SELECT veterinario.ced_veterinario,veterinario.usu_nombre, veterinario.usu_apellido,veterinario.usu_celular, veterinario.usu_email, veterinario.usu_direccion, ciudad.ciu_ciudad_depto, veterinario.usu_tipo FROM veterinario
         INNER JOIN ciudad on ciudad.cod_ciudad_depto = veterinario.usu_cod_ciudad_depto 
    WHERE veterinario.usu_tipo = '$perfil'");

    $registros->execute();
    $cedUsuario = $registros->fetchAll();

    $respuesta = json_encode($cedUsuario);
    echo $respuesta;
}