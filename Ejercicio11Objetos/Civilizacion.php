<?php
/* The Civilizacion class represents a civilization and contains information about its name, king, and
storage capacity. */

require_once('Civilizacion.php');
require_once('Mina.php');
require_once('Rey.php');
require_once('Aldeano.php');


class Civilizacion {
    public $nombre;
    public $rey;
    public $almacen = 0;

    function __construct($nombre, $rey) {
        $this->nombre = $nombre;
        $this->rey = new Rey($rey);
    }
    function getNombre() {
        return $this->nombre;
    }

    function getRey() {
        return $this->rey;
    }

    function getAlmacen() {
        return $this->almacen;
    }

    function setAlmacen($almacen) {
        $this->almacen = $almacen;
    }
  
}

