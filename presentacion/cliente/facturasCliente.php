<?php

	$id = $_SESSION["id"];
	$rol = $_SESSION["rol"];
	if($rol != "cliente"){
		header("Location: ?pid=" . base64_encode("presentacion/sinPermiso.php"));
	}
	$cliente = new Cliente($id);
	$cliente = $cliente -> consId();
	include ("presentacion/encabezado.php");
	include ("presentacion/menuCliente.php");
    
    $facve = new FacturaVenta();
    $facve -> setIdCli($id);
    $facvens = $facve -> consTod();
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<div>
</div>
<div id="contenido-general">
    <div class="container my-4">
        <!-- Botón adicional -->
        <div class="d-flex justify-content-between mb-3">
            <h3>Facturas</h3>
        </div>
        <div>
            <input type="text" class="form-control mb-3">
        </div>
        <!-- Tabla -->
        <div id="resultado">
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
    </div>
</div>
</div>
      <!-- Modal de Bootstrap -->
  <div class="modal fade" id="modalImpresion" tabindex="-1" aria-labelledby="modalImpresionLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Cambia el tamaño del modal aquí -->
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalImpresionLabel">Factura</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
            <div class="modal-body">
                <div class="container my-5">
                <!-- Card Principal -->
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Información de la Compra</h4>
                    </div>
                    <div class="card-body">
                    <!-- Información Principal -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                        <h5>Cliente</h5>
                        <p><strong>Nombre: </strong><?php echo $cliente -> getNombrePersona();?></php>
                        <p><strong>Email: </strong><?php echo $cliente -> getCorreoPersona();?></p>
                        </div>
                        <div class="col-md-6">
                        <h5>Detalles de la Boleta</h5>
                        <p><strong>Número:</strong> <span id="idfav">#12345</span></p>
                        <p><strong>Fecha:</strong> <span id="fecha">02/12/2024</span></p>
                        </div>
                    </div>
                    <!-- Tabla de Productos -->
                    <h5>Productos</h5>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td><span id = "producto">Producto A</span></td>
                            <td><span id = "cantidad">2</span></td>
                            <td><span id = "precun">$50.00</span></td>
                            <td><span id = "total">$100.00</span></td>
                        </tr>
                        </tbody>
                    </table>
                    <!-- Totales -->
                    <div class="d-flex justify-content-end">
                        <div class="text-end">
                        <p><strong>Subtotal: </strong><span id = "subtotal">$175.00</span></p>
                        <p><strong>IVA (19%): </strong><span id = "iva">$33.25</span></p>
                        <h5><strong>Total: </strong><span id = "tot"> $208.25</span></h5>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <!--<button type="button" class="btn btn-primary" onclick="imprimirModal()">Imprimir Factura</button>!-->
            <button id="imprimir-factura" style="color: white;" class="btn bg-primary">
                Imprimir Factura
            </button>
        </div>
      </div>
    </div>
  </div>

<script>
    $(document).ready(function(){
        $('#modalImpresion').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget);
            var idfv = button.data('idfv');
            
            $('#imprimir-factura').attr(
                'onclick',
                `window.open('?pid=<?php echo base64_encode('presentacion/cliente/genFacturaCli.php') ?>&idusu=<?php echo base64_encode($id) ?>&idfac=${btoa(idfv)}', '_blank')`
            );
            var fecha = button.data('fecha');
            var producto =  button.data('producto');
            var cantidad = button.data('cantidad');
            var precun = button.data('precun');
            var total = button.data('total');
            var iva = button.data('iva');
            var tot = button.data('tot');

            console.log("IVA: ",iva);
            console.log("Total: ",tot);
            $(this).find('#idfav').text('#'+idfv);
            $(this).find('#fecha').text(fecha);
            $(this).find('#producto').text(producto);
            $(this).find('#cantidad').text(cantidad);
            $(this).find('#precun').text(precun);
            $(this).find('#total').text(total);
            $(this).find('#subtotal').text(total);
            $(this).find('#iva').text(iva);
            $(this).find('#tot').text(tot);
        });
    });

    function imprimirModal() {
      const contenidoGeneral = document.getElementById('contenido-general');
      const modal = document.getElementById('modalImpresion');

      contenidoGeneral.classList.add('hidden');
     
      window.print();

      contenidoGeneral.classList.remove('hidden');
    }
</script>
