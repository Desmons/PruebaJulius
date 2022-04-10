<?php
session_start();
if (isset($_SESSION["administrador"])) {
    require_once('../model/conexion.php');

    $con = new Conexion();
    $con->getCon();
    $nombre = null ;
    $fecha1 = null;
    $fecha2 = null;

    if (isset($_POST["nombre"])) {
        $nombre = $_POST["nombre"];
    }
    if (isset($_POST["fecha1"]) && isset($_POST["fecha2"])) {
        $fecha1 = $_POST["fecha1"];
        $fecha2 = $_POST["fecha2"];
    }
?>
    <!doctype html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Hello, world!</title>

        <link href="../../css/panel.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">LIbreria</a>
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="form-control form-control-dark "> Icons</div>
            <div class="navbar-nav">
                <div class="nav-item text-nowrap">
                    <a class="nav-link px-3" href="../model/sesionDestroy.php">Cerrar Sesión</a>
                </div>
            </div>
        </header>

        <div class="container-fluid">
            <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="panelInicio.php">
                                    <i class="fa-solid fa-house"></i>
                                    Inicio
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="panelVentas.php">
                                    <i class="fa-solid fa-sack-dollar"></i>
                                    Ventas
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="panelLibros.php">
                                    <i class="fa-solid fa-book"></i>
                                    Libros
                                </a>
                            </li>

                        </ul>
                    </div>
                </nav>

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Ventas</h1>
                    </div>
                    <form method="POST" action="">
                        <div class="row align-items-end">
                            <div class="col-sm-4">
                                <label for="search" class="col-form-label">Nombre:</label>
                                <input type="search" class="form-control" name="nombre" id="search" value="<?php echo $nombre; ?>">
                            </div>
                            <div class="col-sm-3">
                                <label for="desde" class="col-form-label">Desde:</label>
                                <input type="date" class="form-control" name="fecha1" id="desde" value="<?php echo $fecha1; ?>">
                            </div>
                            <div class="col-sm-3">
                                <label for="hasta" class="col-form-label">Hasta:</label>
                                <input type="date" class="form-control" name="fecha2" id="hasta" value="<?php echo $fecha2; ?>">
                            </div>
                            <div class="col-sm-2">
                                <input type="submit" class="btn btn-primary" value="Buscar">
                            </div>
                        </div>

                    </form>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">nombre</th>
                                    <th scope="col">apellidos</th>
                                    <th scope="col">teléfono</th>
                                    <th scope="col">correo</th>
                                    <th scope="col">libros</th>
                                    <th scope="col">fecha de compra</th>
                                    <th scope="col">valor</th>
                                    <th scope="col">empleado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                require_once('../model/conexion.php');

                                $con = new Conexion();
                                $con->getCon();

                                if ($nombre != null) {
                                    $consulta = $con->prepare("SELECT * FROM `clientes` WHERE `nombre` = :nombre");
                                    $consulta->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                                    $consulta->execute();
                                    $registro2 = $consulta->fetchAll();
                                    foreach ($registro2 as $key2 => $value2) {
                                        $consulta = $con->prepare("SELECT * FROM `ordenesdepedidos` WHERE `Clientes_idCliente`= :id");
                                        $consulta->bindParam(':id', $value2[0], PDO::PARAM_INT);
                                        $consulta->execute();
                                        $registro = $consulta->fetchAll();
                                        foreach ($registro as $key => $value) {
                                            $consulta = $con->prepare("SELECT `nombre` FROM `empleados` WHERE `idEmpleado` = :id");
                                            $consulta->bindParam(':id', $value[4], PDO::PARAM_INT);
                                            $consulta->execute();
                                            $registro3 = $consulta->fetchAll();
                                            foreach ($registro3 as $key3 => $value3) {
                                                echo "
                                                <tr>
                                                    <td>" . $value2[1] . "</td>
                                                    <td>" . $value2[2] . "</td>
                                                    <td>" . $value2[3] . "</td>
                                                    <td>" . $value2[4] . "</td>
                                                    <td>placeholder</td>
                                                    <td>" . $value[1] . "</td>
                                                    <td>" . $value[2] . "</td>
                                                    <td>" . $value3[0] . "</td>
                                                </tr>
                                                ";
                                            }
                                        }
                                        
                                        
                                    }
                                    
                                    
                                }
                                elseif ($fecha1 != null && $fecha2 != null) {
                                    $consulta = $con->prepare("SELECT * FROM `ordenesdepedidos` WHERE `fechaCompra` BETWEEN :fecha1 AND :fecha2");
                                    $consulta->bindParam(':fecha1', $fecha1, PDO::PARAM_STR);
                                    $consulta->bindParam(':fecha2', $fecha2, PDO::PARAM_STR);
                                    $consulta->execute();
                                    $registro = $consulta->fetchAll();

                                    foreach ($registro as $key => $value) {
                                        $consulta = $con->prepare("SELECT `nombre` FROM `empleados` WHERE `idEmpleado` = :id");
                                        $consulta->bindParam(':id', $value[4], PDO::PARAM_INT);
                                        $consulta->execute();
                                        $registro3 = $consulta->fetchAll();


                                        $consulta = $con->prepare("SELECT * FROM `clientes` WHERE `idCliente`= :id");
                                        $consulta->bindParam(':id', $value[3], PDO::PARAM_INT);
                                        $consulta->execute();
                                        $registro2 = $consulta->fetchAll();
                                        foreach ($registro2 as $key2 => $value2) {
                                            foreach ($registro3 as $key3 => $value3) {
                                                echo "
                                            <tr>
                                                <td>" . $value2[1] . "</td>
                                                <td>" . $value2[2] . "</td>
                                                <td>" . $value2[3] . "</td>
                                                <td>" . $value2[4] . "</td>
                                                <td>placeholder</td>
                                                <td>" . $value[1] . "</td>
                                                <td>" . $value[2] . "</td>
                                                <td>" . $value3[0] . "</td>
                                            </tr>
                                            ";
                                            }
                                        }
                                    }
                                }



                                ?>
                            </tbody>
                        </table>
                    </div>
                </main>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    </body>

    </html>
<?php
} else {
    header("Location: ../../index.php");
}
?>