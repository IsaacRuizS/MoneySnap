<?php
require_once("../config/db.php");

class Expense {
    public static function create($transactionId, $name, $balance) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO Expenses (TRANSACTION_ID, NAME, CURRENT_BALANCE, CREATED_AT) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("isd", $transactionId, $name, $balance);
        return $stmt->execute();
    }

    public static function all() {
        global $conn;
        $result = $conn->query("SELECT * FROM Expenses");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
