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
    $cedula = $_GET['data']; 
    include 'includes/functions.php';

//------------------First query-------------------------------

    $table1="empleados";
    $table2="subprocesos";
    //$table3="";

    $fields="*";

    $ONclause1="empleados.id=subprocesos.id";
    //$ONclause2="";

    $whereClause="empleados.cedula=$cedula";

    $result = db_select_1_inner_query($table1, $table2, $fields, $ONclause1, $whereClause);
    $data = mysqli_fetch_assoc($result);

    $cedula          = $data['cedula'];
    $nombre_completo = $data['nombre_completo'];
    $cg_anterior     = $data['cg_anterior'];
    $nombre_cg       = $data['nombre_cg'];
    $email           = $data['email'];
    $puestoAnterior  = $data['puestoAnterior'];
    $id              = $data['id'];
    $idJefeN         = $data['idJefeN'];
    $idGrupoGestion  = $data['idGrupoGestion'];
    $fecha_nacim     = $data['fecha_nacim'];
    $activo          = $data['activo'];
    $usuarioRed      = $data['usuarioRed'];
    $usuarioSAP      = $data['usuarioSAP'];
    $puesto          = $data['puesto'];
    $cg              = $data['cg'];

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
                <form>
                    <div class="form-group">

                        <label for="cedula">Cédula:</label><br>
                        <input type="text" class="form-control" id="cedula" name="cedula" value="<?php echo $cedula; ?>" readonly><br>

                        <label for="nombre_completo">Nombre completo:</label><br>
                        <input type="text" class="form-control" id="nombre_completo" name="nombre_completo" value="<?php echo $nombre_completo; ?>"><br>

                        <label for="cg_anterior">CG Anterior:</label><br>
                        <input type="text" class="form-control" id="cg_anterior" name="cg_anterior" value="<?php echo $cg_anterior; ?>"><br>

                        <label for="nombre_cg">Nombre CG:</label><br>
                        <input type="text" class="form-control" id="nombre_cg" name="nombre_cg" value="<?php echo $nombre_cg; ?>"><br>

                        <label for="email">Email:</label><br>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>"><br>

                        <label for="puestoAnterior">Puesto Anterior:</label><br>
                        <input type="text" class="form-control" id="puestoAnterior" name="puestoAnterior" value="<?php echo $puestoAnterior; ?>"><br>

                        <label for="id">ID:</label><br>
                        <input type="text" class="form-control" id="id" name="id" value="<?php echo $id; ?>" readonly><br>

                        <label for="idJefeN">ID Jefe N:</label><br>
                        <input type="text" class="form-control" id="idJefeN" name="idJefeN" value="<?php echo $idJefeN; ?>"readonly><br>

                        <label for="idGrupoGestion">ID Grupo Gestión:</label><br>
                        <input type="text" class="form-control" id="idGrupoGestion" name="idGrupoGestion" value="<?php echo $idGrupoGestion; ?>"readonly><br>

                        <label for="fecha_nacim">Fecha de Nacimiento:</label><br>
                        <input type="text" class="form-control" id="fecha_nacim" name="fecha_nacim" value="<?php echo $fecha_nacim; ?>"><br>

                        <label for="activo">Activo (1/0):</label><br>
                        <input type="text" class="form-control" id="activo" name="activo" value="<?php echo $activo; ?>"><br>

                        <label for="usuarioRed">Usuario Red:</label><br>
                        <input type="text" class="form-control" id="usuarioRed" name="usuarioRed" value="<?php echo $usuarioRed; ?>"><br>

                        <label for="usuarioSAP">Usuario SAP:</label><br>
                        <input type="text" class="form-control" id="usuarioSAP" name="usuarioSAP" value="<?php echo $usuarioSAP; ?>"><br>

                        <label for="puesto">Puesto:</label><br>
                        <input type="text" class="form-control" id="puesto" name="puesto" value="<?php echo $puesto; ?>"><br>

                        <label for="cg">CG:</label><br>
                        <input type="text" class="form-control" id="cg" name="cg" value="<?php echo $cg; ?>"><br>

                    </div>
                </form> 
            </div>
            <!--  <button type="submit" class="btn btn-primary">Actualizar</button> -->
            <a class="btn btn-info" href="all_system_employees_supervisor.php">Volver</a>
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