<?php

class GenericDao {
    /** Conexion a la Base de Datos 
     * @var \PDO */
    public $connection;
    
    function __construct() {
        $this->getConnection();
    }

    protected function getConnection(){
        try {
            $conf= App::getInstance()->config['database'];
            $this->connection = new PDO($conf['driver'] . ':host='.$conf['host']. ';port='.$conf['port'] . ';dbname='.$conf['database'].'', $conf['username'], $conf['password']); 
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->connection->exec("SET NAMES '".$conf['charset']."'");
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    
    protected function closeConnection(){
        $this->connection = NULL;
    }
}
