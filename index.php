<?php
session_start();

if (!isset($_SESSION["empleado"]) || !isset($_SESSION["administrador"])) {

	if (isset($_GET["estado"])) {
		if ($_GET["estado"] == "error") {
			echo '<script type="text/javascript">
					alert("error");
				</script>';
		}
	}

?>
	<!doctype html>
	<html lang="es">

	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

		<link href="css/stylo.css" rel="stylesheet" type="text/css">
		<title>Hello, world!</title>
	</head>

	<body>
		<div class="container">
			<div class="row align-items-center">
				<div class="col-sm-3"></div>
				<div class="col-sm-6">
					<div class="formLogin py-5 px-5">
					<form action="app/controler/login.php" method="post">
						<h3 class="mb-3">Iniciar sesión</h3>

						<div class="form-floating mb-2">
							<input type="email" class="form-control" id="floatingInput" placeholder="nombre@ejemplo.com" name="usuario" required>
							<label for="floatingInput">Usuario</label>
						</div>
						<div class="form-floating">
							<input type="password" class="form-control" id="floatingPassword" placeholder="Contraseña" name="contra" required>
							<label for="floatingPassword">Contraseña</label>
						</div>

						<div class="checkbox mb-3">
							<label>
								<input type="checkbox" value="remember-me"> Recuerdame
							</label>
						</div>
						<button class="w-100 btn btn-lg btn-primary" name="btnInicio" id="btnInicio" type="submit">Ingresar</button>
						<p class="mt-5 mb-3 text-muted">&copy; Fabricio Cardozo Ordoñez</p>
					</form>
					</div>
				</div>
				<div class="col-sm-3"></div>
			</div>

		</div>

		<!-- Optional JavaScript; choose one of the two! -->

		<!-- Option 1: Bootstrap Bundle with Popper -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

		<!-- Option 2: Separate Popper and Bootstrap JS -->
		<!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
	</body>

	</html>
<?php
}
if (isset($_SESSION["administrador"])) {
	header("Location: app/view/panelInicio.php");
} elseif (isset($_SESSION["empleado"])) {
	header("Location: app/view/panelEmpleado.php");
}
?>