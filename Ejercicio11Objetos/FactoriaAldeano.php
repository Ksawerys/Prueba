<?php
require_once('Civilizacion.php');
require_once('Mina.php');
require_once('Rey.php');
require_once('Aldeano.php');



class FactoriaAldeano {

    public static function crearAldeano($saludInicial,$civilizacion) {
        $aldeano = new Aldeano($saludInicial,$civilizacion);
        return $aldeano;
    }
}