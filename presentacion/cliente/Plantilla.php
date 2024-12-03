<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Boleta</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container my-5">
    <!-- Card Principal -->
    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Información de la Boleta</h4>
      </div>
      <div class="card-body">
        <!-- Información Principal -->
        <div class="row mb-3">
          <div class="col-md-6">
            <h5>Cliente</h5>
            <p><strong>Nombre:</strong> Juan Pérez</p>
            <p><strong>Email:</strong> juan.perez@example.com</p>
          </div>
          <div class="col-md-6">
            <h5>Detalles de la Boleta</h5>
            <p><strong>Número:</strong> #12345</p>
            <p><strong>Fecha:</strong> 02/12/2024</p>
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
              <td>Producto A</td>
              <td>2</td>
              <td>$50.00</td>
              <td>$100.00</td>
            </tr>
            <tr>
              <td>2</td>
              <td>Producto B</td>
              <td>1</td>
              <td>$75.00</td>
              <td>$75.00</td>
            </tr>
          </tbody>
        </table>
        <!-- Totales -->
        <div class="d-flex justify-content-end">
          <div class="text-end">
            <p><strong>Subtotal:</strong> $175.00</p>
            <p><strong>IVA (19%):</strong> $33.25</p>
            <h5><strong>Total:</strong> $208.25</h5>
          </div>
        </div>
      </div>
    </div>
  </div>

  <body class="bg-light">
    <div class="container my-5">
      <!-- Card con la Información de la Boleta -->
      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
          <h4 class="mb-0">Información de la Boleta</h4>
        </div>
        <div class="card-body">
          <!-- Información del Boleto -->
          <p><strong>Número de Boleta:</strong> #12345</p>
          <p><strong>Fecha:</strong> 02/12/2024</p>
          <p><strong>Cliente:</strong> Juan Pérez</p>
          <p><strong>Producto:</strong> Producto A</p>
          <p><strong>Cantidad:</strong> 2</p>
          <p><strong>Precio Unitario:</strong> $50.00</p>
          <p><strong>Total:</strong> $100.00</p>
        </div>
      </div>
    </div>

    <div class="container my-5">
        <!-- Card para mostrar los detalles -->
        <div class="card shadow-sm">
          <div class="card-body d-flex justify-content-between align-items-center">
            <!-- Detalles de la boleta (fecha, lugar, hora) -->
            <div>
              <h5 class="mb-0">11 DIC / 2024</h5>
              <small class="text-muted">Mié / 9:00 PM</small>
              <p class="mb-0"><strong>Bogotá</strong></p>
              <p class="mb-0 text-muted">Movistar Arena</p>
            </div>
            <!-- Precio y botón -->
            <div class="text-end">
              <p class="mb-0"><strong>Desde $130.000</strong></p>
              <a href="#" class="btn btn-primary">Comprar</a>
            </div>
          </div>
        </div>
      </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
