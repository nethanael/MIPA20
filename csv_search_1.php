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
           
                
                <div class = "col-12 my_col">
                        <!--(row_!Titulo!)-->
                        <p class="text-center">Subir archivo CSV para busqueda</p>
                </div>

                <table>
                    <tr>
                        <td colspan="4">El sistema permite buscar información en la base de datos a partir de un archivo CSV que contiene una lista de cédulas. Para garantizar un correcto funcionamiento, siga estas instrucciones:</td>
                    </tr>
                    <tr>
                        <td>Formato correcto del CSV:</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>                        
                            <ul>
                                <li>El archivo debe estar en formato .csv (Valores Separados por Comas).</li>
                                <li>Cada línea del archivo debe contener únicamente una cédula.</li>
                                <li>No debe tener encabezados ni columnas adicionales.</li>
                                <li>Las cédulas deben estar limpias, sin caracteres especiales ni espacios adicionales.</li>    
                            </ul>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>                        
                            <form action="csv_search_2.php" method="post" enctype="multipart/form-data">
                                <input type="file" name="archivo_csv" accept=".csv" required>
                                <input type="submit" value="Buscar en la base de datos">
                            </form>
                        </td>
                        <td></td>
                    </tr>
                </table>
            <a class="btn btn-info" href="index.php">Volver</a>            
        </div>

        <?php 
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