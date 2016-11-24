
<?php 
  // Connect to the database
  
  $dbconn = pg_connect("host=181.39.195.34 port=5432 dbname=ad_copseguros user=postgres password=.Romina.2012 ");
  // Get the bytea data
  $result = pg_query($dbconn, "SELECT archivo_archivos_pdf FROM archivos_pdf WHERE id_documentos_legal = 1003   ");  
  
  
  if (!$result) {
  	echo "An error occurred.\n";
  	exit;
  } 
  
  if($row = pg_fetch_row($result)) // pull the first row of the result into an array(there will only be one)
  {
  	$file = $row[0];    // First bit is the data
  	
  	
  	
  
  	Header( "Content-type: PDF"); // Send the header of the approptiate file type, if it's' a image you want it to show as one :)
  	print $data; // Send the data.
  }
  
  
  
?>
