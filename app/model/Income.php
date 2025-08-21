<?php
require_once __DIR__ . '/../config/db.php';

class Income {
    public static function create($transactionId, $name, $balance) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO Incomes (TRANSACTION_ID, NAME, CURRENT_BALANCE, CREATED_AT) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("isd", $transactionId, $name, $balance);
        return $stmt->execute();
    }

    public static function all() {
        global $conn;
        $result = $conn->query("SELECT * FROM Incomes");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
