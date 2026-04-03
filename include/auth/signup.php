<?php 
  session_start();
  require_once("../db.php");

  $name = htmlspecialchars(strip_tags(trim($_POST["name"])));
  $surname = htmlspecialchars(strip_tags(trim($_POST["surname"])));
  $middle = htmlspecialchars(strip_tags(trim($_POST["middle"])));
  $passport_number = htmlspecialchars(strip_tags(trim($_POST["passport-number"])));
  $passport_serial = htmlspecialchars(strip_tags(trim($_POST["passport-serial"])));
  $email = trim($_POST["email"]);
  $password = trim($_POST["password"]);
  $password_confirm = trim($_POST["password-confirmation"]);
  $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

  if ($password !== $password_confirm) {
    $_SESSION["register_error"] = 'Пароли не совпадают.';
  } else if (strlen($passport_serial) !== 6 || strlen($passport_number) !== 4) {
    $_SESSION["register_error"] = 'Серия или номер паспорта некорректны.';
  } else {
    $stmt = $conn->prepare("SELECT client_id FROM clients WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    if ($stmt->get_result()->num_rows === 0) {
      $register = $conn->prepare("INSERT INTO clients (name, surname, middle, passport_serial, passport_number, email, password) 
      VALUES (?,?,?,?,?,?,?)");
      $register->bind_param("sssssss", $name, $surname, $middle, 
      $passport_serial, $passport_number, $email, $password_hash);
    }
  }

  header("Location: ../../index.php?auth=register");
  exit();
?>