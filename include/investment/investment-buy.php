<?php
    session_start();
    require_once(__DIR__ . "/../db.php");
    require_once(__DIR__ . "/../dashboard.php");
    require_once(__DIR__ . "/../investment.php");

    $id = $_GET["id"];
    $value = $_POST["value"];
    $type = $_GET["type"];
    $action = $_GET["action"];
    $account_id = $_POST["account_id"];
    $user_id = $_SESSION["user"]["client_id"];
    $price = get_price($id);


    if (!empty($value)) {
        $securitiesAdded = false;
        $total_price = $value*get_price($id);
        if (get_user_balance_by_account_id($user_id, $account_id) >= $total_price) {   
            $securities_check = $conn->prepare("SELECT * FROM portfolio WHERE user_id = ? AND securities_id = ?");
            $securities_check->bind_param("ii", $user_id, $id);
            $securities_check->execute();

            if ($securities_check->get_result()->num_rows > 0) {
                $securities_update = $conn->prepare("UPDATE portfolio SET amount = amount + ? WHERE user_id = ? AND securities_id = ?");
                $securities_update->bind_param("iii", $value, $user_id, $id);

                if (!$securities_update->execute()) {
                    $securities_update->close();
                    $_SESSION["transaction-error"] = "Произошла ошибка при создании заявки: " . $securities_update->error;
                    header("Location: ../../index.php?page=investment&action=".$action."&type=".$type."&id=".$id);
                    exit();
                }

                $securitiesAdded = true;
                $securities_update->close();
            } else {
                $portfolio = $conn->prepare("INSERT INTO portfolio 
                (user_id, securities_id, new_price, old_price, amount, type) VALUES (?,?,?,?,?,?)");
                $portfolio->bind_param("iiddis", $user_id, $id, $price, $price, $value, $type);
                if ($portfolio->execute()) {
                    $securitiesAdded = true;
                }
                $portfolio->close();
            }

            $securities_check->close();
            $transaction = $conn->prepare("UPDATE accounts SET balance = balance - ? WHERE id = ?");
            $transaction->bind_param("di", $total_price, $account_id);
            if ($securitiesAdded && $transaction->execute()) {
                $transaction->close();
                header("Location: ../../index.php?page=investment");
                exit();              
            } else {
                $_SESSION["transaction-error"] = "Произошла ошибка при создании заявки.";
                header("Location: ../../index.php?page=investment&action=".$action."&type=".$type."&id=".$id);
                exit();
            }
        } else {
            $_SESSION["transaction-error"] = "Недостаточно средств.";
            header("Location: ../../index.php?page=investment&action=".$action."&type=".$type."&id=".$id);
            exit();
        }
    }
?>