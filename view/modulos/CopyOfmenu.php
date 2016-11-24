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
      <a class="navbar-brand" href="#">Menu</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="http://186.71.172.100:4000/aDocument">Inicio <span class="sr-only">(current)</span></a></li>
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administración <span class="caret"></span></a>
          <ul class="dropdown-menu">
        	<li><a href="index.php?controller=Categorias&action=index">Usuarios</a>
		    </li>
			<li><a href="index.php?controller=Roles&action=index">Roles de Usuario</a>
			</li>
			<li><a href="index.php?controller=PermisosRoles&action=index">Permisos Roles</a>
			</li>
		
	          
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gestión de Documentos <span class="caret"></span></a>
          <ul class="dropdown-menu">
          <li><a href="index.php?controller=Categorias&action=index">Categorias</a>
		    </li>
			<li><a href="index.php?controller=SubCategorias&action=index">Subcategorias</a>
			</li>
			<li><a href="index.php?controller=TiposDocumentos&action=index">Tipos de Documentos</a>
			</li>
			<li><a href="index.php?controller=CartonDocumentos&action=index">Cartones de Documentos</a>
			</li>
			<li><a href="index.php?controller=ClienteProveedor&a	ction=index">Clientes / Proveedores</a>
			</li>
			<li role="separator" class="divider"></li>
			<li><a href="index.php?controller=Documentos&action=index">Busqueda de Documentos</a>
			</li>
	        
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reportes <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="index.php?controller=Usuarios&action=Reporte" target="blank">Listado de Usuarios</a>
		    </li>
			<li><a href="index.php?controller=Categorias&action=Reporte" target="blank">Listado de Categorias</a>
		    </li>
			<li><a href="index.php?controller=SubCategorias&action=Reporte" target="blank">Listado de Subcategorias</a>
			</li>
			<li><a href="index.php?controller=Documentos&action=ReporteListado" target="blank">Listado de Documentos</a>
		     <li role="separator" class="divider"></li>
           	<li><a href="index.php?controller=Documentos&action=ReporteEscaneados" target="blank">Documentos Escaneados por Fechas</a>
			</li>
			<li><a href="index.php?controller=Categorias&action=ReporteTotal" target="blank">Documentos por Categorías</a>
			</li>
			<li><a href="index.php?controller=SubCategorias&action=ReporteTotal" target="blank">Documentos por SubCategorías</a>
			</li>
	        <li role="separator" class="divider"></li>
            <li><a href="index.php?controller=ErroresImportacion&action=Reporte" target="blank">Errores de Importación</a>
		    </li>
		
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-right" role="search" action="<?php echo $helper->url("Documentos","Buscador");	
				?>"  method="post" >
        <div class="form-group">
          <input type="text" class="form-control" name="contenido_busqueda" id="criterio_busqueda" placeholder="texto a buscar">
          <select name="criterios_busqueda" id="criterio_busqueda" name="criterio_busqueda" class="form-control">
				<option value="0"  > --TODOS--</option>
				<option value="1"  >Ruc Cliente/Proveedor</option>
				<option value="2"  >Nombre Cliente/Proveedor</option>
				<option value="3"  >Número Carton</option>
				<option value="4"  >Número Poliza</option>
				<option value="5"  >Ramo Póliza</option>
				<option value="6"  >Ciudad Emisión</option>
		 </select>
						   		
        </div>
        <button type="submit" class="btn btn-default">Buscar</button>
      </form>
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>