<?php
session_start();
if (isset($_POST['actualizar']) && isset($_SESSION["administrador"])) {

    
    require_once('../model/titulo.php');
    require_once('../model/edicion.php');
    require_once('../model/editor.php');
    require_once('../model/valoracion.php');
    require_once('../model/fechasDePublicacion.php');
    
    require_once('../model/conexion.php');
    $con = new Conexion();
	$con->getCon();

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
    UPDATE `libros` SET 
    `Titulo_idTitulo`= :titulo,
    `Editor_idEditor`= :editor,
    `FechaDePublicacion_idFechaDePublicacion`= :fecha,
    `Edicion_idEdicion`= :edicion,
    `costo`= :costo,
    `precioMinoristaSugerido`= :precioSugerido,
    `Valoracion_idValoracion`= :valoracion,
    `descripcion`= :descripcion WHERE `idLibros` = :id
    ');
    $consulta->bindParam(':id', $id, PDO::PARAM_INT);
    $consulta->bindParam(':titulo', $idTitulo, PDO::PARAM_INT);
    $consulta->bindParam(':editor', $idEditor, PDO::PARAM_INT);
    $consulta->bindParam(':fecha', $idfechaPublicacion, PDO::PARAM_INT);
    $consulta->bindParam(':edicion', $idEdicion, PDO::PARAM_INT);
    $consulta->bindParam(':costo', $costo, PDO::PARAM_INT);
    $consulta->bindParam(':precioSugerido', $precioMinoristaSugerido, PDO::PARAM_INT);
    $consulta->bindParam(':valoracion', $idValoracion, PDO::PARAM_INT);
    $consulta->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
    $consulta->execute();

    header("Location: ../view/panelLibros.php?estado=exito");

}else{
    header("Location: ../view/panelLibros.php?estado=Noget");
}
?>