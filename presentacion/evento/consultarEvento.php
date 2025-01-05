<?php
    if(isset($_GET["filtro"]))
    $filtro = $_GET["filtro"];
    $id = $_GET["id"];
    $evento = new Evento();
    $evento -> setDProv($id);
    $eventos = $evento -> conPN( $filtro);
?>
<div class="container">
	<div class="row mb-3">
		<div class="col">
            <?php
                if(count($eventos) > 0){
                    echo "<table class='table table-striped table-bordered' style='width:100%'>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th>Id</th>";
                    echo "<th>Nombre</th>";
                    echo "<th>Fecha Inicio</th>";
                    echo "<th>Fecha Final</th>";
                    echo "<th>Precio Base</th>";
                    echo "<th>Lugar</th>";
                    echo "<th>Opciones</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    
                    foreach($eventos as $evento){

                        $detallevento = new DetalleEvento();
                        $elementos = array();
                        $detallevento -> setIdEve($evento -> getIdEve());
                        $deteventos = $detallevento -> consIdEve();
                        $con = 0;
                        $texto = "";
                        foreach($deteventos as $detevento){
                            $tipoboleta = new TipoBoleta($detevento -> getIdTB());
                            $tipoboleta = $tipoboleta -> conTipBol();
                            $texto = $texto. "data-dete".$con."='Nombre: ".$tipoboleta->getNombreTB()." - Porcentaje: ".$tipoboleta->getPorcentajeTB()." - Cantidad: ".$detevento->getCantidad()."'";
                            $con++;
                        }
                        echo "
                        <tr>
                            <td>".$evento -> getIdEve()."</td>
                            <td>".$evento -> getNombreEve()."</td>
                            <td>".$evento -> getFechIniEve()."</td>
                            <td>".$evento -> getFechFinEve()."</td>
                            <td>".$evento -> getPrecioEve()."</td>
                            <td>".$evento -> getIdLug() -> getNombreLug()."</td>
                            <td>    
                                <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#actualizar'
                                        data-ideve='".$evento->getIdEve()."'
                                        data-nombreeve='".$evento->getNombreEve()."'
                                        data-fechinieve='".$evento->getFechIniEve()."'
                                        data-fechfineve='".$evento->getFechFinEve()."'
                                        data-precioeve='".$evento->getPrecioEve()."'
                                        data-lugarid='".$evento->getIdLug()->getIdLug()."'
                                        ".$texto."
                                        data-tamanio ='".$con."'
                                        data-imagen='data:image/jpeg;base64,".base64_encode($evento->getImagenEve())."'>
                                    <i class='fas fa-pencil-alt'></i>
                                </button>
                                <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#eliminarEve'
                                    data-ideve='".$evento -> getIdEve()."'
                                >
                                    <i class='fas fa-times'></i>
                                </button>                                      
                            </td>         
                        </tr>
                    ";
                    }  
                }

            ?>
        </div>
	</div>
</div>	