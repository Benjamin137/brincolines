<?php

$titulo = "";
$urlAPI = "";
$hasId = false;
$urlConsulta = false;
$data = null;

switch ($_GET['accion']) {
    case 'crear':
        $titulo = "Crear Evento para el cliente";
        $urlAPI = "http://localhost:2000/servicio/eventos/crear.php";
        break;
    case 'editar':
        $titulo = "Editar Evento para el cliente";
        $urlAPI = "http://localhost:2000/servicio/eventos/actualizar.php";
        $urlConsulta = "http://localhost:2000/servicio/eventos/consultar.php?id=" . $_GET['id'];
        $hasId = true;
        break;
    default:
        $titulo = "Acción no válida";
        break;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

</head>

<body>
    <div class="container mt-5">

        <h2 id="titulo-accion"><?php echo $titulo; ?></h2>
        <hr />
        <div id="formulario-accion">
            <form action="<?php echo $urlAPI; ?>" method="POST" id="formulario-brincolin">

                <?php
                if ($hasId) {
                    $id = $_GET['id'];
                    echo "<input type='hidden' name='id' value='$id'>";
                }
                ?>

                <label for="fechaInicio" class="form-label">Fecha Inicio:</label>
                <input type="date" name="fechaInicio" id="fechaInicio" class="form-control" required><br><br>

                <label for="fechaFin" class="form-label">Fecha Inicio:</label>
                <input type="date" name="fechaFin" id="fechaFin" class="form-control" required><br><br>

                <label for="tipos_eventos_select" class="form-label">Tipo de evento:</label>
                <select name="idTipoEvento" id="tipos_eventos_select" class="form-select" required>
                    <option value="">Seleccione un tipo de evento</option>
                </select><br /><br />

                <label for="brincolines_select" class="form-label">Brincolin:</label>
                <select name="idBrincolin" id="brincolines_select" class="form-select" required>
                    <option value="">Seleccione un brincolin</option>
                </select><br /><br />

                <label for="clientes_select" class="form-label">Cliente:</label>
                <select name="idCliente" id="clientes_select" class="form-select" required>
                    <option value="">Seleccione un cliente</option>
                </select><br /><br />

                <label for="lugares_select" class="form-label">Lugar:</label>
                <select name="idLugar" id="lugares_select" class="form-select" required>
                    <option value="">Seleccione un lugar</option>
                </select><br /><br />

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                    <a href="./listar.php?tipo=eventos" class="btn btn-secondary">Regresar</a>
                </div>
            </form>


        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
<script>
    const urlConsulta = "<?php echo $urlConsulta; ?>";
    const hasId = <?php echo $hasId ? 'true' : 'false'; ?>;

    window.onload = function() {
        llenarSelects();
    };

    function obtenerEvento() {

        fetch(urlConsulta)
            .then(response => response.json())
            .then(data => {
                const registro = data[0];
                document.getElementById("fechaInicio").value = registro.fecha_inicio_evento.split(" ")[0];
                document.getElementById("fechaFin").value = registro.fecha_fin_evento.split(" ")[0];
                document.getElementById("tipos_eventos_select").value = registro.idTipoEvento_evento;
                document.getElementById("brincolines_select").value = registro.idBrincolin_evento;
                document.getElementById("clientes_select").value = registro.idCliente_evento;
                document.getElementById("lugares_select").value = registro.idLugar_evento;

            })
            .catch(error => console.error('Error:', error));

    }

    function llenarSelects() {

        const selects = ['tipos_eventos', 'brincolines', 'clientes', 'lugares'];
        selects.forEach(select => {
            fetch(`http://localhost:2000/servicio/${select}/consultar.php?select=true`)
                .then(response => response.json())
                .then(data => {
                    const selectElement = document.getElementById(select + "_select");
                    data.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.value;
                        option.textContent = item.label; // Cambia 'nombre' por el campo adecuado
                        selectElement.appendChild(option);
                    });
                    if (hasId) {
                        obtenerEvento();
                    }
                })
                .catch(error => console.error('Error:', error));
        });

    }
</script>

</html>