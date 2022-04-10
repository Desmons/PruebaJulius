<?php
session_start();
if (isset($_POST['btnInicio'])) {
    require_once('../model/conexion.php');

    $usuario = $_POST["usuario"];
    $contra = $_POST["contra"];

    $con = new Conexion();
    $con->getCon();
    $consulta = $con->prepare('SELECT `email`, `password`, `tipo` FROM `empleados` WHERE email= :usuario AND password = :contra');

    $consulta->bindParam(':usuario', $usuario, PDO::PARAM_STR, 45);
    $consulta->bindParam(':contra', $contra, PDO::PARAM_STR, 32);
    $consulta->execute();
    $registro = $consulta->fetch();

    if ($registro[0] == $usuario && $registro[1] == $contra && $registro[2] == 1) {

        $_SESSION["empleado"] = $usuario;
        header("Location: ../view/panelEmpleado.php");
    } elseif ($registro[0] == $usuario && $registro[1] == $contra && $registro[2] == 2) {

        $_SESSION["administrador"] = $usuario;
        header("Location: ../view/panelInicio.php");
    } else {
        header("Location: ../../index.php?estado=error");
    }
} else {
    header("Location: ../../index.php?estado=Noget");
}
?>