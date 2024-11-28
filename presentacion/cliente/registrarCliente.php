<?php
$error = false;
if (isset($_POST["registrar"])) {        
    $cliente = new Cliente(null, $_POST["nombre"], $_POST["apellido"], $_POST["correo"], md5($_POST["clave"]));
    $cliente -> registrar();
}
include ("presentacion/encabezado.php")?>
<div class="container">
	<div class="row mt-5">
		<div class="col-4"></div>
		<div class="col-4">
			<div class="card border-primary">
				<div class="card-header text-bg-info">
					<h4>Registrar Cliente</h4>
				</div>
				<div class="card-body">
				<?php if (isset($_POST["registrar"])) { ?>
					<div class="alert alert-success mt-3" role="alert">Cliente registrado</div>		
				<?php } ?>
					<form method="post"
						action="?pid=<?php echo base64_encode("presentacion/cliente/registrarCliente.php")?>">
						<div class="mb-3">
							<input type="text" name="nombre" class="form-control"
								placeholder="Nombre" required>
						</div>
						<div class="mb-3">
							<input type="text" name="apellido" class="form-control"
								placeholder="Apellido" required>
						</div>
						<div class="mb-3">
							<input type="email" name="correo" class="form-control"
								placeholder="Correo" required>
						</div>
						<div class="mb-3">
							<input type="password" name="clave" class="form-control"
								placeholder="Clave" required>
						</div>
						<button type="submit" name="registrar" class="btn btn-primary">Registrar
							Cliente</button>
						<?php if($error){ ?>
                        <div class="alert alert-danger mt-3"
							role="alert">Error de correo o clave</div>    
						<?php } ?>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>