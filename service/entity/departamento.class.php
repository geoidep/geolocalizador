<?php
require_once("database.class.php");
class Departamento
{
    private $con;
    public function __construct()
    {
        $this->con = new Database();
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getDepartamentos()
    {
        try{
            $query = $this->con->prepare('SELECT coddep, nombdep FROM fn_departamento_listar() as (coddep CHAR(2), nombdep VARCHAR(100));');
            $query->execute();
            $this->con->close_con();

            return $query->fetchAll(PDO::FETCH_ASSOC);

        } catch(PDOException $e) {
            error_log("QRY: ".$e->getMessage(), 0);
        }
    }
}