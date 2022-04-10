<?php

	session_start();
	if (isset($_SESSION["administrador"]) || isset($_SESSION["empleado"])) {
		session_destroy();
		header("Location: ../../index.php");
	}else{
		header("Location: ../../index.php");
	}

?>