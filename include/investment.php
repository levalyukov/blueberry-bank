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

        $account = $conn->prepare("SELECT * FROM accounts WHERE user_id = ? AND account_name = 'Брокерский счёт'");
        $account->bind_param("i", $client_id);
        if ($account->execute() && $account->get_result()->fetch_assoc()) {
            $result = true;
        }
        
        return $result;
    }

    function has_invenstment_portfolio(int $client_id) : bool
    {
        global $conn;
        $result = false;

        $account = $conn->prepare("SHOW TABLES LIKE 'portfolio'");
        $account->execute();
        if ($account->get_result()->fetch_row()) {
            $result = true;
        }
        
        return $result;
    }

    function get_investment_account(int $client_id) : float
    {
        global $conn;
        $result = 0;

        $balance = $conn->prepare("SELECT balance FROM accounts WHERE (user_id, account_name) = (?, 'Брокерский счёт')");
        $balance->bind_param("i", $client_id);

        if ($balance->execute()) {
            $balance->bind_result($result);
            if (!$balance->fetch()) {
                die($conn->error);
            }

            $balance->close();
        }

        return $result;
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

        if (has_invenstment_portfolio($client_id)) {
            $portfolio = $conn->prepare("SELECT * FROM portfolio WHERE user_id = ?");
            $portfolio->bind_param("i", $client_id);
            if ($portfolio->execute()) {
                $result = $portfolio->get_result()->fetch_all();
                $portfolio->close();
            }
        }
    
        return $result;
    }

    function get_invenstment_stocks(int $client_id) : array
    {
        global $conn;
        $result = [];

        if (has_invenstment_portfolio($client_id)) {
            $stocks = $conn->prepare("SELECT * FROM portfolio WHERE user_id = ? AND type = 'stocks'");
            $stocks->bind_param("i", $client_id);
            if ($stocks->execute()) {
                $result = $stocks->get_result()->fetch_all();
                $stocks->close();
            }
        }

        return $result;
    }

    function get_invenstment_bonds(int $client_id) : array
    {
        global $conn;
        $result = [];

        if (has_invenstment_portfolio($client_id)) {
            $bonds = $conn->prepare("SELECT * FROM portfolio WHERE (user_id, type) = (?, 'bonds')");
            $bonds->bind_param("i", $client_id);
            if ($bonds->execute()) {
                $result = $bonds->get_result()->fetch_all();
                $bonds->close();
            }
        }

        return $result;
    }

    function get_invenstment_currency(int $client_id) : array
    {
        global $conn;
        $result = [];

        if (has_invenstment_portfolio($client_id)) {
            $currency = $conn->prepare("SELECT * FROM portfolio WHERE (user_id, type) = (?, 'currency')");
            $currency->bind_param("i", $client_id);
            if ($currency->execute()) {
                $result = $currency->get_result()->fetch_all();
                $currency->close();
            }
        }

        return $result;
    }

    function get_invenstment_metals(int $client_id) : array
    {
        global $conn;
        $result = [];

        if (has_invenstment_portfolio($client_id)) {
            $metals = $conn->prepare("SELECT * FROM portfolio WHERE (user_id, type) = (?, 'metals')");
            $metals->bind_param("i", $client_id);
            if ($metals->execute()) {
                $result = $metals->get_result()->fetch_all();
                $metals->close();
            }
        }

        return $result;
    }

    function get_investment_balance(int $client_id) : float
    {
        global $conn;
        $array = [];
        $result = 0.0;

        if (has_invenstment_portfolio($client_id)) {
            $total_balance = $conn->prepare("SELECT new_price, amount FROM portfolio WHERE user_id = ?");
            $total_balance->bind_param("i", $client_id);

            if ($total_balance->execute()) {
                $array = $total_balance->get_result()->fetch_all();
            
                for ($i = 0; $i < count($array); $i++) {
                    $result += $array[$i][0]*$array[$i][1];
                } 

                $total_balance->close();
            }
        }

        if (has_invenstment_account($client_id)) {
            $result += get_investment_account($client_id);
        }

        return $result;
    }

    function get_type_transaction() : string
    {
        switch ($_GET["type"]) {
            case "stocks":
                return "акций";
            case "bonds":
                return "облигаций";
            case "currency":
                return "валюты";
            case "metals":
                return "металла";
            default:
                return "";
        }
    }

    function get_securities_by_id(int $securities_id) : array
    {
        global $conn;
        $result = [];

        $securities = $conn->prepare("SELECT * FROM portfolio WHERE securities_id = ?");
        $securities->bind_param("i", $securities_id);
        if ($securities->execute()) {
            $result = $securities->get_result()->fetch_assoc() ?? [];
            $securities->close();
        }

        return $result;
    }

    function get_investment_account_id(int $client_id) : int
    {
        global $conn;
        $result = 0;

        $account = $conn->prepare("SELECT id FROM accounts WHERE user_id = ? AND account_name = 'Брокерский счёт'");
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
?>