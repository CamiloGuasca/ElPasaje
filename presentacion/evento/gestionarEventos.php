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
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.4.1/css/rowReorder.bootstrap5.min.css">


<div class="container my-4">
        <!-- Botón adicional -->
        <div class="d-flex justify-content-between mb-3">
            <h3>Eventos</h3>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registro">Agregar Evento</button>
        </div>

        <!-- Tabla -->
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Final</th>
                    <th>Precio Base</th>
                    <th>Lugar</th>
                    <th>Opciones</th>
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
                                        data-imagen='data:image/jpeg;base64,".base64_encode($evento->getImagenEve())."'>
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
                            <input type="text" class="form-control" id="id" placeholder="Ingrese el id" disabled>
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
    
    <div class="modal fade" id="registro" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registroLabel">Formulario de Contacto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="id" class="form-label">Id</label>
                            <input type="text" class="form-control" id="id" placeholder="Ingrese el id" disabled>
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
    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.4.1/js/dataTables.rowReorder.min.js"></script>
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
                $(this).find('#modalImage').attr('src', imagen);
            });
        });
    </script>
        <script>
        $(document).ready(function () {
            // Inicializar DataTable con reordenamiento
            var table = $('#example').DataTable({
                rowReorder: true,
                responsive: true,
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json"
                }
            });
        });
    </script>

