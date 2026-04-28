<?php 
    session_start();
    require_once(__DIR__ . "/../db.php");

    $account_id = $_POST["selected"];
    $value = $_POST["refill-value"];

    if (!empty($value) && $value > 0) {
        $refill = $conn->prepare("UPDATE accounts SET balance = balance + ? WHERE user_id = ? AND id = ?");
        $refill->bind_param("dii", $value, $_SESSION["user"]["client_id"], $account_id);

        $sender_account_id = 0;
        $transaction_title = "Пополнение счёта";
        $transaction_type = "replenishment";
        $transaction = $conn->prepare("INSERT INTO transactions
        (sender_account_id, recipient_account_id, title, type, amount) VALUES (?,?,?,?,?)");
        $transaction->bind_param("iissd", $sender_account_id, $account_id, $transaction_title, $transaction_type, $value);

        if ($refill->execute() && $transaction->execute()) {
            $refill->close();
            $transaction->close();
            header("Location: ../../index.php?page=dashboard");
            exit();
        } else {
            die($conn->error);
        }
    } else {
        $_SESSION["account-refill-error"] = "Некорректная сумма ";
        header("Location: ../../index.php?page=dashboard&action=refill");
        exit();
    }

?>