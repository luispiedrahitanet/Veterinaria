<?php

include('Conexion.php');

class Animal{

    public function __construct(){
        $this->conexion = (new Conexion())->conectar();
    }

    function get_animal(){
        $registros = $this->conexion->prepare("SELECT
        animal.anim_ced_cli, animal.cod_animal, animal.anim_nombre, animal.anim_fech_nacido, raza.raza_raza, genero.gene_genero, animal.anim_fech_ingreso
        FROM animal
            INNER JOIN raza ON (animal.anim_cod_raza=raza.cod_raza)
            INNER JOIN genero ON (animal.anim_cod_genero=genero.cod_genero)");
        $registros->execute();
        $filas = $registros->fetchAll();

        return $filas;
    }



}
