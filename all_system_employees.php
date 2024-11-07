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
        //if ($_SESSION['ROLE_NAME'] == "supervisor") header("Location: home_supervisor.php");
        if ($_SESSION['ROLE_NAME'] == "employee") header("Location: home_employee.php");
        }

    $dept_code=$_SESSION['DEPT_CODE'];
    include 'includes/functions.php';

    $table="empleados";
    $fields="cedula, nombre_completo, usuarioRed, puesto";
    $whereClause="activo like 1";

    $result = db_select_simple($table, $fields, $whereClause);

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
			<div class = "table-responsive my_scrollable_div">
				<!-- (row_!Centro!) -->
                <table class="table table-sm table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th class="my_td" colspan="10">Lista completa de empleados:</th>
                        </tr>
                        <tr>
                            <td colspan="10"><small>Haga cl&iacuteck en la cedula para ver en detalle.</small></td>
                        </tr>
                    </thead>
                    <tr>
                        <th><small>C&eacutedula:</small></th>
                        <th><small>Nombre:</small></th>
                        <th><small>Usuario:</small></th>
                        <th><small>Puesto:</small></th>
                    </tr>
                        <?php                                                   //saca todos los valores de la base de datos y
                                                                                // los hace filas
                            while ($line =  $result->fetch_assoc()) 
                                {
                                    echo "<tr>";
                                    foreach ($line as $col_name => $col_value)
                                    {
                                        if ($col_name == 'task_code'){
                                            echo "<td class='my_td'><a class='btn btn-primary' href=task_detail_employee.php?data=",$col_value,">$col_value</a></td>";
                                        }
                                        if ($col_name != 'task_code'){
                                            echo "<td><small>$col_value</small></td>";
                                        }
                                    }
                                    echo "</tr>";
                                }
                        ?>     
                </table>
            </div>
        <a class="btn btn-info" href="index.php">Volver</a>
		</div>

        <?php 
             mysqli_free_result($result);
            include 'includes/footer.php'; 
        ?>

	</div>
</body>
</html>