<?php
require("./logica/Cliente.php");
$error = false;
if (isset($_POST["registrar"])) {      
    if($_POST["tipo"] == "cliente"){
    	$cliente = new Cliente(null, $_POST["nombre"], $_POST["nacimiento"], $_POST["correo"], md5($_POST["clave"]), $_POST["cedula"]);
       	$cliente -> registro();
    }else{
        $proveedor = new Proveedor(null, $_POST["nombre"], $_POST["nacimiento"], $_POST["correo"], md5($_POST["clave"]), $_POST["cedula"]);
        $proveedor -> registro();
    }
}
include ("presentacion/encabezado.php")?>
<div class="container mb-5">
	<div class="row mt-5">
		<div class="col-4"></div>
		<div class="col-4">
			<div class="card border-primary">
				<div class="card-header text-bg-info">
					<h4>Registro</h4>
				</div>
				<div class="card-body">
				<?php if (isset($_POST["registrar"])) { ?>
					<div class="alert alert-success mt-3" role="alert">Cliente registrado</div>		
				<?php } ?>
					<form method="post"
						action="?pid=<?php echo base64_encode("presentacion/registro.php")?>">
						<div class="mb-3">
							<input type="text" name="nombre" class="form-control"
								placeholder="Nombre" required>
						</div>
                        <div class="mb-3">
							<input type="number" name="cedula" class="form-control"
								placeholder="Cedula" required>
						</div>
                        <div class="mb-3">
                            <input type="date" name="nacimiento" class="form-control" required>
                        </div>
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
                                <option value="provedor">Proveedor</option>
                            <select>
                        </div>
						<button type="submit" name="registrar" class="btn btn-primary">Registrarse</button>
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