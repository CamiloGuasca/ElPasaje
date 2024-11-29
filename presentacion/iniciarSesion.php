<?php
require_once("logica/Cliente.php");
require_once("logica/Proveedor.php");
$error = false;
if (isset($_POST["autenticar"])) {
	if($_POST["tipo"] == "cliente"){
		$cliente = new Cliente();
		$cliente -> setCorreoPersona($_POST["correo"]);
		$cliente -> setClavePersona(md5($_POST["clave"]));
		if($cliente -> autenticar()){
			$_SESSION["id"] = $cliente -> getIdPersona();
			$_SESSION["rol"] = "cliente";
			header("Location: ?pid=".base64_encode("presentacion/sesionCliente.php"));
		}	
	}else if($_POST["tipo"] == "proveedor"){
		$proveedor = new Proveedor();
		$proveedor -> setCorreoPersona($_POST["correo"]);
		$proveedor -> setClavePersona(md5($_POST["clave"]));
		if($proveedor -> autenticar()){
			$_SESSION["id"] = $proveedor -> getIdPersona();
			$_SESSION["rol"] = "proveedor";
			header("Location: ?pid=".base64_encode("presentacion/sesionProveedor.php"));
		}	
	}
}
include ("presentacion/encabezado.php")?>
<div class="container">
	<div class="row mt-5">
		<div class="col-4"></div>
		<div class="col-4">
			<div class="card border-primary">
				<div class="card-header text-bg-info">
					<h4>Iniciar Sesion</h4>
				</div>
				<div class="card-body">
					<form method="post"
						action="?pid=<?php echo base64_encode("presentacion/iniciarSesion.php")?>">
						<div class="mb-3">
							<input type="email" name="correo" class="form-control"
								placeholder="Correo" required>
						</div>
						<div class="mb-3">
							<input type="password" name="clave" class="form-control"
								placeholder="Clave" required>
						</div>
						<div class="mb-3">
                            <select class="form-control" name="tipo">
                                <option value="cliente">Cliente</option>
                                <option value="proveedor">Proveedor</option>
                            <select>
                        </div>
						<button type="submit" name="autenticar" class="btn btn-primary">Iniciar
							Sesion</button>
						<h5>
							<a
								href="?pid=<?php echo base64_encode("presentacion/cliente/registro.php")?>">Registrarse
							</a>
						</h5>
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