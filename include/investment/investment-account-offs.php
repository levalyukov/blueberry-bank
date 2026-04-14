<?php 
    session_start();
    require_once(__DIR__ . "/../db.php");
    require_once(__DIR__ . "/../dashboard.php");
    require_once(__DIR__ . "/../investment.php");

    if (get_investment_account($_SESSION["user"]["client_id"]) >= $_POST["offs-value"]) {
        $transaction = $conn->prepare("UPDATE accounts SET balance = balance - ? WHERE user_id = ? AND account_name = 'Брокерский счёт'");
        $transaction->bind_param("ii", $_POST["offs-value"], $_SESSION["user"]["client_id"]);
        $transaction->execute();

        $account = $conn->prepare("UPDATE accounts SET balance = balance + ? WHERE user_id = ? AND account_name = 'Основной счёт'");
        $account->bind_param("ii", $_POST["offs-value"], $_SESSION["user"]["client_id"]);
        $account->execute();

        header("Location: ../../index.php?page=investment");
        exit();
    } else {
        $_SESSION["investment-account-offs"] = "Недостаточно средств.";
        header("Location: ../../index.php?page=investment&action=offs");
        exit();
    }
?>