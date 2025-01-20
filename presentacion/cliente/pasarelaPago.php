<?php
$id = $_SESSION["id"];
$rol = $_SESSION["rol"];
if($rol != "cliente"){
	header("Location: ?pid=" . base64_encode("presentacion/sinPermiso.php"));
}
$decoide = null;
$cantidad = null;
$idTP = null;

if(!isset($_GET["validar"])){
   header("Location: ?pid=".base64_encode("presentacion/sesionCliente.php"));
}else{

    $decoide = $_GET["decoide"];
    $cantidad = $_GET["cantidad"];
    $idTP = $_GET["idTP"];
    
}

if(isset($_POST["decoide"])){
    $decoide = $_POST["decoide"];
    $cantidad = $_POST["cantidad"];
    $idTP = $_POST["idTP"];
}


if(isset($_POST["decoide"])){
    $dec = $_POST["decoide"];
    $facve = new FacturaVenta(null, null,null,$dec, $id);
	$facve -> registrar();
    $idfac = $facve -> ultid();
    echo "idfac: ".$idfac."\n";
    $can = $_POST["cantidad"];
    echo "cantidad: ".$can."\n";
    $idT = $_POST["idTP"];
    echo "idtp: ".$idT."\n";
    $detfac = new DetalleFactura(null, $idfac, $idT, $can);
    $detfac -> registrar();
}
$cliente = new Cliente($id);
$cliente -> consId();
include ("presentacion/encabezado.php");
include ("presentacion/menuCliente.php");




$tb = new TipoBoleta();
$tb -> setIdTB($idTP);
$tb = $tb -> conTipBol();
$even = new Evento();
$even -> setIdEve($decoide);
$even = $even -> consId();
?>
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
                <p><strong>Fecha:</strong> <span id="fecha"><?php echo date('d/m/Y');?></span></p>
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
                <td><?php echo $tb -> getIdTB();?></td>
                <td><span id = "producto"><?php echo $tb -> getNombreTB();?></span></td>
                <td><span id = "cantidad"><?php echo $cantidad;?></span></td>
                <?php 
                 $valun = ($even -> getPrecioEve() * $tb -> getPorcentajeTB())+$even -> getPrecioEve();
                 $totall = $valun * $cantidad;
                 $tot = ($totall*0.19)+$totall;
                ?>
                <td><span id = "precun">$<?php echo $valun ?></span></td>
                <td><span id = "total">$<?php echo $totall?></span></td>
            </tr>
            </tbody>
        </table>
        <!-- Totales -->
        <div class="d-flex justify-content-end">
            <div class="text-end">
            <p><strong>Subtotal: </strong><span id = "subtotal">$<?php echo $totall;?></span></p>
            <p><strong>IVA (19%): </strong><span id = "iva">$<?php echo $totall * 0.19;?></span></p>
            <h5><strong>Total: </strong><span id = "tot"> $<?php echo $tot;?></span></h5>
            </div>
        </div>

        </div>
     </div>
     <div class="d-flex justify-content-center align-items-center mt-4">
    <!-- Imagen -->
    <img 
      src="img/pse.png" 
      class="img-fluid rounded" 
      alt="Ejemplo" 
      data-bs-toggle="modal" 
      data-bs-target="#pago" 
      style="cursor: pointer;"
      width="100em"
      height="100em"
    >
  </div>
</div>

<div class="modal fade" id="pago" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"> <!-- Clase para centrar el modal -->
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirma tu Compra</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="post" action='?pid=<?php echo base64_encode('presentacion/cliente/pasarelaPago.php') ?>&ideve="<?php echo $ideve?>"'>
			<input type="hidden" name="decoide" value="<?php echo $decoide?>">
            <input type="hidden" name="cantidad" value="<?php echo $cantidad?>">
			<input type="hidden" name="idTP" id="opcionBol" value="<?php echo $idTP?>">
            <div class="modal-body">
                <div class="mb-3">
                <label for="nombreEve" class="form-label">Nombre</label>
                <input type="text" name="nombreEve" class="form-control" id="nombreEve" value="">
                </div>
                <div class="mb-3">
                <label for="fecha" class="form-label">Cédula</label>
                <input type="number" name="fecha" class="form-control" id="fecha" value="">
                </div>
                <div class="mb-3">
                <label for="nombreBol" class="form-label">Celular</label>
                <input type="number" name="nombreBol" class="form-control" id="nombreBol">
                </div>
                <div class="mb-3">
                    <label for="precioBol" class="form-label">Banco</label>
                    <input type="text" name="precioBol" class="form-control" id="precioBol">
                </div>
                <div class="mb-3">
                    <label for="bancos" class="form-label">Banco</label>
                    <select id="bancos" name="bancos" class="form-select">
                        <option value="" disabled selected>Seleccione su banco</option>
                        <option value="bancolombia">Bancolombia</option>
                        <option value="davivienda">Davivienda</option>
                        <option value="bbva">BBVA Colombia</option>
                        <option value="banco-de-bogota">Banco de Bogotá</option>
                        <option value="banco-popular">Banco Popular</option>
                        <option value="banco-de-occidente">Banco de Occidente</option>
                        <option value="banco-agrario">Banco Agrario</option>
                        <option value="citibank">Citibank</option>
                        <option value="itau">Itaú</option>
                        <option value="scotiabank-colpatria">Scotiabank Colpatria</option>
                        <option value="gnb-sudameris">GNB Sudameris</option>
                        <option value="coopcentral">Banco Cooperativo Coopcentral</option>
                        <option value="nequi">Nequi</option>
                        <option value="daviplata">Daviplata</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="total" class="form-label">Total</label>
                    <input type="number" class="form-control" name="total" id="total" value="<?php echo $totall?>" disabled>
                 </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Pagar</button>
            </div>
        </form>
      </div>
    </div>
  </div>