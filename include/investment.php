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

    function get_name(int $id) : string
    {
        global $conn;
        $name = "";

        $stmt = $conn->prepare("SELECT name FROM securities WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $name = $stmt->get_result()->fetch_assoc()['name'];
        }

        return $name;
    }

    function get_image(int $id) : string
    {
        global $conn;
        $name = "";

        $stmt = $conn->prepare("SELECT image FROM securities WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $name = $stmt->get_result()->fetch_assoc()['image'];
        }

        return $name;
    }

    function get_price(int $id) : float
    {
        global $conn;
        $price = 0;

        $stmt = $conn->prepare("SELECT price FROM securities WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $price = $stmt->get_result()->fetch_assoc()['price'];
        }

        return $price;
    }


    function has_invenstment_account(int $client_id) : bool
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

    function has_invenstment_portfoile(int $client_id) : bool
    {
        global $conn;
        $result = false;

        $account = $conn->prepare("SHOW TABLES LIKE 'portfolio'");
        $account->execute();
        if ($account->get_result()->fetch_row()) {
            $result = true;
        } else {
            init_portfolio();
        }
        
        return $result;
    }

    function get_investment_account(int $client_id) : int
    {
        global $conn;
        $balance = $conn->prepare("SELECT balance FROM accounts WHERE (user_id, account_name) = (?, 'Брокерский счёт')");
        $balance->bind_param("i", $client_id);
        $balance->execute();
        return $balance->get_result()->fetch_assoc()['balance'];
    }

    function get_investment_profit_value(int $client_id, int $securities) : float
    {
        return 0;
    }

    function get_investment_profit_percent(int $client_id, int $securities) : float
    {
        return 0;
    }

    function get_investment_portfolio(int $client_id) : array
    {
        global $conn;
        $result = [];

        if (has_invenstment_portfoile($client_id)) {
            $portfolio = $conn->prepare("SELECT * FROM portfolio WHERE user_id = ?");
            $portfolio->bind_param("i", $client_id);
            if ($portfolio->execute()) {
                $result = $portfolio->get_result()->fetch_all();
            }
        }
    
        return $result;
    }

    function get_invenstment_stocks(int $client_id) : array
    {
        global $conn;
        $result = [];

        $stocks = $conn->prepare("SELECT * FROM portfolio WHERE (user_id, type) = (?, 'stocks')");
        $stocks->bind_param("i", $client_id);
        if ($stocks->execute()) {
            $result = $stocks->get_result()->fetch_all();
        }

        return $result;
    }

    function get_invenstment_bonds(int $client_id) : array
    {
        global $conn;
        $result = [];

        $stocks = $conn->prepare("SELECT * FROM portfolio WHERE (user_id, type) = (?, 'bonds')");
        $stocks->bind_param("i", $client_id);
        if ($stocks->execute()) {
            $result = $stocks->get_result()->fetch_all();
        }

        return $result;
    }

    function get_invenstment_currency(int $client_id) : array
    {
        global $conn;
        $result = [];

        $stocks = $conn->prepare("SELECT * FROM portfolio WHERE (user_id, type) = (?, 'currency')");
        $stocks->bind_param("i", $client_id);
        if ($stocks->execute()) {
            $result = $stocks->get_result()->fetch_all();
        }

        return $result;
    }

    function get_invenstment_metals(int $client_id) : array
    {
        global $conn;
        $result = [];

        $stocks = $conn->prepare("SELECT * FROM portfolio WHERE (user_id, type) = (?, 'metals')");
        $stocks->bind_param("i", $client_id);
        if ($stocks->execute()) {
            $result = $stocks->get_result()->fetch_all();
        }

        return $result;
    }

    function get_investment_balance(int $client_id) : float
    {
        global $conn;
        $array = [];
        $result = 0.0;

        $total_balance = $conn->prepare("SELECT new_price, amount FROM portfolio WHERE user_id = ?");
        $total_balance->bind_param("i", $client_id);

        if ($total_balance->execute()) {
            $array = $total_balance->get_result()->fetch_all();
        
            for ($i = 0; $i < count($array); $i++) {
                $result += $array[$i][0]*$array[$i][1];
            } 

            $result += get_investment_account($client_id);
        }

        return $result;
    }
?>