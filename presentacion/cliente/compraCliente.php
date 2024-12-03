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
?>