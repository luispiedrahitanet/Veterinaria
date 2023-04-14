<?php

include('Conexion.php');

class Cliente{

    public function __construct(){
        $this->conexion = (new Conexion())->conectar();
    }

    function get_Cliente(){
        $registros = $this->conexion->prepare("SELECT cliente.ced_cliente,cliente.cli_nombres, cliente.cli_apellidos,cliente.cli_celular, cliente.cli_email, cliente.cli_direccion, ciudad.ciu_ciudad_depto, cliente.cli_fecha FROM cliente INNER JOIN ciudad on ciudad.cod_ciudad_depto = cliente.cli_cod_ciudad_depto");
        $registros->execute();
        $filas = $registros->fetchAll();

        return $filas;
    }


    
}