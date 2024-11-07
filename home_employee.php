<?php
	$ts = gmdate("D, d M Y H:i:s") . " GMT";
	header("Expires: $ts");
	header("Last-Modified: $ts");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");

	session_start();

	if ($_SESSION['LOGIN_MIPA'] == FALSE ){header("Location: index.php");}
    else
       {
        if ($_SESSION['ROLE_NAME'] == "administrator") header("Location: home_admin.php");
        if ($_SESSION['ROLE_NAME'] == "supervisor") header("Location: home_supervisor.php");
        //if ($_SESSION['ROLE_NAME'] == "employee") header("Location: home_employee.php");
        }

	$user_code = $_SESSION['USER_CODE'];
 
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
							<th class="my_td h5" colspan="2">Menu Principal de <?php echo $_SESSION['NAME'];?>:</th>
						</tr>
					</thead>
					<tr>
						<td class="my_td"><a class="btn btn-light btn-block" href=#>disponible</a></td>
						<td class="my_td"><a class="btn btn-light btn-block" href=#>disponible</a></td>
					</tr>
				</table>
				</div>
			</div>

		<div class = "row justify-content-center my_row">
			<div class = "col-6 my_col">
				<div class="p-3 mb-2 bg-success text-white">Mensaje Importante: <?php echo $_SESSION['INBOX_MSG'];?></div>
			</div>
		</div>

		<?php include 'includes/footer.php'; ?>

	</div>
</body>
</html>