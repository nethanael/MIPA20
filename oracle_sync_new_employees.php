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
                <p class="text-center">Reporte de empleados agregados desde ORACLE:</p>
        </div>
    </div>

        <div class = "table-responsive">
            <!-- (row_!Centro!) -->
            <table id="myTable" class="table table-borderless table-hover" style="width:100%">
                <thead class="thead-dark">    
                    <tr>
                        <th><small>Acci&oacuten:</small></th>
                        <th><small>Cedula:</small></th>
                        <th><small>Nombre:</small></th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                                // Incluir archivos de conexión
                        include 'includes/connection.php';        // Retorna $conn para MySQL
                        include 'includes/oracle_connection.php'; // Retorna $oracleConn para Oracle

                        // 1. Consulta en Oracle para obtener empleados
                        $queryOracle = "SELECT cedula, nombrecompleto, email, fec_nacim,cf,nombrecf,puesto FROM rhusrprd.rs_empleados WHERE cf IN (9189)";
                        $stmtOracle = oci_parse($oracleConn, $queryOracle);
                        oci_execute($stmtOracle);

                                
                        // 3. Procesar los registros obtenidos de Oracle
                        while ($row = oci_fetch_assoc($stmtOracle)) {
                            $cedula = (string)$row['CEDULA'];
                            $nombre_completo = (string)$row['NOMBRECOMPLETO'];
                            $email = (string)$row['EMAIL'];
                            $fecha_nacim = (string)$row['FEC_NACIM'];
                            $cg = $row['CF'];
                            $nombre_cg = (string)$row['NOMBRECF'];
                            $puesto = (string)$row['PUESTO'];

                            $query = "SELECT COUNT(*) AS total FROM empleados WHERE cedula = '$cedula'";
                            $result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_assoc($result);
                            $count = $row['total']; // Extrae el valor de COUNT(*)

                            if ($count == 0) {
                                // Insertar si la cédula no existe
                                $query2 = "INSERT INTO empleados (cedula, nombre_completo, nombre_cg, email, fecha_nacim, puesto, cg) VALUES ('$cedula', '$nombre_completo', '$nombre_cg', '$email', '$fecha_nacim', '$puesto', '$cg')";
                                //echo $query2;
                                mysqli_query($conn, $query2);    
                                echo "<tr>";
                                echo "<td>"."Empleado insertado:"."</td>";
                                echo "<td>"."$cedula"."</td>";
                                echo "<td>"."$nombre_completo"."</td>";
                                echo "</tr>";
                            }
                        }

                        echo "<tr>";
                        echo "<td>"."Importación de usuarios completada."."</td>";
                        echo "</tr>";
                        // 4. Cerrar recursos
                        oci_free_statement($stmtOracle);
                        $conn->close();
                        oci_close($oracleConn);

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