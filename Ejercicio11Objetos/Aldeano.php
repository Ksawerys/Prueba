<?php
require_once('Civilizacion.php');
require_once('Mina.php');
require_once('Rey.php');
require_once('Aldeano.php');


class Aldeano {
    public $salud;
    public $civilizacion;

    function __construct($salud, $civilizacion) {
        $this->salud = $salud;
        $this->civilizacion = $civilizacion;
    }

    function getSalud() {
        return $this->salud;
    }

    function setSalud($salud) {
        $this->salud = $salud;
    }

    function getCivilizacion() {
        return $this->civilizacion;
    }

    function setCivilizacion($civilizacion) {
        $this->civilizacion = $civilizacion;
    }

}