<?php
    $id = $_SESSION["id"];
    $rol = $_SESSION["rol"];
    if($rol != "proveedor"){
        header("Location: ?pid ".base64_encode("presentación/sinPermiso.php"));
    }
    $proveedor = new Proveedor($id);
    $proveedor = $proveedor -> consId();
    $evento = new Evento();
    $evento -> setDProv($id);   
    $eventos = $evento -> consIdProv();
    include("presentacion/encabezado.php");
    include("presentacion/menuProveedor.php");
?>
    
    <!-- Incluir Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Incluir Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Incluir DataTables CSS -->
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Tabla con DataTables -->
    <div class="container mt-5">
        <h2>Eventos</h2>
        <table id="miTabla" class="display">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Final</th>
                    <th>Precio Base</th>
                    <th>Lugar</th>
                    <th>Botones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($eventos as $evento){
                        echo "
                        <tr>
                            <td>".$evento -> getIdEve()."</td>
                            <td>".$evento -> getNombreEve()."</td>
                            <td>".$evento -> getFechIniEve()."</td>
                            <td>".$evento -> getFechFinEve()."</td>
                            <td>".$evento -> getPrecioEve()."</td>
                            <td>".$evento -> getIdLug() -> getNombreLug()."</td>
                            <td>    
                                <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#staticBackdrop'
                                        data-ideve='".$evento->getIdEve()."'
                                        data-nombreeve='".$evento->getNombreEve()."'
                                        data-fechinieve='".$evento->getFechIniEve()."'
                                        data-fechfineve='".$evento->getFechFinEve()."'
                                        data-precioeve='".$evento->getPrecioEve()."'
                                        data-lugarid='".$evento->getIdLug()->getIdLug()."'
                                        data-imagen='/uploads/eventos/".$evento->getImagenEve()."'>
                                    <i class='fas fa-pencil-alt'></i>
                                </button>
                                <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#staticBackdrop'>
                                    <i class='fas fa-times'></i>
                                </button>                                      
                            </td>         
                        </tr>
                    ";
                    }           
                ?>
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Formulario de Contacto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="id" class="form-label">Id</label>
                            <input type="text" class="form-control" id="id" placeholder="Ingrese el id" required>
                        </div>
                        <div class="mb-3">
                            <label for="nameeve" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nameeve" placeholder="" required>
                        </div>
                        <div class="mb-3">
                            <label for="fechain" class="form-label">Fecha de Inicio</label>
                            <input type="date" class="form-control" id="fechain" required>
                        </div>
                        <div class="mb-3">
                            <label for="fechafin" class="form-label">Fecha de Finalización</label>
                            <input type="date" class="form-control" id="fechafin" required>
                        </div>
                        <div class="mb-3">
                            <label for="preciob" class="form-label">Precio Base</label>
                            <input type="number" class="form-control" id="preciob" required>
                        </div>
                        <div class="mb-3">
                            <select id="idlugar" class="form-control">
                            <?php
                                $lugar = new Lugar();
                                $lugares = $lugar -> consTod();
                                foreach($lugares as $lugar){
                                    echo"
                                        <option value='".$lugar->getIdLug()."'>".$lugar->getNombreLug()."</option>
                                    ";
                                }
                            ?>
                            </select>
                        </div>
                        <div class="text-center mb-3">
                            <img id="modalImage" src="" alt="Imagen del Evento" class="img-fluid">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Incluir jQuery, Popper.js y Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <!-- Incluir DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    
    <!-- Inicializar DataTable -->
    <script>
        $(document).ready(function() {
            // Cuando se abre el modal
            $('#staticBackdrop').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Botón que activó el modal
                var ideve = button.data('ideve');// Extraer datos de los atributos 'data-*'
                var nombreEve = button.data('nombreeve');
                var fechIniEve = button.data('fechinieve');
                var fechFinEve = button.data('fechfineve');
                var precioEve = button.data('precioeve');
                var idLug = button.data('lugarid');
                var dProv = button.data('dProv');
                var imagen = button.data('imagen'); 
                

                // Rellenar los campos del formulario en el modal con los datos extraídos
                $(this).find('#id').val(ideve); // Asumiendo que 'lugar' va en 'name'
                $(this).find('#nameeve').val(nombreEve); // Asumiendo que 'fecha_inicio' va en 'email'
                $(this).find('#fechain').val(fechIniEve); // Asumiendo que 'precio' va en 'message'
                $(this).find('#fechafin').val(fechFinEve);
                $(this).find('#preciob').val(precioEve);
                $(this).find('#idlugar').val(idLug);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#miTabla').DataTable({
                layout:{
                    topStart: 'search',
                    topEnd: 'pageLength',
                    bottomStart: 'info',
                    bottomEnd: 'paging'    
                }
            });
        });
    </script>
