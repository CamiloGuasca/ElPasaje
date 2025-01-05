<?php
    require("logica/Evento.php");
    require("logica/DetalleEvento.php");
    require("logica/TipoBoleta.php");
    
    $pid = base64_decode($_GET["pid"]);
    include($pid);
?>