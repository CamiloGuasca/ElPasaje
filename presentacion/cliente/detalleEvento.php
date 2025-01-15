<?php
	$id = $_SESSION["id"];
	$rol = $_SESSION["rol"];
	if($rol != "cliente"){
		header("Location: ?pid=" . base64_encode("presentacion/sinPermiso.php"));
	}
	$cliente = new Cliente($id);
	$cliente -> consId();
	include ("presentacion/encabezado.php");
	include ("presentacion/menuCliente.php");
	$decoide = null;
	if(isset($_GET["ideve"])){
		$decoide = base64_decode($_GET["ideve"]);
	}
	
	$evento = new Evento($decoide);
	$evento = $evento -> consId();

	$imagenBase64 = base64_encode($evento->getImagenEve());
	$ideve = base64_encode($decoide);
	$detallevento = new DetalleEvento();
	$detallevento -> setIdEve($decoide);
	$detalleseve = $detallevento -> consIdEve();

	if(isset($_POST["opcionBol"])){
		if($_POST["opcionBol"] == "comprar"){
			$facve = new FacturaVenta(null, null,null,$decoide, $id);
			$idfac = $facve -> registrar();
			$idTP = $_POST["tipbol"];
			$cantidad = $_POST["cantidadBol"];
			$detfac = new DetalleFactura(null, $idfac, $idTP, $cantidad);
			$detfac -> registrar();
		}elseif($_POST["opcionBol"] == "montar"){
			$idTP = $_POST["tipbol"];
			$cantidad = $_POST["cantidadBol"];
			$carrcomp = new CarritoCompra(null, $id, $idTP, $decoide,$cantidad);
			$carrcomp -> registrar();
		}
	}
?>

	</style>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <div class="container my-5 " style="max-width: 60%;">
        <div class="row">
            <!-- Columna Izquierda -->
            <div class="col-md-5">
                <img src="data:image/jpeg;base64,<?php echo $imagenBase64?>" alt="Imagen" class="img-fluid rounded mb-4" style="max-height: 60%;">
                <p><strong>Nombre:</strong> <?php echo $evento->getNombreEve();?></p>
                <p><strong>Fecha de Inicio:</strong> <?php echo $evento->getFechIniEve();?></p>
				<p><strong>Fecha de Terminación:</strong> <?php echo $evento->getFechFinEve();?></p>
				<p><strong>Precio Base:</strong> <?php echo $evento->getPrecioEve();?></p>
                <p><strong>Ubicación:</strong> <?php echo $evento->getIdLug()->getDireccionLug()?> - <?php echo $evento->getIdLug()->getNombreLug()?> </p>
                <p><strong>Proveedor: </strong><?php echo $evento->getDProv()->getNombrePersona()?></p>
            </div>
            <!-- Columna Derecha -->
            <div class="col-md-7">
			<h2><?php echo $evento->getNombreEve();?></h2>
				<?php
					foreach($detalleseve as $detallevent) {
						$tipoboleta = new TipoBoleta($detallevent->getIdTB());
						$tipoboleta = $tipoboleta -> conTipBol();
						$direccion = base64_encode('presentacion/cliente/detalleEvento.php');
						if($detallevent->getCantidad() == 0){
							echo "
						<div class='card shadow-sm'>
						<div class='card-body d-flex justify-content-between align-items-center'>
							<div>
							<h5 class='mb-0'>".$tipoboleta->getNombreTB()."</h5>
							<h3>No Hay Boletas Disponibles</h3>
							</div>
						</div>
						";
						}else{
							echo "
							<div class='card shadow-sm'>
							<div class='card-body d-flex justify-content-between align-items-center'>
								<div>
								<h5 class='mb-0'>".$tipoboleta->getNombreTB()."</h5>
								<small class='text-muted'>".$evento->getFechIniEve()."</small>
								<p class='mb-0'><strong>".$evento -> getIdLug() -> getDireccionLug()."</strong></p>
								<p class='mb-0 text-muted'>".$evento -> getIdLug() -> getNombreLug()."</p>
								</div>
								<div class='text-end'>
								<p class='mb-0'><strong>Valor $".(($evento->getPrecioEve()*$tipoboleta->getPorcentajeTB())/100)+$evento->getPrecioEve()."</strong></p>
								<br>
								<button type='button' class='btn custom-btn' data-bs-toggle='modal' data-bs-target='#comprar'
									data-idbol='".$detallevent->getIdTB()."'
									data-nombol='".$tipoboleta->getNombreTB()."'
									data-valor='".(($evento->getPrecioEve()*$tipoboleta->getPorcentajeTB())/100)+$evento->getPrecioEve()."'
									data-idtb='".$tipoboleta->getIdTB()."'
									data-opcion='montar'
								>
									<i class='bi bi-cart-fill'></i> Montar
								</button>
								<button type='button' class='btn custom-btn' data-bs-toggle='modal' data-bs-target='#comprar'
									data-idbol='".$detallevent->getIdTB()."'
									data-nombol='".$tipoboleta->getNombreTB()."'
									data-valor='".(($evento->getPrecioEve()*$tipoboleta->getPorcentajeTB())/100)+$evento->getPrecioEve()."'
									data-idtb='".$tipoboleta->getIdTB()."'
									data-opcion='comprar'
								>
									<i class='bi bi-cash'></i> Comprar
								</button>
								</div>
							</div>
							";
						}
					}
				?>
				</div>
				</div>
            </div>
        </div>
    </div>

	  <!-- Modal  Compra-->
	  <div class="modal fade" id="comprar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"> <!-- Clase para centrar el modal -->
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirma tu Compra</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="post" action='?pid=<?php echo base64_encode('presentacion/cliente/pasarelaPago.php') ?>&ideve="<?php echo $ideve?>"'>
			<input type="hidden" name="validar" value="algo">
            <input type="hidden" name="idEven" value="<?php echo $decoide?>">
			<input type="hidden" name="opcionBol" id="opcionBol" value="">
			<input type="hidden" name="tipbol" id="tipbol">
			<input type="hidden" name="idtb" id="idtb">
            <div class="modal-body">
                <div class="mb-3">
                    <label for="nombreEve" class="form-label">Evento</label>
                    <input type="text" name = "nombreEve" class="form-control" id="nombreEve" value="<?php echo $evento->getNombreEve()?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" name = "fecha" class="form-control" id="fecha" value="<?php echo $evento->getFechIniEve()?>" disabled>
                </div>
				<div class="mb-3">
                    <label for="nombreBol" class="form-label">Producto</label>
                    <input type="text" name = "nombreBol" class="form-control" id="nombreBol" disabled>
                </div>
				<div class="mb-3">
                    <label for="precioBol" class="form-label">Precio</label>
                    <input type="text" name = "precioBol" class="form-control" id="precioBol"  disabled>
                </div>
				<div class="mb-3">
                    <label for="cantidadBol" class="form-label">Confirma la Cantidad</label>
                    <input type="number" name = "cantidadBol" class="form-control" id="cantidadBol">
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Comprar</button>
            </div>
        </form>
      </div>
    </div>
  </div>
<script>
	$(document).ready(function(){
		$('#comprar').on('show.bs.modal', function(event){
			var button = $(event.relatedTarget);
			var tpbol = button.data('idbol');
			var nombol = button.data('nombol');
			var valor = button.data('valor');
			var opcion = button.data('opcion');
			var idtb = button.data('idtb');

			$(this).find('#tipbol').val(tpbol);
			$(this).find('#nombreBol').val(nombol);
			$(this).find('#precioBol').val(valor);
			$(this).find('#opcionBol').val(opcion);
			$(this).find('#idtb').val(idtb);
		});
	});
</script>

