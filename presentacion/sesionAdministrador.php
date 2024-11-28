<?php
$id = $_SESSION["id"];
$rol = $_SESSION["rol"];
if($rol != "A"){
    header("Location: ?pid=" . base64_encode("presentacion/sinPermiso.php"));    
}
$administrador = new Administrador($id);
$administrador -> consultar();
include ("presentacion/encabezado.php");
include ("presentacion/menuAdministrador.php");
?>
<div class="container">
	<div class="row mb-3">
		<div class="col">
			<div class="card border-primary">
				<div class="card-header text-bg-info">
					<h4>Sesion Administrador</h4>
				</div>
				<div class="card-body">
					<p>Bienvenido administrador <?php echo $administrador -> getNombre() . " " . $administrador -> getApellido() ?></p>
				</div>
			</div>
		</div>
	</div>
</div>