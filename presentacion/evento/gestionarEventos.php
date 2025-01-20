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

 
    if(isset($_POST["opcion"])){
        if($_POST["opcion"] == "registro"){
            $nombreBoleta = $_POST["nombreReg"];
            $fechaInicio = $_POST["fechaInReg"];
            $fechaFin = $_POST["fechaFinReg"];
            $precioBas = $_POST["preciobReg"];
            $lugarReg = $_POST["idlugarReg"];
        
            // Verifica si el archivo se ha subido correctamente
            //if (isset($_FILES['imagenReg']) && $_FILES['imagenReg']['error'] === UPLOAD_ERR_OK) {
                $rutaLocal = $_FILES["imagenReg"]["tmp_name"];
                $tipoArchivo = mime_content_type($rutaLocal);
                $imagenReg = file_get_contents($rutaLocal);
        
                // Validar tipo de archivo
                if (!in_array($tipoArchivo, ['image/jpeg', 'image/png', 'image/gif'])) {
                    die("Tipo de archivo no válido.");
                }
        
                // Mover imagen al servidor (opcional)
                // Registrar evento
                $even = new Evento(null, $nombreBoleta, $fechaInicio, $fechaFin, $precioBas, $imagenReg, $lugarReg, $id);
                $ideve = $even->registro();
        
                // Registrar detalles del evento
                if (isset($_POST['inputs'])) {
                    foreach ($_POST['inputs'] as $id => $values) {
                        $text = $values['text'];
                        $value = $values['value'];
                        $detallevento = new DetalleEvento(null, $ideve, $id, $value);
                        $detallevento->registro();
                        header("Location: ?pid=".base64_encode("presentacion/evento/gestionarEventos.php"));
                    }
                }
           // } else {
             //   die("Error al subir la imagen.");
           // }
        }elseif($_POST["opcion"] == "actualizar"){
            $idevento = $_POST["ideventoAct"];
            $nombreBoleta = $_POST["nombreAct"];
            $fechaInicio = $_POST["fechaInAct"];
            $fechaFin = $_POST["fechaFinAct"];
            $precioBas = $_POST["preciobAct"];
            $lugarReg = $_POST["idlugarAct"];
            $imagenAct = null;
            if(isset($_FILES["imagenAct"]) && $_FILES["imagenAct"]["error"] === UPLOAD_ERR_OK){
                $rutaLocal = $_FILES["imagenAct"]["tmp_name"]; 
                $tipoArchivo = mime_content_type($rutaLocal);
                $imagenAct = file_get_contents($rutaLocal);
        
                // Validar tipo de archivo
                if (!in_array($tipoArchivo, ['image/jpeg', 'image/png', 'image/gif'])) {
                    die("Tipo de archivo no válido.");
                } 
            }
    
            $even = new Evento($idevento, $nombreBoleta,  $fechaInicio, $fechaFin, $precioBas, $imagenAct, $lugarReg, $id);
            $even -> actualizar();
            header("Location: ?pid=".base64_encode("presentacion/evento/gestionarEventos.php"));
        }elseif($_POST["opcion"] == "eliminar"){
            $idevento = $_POST["idEveElim"];
            $even = new Evento($idevento);
            $detalleven = new DetalleEvento();
            $detalleven -> setIdEve($idevento);
            $detalleven -> eliminarIdEve();
            $even -> eliminar();
            header("Location: ?pid=".base64_encode("presentacion/evento/gestionarEventos.php"));
        }
    }

    include("presentacion/encabezado.php");
    include("presentacion/menuProveedor.php");
    
?>

<!-- Incluir Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.4.1/css/rowReorder.bootstrap5.min.css">


<div class="container my-4">
    <div class="d-flex justify-content-between mb-3">
        <h3>Eventos</h3>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registro">Agregar Evento</button>
    </div>
    <div>
        <input type="text" id="filtro" class="form-control" placeholder="Buscar">
    </div>
</div>
<div class="container my-4">
    <div id="resultado">
        <!-- Tabla -->
        <table class="table table-striped table-bordered" style="width:100%">
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
                        $estadis = null;
                        $del = null;
                        foreach($deteventos as $detevento){
                            $tipoboleta = new TipoBoleta($detevento -> getIdTB());
                            $tipoboleta = $tipoboleta -> conTipBol();
                            $texto = $texto. "data-dete".$con."='Nombre: ".$tipoboleta->getNombreTB()." - Porcentaje: ".$tipoboleta->getPorcentajeTB()." - Cantidad: ".$detevento->getCantidad()."'";
                            $volRes = $detevento->conTotVol() - $detevento->getCantidad();
                            $estadis = $estadis."data-volc".$con."='".$detevento->getCantidad()."'data-volr".$con."='".$volRes."' data-tpb".$con."='".$tipoboleta->getNombreTB()."'";
                            $con++;
                        }
                        $estadis = $estadis."data-tode='".$con."'";
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
                                <button type = 'button' class = 'btn btn-success' data-bs-toggle = 'modal' data-bs-target = '#estadisticas'
                                    ".$estadis."
                                >
                                <i class='bi bi-bar-chart-fill'></i>
                                </button>                            
                            </td>         
                        </tr>
                    ";
                    }           
                ?>
            </tbody>
        </table>
        </div>
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
                                                <img id="cargarAct" width="100%" src="" alt="Vista previa" class="img-fluid">
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

<div class="modal" tabindex="-1" id="estadisticas">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Estadísticas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div id='divEstadis'></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </div>
        </div>
    </div>
    </div>
    
    <div class="modal fade" id="registro" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="registroLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
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
                                    <label for="imagenReg" class="form-label">Imagen del Evento</label>
                                    <input type="file" name="imagenReg" class="form-control" id="imagenReg">
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

<script>

        $(document).ready(function(){
            $("#filtro").keyup(function(){
                let filtro = encodeURIComponent($("#filtro").val());
                url = "indexAjax.php?pid=<?php echo base64_encode("presentacion/evento/consultarEvento.php") ?>&filtro=" + filtro + "&id=<?php echo $id; ?>";
                $("#resultado").load(url);
            });
        });
        $(document).ready(function() {
    $('#estadisticas').on('show.bs.modal', function(event) {
            var contenedor = document.getElementById('divEstadis');
            contenedor.innerHTML = '';
            var button = $(event.relatedTarget);
            var tode = button.data('tode');

            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(function() {
                for (var i = 0; i < tode; i++) {
                    var divNuevo = document.createElement('div');
                    divNuevo.id = 'graf' + i;
                    divNuevo.style.width = '100%';
                    divNuevo.style.height = '300px';
                    contenedor.appendChild(divNuevo);
                    
                    drawChart(i); 
                }
            });

            function drawChart(index) {
                var data = google.visualization.arrayToDataTable([
                    ['Tipo', 'Voleta'],
                    ['En venta', button.data('volc' + index)],
                    ['Vendidas', button.data('volr' + index)]
                ]);
                var options = {
                    title: button.data('tpb'+index)
                };
                var chartPie = new google.visualization.PieChart(document.getElementById('graf' + index));
                chartPie.draw(data, options);
            }
        });
    });

        $(document).ready(function() {
            $('#actualizar').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var ideve = button.data('ideve');
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
            
                for(let i = 0; i<tamanio; i++){
                    let muestra = button.data("dete"+i);
                    console.log("dete",i);
                    contex += muestra+"<br>";
                }
                
                $(this).find('#ideventoAct').val(ideve);
                $(this).find('#nombreAct').val(nombreEve);
                $(this).find('#fechaInAct').val(fechIniEve);
                $(this).find('#fechaFinAct').val(fechFinEve);
                $(this).find('#preciobAct').val(precioEve);
                $(this).find('#idlugarAct').val(idLug);
                $(this).find('#cargarAct').attr('src', imagen);
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
        document.getElementById('imagenAct').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('cargarAct');

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

