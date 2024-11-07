<?php
	$ts = gmdate("D, d M Y H:i:s") . " GMT";
	header("Expires: $ts");
	header("Last-Modified: $ts");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	
	session_start();
	//echo $_SESSION['ROLE_NAME'];

	if ($_SESSION['LOGIN_MIPA'] == FALSE ){header("Location: index.php");}
    else
       {
        if ($_SESSION['ROLE_NAME'] == "administrator") header("Location: home_admin.php");
        //if ($_SESSION['ROLE_NAME'] == "supervisor") header("Location: home_supervisor.php");
        if ($_SESSION['ROLE_NAME'] == "employee") header("Location: home_employee.php");
        }
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimun-scale=1.0">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/test_borders.css">
		<title>Sistema MIPA 2.0</title>
	</head>
<body>
	<div class = "container my_cont">

		<?php include 'includes/header.php'; ?>
		<?php include 'includes/navBar.php'; ?>
		
		<div class = "row justify-content-center my_row">
			<div class = "col-6 my_col">
				<!-- (row_!Centro!) -->
					<table class="table">
						<thead class="thead-light">
							<tr>
								<th colspan="2"><p class="my_td h5">Men&uacute; Principal (Supervisor):</p></th>
							</tr>
							<tr>
								<td colspan="2"><p class="my_td"><a class="btn btn-success btn-block" href="scripts/change_role.php">Cambiar a visor</a></p></td>
							</tr>
						</thead>
						<tr>
							<td colspan="2">
								<p class="my_td h5">Consultas:</p>
							</td>
						</tr>
						
						<tr>
						<td class="my_td"><a class="btn btn-light btn-block" href="all_system_employees.php">Consulta General</a></td>
							<td><p class="my_td"><a class="btn btn-light btn-block" href=#>Disponible</a></p></td>
						</tr>

					</table>
			</div>
		</div>

		<div class = "row justify-content-center my_row">
			<div class="col-6 justify-content-center my_col bg-secondary text-white">
				<p class="text-center font-weight-light">Descripcion Sistema</p>
			
			</div>
		</div>

		<?php include 'includes/footer.php'; ?>

	</div>
</body>
</html>