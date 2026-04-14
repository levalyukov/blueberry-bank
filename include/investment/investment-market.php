<?php 
    session_start();
    require_once(__DIR__ . "/../db.php");

    function get_all_stocks() : array
    {
        global $conn;
        $result = [];

        $stmt = $conn->prepare("SELECT * FROM securities WHERE type = 'stocks'");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all();

        return $result;
    }

    function get_all_bonds() : array
    {
        global $conn;
        $result = [];

        $stmt = $conn->prepare("SELECT * FROM securities WHERE type = 'bonds'");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all();

        return $result;
    }

    function get_all_currency() : array
    {
        global $conn;
        $result = [];

        $stmt = $conn->prepare("SELECT * FROM securities WHERE type = 'currency'");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all();

        return $result;
    }

    function get_all_metals() : array
    {
        global $conn;
        $result = [];

        $stmt = $conn->prepare("SELECT * FROM securities WHERE type = 'metals'");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all();

        return $result;
    }

?>