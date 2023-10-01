<?php
require_once('Civilizacion.php');
require_once('Mina.php');
require_once('Rey.php');
require_once('Aldeano.php');


class Mina {
    public $tipo;
    public $items;
    public $aldeanos = array();

    function __construct($tipo = "ORO", $items = 500) {
        $this->tipo = $tipo;
        $this->items = $items;
    }

    function agregarAldeano($aldeano) {
        array_push($this->aldeanos, $aldeano);
    }

    function getaldeanos() {
        return $this->aldeanos;
    }

    function getItems() {
        return $this->items;
    }

    function setitems($items) {
        $this->items = $items;
    }

    function getTipo() {
        return $this->tipo;
    }
    
}

