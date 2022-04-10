<?php
session_start();
if (isset($_SESSION["administrador"])) {
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
                                <a class="nav-link" href="panelVentas.php">
                                    <i class="fa-solid fa-sack-dollar"></i>
                                    Ventas
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="panelLibros.php">
                                    <i class="fa-solid fa-book"></i>
                                    Libros
                                </a>
                            </li>

                        </ul>
                    </div>
                </nav>

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Libros</h1>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Añadir Nuevo Libro</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Titulo</th>
                                    <th scope="col">Autores</th>
                                    <th scope="col">Editor</th>
                                    <th scope="col">Publicación</th>
                                    <th scope="col">Edicion</th>
                                    <th scope="col">Costo</th>
                                    <th scope="col">Precio Minorista</th>
                                    <th scope="col">Valoracion</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                require_once('../model/conexion.php');
                                require_once('../model/titulo.php');
                                require_once('../model/edicion.php');
                                require_once('../model/editor.php');
                                require_once('../model/valoracion.php');
                                require_once('../model/fechasDePublicacion.php');

                                $con = new Conexion();
                                $con->getCon();

                                

                                $consulta = $con->prepare('SELECT `idTitulo`, `titulo` FROM `titulos` ORDER BY `titulo` ASC');
                                $consulta->execute();
                                $registro = $consulta->fetchAll();

                                

                                foreach ($registro as $key => $value) {
                                    $consulta = $con->prepare('SELECT * FROM `libros` WHERE `Titulo_idTitulo` = :idTitulo');
                                    $consulta->bindParam(':idTitulo', $value[0], PDO::PARAM_INT);
                                    $consulta->execute();
                                    $registro2 = $consulta->fetchAll();
                                    
                                    
                                    foreach ($registro2 as $key2 => $value2) {

                                        $objEditor = new editor(null , $value2[2]);
	                                    $idEditor = $objEditor->getEditor($con);

                                        $objFechaPublicacion = new fechasDePublicacion(null , $value2[3]);
	                                    $idfechaPublicacion = $objFechaPublicacion->getFechaDePublicacion($con);

                                        $objEdicion = new edicion(null , $value2[4]);
	                                    $idEdicion = $objEdicion->getEdicion($con);

                                        $objValoracion = new valoracion(null , $value2[7]);
	                                    $idValoracion = $objValoracion->getValoracion($con);

                                        
                                        echo '
                                        <tr>
                                            <td>'.$value2[0].'</td>
                                            <td>'.$value[1].'</td>
                                            <td>'.$value2[0].'</td>
                                            <td>'.$idEditor.'</td>
                                            <td>'.$idfechaPublicacion.'</td>
                                            <td>'.$idEdicion.'</td>
                                            <td>'.$value2[5].'</td>
                                            <td>'.$value2[6].'</td>
                                            <td>'.$idValoracion.'</td>
                                            <td>'.$value2[8].'</td>
                                            <td>
                                            <form method="POST" action="updateLibro.php">
                                                <input type="hidden" name="id" value="'.$value2[0].'">
                                                <input type="hidden" name="titulo" value="'.$value[1].'">
                                                <input type="hidden" name="autor" value="'.$value2[0].'">
                                                <input type="hidden" name="editor" value="'.$idEditor.'">
                                                <input type="hidden" name="edicion" value="'.$idEdicion.'">
                                                <input type="hidden" name="costo" value="'.$value2[5].'">
                                                <input type="hidden" name="fechaPublicacion" value="'.$idfechaPublicacion.'">
                                                <input type="hidden" name="precioMinoristaSugerido" value="'.$value2[6].'">
                                                <input type="hidden" name="valoracion" value="'.$idValoracion.'">
                                                <input type="hidden" name="descripcion" value="'.$value2[8].'">
                                                <input type="submit" class="btn btn-primary" name="editar" value="Editar">
                                            </form>
                                            </td>
                                        </tr>
                                        ';
                                    }
                                }

                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                </main>
            </div>
        </div>
        
        <!-- MODAL -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nuevo Libro</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="../controler/añadirLibro.php">
                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <label for="Titulo" class="col-form-label">Titulo:</label>
                                    <input class="form-control" list="listaTitulos" id="Titulo" placeholder="Titulo..." name="titulo" required>
                                    <datalist id="listaTitulos">
                                        <option value="San Francisco">
                                        <option value="New York">
                                        <option value="Seattle">
                                        <option value="Los Angeles">
                                        <option value="Chicago">
                                    </datalist>
                                </div>
                                <div class="col-sm-6">
                                    <label for="Autor" class="col-form-label">Autor:</label>
                                    <input class="form-control" list="listaAutores" id="Autor" placeholder="Autor..." name="autor" required>
                                    <datalist id="listaAutores">
                                        <option value="San Francisco">
                                        <option value="New York">
                                        <option value="Seattle">
                                        <option value="Los Angeles">
                                        <option value="Chicago">
                                    </datalist>
                                </div>
                                <div class="col-sm-6">
                                    <label for="Editor" class="col-form-label">Editor:</label>
                                    <input class="form-control" list="listaEditores" id="Editor" placeholder="Editor..." name="editor" required>
                                    <datalist id="listaEditores">
                                        <option value="San Francisco">
                                        <option value="New York">
                                        <option value="Seattle">
                                        <option value="Los Angeles">
                                        <option value="Chicago">
                                    </datalist>
                                </div>
                                <div class="col-sm-6">
                                    <label for="Edicion" class="col-form-label">Edicion:</label>
                                    <input class="form-control" list="listaEdiciones" id="Edicion" placeholder="Edicion..." name="edicion" required>
                                    <datalist id="listaEdiciones">
                                        <option value="San Francisco">
                                        <option value="New York">
                                        <option value="Seattle">
                                        <option value="Los Angeles">
                                        <option value="Chicago">
                                    </datalist>
                                </div>
                                <div class="col-sm-6">
                                    <label for="FechaPublicacion" class="col-form-label">Fecha Publicación:</label>
                                    <input type="date" class="form-control" id="FechaPublicacion" name="fechaPublicacion" required>

                                </div>
                                <div class="col-sm-6">
                                    <label for="Costo" class="col-form-label">Costo:</label>
                                    <input type="number" class="form-control" id="Costo" name="costo" required>
                                </div>
                                <div class="col-sm-6">
                                    <label for="PrecioMinoristaSugerido" class="col-form-label">Precio Minorista Sugerido:</label>
                                    <input type="number" class="form-control" id="PrecioMinoristaSugerido" name="precioMinoristaSugerido" required>
                                </div>
                                <div class="col-sm-4">
                                    <label for="valoracion" class="col-form-label">Valoración:</label>
                                    <select class="form-select" id="valoracion" name="valoracion" aria-label="select of valoration">
                                        <option selected>Abre el menu</option>
                                        <option value="extraordinario">Extraordinario</option>
                                        <option value="excelente">Excelente</option>
                                        <option value="bueno">Bueno</option>
                                        <option value="dañado">Dañado</option>
                                    </select>
                                </div>
                                <div class="col-sm-8">
                                    <label for="descripcion" class="col-form-label">Descripción:</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Descripción..."></textarea>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary" name="añadir">Añadir</button>
                            </div>
                        </form>
                    </div>

                </div>
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