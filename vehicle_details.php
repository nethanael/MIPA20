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

    //$dept_code=$_SESSION['DEPT_CODE'];
    $placa = $_GET['data']; 
    include 'includes/functions.php';

//------------------First query-------------------------------

    $table1="vehiculos";
    $table2="empleados";
    $table3="subprocesos";

    //$users_table="infoapp_users";
    //$perf_goal_table="infoapp_performance_goals";

    $fields="vehiculos.placa, vehiculos.numero_SAP, vehiculos.zona_atendida, vehiculos.CMA, vehiculos.tipo, 
    vehiculos.ano, vehiculos.asignado_a, empleados.nombre_completo, empleados.email, subprocesos.nombre, 
    vehiculos.estado_extintor, vehiculos.extintor_cod_SAP, vehiculos.numero_vale, vehiculos.observaciones, 
    vehiculos.para_sustituir, vehiculos.prioridad_sustitucion, vehiculos.activo";

    $ONclause1="vehiculos.asignado_a=empleados.cedula";
    $ONclause2="subprocesos.id=empleados.id";

    $whereClause="vehiculos.placa=$placa";

    $result = db_select_2_inner_query($table1, $table2, $table3, $fields, $ONclause1, $ONclause2, $whereClause);
    $data = mysqli_fetch_assoc($result);
    
	$placa = $data["placa"];
    $numero_SAP = $data['numero_SAP'];
    $zona_atendida = $data['zona_atendida'];
    $CMA = $data['CMA'];
    $tipo = $data['tipo'];
    $ano = $data['ano'];
    $asignado_a = $data['asignado_a'];
    $nombre_completo = $data["nombre_completo"];
    $email = $data["email"];
    $subproceso_nombre = $data["nombre"]; 
    $estado_extintor = $data['estado_extintor'];
    $extintor_cod_SAP = $data['extintor_cod_SAP'];
    $numero_vale= $data['numero_vale'];
    $observaciones = $data['observaciones'];
    $para_sustituir = $data['para_sustituir'];
    $prioridad_sustitucion = $data['prioridad_sustitucion'];
    $activo = $data['activo'];
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
                <form method="POST" action="update_vehicle.php">
                    <div class="form-group">

                        <label for="fname">Placa:</label><br>
                        <input type="text" class="form-control" id="placa" name="placa" value="<?php echo $placa;?>"readonly><br>
                        
                        <label for="fname">N&uacutemero SAP:</label><br>
                        <input type="text" class="form-control" id="numero_SAP" name="numero_SAP" value="<?php echo $numero_SAP;?>"><br>
                        
                        <label for="fname">Zona que atiende:</label><br>
                        <input type="text" class="form-control" id="zona_atendida" name="zona_atendida" value="<?php echo $zona_atendida;?>"><br>
                        
                        <label for="fname">CMA:</label><br>
                        <input type="text" class="form-control" id="CMA" name="CMA" value="<?php echo $CMA;?>"><br>
                        
                        <label for="fname">Tipo:</label><br>
                        <input type="text" class="form-control" id="tipo" name="tipo" value="<?php echo $tipo;?>"><br>
                        
                        <label for="fname">A&ntildeo:</label><br>
                        <input type="text" class="form-control" id="ano" name="ano" value="<?php echo $ano;?>"><br>
                        
                        <label for="fname">Asignado a:</label><br>
                        <small class="form-text text-muted">Al cambiar cedula cambia los datos asociados a esta. Cedula debe estar ya ingresada en el sistema.</small><br>
                        <input type="text" class="form-control" id="asignado_a" name="asignado_a" value="<?php echo $asignado_a;?>"><br>

                        <label for="lname">Nombre:</label><br>
                        <input type="text" class="form-control" id="nombre_completo" name="nombre_completo" value="<?php echo $nombre_completo;?>"readonly><br>
                        
                        <label for="lname">Email:</label><br>
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $email;?>"readonly><br>

                        <label for="lname">Subproceso:</label><br>
                        <input type="text" class="form-control" id="subproceso_nombre" name="subproceso_nombre" value="<?php echo $subproceso_nombre;?>"readonly><br>
                    
                        <label for="lname">Extintor:</label><br>
                        <input type="text" class="form-control" id="estado_extintor" name="estado_extintor" value="<?php echo $estado_extintor;?>"><br>
                    
                        <label for="lname">Extintor Cod. SAP:</label><br>
                        <input type="text" class="form-control" id="extintor_cod_SAP" name="extintor_cod_SAP" value="<?php echo $extintor_cod_SAP;?>"><br>
           
                        <label for="lname">Vale:</label><br>
                        <input type="text" class="form-control" id="numero_vale" name="numero_vale" value="<?php echo $numero_vale;?>"><br>
                    
                        <label for="lname">Observaciones:</label><br>
                        <small class="form-text text-muted">Acepta 300 caracteres.</small><br>
                        <input type="text" class="form-control" id="observaciones" name="observaciones" value="<?php echo $observaciones;?>"><br>
                        
                        <label for="lname">Sustituir?</label><br>
                        <small class="form-text text-muted">Ingrese <strong>no</strong> para no sustituci&oacute;n o <strong>si</strong> para marcar como sustituible.</small><br>
                        <input type="text" class="form-control" id="para_sustituir" name="para_sustituir" value="<?php echo $para_sustituir;?>"><br>
                        
                        <label for="lname">Prioridad Sustituc&iacuteon:</label><br>
                        <input type="text" class="form-control" id="prioridad_sustitucion" name="prioridad_sustitucion" value="<?php echo $prioridad_sustitucion;?>"><br>

                        <label for="lname">Activo:</label><br>
                        <small class="form-text text-muted">Ingrese <strong>0</strong> para inactivo o <strong>1</strong> para activo.</small><br>
                        <input type="text" class="form-control" id="activo" name="activo" value="<?php echo $activo;?>"><br>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
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