<?php 
    session_start();
    require_once(__DIR__ . "/../db.php");
    require_once(__DIR__ . "/../dashboard.php");
    require_once(__DIR__ . "/../investment.php");

    if (get_user_balance($_SESSION["user"]["client_id"]) >= $_POST["refill-value"]) {
        $transaction = $conn->prepare("UPDATE accounts SET balance = balance + ? WHERE user_id = ? AND account_name = 'Брокерский счёт'");
        $transaction->bind_param("ii", $_POST["refill-value"], $_SESSION["user"]["client_id"]);
        $transaction->execute();

        $account = $conn->prepare("UPDATE accounts SET balance = balance - ? WHERE user_id = ? AND account_name = 'Основной счёт'");
        $account->bind_param("ii", $_POST["refill-value"], $_SESSION["user"]["client_id"]);
        $account->execute();

        header("Location: ../../index.php?page=investment");
        exit();
    } else {
        $_SESSION["investment-account-refill"] = "Недостаточно средств.";
        header("Location: ../../index.php?page=investment&action=refill");
        exit();
    }
?>