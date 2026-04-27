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

            case "investment-purchase-stocks":
                return "Инвестиции";
            case "investment-purchase-bonds":
                return "Инвестиции";
            case "investment-purchase-currency":
                return "Инвестиции";
            case "investment-purchase-metals":
                return "Инвестиции";
            case "investment-sale-stocks":
                return "Инвестиции";
            case "investment-sale-bonds":
                return "Инвестиции";
            case "investment-sale-currency":
                return "Инвестиции";
            case "investment-sale-metals":
                return "Инвестиции";

            default: 
                return "";
        }
    }
?>