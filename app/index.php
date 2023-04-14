<?php
session_start();
if (isset($_SESSION["usu_id"])) {

    if (isset($_GET["vista"])) {

        if ($_GET["vista"] == "veterinarios") {
            include('header.php');
            include('view/veterinarioContenido.php');
            include('footer.php');
        }

        if ($_GET["vista"] == "clientes") {
            include('header.php');
            include('view/clienteContenido.php');
            include('footer.php');
        }

        if ($_GET["vista"] == "animales") {
            include('header.php');
            include('view/animalContenido.php');
            include('footer.php');
        }

        if ($_GET["vista"] == "citas") {
            include('header.php');
            include('view/veterinarioCitas.php');
            include('footer.php');
        }

        // if ($_GET["accion"] == "cancelar") {
        //     require_once 'Vista/html/cancelar.php';
        // }

    } else {
        include('header.php');
        include('view/veterinarioContenido.php');
        include('footer.php');
    }

    








}else{
    header('Location: ../login.php');
}
?>