<?php
class Database extends PDO
{
    //nombre base de datos
    private $dbname = "******";
    //nombre servidor
    private $host   = "******";
    //nombre usuarios base de datos
    private $user = "******";
    //password usuario
    private $pass   = "******";
    //puerto postgreSql
    private $port   = 5432;

    private $dbh;
    //creamos la conexión a la base de datos
    public function __construct()
    {
        try {
            $this->dbh = parent::__construct("pgsql:host=$this->host;port=$this->port;dbname=$this->dbname;user=$this->user;password=$this->pass");
        } catch(PDOException $e) {
             error_log("QRY: ".$e->getMessage(), 0);
        }
    }

    //función para cerrar una conexión pdo
    public function close_con()
    {
        $this->dbh = null;
    }
}