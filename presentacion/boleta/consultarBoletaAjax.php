<?php
    $filtro = $_GET["filtro"];
    $id = $_GET["id"];
    $boleta = new TipoBoleta();
    $boleta -> setProveedoresIdProv($id);
    $tiposboletas = $boleta -> conPN($filtro);
?>
<div class="container">
	<div class="row mb-3">
		<div class="col">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Porcentaje</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach($tiposboletas as $tipoboleta) {
                    echo "
                        <tr>
                            <td>".$tipoboleta -> getIdTB()."</td>
                            <td>".$tipoboleta -> getNombreTB()."</td>
                            <td>".$tipoboleta -> getPorcentajeTB()."</td>
                            <td>
                            <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#actualizar'
                                data-idpb='".$tipoboleta -> getIdTB()."'
                                data-nomtb='".$tipoboleta -> getNombreTB()."';
                                data-porcen='".$tipoboleta -> getPorcentajeTB()."'
                            >
                            <i class='fas fa-pencil-alt'></i></button>
                            <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#eliminar'
                                    data-ideve='".$tipoboleta -> getIdTB()."'
                            > <i class='fas fa-times'></i></button>  
                            </td>
                        </tr>
                    ";
                }
            ?>
                        </tbody>
                        </table>
        </div>
	</div>
</div>	