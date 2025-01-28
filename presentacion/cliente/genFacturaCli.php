<?php
ob_start();
$id = $_SESSION["id"];
$rol = $_SESSION["rol"];
if ($rol != "cliente") {
    header("Location: ?pid=" . base64_encode("presentacion/sinPermiso.php"));
}
$idfac = null;
if (isset($_GET["idusu"])) {
    if (base64_decode($_GET["idusu"]) != $id) {
        header("Location: ?pid" . base64_encode("presentacion/sesionCliente.php"));
    } else {
        $idfac = $_GET["idfac"];
    }
}

$cliente = new Cliente($id);
$cliente = $cliente->consId();

$factura = new FacturaVenta(base64_decode($idfac));
$factura = $factura->confacId();

$detFac = new DetalleFactura();
$detFac->setIdFacturaVenta(base64_decode($idfac));
$detFac = $detFac->consDetFacFV();

$valUni = (($factura->getIdEve()->getPrecioEve() * $detFac->getIdTB()->getPorcentajeTB()) / 100) + $factura->getIdEve()->getPrecioEve();
$total = $valUni * $detFac->getCantidad();
$iva = ($total * 0.19);
$tot = $iva + $total;

require_once('fpdf/fpdf.php');
require_once('phpqrcode/qrlib.php');

$nombrearc = "imgtemp/fac.png";
if(file_exists($nombrearc)){
    unlink($nombrearc);
}
$tamanio = 10;
$level = 'M';
$frameSize = 3;
$contenido = 'http://localhost/El%20pasaje/?pid='.base64_encode('presentacion/cliente/genFacturaCli.php').'&idusu='.base64_encode($id).'&idfac='.$idfac;

QRcode::png($contenido,$nombrearc,$level,$tamanio,$frameSize);
// Crear PDF
class PDF extends FPDF
{
    // Encabezado
    function Header()
    {
        $this->SetFillColor(33, 150, 243); // Azul
        $this->SetTextColor(255); // Blanco
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Informacion de la Compra', 0, 1, 'C', true);
        $this->Ln(5);
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(128);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Crear la factura en PDF
$pdf = new PDF();
$pdf->AddPage();

// Información del cliente y boleta
$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(0);

// Detalles del cliente
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(95, 8, 'Nombre: ' . $cliente->getNombrePersona(), 0, 0);
$pdf->Cell(95, 8, 'Numero: #' . $factura->getIdFacturaVenta(), 0, 1);
$pdf->Cell(95, 8, 'Email: ' . $cliente->getCorreoPersona(), 0, 0);
$pdf->Cell(95, 8, 'Fecha: ' . $factura->getFechaFV(), 0, 1);
$pdf->Ln(10);

// Tabla de productos
$pdf->SetFillColor(200, 200, 200); // Gris claro
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 8, '#', 1, 0, 'C', true);
$pdf->Cell(80, 8, 'Producto', 1, 0, 'C', true);
$pdf->Cell(20, 8, 'Cantidad', 1, 0, 'C', true);
$pdf->Cell(40, 8, 'Precio Unitario', 1, 0, 'C', true);
$pdf->Cell(40, 8, 'Total', 1, 1, 'C', true);

// Detalles del producto
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(10, 8, '1', 1, 0, 'C');
$pdf->Cell(80, 8, $detFac->getIdTB()->getNombreTB(), 1, 0);
$pdf->Cell(20, 8, $detFac->getCantidad(), 1, 0, 'C');
$pdf->Cell(40, 8, $valUni, 1, 0, 'C');
$pdf->Cell(40, 8, $total, 1, 1, 'C');
$pdf->Ln(5);

// Totales
$pdf->Cell(190, 8, 'Subtotal: ' . $total, 0, 1, 'R');
$pdf->Cell(190, 8, 'IVA (19%): ' . $iva, 0, 1, 'R');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190, 8, 'Total: ' . $tot, 0, 1, 'R');

$pdf->Ln(5);
$pdf->Image($nombrearc, ($pdf->GetPageWidth() - 50) / 2, $pdf->GetY(), 50, 50);

// Salida del PDF
$pdf->Output('I', 'factura.pdf');

?>
