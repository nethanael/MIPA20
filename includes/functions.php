<?php

/*------------------------------------------------Dinamic Selects----------------------------------*/

    // dinamic select -> display name is the same as value

    function dynamic_select($display_array, $element_name, $label = '', $init_value = '') {
        array_unshift($display_array, "");
        $menu = '';
        if ($label != '') $menu .= '
            <label for="'.$element_name.'">'.$label.'</label>';
        $menu .= '
            <select name="'.$element_name.'" id="'.$element_name.'">';
        if (empty($_REQUEST[$element_name])) {
            $curr_val = $init_value;
        } else {
            $curr_val = $_REQUEST[$element_name];
        }
        foreach ($display_array as $key => $value) {
            $menu .= '
                <option value="'.$value.'"';
            if ($key == $curr_val) $menu .= ' selected="selected"';
            $menu .= '>'.$value.'</option>';
        }
        $menu .= '
            </select>';
        return $menu;
    };

    // dinamic select 2: display name -> display_array, value -> value_array

    function dynamic_select_2($display_array, $value_array, $element_name, $label = '', $init_value = '') {
        array_unshift($display_array, "");
        array_unshift($value_array, 0);
        $menu = '';
        if ($label != '') $menu .= '
            <label for="'.$element_name.'">'.$label.'</label>';
        $menu .= '
            <select name="'.$element_name.'" id="'.$element_name.'">';
        if (empty($_REQUEST[$element_name])) {
            $curr_val = $init_value;
        } else {
            $curr_val = $_REQUEST[$element_name];
        }
        foreach ($display_array as $key => $value) {
            $menu .= '
                <option value="'.$value_array[$key].'"';
            if ($key == $curr_val) $menu .= ' selected="selected"';
            $menu .= '>'.$value.'</option>';
        }
        $menu .= '
            </select>';
        return $menu;
    };

/*------------------------------------------------DB queries----------------------------------*/

    // 1 dimension array query

    function db_1D_query($query){
        include 'connection.php';                                           // DB Connection 
        //echo $query;                                                      // query syntax 
	    $resul = mysqli_query($conn, $query, MYSQLI_USE_RESULT);            // DB QUERY
        $data_2D = mysqli_fetch_all($resul);                                // build data array
        $data_1D = array_reduce($data_2D, 'array_merge', array());          // complex array to 1 dimension array
    
        //print("<pre>".print_r($datos_test_2D,true)."</pre>");                       //  Debugging original array
        //print("<pre>".print_r($datos_test_1D,true)."</pre>");                       //  Debugging new array
        
        return $data_1D;
    };

    // simple insert query

    function db_insert_query($table,$fields,$values){
        include 'connection.php';
        $query = "INSERT INTO ".$table." ".$fields." VALUES ".$values;
		//echo $query;
		return mysqli_query($conn, $query);                        //inserts to db
    };

    // simple update query with where clause

    function db_update_query_1_whereClause($table,$fields,$whereClause){
        include 'connection.php';
        $query = "UPDATE $table SET $fields WHERE $whereClause";
		//echo $query;
		return mysqli_query($conn, $query);                        //inserts to db
    };

     // simple select query with where clause (Use to iterate and build tables)

     function db_select_simple($table1, $fields, $whereClause){
        include 'connection.php';
        $query = "SELECT ".$fields." FROM ".$table1." WHERE ".$whereClause;
        //echo $query;
        return mysqli_query($conn, $query);                        //query to db
    };

    // simple select query with where clause and a fetched result (use to fill forms with data)

    function db_select_simple_fetch($table1, $fields, $whereClause){
        include 'connection.php';
        $query = "SELECT ".$fields." FROM ".$table1." WHERE ".$whereClause;
        //echo $query;
        $result = mysqli_query($conn, $query);
        return mysqli_fetch_assoc($result); 
    };

    // select query with 1 inner join and 1 where clause

    function db_select_1_inner_query($table1, $table2, $fields, $ONclause1, $whereClause){
        include 'connection.php';
        $query = "SELECT ".$fields." FROM ".$table1." INNER JOIN ".$table2." ON ".$ONclause1." WHERE ".$whereClause;
        //echo $query;
        //echo "++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++";
        return mysqli_query($conn, $query);                        //query to db
    };

    function db_select_1_left_query($table1, $table2, $fields, $ONclause1, $whereClause){
        include 'connection.php';
        $query = "SELECT ".$fields." FROM ".$table1." LEFT JOIN ".$table2." ON ".$ONclause1." WHERE ".$whereClause;
        //echo $query;
        //echo "++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++";
        return mysqli_query($conn, $query);                        //query to db
    };

    // select query with 1 inner join, 1 where clause and 1 order by ASC

    function db_select_1_inner_query_orderby($table1, $table2, $fields, $ONclause1, $whereClause, $orderBy){
        include 'connection.php';
        $query = "SELECT ".$fields." FROM ".$table1." INNER JOIN ".$table2." ON ".$ONclause1." WHERE ".$whereClause. " ORDER BY " .$orderBy. " ASC ";
       //echo $query;
        return mysqli_query($conn, $query);                        //query to db
    };

    // select query with 2 inner joins and 1 where clause

    function db_select_2_inner_query($table1, $table2, $table3, $fields, $ONclause1, $ONclause2, $whereClause){
        include 'connection.php';
        $query = "SELECT ".$fields." FROM ".$table1." INNER JOIN ".$table2." ON ".$ONclause1." INNER JOIN ".$table3." ON ".$ONclause2." WHERE ".$whereClause;
		//echo $query;
		return mysqli_query($conn, $query);                        //query to db
    };

    function db_select_2_left_query($table1, $table2, $table3, $fields, $ONclause1, $ONclause2, $whereClause){
        include 'connection.php';
        $query = "SELECT ".$fields." FROM ".$table1." LEFT JOIN ".$table2." ON ".$ONclause1." LEFT JOIN ".$table3." ON ".$ONclause2." WHERE ".$whereClause;
		//echo $query;
		return mysqli_query($conn, $query);                        //query to db
    };

    // Special query for MIPA 2.0

    function db_select_special_alias_query(){
        include 'connection.php';
        $query = "SELECT e.cedula, e.nombre_completo, sp1.nombre AS subproceso_1, sp2.nombre AS subproceso_2,
                        e2.nombre_completo AS coordinador, gg.nombre, e.usuarioRed, e.email, e.usuarioSAP, e.puesto, e.cg 
                  FROM empleados e
                  LEFT JOIN subprocesos sp1 ON e.idJefeN = sp1.id
                  LEFT JOIN subprocesos sp2 ON e.id = sp2.id
                  LEFT JOIN empleados e2 ON e2.cedula = sp2.cedula_coordinador
                  LEFT JOIN grupo_gestion gg ON e.idGrupoGestion = gg.id
                  WHERE e.activo = 1";
    
        $result = mysqli_query($conn, $query);
    
        if (!$result) {
            die("Error en la consulta: " . mysqli_error($conn)); // Muestra el error y detiene la ejecución
        }
    
        return $result;
    }

        // select query with 3 inner joins and 1 where clause
        // table4 uses an alias so u can repeat that table

    function db_select_3_inner_query($table1, $table2, $table3, $table4, $fields, $ONclause1, $ONclause2, $ONclause3, $whereClause){
        include 'connection.php';
        $query = "SELECT ".$fields." FROM ".$table1." INNER JOIN ".$table2." ON ".$ONclause1." INNER JOIN ".$table3." ON ".$ONclause2." INNER JOIN ".$table4." table4 "." ON ".$ONclause3." WHERE ".$whereClause;
        //echo $query;
        return mysqli_query($conn, $query);                        //query to db
    };

    // simple row count 

    function countRows($table1, $whereClause){
        include 'connection.php';
        $query = "SELECT *, COUNT(*) FROM ".$table1." WHERE ".$whereClause;
        //echo $query;
        //return mysqli_query($conn, $query);
        $result = mysqli_query($conn, $query);
        return mysqli_fetch_assoc($result); 

    };


/* -------------------------------------------- Time functions---------------------------------*/

function dateDifference($date_1 , $date_2 , $differenceFormat = '%R%a' )
	{
		$datetime1 = date_create($date_1);
		$datetime2 = date_create($date_2);

        if ($datetime1 == false || $datetime2 == false){
            return "N/A";
        }
	
		$interval = date_diff($datetime1, $datetime2);
	
		return $interval->format($differenceFormat);
	};

function monthFix()
    {
        //$month = 1;
        $month = date("m");
        $month = $month - 1;
        $month = ($month <= 9) ? ("0".$month) : ($month);
        $month = ($month == 0) ? ("12") : ($month);
        return $month ;
    };

function yearFix($month)
    {
        $year = date("y");
        $year = ($month == "12") ? ($year - 1) : ($year);
        return $year;
    };

    function monthName()
    {
        //$month = 1;
        $month = date("m");

        switch ($month) {
            case 1:
                return "Enero ";
                break;
            case 2:
                return "Febrero ";
                break;
            case 3:
                return "Marzo ";
                break;
            case 4:
                return "Abril ";
                break;
            case 5:
                return "Mayo ";
                break;
            case 6:
                return "Junio ";
                break;
            case 7:
                return "Julio ";
                break;
            case 8:
                return "Agosto ";
                break;
            case 9:
                return "Setiembre ";
                break;
            case 10:
                return "Octubre ";
                break;
            case 11:
                return "Noviembre ";
                break;
            case 12:
                return "Diciembre ";
                break;
        }
        return $month ;
    };


    // Performance time calculations

    function performanceValue($right_now, $req_date)
    {

    $dateTimestamp1 = strtotime($right_now);
    $dateTimestamp2 = strtotime($req_date);

    if ($dateTimestamp1>$dateTimestamp2){
            return "bajo";
        }
    if ($dateTimestamp1==$dateTimestamp2){
            return "cuanto";
        }
    if ($dateTimestamp1<$dateTimestamp2){
            return "sobresaliente";
        }

    }

    function debug_to_console($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);
    
        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }

    /* ORACLE FUNCTIONS */

         // simple select query with where clause (Use to iterate and build tables)

    function oracle_db_select_simple($table1, $fields, $whereClause){
        include 'oracle_connection.php';
        
        $query = "SELECT ".$fields." FROM ".$table1." WHERE ".$whereClause;
        //echo $query;
        $stmt = oci_parse($oracleConn, $query);
        oci_execute($stmt);
                
        return $stmt;        //query to db
    };

        // Building an array for data transfer between BD´s ORACLE -> MySQL

    function oracle_db_build($data){
    
      // array build for data update between DB´s
        $oracle_data = [];
            while ($row = oci_fetch_assoc($data)) {
            $oracle_data[] = $row; // save results on array
        }
    
        oci_free_statement($oracle_stmt);
        return $oracle_data;

    };

?>

