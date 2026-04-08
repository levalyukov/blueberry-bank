<?php 
    session_start();
    require_once("db.php");

    function get_all_stocks(): array
    {
        global $conn;

        if (!$conn->query("SHOW TABLES LIKE 'securities'")->fetch_row()) {
            create_securities();
            init_stocks();
        }

        return [];
    }

    function get_all_bonds(): array
    {
        global $conn;

        if (!$conn->query("SHOW TABLES LIKE 'securities'")->fetch_row()) {
              create_securities();
              init_bonds();
        }

        return [];
    }

    function get_all_currency(): array
    {
        global $conn;

        if (!$conn->query("SHOW TABLES LIKE 'securities'")->fetch_row()) {
            create_securities();
            init_currency();
        }

        return [];
    }

    function get_all_metals(): array
    {
        global $conn;

        if (!$conn->query("SHOW TABLES LIKE 'securities'")->fetch_row()) {
            create_securities();
            init_metals();
        }

        return [];
    }



    function init_stocks() : void 
    {
        
    }
    function init_bonds() : void 
    {

    }
    function init_currency() : void 
    {

    }
    function init_metals() : void 
    {

    }
?>