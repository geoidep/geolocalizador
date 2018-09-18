<?php
header("Content-type: application/json");
require_once("../entity/departamento.class.php");

$departamento=new Departamento();
$departamentos=$departamento->getDepartamentos();
$data = array();

foreach($departamentos as $departamento)
    $data [] = array("codigo"=>$departamento['coddep'], "valor"=>$departamento['nombdep']);

echo json_encode(array("LISTA"=> $data),JSON_UNESCAPED_UNICODE);
?>