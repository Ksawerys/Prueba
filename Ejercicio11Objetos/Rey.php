<?php
require_once('Civilizacion.php');
require_once('Mina.php');
require_once('Rey.php');
require_once('Aldeano.php');


class Rey {
    public $nombre;
    function __construct($nombre) {
        $this->nombre = $nombre;
    }
}
