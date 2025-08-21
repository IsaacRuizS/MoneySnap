<?php
require_once __DIR__ . '/../model/Transaction.php';

class TransactionController {

    public function getAllTransactions() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['status' => 'error', 'message' => 'Usuario no autenticado']);
            return;
        }

        $transaction = new Transaction();
        $data = $transaction->getAll((int)$_SESSION['user_id']);

        echo json_encode(['status' => 'success', 'data' => $data]);
    }
}
