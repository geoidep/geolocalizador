<?php
if (isset($_POST['codpro']))
    $codpro=$_POST['codpro'];
else
    $codpro="1501";

header("Content-type: application/json");
require_once("../entity/distrito.class.php");

$distrito=new Distrito();
$distritos=$distrito->getDistritos($codpro);
$data = array();

foreach($distritos as $distrito)
    $data [] = array("codigo"=>$distrito['ubigeo'], "valor"=>($distrito['nombdis']));

echo json_encode(array("LISTA"=> $data),JSON_UNESCAPED_UNICODE);
?>