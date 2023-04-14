<?php

include('Conexion.php');




class Cita{
    


    public function __construct(){
        $this->conexion = (new Conexion())->conectar();
    }

    function get_citas($filtro = ""){
        
        $registros = $this->conexion->prepare("SELECT cita.cod_cita, cita.cita_cod_animal, animal.anim_nombre, turno.tur_fecha, TIME_FORMAT(turno.tur_turno, '%h:%i%p') as cita_turno, turno.tur_fecha as cita_fecha, turno.id_turno, tipo_cita.tcita_tipo, veterinario.ced_veterinario, veterinario.usu_nombre, veterinario.usu_apellido, cita.cita_estado, cita.cita_observaciones,animal.anim_ced_cli, raza.raza_raza, genero.gene_genero, cliente.cli_nombres, cliente.cli_apellidos
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

        return $filas;
    }



}
