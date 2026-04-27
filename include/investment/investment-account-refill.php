<?php 
    session_start();
    require_once(__DIR__ . "/../db.php");
    require_once(__DIR__ . "/../dashboard.php");
    require_once(__DIR__ . "/../investment.php");

    if (get_user_balance($_SESSION["user"]["client_id"]) >= $_POST["refill-value"]) {
        $transaction = $conn->prepare("UPDATE accounts SET balance = balance + ? WHERE user_id = ? AND account_name = 'Брокерский счёт'");
        $transaction->bind_param("ii", $_POST["refill-value"], $_SESSION["user"]["client_id"]);
        $transaction->execute();

        $sender_account_id = get_user_account_id($_SESSION["user"]["client_id"]);
        $recipient_account_id = get_investment_account_id($_SESSION["user"]["client_id"]);
        $transaction_title = "Между своими счетами";
        $transaction_type = "transfer";

        $transaction = $conn->prepare("INSERT INTO transactions (sender_account_id, recipient_account_id, title, type, amount) VALUES (?,?,?,?,?)");
        $transaction->bind_param("iissd", $sender_account_id, $recipient_account_id, $transaction_title, $transaction_type, $_POST["refill-value"]);
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