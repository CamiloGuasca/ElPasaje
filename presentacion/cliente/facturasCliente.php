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
    
  


    $facve = new FacturaVenta();
    $facve -> setIdCli($id);
    $facvens = $facve -> consTod();
?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <div class="container my-4">
        <!-- Botón adicional -->
        <div class="d-flex justify-content-between mb-3">
            <h3>Eventos</h3>
            <button class="btn btn-primary" id="customButton">Agregar Elemento</button>
        </div>

        <!-- Tabla -->
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Evento</th>
                    <th>Botones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($facvens as $facven){
                        echo "
                        <tr>
                            <td>".$facven->getIdFacturaVenta()."</td>
                            <td>".$facven->getFechaFV()."</td>
                            <td>".$facven->getHoraFV()."</td>
                            <td>".$facven->getIdEve()->getNombreEve()."</td>
                            <td>
                                <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#eliminarEve'>
                                    <i class='bi bi-download'></i>
                                </button> 
                            </td>
                        </tr>
                        ";
                    }
                ?>

            </tbody>
        </table>
    </div>
