<?php   
    /* ... */
    session_start();
    require_once "db.php";

    function get_user_balance_by_account_id(int $user_id, int $account_id) : float
    {
        global $conn;
        $result = 0;

        $account = $conn->prepare("SELECT balance FROM accounts WHERE user_id = ? AND id = ?");
        $account->bind_param("ii", $user_id, $account_id);
        if ($account->execute()) {
            $result = $account->get_result()->fetch_assoc()["balance"];
        } else {
            die($conn->error);
        }

        return $result;
    }

    function get_user_balance(int $client_id) : float 
    {
        global $conn;
        $result = 0;

        $balance = $conn->prepare("SELECT balance FROM accounts WHERE user_id = ?");
        $balance->bind_param("s", $client_id);
        $balance->execute();
        $account = $balance->get_result()->fetch_assoc();

        if ($account) {
            $result = $account['balance'];
        } else {
            $new_account = $conn->prepare("INSERT INTO accounts (user_id) VALUE (?)");
            $new_account->bind_param("s", $client_id);
            $new_account->execute();
        }

        return $result;
    }

    function get_user_accounts(int $client_id) : array
    {
        global $conn;
        $result = [];

        $accounts = $conn->prepare("SELECT * FROM accounts WHERE user_id = ?");
        $accounts->bind_param("i", $client_id);
        if ($accounts->execute()) {
            $result = $accounts->get_result()->fetch_all();
        }        

        return $result;
    }

    function get_user_month_income(int $client_id) : float 
    {
        return 0.0;
    }

    function get_user_month_expenses(int $client_id) : float 
    {
        return 0.0;
    }

?>