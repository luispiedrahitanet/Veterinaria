<?php

if ( !empty($_POST["nombre"]) && !empty($_POST["email"]) && !empty($_POST["telefono"]) && !empty($_POST["mensaje"]) ){
    
    // $nombre = htmlspecialchars($_POST["nombre"]);
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $telefono = $_POST["telefono"];
    $mensaje = $_POST["mensaje"];
    $asunto = "Mensaje desde la página de Contacto";

    $mailTo = "";
    $headers = "De: " . $email;
    $txt = "Ha recibido un mensade de la página de contacto de " . $nombre . "\n\n" . $mensaje;

    mail($mailTo, $asunto, $txt, $headers);

    echo 'enviado';

} else {
    echo 'fallido';
}
