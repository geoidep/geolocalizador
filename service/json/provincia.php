<?php
if (isset($_POST["coddep"]))
    $coddep=$_POST['coddep'];
else
    $coddep="15";

header("Content-type: application/json");
require_once("../entity/provincia.class.php");

$provincia=new Provincia();
$provincias=$provincia->getProvincias($coddep);
$data = array();

foreach($provincias as $provincia)
    $data [] = array("codigo"=>$provincia['codpro'], "valor"=>$provincia['nombpro']);

echo json_encode(array("LISTA"=> $data),JSON_UNESCAPED_UNICODE);
?>