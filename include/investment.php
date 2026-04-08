<?php 
    session_start();
    require_once("db.php");

    $birthday = trim($_POST["birthday"]);
    if (!empty($birthday)) {
        $now = (int)((new DateTime())->format('Y'));
        $user = (int)((new DateTime($birthday))->format('Y'));

        if ($now - $user > 100 || $now - $user < 18) {
            $_SESSION['investment_error'] = "Некорректная дата рождения.";
        }

        if ($now - $user >= 18 && $now - $user <= 100) {
            if (!$conn->query("SELECT * FROM accounts WHERE account_name = 'Брокерский счёт'")->fetch_assoc()) {
                $new_account = $conn->prepare("INSERT INTO accounts (user_id,account_name) VALUES (?, 'Брокерский счёт')");
                $new_account->bind_param("s", $_SESSION["user"]["client_id"]);
                $new_account->execute();
            }
        }

        header("Location: ../index.php?page=investment");
        exit();
    }


    function has_invenstment_account(int $client_id): bool
    {
        global $conn;
        $result = false;

        $account = $conn->prepare("SELECT * FROM accounts WHERE account_name = 'Брокерский счёт'");
        $account->execute();
        if ($account->get_result()->fetch_assoc()) {
            $result = true;
        }
        
        return $result;
    }

    function get_investment_account(int $client_id): int
    {
        global $conn;
        $balance = $conn->prepare("SELECT balance FROM accounts WHERE (user_id, account_name) = (?, 'Брокерский счёт')");
        $balance->bind_param("i", $client_id);
        $balance->execute();
        return $balance->get_result()->fetch_assoc()['balance'];
    }

    function get_investment_profit_value(int $client_id): float
    {
        return 0;
    }

    function get_investment_profit_percent(int $client_id): float
    {
        return 0.0;
    }
?>