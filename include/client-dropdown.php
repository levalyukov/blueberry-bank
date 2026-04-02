<?php 
  session_start();

  if (isset($_POST["client-signout"])) {
    session_destroy();
  };

  header("Location: ../index.php");
  exit();
?>