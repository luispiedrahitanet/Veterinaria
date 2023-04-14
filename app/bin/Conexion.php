<?php

class Conexion{
    public static function conectar(){

        $servidor = 'localhost';
        $usuario = 'root';
        $constrasena = '';
        $baseddatos = 'messavet';

        try{
            $conex = new PDO("mysql:host=$servidor;dbname=$baseddatos", $usuario, $constrasena);
            $conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conex;
        }catch(PDOException $e){
            die('Conexion fallida: ' . $e->getMessage());
        }
    }
}


