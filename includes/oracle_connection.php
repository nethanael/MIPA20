<?php
// oracleConnection.php

// PMP OCI8 module verification.

if (function_exists('oci_connect')) {
    //echo "OCI8 enable, now you can query ORACLE Databases";
} else {
    //echo "OCI8 disbled, must check server config. 
    //install Oracle instant client 
}

// server credenctials
$oracleConfig = include('oracle_server_params.php');

try {
    // create DSN
    $dsn = "(DESCRIPTION =
                (ADDRESS = (PROTOCOL = TCP)(HOST = {$oracleConfig['host']})(PORT = {$oracleConfig['port']}))
                (CONNECT_DATA = (SERVICE_NAME = {$oracleConfig['service_name']}))
            )";

    // Debugging
    //echo $oracleConfig['username'], " ", $oracleConfig['password'], " ", $dsn;

     // Connect to DB

    $oracleConn = oci_connect($oracleConfig['username'], $oracleConfig['password'], $dsn);

    // Check connection
    if (!$oracleConn) {
        $e = oci_error();
        throw new Exception('No se pudo conectar a Oracle: ' . $e['message']);
    }

    // Debuggin
    //echo "Conexión exitosa a Oracle" . PHP_EOL;

} catch (Exception $e) {
    // Handle errors
    //echo "Error al conectar a Oracle: " . $e->getMessage() . PHP_EOL;
}

?>
