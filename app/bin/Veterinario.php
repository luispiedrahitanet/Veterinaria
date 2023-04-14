<?php

include('Conexion.php');

class Usuario{

    public function __construct(){
        $this->conexion = (new Conexion())->conectar();
    }

    function get_veterinario(){
        $registros = $this->conexion->prepare("SELECT veterinario.ced_veterinario,veterinario.usu_nombre, veterinario.usu_apellido,veterinario.usu_celular, veterinario.usu_email, veterinario.usu_direccion, ciudad.ciu_ciudad_depto, veterinario.usu_tipo FROM veterinario INNER JOIN ciudad on ciudad.cod_ciudad_depto = veterinario.usu_cod_ciudad_depto");
        $registros->execute();
        $filas = $registros->fetchAll();

        return $filas;
    }


    
}