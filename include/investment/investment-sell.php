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

    if (!empty($value)) {
        $securities_selled = false;
        $total_price = $value*get_price($id);

        $check = $conn->prepare("SELECT * FROM portfolio WHERE user_id = ? AND securities_id = ?");
        $check->bind_param("ii", $account_id, $id);
        if ($check->execute()) { // На всякий случай
            $check->close();

            if ((int)get_securities_by_id($id)["amount"]-(int)$value <= 0) {
                
                $remove = $conn->prepare("DELETE FROM portfolio WHERE user_id = ? AND securities_id = ?");
                $remove->bind_param("ii", $user_id, $id);
                if ($remove->execute()) {
                    $remove->close();
                    $securities_selled = true;
                } else {
                    die($conn->error);
                }

            } else {

                $update = $conn->prepare("UPDATE portfolio SET amount = amount - ? WHERE user_id = ? AND securities_id = ?");
                $update->bind_param("iii", $value, $user_id, $id);
                if ($update->execute()) {
                    $update->close();
                    $securities_selled = true;
                } else {
                    die($conn->error);
                }

            }

            if ($securities_selled) {
                $account = $conn->prepare("UPDATE accounts SET balance = balance + ? WHERE user_id = ? AND id = ?");
                $account->bind_param("dii", $total_price, $user_id, $account_id);
                if ($account->execute()) {
                    header("Location: ../../index.php?page=investment");
                    exit();  
                } else {
                    die($conn->error);
                }
            }

        } else {
            $_SESSION['transaction-error'] = "Произошла ошибка создании заявки.";
            header("Location: ../../index.php?page=investment&action=".$action."&type=".$type."&id=".$id);
            exit();
        }
    }
?>