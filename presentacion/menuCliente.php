<?php
	$id = $_SESSION["id"];
	$rol = $_SESSION["rol"];
	if($rol != "cliente"){
		header("Location: ?pid=" . base64_encode("presentacion/sinPermiso.php"));
	}
    $cliente = new Cliente($id);
	$cliente -> consId();
?>
<nav class="navbar navbar-expand-lg custom-btn bg-body-tertiary">
	<div class="container">
		<a class="navbar-brand" href='?pid=<?php echo base64_encode("presentacion/sesionCliente.php")?>'><img src="img/boleto.png" width="50" /></a>
		<button class="navbar-toggler" type="button"
			data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
			aria-controls="navbarNavDropdown" aria-expanded="false"
			aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<ul class="navbar-nav me-auto">
				<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
					href="#" role="button" data-bs-toggle="dropdown"
					aria-expanded="false">Carrito</a>
					<ul class="dropdown-menu">
                        <li><button type='button' class='dropdown-item' data-bs-toggle='modal' data-bs-target='#carrito'>Ver Carrito</button></li>
					</ul></li>
			</ul>
		<div class="collapse navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav me-auto">
				<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
					href="#" role="button" data-bs-toggle="dropdown"
					aria-expanded="false">Factura</a>
					<ul class="dropdown-menu">
                        <li><a class='dropdown-item' href='?pid=<?php echo base64_encode("presentacion/cliente/facturasCliente.php")?>'>Gestionar Facturas</a></li>
					</ul></li>
			</ul>

			<ul class="navbar-nav">
				<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
					 role="button" data-bs-toggle="dropdown"
					aria-expanded="false"><?php echo $cliente -> getNombrePersona()?></a>
					<ul class="dropdown-menu">
                        <li><a class='dropdown-item' href='?cerrarSesion=true'>Cerrar Sesion</a></li>
					</ul></li>
			</ul>			
		</div>
	</div>
</nav>
<?php
	$carrito = new CarritoCompra();
	$carrito -> setIdCli($id);
	$carritos = $carrito -> consIdCli();
?>
 <!-- Modal de Bootstrap -->
 <div class="modal fade" id="carrito" tabindex="-1" aria-labelledby="modalImpresionLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Cambia el tamaño del modal aquí -->
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalImpresionLabel">Carrito de Compra</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
            <div class="modal-body">
            <body class="bg-light">
				<!-- Items del Carrito -->
				<div class="cart-items">
				<?php
					$total = null;
					$ru = "action='?pid=" . base64_encode('presentacion/sesionCliente.php') . "'";
					foreach($carritos as $carrit){
						$precio = (($carrit->getIdEve()->getPrecioEve()*$carrit->getIdTB()->getPorcentajeTB())/100)+$carrit->getIdEve()->getPrecioEve();
						$totalPr = $precio*$carrit->getCantidad();
						$total += $totalPr;
						echo "
								<div class='d-flex justify-content-between align-items-center border-bottom py-2'>
								<div>
									<h5 class='fw-bold'>".$carrit->getIdEve()->getNombreEve()."</h5>
									<h6>".$carrit->getIdTB()->getNombreTB()."</h6>
									<small>Cantidad: ".$carrit->getCantidad()."</small>
									
								</div>
								<div>
									<span>$".$totalPr."</span>
									<form method='post' ".$ru.">
										<input name = 'idcar' type='hidden' value='".$carrit->getIdCC()."'>
										<button class='btn btn-sm btn-danger ms-3 mt-3'>Eliminar</button>
									</form>
								</div>
								</div>
							 ";
					}
				?>
				</div>
				<!-- Total -->
				<div class="mt-4 text-end">
					<h5>Total: $<?php echo $total?></h5>
				</div>
        </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Seguir Comprando</button>
			<form method="post" action="?pid=<?php echo base64_encode('presentacion/sesionCliente.php') ?>">
				<input type="hidden" name="comptodcar" value="true">
         		<button type="submit" class="btn btn-success">Comprar</button>
			</form>
        </div>
      </div>
    </div>
  </div>