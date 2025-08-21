<?php

require_once __DIR__ . '/../config/db.php';

class Transaction
{
    private mysqli $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getAll(int $userId): array {
        $sql = "SELECT 
                    t.TRANSACTION_ID,
                    t.AMOUNT,
                    t.TYPE,
                    t.DESCRIPTION,
                    t.CREATED_AT,
                    t.TRANSACTION_CATEGORY_ID,
                    tc.NAME as CATEGORY
                FROM `transactions` t
                LEFT JOIN `transactioncategories` tc 
                    ON t.TRANSACTION_CATEGORY_ID = tc.TRANSACTION_CATEGORY_ID
                WHERE t.USER_ID = ? 
                ORDER BY t.CREATED_AT DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $res = $stmt->get_result();

        $transactions = [];
        while ($row = $res->fetch_assoc()) {
            $transactions[] = $row;
        }

        $stmt->close();
        return $transactions;
    }
}
