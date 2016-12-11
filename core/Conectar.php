<?php
class Conectar{
    private $driver;
    private $host, $user, $pass, $database, $charset, $port;
  
    public function __construct() {
        $db_cfg = require_once 'config/database.php';
        $this->driver=$db_cfg["driver"];
        $this->host=$db_cfg["host"];
        $this->user=$db_cfg["user"];
        $this->pass=$db_cfg["pass"];
        $this->database=$db_cfg["database"];
        $this->charset=$db_cfg["charset"];
        $this->port=$db_cfg["port"];
    }
    
    public function conexion(){
        
        if($this->driver=="pgsql" || $this->driver==null){
       
        	//$con = pg_connect("host=localhost port=5432 dbname=ad_capremci user=postgres password=.Romina.2012 ");
        	$con = pg_connect("host=186.4.241.148 port=5433 dbname=ad_bev user=postgres password=.Romina.2012 ");
        	if(!$con){
        		echo "No se puedo Conectar a la Base";
        		exit();
        	} else {
        		
        	}
       
        }
        
        return $con;
	
    }
    
    public function startFluent(){
        require_once "FluentPDO/FluentPDO.php";
        
        if($this->driver=="pgsql" || $this->driver==null){
        	
        	try
        	{
        		//$pdo = new PDO('pgsql:host=localhost;port=5432;dbname=ad_capremci', 'postgres', '.Romina.2012' );
        		$pdo = new PDO('pgsql:host=186.4.241.148;port=5433;dbname=ad_bev', 'postgres', '.Romina.2012' );
            
         
            	$fpdo = new FluentPDO($pdo);
            	
            }
            
            
            catch(Exception $err)
            {
            	echo "PDO No se puedo Conectar a la Base";
            	exit();
            }
        }
        
        return $fpdo;
    }
}
?>
