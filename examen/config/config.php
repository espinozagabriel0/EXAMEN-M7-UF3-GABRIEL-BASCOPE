<?php
    $host = 'mysql-gabriel17.alwaysdata.net';
    $dbname = 'gabriel17_ecodrive';
    $username = 'gabriel17';
    $password = 'password-123';


    
    $mysqli = new mysqli($host, $username, $password, $dbname);

    if ($mysqli->connect_error) {
        die("Error de conexión: ". $mysqli->connect_error);
    }
    // else{
    //     echo "CONEXIÓN EXISTOSA";
    // }
?>