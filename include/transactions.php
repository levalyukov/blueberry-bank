<?php 
  session_start();
  require_once("db.php");

  function get_user_last_history(int $client_id): array
  {
    global $conn;
    $result = [];

    // if ($conn->query("SLOW TABLES LIKE ''"->fetch))

    return $result;
  };

?>