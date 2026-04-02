<?php 
  session_start();
  require_once("../db.php");

  $email = trim($_POST["email"]);
  $password = trim($_POST["password"]);
  $password_hash = password_hash($password, PASSWORD_DEFAULT);

  $stmt = $conn->prepare("SELECT * FROM clients WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  if ($user && password_verify($password, $user["password"])) {
    $_SESSION["user"] = $user;
  } else {
    $_SESSION["auth_error"] = "Неверная почта или пароль.";
  };

  header("Location: ../../index.php");
  exit();
?>