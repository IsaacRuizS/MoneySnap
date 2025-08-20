<?php
require_once __DIR__ . '/../config/db.php';

class Saving {
    public static function create($userId, $name, $amount) {
        $conn = Database::connect();

        $transactionCategoryId = 3;
        $type = 'savings';

        $stmt = $conn->prepare("INSERT INTO transactions (USER_ID, TRANSACTION_CATEGORY_ID, AMOUNT, DESCRIPTION, TYPE, CREATED_AT) VALUES (?,?,?,?,?,NOW())");
        $stmt->bind_param("iidss", $userId, $transactionCategoryId, $amount, $name, $type);
        $result = $stmt->execute();
        $conn->close();
        return $result;
    }
    
    public static function getUserSavings($userId) {
        $conn = Database::connect();
        $stmt = $conn->prepare("
            SELECT *
            FROM transactions
            WHERE USER_ID = ? AND
            TYPE = 'savings'
            ORDER BY CREATED_AT DESC
        ");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();
        return $data;
    }
    
    public static function getById($id) {
        $conn = Database::connect();
        $stmt = $conn->prepare("SELECT * FROM transactions WHERE TRANSACTION_ID = ? AND TYPE = 'savings'");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $conn->close();
        return $data;
    }
    
    public static function update($id, $amount, $description) {
        $conn = Database::connect();
        $stmt = $conn->prepare("UPDATE transactions SET AMOUNT = ?, DESCRIPTION = ? WHERE TRANSACTION_ID = ? AND TYPE = 'savings'");
        $stmt->bind_param("dsi", $amount, $description, $id);
        $result = $stmt->execute();
        $conn->close();
        return $result;
    }
    
    public static function delete($id) {
        $conn = Database::connect();
        $stmt = $conn->prepare("DELETE FROM transactions WHERE TRANSACTION_ID = ? AND TYPE = 'savings'");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        return $result;
    }
}
?>
