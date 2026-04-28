<?php
    session_start();
    require_once("db.php");

    function get_user_history(array $client_accounts): array
    {
        global $conn;
        if (empty($client_accounts)) {
            return [];
        }

        $placeholders = implode(',', array_fill(0, count($client_accounts), '?'));
        $stmt = $conn->prepare("SELECT * FROM transactions WHERE sender_account_id 
        IN ($placeholders) OR recipient_account_id IN ($placeholders)");

        $params = array_merge($client_accounts, $client_accounts);
        $types = str_repeat('i', count($params));

        $bindParams = [$types];
        foreach ($params as $key => $value) {
            $bindParams[] = &$params[$key];
        }

        call_user_func_array([$stmt, 'bind_param'], $bindParams);
        $stmt->execute();
        $result = $stmt->get_result();


        return $result->fetch_all();
    }

    function get_type_transaction(string $type) : string
    {
        switch ($type) {
            case "replenishment":
                return "Пополнение";
                
            case "purchase":
                return "Покупка";
                
            case "transfer":
                return "Перевод";
                
            case "withdrawal":
                return "Снятие";
                
            case "investment-purchase-stocks"
            || "investment-purchase-bonds"
            || "investment-purchase-currency"
            || "investment-purchase-metals"
            || "investment-sale-stocks"
            || "investment-sale-bonds"
            || "investment-sale-currency"
            || "investment-sale-metals":
                return "Инвестиции";

            default: 
                return "";
        }
    }

    function time_ago(string $timestamp) : string 
    {
        $time_difference = time() - $timestamp;

        if ($time_difference < 1) { return 'только что'; }

        $condition = array(
            12 * 30 * 24 * 60 * 60 =>  'год',
            30 * 24 * 60 * 60      =>  'мес',
            24 * 60 * 60           =>  'д',
            60 * 60                =>  'ч',
            60                     =>  'мин',
            1                      =>  'сек'
        );

        foreach ($condition as $secs => $str) {
            $d = $time_difference / $secs;
            if ($d >= 1) {
                $t = floor($d);
                return $t . ' ' . $str . ' назад';
            }
        }

        return '';
    }

    function get_array_transactions(array $client_accounts) : array
    {
        global $conn;
        $result = [];
        $temp = [];

        $replenishment_value = 0.0;
        $purchase_value = 0.0;
        $transfer_value = 0.0;
        $withdrawal_value = 0.0;
        $investment_value = 0.0;
        $investment_array = [
            "investment-purchase-stocks", "investment-purchase-bonds", "investment-purchase-currency", 
            "investment-purchase-metals", "investment-sale-stocks", "investment-sale-bonds", 
            "investment-sale-currency", "investment-sale-metals"
        ];

        if (empty($client_accounts)) {
            return [];
        }

        $placeholders = implode(',', array_fill(0, count($client_accounts), '?'));
        $transactions = $conn->prepare("SELECT amount,type FROM transactions 
        WHERE sender_account_id IN ($placeholders) OR recipient_account_id IN ($placeholders)");

        $params = array_merge($client_accounts, $client_accounts);
        $types = str_repeat('i', count($params));

        $bindParams = [$types];
        foreach ($params as $key => $value) {
            $bindParams[] = &$params[$key];
        }

        call_user_func_array([$transactions, 'bind_param'], $bindParams);
        $transactions->execute();
        $temp = $transactions->get_result()->fetch_all();

        if (count($temp) > 0) {
            for ($i = 0; $i < count($temp); $i++) {
                if ($temp[$i][1] === "replenishment") {
                    $replenishment_value += $temp[$i][0];
                } else if ($temp[$i][1] === "purchase") {
                    $purchase_value += $temp[$i][0];
                } else if ($temp[$i][1] === "transfer") {
                    $transfer_value += $temp[$i][0];
                } else if ($temp[$i][1] === "withdrawal") {
                    $withdrawal_value += $temp[$i][0];
                } else if (in_array($temp[$i][1], $investment_array)) {
                    $investment_value += $temp[$i][0];
                }
            }
        }

        array_push($result, $replenishment_value, $purchase_value, 
            $transfer_value, $withdrawal_value, $investment_value);

        return $result;
    }
?>