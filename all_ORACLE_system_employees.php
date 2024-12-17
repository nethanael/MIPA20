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

    $table="rhusrprd.rs_empleados";
    $fields="cedula, nombrecompleto, email, fec_nacim, cf, nombrecf, puesto";
    $whereClause="cf IN (9189)";
    
    $result = oracle_db_select_simple($table, $fields, $whereClause);
    //echo $result;

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
					<p class="text-center">Lista General de empleados SFI (oracle BD RH):</p>
			</div>
		</div>

			<div class = "table-responsive">
				<!-- (row_!Centro!) -->
                <table id="myTable" class="table table-borderless table-hover" style="width:100%">
                    <thead class="thead-dark">    
                        <tr>
                            <th><small>C&eacutedula:</small></th>
                            <th><small>Nombre:</small></th>
                            <th><small>Email:</small></th>
                            <th><small>Puesto:</small></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php           
                            while (($row = oci_fetch_assoc($result)) != false) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['CEDULA']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['NOMBRECOMPLETO']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['EMAIL']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['PUESTO']) . "</td>";
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