<?php
if (isset($_POST['codigo']))
    $codigo=$_POST['codigo'];
else
    $codigo="1501";

header("Content-type: application/json");
require_once("../entity/zoom.class.php");

$zoom=new Zoom();
$zooms=$zoom->getZoom($codigo);
$data = array();

foreach($zooms as $zoom)
    $data [] = array("x"=>$zoom['x'], "y"=>$zoom['y'], "zoom"=>$zoom['zoom']);

echo json_encode(array("ZOOM"=> $data),JSON_UNESCAPED_UNICODE);
?>