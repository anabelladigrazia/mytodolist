<?php
require_once 'config.php';

$app= App::getInstance();
$config= $app->config['database'];
$connection;
try {
    $connection = new PDO($config['driver'] . ':host='.$config['host']. ';port='.$config['port'], $config['username'], $config['password']); 
    $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);  
    $connection->exec("SET NAMES '".$config['charset']."'");
    print "Conexion Correcta";
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage();
    die();
}

$database= $config['database'];
$user= $config['username'];
$pass= $config['password'];

//CHEKEO BD
$stmt = $connection->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '".$config['database']."'");
if(!(bool)$stmt->fetchColumn()){
    //CREO BD
    try{        
        $rta= $connection->exec("CREATE DATABASE `$database`;"
            . "CREATE USER '$user'@'localhost' IDENTIFIED BY '$pass';"
            . "GRANT ALL ON `$database`.* TO '$user'@'localhost';"
            . "FLUSH PRIVILEGES;");
        if(!$rta){
            print "¡Error!: Fallo creando la base";
            die();
        }
    } catch (Exception $ex) {
        print "¡Error!: " . $e->getMessage();
        die();
    }                
}else{
    print "La base de datos ya existe";
}

try{
	$connection->query("use $database");
	$connection->beginTransaction();
	$stmt= $connection->query("SHOW TABLES");
	//VEO QUE NO EXISTAN TABLAS
	if(!(bool)$stmt->fetchColumn()){
		//IMPORTO LA ESTRUCTURA Y DATOS BASICOS
		$sql = file_get_contents(ROOT_PATH . 'database.sql');
		if($connection->exec($sql) === FALSE){
                    $connection->rollback();
                    print "¡Error!: Carga incorrecta de datos";
                    die();
		}
                print "Base cargada correctamente";
	}else{
            print "La base de datos ya se encuentra cargada";
        }
	$connection->commit();
} catch (Exception $ex) {
	$connection->rollback();
	print "¡Error!: " . $ex->getMessage();
	die();
}

print "Exito!!!";
