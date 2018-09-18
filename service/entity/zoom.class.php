<?php
require_once("database.class.php");
class Zoom
{
    private $con;
    public function __construct()
    {
        $this->con = new Database();
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getZoom($codigo)
    {
        try{
            $query = $this->con->prepare("SELECT x, y, zoom FROM fn_zoom_consultar('$codigo') as (x FLOAT, y FLOAT, zoom INTEGER);");
            $query->execute();
            $this->con->close_con();

            return $query->fetchAll(PDO::FETCH_ASSOC);

        } catch(PDOException $e) {
            error_log("QRY: ".$e->getMessage(), 0);
        }
    }
}