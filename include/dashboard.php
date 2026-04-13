<?php 

    /* ... */

    require_once "db.php";

    function get_user_balance_by_account_id(int $user_id, int $account_id) : float
    {
        global $conn;
        $result = 0;

        $account = $conn->prepare("SELECT balance FROM accounts WHERE user_id = ? AND id = ?");
        $account->bind_param("ii", $user_id, $account_id);
        if ($account->execute()) {
            $result = $account->get_result()->fetch_assoc()["balance"];
        }

        return $result;
    }

    function get_user_balance(int $client_id) : float 
    {
        global $conn;
        $result = 0;

        $accounts = $conn->query("SHOW TABLES LIKE 'accounts'");

        if (!$accounts) {
        $createTable = $conn->query("CREATE TABLE accounts (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            balance DECIMAL(15,2) DEFAULT 0.00,
            account_name VARCHAR(100) DEFAULT 'Основной счёт'
        )");
        };

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
        };

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

    function get_user_month_income() : float 
    {
        return -1;
    }

    function get_user_month_expenses() : float 
    {
        return -1;
    }

?>