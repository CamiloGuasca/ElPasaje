<?php
   $id = $_SESSION["id"];
   $rol = $_SESSION["rol"];
   if($rol != "proveedor"){
       header("Location: ?pid ".base64_encode("presentación/sinPermiso.php"));
   }

   $proveedor = new Proveedor($id);
   $proveedor = $proveedor -> consId();
   $tipoboleta = new Tipoboleta();
   $tipoboleta -> setProveedoresIdProv($id);
   $tiposboletas = $tipoboleta-> consId();
   
   include("presentacion/encabezado.php");
   include("presentacion/menuProveedor.php");

   if(isset($_POST["opcion"])){
        if($_POST["opcion"] == "registrar"){
            $nomBoleta = $_POST["nombreBol"];
            $porcentajeBoleta = $_POST["porcentajeBol"];
            $boleta = new TipoBoleta(null, $nomBoleta, $porcentajeBoleta, $id);
            $boleta -> registrar();
            header("Location: ?pid=".base64_encode("presentacion/evento/gestionarEventos.php"));
        }elseif($_POST["opcion"] == "actualizar"){
            $nomBoleta = $_POST["nombreBolReg"];
            $porcentajeBoleta = $_POST["porcentajeBolReg"];
            $idboleta = $_POST["idtop"];
            $boleta = new TipoBoleta($idboleta, $nomBoleta, $porcentajeBoleta, $id);
            $boleta -> actualizar();
            header("Location: ?pid=".base64_encode("presentacion/boleta/gestionarBoleta.php"));
        }elseif($_POST["opcion"] == "eliminar"){
            $idbol = $_POST["ideve"];
            $boleta = new TipoBoleta($idbol);
            $boleta -> eliminar();
            header("Location: ?pid=".base64_encode("presentacion/boleta/gestionarBoleta.php"));
        }
   }
?>
<!-- Incluir Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.4.1/css/rowReorder.bootstrap5.min.css">

<div class="container my-4 w-50">
        <div class="d-flex justify-content-between mb-3">
            <h3>Boletas</h3>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registro">Agregar Boleta</button>
        </div>
        <div>
            <input type="text" id="filtro" class="form-control" placeholder="Buscar">
        </div>
</div>
<div class="container my-4 w-50">
  <div id="resultado">  
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


  <!-- Modal  Registro-->
  <div class="modal fade" id="registro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"> <!-- Clase para centrar el modal -->
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar Boleta</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="post" action="?pid=<?php echo base64_encode('presentacion/boleta/gestionarBoleta.php') ?>">
            <input type="hidden" name="opcion" value="registrar">
            <div class="modal-body">
                <div class="mb-3">
                    <label for="nombreBol" class="form-label">Nombre</label>
                    <input type="text" name = "nombreBol" class="form-control" id="nombreBol" required>
                </div>
                <div class="mb-3">
                    <label for="nombreBol" class="form-label">Porcentaje</label>
                    <input type="number" name = "porcentajeBol" class="form-control" id="porcentajeBol" required>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Agregar</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal  Actualizar-->
  <div class="modal fade" id="actualizar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"> <!-- Clase para centrar el modal -->
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Actualizar Boleta</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="post" action="?pid=<?php echo base64_encode('presentacion/boleta/gestionarBoleta.php') ?>">
            <input type="hidden" name="opcion" value="actualizar">
            <input type="hidden" name="idtop" id="idtop">
            <div class="modal-body">
                <div class="mb-3">
                    <label for="nombreBolReg" class="form-label">Nombre</label>
                    <input type="text" name = "nombreBolReg" class="form-control" id="nombreBolReg" required>
                </div>
                <div class="mb-3">
                    <label for="porcentajeBolReg" class="form-label">Porcentaje</label>
                    <input type="number" name = "porcentajeBolReg" class="form-control" id="porcentajeBolReg" required>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
      </div>
    </div>
  </div>
      <!-- Modal  Eiminar-->
         <!-- Modal  Actualizar-->
  <div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"> <!-- Clase para centrar el modal -->
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Eliminar Boleta</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="post" action="?pid=<?php echo base64_encode('presentacion/boleta/gestionarBoleta.php') ?>">
            <div class="modal-body">
            <input type="hidden" name="opcion" value="eliminar">
            <input type="hidden" name="ideve" id="ideve">
             <p>¿Esta seguro que quiere eliminar el evento?</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-danger">Eliminar</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function(){
      $("#filtro").keyup(function(){
        let filtro = encodeURIComponent($("#filtro").val());
        url = "indexAjax.php?pid=<?php echo base64_encode("presentacion/boleta/consultarBoletaAjax.php") ?>&filtro=" + filtro + "&id=<?php echo $id; ?>";
        $("#resultado").load(url);
      });
    });
    $(document).ready(function(){
        $('#actualizar').on('show.bs.modal', function(event){    
            var button = $(event.relatedTarget);
            var idpb = button.data('idpb');
            var nombreBol = button.data('nomtb');
            var porcentajeBol = button.data('porcen');


            $(this).find('#idtop').val(idpb);
            $(this).find('#nombreBolReg').val(nombreBol);
            $(this).find('#porcentajeBolReg').val(porcentajeBol);
        });
    });
    $(document).ready(function(){
        $('#eliminar').on('show.bs.modal', function(event){    
            var button = $(event.relatedTarget);
            var ideve = button.data('ideve');
            console.log("Byuaa", ideve);
            $(this).find('#ideve').val(ideve);
        });
    });
  </script>