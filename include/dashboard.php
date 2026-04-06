<?php 

  /* ... */

  require_once "db.php";

  function get_user_balance(int $client_id): int 
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

  function get_user_month_income(): int 
  {
    return -1;
  }

  function get_user_month_expenses(): int 
  {
    return -1;
  }

  function get_user_last_history(int $client_id): array
  {
    return [1,2,3,4,5,6,7];
  }
  
  function has_invenstment_account(int $client_id): bool
  {
    return false;
  }

?>