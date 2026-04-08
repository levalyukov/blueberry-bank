<?php 
    session_start();
    require_once("db.php");

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

    function open_investment_account(): bool
    {
        global $conn;

        return false;
    }
?>