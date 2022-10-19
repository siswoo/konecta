<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<title>Prueba Konecta</title>
</head>
<body>

<div class="container" style="margin-top:2rem;">
	<div class="row">
		<div class="col-12 text-center" style="font-weight:bold; font-size: 22px;">Gestión de Productos</div>
		<div class="col-12 mt-2 mb-2">
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_nuevo1">Nuevo Producto</button>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_venta1">Generar Venta</button>
			<a href="consulta1.php">
				<button type="button" class="btn btn-primary">Consultas de Ventas</button>
			</a>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_masstock1">Producto con mas Stock</button>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_masvendido">Producto más vendido</button>
		</div>
		<input type="hidden" name="datatables" id="datatables" data-pagina="1" data-consultasporpagina="10" data-filtrado="" data-sede="">
		<div class="col-6 form-group form-check">
			<label for="consultasporpagina" style="color:black; font-weight: bold;">Consultas por Página</label>
			<select class="form-control" id="consultasporpagina" name="consultasporpagina">
				<option value="10">10</option>
				<option value="20">20</option>
				<option value="30">30</option>
				<option value="40">40</option>
				<option value="50">50</option>
				<option value="100">100</option>
			</select>
		</div>
		<div class="col-6 form-group form-check">
			<label for="buscarfiltro" style="color:black; font-weight: bold;">Buscar</label>
			<input type="text" class="form-control" id="buscarfiltro" name="buscarfiltro" autocomplete="off">
		</div>	
		<div class="col-12" id="resultado_table1"></div>
	</div>
</div>

</body>
</html>

<div class="modal fade" id="modal_nuevo1" tabindex="-1" role="dialog" aria-labelledby="modal_nuevo1" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Nuevo Producto</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="#" method="POST" id="formulario1">
					<div class="row">
						<div class="col-12 mb-3">
							<label for="nombre" style="font-weight:bold;">Nombre</label>
							<input type="text" class="form-control" name="nombre" id="nombre" required autocomplete="off">
						</div>
						<div class="col-12 mb-3">
							<label for="referencia" style="font-weight:bold;">Referencia</label>
							<input type="text" class="form-control" name="referencia" id="referencia" required autocomplete="off">
						</div>
						<div class="col-12 mb-3">
							<label for="precio" style="font-weight:bold;">Precio</label>
							<input type="text" class="form-control" name="precio" id="precio" required autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
						</div>
						<div class="col-12 mb-3">
							<label for="peso" style="font-weight:bold;">Peso</label>
							<input type="text" class="form-control" name="peso" id="peso" required autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
						</div>
						<div class="col-12 mb-3">
							<label for="categoria" style="font-weight:bold;">Categoría</label>
							<input type="text" class="form-control" name="categoria" id="categoria" required autocomplete="off">
						</div>
						<div class="col-12 mb-3">
							<label for="stock" style="font-weight:bold;">Stock</label>
							<input type="number" class="form-control" name="stock" id="stock" required autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
						</div>
						<div class="col-12 text-right">
							<button type="submit" class="btn btn-success">Guardar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="modal_editar" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Modificar Producto</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="#" method="POST" id="formulario2">
					<div class="row">
						<div class="col-12 mb-3">
							<label for="nombre_m" style="font-weight:bold;">Nombre</label>
							<input type="text" class="form-control" name="nombre_m" id="nombre_m" required autocomplete="off">
						</div>
						<div class="col-12 mb-3">
							<label for="referencia_m" style="font-weight:bold;">Referencia</label>
							<input type="text" class="form-control" name="referencia_m" id="referencia_m" required autocomplete="off">
						</div>
						<div class="col-12 mb-3">
							<label for="precio_m" style="font-weight:bold;">Precio</label>
							<input type="text" class="form-control" name="precio_m" id="precio_m" required autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
						</div>
						<div class="col-12 mb-3">
							<label for="peso_m" style="font-weight:bold;">Peso</label>
							<input type="text" class="form-control" name="peso_m" id="peso_m" required autocomplete="off">
						</div>
						<div class="col-12 mb-3">
							<label for="categoria_m" style="font-weight:bold;">Categoría</label>
							<input type="text" class="form-control" name="categoria_m" id="categoria_m" required autocomplete="off">
						</div>
						<div class="col-12 mb-3">
							<label for="stock_m" style="font-weight:bold;">Stock</label>
							<input type="number" class="form-control" name="stock_m" id="stock_m" required autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
						</div>
						<div class="col-12 text-right">
							<button type="submit" class="btn btn-success">Guardar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_venta1" tabindex="-1" role="dialog" aria-labelledby="modal_venta1" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Generar Venta</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="#" method="POST" id="formulario3">
					<div class="row">
						<div class="col-12 mb-3">
							<label for="producto_v" style="font-weight:bold;">Producto</label>
							<select class="form-control" id="producto_v" name="producto_v" required>
								<option value="">Seleccione</option>
								<?php
								include("script/conexion.php");
								$sql1 = "SELECT * FROM productos";
								$proceso1 = mysqli_query($conexion,$sql1);
								while($row1=mysqli_fetch_array($proceso1)){
									$producto_id = $row1["id"];
									$producto_nombre = $row1["nombre"];
									echo '<option value="'.$producto_id.'">'.$producto_nombre.'</option>';
								}
								?>
							</select>
						</div>
						<div class="col-12 mb-3">
							<label for="stock_v" style="font-weight:bold;">Cantidad Vendida</label>
							<input type="number" class="form-control" name="stock_v" id="stock_v" required autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
						</div>
						<div class="col-12 text-right">
							<button type="submit" class="btn btn-success">Realizar Venta</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_masstock1" tabindex="-1" role="dialog" aria-labelledby="modal_masstock1" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Generar Venta</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-12 mb-3">
						<?php
							$sql2 = "SELECT * FROM productos ORDER BY stock DESC LIMIT 1";
							$proceso2 = mysqli_query($conexion,$sql2);
							while($row2=mysqli_fetch_array($proceso2)){
								$mv_nombre = $row2["nombre"];
								$mv_referencia = $row2["referencia"];
								$mv_stock = $row2["stock"];
								echo 'El producto con más stock es el <br>'.$mv_nombre." con referencia ".$mv_referencia." y stock de ".$mv_stock;
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_masvendido" tabindex="-1" role="dialog" aria-labelledby="modal_masvendido" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Generar Venta</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-12 mb-3">
						<?php
							$sql2='SELECT pro.nombre as pro_nombre, pro.referencia as pro_referencia, SUM(ven.cantidad) as cantidad FROM ventas ven 
							JOIN productos pro 
    						ON ven.id_productos = pro.id
    						GROUP BY pro.id
    						ORDER BY SUM(ven.cantidad) DESC LIMIT 1';
							$proceso2 = mysqli_query($conexion,$sql2);
							while($row2=mysqli_fetch_array($proceso2)){
								$mv_nombre = $row2["pro_nombre"];
								$mv_referencia = $row2["pro_referencia"];
								$mv_cantidad = $row2["cantidad"];
								echo 'El producto con más ventas es el <br>'.$mv_nombre." con referencia ".$mv_referencia." y con ".$mv_cantidad." ventas";
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" id="hidden_id" name="hidden_id">

<script src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="js/popper.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script type="text/javascript">
	$(document).ready(function() {
		filtrar1();
		setInterval('filtrar1()',1000);
	} );

	function filtrar1(){
		var input_consultasporpagina = $('#consultasporpagina').val();
		var input_buscarfiltro = $('#buscarfiltro').val();
		
		$('#datatables').attr({'data-consultasporpagina':input_consultasporpagina})
		$('#datatables').attr({'data-filtrado':input_buscarfiltro})

		var pagina = $('#datatables').attr('data-pagina');
		var consultasporpagina = $('#datatables').attr('data-consultasporpagina');
		var filtrado = $('#datatables').attr('data-filtrado');

		$.ajax({
			type: 'POST',
			url: 'script/crud1.php',
			dataType: "JSON",
			data: {
				"pagina": pagina,
				"consultasporpagina": consultasporpagina,
				"filtrado": filtrado,
				"condicion": "table1",
			},

			success: function(respuesta) {
				//console.log(respuesta);
				if(respuesta["estatus"]=="ok"){
					$('#resultado_table1').html(respuesta["html"]);
				}
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	function paginacion1(value){
		$('#datatables').attr({'data-pagina':value})
		filtrar1();
	}

	$('#myModal').on('shown.bs.modal', function () {
	  	$('#myInput').trigger('focus')
	});

	$("#formulario1").on("submit", function(e){
		e.preventDefault();
		nombre = $('#nombre').val();
		referencia = $('#referencia').val();
		precio = $('#precio').val();
		peso = $('#peso').val();
		categoria = $('#categoria').val();
		stock = $('#stock').val();
		var f = $(this);
			$.ajax({
			type: 'POST',
			url: 'script/crud1.php',
			dataType: "JSON",
			data: {
				"nombre": nombre,
				"referencia": referencia,
				"precio": precio,
				"peso": peso,
				"categoria": categoria,
				"stock": stock,
				"condicion": "nuevo",
			},

		success: function(respuesta) {
			console.log(respuesta);
			if(respuesta['estatus']=='ok'){
				Swal.fire({
					position: 'center',
					icon: 'success',
					title: 'Se ha registrado exitosamente',
					showConfirmButton: false,
					timer: 3000
				});
				$('#nombre').val("");
				$('#referencia').val("");
				$('#precio').val("");
				$('#peso').val("");
				$('#categoria').val("");
				$('#stock').val("");
			}
	      },

	      error: function(respuesta) {
	        console.log(respuesta['responseText']);
	      }
	    });
  	});

  	function consulta(id){
		$.ajax({
			type: 'POST',
			url: 'script/crud1.php',
			dataType: "JSON",
			data: {
				"id": id,
				"condicion": "consulta",
			},

			success: function(respuesta) {
				$('#nombre_m').val(respuesta["nombre"]);
				$('#referencia_m').val(respuesta["referencia"]);
				$('#precio_m').val(respuesta["precio"]);
				$('#peso_m').val(respuesta["peso"]);
				$('#categoria_m').val(respuesta["categoria"]);
				$('#stock_m').val(respuesta["stock"]);
				$('#hidden_id').val(id);
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	$("#formulario2").on("submit", function(e){
		e.preventDefault();
		id = $('#hidden_id').val();
		nombre = $('#nombre_m').val();
		referencia = $('#referencia_m').val();
		precio = $('#precio_m').val();
		peso = $('#peso_m').val();
		categoria = $('#categoria_m').val();
		stock = $('#stock_m').val();
		var f = $(this);
			$.ajax({
			type: 'POST',
			url: 'script/crud1.php',
			dataType: "JSON",
			data: {
				"id": id,
				"nombre": nombre,
				"referencia": referencia,
				"precio": precio,
				"peso": peso,
				"categoria": categoria,
				"stock": stock,
				"condicion": "editar",
			},

		success: function(respuesta) {
			console.log(respuesta);
			 window.location.href = "index.php";
	      },

	      error: function(respuesta) {
	        console.log(respuesta['responseText']);
	      }
	    });
  	});

  	function eliminar(id){
		Swal.fire({
			title: 'Estas seguro?',
			text: "Luego no podrás revertir esta acción",
			icon: 'warning',
			showConfirmButton: true,
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si, Eliminar registro!',
			cancelButtonText: 'Cancelar'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					type: 'POST',
					url: 'script/crud1.php',
					dataType: "JSON",
					data: {
						"id": id,
						"condicion": "eliminar",
					},
					success: function(respuesta) {
						//console.log(respuesta);
						window.location.href = "index.php";
					},

					error: function(respuesta) {
						console.log("error..."+respuesta);
					}
				});
			}
		})
	}

	$("#formulario3").on("submit", function(e){
		e.preventDefault();
		producto_v = $('#producto_v').val();
		cantidad_v = $('#stock_v').val();
		var f = $(this);
			$.ajax({
			type: 'POST',
			url: 'script/crud1.php',
			dataType: "JSON",
			data: {
				"producto_v": producto_v,
				"cantidad_v": cantidad_v,
				"condicion": "venta",
			},

		success: function(respuesta) {
			console.log(respuesta);
			if(respuesta['estatus']=='ok'){
				window.location.href = "index.php";
			}else if(respuesta['estatus']=='error'){
				Swal.fire({
					position: 'center',
					icon: 'error',
					title: respuesta["msg"],
					showConfirmButton: true,
				});
			}
	      },

	      error: function(respuesta) {
	        console.log(respuesta['responseText']);
	      }
	    });
  	});
</script>