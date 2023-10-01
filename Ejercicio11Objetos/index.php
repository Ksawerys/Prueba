<?php
require_once('Civilizacion.php');
require_once('Mina.php');
require_once('Rey.php');
require_once('Aldeano.php');




header("Content-Type:application/json");

$requestMethod = $_SERVER["REQUEST_METHOD"];
$paths = $_SERVER['REQUEST_URI'];

if($requestMethod=='GET'){
    $arraypath= explode('/',$paths);
    if (count($arraypath)==2){
        $consulta=$arraypath[1];
            $duracion=$consulta;
            echo json_encode(simular($duracion));
            $cod = 200;
            header('HTTP/1.1 '.$cod.' '.' OK');

    }else{
            $cod = 406;
            $mes = "FORMAT CONTENT NOT ACCEPTABLE";
            header('HTTP/1.1 '.$cod.' '.$mes);
            echo json_encode(['cod' => $cod,
            'mes' => $mes]);
        }
}elseif($requestMethod=='POST'){
    echo($_SERVER['REQUEST_METHOD']);
    echo($_SERVER['REQUEST_URI']);
    $datosRecibidos = file_get_contents("php://input");
    $data = json_decode($datosRecibidos, true);
    $civilizacion1=new Civilizacion($data[0]["nombre"],$data[0]["rey"]);
    $civilizacion2=new Civilizacion($data[1]["nombre"],$data[1]["rey"]);
    echo json_encode(simulacionReal($civilizacion1,$civilizacion2));
}else{
    $cod = 405;
    $mes = "Verbo no soportado";
    header('HTTP/1.1 '.$cod.' '.$mes);
    echo json_encode(['cod' => $cod,
                      'mes' => $mes]);
}



function simular($duracion){
    $minaDeOro=new Mina();
    $espanoles = new Civilizacion("Españoles", "Isabel");
    $bizantinos = new Civilizacion("Bizantinos", "Constantino");
    $civilizaciones=[$espanoles,$bizantinos];

for ($i=0; $i<$duracion; ++$i) {
  foreach ($minaDeOro->getaldeanos() as &$aldeano) {
      if ($minaDeOro->getitems() > 0) {
          $minaDeOro->setitems($minaDeOro->getitems() - 1);
          $aldeano->getCivilizacion()->setAlmacen($aldeano->getCivilizacion()->getAlmacen() + 1);
      }
  }

  if ($i % 2 == 0) {
      if (mt_rand(1,100) <= 40) {
          $espanol = new Aldeano(200, $espanoles);
          $minaDeOro->agregarAldeano($espanol);
      } elseif (mt_rand(1,100) <= 20) {
          $bizantino = new Aldeano(250, $bizantinos);
          $minaDeOro->agregarAldeano($bizantino);
      }
  }

  if ($i % 5 == 0 && count($minaDeOro->aldeanos) > 0) {
      foreach ($minaDeOro->aldeanos as &$aldeano) {
          if ($aldeano->getCivilizacion() != $bizantinos) {
              $aldeano->setCivilizacion($bizantinos);
              break;
          }
      }
  }
}
return $civilizaciones;
}

function simulacionReal($civilizacion1,$civilizacion2){
    $minaDeOro=new Mina();
    $espanoles = $civilizacion1;
    $bizantinos = $civilizacion2;
    $aldeanos=[];

    for ($i=0; $i<60; ++$i) {
        foreach ($minaDeOro->getaldeanos() as &$aldeano) {
            if ($minaDeOro->getitems() > 0) {
                $minaDeOro->setitems($minaDeOro->getitems() - 1);
                $aldeano->getCivilizacion()->setAlmacen($aldeano->getCivilizacion()->getAlmacen() + 1);
            }
        }
      
        if ($i % 2 == 0) {
            if (mt_rand(1,100) <= 40) {
                $espanol = new Aldeano(200, $espanoles);
                $aldeanos[]=$espanol;
                $minaDeOro->agregarAldeano($espanol);
            } elseif (mt_rand(1,100) <= 20) {
                $bizantino = new Aldeano(250, $bizantinos);
                $aldeanos[]=$bizantino;
                $minaDeOro->agregarAldeano($bizantino);
            }
        }
      
        if ($i % 5 == 0 && count($minaDeOro->aldeanos) > 0) {
            foreach ($minaDeOro->aldeanos as &$aldeano) {
                if ($aldeano->getCivilizacion() != $bizantinos) {
                    $aldeano->setCivilizacion($bizantinos);
                    break;
                }
            }
        }
      
}
return $aldeanos;
}