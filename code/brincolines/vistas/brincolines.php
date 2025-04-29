<?php

$titulo = "";
$urlAPI = "";
$hasId = false;
$urlConsulta = false;
$data = null;

switch ($_GET['accion']) {
    case 'crear':
        $titulo = "Crear Brincolin";
        $urlAPI = "http://localhost:2000/servicio/brincolines/crear.php";
        break;
    case 'editar':
        $titulo = "Editar Brincolin";
        $urlAPI = "http://localhost:2000/servicio/brincolines/actualizar.php";
        $urlConsulta = "http://localhost:2000/servicio/brincolines/consultar.php?id=" . $_GET['id'];
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

                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required><br><br>

                <label for="color" class="form-label">Color:</label>
                <input type="text" name="color" id="color" class="form-control"><br><br>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                    <a href="./listar.php?tipo=brincolines" class="btn btn-secondary">Regresar</a>
                </div>
            </form>


        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
<script>
    const urlConsulta = "<?php echo $urlConsulta; ?>";
    const hasId = <?php echo $hasId ? 'true' : 'false'; ?>;

    if (hasId) {
        fetch(urlConsulta)
            .then(response => response.json())
            .then(data => {
                const registro = data[0];
                document.getElementById('nombre').value = registro.nombre_brincolin;
                document.getElementById('color').value = registro.color_brincolin;
            })
            .catch(error => console.error('Error:', error));
    }
</script>

</html>