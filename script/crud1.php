<?php
include("conexion.php");
$condicion = $_POST["condicion"];
$fecha_creacion = date('Y-m-d');

if($condicion=='table1'){
	$pagina = $_POST["pagina"];
	$consultasporpagina = $_POST["consultasporpagina"];
	$filtrado = $_POST["filtrado"];

	if($pagina==0 or $pagina==''){
		$pagina = 1;
	}

	if($consultasporpagina==0 or $consultasporpagina==''){
		$consultasporpagina = 10;
	}

	if($filtrado!=''){
		$filtrado = ' and (nombre LIKE "%'.$filtrado.'%" or referencia LIKE "%'.$filtrado.'%" or precio LIKE "%'.$filtrado.'%" or categoria LIKE "%'.$filtrado.'%" or fecha_creacion LIKE "%'.$filtrado.'%")';
	}

	$limit = $consultasporpagina;
	$offset = ($pagina - 1) * $consultasporpagina;

	$sql1 = "SELECT * FROM productos WHERE id != 0 ".$filtrado." ORDER BY id DESC";
	$sql2 = "SELECT * FROM productos WHERE id != 0 ".$filtrado." ORDER BY id DESC LIMIT ".$limit." OFFSET ".$offset;

	$proceso1 = mysqli_query($conexion,$sql1);
	$proceso2 = mysqli_query($conexion,$sql2);
	$conteo1 = mysqli_num_rows($proceso1);
	$paginas = ceil($conteo1 / $consultasporpagina);

	$html = '';

	$html .= '
		<div class="col-xs-12">
	        <table class="table table-bordered">
	            <thead>
		            <tr>
		                <th class="text-center">Nombre</th>
		                <th class="text-center">Referencia</th>
		                <th class="text-center">Precio</th>
		                <th class="text-center">Peso</th>
		                <th class="text-center">Categoría</th>
		                <th class="text-center">Stock</th>
		                <th class="text-center">Fecha Creación</th>
		                <th class="text-center">Opciones</th>
		            </tr>
	            </thead>
				<tbody>
	';
	if($conteo1>=1){
		while($row2 = mysqli_fetch_array($proceso2)) {
			$html .= '
					<tr id="tr_'.$row2["id"].'">
						<td style="text-align:center;">'.$row2["nombre"].'</td>
						<td style="text-align:center;">'.$row2["referencia"].'</td>
						<td style="text-align:center;">'.$row2["precio"].'</td>
						<td style="text-align:center;">'.$row2["peso"].'</td>
						<td style="text-align:center;">'.$row2["categoria"].'</td>
						<td style="text-align:center;">'.$row2["stock"].'</td>
						<td style="text-align:center;">'.$row2["fecha_creacion"].'</td>
						<td class="text-center" nowrap="nowrap">
							<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal_editar" onclick="consulta('.$row2["id"].');">Modificar</button>
							<button type="button" class="btn btn-danger" onclick="eliminar('.$row2["id"].');">Eliminar</button>
						</td>
					</tr>
		   ';
		}
	}else{
		$html .= '<tr><td colspan="8" class="text-center" style="font-weight:bold;font-size:20px;">Sin Resultados</td></tr>';
	}

	$html .= '
	            </tbody>
	        </table>
	        <nav>
	            <div class="row">
	                <div class="col-xs-12 col-sm-4 text-center">
	                    <p>Mostrando '.$conteo1.' Datos disponibles</p>
	                </div>
	                <div class="col-xs-12 col-sm-4 text-center">
	                    <p>Página '.$pagina.' de '.$paginas.' </p>
	                </div> 
	                <div class="col-xs-12 col-sm-4">
			            <nav aria-label="Page navigation" style="float:right; padding-right:2rem;">
							<ul class="pagination">
	';
	
	if ($pagina > 1) {
		$html .= '
								<li class="page-item">
									<a class="page-link" onclick="paginacion1('.($pagina-1).');" href="#">
										<span aria-hidden="true">Anterior</span>
									</a>
								</li>
		';
	}

	$diferenciapagina = 3;
	
	/*********MENOS********/
	if($pagina==2){
		$html .= '
		                		<li class="page-item">
			                        <a class="page-link" onclick="paginacion1('.($pagina-1).');" href="#">
			                            '.($pagina-1).'
			                        </a>
			                    </li>
		';
	}else if($pagina==3){
		$html .= '
			                    <li class="page-item">
			                        <a class="page-link" onclick="paginacion1('.($pagina-2).');" href="#"">
			                            '.($pagina-2).'
			                        </a>
			                    </li>
			                    <li class="page-item">
			                        <a class="page-link" onclick="paginacion1('.($pagina-1).');" href="#"">
			                            '.($pagina-1).'
			                        </a>
			                    </li>
	';
	}else if($pagina>=4){
		$html .= '
		                		<li class="page-item">
			                        <a class="page-link" onclick="paginacion1('.($pagina-3).');" href="#"">
			                            '.($pagina-3).'
			                        </a>
			                    </li>
			                    <li class="page-item">
			                        <a class="page-link" onclick="paginacion1('.($pagina-2).');" href="#"">
			                            '.($pagina-2).'
			                        </a>
			                    </li>
			                    <li class="page-item">
			                        <a class="page-link" onclick="paginacion1('.($pagina-1).');" href="#"">
			                            '.($pagina-1).'
			                        </a>
			                    </li>
		';
	} 

	/*********MAS********/
	$opcionmas = $pagina+3;
	if($paginas==0){
		$opcionmas = $paginas;
	}else if($paginas>=1 and $paginas<=4){
		$opcionmas = $paginas;
	}
	
	for ($x=$pagina;$x<=$opcionmas;$x++) {
		$html .= '
			                    <li class="page-item 
		';

		if ($x == $pagina){ 
			$html .= '"active"';
		}

		$html .= '">';

		$html .= '
			                        <a class="page-link" onclick="paginacion1('.($x).');" href="#"">'.$x.'</a>
			                    </li>
		';
	}

	if ($pagina < $paginas) {
		$html .= '
			                    <li class="page-item">
			                        <a class="page-link" onclick="paginacion1('.($pagina+1).');" href="#"">
			                            <span aria-hidden="true">Siguiente</span>
			                        </a>
			                    </li>
		';
	}

	$html .= '

						</ul>
					</nav>
				</div>
	        </nav>
	    </div>
	';

	$datos = [
		"estatus"	=> "ok",
		"html"	=> $html,
		"sql2"	=> $sql2,
		"sql1"	=> $sql1,
	];
	echo json_encode($datos);
}

if($condicion=='nuevo'){
	$nombre = $_POST["nombre"];
	$referencia = $_POST["referencia"];
	$precio = $_POST["precio"];
	$peso = $_POST["peso"];
	$categoria = $_POST["categoria"];
	$stock = $_POST["stock"];
	$sql1 = "INSERT INTO productos (nombre,referencia,precio,peso,categoria,stock,fecha_creacion) VALUES ('$nombre','$referencia','$precio','$peso','$categoria','$stock','$fecha_creacion')";
	$proceso1 = mysqli_query($conexion,$sql1);
	$datos = [
		"estatus"	=> "ok",
	];
	echo json_encode($datos);
}

if($condicion=='consulta'){
	$id = $_POST["id"];
	$sql1 = "SELECT * FROM productos WHERE id = $id";
	$proceso1 = mysqli_query($conexion,$sql1);
	while($row1=mysqli_fetch_array($proceso1)){
		$nombre = $row1["nombre"];
		$referencia = $row1["referencia"];
		$precio = $row1["precio"];
		$peso = $row1["peso"];
		$categoria = $row1["categoria"];
		$stock = $row1["stock"];
		$fecha_creacion = $row1["fecha_creacion"];
	}
	$datos = [
		"estatus"	=> "ok",
		"nombre" => $nombre,
		"referencia" => $referencia,
		"precio" => $precio,
		"peso" => $peso,
		"categoria" => $categoria,
		"stock" => $stock,
	];
	echo json_encode($datos);
}

if($condicion=='editar'){
	$id = $_POST["id"];
	$nombre = $_POST["nombre"];
	$referencia = $_POST["referencia"];
	$precio = $_POST["precio"];
	$peso = $_POST["peso"];
	$categoria = $_POST["categoria"];
	$stock = $_POST["stock"];
	$sql1 = "UPDATE productos SET nombre = '$nombre', referencia = '$referencia', precio = $precio, peso = $peso, categoria = '$categoria', stock = $stock WHERE id = $id ";
	$proceso1 = mysqli_query($conexion,$sql1);
	$datos = [
		"estatus"	=> "ok",
	];
	echo json_encode($datos);
}

if($condicion=='eliminar'){
	$id = $_POST["id"];
	$sql1 = "DELETE FROM productos WHERE id = $id";
	$proceso1 = mysqli_query($conexion,$sql1);
	$datos = [
		"estatus"	=> "ok",
	];
	echo json_encode($datos);
}

if($condicion=='venta'){
	$producto_v = $_POST["producto_v"];
	$cantidad_v = $_POST["cantidad_v"];
	if($cantidad_v<=0){
		$datos = [
			"estatus"	=> "error",
			"msg"	=> "debe ingresar una cantidad vendida mayor a cero",
		];
		echo json_encode($datos);
		exit;
	}
	$sql1 = "SELECT * FROM productos WHERE id = $producto_v";
	$proceso1 = mysqli_query($conexion,$sql1);
	while($row1=mysqli_fetch_array($proceso1)){
		$stock = $row1["stock"];
		$precio = $row1["precio"];
	}
	$stock_final = $stock-$cantidad_v;
	if($stock_final<0){
		$datos = [
			"estatus"	=> "error",
			"msg"	=> "No hay stock suficiente, el máximo permitido para este producto es ".$stock,
		];
		echo json_encode($datos);
	}else{
		$sql2 = "UPDATE productos SET stock = $stock_final WHERE id = $producto_v";
		$proceso2 = mysqli_query($conexion,$sql2);
		$precio_total = $precio*$cantidad_v;
		$sql3 = "INSERT INTO ventas (id_productos,cantidad,coste,fecha_creacion) VALUES ($producto_v,$cantidad_v,$precio_total,'$fecha_creacion')";
		$proceso3 = mysqli_query($conexion,$sql3);
		$datos = [
			"estatus"	=> "ok",
		];
		echo json_encode($datos);
	}
}

if($condicion=='table2'){
	$pagina = $_POST["pagina"];
	$consultasporpagina = $_POST["consultasporpagina"];
	$filtrado = $_POST["filtrado"];

	if($pagina==0 or $pagina==''){
		$pagina = 1;
	}

	if($consultasporpagina==0 or $consultasporpagina==''){
		$consultasporpagina = 10;
	}

	if($filtrado!=''){
		$filtrado = ' and (nombre LIKE "%'.$filtrado.'%" or referencia LIKE "%'.$filtrado.'%" or precio LIKE "%'.$filtrado.'%" or categoria LIKE "%'.$filtrado.'%" or fecha_creacion LIKE "%'.$filtrado.'%")';
	}

	$limit = $consultasporpagina;
	$offset = ($pagina - 1) * $consultasporpagina;

	$sql1 = "SELECT pro.nombre as pro_nombre, pro.referencia as pro_referencia, ven.cantidad as ven_cantidad, ven.id as ven_id, ven.coste as ven_coste, ven.fecha_creacion as ven_fecha_creacion FROM ventas ven 
	INNER JOIN productos pro 
	ON ven.id_productos = pro.id 
	WHERE ven.id != 0 ".$filtrado." ORDER BY ven.id DESC";
	$sql2 = "SELECT pro.nombre as pro_nombre, pro.referencia as pro_referencia, ven.cantidad as ven_cantidad, ven.id as ven_id, ven.coste as ven_coste, ven.fecha_creacion as ven_fecha_creacion FROM ventas ven 
	INNER JOIN productos pro 
	ON ven.id_productos = pro.id 
	WHERE ven.id != 0 ".$filtrado." ORDER BY ven.id DESC LIMIT ".$limit." OFFSET ".$offset;

	$proceso1 = mysqli_query($conexion,$sql1);
	$proceso2 = mysqli_query($conexion,$sql2);
	$conteo1 = mysqli_num_rows($proceso1);
	$paginas = ceil($conteo1 / $consultasporpagina);

	$html = '';

	$html .= '
		<div class="col-xs-12">
	        <table class="table table-bordered">
	            <thead>
		            <tr>
		                <th class="text-center">Producto</th>
		                <th class="text-center">Referencia</th>
		                <th class="text-center">Cantidad</th>
		                <th class="text-center">Coste</th>
		                <th class="text-center">Fecha Creación</th>
		            </tr>
	            </thead>
				<tbody>
	';
	if($conteo1>=1){
		while($row2 = mysqli_fetch_array($proceso2)) {
			$html .= '
					<tr id="tr_'.$row2["ven_id"].'">
						<td style="text-align:center;">'.$row2["pro_nombre"].'</td>
						<td style="text-align:center;">'.$row2["pro_referencia"].'</td>
						<td style="text-align:center;">'.$row2["ven_cantidad"].'</td>
						<td style="text-align:center;">'.$row2["ven_coste"].'</td>
						<td style="text-align:center;">'.$row2["ven_fecha_creacion"].'</td>
					</tr>
		   ';
		}
	}else{
		$html .= '<tr><td colspan="8" class="text-center" style="font-weight:bold;font-size:20px;">Sin Resultados</td></tr>';
	}

	$html .= '
	            </tbody>
	        </table>
	        <nav>
	            <div class="row">
	                <div class="col-xs-12 col-sm-4 text-center">
	                    <p>Mostrando '.$conteo1.' Datos disponibles</p>
	                </div>
	                <div class="col-xs-12 col-sm-4 text-center">
	                    <p>Página '.$pagina.' de '.$paginas.' </p>
	                </div> 
	                <div class="col-xs-12 col-sm-4">
			            <nav aria-label="Page navigation" style="float:right; padding-right:2rem;">
							<ul class="pagination">
	';
	
	if ($pagina > 1) {
		$html .= '
								<li class="page-item">
									<a class="page-link" onclick="paginacion1('.($pagina-1).');" href="#">
										<span aria-hidden="true">Anterior</span>
									</a>
								</li>
		';
	}

	$diferenciapagina = 3;
	
	/*********MENOS********/
	if($pagina==2){
		$html .= '
		                		<li class="page-item">
			                        <a class="page-link" onclick="paginacion1('.($pagina-1).');" href="#">
			                            '.($pagina-1).'
			                        </a>
			                    </li>
		';
	}else if($pagina==3){
		$html .= '
			                    <li class="page-item">
			                        <a class="page-link" onclick="paginacion1('.($pagina-2).');" href="#"">
			                            '.($pagina-2).'
			                        </a>
			                    </li>
			                    <li class="page-item">
			                        <a class="page-link" onclick="paginacion1('.($pagina-1).');" href="#"">
			                            '.($pagina-1).'
			                        </a>
			                    </li>
	';
	}else if($pagina>=4){
		$html .= '
		                		<li class="page-item">
			                        <a class="page-link" onclick="paginacion1('.($pagina-3).');" href="#"">
			                            '.($pagina-3).'
			                        </a>
			                    </li>
			                    <li class="page-item">
			                        <a class="page-link" onclick="paginacion1('.($pagina-2).');" href="#"">
			                            '.($pagina-2).'
			                        </a>
			                    </li>
			                    <li class="page-item">
			                        <a class="page-link" onclick="paginacion1('.($pagina-1).');" href="#"">
			                            '.($pagina-1).'
			                        </a>
			                    </li>
		';
	} 

	/*********MAS********/
	$opcionmas = $pagina+3;
	if($paginas==0){
		$opcionmas = $paginas;
	}else if($paginas>=1 and $paginas<=4){
		$opcionmas = $paginas;
	}
	
	for ($x=$pagina;$x<=$opcionmas;$x++) {
		$html .= '
			                    <li class="page-item 
		';

		if ($x == $pagina){ 
			$html .= '"active"';
		}

		$html .= '">';

		$html .= '
			                        <a class="page-link" onclick="paginacion1('.($x).');" href="#"">'.$x.'</a>
			                    </li>
		';
	}

	if ($pagina < $paginas) {
		$html .= '
			                    <li class="page-item">
			                        <a class="page-link" onclick="paginacion1('.($pagina+1).');" href="#"">
			                            <span aria-hidden="true">Siguiente</span>
			                        </a>
			                    </li>
		';
	}

	$html .= '

						</ul>
					</nav>
				</div>
	        </nav>
	    </div>
	';

	$datos = [
		"estatus"	=> "ok",
		"html"	=> $html,
		"sql2"	=> $sql2,
		"sql1"	=> $sql1,
	];
	echo json_encode($datos);
}
