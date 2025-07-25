<?php
require_once("../config/db.php");

class Saving {
    public static function create($transactionId, $name, $balance, $deadline) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO Savings (TRANSACTION_ID, NAME, CURRENT_BALANCE, DEADLINE, CREATED_AT) VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param("isds", $transactionId, $name, $balance, $deadline);
        return $stmt->execute();
    }

    public static function all() {
        global $conn;
        $result = $conn->query("SELECT * FROM Savings");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
