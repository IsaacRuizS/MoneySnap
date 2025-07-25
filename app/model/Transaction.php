<?php
require_once("../config/db.php");

class Transaction {

    public static function create($userId, $categoryId, $amount, $description, $type) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO Transactions (USER_ID, TRANSACTION_CATEGORY_ID, AMOUNT, DESCRIPTION, TYPE, CREATED_AT) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("iisss", $userId, $categoryId, $amount, $description, $type);
        return $stmt->execute();
    }

    public static function all() {
        global $conn;
        $result = $conn->query("SELECT * FROM Transactions");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function findById($id) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM Transactions WHERE TRANSACTION_ID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function delete($id) {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM Transactions WHERE TRANSACTION_ID = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
