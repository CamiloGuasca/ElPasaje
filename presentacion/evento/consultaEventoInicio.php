<div class="container">
	<div class="row mb-3">
		<div class="col">
			<div class="card border-primary">
				<div class="card-header text-bg-info">
					<h4>Tienda Anonima</h4>
				</div>
				<div class="card-body">
    					<?php
        $i = 0;
        $evento = new Evento();
        $eventos = $evento->consTod();
        foreach ($eventos as $eventoActual) {
            if ($i % 4 == 0) {
                echo "<div class='row mb-3'>";
            }
            echo "<div class='col-lg-3 col-md-4 col-sm-6' >";
            echo "<div class='card text-bg-light'>";
            echo "<div class='card-body'>";
            $imagenBase64 = base64_encode($eventoActual->getImagenEve());
            echo "<div class='text-center'><img src='data:image/jpeg;base64,$imagenBase64' width='70%' /></div>";
            echo "<a href='#'>" . $eventoActual->getNombreEve() . "</a><br>";
            echo "Fecha: " . $eventoActual->getFechFinEve() . "<br>";
            echo "Valor: $" . $eventoActual->getPrecioEve() . "<br>";
            echo "Lugar: " . $eventoActual->getLugaresIdLug(). "<br>";
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