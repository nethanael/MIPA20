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
        include 'includes/connection.php';  

// 2. Procesar el archivo CSV subido
if (isset($_FILES["archivo_csv"])) {
    $archivo = $_FILES["archivo_csv"]["tmp_name"];
    
    // Leer el CSV y extraer los identificadores
    $ids = [];
    if (($handle = fopen($archivo, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $ids[] = intval($data[0]); // Convertir a número
        }
        fclose($handle);
    }

    // Verificar si hay datos
    if (empty($ids)) {
        die("El archivo CSV no contiene identificadores válidos.");
    }

    // 3. Crear consulta SQL con IN para buscar coincidencias
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $sql = "SELECT cedula, nombre_completo, email FROM empleados WHERE cedula IN ($placeholders)";
    $stmt = $conn->prepare($sql);

    // 4. Bind dinámico de parámetros
    $types = str_repeat('i', count($ids)); // 'i' para enteros
    $stmt->bind_param($types, ...$ids);

    // 5. Ejecutar consulta y obtener resultados
    $stmt->execute();
    $result = $stmt->get_result();

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
					<p class="text-center">Lista de coincidencias contra el archivo CSV:</p>
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php   
                        
                            // 6. Construir la tabla HTML con los datos obtenidos
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>{$row['cedula']}</td>
                                        <td>{$row['nombre_completo']}</td>
                                        <td>{$row['email']}</td>
                                    </tr>";
                            }

                            echo "</table>";

                            // Cerrar conexión
                            $stmt->close();
                            $conn->close();
                        } else {
                            // 7. Mostrar formulario de subida de CSV
                            echo '<form action="test.php" method="post" enctype="multipart/form-data">
                                    <input type="file" name="archivo_csv" accept=".csv" required>
                                    <input type="submit" value="Buscar en la base de datos">
                                </form>';
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