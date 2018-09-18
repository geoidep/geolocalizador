<?php
require_once("database.class.php");
class Provincia
{
    private $con;
    public function __construct()
    {
        $this->con = new Database();
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getProvincias($codpro)
    {
        try{
            $query = $this->con->prepare("SELECT codpro, nombpro FROM fn_provincia_listar('$codpro') as (codpro CHAR(4), nombpro VARCHAR(100));");
            $query->execute();
            $this->con->close_con();

            return $query->fetchAll(PDO::FETCH_ASSOC);

        } catch(PDOException $e) {
            error_log("QRY: ".$e->getMessage(), 0);
        }
    }
}