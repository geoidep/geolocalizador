<?php
if (isset($_POST['codigo']))
    $codigo=$_POST['codigo'];
else
    $codigo="1501";

header("Content-type: application/json");
require_once("../entity/puntoInteres.class.php");

$puntoInteres=new PuntoInteres();
$puntoIntereses=$puntoInteres->getPuntoInteres($codigo);
$LISTA['PUNTOS'] = array(
                            "type" => "FeatureCollection",
                            "name" => "puntos",
                            "crs" => array(
                                            "type" => "name",
                                            "properties" => array("name" => "urn:ogc:def:crs:OGC:1.3:CRS84")
                                            ),
                            "features" => array()
                            );

foreach($puntoIntereses as $puntoInteres)
    array_push($LISTA['PUNTOS']['features'], array('type' => 'Feature',
                                                    'properties' => array('nombPunto' => $puntoInteres['nombpunto']),
                                                    'geometry'   => array('type'        => 'Point',
                                                                          'coordinates' => array($puntoInteres['x'],$puntoInteres['y'])
                                                                        )));
    
echo json_encode($LISTA,JSON_UNESCAPED_UNICODE);
?>