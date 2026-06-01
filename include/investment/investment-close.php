<?php 
    require_once(__DIR__ . "/../db.php");
    require_once(__DIR__ . "/../investment.php");

    $client_id = (int)$_GET["user_id"];

    if (has_invenstment_account($client_id)) {
        
        $delete = $conn->prepare("DELETE FROM accounts WHERE user_id = ? AND account_name = 'Брокерский счёт'");
        $delete->bind_param("i", $client_id);
        if ($delete->execute()) {
            // Добавить потом сюда отправку уведомление в центр уведомлений пользователя, если не забуду
            header("Location: ../../index.php");
            exit();  
        } else {
            die($conn->error);
        }

    } else {
        header("Location: ../../index.php");
        exit();
    }

?>