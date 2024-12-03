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
	include ("presentacion/evento/consultaEventoInicio.php");

	if(isset($_POST["idcar"])){
		$idcar = $_POST["idcar"];
		$carrito = new CarritoCompra($idcar);
		$carrito -> eliminarPID();
	}

	if(isset($_POST["comptodcar"])){
		$carrito = new CarritoCompra();
		$carrito -> setIdCli($id);
		$carritos = $carrito -> consIdCli();
		foreach($carritos as $car){
			$facve = new FacturaVenta(null, null,null,$car -> getIdEve() -> getIdEve(), $id);
			$idfac = $facve -> registrar();
			$detfac = new DetalleFactura(null, $idfac, $car -> getIdTB() -> getIdTB(), $car -> getCantidad());
			$detfac -> registrar();
			$carrito = new CarritoCompra($car->getIdCC());
			$carrito -> eliminarPID();
		}
	}
?>
