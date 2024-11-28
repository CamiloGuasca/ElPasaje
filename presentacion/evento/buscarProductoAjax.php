<?php 
$filtro = $_GET["filtro"];
$producto = new Producto();
$productos = $producto -> buscar($filtro);
?>
<div class="container">
	<div class="row mb-3">
		<div class="col">		
			<?php 
			if(count($productos) > 0){
                echo "<table class='table table-striped table-hover'>";
				echo "<tr>";
				echo "<th>Marca</th>";
				echo "<th>Nombre</th>";
				echo "<th>Cantidad</th>";
				echo "<th>Precio</th>";
				echo "</tr>";
				
				foreach ($productos as $productoActual){
				    echo "<tr>";
				    echo "<td>" . $productoActual -> getMarca() -> getNombre() . "</td>";
				    echo "<td>" . str_ireplace($filtro, "<strong>" . substr($productoActual -> getNombre(), stripos($productoActual -> getNombre(), $filtro), strlen($filtro)) . "</strong>", $productoActual -> getNombre()) . "</td>";
				    echo "<td>" . $productoActual -> getCantidad() . "</td>";
				    echo "<td>" . $productoActual -> getPrecioVenta() . "</td>";
				    echo "</tr>";
				}
				echo "</table>";
			} else {
			    echo "<div class='alert alert-danger mt-3' role='alert'>No hay resultados</div>";
			}
			?>
		</div>
	</div>
</div>