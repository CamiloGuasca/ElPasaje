<?php
$id = $_SESSION["id"];
$rol = $_SESSION["rol"];
if($rol != "C"){
    header("Location: ?pid=" . base64_encode("presentacion/sinPermiso.php"));
}
$cliente = new Cliente($id);
$cliente -> consultar();
include ("presentacion/encabezado.php");
include ("presentacion/menuCliente.php");
?>
<div class="container">
	<div class="row mb-3">
		<div class="col">
			<div class="card border-primary">
				<div class="card-header text-bg-info">
					<h4>Sesion Cliente</h4>
				</div>
				<div class="card-body">
					<p>Bienvenido cliente <?php echo $cliente -> getNombre() . " " . $cliente -> getApellido() ?></p>
				</div>
			</div>
		</div>
	</div>
</div>