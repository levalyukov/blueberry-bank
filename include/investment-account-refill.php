<?php 
    session_start();
    require_once("db.php");
    require_once("dashboard.php");
    require_once("investment.php");

    if (get_user_balance((int)$_SESSION["user"]["client_id"]) >= (int)$_POST["refill-value"]) {
        header("Location: ../index.php?page=investment");
        exit();
    } else {
        $_SESSION["investment-account-refill"] = "Недостаточно средств.";
        header("Location: ../index.php?page=investment&action=refill");
        exit();
    }
?>