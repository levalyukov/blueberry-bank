<?php
    error_reporting(0);

    $db_server   = 'localhost';
    $db_name     = 'bank';
    $db_user     = 'root';
    $db_password = '';
    $db_error = "";

    $conn = new mysqli($db_server, $db_user, $db_password, $db_name);

    if ($conn->connect_error) {
        $db_error = "503";
    };
?>