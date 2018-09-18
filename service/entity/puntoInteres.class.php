<?php
require_once("database.class.php");
class PuntoInteres
{
    private $con;
    public function __construct()
    {
        $this->con = new Database();
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getPuntoInteres($codigo)
    {
        try{
            $query = $this->con->prepare("SELECT nombpunto, x, y FROM fn_puntointeres_consultar('$codigo') as (nombpunto VARCHAR, x FLOAT, y FLOAT);");
            $query->execute();
            $this->con->close_con();

            return $query->fetchAll(PDO::FETCH_ASSOC);

        } catch(PDOException $e) {
            error_log("QRY: ".$e->getMessage(), 0);
        }
    }
}