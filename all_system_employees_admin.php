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
        //if ($_SESSION['ROLE_NAME'] == "administrator") header("Location: home_admin.php");
        if ($_SESSION['ROLE_NAME'] == "supervisor") header("Location: home_supervisor.php");
        if ($_SESSION['ROLE_NAME'] == "employee") header("Location: home_employee.php");
        }

    $dept_code=$_SESSION['DEPT_CODE'];
    include 'includes/functions.php';

    $table1="empleados";
    $table2="subprocesos";
    $fields="cedula, nombre_completo, nombre, usuarioRed, usuarioSAP, puesto, cg";
    $ONclause1="empleados.id=subprocesos.id";
    $whereClause="activo like 1";

    $result = db_select_1_left_query($table1, $table2, $fields, $ONclause1, $whereClause);

?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimun-scale=1.0">
		<link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/test_borders.css">

        <!-- jQuery -->
        <script src="includes/jquery-3.7.1.min.js"></script>
        <!-- DataTables CSS -->
        <link rel="stylesheet" href="css/jquery.dataTables.min.css">
        <!-- DataTables JS -->
        <script src="includes/jquery.dataTables.min.js"></script>

        <title>Sistema MIPA 2.0</title>
	</head>
<body>
	<div class = "container my_cont">

	<?php include 'includes/header.php'; ?>
	<?php include 'includes/navBar.php'; ?>
          
	<div class = "row justify-content-center my_row">

		<div class = "row justify-content-center my_row">
			<div class = "col-12 my_col">
					<!--(row_!Titulo!)-->
					<p class="text-center">Lista General de empleados SFI:</p>
			</div>
		</div>

			<div class = "table-responsive">
				<!-- (row_!Centro!) -->
                <table id="myTable" class="table table-borderless table-hover" style="width:100%">
                    <thead class="thead-dark">    
                        <tr>
                        <th><small>C&eacutedula:</small></th>
                            <th><small>Nombre:</small></th>
                            <th><small>Subproceso:</small></th>
                            <th><small>Usuario de RED:</small></th>
                            <th><small>Usuario de SAP:</small></th>
                            <th><small>Puesto:</small></th>
                            <th><small>Centro Gesti&oacuten:</small></th>
                        </tr>
                    </thead>
                    <tbody>
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
                    </tbody>    
                </table>
            </div>
        <button class="btn btn-warning" onclick="exportTableToExcel('myTable', 'Empleados_MIPA')">Exportar a Excel</button><br>
        <a class="btn btn-info" href="index.php">Volver</a>
		</div>


        <?php 
             mysqli_free_result($result);
            include 'includes/footer.php'; 
        ?>

	</div>
    <script>

        $('#myTable').DataTable({
            paging: true,
            searching: true,
            ordering:false,
            pageLength: 20, // Número de registros por página
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/Spanish.json' // Para traducir al español
            }
        });

        $(document).ready(function() {
            $('#myTable').DataTable();
        });

    </script>
    <script src="scripts/export_report_excel.js"></script> 
</body>
</html>