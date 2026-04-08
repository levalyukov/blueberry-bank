<?php
    // error_reporting(0);

    $db_server   = 'localhost';
    $db_name     = 'bank';
    $db_user     = 'root';
    $db_password = '';
    $db_error    = '';

    $conn = new mysqli($db_server, $db_user, $db_password, $db_name);

    if ($conn->connect_error) {
        $db_error = $conn->connect_error;
    }

    function create_securities() : void
    {
        global $conn;
        $conn->query('CREATE TABLE `securities` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `symbol` VARCHAR(4) NOT NULL,
            `name` TEXT NOT NULL,
            `volatility` DECIMAL(3,2) NOT NULL,
            `price` DECIMAL NOT NULL,
            `type` ENUM(`stocks`,`bonds`,`currency`,`metals`) DEFAULT `stocks`,
            `image` TEXT NOT NULL
        )'); 
    }
?>