<?php
session_start();
if(isset($_GET["cerrarSesion"])){
    session_destroy();
}
require("logica/Evento.php");
require("logica/TipoBoleta.php");
require("logica/DetalleEvento.php");
require("logica/Cliente.php");
require("logica/FacturaVenta.php");
require("logica/DetalleFactura.php");
require("logica/CarritoCompra.php");
$paginasSinSesion = array(
    "presentacion/iniciarSesion.php",
    "presentacion/registro.php",
    "presentacion/sinPermiso.php",
);

$paginasConSesion = array(
    "presentacion/sesionAdministrador.php",
    "presentacion/sesionCliente.php",
    "presentacion/sesionProveedor.php",
    "presentacion/evento/gestionarEventos.php",
    "presentacion/boleta/gestionarBoleta.php",
    "presentacion/cliente/detalleEvento.php",
    "presentacion/cliente/facturasCliente.php",
    "presentacion/cliente/pasarelaPago.php",
    "presentacion/cliente/genFacturaCli.php"
);

?>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://use.fontawesome.com/releases/v5.11.1/css/all.css" rel="stylesheet" />
</head>
<body>
<style>
    .custom-btn {
      background-color: #f5725d; /* Color de fondo (naranja) */
      color: white; /* Color del texto */
      border: none; /* Elimina el borde */
    }
    .otro{
      background-color: #ffd15c; /* Color de fondo (naranja) */
      color: white; /* Color del texto */
      border: none;
    }
</style>
<?php 
if(!isset($_GET["pid"])){
    include ("presentacion/encabezado.php");
    include ("presentacion/menu.php");
    include ("presentacion/evento/consultaEventoInicio.php");    
}else{
    $pid = base64_decode($_GET["pid"]);
    if(in_array($pid, $paginasSinSesion)){
        include ($pid);
    }else if(in_array($pid, $paginasConSesion)){
        if(isset($_SESSION["id"])){
            include ($pid);
        }else{
            include ("presentacion/iniciarSesion.php");
        }
    }else{
        echo "<h1>Error 404</h1>";        
    }
}
?>
</body>
</html>