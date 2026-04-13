<?php 
  session_start();
  require_once("db.php");

  function get_user_last_history(int $client_id) : array
  {
    global $conn;
    $result = [];

    if (!$conn->query("SHOW TABLES LIKE 'transactions'")->fetch_row()) {
      $conn->query('CREATE TABLE `transactions` (
        `transaction_id` INT AUTO_INCREMENT PRIMARY KEY,
        `sender_account_id` INT NOT NULL,
        `recipient_account_id` INT NOT NULL,
        `description` TEXT,
        `amount` INT NOT NULL,
        `datetime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        `successfully` BOOLEAN NOT NULL
      )');
    };

    return $result;
  }

?>