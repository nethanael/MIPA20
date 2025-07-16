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

    $placa = $_GET['data']; 
    include 'includes/functions.php';

//------------------First query-------------------------------

    $table1="vehiculos";
    $table2="empleados";
    $table3="subprocesos";

    $fields="vehiculos.placa, empleados.nombre_completo, empleados.email, subprocesos.nombre";

    $ONclause1="vehiculos.digitador_ETM_1=empleados.cedula";
    $ONclause2="empleados.id=subprocesos.id";

    $whereClause="vehiculos.placa=$placa";

    $result = db_select_2_inner_query($table1, $table2, $table3, $fields, $ONclause1, $ONclause2, $whereClause);
    $data1 = mysqli_fetch_assoc($result);
    
	$placa = $data1["placa"];
    $digitador_ETM_1_nombre = $data1['nombre_completo'];
    $digitador_ETM_1_email = $data1['email'];
    $digitador_ETM_1_subproceso = $data1['nombre'];

    //$ = $data[''];

    mysqli_free_result($result);

    //------------------second query-------------------------------

    $table1="vehiculos";
    $table2="empleados";
    $table3="subprocesos";

    $fields="vehiculos.placa, empleados.nombre_completo, empleados.email, subprocesos.nombre";

    $ONclause1="vehiculos.digitador_ETM_2=empleados.cedula";
    $ONclause2="empleados.id=subprocesos.id";

    $whereClause="vehiculos.placa=$placa";

    $result = db_select_2_inner_query($table1, $table2, $table3, $fields, $ONclause1, $ONclause2, $whereClause);
    $data2 = mysqli_fetch_assoc($result);
    
	//$placa = $data["placa"];
    $digitador_ETM_2_nombre = $data2['nombre_completo'];
    $digitador_ETM_2_email = $data2['email'];
    $digitador_ETM_2_subproceso = $data2['nombre'];

    //$ = $data[''];

    mysqli_free_result($result);

        //------------------third query-------------------------------

    $table1="vehiculos";
    $table2="empleados";
    $table3="subprocesos";

    $fields="vehiculos.placa, empleados.nombre_completo, empleados.email, subprocesos.nombre";

    $ONclause1="vehiculos.digitador_ETM_3=empleados.cedula";
    $ONclause2="empleados.id=subprocesos.id";

    $whereClause="vehiculos.placa=$placa";

    $result = db_select_2_inner_query($table1, $table2, $table3, $fields, $ONclause1, $ONclause2, $whereClause);
    $data3 = mysqli_fetch_assoc($result);
    
	//$placa = $data["placa"];
    $digitador_ETM_3_nombre = $data3['nombre_completo'];
    $digitador_ETM_3_email = $data3['email'];
    $digitador_ETM_3_subproceso = $data3['nombre'];

    //$ = $data[''];

    mysqli_free_result($result);

            //------------------fourth query-------------------------------

    $table1="vehiculos";
    $table2="empleados";
    $table3="subprocesos";

    $fields="vehiculos.placa, empleados.nombre_completo, empleados.email, subprocesos.nombre";

    $ONclause1="vehiculos.elaborador_fact_ETM_1=empleados.cedula";
    $ONclause2="empleados.id=subprocesos.id";

    $whereClause="vehiculos.placa=$placa";

    $result = db_select_2_inner_query($table1, $table2, $table3, $fields, $ONclause1, $ONclause2, $whereClause);
    $data4 = mysqli_fetch_assoc($result);
    
	//$placa = $data["placa"];
    $elaborador_fact_ETM_1_nombre = $data4['nombre_completo'];
    $elaborador_fact_ETM_1_email = $data4['email'];
    $elaborador_fact_ETM_1_subproceso = $data4['nombre'];

    //$ = $data[''];

    mysqli_free_result($result);

                //------------------fifth query-------------------------------

    $table1="vehiculos";
    $table2="empleados";
    $table3="subprocesos";

    $fields="vehiculos.placa, empleados.nombre_completo, empleados.email, subprocesos.nombre";

    $ONclause1="vehiculos.elaborador_fact_ETM_2=empleados.cedula";
    $ONclause2="empleados.id=subprocesos.id";

    $whereClause="vehiculos.placa=$placa";

    $result = db_select_2_inner_query($table1, $table2, $table3, $fields, $ONclause1, $ONclause2, $whereClause);
    $data5 = mysqli_fetch_assoc($result);
    
	//$placa = $data["placa"];
    $elaborador_fact_ETM_2_nombre = $data5['nombre_completo'];
    $elaborador_fact_ETM_2_email = $data5['email'];
    $elaborador_fact_ETM_2_subproceso = $data5['nombre'];

    //$ = $data[''];

    mysqli_free_result($result);

                    //------------------sixth query-------------------------------

    $table1="vehiculos";
    $table2="empleados";
    $table3="subprocesos";

    $fields="vehiculos.placa, empleados.nombre_completo, empleados.email, subprocesos.nombre";

    $ONclause1="vehiculos.elaborador_fact_ETM_3=empleados.cedula";
    $ONclause2="empleados.id=subprocesos.id";

    $whereClause="vehiculos.placa=$placa";

    $result = db_select_2_inner_query($table1, $table2, $table3, $fields, $ONclause1, $ONclause2, $whereClause);
    $data6 = mysqli_fetch_assoc($result);
    
	//$placa = $data["placa"];
    $elaborador_fact_ETM_3_nombre = $data6['nombre_completo'];
    $elaborador_fact_ETM_3_email = $data6['email'];
    $elaborador_fact_ETM_3_subproceso = $data6['nombre'];

    //$ = $data[''];

    mysqli_free_result($result);

                        //------------------seventh query-------------------------------

    $table1="vehiculos";
    $table2="empleados";
    $table3="subprocesos";

    $fields="vehiculos.placa, empleados.nombre_completo, empleados.email, subprocesos.nombre";

    $ONclause1="vehiculos.elaborador_fact_ETM_4=empleados.cedula";
    $ONclause2="empleados.id=subprocesos.id";

    $whereClause="vehiculos.placa=$placa";

    $result = db_select_2_inner_query($table1, $table2, $table3, $fields, $ONclause1, $ONclause2, $whereClause);
    $data7 = mysqli_fetch_assoc($result);
    
	//$placa = $data["placa"];
    $elaborador_fact_ETM_4_nombre = $data7['nombre_completo'];
    $elaborador_fact_ETM_4_email = $data7['email'];
    $elaborador_fact_ETM_4_subproceso = $data7['nombre'];

    //$ = $data[''];

    mysqli_free_result($result);

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

			<div class = "col-12 my_col">
				<!-- (row_!Centro!) -->
                 <p class="text-center">Digitadores:</p>
                <form method="POST" action="">
                    <div class="form-group">

                    <!-- bloque 1 -->  
                    <?php 
                        if ($data1): { ?>
                        <small class="form-text text-success">Digitador ETM 1.</small><br>

                        <label for="fname">Placa:</label><br>
                        <input type="text" class="form-control" id="placa" name="placa" value="<?php echo $placa;?>"readonly><br>
                        
                        <label for="fname">Nombre Digitador ETM 1:</label><br>
                        <input type="text" class="form-control" id="nombre_digitador_ETM_1" name="nombre_digitador_ETM_1" value="<?php echo $digitador_ETM_1_nombre;?>"readonly><br>

                        <label for="fname">Email Digitador ETM 1:</label><br>
                        <input type="text" class="form-control" id="digitador_ETM_1_email" name="digitador_ETM_1_email" value="<?php echo $digitador_ETM_1_email;?>"readonly><br>
                    
                        <label for="fname">Subproceso:</label><br>
                        <input type="text" class="form-control" id="digitador_ETM_1_subproceso" name="digitador_ETM_1_subproceso" value="<?php echo $digitador_ETM_1_subproceso;?>"readonly><br>
                    <?php    
                        }
                            else: echo '<small class="form-text text-danger">No existe digitador ETM 1.</small><br>';
                        endif;
                    ?>                    
                    <!-- bloque 2-->  
                    <?php 
                        if ($data2): { ?>
                        <small class="form-text text-success">Digitador ETM 2.</small><br>

                        <label for="fname">Nombre Digitador ETM 2:</label><br>
                        <input type="text" class="form-control" id="nombre_digitador_ETM_2" name="nombre_digitador_ETM_2" value="<?php echo $digitador_ETM_2_nombre;?>"readonly><br>

                        <label for="fname">Email Digitador ETM 2:</label><br>
                        <input type="text" class="form-control" id="digitador_ETM_2_email" name="digitador_ETM_2_email" value="<?php echo $digitador_ETM_2_email;?>"readonly><br>
                    
                        <label for="fname">Subproceso:</label><br>
                        <input type="text" class="form-control" id="digitador_ETM_2_subproceso" name="digitador_ETM_2_subproceso" value="<?php echo $digitador_ETM_2_subproceso;?>"readonly><br>
                  <?php    
                        }
                            else: echo '<small class="form-text text-danger">No existe digitador ETM 2.</small><br>';
                        endif;
                    ?>
                    <!-- bloque 3-->  
                    <?php 
                        if ($data3): { ?>
                        <small class="form-text text-success">Digitador ETM 3.</small><br>
                          
                        <label for="fname">Nombre Digitador ETM 3:</label><br>
                        <input type="text" class="form-control" id="nombre_digitador_ETM_3" name="nombre_digitador_ETM_3" value="<?php echo $digitador_ETM_3_nombre;?>"readonly><br>

                        <label for="fname">Email Digitador ETM 3:</label><br>
                        <input type="text" class="form-control" id="digitador_ETM_3_email" name="digitador_ETM_3_email" value="<?php echo $digitador_ETM_3_email;?>"readonly><br>
                    
                        <label for="fname">Subproceso:</label><br>
                        <input type="text" class="form-control" id="digitador_ETM_3_subproceso" name="digitador_ETM_3_subproceso" value="<?php echo $digitador_ETM_3_subproceso;?>"readonly><br>
                    <?php    
                        }
                            else: echo '<small class="form-text text-danger">No existe digitador ETM 3.</small><br>';
                        endif;
                    ?>
                    <p class="text-center">Elaboradores:</p>
                    <!-- bloque 4 --> 
                    <?php 
                        if ($data4): { ?>
                        <small class="form-text text-success">Elaborador Factura ETM 1.</small><br>
                          
                        <label for="fname">Nombre Elaborador de Factura ETM 1:</label><br>
                        <input type="text" class="form-control" id="elaborador_fact_ETM_1_nombre" name="elaborador_fact_ETM_1" value="<?php echo $elaborador_fact_ETM_1_nombre;?>"readonly><br>

                        <label for="fname">Email Digitador ETM 1:</label><br>
                        <input type="text" class="form-control" id="elaborador_fact_ETM_1_email" name="elaborador_fact_ETM_1_email" value="<?php echo $elaborador_fact_ETM_1_email;?>"readonly><br>
                    
                        <label for="fname">Subproceso:</label><br>
                        <input type="text" class="form-control" id="elaborador_fact_ETM_1_subproceso" name="elaborador_fact_ETM_1_subproceso" value="<?php echo $elaborador_fact_ETM_1_subproceso;?>"readonly><br>
                    <?php    
                        }
                            else: echo '<small class="form-text text-danger">No existe elaborador de Factura ETM 1.</small><br>';
                        endif;
                    ?>

                    <!-- bloque 5 --> 
                    <?php 
                        if ($data5): { ?>
                        <small class="form-text text-success">Elaborador Factura ETM 2.</small><br>
                          
                        <label for="fname">Nombre Elaborador de Factura ETM 2:</label><br>
                        <input type="text" class="form-control" id="elaborador_fact_ETM_2_nombre" name="elaborador_fact_ETM_2" value="<?php echo $elaborador_fact_ETM_2_nombre;?>"readonly><br>

                        <label for="fname">Email Digitador ETM 2:</label><br>
                        <input type="text" class="form-control" id="elaborador_fact_ETM_2_email" name="elaborador_fact_ETM_2_email" value="<?php echo $elaborador_fact_ETM_2_email;?>"readonly><br>
                    
                        <label for="fname">Subproceso:</label><br>
                        <input type="text" class="form-control" id="elaborador_fact_ETM_2_subproceso" name="elaborador_fact_ETM_2_subproceso" value="<?php echo $elaborador_fact_ETM_2_subproceso;?>"readonly><br>
                    <?php    
                        }
                            else: echo '<small class="form-text text-danger">No existe elaborador de Factura ETM 2.</small><br>';
                        endif;
                    ?>

                    <!-- bloque 6 --> 

                    <?php 
                        if ($data6): { ?>
                        <small class="form-text text-success">Elaborador Factura ETM 3.</small><br>
                          
                        <label for="fname">Nombre Elaborador de Factura ETM 3:</label><br>
                        <input type="text" class="form-control" id="elaborador_fact_ETM_3_nombre" name="elaborador_fact_ETM_3" value="<?php echo $elaborador_fact_ETM_3_nombre;?>"readonly><br>

                        <label for="fname">Email Digitador ETM 3:</label><br>
                        <input type="text" class="form-control" id="elaborador_fact_ETM_3_email" name="elaborador_fact_ETM_3_email" value="<?php echo $elaborador_fact_ETM_3_email;?>"readonly><br>
                    
                        <label for="fname">Subproceso:</label><br>
                        <input type="text" class="form-control" id="elaborador_fact_ETM_3_subproceso" name="elaborador_fact_ETM_3_subproceso" value="<?php echo $elaborador_fact_ETM_3_subproceso;?>"readonly><br>
                    <?php    
                        }
                            else: echo '<small class="form-text text-danger">No existe elaborador de Factura ETM 3.</small><br>';
                        endif;
                    ?>

                    <!-- bloque 7 --> 

                    <?php 
                        if ($data7): { ?>
                            <small class="form-text text-success">Elaborador Factura ETM 4.</small><br>
                            
                            <label for="fname">Nombre Elaborador de Factura ETM 4:</label><br>
                            <input type="text" class="form-control" id="elaborador_fact_ETM_4_nombre" name="elaborador_fact_ETM_4" value="<?php echo $elaborador_fact_ETM_4_nombre;?>"readonly><br>

                            <label for="fname">Email Digitador ETM 4:</label><br>
                            <input type="text" class="form-control" id="elaborador_fact_ETM_4_email" name="elaborador_fact_ETM_4_email" value="<?php echo $elaborador_fact_ETM_4_email;?>"readonly><br>
                        
                            <label for="fname">Subproceso:</label><br>
                            <input type="text" class="form-control" id="elaborador_fact_ETM_4_subproceso" name="elaborador_fact_ETM_4_subproceso" value="<?php echo $elaborador_fact_ETM_4_subproceso;?>"readonly><br>
                    <?php    
                        }
                            else: echo '<small class="form-text text-danger">No existe elaborador de Factura ETM 4.</small><br>';
                        endif;
                    ?>


                    </div>
                </form> 
            </div>
    
            <a class="btn btn-info" href="vehicles_supervisor.php">Volver</a>
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