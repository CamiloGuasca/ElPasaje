<div class="container mt-5">
	<div class="row mb-3">
		<div class="col">
			<div class="">
				<div class="card-header">
				</div>
				<div class="">
    					<?php
        $i = 0;
        $evento = new Evento();
        $eventos = $evento->consTod();
        foreach ($eventos as $eventoActual) {
            if ($i % 4 == 0) {
                echo "<div class='row mb-3'>";
            }
            echo "<div class='col-lg-3 col-md-4 col-sm-6' >";
            echo "<div class='card'>";
            echo "<div class='card-body'>";
            $imagenBase64 = base64_encode($eventoActual->getImagenEve());
            $direccion = base64_encode('presentacion/cliente/detalleEvento.php');
            $ideve = base64_encode($eventoActual -> getIdEve());
            echo "<a href='?pid=".$direccion."&ideve=".$ideve."'><div class='text-center'><img src='data:image/jpeg;base64,$imagenBase64' width='70%' /></div></a><br>";
            echo "" . $eventoActual->getNombreEve() . "<br>";
            echo "Fecha: " . $eventoActual->getFechFinEve() . "<br>";
            echo "Valor: $" . $eventoActual->getPrecioEve() . "<br>";
            echo "Lugar: " . $eventoActual-> getIdLug() -> getNombreLug(). "<br>";
            echo "Proveedor: " . $eventoActual->getDProv() -> getNombrePersona(). "<br>";
            echo "</div>";
            echo "</div>";
            echo "</div>";

            if ($i % 4 == 3) {
                echo "</div>";
            }
            $i ++;
        }
        if ($i % 4 != 0) {
            echo "</div>";
        }
        ?>
					</div>
			</div>
		</div>
	</div>
</div>