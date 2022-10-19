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
			<a href="index.php">
				<button type="button" class="btn btn-primary">Consultas de Productos</button>
			</a>
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
				"condicion": "table2",
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