<?php   
    /* ... */
    session_start();
    require_once "db.php";
    require_once "transactions.php";

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

    function get_user_account_id(int $client_id) : int
    {
        global $conn;
        $result = 0;

        $account = $conn->prepare("SELECT id FROM accounts WHERE user_id = ? AND account_name = 'Основной счёт'");
        $account->bind_param("i", $client_id);
        if ($account->execute()) {
            $account->bind_result($result);
            if (!$account->fetch()) {
                die($conn->error);
            }

            $account->close();
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
        $ids = [];

        $stmt = $conn->prepare("SELECT id FROM accounts WHERE user_id = ?");
        $stmt->bind_param("i", $client_id);
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $ids[] = $row['id'];
            }
        }        

        return $ids;
    }

    function get_user_accounts_id(int $client_id) : array
    {
        global $conn;
        $result = [];
        $temp = [];

        $accounts = $conn->prepare("SELECT * FROM accounts WHERE user_id = ?");
        $accounts->bind_param("i", $client_id);
        if ($accounts->execute()) {
            $temp = $accounts->get_result()->fetch_all();
        }

        if (count($temp) > 0) {
            for ($i = 0; $i < count($temp); $i++) {
                array_push($result, $temp[$i][0]);
            }
        }

        return $result;
    }


    function get_user_month_income(array $client_accounts) : float
    {
        global $conn;

        if (empty($client_accounts)) {
            return 0.0;
        }

        $placeholders = implode(',', array_fill(0, count($client_accounts), '?'));
        $sql = "SELECT SUM(amount) FROM transactions 
                WHERE (sender_account_id IN ($placeholders) OR recipient_account_id IN ($placeholders)) 
                AND type IN ('replenishment','investment-sale-stocks','investment-sale-bonds',
                'investment-sale-currency','investment-sale-metals') 
                AND datetime >= ? AND datetime < ?";

        $transaction = $conn->prepare($sql);
        $startOfMonth = new DateTime('first day of this month 00:00:00');
        $endOfMonth = (clone $startOfMonth)->modify('+1 month');
        $startDate = $startOfMonth->format('Y-m-d H:i:s');
        $endDate = $endOfMonth->format('Y-m-d H:i:s');
        $paramsValues = array_merge($client_accounts, $client_accounts, [$startDate, $endDate]);
        $accTypes = str_repeat('s', count($client_accounts) * 2); 
        $types = $accTypes . 'ss';

        $transaction->bind_param($types, ...$paramsValues);

        if (!$transaction->execute()) {
            return 0.0;
        }

        $result = $transaction->get_result()->fetch_row();
        return (float)($result[0] ?? 0.0);
    }

    function get_user_month_expenses(array $client_accounts) // : float 
    {
        global $conn;

        if (empty($client_accounts)) {
            return 0.0;
        }

        $placeholders = implode(',', array_fill(0, count($client_accounts), '?'));
        $sql = "SELECT SUM(amount) FROM transactions 
                WHERE (sender_account_id IN ($placeholders) OR recipient_account_id IN ($placeholders)) 
                AND type IN ('purchase','transfer','withdrawal','investment-purchase-stocks',
                'investment-purchase-bonds','investment-purchase-currency','investment-purchase-metals') 
                AND datetime >= ? AND datetime < ?";

        $transaction = $conn->prepare($sql);
        $startOfMonth = new DateTime('first day of this month 00:00:00');
        $endOfMonth = (clone $startOfMonth)->modify('+1 month');
        $startDate = $startOfMonth->format('Y-m-d H:i:s');
        $endDate = $endOfMonth->format('Y-m-d H:i:s');
        $paramsValues = array_merge($client_accounts, $client_accounts, [$startDate, $endDate]);
        $accTypes = str_repeat('s', count($client_accounts) * 2); 
        $types = $accTypes . 'ss';
        $transaction->bind_param($types, ...$paramsValues);

        if (!$transaction->execute()) {
            return 0.0;
        }
        
        $result = $transaction->get_result()->fetch_row();
        return (float)($result[0] ?? 0.0);
    }

    function has_account_by_id(int $id) : bool
    {
        global $conn;

        $check = $conn->prepare("SELECT * FROM accounts WHERE id = ?");
        $check->bind_param("i", $id);
        if ($check->execute()) {
            return $check->get_result()->num_rows > 0;
        }

        return false;
    }

?>