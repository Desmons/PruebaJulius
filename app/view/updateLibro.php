<?php
session_start();
if (isset($_SESSION["administrador"])) {
    $id = $_POST["id"];
    $titulo = $_POST["titulo"];
    $autor = $_POST["autor"];
    $editor = $_POST["editor"];
    $edicion = $_POST["edicion"];
    $fechaPublicacion = $_POST["fechaPublicacion"];
    $costo = $_POST["costo"];
    $precioMinoristaSugerido = $_POST["precioMinoristaSugerido"];
    $valoracion = $_POST["valoracion"];
    $descripcion = $_POST["descripcion"];

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
                        <h1 class="h2">Actualizar Libro</h1>
                        <a href="panelLibros.php" class="btn btn-primary" >Volver</a>
                    </div>
                    <form method="post" action="../controler/actualizarLibro.php">
                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <label for="Titulo" class="col-form-label">Titulo:</label>
                                    <input class="form-control" list="listaTitulos" id="Titulo" placeholder="Titulo..." name="titulo" required value="<?php echo $titulo; ?>">
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
                                    <input class="form-control" list="listaAutores" id="Autor" placeholder="Autor..." name="autor" required value="<?php echo $autor; ?>">
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
                                    <input class="form-control" list="listaEditores" id="Editor" placeholder="Editor..." name="editor" required value="<?php echo $editor; ?>">
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
                                    <input class="form-control" list="listaEdiciones" id="Edicion" placeholder="Edicion..." name="edicion" required value="<?php echo $edicion; ?>">
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
                                    <input type="date" class="form-control" id="FechaPublicacion" name="fechaPublicacion" required value="<?php echo $fechaPublicacion; ?>">

                                </div>
                                <div class="col-sm-6">
                                    <label for="Costo" class="col-form-label">Costo:</label>
                                    <input type="number" class="form-control" id="Costo" name="costo" required value="<?php echo $costo; ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label for="PrecioMinoristaSugerido" class="col-form-label">Precio Minorista Sugerido:</label>
                                    <input type="number" class="form-control" id="PrecioMinoristaSugerido" name="precioMinoristaSugerido" required value="<?php echo $precioMinoristaSugerido; ?>">
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
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Descripción..." ><?php echo $descripcion; ?></textarea>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                
                            </div>
                            <div class="modal-footer">
                                <a href="panelLibros.php" class="btn btn-secondary" >Volver</a>
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <button type="submit" class="btn btn-primary" name="actualizar">Actualizar</button>
                            </div>
                        </form>
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