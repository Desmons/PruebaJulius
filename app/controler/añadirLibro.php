<?php
session_start();
if (isset($_POST['añadir']) && isset($_SESSION["administrador"])) {

    
    require_once('../model/titulo.php');
    require_once('../model/edicion.php');
    require_once('../model/editor.php');
    require_once('../model/valoracion.php');
    require_once('../model/fechasDePublicacion.php');
    
    require_once('../model/conexion.php');
    $con = new Conexion();
	$con->getCon();

    $titulo = $_POST["titulo"];
    $autor = $_POST["autor"];
    $editor = $_POST["editor"];
    $edicion = $_POST["edicion"];
    $fechaPublicacion = $_POST["fechaPublicacion"];
    $costo = $_POST["costo"];
    $precioMinoristaSugerido = $_POST["precioMinoristaSugerido"];
    $valoracion = $_POST["valoracion"];
    $descripcion = $_POST["descripcion"];


    $objTitulo = new titulo($titulo);
	$idTitulo = $objTitulo->getId($con);

    $objEdicion = new edicion($edicion);
	$idEdicion = $objEdicion->getId($con);

    $objEditor = new editor($editor);
	$idEditor = $objEditor->getId($con);

    $objValoracion = new valoracion($valoracion);
	$idValoracion = $objValoracion->getId($con);

    $objFechaPublicacion = new fechasDePublicacion($fechaPublicacion);
	$idfechaPublicacion = $objFechaPublicacion->getId($con);
    
    $consulta = $con->prepare('
    INSERT INTO `libros`(`Titulo_idTitulo`, `Editor_idEditor`, `FechaDePublicacion_idFechaDePublicacion`, `Edicion_idEdicion`, `costo`, `precioMinoristaSugerido`,  `Valoracion_idValoracion`, `descripcion`)
    VALUES (:idTitulo,:idEditor,:fechaPublicacion,:idEdicion,:costo,:precioMinoristaSugerido,:idValoracion, :descripcion)
    ');
    $consulta->bindParam(':idTitulo', $idTitulo, PDO::PARAM_INT);
    $consulta->bindParam(':idEditor', $idEditor, PDO::PARAM_INT);
    $consulta->bindParam(':fechaPublicacion', $idfechaPublicacion, PDO::PARAM_INT);
    $consulta->bindParam(':idEdicion', $idEdicion, PDO::PARAM_INT);
    $consulta->bindParam(':costo', $costo, PDO::PARAM_INT);
    $consulta->bindParam(':precioMinoristaSugerido', $precioMinoristaSugerido, PDO::PARAM_INT);
    $consulta->bindParam(':idValoracion', $idValoracion, PDO::PARAM_INT);
    $consulta->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
    $consulta->execute();

    header("Location: ../view/panelLibros.php?estado=exito");

}else{
    header("Location: ../view/panelLibros.php?estado=Noget");
}
?>