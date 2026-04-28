<?php 
    session_start();
    require_once(__DIR__ . "/../db.php");
    require_once(__DIR__ . "/../dashboard.php");

    $transfer_value = $_POST["transfer-value"];
    $recipient_account_id = $_POST["account-id"];
    $sender_account_id = $_SESSION["user"]["client_id"];

    if (has_account_by_id((int)$recipient_account_id)) {
        $refill = $conn->prepare("UPDATE accounts SET balance = balance + ? WHERE id = ?");
        $refill->bind_param("di", $transfer_value, $recipient_account_id);
        
        $offs = $conn->prepare("UPDATE accounts SET balance = balance - ? WHERE id = ?");
        $offs->bind_param("di", $transfer_value, $sender_account_id);
        
        $transaction_type = "transfer";
        $transaction_title = "Перевод на счёт №".$recipient_account_id;
        $transaction = $conn->prepare("INSERT INTO transactions
        (sender_account_id, recipient_account_id, title, type, amount) VALUES (?,?,?,?,?)");
        $transaction->bind_param("iissd", $sender_account_id, $recipient_account_id, $transaction_title, $transaction_type, $transfer_value);

        if ($offs->execute() && $refill->execute() && $transaction->execute()) {
            $offs->close();
            $refill->close();
            $transaction->close();
            header("Location: ../../index.php?page=dashboard");
            exit();
        } else {
            die($conn->error);
        }

    } else {
        $_SESSION["account-transfer-error"] = "Некорректный номер карты.";
        header("Location: ../../index.php?page=dashboard&action=transfer");
        exit();
    }
?>