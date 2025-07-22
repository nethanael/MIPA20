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

    $table1="vehiculos";
    $table2="empleados";
    $table3="subprocesos";
    $table4="subprocesos";

    // como se repite la tabla 3 y 4 se deben usar alias tanto en los nombres de los campos como en el onclause3

    $fields="vehiculos.placa, vehiculos.numero_SAP, vehiculos.CMA, vehiculos.tipo, vehiculos.ano, vehiculos.asignado_a, 
    empleados.nombre_completo, table4.nombre nombre_1, subprocesos.nombre nombre_2, 
    vehiculos.estado_extintor, vehiculos.extintor_cod_SAP, vehiculos.numero_vale, vehiculos.prioridad_sustitucion,
    vehiculos.observaciones";

    $ONclause1="vehiculos.asignado_a=empleados.cedula";
    $ONclause2="subprocesos.id=empleados.id";
    $ONclause3="table4.id=empleados.idJefeN";
    
    $whereClause="vehiculos.activo like 1";


    $result = db_select_3_inner_query($table1, $table2, $table3, $table4, $fields, $ONclause1, $ONclause2, $ONclause3, $whereClause);

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
					<p class="text-center">Veh&iacuteculos SFI:</p>
			</div>
		</div>

			<div class = "table-responsive">
				<!-- (row_!Centro!) -->
                <table id="myTable" class="table table-sm table-hover" style="width:100%">
                    <thead class="thead-dark">    
                        <tr>
                            <th><small>Placa:</small></th>
                            <th><small>C&oacutedigo SAP:</small></th>
                            <th><small>CMA:</small></th>
                            <th><small>Tipo:</small></th>
                            <th><small>A&ntildeo:</small></th>
                            <th><small>Asignado a:</small></th>
                            <th><small>Nombre:</small></th>
                            <th><small>Subproceso 1:</small></th>
                            <th><small>Subproceso 2:</small></th>
                            <!-- <th><small>Sustituir:</small></th> -->
                            <!-- <th><small>Prioridad:</small></th> -->
                            <th><small>Estado Extintor:</small></th>
                            <th><small>Cod. SAP:</small></th>
                            <th><small># Vale:</small></th>
                            <!-- <th><small>Sustituci&oacuten:</small></th> -->
                            <!-- <th><small>Prioridad:</small></th> -->
                             <th><small>Prioridad Sustituci&oacuten:</small></th>
                            <th><small>Observaciones:</small></th>
                            <th><small>ETM info:</small></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    //saca todos los valores de la base de datos y
                    // Verificar si hubo un error en la consulta
                    if (!$result) {
                        die("<tr><td colspan='100%'>Error en la consulta: " . mysqli_error($conn) . "</td></tr>");
                    }
                    // Verifica si hay resultados
                    if ($result->num_rows > 0) {
                        // Recorre cada fila del resultado
                        while ($line = $result->fetch_assoc()) {
                            echo "<tr>";

                            foreach ($line as $col_name => $col_value) {
                                // Escapa el valor para evitar XSS
                                $safe_value = htmlspecialchars($col_value, ENT_QUOTES, 'UTF-8');

                                switch ($col_name) {
                                    case 'placa':
                                        echo "<td class='my_td'><a class='btn btn-primary' style='font-size: 10px;' href='vehicle_details.php?data={$safe_value}'>{$safe_value}</a></td>";
                                        $placa_temp = $safe_value;
                                        break;

                                    case 'asignado_a':
                                        echo "<td><a class='btn btn-warning' style='font-size: 10px; href='employee_details.php?data={$safe_value}'>{$safe_value}</a></td>";
                                        break;

                                    default:
                                        echo "<td><small style='font-size: 10px;'>{$safe_value}</small></td>";
                                        break;
                                }
                            }
                            echo "<td class='my_td'><a class='btn btn-primary' style='font-size: 10px;' href='vehicle_etm_details.php?data={$placa_temp}'>Consultar ETM</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='100%'>No hay datos disponibles</td></tr>";
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
            pageLength: 100, // Número de registros por página
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