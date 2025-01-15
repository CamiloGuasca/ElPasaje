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
$idevento = null;
$cantidad = null;
$idtb = null;
if(!isset($_POST["validar"])){
    header("Location: ?pid=".base64_encode("presentacion/sesionCliente.php"));
}else{
    $idevento = $_POST["idEven"];
    $cantidad = $_POST["cantidadBol"];
    $idtb = $_POST["idtb"];
}

if(isset($_POST["opcionBol"])){
		if($_POST["opcionBol"] == "comprar"){
			$facve = new FacturaVenta(null, null,null,$idevento, $id);
			$idfac = $facve -> registrar();
			$idTP = $_POST["tipbol"];
			$cantidad = $_POST["cantidadBol"];
			$detfac = new DetalleFactura(null, $idfac, $idTP, $cantidad);
			$detfac -> registrar();
		}elseif($_POST["opcionBol"] == "montar"){
			$idTP = $_POST["tipbol"];
			$cantidad = $_POST["cantidadBol"];
			$carrcomp = new CarritoCompra(null, $id, $idTP, $decoide,$cantidad);
			$carrcomp -> registrar();
		}
}

$tb = new TipoBoleta();
$tb -> setIdTB($idtb);
$tb = $tb -> conTipBol();
$even = new Evento();
$even -> setIdEve($idevento);
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
                 $total = $valun * $cantidad;
                 $tot = ($total*0.19)+$total;
                ?>
                <td><span id = "precun">$<?php echo $valun ?></span></td>
                <td><span id = "total">$<?php echo $total ?></span></td>
            </tr>
            </tbody>
        </table>
        <!-- Totales -->
        <div class="d-flex justify-content-end">
            <div class="text-end">
            <p><strong>Subtotal: </strong><span id = "subtotal">$<?php echo $total;?></span></p>
            <p><strong>IVA (19%): </strong><span id = "iva">$<?php echo $total * 0.19;?></span></p>
            <h5><strong>Total: </strong><span id = "tot"> $<?php echo $tot;?></span></h5>
            </div>
        </div>
        </div>
     </div>
</div>