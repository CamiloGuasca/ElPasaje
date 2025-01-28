<?php
    require("logica/Evento.php");
    require("logica/DetalleEvento.php");
    require("logica/TipoBoleta.php");
    require("logica/FacturaVenta.php");
    require("logica/DetalleFactura.php");

    
    $pid = base64_decode($_GET["pid"]);
    include($pid);
?>