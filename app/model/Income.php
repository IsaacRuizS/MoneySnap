<?php

require_once __DIR__ . '/../config/db.php';

class Income
{
    private mysqli $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function create(int $userId, float $amount, string $category, string $date, ?string $description = null): bool {

        // Insert en Transactions
        $sqlTxn = "INSERT INTO `transactions`
                    (`USER_ID`, `AMOUNT`, `TYPE`, `CREATED_AT`, `DESCRIPTION`, `TRANSACTION_CATEGORY_ID`, `UPDATED_AT`)
                    VALUES
                    (?, ?, ?, ?, ?, 5, NULL)"; 

        $stmtTxn = $this->db->prepare($sqlTxn);
        $stmtTxn->bind_param("idsss", $userId, $amount, $category, $date, $description);
        $ok1 = $stmtTxn->execute();
        $transactionId = $this->db->insert_id;
        $stmtTxn->close();

        if (!$ok1) {
            return false;
        }

        // Insert en Incomes
        $sqlInc = "INSERT INTO `incomes`
                    (`TRANSACTION_ID`, `NAME`, `CURRENT_BALANCE`, `CREATED_AT`, `UPDATED_AT`, `DELETED_AT`)
                    VALUES
                    (?, ?, ?, NOW(), NULL, NULL)";

        $stmtInc = $this->db->prepare($sqlInc);
        $stmtInc->bind_param("isd", $transactionId, $category, $amount);
        $ok2 = $stmtInc->execute();
        $stmtInc->close();

        return $ok2;
    }
}
