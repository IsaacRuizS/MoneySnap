<?php
require_once __DIR__ . '/../model/Income.php';
require_once __DIR__ . '/../model/Expense.php';
require_once __DIR__ . '/../model/Transaction.php';


class ReportsController {
    public function getTransactions() {
        if (!isset($_SESSION['user_id'])) {

            echo json_encode(['status' => 'error', 'message' => 'Usuario no autenticado']);
            return;
        }

        $transaction = new Transaction();

        $expenses = $transaction->getExpensesByUserId($_SESSION['user_id']) ?? 0;
    }
}
