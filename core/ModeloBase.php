<?php
class ModeloBase extends EntidadBase{
    private $table;
    private $fluent;
    Private $con;
    
    public function __construct($table) {
        $this->table=(string) $table;
        parent::__construct($table);
        
        $this->fluent=$this->getConetar()->startFluent();
        $this->con=$this->getConetar()->conexion();
    }
    
    public function fluent(){
        return $this->fluent;
    }

    public function con(){
    	return $this->con;
    }
    
    public function ejecutarSql($query){
        $query=pg_query($this->con, $query);
        if($query==true){
            if(pg_num_rows($query)>1)
            {
                while($row = pg_fetch_object($query)) {
                   $resultSet[]=$row;
                }
            }
            elseif
            (pg_num_rows($query)==1){
                if($row = pg_fetch_object($query)) {
                    $resultSet=$row;
                }
            }
            else
            {
                $resultSet=true;
            }
        }
        else
        {
            $resultSet=false;
        }
        
        return $resultSet;
    }
    


    public function enviarSql($query){
    	
    	$result=pg_query($this->con, $query);

    	
    	if($result==true)
    	{

    		$resultSet = $result;
    		
    	}
    	else
    	{
    		$resultSet=null;
    	}
    
    	
    	return $resultSet;
    }
    
    

    public function enviarFuncion($query){

    	try 
    	{
    		pg_query($this->con, $query);
    		$resultSet= "Insertado Correctamente";
    	}
    	catch (Exception $Ex)
    	{
    		$resultSet = "Error al Insertar: " + $Ex->getMessage();
    		
    	}
    
    		 
    	return $resultSet;
    }
    
    
    
    

    public function ConsultaSql($query){
    	$resultSet = array();
    	
    	$query=pg_query($this->con, $query);
    	if($query==true)
    	{
    		if(pg_num_rows($query)>1)
    		{
    			
    			if($row = $row = pg_fetch_row($query)) {
    				$resultSet=$row;
    			}
    		}
    		elseif(pg_num_rows($query)==1){
    		   
    			if($row = pg_fetch_row($query)) {
    				$resultSet=$row;
    			}
    			
    			
    		}
    		else{
    		}
    	}else{
    	
    	}
    
    	return $resultSet;
    }
    

    
    
    
    //Aqui podemos montarnos metodos para los modelos de consulta
    
    
    
    
}
?>


