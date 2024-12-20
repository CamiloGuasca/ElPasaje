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
    $tipoboleta = new Tipoboleta();
    $tipoboleta -> setProveedoresIdProv($id);
    $tiposboletas = $tipoboleta-> consId();

    include("presentacion/encabezado.php");
    include("presentacion/menuProveedor.php");
    
    if(isset($_POST["opcion"])){
        if($_POST["opcion"] == "registro"){
            $nombreBoleta = $_POST["nombreReg"];
            $fechaInicio = $_POST["fechaInReg"];
            $fechaFin = $_POST["fechaFinReg"];
            $precioBas = $_POST["preciobReg"];
            $lugarReg = $_POST["idlugarReg"];
            $imagenReg = null;
            if (isset($_FILES['imagenAct']) && $_FILES['imagenAct']['error'] === 0) {
                // Procesar la imagen
                $imagenReg = $imagen = file_get_contents($_FILES['imagenAct']['tmp_name']);
            } else {
                echo "No se ha subido ningún archivo o ha ocurrido un error al cargar.";
            }
            $even = new Evento(null, $nombreBoleta,  $fechaInicio, $fechaFin, $precioBas, $imagenReg, $lugarReg, $id);
            $ideve = $even -> registro();

            if (isset($_POST['inputs'])) {
                foreach ($_POST['inputs'] as $id => $values) {
                    $text = $values['text'];  // Texto del select
                    $value = $values['value']; // Valor ingresado
                    $detallevento = new DetalleEvento(null, $ideve, $id, $value);
                    $detallevento -> registro();
                }
            }
        }elseif($_POST["opcion"] == "actualizar"){
            $idevento = $_POST["ideventoAct"];
            $nombreBoleta = $_POST["nombreAct"];
            $fechaInicio = $_POST["fechaInAct"];
            $fechaFin = $_POST["fechaFinAct"];
            $precioBas = $_POST["preciobAct"];
            $lugarReg = $_POST["idlugarAct"];
            $imagenReg = null;
            if (isset($_FILES['imagenReg']) && $_FILES['imagenReg']['error'] === 0) {
                // Procesar la imagen
                $imagen = file_get_contents($_FILES['imagenReg']['tmp_name']);
            } else {
                echo "No se ha subido ningún archivo o ha ocurrido un error al cargar.";
            }
            $even = new Evento($idevento, $nombreBoleta,  $fechaInicio, $fechaFin, $precioBas, $imagenReg, $lugarReg, $id);
            $even -> actualizar();
        }elseif($_POST["opcion"] == "eliminar"){
            $idevento = $_POST["idEveElim"];
            $even = new Evento($idevento);
            $detalleven = new DetalleEvento();
            $detalleven -> setIdEve($idevento);
            $detalleven -> eliminar();
            $even -> eliminar();
        }
    }
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

                        $detallevento = new DetalleEvento();
                        $elementos = array();
                        $detallevento -> setIdEve($evento -> getIdEve());
                        $deteventos = $detallevento -> consIdEve();
                        $con = 0;
                        $texto = "";
                        foreach($deteventos as $detevento){
                            $tipoboleta = new TipoBoleta($detevento -> getIdTB());
                            $tipoboleta = $tipoboleta -> conTipBol();
                            $texto = $texto. "data-dete".$con."='Nombre: ".$tipoboleta->getNombreTB()." - Porcentaje: ".$tipoboleta->getPorcentajeTB()." - Cantidad: ".$detevento->getCantidad()."'";
                            $con++;
                        }
                        echo "
                        <tr>
                            <td>".$evento -> getIdEve()."</td>
                            <td>".$evento -> getNombreEve()."</td>
                            <td>".$evento -> getFechIniEve()."</td>
                            <td>".$evento -> getFechFinEve()."</td>
                            <td>".$evento -> getPrecioEve()."</td>
                            <td>".$evento -> getIdLug() -> getNombreLug()."</td>
                            <td>    
                                <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#actualizar'
                                        data-ideve='".$evento->getIdEve()."'
                                        data-nombreeve='".$evento->getNombreEve()."'
                                        data-fechinieve='".$evento->getFechIniEve()."'
                                        data-fechfineve='".$evento->getFechFinEve()."'
                                        data-precioeve='".$evento->getPrecioEve()."'
                                        data-lugarid='".$evento->getIdLug()->getIdLug()."'
                                        ".$texto."
                                        data-tamanio ='".$con."'
                                        data-imagen='data:image/jpeg;base64,".base64_encode($evento->getImagenEve())."'>
                                    <i class='fas fa-pencil-alt'></i>
                                </button>
                                <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#eliminarEve'
                                    data-ideve='".$evento -> getIdEve()."'
                                >
                                    <i class='fas fa-times'></i>
                                </button>                                      
                            </td>         
                        </tr>
                    ";
                    }           
                ?>
            </tbody>
        </table>
        <div class="modal fade" id="actualizar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="registroLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl"> <!-- Modal más ancho -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registroLabel">Nuevo Evento </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" enctype="multipart/form-data" action="?pid=<?php echo base64_encode('presentacion/evento/gestionarEventos.php') ?>">
                <div class="modal-body">
                    <div class="row">
                        <!-- Primera sección -->
                        <div class="col-md-6 modal-section">
                            <h5>Actualizar Evento</h5>
                                <input type="hidden" value="actualizar" name="opcion">
                                <input type="hidden" name="ideventoAct" id="ideventoAct">
                                <div class="mb-3">
                                    <label for="nombreAct" class="form-label">Nombre</label>
                                    <input type="text" name = "nombreAct" class="form-control" id="nombreAct" required>
                                </div>
                                <div class="mb-3">
                                    <label for="fechaInAct" class="form-label">Fecha de Inicio</label>
                                    <input type="date" name = "fechaInAct" class="form-control" id="fechaInAct" required>
                                </div>
                                <div class="mb-3">
                                    <label for="fechaFinAct" class="form-label">Fecha de Finalización</label>
                                    <input type="date" name = "fechaFinAct" class="form-control" id="fechaFinAct" required>
                                </div>
                                <div class="mb-3">
                                    <label for="preciobAct" class="form-label">Precio Base</label>
                                    <input type="number" name = "preciobAct" class="form-control" id="preciobAct" required>
                                </div>
                                <div class="mb-3">
                                    <label for="idlugarAct" class="form-label">Lugar</label>
                                    <select id="idlugarAct" name="idlugarAct" class="form-control">
                                        <option value=""> </option>
                                        <?php
                                            $lugar = new Lugar();
                                            $lugares = $lugar->consTod();
                                            foreach ($lugares as $lugar) {
                                                echo "
                                                    <option value='" . $lugar->getIdLug() . "'>" . $lugar->getNombreLug() . " - Capadidad: " .$lugar -> getCapacidadLug()."</option>
                                                ";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="imagenReg" class="form-label">Imagen del Evento</label>
                                    <input type="file" name = "imagenReg" class="form-control" id="imagenReg">
                                </div>
                        </div>

                        <!-- Segunda sección -->
                        <div class="col-md-6 modal-section">
                            <h5>Información Adicional</h5>

                                <div class="text-center">
                                    
                                </div>
                                <div class="col-lg-5 col-md-6 col-sm-8">
                                    <div class="card text-bg-light">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <img id="modalimage" width="100%" src="" alt="Vista previa" class="img-fluid">
                                            </div>
                                            <a href="#">Rock al parque</a><br>
                                            Fecha: 00/00/0000<br>
                                            Valor: $60000<br>
                                            Lugar: Estadio el Campín<br>
                                            Proveedor: Camilo Guasca<br>
                                        </div>
                                    </div>
                                </div>      
                                <label for="mensaje" class="form-label">Boletas</label>
                                <div id="mensaje" name="mensaje" class="alert alert-info" role="alert">
                                    Aquí irá el texto formateado.
                                </div>
                        </div>
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

    <div class="modal" tabindex="-1" id="eliminarEve">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Eliminar Evento</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" action="?pid=<?php echo base64_encode('presentacion/evento/gestionarEventos.php') ?>">
      <div class="modal-body">
            <p>¿Esta seguro que quiere eliminar el evento?</p>
            <input type="hidden" name="opcion" value="eliminar">
            <input type="hidden" name="idEveElim" id="idEveElim" value="">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </div>
        </form>
        </div>
    </div>
    </div>

    
    <div class="modal fade" id="registro" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="registroLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl"> <!-- Modal más ancho -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registroLabel">Nuevo Evento </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="?pid=<?php echo base64_encode('presentacion/evento/gestionarEventos.php') ?>">
                <div class="modal-body">
                    <div class="row">
                        <!-- Primera sección -->
                        <div class="col-md-6 modal-section">
                            <h5>Datos del Evento</h5>
                                <input type="hidden" value="registro" name="opcion">
                                <div class="mb-3">
                                    <label for="nameeve" class="form-label">Nombre</label>
                                    <input type="text" name = "nombreReg" class="form-control" id="nameeve" required>
                                </div>
                                <div class="mb-3">
                                    <label for="fechain" class="form-label">Fecha de Inicio</label>
                                    <input type="date" name = "fechaInReg" class="form-control" id="fechain" required>
                                </div>
                                <div class="mb-3">
                                    <label for="fechafin" class="form-label">Fecha de Finalización</label>
                                    <input type="date" name = "fechaFinReg" class="form-control" id="fechafin" required>
                                </div>
                                <div class="mb-3">
                                    <label for="preciob" class="form-label">Precio Base</label>
                                    <input type="number" name = "preciobReg" class="form-control" id="preciob" required>
                                </div>
                                <div class="mb-3">
                                    <label for="idlugar" class="form-label">Lugar</label>
                                    <select id="idlugar" name="idlugarReg" class="form-control">
                                        <option value=""> </option>
                                        <?php
                                            $lugar = new Lugar();
                                            $lugares = $lugar->consTod();
                                            foreach ($lugares as $lugar) {
                                                echo "
                                                    <option value='" . $lugar->getIdLug() . "'>" . $lugar->getNombreLug() . " - Capadidad: " .$lugar -> getCapacidadLug()."</option>
                                                ";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="imagenAct" class="form-label">Imagen del Evento</label>
                                    <input type="file" name = "imagenAct" class="form-control" id="imagenAct">
                                </div>
                        </div>

                        <!-- Segunda sección -->
                        <div class="col-md-6 modal-section">
                            <h5>Información Adicional</h5>

                                <div class="text-center">
                                    
                                </div>
                                <div class="col-lg-5 col-md-6 col-sm-8">
                                    <div class="card text-bg-light">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <img id="cargar" width="100%" src="" alt="Vista previa" class="img-fluid" style="display:none;">
                                            </div>
                                            <a href="#">Rock al parque</a><br>
                                            Fecha: 00/00/0000<br>
                                            Valor: $60000<br>
                                            Lugar: Estadio el Campín<br>
                                            Proveedor: Camilo Guasca<br>
                                        </div>
                                    </div>
                                </div>      
                                <div class="mb-3">
                                    <label for="tipboleta" class="form-label">Entradas</label>
                                    <select id="tipboleta" class="form-control">
                                            <option value = ""></option>
                                            <?php
                                                foreach($tiposboletas as $tipobol){
                                                    echo "<option value = '".$tipobol -> getIdTB()."'>".$tipobol -> getNombreTB()." - ".$tipobol -> getPorcentajeTB()."</option>";
                                                }
                                            ?>
                                    </select>
                                </div> 
                                <div class="mb-3">
                                    <button type="button" class="btn btn-primary" onclick="crearInput(event)">Agregar</button>
                                </div>
                                <div id="inputsContainer"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
                </form>
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
            $('#actualizar').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Botón que activó el modal
                var ideve = button.data('ideve');// Extraer datos de los atributos 'data-*'
                var nombreEve = button.data('nombreeve');
                var fechIniEve = button.data('fechinieve');
                var fechFinEve = button.data('fechfineve');
                var precioEve = button.data('precioeve');
                var idLug = button.data('lugarid');
                var dProv = button.data('dProv');
                var imagen = button.data('imagen'); 
                var idevento = button.data('idevento');
                let tamanio = button.data("tamanio");
                let contex = "";
                //console.log("Tamaño ",tamanio);
                for(let i = 0; i<tamanio; i++){
                    let muestra = button.data("dete"+i);
                    console.log("dete",i);
                    contex += muestra+"<br>";
                }
                // Rellenar los campos del formulario en el modal con los datos extraídos
                $(this).find('#ideventoAct').val(ideve); // Asumiendo que 'lugar' va en 'name'
                $(this).find('#nombreAct').val(nombreEve); // Asumiendo que 'fecha_inicio' va en 'email'
                $(this).find('#fechaInAct').val(fechIniEve); // Asumiendo que 'precio' va en 'message'
                $(this).find('#fechaFinAct').val(fechFinEve);
                $(this).find('#preciobAct').val(precioEve);
                $(this).find('#idlugarAct').val(idLug);
                $(this).find('#modalimage').attr('src', imagen);
                $(this).find('#mensaje').html(contex);
            });
        });
        $(document).ready(function(){
            $('#eliminarEve').on('show.bs.modal', function(event){
                var button = $(event.relatedTarget);
                var ideve = button.data('ideve');

                $(this).find("#idEveElim").val(ideve);
            });
        })

        let inputCount = 0; // Variable para llevar el conteo de los inputs creados

        function crearInput(event) {
            event.preventDefault(); // Para evitar el envío del formulario si el botón está dentro de un formulario

            // Obtener el select y la opción seleccionada
            var select = document.getElementById("tipboleta");
            var selectedOption = select.options[select.selectedIndex];
            var selectedValue = selectedOption.value; // Valor real de la opción
            var selectedText = selectedOption.text;  // Texto visible de la opción

            if (!selectedValue) {
                alert("Por favor, selecciona un tipo de boleta.");
                return; // Si no se ha seleccionado una opción, no continuar
            }

            // Incrementar el contador de inputs
            inputCount++;

            // Crear un identificador único
            var uniqueId = "input-" + inputCount;

            // Crear el contenedor
            var containerDiv = document.createElement("div");
            containerDiv.classList.add("d-flex", "align-items-center", "mb-3");
            containerDiv.id = uniqueId; // Asignar un id único al contenedor

            // Crear el primer input (texto del select)
            var input1 = document.createElement("input");
            input1.type = "text";
            input1.value = selectedText; // Mostrar el texto del select
            input1.classList.add("form-control", "me-2");
            input1.readOnly = true; // Hacer que el input no sea editable
            input1.dataset.realValue = selectedValue; // Guardar el valor real como atributo data
            input1.name = `inputs[${inputCount}][text]`; // Asignar name dinámico

            // Crear el segundo input (valor adicional)
            var input2 = document.createElement("input");
            input2.type = "text";
            input2.placeholder = "Ingrese un valor";
            input2.classList.add("form-control", "me-2");
            input2.name = `inputs[${inputCount}][value]`; // Asignar name dinámico

            // Crear el botón para eliminar
            var deleteButton = document.createElement("button");
            deleteButton.textContent = "Eliminar";
            deleteButton.classList.add("btn", "btn-danger", "ms-2");
            deleteButton.onclick = function () {
                containerDiv.remove();
            };

            // Agregar los elementos al contenedor
            containerDiv.appendChild(input1);
            containerDiv.appendChild(input2);
            containerDiv.appendChild(deleteButton);

            // Agregar el contenedor al div principal
            document.getElementById("inputsContainer").appendChild(containerDiv);
        }
        document.getElementById('imagenReg').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('previewImage');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block'; // Mostrar la imagen
                };
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none'; // Ocultar la imagen si no hay archivo
            }
        });
        document.getElementById('imagenAct').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('cargar');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block'; // Mostrar la imagen
                };
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none'; // Ocultar la imagen si no hay archivo
            }
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

