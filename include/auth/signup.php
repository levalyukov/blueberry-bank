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

    if (!$conn->query("SHOW TABLES LIKE 'clients'")->fetch_row()) {
        if (!$conn->query("CREATE TABLE `clients` (
            `client_id` INT AUTO_INCREMENT PRIMARY KEY,
            `name` TEXT NOT NULL,
            `surname` TEXT NOT NULL,
            `middle` TEXT,
            `passport_serial` INT(4) UNIQUE NOT NULL,
            `passport_number` INT(6) UNIQUE NOT NULL,
            `email` VARCHAR(128) UNIQUE NOT NULL,
            `password` TEXT NOT NULL
        )")) {
            die($conn->error);
        }
    }

    $passport_serial_correct = false;
    $passport_number_correct = false;

    $check_passport_serial = $conn->prepare("SELECT * FROM clients WHERE passport_serial = ?");
    $check_passport_serial->bind_param("i", $passport_serial);
    if ($check_passport_serial->execute()) {

        if ($check_passport_serial->get_result()->fetch_row() == 0) {
            $passport_serial_correct = true;
        } else {
            $_SESSION["register_error"] = "Перепроверьте серию и номер паспорта.";
            header("Location: ../../index.php?auth=register");
            exit();
        }

        $check_passport_serial->close();
    } else {
        die($conn->error);
    }

    $check_passport_number = $conn->prepare("SELECT * FROM clients WHERE passport_number = ?");
    $check_passport_number->bind_param("i", $passport_number);
    if ($check_passport_number->execute()) {
        
        if ($check_passport_number->get_result()->fetch_row() == 0) {
            $passport_number_correct = true;
        } else {
            $_SESSION["register_error"] = "Перепроверьте серию и номер паспорта.";
            header("Location: ../../index.php?auth=register");
            exit();
        }

        $check_passport_number->close();
    } else {
        die($conn->error);
    }


    if ($password !== $password_confirm) {
        $_SESSION["register_error"] = 'Пароли не совпадают.';
        header("Location: ../../index.php?auth=register");
        exit();
    } else if (strlen($passport_number) !== 6 || strlen($passport_serial) !== 4) {
        $_SESSION["register_error"] = 'Серия или номер паспорта некорректны.';
        header("Location: ../../index.php?auth=register");
        exit();
    } else {
        $stmt = $conn->prepare("SELECT client_id FROM clients WHERE email = ?");
        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();

            if ($stmt->get_result()->num_rows === 0) {
                $register = $conn->prepare("INSERT INTO clients 
                (name, surname, middle, passport_serial, passport_number, email, password) VALUES (?,?,?,?,?,?,?)");
                $register->bind_param("sssssss", $name, $surname, $middle, 
                $passport_serial, $passport_number, $email, $password_hash);
                $register->execute();
            }
        }
    }

    header("Location: ../../index.php");
    exit();
?>