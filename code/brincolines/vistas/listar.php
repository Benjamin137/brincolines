<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./listar.php?tipo=clientes">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./listar.php?tipo=brincolines">Brincolines</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./listar.php?tipo=lugares">Lugares</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./listar.php?tipo=eventos">Eventos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./listar.php?tipo=tipos_eventos">Tipos eventos</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</header>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Brincolines</h1>
        <h2 id="titulo-accion"></h2>
        <div>
            <a type="button" class="btn btn-primary m-3" id="btnAgregar" style="
            float: right;   
            ">Agregar</a>
            <table id="tabla-brincolines" class="table table-striped table-bordered table-hover">
                <thead>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
<script>
    //En funcion de queryParam tipo se cargan los datos de la tabla, columnas y el titulo
    let queryParam = new URLSearchParams(window.location.search);
    let tipo = queryParam.get("tipo");


    let columnas = {
        "brincolines": [
            "id_brincolin",
            "nombre_brincolin",
            "color_brincolin",
        ],
        "clientes": [
            "id_cliente",
            "nombreCompleto_cliente",
            "telefono_cliente",
        ],
        "lugares": [
            "id_lugar",
            "direccion_lugar",
        ],
        "eventos": [
            "id_evento",
            "folio_evento",
            "fecha_inicio_evento",
            "fecha_fin_evento",
            "nombreCompleto_cliente",
            "nombre_brincolin",
            "direccion_lugar",
        ],
        "tipos_eventos": [
            "id_tipoEvento",
            "descripcion_tipoEvento",
        ]
    }




    switch (tipo) {
        case 'brincolines':
            document.getElementById("titulo-accion").innerText = "Brincolines";
            document.getElementById("btnAgregar").addEventListener("click", function () {
                window.location.href = "./brincolines.php?accion=crear";
            });
            cargarTabla(tipo);
            break;
        case 'clientes':
            document.getElementById("titulo-accion").innerText = "Clientes";
            document.getElementById("btnAgregar").addEventListener("click", function () {
                window.location.href = "./clientes.php?accion=crear";
            });
            cargarTabla(tipo);
            break;
        case 'lugares':
            document.getElementById("titulo-accion").innerText = "Lugares";
            document.getElementById("btnAgregar").addEventListener("click", function () {
                window.location.href = "./lugares.php?accion=crear";
            });
            cargarTabla(tipo);
            break;
        case 'eventos':
            document.getElementById("titulo-accion").innerText = "Eventos";
            document.getElementById("btnAgregar").addEventListener("click", function () {
                window.location.href = "./eventos.php?accion=crear";
            });
            cargarTabla(tipo);
            break;
        case 'tipos_eventos':
            document.getElementById("titulo-accion").innerText = "Tipos de Eventos";
            document.getElementById("btnAgregar").addEventListener("click", function () {
                window.location.href = "./tipos_eventos.php?accion=crear";
            });
            cargarTabla(tipo);
            break;
        default:
            console.error("Tipo no válido");
            break;
    }


    function cargarTabla(tipo) {
        let tabla = document.getElementById("tabla-brincolines");
        let thead = tabla.querySelector("thead");
        let tbody = tabla.querySelector("tbody");

        // Limpiar el contenido previo de la tabla
        thead.innerHTML = "";
        tbody.innerHTML = "";

        // Crear encabezados de la tabla
        let tr = document.createElement("tr");
        columnas[tipo].forEach(columna => {
            let th = document.createElement("th");
            th.innerText = columna;
            tr.appendChild(th);
        });

        //Agregar columna editar y eliminar
        let th = document.createElement("th");
        th.innerText = "Acciones";
        tr.appendChild(th);
        thead.appendChild(tr);

        // Obtener datos de la API
        fetch(`http://localhost:2000/servicio/${tipo}/consultar.php`)
            .then(response => response.json())
            .then(data => {
                data.forEach(item => {
                    let tr = document.createElement("tr");
                    columnas[tipo].forEach(columna => {
                        let td = document.createElement("td");
                        td.innerText = item[columna];
                        tr.appendChild(td);
                    });

                    // Crear botones de editar y eliminar
                    let tdAcciones = document.createElement("td");
                    let btnEditar = document.createElement("button");
                    btnEditar.innerText = "Editar";
                    btnEditar.className = "btn btn-secondary m-1";
                    btnEditar.addEventListener("click", function () {
                        window.location.href = `./${tipo}.php?accion=editar&id=${item[columnas[tipo][0]]}`;
                    });
                    tdAcciones.appendChild(btnEditar);

                    let btnEliminar = document.createElement("button");
                    btnEliminar.innerText = "Eliminar";
                    btnEliminar.className = "btn btn-danger m-1";
                    tdAcciones.appendChild(btnEliminar);
                    tr.appendChild(tdAcciones);


                    tbody.appendChild(tr);
                });
            })
            .catch(error => console.error('Error al cargar los datos:', error));
    }
</script>

</html>