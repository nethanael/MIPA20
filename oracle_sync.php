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
    // get Oracle data
    $result = oracle_db_select_simple($table, $fields, $whereClause);
    // Convert Data to array
    $oracle_data = oracle_db_build($result);

    //print_r($oracle_data);
    
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
                <p class="text-center">Reporte de Data sincronizada:</p>
        </div>
    </div>

        <div class = "table-responsive">
            <!-- (row_!Centro!) -->
            <table id="myTable" class="table table-borderless table-hover" style="width:100%">
                <thead class="thead-dark">    
                    <tr>
                        <th><small>C&eacutedula:</small></th>
                        <th><small>Nombre:</small></th>
                        <th><small>Puesto:</small></th>
                    </tr>
                </thead>
                <tbody>
                        <?php
                            include 'includes/connection.php';
                            // updating PFSI DB with array and show results
                            foreach ($oracle_data as $row) {
                                
                                $cedula = trim($row['CEDULA']); // trim white space
                                $nombre = trim($row['NOMBRECOMPLETO']);
                                $puesto = trim($row['PUESTO']);

                                if (empty($cedula) || empty($puesto)) {
                                    echo "Error: Datos vacíos detectados para cédula: $cedula\n";
                                    continue;
                                }
                                
                                echo "<tr>";
                                echo "<td>".$cedula."</td>";
                                echo "<td>".$nombre."</td>";
                                echo "<td>".$puesto."</td>";
                                echo "</tr>";
                                               
                                //echo $mysql_query;
                        
                                // sql update sentence
                                $query = "UPDATE empleados set puesto = '$puesto' WHERE cedula LIKE '$cedula' AND activo LIKE 1";
                                $resul = mysqli_query($conn, $query);
                        
                            }
                        ?>
                    </tbody>    
                </table>
            </div>
        <button class="btn btn-warning" onclick="exportTableToExcel('myTable', 'Datos sincronizados Oracle')">Exportar a Excel</button><br>
        <a class="btn btn-info" href="index.php">Volver</a>
		</div>


        <?php 
             mysqli_free_result($result);
            include 'includes/footer.php'; 
        ?>

	</div>
    <script src="scripts/export_report_excel.js"></script> 
</body>
</html>