<?php
require_once("database.class.php");
class Distrito
{
    private $con;
    public function __construct()
    {
        $this->con = new Database();
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getDistritos($codpro)
    {
        try{
            $query = $this->con->prepare("SELECT ubigeo, nombdis FROM fn_distrito_listar('$codpro') as (ubigeo CHAR(6), nombdis VARCHAR(40));");
            $query->execute();
            $this->con->close_con();

            return $query->fetchAll(PDO::FETCH_ASSOC);

        } catch(PDOException $e) {
            error_log("QRY: ".$e->getMessage(), 0);
        }
    }
}