<?php
$filtro = $_GET["filtro"];
$id = $_GET["id"];
$facve = new FacturaVenta();
$facve -> setIdCli($id);
$facvens = $facve->conFCF($filtro);
?>
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
                        $detfac = new DetalleFactura();
                        $detfac -> setIdFacturaVenta($facve->getIdFacturaVenta());
                        $detfac = $detfac ->consIdFac();
                        $precun = (($facven->getIdEve()->getPrecioEve()*$detfac -> getIdTB() -> getPorcentajeTB())/100)+$facven->getIdEve()->getPrecioEve();
                        $total = $precun*$detfac->getCantidad();
                        $iva = ($total*19)/100;
                        $tot = $total+$iva;
                        echo "
                        <tr>
                            <td>".$facven->getIdFacturaVenta()."</td>
                            <td>".$facven->getFechaFV()."</td>
                            <td>".$facven->getHoraFV()."</td>
                            <td>".$facven->getIdEve()->getNombreEve()."</td>
                            <td>
                                <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#modalImpresion'
                                    data-idfv='".$facven->getIdFacturaVenta()."'
                                    data-fecha='".$facven->getFechaFV()."'
                                    data-producto='".$detfac -> getIdTB() -> getNombreTB()."'
                                    data-cantidad='".$detfac -> getCantidad()."'
                                    data-precun='".$precun."'
                                    data-total='".$total."'
                                    data-iva='".$iva."';
                                    data-tot='".$tot."'
                                >
                                    <i class='bi bi-download'></i>
                                </button> 
                            </td>
                        </tr>
                        ";
                    }
                ?>

            </tbody>
        </table>