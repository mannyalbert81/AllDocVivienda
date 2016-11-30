<div class="container" style="margin-top: 20px; " >
<div class="row">

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
     
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        
        <!--  <li class="active"><a href="index.php?controller=Usuarios&action=loguear"><span class="glyphicon glyphicon-home" ><?php echo " Inicio" ;?></span> <span class="sr-only">(current)</span></a></li>
        -->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-modal-window" ><?php echo " Administración" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
        	<li><a href="index.php?controller=Usuarios&action=index">Usuarios</a>
		    </li>
			<li><a href="index.php?controller=Roles&action=index">Roles de Usuario</a>
			</li>
			<li><a href="index.php?controller=PermisosRoles&action=index">Permisos Roles</a>
			</li>
		    <li><a href="index.php?controller=RegistroCartonDocumentos&action=index">Registro de Cartones</a>
			</li>
		
	          
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-file" ><?php echo " Gestión Documental" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
          <li><a href="index.php?controller=Categorias&action=index">Categorias</a>
		    </li>
			<li><a href="index.php?controller=SubCategorias&action=index">Subcategorias</a>
			</li>
			<li><a href="index.php?controller=TiposDocumentos&action=index">Tipos de Documentos</a>
			</li>
			<li><a href="index.php?controller=CartonDocumentos&action=index">Cartones de Documentos</a>
			</li>
			<li><a href="index.php?controller=ClienteProveedor&action=index">Clientes / Proveedores</a>
			</li>
			<li><a href="index.php?controller=Soat&action=index">SOAT</a>
			</li>
			<li role="separator" class="divider"></li>
			<li><a href="index.php?controller=Documentos&action=index">Busqueda de Documentos</a>
			</li>
			<li><a href="index.php?controller=DocumentosClienteProveedor&action=index">Busqueda Categorias + Cliente / Proveedor</a>
			</li>
			<li><a href="index.php?controller=DocumentosTipoDocumentos&action=index">Busqueda Categorias + Tipo Documentos</a>
			</li>
	        <li><a href="index.php?controller=DocumentosCartonDocumentos&action=index">Busqueda Categorias + Carton Documentos</a>
			</li>
			<li><a href="index.php?controller=DocumentosNumeroCredito&action=index">Busqueda Categorias + Numero de Credito</a>
			</li>
			
			
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-print	" ><?php echo " Informes" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
        	<li><a href="index.php?controller=Categorias&action=ReporteTotal" target="blank">Documentos por Categorías</a>
			</li>
			<li><a href="index.php?controller=SubCategorias&action=ReporteTotal" target="blank">Documentos por SubCategorías</a>
			</li>
			<li><a href="index.php?controller=Documentos&action=BuscaxCarton" >Documentos por Cartón</a>
			</li>
			<li role="separator" class="divider"></li>
			
			<li><a href="index.php?controller=CartonDocumentos&action=ReporteTotal" >Listado de Cartones Registrados</a>
			</li>
			
	        <li role="separator" class="divider"></li>
           <li><a href="index.php?controller=ErroresImportacion&action=index" target="blank">Errores de Importación</a>
		    </li>
		
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-modal-window" ><?php echo " Utilitarios" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="index.php?controller=CartonImpreso&action=index">Impresión de Etiqueta de Cartón</a>
			</li>
			<li><a href="index.php?controller=Documentos&action=ActualizarDocumentos">Actualizar Documentos</a>
			</li>
		  </ul>
        </li>
      </ul>
     
     
       <form class="navbar-form" role="search" action="<?php echo $helper->url("Documentos","Buscador");?>"  method="post" >
  		
  		    <div class="row">
		    <div class="col-xs-2 col-md-2">
		    <div class="form-group">
                                <input type="text" class="form-control" id="criterio_busqueda" name="contenido_busqueda" value=""  placeholder="texto a buscar">
            </div>
            </div>
            <div class="col-xs-2 col-md-2">
            <div class="form-group">
                                 
                                  <select name="criterio_busqueda" id="criterio_busqueda"  class="form-control" >
                                  <option value="0"  > --TODOS--</option>
									<option value="1"  >Ruc Cliente/Proveedor</option>
									<option value="2"  >Nombre Cliente/Proveedor</option>
									<option value="3"  >Número Carton</option>
									<option value="4"  >Número Credito</option>
									<option value="7"  >Tipo de Documento</option>
                                  </select> 
                                  
            </div>
		    </div>
		    <div class="col-xs-2 col-md-1" style="margin-left: 40px">
		    <button type="submit"  name="btn_buscar" class="btn btn-default"><span class="glyphicon glyphicon-search" ></span></button>
            </div>
			</div> 
  		
  		
  		
  		
		
        </form>
     
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
  
</nav>
       
        
</div>
</div>