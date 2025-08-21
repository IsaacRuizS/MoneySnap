<?php
require_once __DIR__ . '/../config/db.php';

class TransactionCategory {

    public static function getCategories() {
        $conn = Database::connect();
        $stmt = $conn->prepare("
            SELECT TRANSACTION_CATEGORY_ID, NAME 
            FROM transactioncategories 
            WHERE DELETED_AT IS NULL 
            AND TRANSACTION_CATEGORY_ID NOT IN (4,5)
            ORDER BY NAME
        ");

        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();
        return $data;
    }
}
?>
