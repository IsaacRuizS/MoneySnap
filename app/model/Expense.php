<?php

require_once __DIR__ . '/../config/db.php';

class Expense
{
    private mysqli $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function create(int $userId, float $amount, string $category, string $date, ?string $description = null): bool {

        // Insert en Transactions
        $sqlTxn = "INSERT INTO `transactions`
                    (`USER_ID`, `AMOUNT`, `TYPE`,  `CREATED_AT`, `DESCRIPTION`, `TRANSACTION_CATEGORY_ID`, `UPDATED_AT`)
                    VALUES
                    (?, ?, ?, ?, ?, 4, NULL)";
        
        $stmtTxn = $this->db->prepare($sqlTxn);
        $stmtTxn->bind_param("idsss", $userId, $amount, $category, $date, $description);
        $ok1 = $stmtTxn->execute();
        $transactionId = $this->db->insert_id;
        $stmtTxn->close();

        if (!$ok1) {
            return false;
        }

        // Insert en Expenses
        $sqlExp = "INSERT INTO `expenses`
                    (`TRANSACTION_ID`, `NAME`, `CURRENT_BALANCE`, `CREATED_AT`, `UPDATED_AT`, `DELETED_AT`)
                    VALUES
                    (?, ?, ?, NOW(), NULL, NULL)";
        
        $stmtExp = $this->db->prepare($sqlExp);
        $stmtExp->bind_param("isd", $transactionId, $category, $amount);
        $ok2 = $stmtExp->execute();
        $stmtExp->close();

        return $ok2;
    }
}
